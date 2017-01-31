<?php
/**
 * Jetpack Compatibility File
 *
 * @link    https://jetpack.com/
 *
 * @package Bluegreen
 */

namespace Bluegreen;

class Jetpack {
	/**
	 * Jetpack constructor.
	 */
	function __construct() {
		add_action( 'after_setup_theme', array( get_called_class(), 'jetpack_setup' ) );
	}

	/**
	 * Jetpack setup function.
	 *
	 * See: https://jetpack.com/support/infinite-scroll/
	 * See: https://jetpack.com/support/responsive-videos/
	 */
	static function jetpack_setup() {
		// Add theme support for Infinite Scroll.
		add_theme_support( 'infinite-scroll', array(
			'container' => 'main',
			// TODO: check that this reference actually works :).
			'render'    => 'Bluegreen\\Jetpack::infinite_scroll_render',
			'footer'    => 'page',
		) );

		// Add theme support for Responsive Videos.
		add_theme_support( 'jetpack-responsive-videos' );
	}

	/**
	 * Custom render function for Infinite Scroll.
	 */
	static function infinite_scroll_render() {
		while ( have_posts() ) {
			the_post();
			if ( is_search() ) :
				get_template_part( 'template-parts/content', 'search' );
			else :
				get_template_part( 'template-parts/content', get_post_format() );
			endif;
		}
	}
}



