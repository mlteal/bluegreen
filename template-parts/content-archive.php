<?php
/**
 * Template part for displaying post archive
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bluegreen
 */

$image = get_the_post_thumbnail_url( get_the_ID(), 'widget' );
$post_style = '';
if ( $image ) {
	$post_style = 'style="background-image: url(' . $image . ');" ';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'columns' ); ?>>
	<div class="column is-one-third featured-image" <?php echo $post_style; ?>>
	</div>
	<div class="column is-two-thirds container content">
		<header class="entry-header">
			<?php Bluegreen\Util::the_title( 'is-3' ); ?>
			<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php Bluegreen\Template_Tags::posted_on(); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	</div>
</article><!-- #post-## -->
