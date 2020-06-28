<?php
 /**
 * Register Sidebar area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * @package businessdeal
 */
function businessdeal_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'businessdeal' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'businessdeal' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Advertise Area', 'businessdeal' ),
		'id'            => 'advertise-area',
		'description'   => esc_html__( 'This section will appear above the Header Section', 'businessdeal' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'BusinessDeal Template Main Section', 'businessdeal' ),
		'id'            => 'businessdeal-template-main',
		'description'   => esc_html__( 'This section will appear when BusinessDeal Template is selected at Main Section', 'businessdeal' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_widget( 'BusinessDeal_posts' );
	register_widget( 'BusinessDeal_welcome' );
	register_widget( 'BusinessDeal_brandstory' );
	register_widget( 'BusinessDeal_service' );
	register_widget( 'BusinessDeal_personal_section' );
	register_widget( 'BusinessDeal_call_to_action' );
	register_widget( 'BusinessDeal_testimonial_slide' );
	register_widget( 'BusinessDeal_blog_grid_category_posts' );
}
add_action( 'widgets_init', 'businessdeal_widgets_init' );