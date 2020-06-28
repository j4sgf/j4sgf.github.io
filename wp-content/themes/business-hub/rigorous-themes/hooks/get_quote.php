<?php
/**
 * The quote hook for our theme.
 *
 * This is the template that displays quote of the theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_Hub
 */

if ( ! function_exists( 'business_hub_get_quotes' ) ) :

    function business_hub_get_quotes(){ 

        $theme_options  = business_hub_theme_options();

        if( 1 === $theme_options['quote_enable'] ){ ?>

        <div class="get-quote">
            <div class="container">
                <div class="row">
                    <?php
                    if( !empty( $theme_options['get_a_quote'] ) ){
                    $get_a_quote         = $theme_options['get_a_quote'];
                    if( !empty( $get_a_quote )){ 
                        $get_a_quote_args = array( 
                            'p'             => absint( $get_a_quote ), 
                            'post_status'     => 'publish'
                            );

                        $get_a_quote_query = new WP_Query( $get_a_quote_args ); 
                        if ( $get_a_quote_query->have_posts() ) :
                            while ( $get_a_quote_query->have_posts() ) : $get_a_quote_query->the_post(); ?>

                        <div class="col col-3-of-4">
                            <h3><?php the_title(); ?></h3>
                        </div><!-- .col -->       

                        <div class="col col-1-of-4 text-center">
                            <?php 
                            $get_quote = (!empty( $theme_options['quote_btn'] )) ? $theme_options['quote_btn'] : __('Get a quote', 'business-hub');
                            ?>
                            <a href="<?php the_permalink(); ?>" target="_self" class="btn-business"><?php echo esc_html( $get_quote ); ?> <i class="fa fa-angle-right"></i></a>
                        </div><!-- .col -->

                        <?php
                        endwhile;

                        wp_reset_postdata();

                        endif;
                        } 
                    } else {
                    ?>

                    <div class="col col-3-of-4">
                        <h3><?php esc_html_e( 'Insert the post ID in customizer, Get A Quote Section to display the post title', 'business-hub' ); ?></h3>
                    </div><!-- .col -->       

                    <div class="col col-1-of-4 text-center">
                        <?php 
                        $get_quote = (!empty( $theme_options['quote_btn'] )) ? $theme_options['quote_btn'] : __('Get a quote', 'business-hub');
                        ?>
                        <a href="<?php the_permalink(); ?>" target="_self" class="btn-business"><?php echo esc_html( $get_quote ); ?> <i class="fa fa-angle-right"></i></a>
                    </div><!-- .col -->

                    <?php
                    }
                    ?>

                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .get-quote -->

        <?php } 
    }

endif;

add_action( 'business_hub_quote', 'business_hub_get_quotes', 10 );
