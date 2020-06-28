<?php
 /**
 * Register widget area.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_widget
 * @package businessdeal
 */

 class BusinessDeal_blog_grid_category_posts extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_blog_grid', 'description' => esc_html__( 'Display single blog column in home page', 'businessdeal') );
		$control_ops = array('width' => 200, 'height' => 250);
		parent::__construct( false, $name=esc_html__('T-Spiral: Blog Grid Category Posts','businessdeal'), $widget_ops, $control_ops );
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 */
	public function form( $instance ) {
		$posts_title = ! empty( $instance['posts_title'] ) ? esc_attr( $instance['posts_title'] ) : '';
		$latest_posts = ! empty( $instance['latest_posts'] ) ? esc_attr( $instance['latest_posts'] ) : 'latest';
		$category = ! empty( $instance['category'] ) ? esc_attr( $instance['category'] ) : 'category';
	?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'posts_title' )); ?>"><?php esc_html_e( 'Title:', 'businessdeal' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'posts_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'posts_title' )); ?>" type="text" value="<?php echo esc_attr( $posts_title ); ?>">
		</p>
		<p><input type="radio" <?php checked(esc_attr($latest_posts), 'latest'); ?> id="<?php echo $this->get_field_id( 'latest_posts' ); ?>" name="<?php echo esc_attr($this->get_field_name( 'latest_posts' )); ?>" value="latest"/><?php esc_html_e( 'Latest Posts', 'businessdeal' );?>
			<br>
		 <input type="radio" <?php checked(esc_attr($latest_posts), 'category'); ?> id="<?php echo esc_attr($this->get_field_id( 'latest_posts' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'latest_posts' )); ?>" value="category"/><?php esc_html_e( 'Show Category posts', 'businessdeal' );?>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'category' )); ?>"><?php esc_html_e( 'Select category', 'businessdeal' ); ?>:</label>
			<?php wp_dropdown_categories( array( 'show_option_none' =>esc_html__('-- Select -- ','businessdeal'),'name' => esc_attr($this->get_field_name( 'category' )), 'selected' => esc_attr($category) ) ); ?>
		</p>
		
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance[ 'posts_title' ] = sanitize_text_field($new_instance[ 'posts_title' ]);
		$instance[ 'latest_posts' ] = sanitize_text_field($new_instance[ 'latest_posts' ]);
		$instance[ 'category' ] = absint($new_instance[ 'category' ]);

		return $instance;
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 */
	public function widget( $args, $instance ) {
		extract($args);
		$posts_title = ! empty( $instance['posts_title'] ) ? esc_attr( $instance['posts_title'] ) : '';
		$latest_posts = ! empty( $instance['latest_posts'] ) ? esc_attr( $instance['latest_posts'] ) : 'latest';
		$category = ! empty( $instance['category'] ) ? esc_attr( $instance['category'] ) : 'category';
		$excerpt_display = get_theme_mod('excerpt-display','excerpt-content');
		$excerpt_text = get_theme_mod('excerpt_text',esc_html__('Read More','businessdeal'));

		echo $before_widget; ?>
		<div class="wrap">
			<?php if(!empty($posts_title) ){ ?>
				<h2 class="widget-title"><?php echo esc_attr($posts_title); ?></h2>
			<?php } ?>
			<div class="blog-grid-wrap">
				<div class="row col-4">
		
					<?php
					if( $latest_posts == 'latest' ) {
						$get_posts = new WP_Query( array(
							'posts_per_page' 			=> 4,
							'post_type'					=> 'post',
							'ignore_sticky_posts' 	=> true
						) );
					}
					else {
						$get_posts = new WP_Query( array(
							'posts_per_page' 			=> 4,
							'post_type'					=> 'post',
							'category__in'				=> absint($category)
						) );
					}

					while( $get_posts-> have_posts() ) : $get_posts->the_post(); ?>
					<div class="column">
						<div class="blog-grid">
							<?php if ( has_post_thumbnail() ) { ?>
								<div class="blog-grid-thumbnail">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('businessdeal-grid-post'); ?></a>
								 </div><!-- .blog-grid-thumbnail -->
							<?php } ?>
							<div class="blog-grid-content">
								<h2 class="blog-grid-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
								<div class="blog-grid-meta">
									<?php

										businessdeal_posted_on();

									?>
								</div><!-- .blog-grid-meta -->
								<div class="blog-grid-text-content">
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
										}
									?>
								</div><!-- .blog-grid-text-content -->
							</div><!-- .blog-grid-content -->
						</div><!-- .blog-grid -->
					</div><!-- .column -->
					<?php
					endwhile;
					wp_reset_postdata(); ?>
				</div><!-- .row -->
			</div><!-- .blog-grid-wrap -->
		</div><!-- .wrap -->
		<?php echo $after_widget . '<!-- .widget_blog_grid -->';
	}

}