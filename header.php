<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bluegreen
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="is-fullheight">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content">Skip to content</a>
	<header id="header" class="hero">
		<div class="hero-head">
			<div class="container">
				<nav id="site-navigation" class="nav main-navigation" role="navigation">
					<div class="nav-left">
						<span class="site-title">
							<a href="<?php echo home_url( '/' ); ?>" class="nav-item is-brand" rel="home">
								<?php echo get_bloginfo( 'name' ); ?>
							</a>
						</span>
					</div>
					<button id="menu-toggle" class="button is-clear menu-toggle"
							aria-controls="primary-menu" aria-expanded="false">
						<span id="nav-toggle" class="nav-toggle">
							<span></span>
							<span></span>
							<span></span>
						</span>
					</button>
					<?php Bluegreen\Nav::print_prinary_nav(); ?>
				</nav><!-- #site-navigation -->
			</div><!-- .container -->
		</div><!-- .hero-head -->
	</header><!-- .hero -->

	<div id="content" class="site-content">
