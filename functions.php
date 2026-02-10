<?php
/**
 * LUNARFILM theme functions and definitions
 *
 * @package LUNARFILM
 */

if ( ! function_exists( 'lunarfilm_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function lunarfilm_setup() {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
	}
}
add_action( 'after_setup_theme', 'lunarfilm_setup' );

/**
 * Enqueue theme styles.
 */
function lunarfilm_scripts() {
	wp_enqueue_style( 'lunarfilm-style', get_stylesheet_uri(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'lunarfilm_scripts' );
