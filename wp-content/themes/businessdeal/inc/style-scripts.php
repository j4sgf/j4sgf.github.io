<?php
 /**
 * Enqueue scripts and styles.
 *
 * @package businessdeal
 */

function businessdeal_scripts() {
	$select_main_banner_category = get_theme_mod('select_main_banner_category','');
	$slider_options = get_theme_mod('slider-options','main-banner');
	$disable_main_banner = get_theme_mod('disable_main_banner',0);
	$enable_sticky_menu = get_theme_mod('enable_sticky_menu',1);
	wp_enqueue_style( 'businessdeal-style', get_stylesheet_uri() );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/library/fontawesome/css/all.min.css' );

	wp_enqueue_style( 'businessdeal-google-fonts', businessdeal_fonts_url(), array(), null );

	wp_enqueue_script('businessdeal-global', get_template_directory_uri().'/assets/js/global.js', array('jquery'), true, false);

	wp_enqueue_script( 'businessdeal-navigation', get_template_directory_uri() . '/assets/js/navigation.min.js', array(), false, true );

	wp_enqueue_script( 'businessdeal-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), false, true );

	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/library/slick/slick.min.js', array(), false, true );

	wp_enqueue_script( 'businessdeal-slick-settings', get_template_directory_uri() . '/assets/library/slick/slick-settings.js', array(), false, true );

	if($enable_sticky_menu ==1 ){
		wp_enqueue_script( 'jquery-sticky', get_template_directory_uri() . '/assets/library/sticky/jquery.sticky.js', array(), false, true );
		wp_enqueue_script( 'businessdeal-sticky-settings', get_template_directory_uri() . '/assets/library/sticky/sticky-setting.js', array(), false, true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'businessdeal_scripts' );

function businessdeal_admin_notice (){

  wp_enqueue_style( 'businessdeal-admin-css', get_template_directory_uri() . '/css/admin/admin.css' );

}

add_action( 'admin_enqueue_scripts', 'businessdeal_admin_notice' );

if ( ! function_exists( 'businessdeal_fonts_url' ) ) :
/**
 * Register Google fonts for BusinessDeal.
 *
 * Create your own businessdeal_fonts_url() function to override in a child theme.
 *
 *
 * @return string Google fonts URL for the theme.
 */
function businessdeal_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Open+Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Open+Sans font: on or off', 'businessdeal' ) ) {
		$fonts[] = 'Open+Sans:400,400i,500,500i,700';
	}

	/* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'businessdeal' ) ) {
		$fonts[] = 'Roboto:400,400i,500,500i,700&display=swap';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => esc_attr( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;