<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package businessdeal
 */

//Excerpt More
function businessdeal_excerpt_more( $link ) {
   $excerpt_text = get_theme_mod('excerpt_text',esc_html__('Read More','businessdeal'));
    if ( is_admin() ) {
        return $link;
    }

    $link = sprintf(
        '<span class="ml-btn"><a href="%1$s" class="more-link">%2$s</a></span>',
        esc_url( get_permalink( get_the_ID() ) ),
        /* translators: %s: Name of current post */
        sprintf( $excerpt_text, get_the_title( get_the_ID() ) )
    );
    return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'businessdeal_excerpt_more' );

//Excerpt length
function businessdeal_excerpt_length($length) {
    $excerpt_length = get_theme_mod('excerpt_length','25');
    if( is_admin() ){
        return absint($length);
    }

    $length = $excerpt_length;
    return absint($length);
}
add_filter('excerpt_length', 'businessdeal_excerpt_length');

// Site Info
function businessdeal_site_info(){ ?>
    <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'businessdeal' ) ); ?>">
<?php
/* translators: %s: CMS name, i.e. WordPress. */
printf( esc_html__( 'Proudly powered by %s', 'businessdeal' ), 'WordPress' );
?>
</a>
<span class="sep"> | </span>
<?php
/* translators: 1: Theme name, 2: Theme author. */
printf( esc_html__( 'Theme: %1$s By %2$s.', 'businessdeal' ), __('BusinessDeal <span class="sep"> | </span> ','businessdeal'),'<a href="'.esc_url('https://themespiral.com/') .'">' . esc_html__('ThemeSpiral.com','businessdeal').'</a>' );
}

add_action ('businessdeal_footer_copyright_frontend','businessdeal_site_info');

// Enequeue backend js file for widgets

if (!function_exists('businessdeal_backend_enqueue_widgets')) :
    function businessdeal_backend_enqueue_widgets($hook)
    {
        if ('widgets.php' != $hook) {
            return;
        }

        wp_register_script('businessdeal-custom-widgets', get_template_directory_uri() . '/inc/widgets/js/widgets.js', array('jquery'), true);
        wp_enqueue_script('businessdeal-custom-widgets');
        wp_enqueue_style( 'businessdeal-style-admin', get_template_directory_uri() . '/inc/widgets/css/widgets.css');
    }

    add_action('admin_enqueue_scripts', 'businessdeal_backend_enqueue_widgets');
endif;