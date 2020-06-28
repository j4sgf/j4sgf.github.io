<?php
/**
 * The template for displaying woocommerce section.
 *
 * @package Business_Hub
 */

get_header(); ?>
<?php if(is_active_sidebar( 'shope-sidebar' )){
	$class_shop = 'col-2-of-3';
} else{
 $class_shop = 'col-1-of-1';

}?>

    <div id="primary" class="content-area col <?php echo esc_attr( $class_shop);?>">
        <main id="main" class="site-main" role="main">

            <?php woocommerce_content(); ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
if(is_active_sidebar( 'shope-sidebar' )){
	dynamic_sidebar( 'shope-sidebar' );
}
get_footer();