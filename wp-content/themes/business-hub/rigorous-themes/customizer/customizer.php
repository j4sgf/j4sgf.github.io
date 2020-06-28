<?php
/**
 * Business Hub Theme Customizer.
 *
 * @package Business_Hub
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function business_hub_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'business_hub_customize_register' );

function business_hub_customizer( $wp_customize ) {

	$wp_customize->add_setting(
		'business_hub[site_identity]', 
		array(
			'default' 			=> 'title-text',
			'sanitize_callback' => 'business_hub_sanitize_select'
		)
	);

	$wp_customize->add_control(
		'business_hub[site_identity]', 
		array(
			'type' 		=> 'radio',
			'label' 	=> __('Show', 'business-hub'),
			'section' 	=> 'title_tagline',
			'choices' 	=> array(
								'logo-only' 	=> __('Logo Only', 'business-hub'),
								'logo-text' 	=> __('Logo + Tagline', 'business-hub'),
								'title-only' 	=> __('Title Only', 'business-hub'),
								'title-text' 	=> __('Title + Tagline', 'business-hub')
							)
		)
	);

	// Option Panel Starts
	$wp_customize->add_panel(
		'basic_panel', 
		array(
			'title'				=> __('Theme Options', 'business-hub'),
			'priority' 			=> 50,			
			'description' 	 	=> __('Option to change general settings', 'business-hub') 
		)
	);

	// Header Setting Section starts
	$wp_customize->add_section(
		'business_hub_header', 
		array(    
			'title'       => __('Header', 'business-hub'),
			'panel'       => 'basic_panel'    
		)
	);	

	// Sticky header
	$wp_customize->add_setting(
		'business_hub[sticky_header]', 
		array(
			'default'           => 1,		
			'sanitize_callback' => 'business_hub_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		'business_hub[sticky_header]', 
		array(
			'label'       => __('Enable sticky header', 'business-hub'),
			'section'     => 'business_hub_header',   
			'settings'    => 'business_hub[sticky_header]',		
			'type'        => 'checkbox'
		)
	);

	// Show top bar in header
	$wp_customize->add_setting(
		'business_hub[top_bar]', 
		array(
			'default'           => 1,			
			'sanitize_callback' => 'business_hub_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		'business_hub[top_bar]', 
		array(
			'label'       => __('Show top header bar', 'business-hub'),
			'section'     => 'business_hub_header',   
			'settings'    => 'business_hub[top_bar]',		
			'type'        => 'checkbox'
		)
	);

	// Left part of top navigation
	$wp_customize->add_setting(
		'business_hub[top_bar_left]', 
		array(
			'default' 			=> 'social-icons',		
			'sanitize_callback' => 'business_hub_sanitize_select'
		));

	$wp_customize->add_control(
		'business_hub[top_bar_left]', 
		array(		
			'label' 	=> __('Top Bar Left Element', 'business-hub'),
			'section' 	=> 'business_hub_header',
			'settings'  => 'business_hub[top_bar_left]',
			'type' 		=> 'radio',
			'choices' 	=> array(
								'social-icons' 	=> __('Social Icons', 'business-hub'),
								'menu' 			=> __('Menu', 'business-hub'),						
							),
			'active_callback' 	=> 'business_hub_top_header_show',
		)
	);

	// Right part of top navigation
	$wp_customize->add_setting(
		'business_hub[top_bar_right]', 
		array(
			'default' 			=> 'search-form',		
			'sanitize_callback' => 'business_hub_sanitize_select'
		)
	);

	$wp_customize->add_control(
		'business_hub[top_bar_right]', 
		array(		
			'label' 	=> __('Top Bar Right Element', 'business-hub'),
			'section' 	=> 'business_hub_header',
			'settings'  => 'business_hub[top_bar_right]',
			'type' 		=> 'radio',
			'choices' 	=> array(								
								'menu' 			=> __('Menu', 'business-hub'),
								'search-form' 	=> __('Search Form', 'business-hub'),					
							),
			'active_callback' 	=> 'business_hub_top_header_show',
		)
	);

	// Enable Social Icons
	$wp_customize->add_setting(
		'business_hub[right_social]', 
		array(
			'default'           => 1,		
			'sanitize_callback' => 'business_hub_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		'business_hub[right_social]', 
		array(
			'label'       => __('Enable Social Icons on right top bar', 'business-hub'),
			'section'     => 'business_hub_header',   
			'settings'    => 'business_hub[right_social]',		
			'type'        => 'checkbox'
		)
	);
	// Enable Opening Hours
	$wp_customize->add_setting(
		'business_hub[right_hours]', 
		array(
			'default'           => 1,		
			'sanitize_callback' => 'business_hub_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		'business_hub[right_hours]', 
		array(
			'label'       => __('Enable Opening Hours on right top bar', 'business-hub'),
			'section'     => 'business_hub_header',   
			'settings'    => 'business_hub[right_hours]',		
			'type'        => 'checkbox'
		)
	);

	// Header Address
	$wp_customize->add_setting(
		'business_hub[top_address]', 
		array(
			'default'           =>  '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'business_hub[top_address]', 
		array(
			'label'       		=> __('Address', 'business-hub'),  
			'section'     		=> 'business_hub_header',  
			'settings'    		=> 'business_hub[top_address]',		
			'type'        		=> 'text',
			'active_callback' 	=> 'business_hub_top_header_show',
		)
	);

	// Header Telephone
	$wp_customize->add_setting(
		'business_hub[top_telephone]', 
		array(
			'default'           =>  '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'business_hub[top_telephone]', 
		array(
			'label'       		=> __('Telephone', 'business-hub'),  
			'section'     		=> 'business_hub_header',  
			'settings'    		=> 'business_hub[top_telephone]',		
			'type'        		=> 'text',
			'active_callback' 	=> 'business_hub_top_header_show',
		)
	);

	// Header Email
	$wp_customize->add_setting(
		'business_hub[top_email]', 
		array(
			'default'           =>  '',
			'sanitize_callback' => 'sanitize_email'
		)
	);

	$wp_customize->add_control(
		'business_hub[top_email]', 
		array(
			'label'       		=> __('Email', 'business-hub'),  
			'section'     		=> 'business_hub_header',  
			'settings'    		=> 'business_hub[top_email]',		
			'type'        		=> 'text',
			'active_callback' 	=> 'business_hub_top_header_show',
		)
	);

	// Header Opening Hours
	$wp_customize->add_setting(
		'business_hub[top_hours]', 
		array(
			'default'           =>  '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'business_hub[top_hours]', 
		array(
			'label'       		=> __('Opening Hours', 'business-hub'),  
			'section'     		=> 'business_hub_header',  
			'settings'    		=> 'business_hub[top_hours]',		
			'type'        		=> 'text',
			'active_callback' 	=> 'business_hub_top_header_show',
		)
	);

	// Slider Setting Section starts
	$wp_customize->add_section(
		'business_hub_slider', 
		array(    
			'title'       => __('Slider', 'business-hub'),
			'panel'       => 'basic_panel'    
		)
	);	  

	// Enable/Disable Slider
	$wp_customize->add_setting(
		'business_hub[slider_enable]', 
		array(
			'default'           => 0,		
			'sanitize_callback' => 'business_hub_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		'business_hub[slider_enable]', 
		array(
			'label'       => __('Enable Slider or Banner', 'business-hub'),
			'section'     => 'business_hub_slider',   
			'settings'    => 'business_hub[slider_enable]',		
			'type'        => 'checkbox'
		)
	);	

	// Show/Hide Date
	$wp_customize->add_setting(
		'business_hub[slider_excerpt_enable]', 
		array(
			'default'           => 1,		
			'sanitize_callback' => 'business_hub_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		'business_hub[slider_excerpt_enable]', 
		array(
			'label'       => __('Display Slider Excerpts', 'business-hub'),
			'section'     => 'business_hub_slider',   
			'settings'    => 'business_hub[slider_excerpt_enable]',		
			'type'        => 'checkbox'
		)
	);

	// Show/Hide Read More button
	$wp_customize->add_setting(
		'business_hub[read_more_enable]', 
		array(
			'default'           => 1,
			'sanitize_callback' => 'business_hub_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		'business_hub[read_more_enable]', 
		array(
			'label'       => __('Show Read More button', 'business-hub'),
			'section'     => 'business_hub_slider',   
			'settings'    => 'business_hub[read_more_enable]',		
			'type'        => 'checkbox'
		)
	);

	// Slider type
	$wp_customize->add_setting(
		'business_hub[main_slider_type]', 
		array(
			'default' 			=> 'slider',		
			'sanitize_callback' => 'business_hub_sanitize_select'
		)
	);

	$wp_customize->add_control(
		'business_hub[main_slider_type]', 
		array(		
			'label' 	=> __('Slider Type', 'business-hub'),
			'section' 	=> 'business_hub_slider',
			'settings'  => 'business_hub[main_slider_type]',
			'type' 		=> 'radio',
			'choices' 	=> array(
								'slider' 		=> __('Slider', 'business-hub'),
								'banner-image' 	=> __('Banner Image', 'business-hub'),				
							)
		)
	);	

	//Slider category
	$wp_customize->add_setting(
		'business_hub[slider_cat]', 
		array(
			'default'         => '',		
			'sanitize_callback' => 'business_hub_sanitize_number'
		)
	);

	$wp_customize->add_control(
		new Business_Hub_Customize_Category_Control(
			$wp_customize,
			'business_hub[slider_cat]',
			array(
				'label'       => __( 'Category for slider', 'business-hub' ),
				'description' => __( 'Posts of selected category will be used as slides', 'business-hub' ),
				'settings'    => 'business_hub[slider_cat]',
				'section'     => 'business_hub_slider', 
				'active_callback' 	=> 'business_hub_slider_type_category',        
			)
		)
	);

	// Slider Number.
	$wp_customize->add_setting( 'business_hub[slider_number]',
		array(
		'default'           => 5,
		'sanitize_callback' => 'business_hub_sanitize_number_range',
		)
	);

	$wp_customize->add_control( 'business_hub[slider_number]',
		array(
			'label'       		=> __( 'Number of Slider', 'business-hub' ),			
			'section'     		=> 'business_hub_slider',
			'type'        		=> 'number',
			'input_attrs' 		=> array( 'min' => 1, 'max' => 10, 'step' => 1, 'style' => 'width: 55px;' ),
			'active_callback' 	=> 'business_hub_slider_type_category',
		)
	);

	// Slider Transition Delay.
	$wp_customize->add_setting( 'business_hub[slider_transition_delay]',
		array(
		'default'           => 3,
		'sanitize_callback' => 'business_hub_sanitize_number_range',
		)
	);

	$wp_customize->add_control( 'business_hub[slider_transition_delay]',
		array(
			'label'       		=> __( 'Transition Delay', 'business-hub' ),
			'description' 		=> __( 'In second(s)', 'business-hub' ),
			'section'     		=> 'business_hub_slider',
			'type'        		=> 'number',
			'input_attrs' 		=> array( 'min' => 1, 'max' => 10, 'step' => 1, 'style' => 'width: 55px;' ),
			'active_callback' 	=> 'business_hub_slider_type_category',
		)
	);

	// Slider Transition Duration.
	$wp_customize->add_setting( 'business_hub[slider_transition_duration]',
		array(
		'default'           => 3,
		'sanitize_callback' => 'business_hub_sanitize_number_range',
		)
	);

	$wp_customize->add_control( 'business_hub[slider_transition_duration]',
		array(
		'label'       		=> __( 'Transition Duration', 'business-hub' ),
		'description' 		=> __( 'In second(s)', 'business-hub' ),
		'section'     		=> 'business_hub_slider',
		'type'        		=> 'number',
		'input_attrs' 		=> array( 'min' => 1, 'max' => 10, 'step' => 1, 'style' => 'width: 55px;' ),
		'active_callback' 	=> 'business_hub_slider_type_category',
		)
	);

	// Banner image
	$wp_customize->add_setting(
		'business_hub[banner_image]', 
		array(
			'default'           	=>  '',				
			'sanitize_callback'     => 'business_hub_sanitize_number',			
		)
	);	

	$wp_customize->add_control(
		'business_hub[banner_image]', 
		array(
			'label'       		=> __('Banner Image', 'business-hub'),   
			'description' 		=> __( 'Enter the ID of post to use as a banner image.', 'business-hub' ), 
			'settings'    		=> 'business_hub[banner_image]',
			'section'     		=> 'business_hub_slider',
			'type'        		=> 'text',
			'active_callback' 	=> 'business_hub_slider_type_banner', 			
		)
	);

	// Quote Setting Section starts
	$wp_customize->add_section(
		'business_hub_quote', 
		array(    
			'title'       => __('Get a Quote', 'business-hub'),
			'panel'       => 'basic_panel'    
		)
	);	  

	// Enable/Disable Quote
	$wp_customize->add_setting(
		'business_hub[quote_enable]', 
		array(
			'default'           => 0,		
			'sanitize_callback' => 'business_hub_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		'business_hub[quote_enable]', 
		array(
			'label'       => __('Enable Quote section', 'business-hub'),
			'section'     => 'business_hub_quote',   
			'settings'    => 'business_hub[quote_enable]',		
			'type'        => 'checkbox'
		)
	);

	// Select post for Quote
	$wp_customize->add_setting(
		'business_hub[get_a_quote]', 
		array(
			'default'           	=>  '',				
			'sanitize_callback'     => 'business_hub_sanitize_number',			
		)
	);	

	$wp_customize->add_control(
		'business_hub[get_a_quote]', 
		array(
			'label'       => __('Get A Quote', 'business-hub'),   
			'description' => __( 'Insert the post ID, to display the post title in Get A Quote section', 'business-hub' ), 
			'settings'    => 'business_hub[get_a_quote]',
			'section'     => 'business_hub_quote',
			'type'        => 'text',			
		)
	); 

	// Quote button text
	$wp_customize->add_setting(
		'business_hub[quote_btn]', 
		array(
			'default'           =>  __('Get A Quote', 'business-hub'),		
			'sanitize_callback' => 'sanitize_text_field'
		)
	);	

	$wp_customize->add_control(
		'business_hub[quote_btn]', 
		array(
			'label'       => __('Button Text', 'business-hub'),    
			'settings'    => 'business_hub[quote_btn]',
			'section'     => 'business_hub_quote',
			'type'        => 'text',			
		)
	);

	// Home Section starts
	$wp_customize->add_section(
		'business_hub_home', 
		array(    
			'title'       => __('Home Sections', 'business-hub'),
			'panel'       => 'basic_panel'    
		)
	);

	// Show Home Page content
	$wp_customize->add_setting(
		'business_hub[home_content]', 
		array(
			'default'           => 1,		
			'sanitize_callback' => 'business_hub_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		'business_hub[home_content]', 
		array(
			'label'       => __('Show Home Content', 'business-hub'),
			'description' => __( 'Check this to show page content in Home page.', 'business-hub' ),
			'section'     => 'business_hub_home',   
			'settings'    => 'business_hub[home_content]',		
			'type'        => 'checkbox'
		)
	);	  

	// Our Services
	$wp_customize->add_setting(
		'business_hub[our_services]', 
		array(
			'default'           => '',		
			'sanitize_callback' => 'business_hub_sanitize_number'
		)
	);	

	$wp_customize->add_control(
		new Business_Hub_Customize_Category_Control(
			$wp_customize,
			'business_hub[our_services]',
			array(
				'label'       => __( 'Our Services', 'business-hub' ),
				'description' => __( 'Leave blank if you do not wish to display this section.', 'business-hub' ),
				'settings'    => 'business_hub[our_services]',
				'section'     => 'business_hub_home', 				     
			)
		)
	); 

	// Our Service Number.
	$wp_customize->add_setting( 'business_hub[our_service_number]',
		array(
		'default'           => 9,
		'sanitize_callback' => 'business_hub_sanitize_number_range',
		)
	);

	$wp_customize->add_control( 'business_hub[our_service_number]',
		array(
			'label'       		=> __( 'Number for Our Service Section', 'business-hub' ),			
			'section'     		=> 'business_hub_home',
			'type'        		=> 'number',
			'input_attrs' 		=> array( 'min' => 1, 'max' => 20, 'step' => 1, 'style' => 'width: 55px;' ),
			
		)
	);

	// Why Choose Us
	$wp_customize->add_setting(
		'business_hub[why_us]', 
		array(
			'default'           	=>  '',				
			'sanitize_callback'     => 'business_hub_sanitize_number',			
		)
	);	

	$wp_customize->add_control(
		'business_hub[why_us]', 
		array(
			'label'       => __('Why Choose Us?', 'business-hub'),   
			'description' => __( 'Enter the ID of post to use in Why Choose Us section.', 'business-hub' ), 
			'settings'    => 'business_hub[why_us]',
			'section'     => 'business_hub_home',
			'type'        => 'text',			
		)
	);	

	// About Section
	$wp_customize->add_setting(
		'business_hub[about]', 
		array(
			'default'           	=>  '',				
			'sanitize_callback'     => 'business_hub_sanitize_number',			
		)
	);	

	$wp_customize->add_control(
		'business_hub[about]', 
		array(
			'label'       => __('About/Welcome Section', 'business-hub'),   
			'description' => __( 'Enter the ID of post to use in About(Welcome) section.', 'business-hub' ), 
			'settings'    => 'business_hub[about]',
			'section'     => 'business_hub_home',
			'type'        => 'text',			
		)
	);

	// Our Works
	$wp_customize->add_setting(
		'business_hub[our_works]', 
		array(
			'default'           => '',		
			'sanitize_callback' => 'business_hub_sanitize_number'
		)
	);	

	$wp_customize->add_control(
		new Business_Hub_Customize_Category_Control(
			$wp_customize,
			'business_hub[our_works]',
			array(
				'label'       => __( 'Our Works', 'business-hub' ),
				'description' => __( 'Leave blank if you do not wish to display this section.', 'business-hub' ),
				'settings'    => 'business_hub[our_works]',
				'section'     => 'business_hub_home', 				     
			)
		)
	);

	// Our Blogs
	$wp_customize->add_setting(
		'business_hub[our_blogs]', 
		array(
			'default'           => '',		
			'sanitize_callback' => 'business_hub_sanitize_number'
		)
	);	

	$wp_customize->add_control(
		new Business_Hub_Customize_Category_Control(
			$wp_customize,
			'business_hub[our_blogs]',
			array(
				'label'       => __( 'Our Blogs', 'business-hub' ),
				'description' => __( 'Leave blank if you do not wish to display this section.', 'business-hub' ),
				'settings'    => 'business_hub[our_blogs]',
				'section'     => 'business_hub_home', 				     
			)
		)
	);	

	// Post Options 
	$wp_customize->add_section(
		'business_hub_post_opt', 
		array(    
			'title'   	=> __('Post Options', 'business-hub' ),
			'panel'		=> 'basic_panel'    
		)
	);

	// Hide Meta Data
	$wp_customize->add_setting(
		'business_hub[hide_meta]', 
		array(
			'default'           => 0,		
			'sanitize_callback' => 'business_hub_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		'business_hub[hide_meta]', 
		array(
			'label'       => __('Check to hide meta data below title', 'business-hub'),
			'description' => __('Check this box to hide post meta data in post listing page', 'business-hub'),
			'section'     => 'business_hub_post_opt',   
			'settings'    => 'business_hub[hide_meta]',		
			'type'        => 'checkbox'
		)
	);

	// Read More Text Setting
	$wp_customize->add_setting(
		'business_hub[readmore_text]', 
		array(
			'default'           => __( 'Read More', 'business-hub' ),	
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'business_hub[readmore_text]', 
		array(
			'label'       => __('Read More Text', 'business-hub'),  
			'description' => __('Change text if you want to use other than "Read More"', 'business-hub'),   
			'settings'    => 'business_hub[readmore_text]',
			'section'     => 'business_hub_post_opt',
			'type'        => 'text'
		)
	);

	//Excerpt length
	$wp_customize->add_setting(
		'business_hub[excerpt_length]', 
		array(
			'default'           => 40,  		
			'sanitize_callback' => 'business_hub_sanitize_number'
		)
	);

	$wp_customize->add_control(
		'business_hub[excerpt_length]', 
		array(
			'label'       => __('Excerpt Length', 'business-hub'),  
			'description' => __('Change length of the words used in post', 'business-hub'),   
			'settings'    => 'business_hub[excerpt_length]',
			'section'     => 'business_hub_post_opt',
			'type'        => 'number'
		)
	);

	// Layout 
	$wp_customize->add_section(
		'business_hub_layout', 
		array(    
			'title'   	=> __('Layout', 'business-hub' ),
			'panel'		=> 'basic_panel'    
		)
	);

	$wp_customize->add_setting(
		'business_hub[sidebar]', 
		array(
			'default'           => 'right',		
			'sanitize_callback' => 'business_hub_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Business_Hub_Customize_Sidebar_Control(
			$wp_customize, 
			'business_hub[sidebar]', 
			array(
				'type' 		=> 'radio-image',
				'label' 	=> __('Sidebar', 'business-hub' ),
				'section' 	=> 'business_hub_layout',
				'settings' 	=> 'business_hub[sidebar]',
				'choices' 	=> array(
					'left' 	=> get_template_directory_uri() . '/rigorous-themes/customizer/images/left-sidebar.png',
					'right' => get_template_directory_uri() . '/rigorous-themes/customizer/images/right-sidebar.png',
					'no-sidebar' => get_template_directory_uri() . '/rigorous-themes/customizer/images/sidebar-no.png',
					)
			)
		)
	);

	// Footer Options 
	$wp_customize->add_section(
		'business_hub_footer', 
		array(    
			'title'       => __('Footer', 'business-hub' ),
			'panel'       => 'basic_panel'    
		)
	);		

	// Footer Copyright
	$wp_customize->add_setting(
		'business_hub[copyright]', 
		array(
		  'default'           =>  __('Copyright 2016. All rights reserved', 'business-hub'),  
		  'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'business_hub[copyright]', 
			array(
			'label'       => __('Copyright Text', 'business-hub'),    
			'settings'    => 'business_hub[copyright]',
			'section'     => 'business_hub_footer',
			'type'        => 'text'
		)
	);	

	// Enable/Disable scroll to top  
	$wp_customize->add_setting(
		'business_hub[scroll_top]', 
		array(
			'default'           => 0,	  
			'sanitize_callback' => 'business_hub_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		'business_hub[scroll_top]', 
		array(
			'label'       => __('Disable Scroll to Top', 'business-hub'),    
			'settings'    => 'business_hub[scroll_top]',
			'section'     => 'business_hub_footer',
			'type'        => 'checkbox'
		)
	);

}

add_action( 'customize_register', 'business_hub_customizer' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function business_hub_customize_preview_js() {
	wp_enqueue_script( 'business_hub_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'business_hub_customize_preview_js' );

