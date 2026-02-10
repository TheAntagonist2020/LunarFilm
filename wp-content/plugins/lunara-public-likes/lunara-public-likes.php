<?php
/**
 * Plugin Name: Lunara Public Likes
 * Description: Adds a simple Like button that works for all visitors (no WordPress.com login required). Designed for Lunara Film.
 * Version: 1.0.0
 * Author: Lunara Film
 * License: GPL2+
 */

if (!defined('ABSPATH')) {
    exit;
}

class Lunara_Public_Likes {
    const META_KEY = '_lunara_public_like_count';
    const COOKIE_PREFIX = 'lunara_liked_';
    const NONCE_ACTION = 'lunara_public_like';

    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);

        add_shortcode('lunara_like', [$this, 'shortcode']);

        // Auto-append below content for single posts/reviews unless disabled.
        add_filter('the_content', [$this, 'append_to_content'], 20);

        add_action('wp_ajax_lunara_public_like', [$this, 'ajax_like']);
        add_action('wp_ajax_nopriv_lunara_public_like', [$this, 'ajax_like']);
    }

    /**
     * Allow theme/site to adjust which post types get the automatic Like button.
     */
    private function get_auto_post_types() {
        $types = apply_filters('lunara_public_likes_post_types', ['post', 'review']);
        if (!is_array($types)) {
            $types = ['post', 'review'];
        }
        return array_values(array_filter($types));
    }

    public function enqueue_assets() {
        if (!is_singular()) {
            return;
        }

        wp_register_script(
            'lunara-public-likes',
            plugins_url('assets/lunara-public-likes.js', __FILE__),
            [],
            '1.0.0',
            true
        );

        wp_localize_script('lunara-public-likes', 'LunaraPublicLikes', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce(self::NONCE_ACTION),
        ]);

        wp_register_style(
            'lunara-public-likes',
            plugins_url('assets/lunara-public-likes.css', __FILE__),
            [],
            '1.0.0'
        );

        wp_enqueue_script('lunara-public-likes');
        wp_enqueue_style('lunara-public-likes');
    }

    public function append_to_content($content) {
        if (!is_singular() || !in_the_loop() || !is_main_query()) {
            return $content;
        }

        $post = get_post();
        if (!$post) {
            return $content;
        }

        if (!in_array($post->post_type, $this->get_auto_post_types(), true)) {
            return $content;
        }

        // Avoid double-inserting if the shortcode is already used.
        if (has_shortcode($content, 'lunara_like')) {
            return $content;
        }

        return $content . $this->render_button($post->ID);
    }

    public function shortcode($atts) {
        $atts = shortcode_atts([
            'post_id' => 0,
        ], $atts, 'lunara_like');

        $post_id = intval($atts['post_id']);
        if ($post_id <= 0) {
            $post_id = get_the_ID();
        }
        if ($post_id <= 0) {
            return '';
        }

        return $this->render_button($post_id);
    }

    private function get_like_count($post_id) {
        $count = get_post_meta($post_id, self::META_KEY, true);
        $count = is_numeric($count) ? intval($count) : 0;
        return max(0, $count);
    }

    private function has_liked($post_id) {
        $cookie_name = self::COOKIE_PREFIX . $post_id;
        return !empty($_COOKIE[$cookie_name]);
    }

    private function set_liked_cookie($post_id) {
        $cookie_name = self::COOKIE_PREFIX . $post_id;
        // 1 year.
        setcookie($cookie_name, '1', time() + 365 * 24 * 60 * 60, COOKIEPATH ?: '/', COOKIE_DOMAIN ?: '', is_ssl(), true);
        // Mirror into the current request for immediate UI updates.
        $_COOKIE[$cookie_name] = '1';
    }

    private function render_button($post_id) {
        $count = $this->get_like_count($post_id);
        $liked = $this->has_liked($post_id);

        $classes = 'lunara-like-button' . ($liked ? ' is-liked' : '');

        $label = $liked ? 'Liked' : 'Like';

        $html  = '<div class="lunara-like-wrap" data-post-id="' . esc_attr($post_id) . '">';
        $html .= '<button type="button" class="' . esc_attr($classes) . '" data-post-id="' . esc_attr($post_id) . '">';
        $html .= '<span class="lunara-like-icon" aria-hidden="true">★</span>';
        $html .= '<span class="lunara-like-label">' . esc_html($label) . '</span>';
        $html .= '<span class="lunara-like-count" aria-label="Likes">' . esc_html(number_format_i18n($count)) . '</span>';
        $html .= '</button>';
        $html .= '</div>';

        return $html;
    }

    public function ajax_like() {
        $nonce = isset($_POST['nonce']) ? sanitize_text_field(wp_unslash($_POST['nonce'])) : '';
        if (!wp_verify_nonce($nonce, self::NONCE_ACTION)) {
            wp_send_json_error(['message' => 'Invalid request.'], 403);
        }

        $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
        if ($post_id <= 0 || get_post_status($post_id) === false) {
            wp_send_json_error(['message' => 'Invalid post.'], 400);
        }

        // Prevent repeat likes from the same browser using a cookie.
        if ($this->has_liked($post_id)) {
            wp_send_json_success([
                'count' => $this->get_like_count($post_id),
                'liked' => true,
            ]);
        }

        $count = $this->get_like_count($post_id);
        $count++;
        update_post_meta($post_id, self::META_KEY, $count);

        $this->set_liked_cookie($post_id);

        wp_send_json_success([
            'count' => $count,
            'liked' => true,
        ]);
    }
}

new Lunara_Public_Likes();
