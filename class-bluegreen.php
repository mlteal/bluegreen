<?php
/**
 * Main theme class
 *
 * @package Bluegreen
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Bluegreen {
	/**
	 * Bluegreen constructor.
	 */
	function __construct() {
		// Define any necessary constants, namespaced properly.
		static::defines();

		// Run the base class constructor.
		add_action( 'after_setup_theme', array( get_called_class(), 'run' ) );

		// Add the actions needed for the following classes that can't run via `after_setup_theme`.
		new Bluegreen\Customizer();
		new Bluegreen\Extras();
		new Bluegreen\Template_Tags();
//		new Bluegreen\Jetpack();

	}

	static function run() {
		// Instantiate the base class that will load everything that needs to run on setup.
		new Bluegreen\Base();
	}

	static function defines() {
		// dynamically pull the theme version right from the stylesheet
		$theme_info = wp_get_theme();
		define( 'Bluegreen\\VERSION', $theme_info->get( 'Version' ) );
	}
}
