<?php
/**
 * Extra Functions
*
 * @package Bluegreen
 */

namespace Bluegreen;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Extras {
	function __construct() {
		add_filter( 'body_class', array( get_called_class(), 'body_classes' ) );
		add_action( 'wp_head', array( get_called_class(), 'pingback_header' ) );
	}

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	static function body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		return $classes;
	}

	/**
	 * Add a pingback url auto-discovery header for singularly identifiable articles.
	 */
	static function pingback_header() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
		}
	}
}
