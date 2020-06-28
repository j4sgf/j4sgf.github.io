<?php
/**
 * The home content hook for our theme.
 *
 * This is the template that displays slider of the theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_Hub
 */

if ( ! function_exists( 'business_hub_home_content' ) ) :

  function business_hub_home_content(){  

    $theme_options  = business_hub_theme_options();

    if( is_home() || is_front_page() ){ ?>
      <div id="primary-home" class="content-area">
        <main id="main" class="site-main" role="main">
          <?php
          do_action( 'business_hub_services_content' );
          do_action( 'business_hub_why_us_content' );
          do_action( 'business_hub_welcome_content' );
          do_action( 'business_hub_works_content' );
          do_action( 'business_hub_blogs_content' );
          ?>
        </main><!-- #main -->
      </div><!-- #primary -->
      <?php
    }

  }

endif;

add_action( 'business_hub_action_home_content', 'business_hub_home_content', 10 );

//For services section
if ( ! function_exists( 'business_hub_services_section' ) ) :

  function business_hub_services_section(){ 

    $theme_options  = business_hub_theme_options();

    $our_services   = $theme_options['our_services'];

    $read_more      = $theme_options['readmore_text'];

    if( !empty( $our_services ) ){ ?>

      <div  id="scroll"  class="our-services-wrapper">
        <div class="container">
          <section class="our-services">
            <header class="entry-header heading">
              <span class=""><?php esc_html_e('Explore', 'business-hub'); ?></span>
              <h2 class="entry-title"><?php echo get_the_category_by_ID( absint( $our_services ) ); ?> <span class="view-more"><a href="<?php echo get_category_link( absint( $our_services ) ); ?>"><?php esc_html_e('View More', 'business-hub'); ?></a></span></h2>
            </header>
            <div class="services">
              <div class="row">
                <?php
                $services_args = array( 
                                  'cat'             => absint( $our_services ), 
                                  'post_status'     => 'publish', 
                                  'posts_per_page'  => absint( $theme_options['our_service_number'] ),
                                );

                $services_query = new WP_Query( $services_args ); 

                if ( $services_query->have_posts() ) :

                  $services_count= 1;

                  while ( $services_query->have_posts() ) : $services_query->the_post(); ?>
                    <div class="col col-1-of-3">
                      <div class="row">
                        <div class="col col-1-of-3">
                          <div class="big-number">
                            <?php echo sprintf( "%02d", absint($services_count) ); ?>
                          </div>
                        </div><!-- .col -->

                        <div class="col col-2-of-3">
                          <header class="entry-header">
                          <h4 class="entry-header"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                          </header>
                          <p><?php echo esc_html( business_hub_limit_words( get_the_excerpt(), 20 ) ); ?>  </p>
                          <p class="with_label"><a class="btn-services" href="<?php the_permalink(); ?> "><?php echo esc_html( $read_more ); ?> <i class="fa fa-angle-right"></i></a></p>
                        </div><!-- .col -->
                      </div><!-- .row -->
                    </div><!-- .col -->
                    <?php 

                    $services_count++;

                  endwhile;

                  wp_reset_postdata();

                endif; ?>

              </div><!-- .row -->
            </div><!-- .services -->
          </section><!-- .our-services -->
        </div><!-- .container -->
      </div><!-- .our-services-wrapper -->

    <?php
    }

  }

endif;

add_action( 'business_hub_services_content', 'business_hub_services_section', 10 );

//For Why Choose Us Section
if ( ! function_exists( 'business_hub_why_us_section' ) ) :

  function business_hub_why_us_section(){ 

    $theme_options  = business_hub_theme_options(); 

    $why_us         = $theme_options['why_us'];

    if( !empty( $why_us )){ 

      $why_args = array( 
                        'p'             => absint( $why_us ), 
                        'post_status'     => 'publish'
                      );

      $why_query = new WP_Query( $why_args ); 

      if ( $why_query->have_posts() ) :

         while ( $why_query->have_posts() ) : $why_query->the_post(); ?>
          <section class="why-us">
            <div class="half-part">
                <?php 
                if ( has_post_thumbnail() ) {

                    the_post_thumbnail(); 

                } ?>
            </div> <!-- .half-part -->
            <div class="half-part">
                <header class="entry-header heading heading-with-border">
                    <h2 class="entry-title"><?php the_title(); ?></h2>
                </header>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </div> <!-- .half-part -->
          </section><!-- .why-us -->
          <?php 
        endwhile;

        wp_reset_postdata();

      endif;
    }

  }
endif;

add_action( 'business_hub_why_us_content', 'business_hub_why_us_section', 10 );

//For Welcome Section
if ( ! function_exists( 'business_hub_welcome_section' ) ) :

  function business_hub_welcome_section(){ 

    $theme_options  = business_hub_theme_options(); 

    $about          = $theme_options['about'];

    $read_more      = $theme_options['readmore_text'];

    if( !empty( $about )){ 

      $about_args = array( 
                        'p'               => absint( $about ), 
                        'post_status'     => 'publish'
                      );

      $about_query = new WP_Query( $about_args ); 

      if ( $about_query->have_posts() ) :

        while ( $about_query->have_posts() ) : $about_query->the_post(); ?>

          <section class="about-us">
              <div class="left-part">
                  <header class="entry-header heading heading-with-border">
                      <h2 class="entry-title"><?php the_title(); ?></h2>
                  </header>

                  <div class="entry-content">
                      <p><?php echo esc_html( business_hub_limit_words( get_the_content(), 80 ) ); ?>  </p>
                      <a class="btn-business" href="<?php the_permalink(); ?> "><?php echo esc_html( $read_more ); ?> <i class="fa fa-angle-right"></i></a>
                  </div>
              </div> <!-- .about-us-part -->

              <div class="right-part">
                <?php 
                if ( has_post_thumbnail() ) {

                  the_post_thumbnail(); 

                } ?>
              </div> <!-- .about-us-part -->
          </section><!-- .about-us -->
          <?php

        endwhile;

        wp_reset_postdata();

      endif;
    }

  }

endif;

add_action( 'business_hub_welcome_content', 'business_hub_welcome_section', 10 );

//For Our Works Section
if ( ! function_exists( 'business_hub_works_section' ) ) :

  function business_hub_works_section(){ 

    $theme_options  = business_hub_theme_options();

    $our_works      = $theme_options['our_works'];

    if( !empty( $our_works ) ){ ?>

      <section class="our-works">
          <div class="container">
              <div class="row">
                  <div class="col col-1-of-1">
                      <header class="entry-header heading">
                          <span class=""><?php esc_html_e('Explore', 'business-hub'); ?></span>
                          <h2 class="entry-title"><?php echo get_the_category_by_ID( absint( $our_works ) ); ?> <span class="view-more"><a href="<?php echo get_category_link( absint( $our_works ) ); ?>"><?php esc_html_e('View More', 'business-hub'); ?></a></span></h2>
                      </header>
                  </div> <!-- .col -->
              </div><!-- .row -->
          </div><!-- .container -->
          <?php 
          $work_args = array( 
                            'cat'             => absint( $our_works ), 
                            'post_status'     => 'publish', 
                            'posts_per_page'  => -1 
                          );

          $work_query = new WP_Query( $work_args ); 

          if ( $work_query->have_posts() ) : ?>
            <div class="works-item">
                <div class="row">
                  <?php while ( $work_query->have_posts() ) : $work_query->the_post(); ?>
                    <div class="col col-1-of-4">
                        <div class="hovereffect">
                          <?php 
                          if ( has_post_thumbnail() ) { 

                            the_post_thumbnail('business-hub-work');

                          } ?>
                          <div class="overlay">
                              <div class="v-center">
                                  <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                  <p> 
                                  <i class="fa fa-folder-open-o"></i> <?php echo get_the_category_list( __( ', ', 'business-hub' ) ); ?>
                                  </p>                                       
                              </div><!-- .v-center -->
                          </div><!-- .overlay -->
                        </div><!-- .hovereffect -->                    
                    </div><!-- .col -->
                  <?php endwhile; 
                  wp_reset_postdata(); ?>                    
                </div><!-- .row -->
            </div><!-- .works-item -->
          <?php endif; ?>
      </section><!-- .our-works -->

    <?php
    }

  }

endif;

add_action( 'business_hub_works_content', 'business_hub_works_section', 10 );

//For Our Blogs Section
if ( ! function_exists( 'business_hub_blogs_section' ) ) :

  function business_hub_blogs_section(){ 
    $theme_options  = business_hub_theme_options();

    $our_blogs      = $theme_options['our_blogs'];

    $read_more      = $theme_options['readmore_text'];

    if( !empty( $our_blogs ) ){ ?>  
      <section class="blog-news">
          <div class="container">
              <div class="row">
                  <div class="col col-1-of-1">
                    <header class="entry-header heading">
                      <span class=""><?php esc_html_e('Explore', 'business-hub'); ?></span>
                      <h2 class="entry-title"><?php echo get_the_category_by_ID( absint( $our_blogs ) ); ?> <span class="view-more"><a href="<?php echo get_category_link( absint( $our_blogs ) ); ?>"><?php esc_html_e('View More', 'business-hub'); ?></a></span></h2>
                    </header>
                  </div><!-- .col -->
                  <?php
                  $blog_args = array( 
                                  'cat'             => absint( $our_blogs ), 
                                  'post_status'     => 'publish', 
                                  'posts_per_page'  => 4 
                                );

                  $blog_query = new WP_Query( $blog_args ); 

                  if ( $blog_query->have_posts() ) : 
                    while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
                      <div class="col col-1-of-2">
                        <?php $blog_class = ( has_post_thumbnail() ) ? 'blog-post' : 'blog-post no-image'; ?>
                          <article class="<?php echo $blog_class; ?>">
                              <div class="entry-thumbnail">
                                  <?php 
                                  if ( has_post_thumbnail() ) {

                                      the_post_thumbnail('business-hub-blog'); 

                                  }?>
                                  <div class="thumbhover">
                                      <a href="<?php the_permalink(); ?>" class="more-link btn-business v-center"><?php echo esc_html( $read_more ); ?></a>
                                  </div>
                              </div><!-- .entry-thumbnail -->

                              <div class="blog-content">
                                  <header class="entry-header">
                                      <div class="entry-meta">
                                        <?php business_hub_posted_on(); ?>
                                      </div>
                                      <h3 class="entry-title"><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h3>
                                  </header><!-- .entry-header -->

                                  <div class="entry-content">
                                    <p>
                                      <?php echo esc_html( business_hub_limit_words( get_the_excerpt(), 15) ); ?>         
                                    </p>
                                  </div>
                              </div><!-- .blog-content -->
                          </article><!-- .blog-post -->
                      </div> <!-- .col -->
                    <?php 
                    endwhile;
                    wp_reset_postdata();
                  endif; ?>

                  
                  
              </div><!-- .row -->
          </div><!-- .container -->
      </section><!-- .blog-news -->
  <?php
    }
  }

endif;

add_action( 'business_hub_blogs_content', 'business_hub_blogs_section', 10 );
