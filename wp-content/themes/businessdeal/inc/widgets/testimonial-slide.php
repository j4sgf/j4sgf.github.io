<?php
 /**
 * Register widget area.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_widget
 * @package businessdeal
 */

 class BusinessDeal_testimonial_slide extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_testimonial_slide_section', 'description' => esc_html__( 'Display  Testimonial Slide in home page', 'businessdeal') );
		$control_ops = array('width' => 200, 'height' => 250);
		parent::__construct( false, $name=esc_html__('T-Spiral: Testimonial Slide','businessdeal'), $widget_ops, $control_ops );
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 */
	public function form( $instance ) {
		$instance = wp_parse_args((array) $instance, array('no_of_testimonial' => '3','welcome_title' => '','brand_image' => '','page_id0'=>'','page_id1'=>'','page_id2'=>'' ));

		$no_of_testimonial = absint( $instance[ 'no_of_testimonial' ] );
		$welcome_title = esc_attr($instance['welcome_title']);
		$brand_image = esc_url($instance['brand_image']);
		for ($i = 0; $i < $no_of_testimonial; $i++) {
			$var            = 'page_id'.$i;
			$defaults[$var] = '';
		}

		$instance = wp_parse_args((array)$instance, $defaults);

		for ($i = 0; $i < $no_of_testimonial; $i++) {
			$var = 'page_id'.$i;
			$var = absint($instance[$var]);
		}
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'no_of_testimonial' )); ?>"><?php esc_html_e( 'Number of Persons:', 'businessdeal' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'no_of_testimonial' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'no_of_testimonial' )); ?>" type="text" value="<?php echo absint( $no_of_testimonial ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'welcome_title' )); ?>"><?php esc_html_e( 'Title:', 'businessdeal' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'welcome_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'welcome_title' )); ?>" type="text" value="<?php echo esc_attr( $instance[ 'welcome_title' ] ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('brand_image'); ?>">
			<?php _e('Background Image', 'businessdeal'); ?>:
			</label>

			<span class="img-preview-wrap" <?php if (empty($brand_image)) { ?> style="display:none;" <?php } ?>>
			<img class="widefat" src="<?php echo esc_url($brand_image); ?>"
			alt="<?php esc_attr_e('Image preview', 'businessdeal'); ?>"/>
			</span><!-- .img-preview-wrap -->

			<input type="text" class="widefat" name="<?php echo $this->get_field_name('brand_image'); ?>"
			id="<?php echo $this->get_field_id('brand_image'); ?>"
			value="<?php echo esc_url($brand_image); ?>"/>

			<input type="button" id="custom_media_button"
			value="<?php esc_attr_e('Background Image', 'businessdeal'); ?>" class="button media-image-upload"
			data-title="<?php esc_attr_e('Select Image', 'businessdeal'); ?>"
			data-button="<?php esc_attr_e('Select Image', 'businessdeal'); ?>"/>

			<input type="button" id="remove_media_button"
			value="<?php esc_attr_e('Remove Image', 'businessdeal'); ?>"
			class="button media-image-remove"/>
		</p>

		<?php for( $i=0; $i < $no_of_testimonial; $i++) { ?>
			<p>
				<label for="<?php echo $this->get_field_id( key($defaults) ); ?>"><?php _e( 'Page', 'businessdeal' ); ?>:</label>
				<?php wp_dropdown_pages( array( 'show_option_none' =>' ','name' => $this->get_field_name( key($defaults) ), 'selected' => $instance[key($defaults)] ) ); ?>
			</p>

		<?php
		next( $defaults );
		}
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
		$instance = $old_instance;
		$instance['no_of_testimonial'] = absint( $new_instance['no_of_testimonial'] );
		$instance['welcome_title'] = sanitize_text_field( $new_instance['welcome_title'] );
		$instance['brand_image']    = esc_url_raw( $new_instance['brand_image'] );
		for ($i = 0; $i < $instance['no_of_testimonial']; $i++) {
			$var            = 'page_id'.$i;
			$instance[$var] = absint($new_instance[$var]);
		}
		
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
		$no_of_testimonial = ( ! empty( $instance['no_of_testimonial'] ) ) ? absint( $instance['no_of_testimonial'] ) : 4;
		$welcome_title = ! empty( $instance['welcome_title'] ) ? esc_attr( $instance['welcome_title'] ) : '';
		$brand_image = isset( $instance[ 'brand_image' ] ) ? esc_url($instance[ 'brand_image' ] ) : '';
		$page_array = array();
		for( $i=0; $i<$no_of_testimonial; $i++ ) {
 			$var = 'page_id'.$i;
 			$page_id = isset( $instance[ $var ] ) ? $instance[ $var ] : '';

 			if( !empty( $page_id ) )
 				array_push( $page_array, $page_id );// Push the page id in the array
 		}
 		if( !empty($page_array) ) {
			$get_featured_pages = new WP_Query( array(
				'posts_per_page' 			=> -1,
				'post_type'					=>  array( 'page' ),
				'post__in'		 			=> $page_array,
				'orderby' 		 			=> 'post__in'
			) );

			echo $before_widget; ?>
			<div class="testimonial-image-overly" <?php if (!empty($brand_image)){ ?> style='background-image: url("<?php echo esc_url ($brand_image); ?>")'<?php } ?>>
			<div class="wrap">
				<?php 
				if(!empty($welcome_title) ){ ?>
					<h2 class="widget-title"><?php echo esc_attr($welcome_title); ?></h2>
				<?php } ?>
				<div class="testimonial-slide-wrap">
					<div class="testimonial-slide">
			 			<?php
			 				while( $get_featured_pages->have_posts() ):$get_featured_pages->the_post(); ?>
			 					<div class="testimonial-slide-inner">
									<div class="ts-content-top">
										<div class="ts-content-top-inner">
											<?php if ( has_post_thumbnail() ) { ?>
												<div class="ts-thumbnail">
													<a href="<?php the_permalink(); ?>">
														<?php the_post_thumbnail( 'thumbnail' ); ?>
													</a>
												</div><!-- .ts-thumbnail -->
											<?php } ?>
											<div class="ts-content">
												<?php the_excerpt(); ?>
											</div><!-- .ts-content -->
										</div><!-- .ts-content-top-inner -->
									</div><!-- .ts-content-top -->
									<div class="ts-content-bottom">
										<h4 class="ts-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
									</div><!-- .ts-content-bottom -->
								</div><!-- .testimonial-slide-inner -->

							<?php
							endwhile;
							wp_reset_postdata();
						?>
					</div><!-- .testimonial-slide -->
				</div><!-- .testimonial-slide-wrap -->
			</div><!-- .testimonial-image-overly -->
			<?php echo $after_widget. '<!-- .widget_testimonial_slide_section -->';
		}
	}
}
