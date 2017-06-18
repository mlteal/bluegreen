<?php
/**
 * Template part for displaying posts
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bluegreen
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'card' ); ?>>
	<?php if ( has_post_thumbnail() ): ?>
		<?php if ( ! is_single() ) : ?>
			<div class="card-image">
				<figure class="image is-16by9">
					<?php the_post_thumbnail( 'widget' ); ?>
				</figure>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	<div class="card-content">
		<div class="media">
			<header class="media-content">
				<?php if ( is_single() ) : ?>
					<?php Bluegreen\Util::the_title( 'is-2', false ); ?>
				<?php else : ?>
					<?php Bluegreen\Util::the_title( 'is-3' ); ?>
				<?php endif; ?>

				<?php if ( 'post' === get_post_type() ) : ?>
					<div class="subtitle is-6">
						<?php Bluegreen\Template_Tags::posted_on(); ?>
					</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->
		</div>
		<div class="content entry-content">
			<?php if ( is_single() ) : ?>
				<?php the_content( sprintf(
				/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'bluegreen' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bluegreen' ),
					'after'  => '</div>',
				) );
				?>
			<?php else : ?>
				<?php the_excerpt(); ?>
			<?php endif; ?>
			<div class="content entry-footer">
				<small><?php Bluegreen\Template_Tags::entry_footer(); ?></small>
			</div><!-- .entry-footer -->
		</div><!-- .entry-content -->
	</div>

</article><!-- #post-## -->
