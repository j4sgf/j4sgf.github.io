<?php
/**
 * BusinessDeal Theme Customizer
 *
 * @package businessdeal
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function businessdeal_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'businessdeal_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'businessdeal_customize_partial_blogdescription',
		) );
	}
	class BusinessDeal_title_display extends WP_Customize_Control {
        public $type = 'main-title';
        public $label = '';
        public function render_content() {
        ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
        <?php
        }
    }

	// Add Panel
	$wp_customize->add_panel( 'businessdeal_options_panel', array(
		'priority' => 10,
		'capability' => 'edit_theme_options',
		'title' => esc_html__( 'Theme Options', 'businessdeal' ),
	) );



	// Add Section
	$wp_customize->add_section( 'businessdeal_all_theme_options', array(
		'priority' => 10,
		'capability' => 'edit_theme_options',
		'title' => esc_html__( 'All theme Options', 'businessdeal' ),
		'panel' => 'businessdeal_options_panel',
	) );

	$wp_customize->add_section( 'businessdeal_main_banner_section', array(
		'priority' => 30,
		'capability' => 'edit_theme_options',
		'title' => esc_html__( 'Main Banner', 'businessdeal' ),
		'panel' => 'businessdeal_options_panel',
	) );

	$wp_customize->add_section( 'businessdeal_highlighted_category_section', array(
		'priority' => 40,
		'capability' => 'edit_theme_options',
		'title' => esc_html__( 'Highlighted Category', 'businessdeal' ),
		'panel' => 'businessdeal_options_panel',
	) );

	/**
	 * Load our custom control.
	 */
	require_once get_template_directory() . '/inc/custom/class-customizer-toggle-control.php';

	/**
	 * Load our custom radio image.
	 */
   require_once get_template_directory() . '/inc/custom/radio-image/class-radio-image-control.php';
   $wp_customize->register_control_type( 'Businessdeal_Control_Radio_Image' );



	/**
	 * Control Checkbox Multiple
	 */
	 require get_template_directory() . '/inc/customizer/control-checkbox-multiple.php';

	/**
	 * All theme Options section
	 */
	require get_template_directory() . '/inc/customizer/all-theme-options.php';

	/**
	 * Main Banner Section
	 */
	require get_template_directory() . '/inc/customizer/main-banner.php';

	/**
	 * Excerpt Display
	 */
	require get_template_directory() . '/inc/customizer/excerpt-display.php';

	/**
	 * Sanitize functions
	 */
	require get_template_directory() . '/inc/customizer/sanitize-callback-functions.php';

	}
add_action( 'customize_register', 'businessdeal_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function businessdeal_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function businessdeal_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function businessdeal_customize_preview_js() {
	wp_enqueue_script( 'businessdeal-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20180801', true );

}
add_action( 'customize_preview_init', 'businessdeal_customize_preview_js' );
