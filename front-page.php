<?php
/**
 * The front-page template, overrides the index template
 * regardless of whether the front page is posts or a
 * specific page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bluegreen
 */

get_header();
?>
<section id="front_page_hero" class="hero is-primary is-large">
	<!-- Hero header: will stick at the top -->
	<div class="hero-head"></div>

	<!-- Hero content: will be in the middle -->
	<div class="hero-body">
		<div class="container has-text-centered">
			<h1 class="title"><?php echo get_bloginfo( 'name' ); ?></h1>
			<h2 class="subtitle"><?php echo get_bloginfo( 'description' ); ?></h2>
		</div>
	</div>
</section>
<div id="primary" class="content-area">
	<main id="main" class="site-main wrapper" role="main">
		<?php if ( have_posts() ) : ?>
			<div class="container">
				<div class="columns is-multiline">
					<?php while ( have_posts() ) : the_post(); ?>
						<div class="column is-one-third">
							<?php get_template_part( 'template-parts/content', 'post' ); ?>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
			<div class="section pagination">
				<div class="container">
					<?php Bluegreen\Pagination::print_pagination(); ?>
				</div>
			</div>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
