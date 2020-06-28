<?php
/**
 * BusinessDeal Excerpt Display
 *
 * @package businessdeal
 */

/**
 * Displays custom theme posts in frontpage. 
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

	$wp_customize->add_section( 'excerpt-settings', array(
		'priority' => 100,
		'capability' => 'edit_theme_options',
		'title' => esc_html__( 'Excerpt Settings', 'businessdeal' ),
		'panel' => 'businessdeal_options_panel',
	) );

	$wp_customize->add_setting( 'excerpt-display', array(
		'default' => 'excerpt-content',
		'sanitize_callback' => 'businessdeal_sanitize_select',
		));
	$wp_customize->add_control( 'excerpt-display', array(
		'priority'=>10,
		'label' => esc_html__('Post Excerpt Content', 'businessdeal'),
		'section' => 'excerpt-settings',
		'type' => 'radio',
		'choices' => array(
		'full-content' => esc_html__( 'Full Content','businessdeal' ),
		'excerpt-content' => esc_html__( 'Excerpt Content','businessdeal' ),
		),
	));