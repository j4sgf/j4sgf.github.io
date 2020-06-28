<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package businessdeal
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php 
	//wp_body_open hook from WordPress 5.2
	if ( function_exists( 'wp_body_open' ) ) {
	    wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	} ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'businessdeal' ); ?></a>
	<?php
	if ( has_header_image() ) {
		/**
		* Header Image
		*/
		do_action ('businessdeal_frontend_header_image');
	}

	if ( ( is_front_page() && is_home() ) || is_front_page() ) {
		// Default homepage
		if ( is_active_sidebar( 'advertise-area' ) ) { ?>
			<div class="advertise-area">
				<div class="wrap">

					<?php dynamic_sidebar( 'advertise-area' ); ?>

				</div><!-- .wrap -->
			</div><!-- .advertise-area -->

		<?php }
	} ?>

	<?php
		$disable_search_form = get_theme_mod('disable_search_form',0);
	?>

	<header id="masthead" class="site-header">
		<div id="main-header" class="main-header">
			<div class="navigation-top">
        		<div class="wrap">
        			<?php 

						/**
						 * Site Branding
						 */
						do_action ('businessdeal_frontend_site_branding');
					?>

	            	<div id="site-header-menu" class="site-header-menu">
						<nav class="main-navigation" aria-label="<?php esc_attr_e('Primary Menu','businessdeal'); ?>" role="navigation">
							<?php
								/**
								 * Top Navigation
								 */
								do_action('businessdeal_frontend_navigation_top'); 
							?>
						</nav><!-- #site-navigation -->

						<?php if($disable_search_form ==0) { ?>
							<button type="button" class="search-toggle"><span><span class="screen-reader-text"><?php esc_html_e('Search for:','businessdeal'); ?></span></span></button>
						<?php } ?>
					</div>
				</div><!-- .wrap -->
			</div><!-- .navigation-top -->

			<?php
	 			if ( $disable_search_form == 0 ){
					/**
					* Search Form
					*/
					do_action('businessdeal_frontend_search_form');

				} ?>

			<div class="main-header-brand">
				<?php if( ( has_nav_menu( 'menu-3' ) ) || (  has_nav_menu('menu-2') ) ) { ?>
					<div class="secondary-nav-wrap">
						<div class="wrap">
							<?php

							if( has_nav_menu( 'menu-3' ) ){
								/**
								 * Secondary Navigation
								 */
								do_action('businessdeal_frontend_secondary_navigation');

							}

							if(has_nav_menu('menu-2')){ ?>
								<div class="header-social-menu">

									<?php
										/**
										 * Social navigation
										 */
										do_action ('businessdeal_frontend_social_navigation');
									?>

								</div><!-- .header-social-menu -->
							<?php } ?>
						</div><!-- .wrap -->
					</div><!-- .secondary-nav-wrap -->
				<?php } ?>

				<div id="nav-sticker">
					<div class="navigation-top">
						<div class="wrap">
							<div class="site-branding">
								 <?php the_custom_logo(); ?>
								<div class="site-branding-text">
									<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
									<?php
									$businessdeal_description = get_bloginfo( 'description', 'display' );
									if ( $businessdeal_description || is_customize_preview() ) : ?>
										<p class="site-description"><?php echo $businessdeal_description; /* WPCS: xss ok. */ ?></p>
									<?php endif; ?>
								</div><!-- .site-branding-text -->
							</div><!-- .site-branding -->

							<div id="site-header-menu" class="site-header-menu">
								<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e('Primary Menu','businessdeal'); ?>">
								<?php

									/**
									 * Top Navigation
									 */
									do_action('businessdeal_frontend_navigation_top');

								?>
								</nav><!-- #site-navigation -->
		            			<?php if($disable_search_form ==0) { ?>
									<button type="button" class="search-toggle"><span><span class="screen-reader-text"><?php esc_html_e('Search for:','businessdeal'); ?></span></span></button>
								<?php } ?>
							</div>
        				</div><!-- .wrap -->
     				</div><!-- .navigation-top -->
     			</div><!-- #nav-sticker -->
     			<?php
     			if ( $disable_search_form == 0 ){
					/**
					* Search Form
					*/
					do_action('businessdeal_frontend_search_form');

				} ?>
			</div><!-- .main-header-brand -->
		</div><!-- .main-header -->
		<?php do_action ('businessdeal_frontend_banner_display_type'); ?>
	</header><!-- #masthead -->

	<div id="content" class="site-content">