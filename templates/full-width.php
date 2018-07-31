<?php
/**
 * Template name: Full Width
 */

get_header(); ?>
<?php while ( have_posts() ) :
	the_post();
	$hero_style = '';
	if ( has_post_thumbnail() ) {
		$hero_style = 'style="background-image: url('
		              . get_the_post_thumbnail_url( get_the_ID(), 'large' )
		              . ');" ';
	}
	?>
	<div class="hero is-primary" <?php echo $hero_style; ?>>
		<!-- Hero content: will be in the middle -->
		<div class="hero-body">
			<div class="container has-text-centered">
				<h1 class="title"><?php the_title(); ?></h1>
			</div>
		</div>
	</div>
	<div id="primary" class="content-area is-fullwidth">
		<main id="main" class="site-main wrapper is-fullhd" role="main">
			<article id="post-<?php the_ID(); ?>">
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
			</article><!-- #post-## -->
		</main><!-- #main -->
	</div><!-- #primary -->
<?php endwhile; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
