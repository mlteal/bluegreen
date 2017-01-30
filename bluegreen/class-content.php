<?php
/**
 * Content Functions
 *
 * @package Bluegreen
 */

namespace Bluegreen;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Content {
	/**
	 * Content constructor.
	 */
	function __construct() {
		add_action( 'after_setup_theme', array( get_called_class(), 'content_width' ), 0 );
	}

	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	static function content_width() {
		$GLOBALS['content_width'] = apply_filters( 'bluegreen_content_width', 640 );
	}
}
