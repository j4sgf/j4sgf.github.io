<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Business_Hub
 */
$theme_options = business_hub_theme_options();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-category-wrapper'); ?>>
	<div class="row">

	<?php if( is_sticky() ){ ?>
    	<div class="favourite"><i class="fa fa-star"></i></div>
	<?php } ?>

		<?php 
		if ( has_post_thumbnail() ) {

			$second_col = 'col col-2-of-3';

		} else{

			$second_col = 'col col-1-of-1';
			
		}?>

		<?php if ( has_post_thumbnail() ) { ?>
			<div class="col col-1-of-3">
			    <?php the_post_thumbnail('business-hub-blog'); ?>
			</div> <!-- .col -->
		<?php } ?>
		<div class="<?php echo esc_attr( $second_col ); ?>">
			<header class="entry-header">
				<?php
				if ( is_single() ) :
					the_title( '<h3 class="entry-title">', '</h3>' );
				else :
					the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
				endif;

				if ( 'post' === get_post_type() && ( 1 !== $theme_options['hide_meta']) ) : ?>
				<div class="post-details">
					<?php 
					business_hub_posted_on();
					business_hub_entry_footer();
					?>
				</div><!-- .entry-meta -->
				<?php
				endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<p>
					<?php the_excerpt(); ?>					
				</p>
			</div><!-- .entry-content -->

			<?php $read_more = $theme_options['readmore_text']; ?>
			<a class="btn-business" href="<?php the_permalink(); ?> ">
			<?php if( !empty( $read_more ) ) {
				echo esc_html( $read_more ); 
			} else {
				esc_html_e( 'Read More', 'business-hub' );
			} ?>
			<i class="fa fa-angle-right"></i></a>		

		</div><!-- .col -->
	</div><!-- .row -->
</article><!-- #post-## -->
