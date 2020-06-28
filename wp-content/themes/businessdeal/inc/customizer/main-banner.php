<?php
/**
 * BusinessDeal Main Banner
 *
 * @package businessdeal
 */

/**
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

$wp_customize->add_setting( 'select_main_banner_category', array(
    'default' => '',
    'sanitize_callback' => 'businessdeal_sanitize_select',
));
$wp_customize->add_control( 'select_main_banner_category', array(
    'priority'=>10,
    'label' => esc_html__('Select Main Banner', 'businessdeal'),
    'section' => 'businessdeal_main_banner_section',
    'type' => 'select',
    'choices'   =>  businessdeal_cat_list()
));

$wp_customize->add_setting( 'disable-link', array(
    'default' => 0,
    'sanitize_callback' => 'businessdeal_sanitize_checkbox',
));
$wp_customize->add_control( new Businessdeal_Control_Toggle( 
    $wp_customize,'disable-link', 
    array(
            'priority'=>20,
            'label' => esc_html__('Remove link from Title and Image', 'businessdeal'),
            'section' => 'businessdeal_main_banner_section',
            'type'        => 'ios',
        )
    )
);