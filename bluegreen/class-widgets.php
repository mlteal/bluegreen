<?php
/**
 * Widget Functions
 *
 * @package Bluegreen
 */

namespace Bluegreen;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Widgets {
	function __construct() {
		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_action( 'widgets_init', array( get_called_class(), 'widgets_init' ) );
	}

	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	static function widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'bluegreen' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'bluegreen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s column is-one-third">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title is-bold">',
			'after_title'   => '</h2>',
		) );
	}

}
