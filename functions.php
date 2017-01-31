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
require_once( get_template_directory() . '/class-bluegreen.php' );
new Bluegreen();
