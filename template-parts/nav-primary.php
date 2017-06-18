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