<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Business_Hub
 */
$theme_options = business_hub_theme_options();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-category-wrapper'); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() && ( 1 !== $theme_options['hide_meta']) ) : ?>
			<div class="post-details">
				<?php 
				business_hub_posted_on();
				business_hub_entry_footer();
				 ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	
</article><!-- #post-## -->
