<?php
/**
 * Scripts & Styles
 *
 * @package Bluegreen
 */

/**
 * Enqueue scripts and styles.
 */
function bluegreen_scripts() {
	wp_register_style(
		'bluegreen-fontawesome',
		get_template_directory_uri() . '/assets/css/font-awesome.min.css',
		array(),
		'4.7.0'
	);
	wp_enqueue_style( 'bluegreen-fontawesome' );

	wp_enqueue_style( 'bluegreen-style', get_template_directory_uri() . '/assets/css/style.min.css' );

	wp_enqueue_script( 'bluegreen-navigation', get_template_directory_uri() . '/assets/js/navigation.min.js', array(), '20151215', true );

	wp_enqueue_script( 'bluegreen-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.min.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bluegreen_scripts' );
