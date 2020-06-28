<?php
/**
 * Theme Functions which enhance the theme by hooking into WordPress
 *
 * @package businessdeal
 */


// Navigation Top
function businessdeal_navigation_top(){ ?>
    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
        <span class="toggle-text"><?php esc_html_e('Menu','businessdeal'); ?></span>
        <span class="toggle-bar"></span>
    </button>

    <?php
    wp_nav_menu( array(
        'container' =>'',
        'theme_location' => 'menu-1',
        'menu_id'        => 'primary-menu',
        'items_wrap'      => '<ul id="primary-menu" class="menu nav-menu">%3$s</ul>',
    ) );
}

add_action('businessdeal_frontend_navigation_top','businessdeal_navigation_top');

// Navigation Secondary
function businessdeal_secondary_navigation(){ ?>
   <nav class="secondary-navigation" role="navigation" aria-label="<?php esc_attr_e('Secondary Navigation','businessdeal'); ?>">
        <button class="secondary-menu-toggle" aria-controls="primary-menu" aria-expanded="false">
            <span class="secondary-toggle-text"><?php esc_html_e('Menu','businessdeal'); ?></span>
            <span class="secondary-toggle-bar"></span>
        </button>
        <?php
        wp_nav_menu( array(
            'container' =>'',
            'theme_location' => 'menu-3',
            'menu_id'        => 'primary-menu',
            'items_wrap'      => '<ul id="primary-menu" class="secondary-menu">%3$s</ul>',
        ) ); ?>
    </nav><!-- .secondary-navigation -->       
<?php }

add_action('businessdeal_frontend_secondary_navigation','businessdeal_secondary_navigation');

// Search Form 
function businessdeal_search_form(){
    $search_text = get_theme_mod('search_text',esc_html__('Search','businessdeal')); ?>
    <div class="search-container-wrap">
        <div class="search-container">
            <form role="search" method="get" class="search" action="<?php echo esc_url( home_url( '/' ) ); ?>"  role="search"> 
                <label for='s' class='screen-reader-text'><?php esc_html_e( 'Search', 'businessdeal' ); ?></label> 
                    <input class="search-field" placeholder="<?php echo esc_attr($search_text).'&hellip;'; ?>" name="s" type="search"> 
                    <input class="search-submit" value="<?php echo esc_attr($search_text); ?>" type="submit">
            </form>
        </div><!-- .search-container -->
    </div><!-- .search-container-wrap -->
    
<?php }
add_action('businessdeal_frontend_search_form','businessdeal_search_form');

// Social Navigation
function businessdeal_social_navigation(){ ?>
    <nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e('Social Navigation','businessdeal'); ?>">
        <?php
       
            wp_nav_menu( array(
                'container' =>'',
                'theme_location' => 'menu-2',
                'menu_id'        => 'primary-menu',
                'items_wrap'      => '<ul class="social-links-menu">%3$s</ul>',
                'link_before'    => '<span class="screen-reader-text">',
                'link_after'     => '</span>',
            ) );
        ?>
    </nav><!-- .social-navigation -->

<?php }

add_action('businessdeal_frontend_social_navigation','businessdeal_social_navigation');

// Site Branding
function businessdeal_site_branding(){ ?>
    <div class="site-branding">
        <?php the_custom_logo(); ?>
        <div class="site-branding-text">

            <?php if ( is_front_page() && is_home() ) : ?>
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <?php
            else :
                ?>
                <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                <?php
            endif;
            $businessdeal_description = get_bloginfo( 'description', 'display' );
            if ( $businessdeal_description || is_customize_preview() ) :
                ?>
                <p class="site-description"><?php echo $businessdeal_description; /* WPCS: xss ok. */ ?></p>
            <?php endif; ?>

        </div><!-- .site-branding-text -->
    </div><!-- .site-branding -->

<?php }

add_action('businessdeal_frontend_site_branding','businessdeal_site_branding');

// Main Banner
function businessdeal_main_banner(){
$disable_main_banner = get_theme_mod('disable_main_banner',0);
$select_main_banner_category = get_theme_mod('select_main_banner_category','');
$no_of_main_banner = get_theme_mod('no_of_main_banner','3');
$slider_options = get_theme_mod('slider-options','main-banner');
$excerpt_text = get_theme_mod('excerpt_text',esc_html__('Read More','businessdeal'));
$excerpt_display = get_theme_mod('excerpt-display','excerpt-content');
$disable_link = get_theme_mod('disable-link',0);
$query = new WP_Query(array(
    'posts_per_page' =>  absint($no_of_main_banner),
    'post_type' => array( 'post' ) ,
    'category_name' => esc_attr($select_main_banner_category),
));
if(!is_paged()){
    if($disable_main_banner==0){
        if($select_main_banner_category!='' || $slider_options !='main-banner'){ ?>
        <div class="main-banner">
            <div class="banner-wrap">
                <div class="banner-list">
                    <?php 
                    if($slider_options == 'metaslider' || $slider_options == 'smartslider' || $slider_options == 'masterslider'){
                        do_action('businessdeal_frontend_plugins_slider');
                    } else {
                        while ($query->have_posts()):$query->the_post();  ?>
                            <div class="slide">
                                <div class="slide-content">
                                    <?php if(has_post_thumbnail()){ ?>
                                        <div class="slide-thumb">
                                            <?php if ($disable_link ==0){ ?>
                                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <?php the_post_thumbnail(); ?></a>
                                            <?php } else {
                                                the_post_thumbnail();
                                            } ?>
                                        </div><!-- .slide-thumb -->
                                    <?php } ?>
                                    <div class="slide-text-wrap">
                                        <div class="slide-text-content">
                                             <?php if ($disable_link ==0){ ?>
                                                <h2 class="slide-title"><a href="<?php the_permalink(); ?>" alt="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                                            <?php } else { ?>
                                                <h2 class="slide-title"><?php the_title(); ?></h2>
                                            <?php } ?>
                                            <div class="slide-text">
                                                <?php 
                                                    if($excerpt_display == 'full-content'){
                                                        the_content( sprintf(
                                                        wp_kses(
                                                            /* translators: %s: Name of current post. Only visible to screen readers */
                                                            $excerpt_text. '<span class="screen-reader-text"> "%s"</span>',
                                                            array(
                                                                'span' => array(
                                                                    'class' => array(),
                                                                ),
                                                            )
                                                        ),
                                                        get_the_title()
                                                    ) );
                                                    } else {
                                                        the_excerpt();
                                                    } ?>
                                            </div><!-- .slider-text -->
                                       
                                        </div><!-- .slide-text-content -->
                                    </div><!-- .slide-text-wrap -->
                                </div><!-- .slide-content -->
                            </div><!-- .slide -->
                        <?php endwhile;
                        wp_reset_postdata();
                    } ?>
                </div><!-- .banner-list -->
            </div><!-- .banner-wrap -->
        </div><!-- .main-banner -->
        <?php }
    }
} ?>

<?php }

add_action('businessdeal_frontend_main_banner','businessdeal_main_banner');

function businessdeal_header_image(){ ?>
    <div class="custom-header">
        <div class="custom-header-media">
            <?php the_custom_header_markup(); ?>
        </div><!-- .custom-header-media -->
    </div><!-- .custom-header -->
<?php
}

add_action('businessdeal_frontend_header_image','businessdeal_header_image');

// Main Banner with hook
function businessdeal_banner_display_type(){
    $disable_main_banner = get_theme_mod('disable_main_banner',0); 
       if($disable_main_banner ==0 ) {

            /**
            * Main Banner
            */

            if ( is_front_page() && is_home() ) {

                // Default homepage
                do_action('businessdeal_frontend_main_banner');

            } elseif ( is_front_page()){

                //Static homepage
                // Default homepage
                do_action('businessdeal_frontend_main_banner');

            }elseif (is_page_template( 'template/businessdeal-template.php' )) {

               // Default homepage
                do_action('businessdeal_frontend_main_banner');
                
            }
        }
}

add_action('businessdeal_frontend_banner_display_type','businessdeal_banner_display_type');

// Add Icons after link in tag list
add_filter('the_tags', 'businessdeal_addicons_after_link_tag_list');

function businessdeal_addicons_after_link_tag_list($list) {
    $list = str_replace('rel="tag">', 'rel="tag"><i class="fas fa-hashtag"></i>', $list);
    return $list;
}