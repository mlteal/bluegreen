<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bluegreen
 */

/**
 * Require the self-instantiating Autoloader class that will
 * autoload anything in the `bluegreen` dir.
 *
 * Every class in the `bluegreen` dir should be namespaced with `Bluegreen`.
 */
require_once( get_template_directory() . '/class-bluegreen-autoloader.php' );

if ( ! function_exists( 'bluegreen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bluegreen_setup() {
	// instantiate the base class that will load everything that needs to run on setup.
	new Bluegreen\Base();

	require get_template_directory() . '/bluegreen/pagination.php';
	require get_template_directory() . '/bluegreen/widgets.php';
	require get_template_directory() . '/bluegreen/search.php';
	require get_template_directory() . '/bluegreen/scripts-styles.php';
}
endif;
add_action( 'after_setup_theme', 'bluegreen_setup' );

require get_template_directory() . '/bluegreen/template-tags.php';
require get_template_directory() . '/bluegreen/extras.php';
require get_template_directory() . '/bluegreen/customizer.php';
require get_template_directory() . '/bluegreen/jetpack.php';
