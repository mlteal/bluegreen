<?php
/**
 * Theme Customizer Functions
 *
 * @package Bluegreen
 */

namespace Bluegreen;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Customizer {
	function __construct() {
		add_action( 'customize_register', array( get_called_class(), 'customize_register' ) );
		add_action( 'customize_preview_init', array( get_called_class(), 'enqueue_customizer_scripts' ) );
	}

	/**
	 * Add postMessage support for site title and description for the Theme Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	static function customize_register( $wp_customize ) {
		$wp_customize->remove_section( "colors" );
		$wp_customize->remove_section( "background_image" );

		$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	}

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 */
	static function enqueue_customizer_scripts() {
		wp_register_script(
			'bluegreen_customizer',
			get_template_directory_uri() . '/assets/js/customizer.js',
			array( 'customize-preview' ),
			'20151215',
			true
		);
		wp_enqueue_script( 'bluegreen_customizer' );
	}
}
