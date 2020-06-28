<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package businessdeal
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function businessdeal_body_classes( $classes ) {
    $select_layout = get_theme_mod('select-layout','right');

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    //left sidebar
    if($select_layout=='left'){
        $classes[] = 'left-sidebar';

    }

    // Add class if sidebar is used.
    if ( is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'has-sidebar';
    }

	return $classes;
}
add_filter( 'body_class', 'businessdeal_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function businessdeal_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'businessdeal_pingback_header' );

// Default Category Lists for Dropdown

if( !function_exists( 'businessdeal_cat_list' ) ):
    function businessdeal_cat_list() {
        $businessdeal_args = array(
            'type'       => 'post',
            'taxonomy'   => 'category',
        );
        $businessdeal_cat_lists = get_categories( $businessdeal_args );
        $businessdeal_cat_list = array('' => esc_html__('--Select--','businessdeal'));
        foreach( $businessdeal_cat_lists as $category ) {
            $businessdeal_cat_list[esc_attr( $category->slug )] = esc_html( $category->name );
        }
        return $businessdeal_cat_list;
    }
endif;

//front page category list

if( !function_exists( 'businessdeal_frontpage_cat_list' ) ):
    function businessdeal_frontpage_cat_list() {
        $businessdeal_args = array(
            'type'       => 'post',
            'taxonomy'   => 'category',
        );
        $businessdeal_frontpage_cat_lists = get_categories( $businessdeal_args );
        foreach( $businessdeal_frontpage_cat_lists as $category ) {
            $businessdeal_frontpage_cat_list[esc_attr( $category->term_id )] = esc_html( $category->name );
        }
        return $businessdeal_frontpage_cat_list;
    }
endif;

//Exclude posts from home page

function businessdeal_exclude_homepage($query) {
    $front_page_categories = get_theme_mod('front_page_categories','');
    if ( is_array( $front_page_categories ) && !in_array( 0, $front_page_categories ) ) {
        if ( $query->is_home() && $query->is_main_query() ) {
            $query->query_vars['category__in'] = $front_page_categories;
        }
    }
}
add_action('pre_get_posts', 'businessdeal_exclude_homepage');

