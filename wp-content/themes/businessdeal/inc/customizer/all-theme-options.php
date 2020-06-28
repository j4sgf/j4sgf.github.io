<?php
/**
 * BusinessDeal All theme Options
 *
 * @package businessdeal
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

//Front Page Category (List of categories to hide from home page)

    $businessdeal_frontpage_cat_lists = businessdeal_frontpage_cat_list();

    $wp_customize->add_setting( 'front_page_categories', array(
        'default'           => '',
        'sanitize_callback' => 'businessdeal_sanitize_multi_checkbox'
    ) );

    $wp_customize->add_control(
        new BusinessDeal_Customize_Multiple_Checkboxes_Control(
            $wp_customize,
            'front_page_categories',
            array(
                'section' => 'businessdeal_all_theme_options',
                'label'   => esc_html__( 'Front/ Home page posts categories', 'businessdeal' ),
                'description' => esc_html__('Selected category display on front/ home page. If not selected, all post will be displayed','businessdeal'),
                'choices' => $businessdeal_frontpage_cat_lists,
                'priority'    => 10,
            )
        )
    );

    //  Blog Options
    $wp_customize->add_setting('main-title', array(
            'type'              => 'main-title-control',
            'sanitize_callback' => 'sanitize_text_field',            
        )
    );
    $wp_customize->add_control( new BusinessDeal_title_display( $wp_customize, 'businessdeal-100', array(
            'priority' => 100,
            'label' => esc_html__('Blog/ Single Options', 'businessdeal'),
            'section' => 'businessdeal_all_theme_options',
            'settings' => 'main-title',
        ) )
    );

    $wp_customize->add_setting( 'disable-author', array(
        'default' => 0,
        'sanitize_callback' => 'businessdeal_sanitize_checkbox',
    ));
   $wp_customize->add_control( new Businessdeal_Control_Toggle( 
        $wp_customize,'disable-author', 
        array(
                'priority'=>110,
                'label' => esc_html__('Hide Author', 'businessdeal'),
                'section' => 'businessdeal_all_theme_options',
                'type'        => 'ios',
            )
        )
    );

    $wp_customize->add_setting( 'disable-date', array(
        'default' => 0,
        'sanitize_callback' => 'businessdeal_sanitize_checkbox',
    ));
    $wp_customize->add_control( new Businessdeal_Control_Toggle( 
        $wp_customize,'disable-date', 
        array(
                'priority'=>120,
                'label' => esc_html__('Hide Date', 'businessdeal'),
                'section' => 'businessdeal_all_theme_options',
                'type'        => 'ios',
            )
        )
    );

    $wp_customize->add_setting( 'disable-category', array(
        'default' => 0,
        'sanitize_callback' => 'businessdeal_sanitize_checkbox',
    ));
    $wp_customize->add_control( new Businessdeal_Control_Toggle( 
        $wp_customize,'disable-category', 
        array(
                'priority'=>130,
                'label' => esc_html__('Hide Category', 'businessdeal'),
                'section' => 'businessdeal_all_theme_options',
                'type'        => 'ios',
            )
        )
    );

    $wp_customize->add_setting( 'disable-comments', array(
        'default' => 0,
        'sanitize_callback' => 'businessdeal_sanitize_checkbox',
    ));
    $wp_customize->add_control( new Businessdeal_Control_Toggle( 
        $wp_customize,'disable-comments', 
        array(
                'priority'=>140,
                'label' => esc_html__('Hide Comments', 'businessdeal'),
                'section' => 'businessdeal_all_theme_options',
                'settings'  => 'disable-comments',
                'type'        => 'ios',
            )
        )
    );

    //Select Theme Layout
    $wp_customize->add_setting( 'select-layout', array(
        'default' => 'right',
        'sanitize_callback' => 'businessdeal_sanitize_select',
    ));

    $wp_customize->add_control( new Businessdeal_Control_Radio_Image(
        $wp_customize, 'select-layout',
            array(
                    'priority'=>200,
                    'label' => esc_html__('Select Sidebar Layout', 'businessdeal'),
                    'section' => 'businessdeal_all_theme_options',
                    'choices' => array(
                        'right' => esc_url( get_template_directory_uri() ) . '/assets/images/right-sidebar.png',
                        'left' => esc_url( get_template_directory_uri() ) . '/assets/images/left-sidebar.png',
                ),
            )
        )
    );


    $wp_customize->add_setting( 'enable_sticky_menu', array(
        'default' => 1,
        'sanitize_callback' => 'businessdeal_sanitize_checkbox',
    ));
    $wp_customize->add_control( new Businessdeal_Control_Toggle( 
        $wp_customize,'enable_sticky_menu', 
        array(
                'priority'=>270,
                'label' => esc_html__('Enable Sticky Menu', 'businessdeal'),
                'section' => 'businessdeal_all_theme_options',
                'type'        => 'ios',
            )
        )
    );

    $wp_customize->add_setting( 'post-pagination', array(
        'default' => 'numeric',
        'sanitize_callback' => 'businessdeal_sanitize_select',
    ));
    $wp_customize->add_control( 'post-pagination', array(
        'priority'=>290,
        'label' => esc_html__('Post Pagination', 'businessdeal'),
        'section' => 'businessdeal_all_theme_options',
        'type' => 'radio',
        'choices' => array(
            'default' => esc_html__( 'Default','businessdeal' ),
            'numeric' => esc_html__( 'Numeric','businessdeal' ),
        ),
    ));
