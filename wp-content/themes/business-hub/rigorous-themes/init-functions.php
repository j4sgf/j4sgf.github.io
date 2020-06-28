<?php 

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/rigorous-themes/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/rigorous-themes/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/rigorous-themes/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/rigorous-themes/jetpack.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/rigorous-themes/customizer/customizer.php';

/**
 * Load Controls.
 */
require get_template_directory() . '/rigorous-themes/customizer/controls.php';

/**
 * Load Sanitization Functions.
 */
require get_template_directory() . '/rigorous-themes/customizer/sanitization.php';

/**
 * Load Default Options.
 */
require get_template_directory() . '/rigorous-themes/customizer/defaults.php';

/**
 * Init Hooks of the theme
 */
require get_template_directory() . '/rigorous-themes/hooks/hooks-init.php';

//=============================================================
// Widget : Recent Posts Extended
//=============================================================
require get_template_directory() . '/rigorous-themes/widgets/recent-post-extended.php';


//=============================================================
// Menu Fallback function
//=============================================================

if ( !function_exists('business_hub_menu_fallback') ) :

function business_hub_menu_fallback(){

	echo '<ul id="menu-main-menu" class="menu">';
		echo '<li class="menu-item"><a href="' . esc_url( home_url( '/' ) ) . '">' . __( 'Home', 'business-hub' ). '</a></li>';
		wp_list_pages( array(
			'title_li' => '',
			'depth'    => 1,
			'number'   => 5,
		) );
		echo '</ul>';
	
}

endif;

//=============================================================
// Function limit the number of words.
//=============================================================

function business_hub_limit_words($string, $word_limit) {

	$words = explode(' ', $string, ($word_limit + 1));

	if(count($words) > $word_limit) {

		if(count($words) > $word_limit) {

			array_pop($words);

			return implode(' ', $words).'...';
			
		}
	} else {  

		return $string;

	}

}

//=============================================================
// Function to change the number of words in excerpt.
//=============================================================

if ( ! function_exists( 'business_hub_excerpt_length' ) ) :
	
	function business_hub_excerpt_length( $length ) {

		$excerpt_length = business_hub_theme_options();

		if ( empty( $excerpt_length['excerpt_length'] ) ) {

			$excerpt_length = $length;

		}
		
		return absint( $excerpt_length['excerpt_length'] );

	}

endif;
add_filter( 'excerpt_length', 'business_hub_excerpt_length', 999 );

//=============================================================
// To add class on body for sidebar
//=============================================================
if ( ! function_exists( 'business_hub_alter_body_class' ) ) {

	function business_hub_alter_body_class( $classes ) {
	    
	    $theme_options = business_hub_theme_options();

	    if( isset( $theme_options['sidebar'] ) && 'left' == $theme_options['sidebar'] ) {

	        $sidebar_layout = 'left-sidebar';    

	    }elseif( isset( $theme_options['sidebar'] ) && 'right' == $theme_options['sidebar'] ) {

	        $sidebar_layout = 'right-sidebar';

	    }else{
	    	$sidebar_layout = 'no-sidebar';
	    }            
	    
	    $classes[] = $sidebar_layout;

	    return $classes;
	}
	
}
add_filter( 'body_class', 'business_hub_alter_body_class' );


//=============================================================
// Function to check widget status
//=============================================================
 if ( ! function_exists( 'business_hub_widget_count' ) ) :

 function business_hub_widget_count( $sidebar_names ){

    $status = 0;

    foreach ($sidebar_names as $sidebar) {
      
        if( is_active_sidebar( $sidebar )){
            $status = $status+1;
        }
    }

    return $status;        
 }

endif;

//=============================================================
// Function for custom header style
//=============================================================

if ( ! function_exists( 'business_hub_header_style' ) ) {
	function business_hub_header_style() {
		$header_text_color = get_header_textcolor();
		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: HEADER_TEXTCOLOR.
		 */
		$header_text_css = '';
		
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			$header_text_css = '.site-title,
				.site-description {
					position: absolute;
					clip: rect(1px, 1px, 1px, 1px);
				}';
			// If the user has set a custom color for the text use that.
			else :
			$header_text_css ='.site-title a,
						.site-description {
							color: #<?php echo esc_attr( $header_text_color ); ?>;
						}';
		endif; 
		
		$css = $header_text_css; 

		wp_add_inline_style( 'business-hub-style', $css );
	}
}

add_action( 'wp_enqueue_script', 'business_hub_header_style' );

//======================================================================
// Function for owlcarousel dynamic slideSpeed and autoplayTimeout
//======================================================================

if ( ! function_exists( 'business_hub_load_owl_scripts' ) ) {

function business_hub_load_owl_scripts() {
	$theme_options = business_hub_theme_options();

	wp_localize_script('business-hub-custom', 'business_hub_script_vars', array(
			'slideSpeed' 		=> ($theme_options['slider_transition_duration']*1000),
			'autoplayTimeout' 	=> ($theme_options['slider_transition_delay']*1000),
		));
	}
}

add_action('wp_enqueue_scripts', 'business_hub_load_owl_scripts');
