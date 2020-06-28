<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Business_Hub
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses business_hub_header_style()
 */
function business_hub_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'business_hub_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'business_hub_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'business_hub_custom_header_setup' );
