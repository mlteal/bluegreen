<?php
/**
 * Navigation Functions
 *
 * @package Bluegreen
 */

namespace Bluegreen;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Nav {
	/**
	 * Nav constructor.
	 */
	function __construct() {
		static::register_menus();
	}
	/**
	 * This function is run by the Base class to get the menus registered
	 */
	static function register_menus() {
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'bluegreen' ),
		) );
	}

	/**
	 * Print the primary nav
	 */
	static function print_prinary_nav() {
		wp_nav_menu( array(
				'theme_location'    => 'menu-1',
				'depth'             => 2,
				'container'         => 'div id="navigation"',
				'menu_class'        => 'navbar-menu nav-menu',
				'fallback_cb'       => 'Bluegreen\\Navwalker::fallback',
				'walker'            => new Navwalker(),
			)
		);
	}
}
