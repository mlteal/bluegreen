<?php
/**
 * Search Functions
 *
 * @package Bluegreen
 */

namespace Bluegreen;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Search {
	function __construct() {
		add_filter( 'get_search_form', array( get_called_class(), 'search_form' ), 100 );
	}

	/**
	 * Replace the default WP search form
	 *
	 * @param $form
	 *
	 * @return string
	 */
	static function search_form( $form ) {
		ob_start();
		?>
		<form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url( '/' ); ?>">
			<h2 class="widget-title is-bold">Search</h2>
			<div class="control has-addons">
				<label class="screen-reader-text" for="s"><?php _e( 'Search for:' ); ?></label>
				<input class="input" type="text" value="<?php echo get_search_query(); ?>" name="s" id="s"/>
				<input class="button" type="submit" id="searchsubmit" value="<?php echo esc_attr__( 'Submit' ); ?>"/>
			</div>
		</form>
		<?php

		return ob_get_clean();
	}
}



