<?php
/**
 * The top bar hook for our theme.
 *
 * This is the template that displays top header of the theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_Hub
 */

if ( ! function_exists( 'business_hub_top_header_bar' ) ) :

    function business_hub_top_header_bar(){

        $theme_options  = business_hub_theme_options();         

        if( 1 === $theme_options['top_bar'] ){ ?> 

            <div class="top-bar">
                <div class="container">
                    <div class="row">                    
                        <div class="col col-1-of-2 top-left">
                            <?php if( 'menu' == $theme_options['top_bar_left'] ){ ?>

                                <nav class="top-navigation">
                                    <?php wp_nav_menu( array( 'theme_location' => 'top-bar', 'fallback_cb' => 'business_hub_menu_fallback', 'container'=> false, 'depth' => 1 ) ); ?>                     
                                </nav><!-- .main-navigation -->

                            <?php } ?>                            

                           <?php 
                           if( 'social-icons' == $theme_options['top_bar_left'] ){ 

                                if ( has_nav_menu( 'social' ) ) : ?>
                                    <div class="social-links">
                                        <?php
                                            wp_nav_menu( array(
                                                'theme_location' => 'social',
                                                'menu_class'     => 'social-links-menu',
                                                'depth'          => 1,
                                                'link_before'    => '<span class="screen-reader-text">',
                                                'link_after'     => '</span>',
                                            ) );
                                        ?>
                                    </div><!-- .social-links -->
                                <?php endif; 

                           } ?>

                        </div><!--.col -->

                        <div class="col col-1-of-2 top-right">

                             <?php if( 'menu' == $theme_options['top_bar_right'] ){ ?>

                                 <nav class="top-navigation">
                                     <?php wp_nav_menu( array( 'theme_location' => 'top-bar', 'fallback_cb' => 'business_hub_menu_fallback', 'container'=> false, 'depth' => 1 ) ); ?>                     
                                 </nav><!-- .main-navigation -->

                             <?php } ?>

                             <?php if( !empty( $theme_options['top_hours']) && ( 1 === $theme_options['right_hours'] ) ){ ?>

                                 <div class="information">          
                                     <div class="open-time"><span><i class="fa fa-clock-o"></i> <?php echo esc_html( $theme_options['top_hours'] ); ?></span></div>
                                 </div><!-- .informational -->

                             <?php } ?>

                            <?php 
                            if( 1 === $theme_options['right_social'] ){ 
                                
                                if ( has_nav_menu( 'social' ) ) : ?>
                                    <div class="social-links">
                                        <?php
                                            wp_nav_menu( array(
                                                'theme_location' => 'social',
                                                'menu_class'     => 'social-links-menu',
                                                'depth'          => 1,
                                                'link_before'    => '<span class="screen-reader-text">',
                                                'link_after'     => '</span>',
                                            ) );
                                        ?>
                                    </div><!-- .social-links -->
                                <?php endif; 

                            } ?>

                            <?php
                            if( 'search-form' == $theme_options['top_bar_right'] ){   

                                get_search_form();
                                
                            } ?>
                        </div><!--.col -->
                    </div> <!-- .row -->
                </div> <!-- .container -->
            </div> <!-- .top-bar -->

        <?php }
    }

endif;

add_action( 'business_hub_top_header', 'business_hub_top_header_bar', 10 );