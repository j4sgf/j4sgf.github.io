<?php
/**
 * businessdeal functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package businessdeal
 */

include get_theme_file_path( 'vendor/wptrt/autoload/src/Loader.php' );

$businessdeal_loader = new \WPTRT\Autoload\Loader();

$businessdeal_loader->add( 'WPTRT\\Customize\\Section', get_theme_file_path( 'vendor/wptrt/customize-section-button/src' ) );

$businessdeal_loader->register();

if ( ! function_exists( 'businessdeal_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function businessdeal_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on businessdeal, use a find and replace
		 * to change 'businessdeal' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'businessdeal', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'businessdeal' ),
			'menu-2' => esc_html__( 'Social Links', 'businessdeal' ),
			'menu-3' => esc_html__( 'Secondary', 'businessdeal' ),
			'menu-4' => esc_html__( 'Footer', 'businessdeal' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'search-form',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'businessdeal_custom_background_args', array(
			'default-color' => '#ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, and column width.
		  */
		add_editor_style( array( 'css/editor-style.css', businessdeal_fonts_url() ) );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		add_image_size( 'businessdeal-welcome-widget', 768, 768, true );
		add_image_size( 'businessdeal-personal-widget', 500, 600, true );
		add_image_size( 'businessdeal-grid-post', 680, 500, true );
		add_image_size( 'businessdeal-blog', 768, 768, true );
		

	}

endif;
add_action( 'after_setup_theme', 'businessdeal_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function businessdeal_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'businessdeal_content_width', 1170 );
}
add_action( 'after_setup_theme', 'businessdeal_content_width', 0 );

/**
 * Sidebar Area
 */
require get_template_directory() . '/inc/widgets/sidebars.php';

/**
 * Widgets Area
 */
require get_template_directory() . '/inc/widgets/post-widgets.php';

/**
 * Personal Section Widgets
 */
require get_template_directory() . '/inc/widgets/personal-section.php';

/**
 * Service Widgets
 */
require get_template_directory() . '/inc/widgets/service-widgets.php';

/**
 * Welcome Widgets
 */
require get_template_directory() . '/inc/widgets/welcome-widgets.php';

/**
 * Brand Story Widgets
 */
require get_template_directory() . '/inc/widgets/brand-story.php';

/**
 * Call to Action Widgets
 */
require get_template_directory() . '/inc/widgets/call-to-action.php';

/**
 * Testimonial Slide Widgets
 */
require get_template_directory() . '/inc/widgets/testimonial-slide.php';

/**
 * Widgets Blog Category post
 */
require get_template_directory() . '/inc/widgets/blog-category-post.php';

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/style-scripts.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Theme Information
 */
require get_template_directory() . '/inc/information.php';

/**
 * Common Functions
 */
require get_template_directory() . '/inc/common-functions.php';

/**
 * Theme Functions
 */
require get_template_directory() . '/inc/theme-functions.php';


if ( !class_exists( 'BusinessDeal_Pro' ) ) {

	/**
	 * TGM plugin Activation
	 */
	require get_template_directory() . '/inc/tgm/tgm.php';

	/**
	 * Upgrade to Pro
	 */
	require get_template_directory() . '/inc/customizer/upgrade-to-pro.php';

	/**
	 * Home/ Frontpage checkbox
	 */
	require get_template_directory() . '/inc/custom/customizer-custom.php';

	/**
	 * About Page
	 */
	require get_template_directory() . '/inc/about-theme/about-theme.php';
}

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Theme Activation Notice
add_action( 'admin_notices', 'businessdeal_activation_notice' );

// Theme Ignore
add_action( 'admin_init', 'businessdeal_notice_ignore' );
function businessdeal_notice_ignore() {
  global $current_user;
  $user_id   = $current_user->ID;
  $theme_data  = wp_get_theme();

  if ( isset( $_GET[ sanitize_key( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore' ] ) && '0' == $_GET[ sanitize_key( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore' ] ) {
    add_user_meta( $user_id, sanitize_key( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore', 'true', true );
  }
}
