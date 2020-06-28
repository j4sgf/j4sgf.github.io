<?php
/**
 * Business Hub functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Business_Hub
 */

if ( ! function_exists( 'business_hub_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function business_hub_setup() {
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Business Hub, use a find and replace
	 * to change 'business-hub' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'business-hub', get_template_directory() . '/languages' );
	
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Remove Display Site Title and Tagline from site identity of customizer
	add_theme_support( 'custom-header', array(
		'header-text' => false
	) );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// WooCommerce compatible
	add_theme_support( 'woocommerce' );

	/*
	* Enable support for custom logo.
	*/  
	add_theme_support( 'custom-logo', array(
		'flex-height' => true,
		'flex-width'  => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 775, 370);
	add_image_size( 'business-hub-blog', 260, 250, true );
	add_image_size( 'business-hub-work', 357, 240, true );
	
	

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'top-bar' 	=> esc_html__( 'Top Bar', 'business-hub' ),
		'primary' 	=> esc_html__( 'Primary', 'business-hub' ),
		'social' 	=> esc_html__( 'Social Links Menu', 'business-hub' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'business_hub_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );	
}
endif;
add_action( 'after_setup_theme', 'business_hub_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function business_hub_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'business_hub_content_width', 785 );
}
add_action( 'after_setup_theme', 'business_hub_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function business_hub_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'business-hub' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'business-hub' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<header class="entry-header"><h4 class="widget-title">',
		'after_title'   => '</h4></header>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'business-hub' ),
		'id'            => 'sidebar-shop',
		'description'   => esc_html__( 'Add widgets here.', 'business-hub' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<header class="entry-header"><h4 class="widget-title">',
		'after_title'   => '</h4></header>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer: One', 'business-hub' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widget here. This section is used for top footer.', 'business-hub' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<header class="entry-header"><h4 class="widget-title">',
		'after_title'   => '</h4></header>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer: Two', 'business-hub' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widget here. This section is used for top footer.', 'business-hub' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<header class="entry-header"><h4 class="widget-title">',
		'after_title'   => '</h4></header>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer: Three', 'business-hub' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widget here. This section is used for top footer.', 'business-hub' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<header class="entry-header"><h4 class="widget-title">',
		'after_title'   => '</h4></header>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer: Four', 'business-hub' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Add widget here. This section is used for top footer.', 'business-hub' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<header class="entry-header"><h4 class="widget-title">',
		'after_title'   => '</h4></header>',
	) );
	
}
add_action( 'widgets_init', 'business_hub_widgets_init' );

if ( ! function_exists( 'business_hub_fonts_url' ) ) {
	/**
	 * Register Google fonts.
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function business_hub_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Exo+ font: on or off', 'business-hub' ) ) {
			$fonts[] = 'Exo 2:300,400,500,500i,600,700,900';
		}

		/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Roboto', 'business-hub' ) ) {
			$fonts[] = 'Roboto:300,400,500,700,900';
		}		

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}
}

/**
 * Enqueue scripts and styles.
 */
function business_hub_scripts() {

	$theme_options = business_hub_theme_options();

	wp_enqueue_style( 'meanmenu', get_template_directory_uri() . '/assets/css/meanmenu.css' );

	wp_enqueue_style( 'business-hub-grid', get_template_directory_uri() . '/assets/css/grid.css' );

	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.css' );	

	wp_enqueue_style( 'business-hub-style', get_stylesheet_uri() );

	wp_enqueue_style( 'business-hub-responsive', get_template_directory_uri() . '/assets/css/responsive.css' );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css' );

	wp_enqueue_style( 'business-hub-fonts', business_hub_fonts_url(), array(), null );


	wp_enqueue_script( 'business-hub-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20160908', true );

	wp_enqueue_script( 'business-hub-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20160909', true );

	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), '20160910', true );	

	wp_enqueue_script( 'jquery-meanmenu', get_template_directory_uri() . '/assets/js/jquery.meanmenu.js', array('jquery'), '20160911', true );

	wp_enqueue_script( 'jquery-waypoints', get_template_directory_uri() . '/assets/js/jquery.waypoints.min.js', array('jquery'), '20160912', true );

	wp_enqueue_script( 'business-hub-custom', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), '20160914', true );

	if( 1 === $theme_options['sticky_header'] ){
		wp_enqueue_script( 'business-hub-sticky-header', get_template_directory_uri() . '/assets/js/sticky.header.js', array('jquery'), '20160915', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
}
add_action( 'wp_enqueue_scripts', 'business_hub_scripts' );

require_once( trailingslashit( get_template_directory() ) . 'rigorous-themes/upgrade-button/class-customize.php' );



/**
 * Load Business Hub Functions.
 */
require get_template_directory() . '/rigorous-themes/init-functions.php';
