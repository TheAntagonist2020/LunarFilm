<?php
/**
 * LUNARFILM theme functions and definitions
 *
 * This is a fully standalone theme with no parent theme dependency.
 *
 * @package LUNARFILM
 */

if ( ! defined( 'LUNARFILM_VERSION' ) ) {
	define( 'LUNARFILM_VERSION', '1.0.0' );
}

if ( ! function_exists( 'lunarfilm_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function lunarfilm_setup() {
		load_theme_textdomain( 'lunarfilm', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'lunarfilm' ),
				'footer'  => esc_html__( 'Footer Menu', 'lunarfilm' ),
			)
		);

		add_theme_support(
			'html5',
			array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
		);

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		add_theme_support(
			'custom-background',
			array(
				'default-color' => '0a0a0a',
				'default-image' => '',
			)
		);

		add_theme_support( 'customize-selective-refresh-widgets' );
	}
}
add_action( 'after_setup_theme', 'lunarfilm_setup' );

/**
 * Set the content width in pixels.
 *
 * @global int $content_width
 */
function lunarfilm_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lunarfilm_content_width', 1200 );
}
add_action( 'after_setup_theme', 'lunarfilm_content_width', 0 );

/**
 * Register widget areas.
 */
function lunarfilm_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'lunarfilm' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'lunarfilm' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'lunarfilm' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add footer widgets here.', 'lunarfilm' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'lunarfilm_widgets_init' );

/**
 * Enqueue theme styles and scripts.
 */
function lunarfilm_scripts() {
	wp_enqueue_style( 'lunarfilm-style', get_stylesheet_uri(), array(), LUNARFILM_VERSION );
}
add_action( 'wp_enqueue_scripts', 'lunarfilm_scripts' );
