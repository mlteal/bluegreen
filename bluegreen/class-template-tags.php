<?php
/**
 * Custom Template Tags
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Bluegreen
 */

namespace Bluegreen;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Template_Tags {
	function __construct() {
		add_action( 'edit_category', array( get_called_class(), 'category_transient_flusher' ) );
		add_action( 'save_post', array( get_called_class(), 'category_transient_flusher' ) );
	}

	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	static function posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			esc_html_x( 'Posted on %s', 'post date', 'bluegreen' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			esc_html_x( 'by %s', 'post author', 'bluegreen' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
	}

	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	static function entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'bluegreen' ) );
			if ( $categories_list && self::categorized_blog() ) {
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'bluegreen' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'bluegreen' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'bluegreen' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			/* translators: %s: post title */
			comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'bluegreen' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
			echo '</span>';
		}

		edit_post_link(
			sprintf(
			/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'bluegreen' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}

	/**
	 * Returns true if a blog has more than 1 category.
	 *
	 * @return bool
	 */
	static function categorized_blog() {
		if ( false === ( $categories = get_transient( 'bluegreen_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$categories = get_categories( array(
				'fields'     => 'ids',
				'hide_empty' => 1,
				// We only need to know if there is more than one category.
				'number'     => 2,
			) );

			// Count the number of categories that are attached to the posts.
			$categories = count( $categories );

			set_transient( 'bluegreen_categories', $categories );
		}

		if ( $categories > 1 ) {
			// This blog has more than 1 category so bluegreen_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so bluegreen_categorized_blog should return false.
			return false;
		}
	}

	/**
	 * Flush out the transients used in bluegreen_categorized_blog.
	 */
	static function category_transient_flusher() {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Like, beat it. Dig?
		delete_transient( 'bluegreen_categories' );
	}
}
