<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_Hub
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php 

	$theme_options = business_hub_theme_options();

	$site_identity 	= $theme_options['site_identity'];

	$header_class 	= 'site-header header primary-header';

	if( 'logo-only' === $site_identity ){

		$header_class = 'site-header header primary-header header-logo-only';

	}elseif ( 'logo-text' === $site_identity ) {

		$header_class = 'site-header header primary-header header-logo-text';

	}elseif ( 'title-only' === $site_identity ) {

		$header_class = 'site-header header primary-header header-title-only';	

	}elseif ( 'title-text' === $site_identity ) {

		$header_class = 'site-header header primary-header header-title-text';

	}

?>
<div id="page" class="site">
	<header id="masthead" class="<?php echo esc_attr( $header_class ); ?>" role="banner">
		<?php do_action( 'business_hub_top_header' ); ?>

		<?php if ( get_header_image() ) {	
			$bg_image_url = get_header_image();
		?> 
		<div class="contact-info-section header-background-image" style="background-image: url(<?php echo esc_url( $bg_image_url ); ?>);">
		<?php } else { ?>
		<div class="contact-info-section">
		<?php } ?>

			<div class="container">
				<div class="row">
					<div class="col col-1-of-4">
					    <div class="site-branding">
							<?php						

							$title 			= get_bloginfo( 'name', 'display' );

							$description 	= get_bloginfo( 'description', 'display' );

							if( 'logo-only' == $site_identity){

								if ( has_custom_logo() ) {

									the_custom_logo();

								}
							} elseif( 'logo-text' == $site_identity){

								if ( has_custom_logo() ) {

									the_custom_logo();

								}

								if ( $description ) {
									echo '<p class="site-description">'.esc_html( $description ).'</p>';
								}

							} elseif( 'title-only' == $site_identity && $title ){ ?>

								<h1 class="site-title title-only"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php 

							}elseif( 'title-text' == $site_identity){ 

								if( $title ){ ?>

									<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
									<?php 
								}

								if ( $description ) {

									echo '<p class="site-description">'.esc_html( $description ).'</p>';

								}
							}

							?>
						</div><!-- .site-branding -->
					</div><!-- .col -->
					<div class="col col-3-of-4">
					    <div class="contact-information-wrapper">
					        <div class="contact-information">
					        	<?php if( !empty( $theme_options['top_address'] ) ){ ?>
						            <dl>
						                <dt><i class="fa fa-map-marker"></i></dt>
						                <dd>
						              		<p><?php echo esc_html( $theme_options['top_address'] ); ?></p>
						                </dd>
						            </dl>
						        <?php } ?>

						        <?php if( !empty( $theme_options['top_telephone'] ) ){ 

						        	$telephone 	= $theme_options['top_telephone'];

						        	$phone 		= str_replace( ' ', '', $telephone );

						        	$phone 		= str_replace( '(', '', $phone );

						        	$phone 		= str_replace( ')', '', $phone );

						        	$phone 		= str_replace( '-', '', $phone );

						        	?>
						            <dl>
						                <dt><i class="fa fa-phone"></i></dt>
						                <dd>
						                    <p><a href="tel:<?php echo esc_html( $phone ); ?>"><?php echo esc_html( $telephone ); ?></a><p>
						                </dd>
						            </dl>
					            <?php } ?>

					            <?php if( !empty( $theme_options['top_email'] ) ){ ?>
						            <dl>
						                <dt><i class="fa fa-envelope"></i></dt>
						                <dd>
						                 	<p><a href="mailto:<?php echo esc_html( $theme_options['top_email'] ); ?>"><?php echo esc_html( $theme_options['top_email'] ); ?></a></p>
						                </dd>
						            </dl>
					            <?php } ?>
					        </div>
					    </div><!-- .contact-information -->
					</div><!-- .col -->
				</div>
			</div>
		</div><!-- .contact-info-section -->		

		<div class="full-nav-menu">
		    <div class="container">
		        <div class="row">
		            <div class="col col-1-of-1">
		                <nav class="main-navigation">
		                	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'fallback_cb' => 'business_hub_menu_fallback', 'container'=> false ) ); ?>              
		                </nav><!-- .main-navigation -->

		                <?php get_search_form(); ?>
		            </div><!-- .col -->
		        </div><!-- .row -->
		    </div><!-- .container -->
		</div><!-- .full-nav-menu -->
	</header><!-- #masthead -->

	<?php 
	if( ! is_home() && is_front_page() ){

		do_action( 'business_hub_slider' );

		do_action( 'business_hub_quote' );

		do_action( 'business_hub_action_home_content' );

	}

	do_action( 'business_hub_action_before_container' );