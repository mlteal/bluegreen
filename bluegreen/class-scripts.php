<?php
/**
 * Scripts & Styles
 *
 * @package Bluegreen
 */

namespace Bluegreen;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Scripts {
	/**
	 * Scripts constructor.
	 */
	function __construct() {
		add_action( 'wp_enqueue_scripts', array( get_called_class(), 'enqueue_scripts' ) );
		add_action( 'login_enqueue_scripts', array( get_called_class(), 'login_enqueue_scripts' ) );
	}

	/**
	 * Enqueue scripts and styles.
	 */
	static function enqueue_scripts() {
		wp_register_style(
			'bluegreen-fontawesome',
			get_template_directory_uri() . '/assets/css/font-awesome.min.css',
			array(),
			'4.7.0' // Use the Fontawesome version here
		);
		wp_enqueue_style( 'bluegreen-fontawesome' );

		wp_register_style(
			'bluegreen-style',
			get_template_directory_uri() . '/assets/css/style.min.css',
			array( 'bluegreen-fontawesome' ),
			VERSION
		);
		wp_enqueue_style( 'bluegreen-style' );

		wp_register_script(
			'bluegreen-navigation',
			get_template_directory_uri() . '/assets/js/navigation.min.js',
			array(),
			VERSION,
			true
		);
		wp_enqueue_script( 'bluegreen-navigation' );

		wp_register_script(
			'bluegreen-skip-link-focus-fix',
			get_template_directory_uri() . '/assets/js/skip-link-focus-fix.min.js',
			array(),
			VERSION,
			true
		);
		wp_enqueue_script( 'bluegreen-skip-link-focus-fix' );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	static function login_enqueue_scripts() {
		wp_register_style(
			'bluegreen-login-style',
			get_template_directory_uri() . '/assets/css/login-style.min.css',
			array(),
			VERSION
		);
		wp_enqueue_style( 'bluegreen-login-style' );
	}
}
