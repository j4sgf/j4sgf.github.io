<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_Hub
 */

$theme_options = business_hub_theme_options();

do_action( 'business_hub_action_after_container' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php 
		$sidebar_names = array('footer-1', 'footer-2', 'footer-3', 'footer-4'  );

	    $widget_count = business_hub_widget_count( $sidebar_names ); 

	    if(0<$widget_count): ?>
		    <div class="footer-widget-wrapper">
		        <div class="container">
		            <div class="row">
			            <?php 
			            $column_class = '';

			            if( 1  === $widget_count ){
			                $column_class = 'col-1-of-1';
			            } elseif( 2  === $widget_count ){
			                $column_class = 'col-1-of-2';
			            } elseif( 3  === $widget_count ){
			                $column_class = 'col-1-of-3';
			            }elseif( 4  === $widget_count ){
			                $column_class = 'col-1-of-4';
			            } 

			            foreach ($sidebar_names as $key => $value) { 
			            	    if( is_active_sidebar( $value ) ){ ?>
			            	    	<div class="col <?php echo esc_attr( $column_class ); ?>">
			            	    <?php
									dynamic_sidebar( $value );
								?>
									</div><!-- .col -->
								<?php }  } ?>
		            </div><!-- .row -->
		        </div><!-- .container -->
		    </div><!-- .footer-widget-wrapper -->
		<?php endif; ?>

	    <div id="site-generator" class="site-info">
	        <div class="container">
	            <div class="col col-1-of-1">
	                <div class="footer-copyright">

	                    <?php do_action( 'business_hub_copyright' ); ?>
	                    <?php if( 0 == $theme_options['scroll_top'] ){ ?>
			                    <div class="go-to-top">
			                        <a href="#" class="go-to-top-link"> <i class="fa fa-angle-up"></i><br><?php esc_html_e('Back To Top', 'business-hub'); ?></a>
			                    </div><!-- .go-to-top -->
	                    <?php } ?>

	                </div><!-- .footer-copyright -->
	            </div><!-- .col -->
	        </div><!-- .wrapper -->
	    </div><!--#site-generator -->
	</footer><!-- .site-footer -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
