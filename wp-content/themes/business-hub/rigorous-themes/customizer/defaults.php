<?php
/**
 *  Default theme options
 */
if ( !function_exists('business_hub_default_options') ) :

    function business_hub_default_options() {

        $default_options = array(
            'site_identity'                 => 'title-text',         
            'sticky_header'                 => 1,
            'top_bar'                       => 1,
            'top_bar_left'                  => 'social-icons',
            'top_bar_right'                 => 'search-form',
            'right_social'                  => 1,
            'right_hours'                   => 1,
            'top_address'                   => '', 
            'top_telephone'                 => '',
            'top_email'                     => '',
            'top_hours'                     => '',
            'slider_enable'                 => 0,
            'slider_excerpt_enable'         => 1,
            'read_more_enable'              => 1,
            'main_slider_type'              => 'slider',
            'slider_cat'                    => '',
            'slider_number'                 => 5,
            'slider_transition_delay'       => 3,
            'slider_transition_duration'    => 3,
            'banner_image'                  => '',
            'quote_enable'                  => 0,
            'quote_btn'                     =>  __('Get A Quote', 'business-hub'),
            'home_content'                  => 1,
            'our_services'                  => '',
            'our_service_number'            => 9,
            'why_us'                        => '',
            'about'                         => '',
            'our_works'                     => '',
            'our_blogs'                     => '',   
            'sidebar'                       => 'right',
            'hide_meta'                     => 0,
            'readmore_text'                 =>  __( 'Read More', 'business-hub' ), 
            'excerpt_length'                => 40,                    
            'copyright'                     => __('Copyright 2016. All rights reserved', 'business-hub'),      
            'scroll_top'                    => 0,

        );

        return apply_filters( 'business_hub_defaults', $default_options );

    }

endif;


/**
*  Get theme options
*/
if ( !function_exists('business_hub_theme_options') ) :

    function business_hub_theme_options() {

        $business_hub_defaults = business_hub_default_options();

        $business_hub_option_values = get_theme_mod( 'business_hub');

        if( is_array($business_hub_option_values )){

            return array_merge( $business_hub_defaults ,$business_hub_option_values );

        }
        else{

            return $business_hub_defaults;

        }

    }
endif;