<?php
/**
 * The common hook for our theme.
 *
 * This is the template that displays slider of the theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_Hub
 */

if ( ! function_exists( 'business_hub_before_container' ) ) :

    function business_hub_before_container(){ ?>

        <div id="content" class="site-content">
        <div class="container">
        <div class="row">
        <?php
    }

endif;

add_action( 'business_hub_action_before_container', 'business_hub_before_container', 10 );

if ( ! function_exists( 'business_hub_after_container' ) ) :

    function business_hub_after_container(){ ?>
        </div><!-- .row -->
        </div><!-- .container -->
        </div><!-- #content -->
    <?php 
    }

endif;

add_action( 'business_hub_action_after_container', 'business_hub_after_container', 10 );

//Check if page content is enable or not in home page
if ( ! function_exists( 'business_hub_home_page_content_check' ) ) :
    
    function business_hub_home_page_content_check( $status ) {

        if ( is_front_page() || is_home() ) {

            $theme_options = business_hub_theme_options();

            $home_content = $theme_options['home_content'];

            if ( 0 === $home_content || empty( $home_content ) ) {

                $status = false;

            }
        }

        return $status;

    }

endif;

add_filter( 'business_hub_home_content_status', 'business_hub_home_page_content_check' );

