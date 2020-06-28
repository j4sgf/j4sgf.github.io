<?php
/**
 * The slider hook for our theme.
 *
 * This is the template that displays slider of the theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_Hub
 */

if ( ! function_exists( 'business_hub_main_slider' ) ) :

  function business_hub_main_slider(){  

    $theme_options  = business_hub_theme_options();

    $readmore       = $theme_options['read_more_enable'];

    $read_more      = $theme_options['readmore_text'];

    $slider_excerpt = $theme_options['slider_excerpt_enable'];

    $slider_number  = $theme_options['slider_number'];

    if( 'slider' === $theme_options['main_slider_type'] && ( 1 === $theme_options['slider_enable']) ){ 
      
      if(!empty( $theme_options['slider_cat'] )){

        $slider_args = array( 
                        'cat'             => absint( $theme_options['slider_cat'] ), 
                        'post_status'     => 'publish', 
                        'posts_per_page'  => absint( $slider_number),
                      );
      } else{

        $slider_args = array( 'post_status' => 'publish', 'posts_per_page' => 5 );
      }
       
      $slider_query = new WP_Query( $slider_args ); 

      if ( $slider_query->have_posts() ) : ?>
        <div id="main-slider">
          <div class="owl-carousel">
            <?php 
            while ( $slider_query->have_posts() ) : $slider_query->the_post(); 

              $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>

              <div class="item" style="background-image: url(<?php echo esc_url($image_url[0]); ?>); ">
                <div class="caption">
                    <h2><?php the_title(); ?></h2>
                    <?php if( 1 == $slider_excerpt ){ ?>
                      <div class="entry-content">
                        <p><?php echo esc_html( business_hub_limit_words( get_the_excerpt(), 25 ) ); ?>  </p>                          
                      </div>
                    <?php } ?>

                    <?php if( 1 == $readmore ){ ?>
                      <div class="btn btn-business"><a href="<?php the_permalink(); ?>"><?php echo esc_html( $read_more ); ?> <i class="fa fa-angle-right"></i></a></div>
                    <?php } ?>
                  </div><!-- .caption -->
              </div>
            <?php endwhile; ?>
          </div>
          <div class="scroll-down-wrapper">
              <div class="scroll-down">
                  <a href="#<?php echo esc_html( 'scroll' ); ?>">
                      <div class="scroll-down-middle"> </div> 
                      <span class="fa fa-angle-double-down"></span>
                  </a>
              </div><!-- .scroll-down -->
          </div><!-- .scroll-down-wrapper -->
        </div>
        <?php wp_reset_postdata(); 
      endif; ?>
      
    <?php } elseif( ( 1 === $theme_options['slider_enable']) ){ ?>

    <div id="main-slider" class="main-banner">
    <?php 
      $banner_img         = $theme_options['banner_image'];
      if( !empty( $banner_img )){ 
          $banner_img_args = array( 
              'p'             => absint( $banner_img ), 
              'post_status'     => 'publish'
          );

          $banner_img_query = new WP_Query( $banner_img_args ); 
          if ( $banner_img_query->have_posts() ) :
          while ( $banner_img_query->have_posts() ) : $banner_img_query->the_post();
          $banner_img_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>

      <div class="item" style="background-image: url(<?php echo esc_url($banner_img_url[0]); ?>); ">
        <div class="caption">
            <h2><?php the_title(); ?></h2>
             <?php if( 1 == $slider_excerpt ){ ?>
                <div class="entry-content">
                  <p><?php echo esc_html( business_hub_limit_words( get_the_excerpt(), 25 ) ); ?>  </p>                          
                </div>
              <?php } ?>

            <?php if( 1 == $readmore ){ ?>
              <div class="btn btn-business"><a href="<?php the_permalink(); ?>"><?php echo esc_html( $read_more ); ?> <i class="fa fa-angle-right"></i></a></div>
            <?php } ?>
        </div><!-- .caption -->
        <div class="scroll-down-wrapper">
            <div class="scroll-down">
                <a  href="#<?php echo esc_html( 'scroll' ); ?>">
                    <div class="scroll-down-middle"> </div> 
                    <span class="fa fa-angle-double-down"></span>
                </a>
            </div><!-- .scroll-down -->
        </div><!-- .scroll-down-wrapper -->
      </div><!-- .item -->   

      <?php
        endwhile;
      wp_reset_postdata();
    endif;
    } 
    ?>    

    </div><!-- .main-slider -->

    <?php }
  }

endif;

add_action( 'business_hub_slider', 'business_hub_main_slider', 10 );
