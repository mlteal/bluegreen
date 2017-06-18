<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Bluegreen
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
	$categories_list = '<li>' . get_the_category_list( __( '</li><li></li>', 'bluegreen' ), '', get_the_ID() );
	$categories = sprintf(
		'<ul class="cat-links">' . esc_html__( '%1$s', 'bluegreen' ) . '</ul>',
		$categories_list );
	?>
	<div class="hero is-primary is-fullheight" <?php echo $hero_style; ?>>
		<!-- Hero content: will be in the middle -->
		<div class="hero-body">
			<div class="container has-text-centered">
				<h1 class="title"><?php the_title(); ?></h1>
				<div class="subtitle"><?php echo get_the_date( '', get_the_ID() ); ?></div>
			</div>
		</div>
		<div class="hero-foot">
			<nav class="tabs">
				<div class="container">
					<?php echo $categories; ?>
				</div>
			</nav>
		</div>
	</div>
	<div id="primary" class="content-area">
		<main id="main" class="site-main wrapper" role="main">
			<?php get_template_part( 'template-parts/content', 'post' ); ?>
			<div class="section">
				<div class="container is-narrow">
					<?php the_post_navigation(); ?>
				</div>
			</div>
			<?php Bluegreen\Util::the_comments(); ?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php endwhile; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
