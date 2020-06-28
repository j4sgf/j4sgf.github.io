<?php
/**
 * The powerby hook for our theme.
 *
 * This is the template that displays powerby text of the theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_Hub
 */

if ( ! function_exists( 'business_hub_powerby' ) ) :

    function business_hub_powerby(){

    $theme_options  = business_hub_theme_options();      
   
    ?> 

    <div id="copyright">
        <p><?php echo esc_html( $theme_options['copyright'] ); ?>. <?php sprintf( esc_html__( 'Theme: %1$s by %2$s.', 'business-hub' ), 'Business Hub', '<a href="'.esc_url( 'https://rigorousthemes.com/' ).'" rel="designer" target="_blank">Rigorous Themes</a>' ); ?></p>
    </div>
        

    <?php }

endif;

add_action( 'business_hub_copyright', 'business_hub_powerby', 10 );