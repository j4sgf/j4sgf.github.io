<?php
 /**
 * Register widget area.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_widget
 * @package businessdeal
 */

 class BusinessDeal_brandstory extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_brand_story', 'description' => esc_html__( 'Display  Brand Story Section in home page', 'businessdeal') );
		$control_ops = array('width' => 200, 'height' => 250);
		parent::__construct( false, $name=esc_html__('T-Spiral: Brand Story Section','businessdeal'), $widget_ops, $control_ops );
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 */
	public function form( $instance ) {
		$instance = wp_parse_args((array) $instance, array('brandstory_title' => '','page_id0'=>'','page_id1'=>'','page_id2'=>'', 'brand_image' => '', 'select_icons0' =>'','select_icons1' =>'','select_icons2' =>'', 'select_layout' =>esc_html__('Default','businessdeal')));

		$brandstory_title = esc_attr($instance['brandstory_title']);
		$brand_image = esc_url($instance['brand_image']);
		$select_layout = esc_attr($instance['select_layout']);
		$brand_design = array(
                        'default' => esc_html__( 'Default', 'businessdeal' ),
                        'simple' => esc_html__( 'Simple', 'businessdeal' ),
                    );
		for ($i = 0; $i < 2; $i++) {
			$var            = 'page_id'.$i;
			$defaults[$var] = '';
			$select_icons  = 'select_icons'.$i;
			$instance[ $select_icons ] = esc_attr( $instance[ $select_icons ] );
		}

		$instance = wp_parse_args((array)$instance, $defaults);

		for ($i = 0; $i < 2; $i++) {
			$var = 'page_id'.$i;
			$var = absint($instance[$var]);
		}
		?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'brandstory_title' )); ?>"><?php esc_html_e( 'Title:', 'businessdeal' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'brandstory_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'brandstory_title' )); ?>" type="text" value="<?php echo esc_attr( $instance[ 'brandstory_title' ] ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'select_layout' ) ); ?>">
				<?php esc_html_e( 'Select Brand Story Layout:', 'businessdeal' ); ?>
			</label>
			<br/>
			<select class='widefat' id="<?php echo esc_attr( $this->get_field_id( 'select_layout' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'select_layout' ) ); ?>" type="text">
				<?php foreach ( $brand_design as $key_value => $brand_designs  ) : ?>

					 <option value="<?php echo esc_attr( $key_value ); ?>" <?php selected( $key_value, $instance['select_layout'] ); ?>><?php echo esc_html( $brand_designs ); ?></option>

				<?php endforeach; ?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('brand_image'); ?>">
			<?php _e('Upload Brand Image', 'businessdeal'); ?>:
			</label>

			<span class="img-preview-wrap" <?php if (empty($brand_image)) { ?> style="display:none;" <?php } ?>>
			<img class="widefat" src="<?php echo esc_url($brand_image); ?>"
			alt="<?php esc_attr_e('Image preview', 'businessdeal'); ?>"/>
			</span><!-- .img-preview-wrap -->

			<input type="text" class="widefat" name="<?php echo $this->get_field_name('brand_image'); ?>"
			id="<?php echo $this->get_field_id('brand_image'); ?>"
			value="<?php echo esc_url($brand_image); ?>"/>

			<input type="button" id="custom_media_button"
			value="<?php esc_attr_e('Upload Image', 'businessdeal'); ?>" class="button media-image-upload"
			data-title="<?php esc_attr_e('Select Brand Image', 'businessdeal'); ?>"
			data-button="<?php esc_attr_e('Select Brand Image', 'businessdeal'); ?>"/>

			<input type="button" id="remove_media_button"
			value="<?php esc_attr_e('Remove Image', 'businessdeal'); ?>"
			class="button media-image-remove"/>
		</p>

		<?php for( $i=0; $i< 2; $i++) {
		$select_icons = 'select_icons'.$i; ?>
			<p>
				<label for="<?php echo $this->get_field_id( key($defaults) ); ?>"><?php _e( 'Page', 'businessdeal' ); ?>:</label>
				<?php wp_dropdown_pages( array( 'show_option_none' =>' ','name' => $this->get_field_name( key($defaults) ), 'selected' => $instance[key($defaults)] ) ); ?>
			</p>

			<p> <?php esc_html_e('Icon Class:', 'businessdeal'); ?> <a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank"> <?php esc_html_e('Get Fontawesome icon code','businessdeal' ); ?></a>
			<input class="widefat" id="<?php echo $this->get_field_id($select_icons); ?>" name="<?php echo $this->get_field_name($select_icons); ?>" type="text" placeholder="fab fa-500px" value="<?php if(isset ( $instance[$select_icons] ) ) echo esc_attr( str_replace( [ 'fab', 'fas', 'far'], [ 'fab ', 'fas ', 'far '], $instance[$select_icons] ) ); ?>" />
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
		$instance['brandstory_title'] = sanitize_text_field( $new_instance['brandstory_title'] );
		$instance['brand_image']    = esc_url_raw( $new_instance['brand_image'] );
		$instance['select_layout']    = sanitize_key( $new_instance['select_layout'] );
		for ($i = 0; $i < 2; $i++) {
			$var            = 'page_id'.$i;
			$instance[$var] = absint($new_instance[$var]);
			$select_icons  = 'select_icons'.$i;
			$instance[$select_icons] = sanitize_html_class( $new_instance[$select_icons] );
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
		$brandstory_title = ! empty( $instance['brandstory_title'] ) ? esc_attr( $instance['brandstory_title'] ) : '';
		$brand_image = isset( $instance[ 'brand_image' ] ) ? esc_url($instance[ 'brand_image' ] ) : '';
		$select_layout = isset( $instance[ 'select_layout' ] ) ? esc_attr($instance[ 'select_layout' ] ) : 'Default';
		$page_array = array();
		$icons_array = array();
		for( $i=0; $i<2; $i++ ) {
 			$var = 'page_id'.$i;
 			$page_id = isset( $instance[ $var ] ) ? $instance[ $var ] : '';
 			$select_icons  = 'select_icons'.$i;
 			$icons = isset( $instance[ $select_icons ] ) ? $instance[ $select_icons ] : '';

 			if( !empty( $page_id ) )
 				array_push( $page_array, $page_id );// Push the page id in the array

 			if( !empty( $icons ) )
 				array_push( $icons_array, $icons );// Push the select icons in the array
 		}
 		if( !empty($page_array) ) {
			$get_featured_pages = new WP_Query( array(
				'posts_per_page' 			=> -1,
				'post_type'					=>  array( 'page' ),
				'post__in'		 			=> $page_array,
				'orderby' 		 			=> 'post__in'
			) );

		if ($select_layout == 'default'){
			$custom_class = 'ex_design ';
			$args['before_widget'] = str_replace('class="', "class=\"$custom_class", $args['before_widget']);
		}

			echo $args['before_widget'];
			$j = 0; ?>
			<div class="brand-story-item-inside">
				<?php if(!empty($brand_image)){ ?>
					<div class="bs-thumbnail">
						<figure class="bs-thumbnail-holder">
							<img src="<?php echo esc_url($brand_image); ?>">
						</figure>
					</div><!-- .bs-thumbnail -->
				<?php } ?>
				<div class="bs-content">
					<?php if (!empty($brandstory_title)){?>
						<h2 class="widget-title"><?php echo esc_html ($brandstory_title);?></h2>
					<?php } ?>
					<div class="bs-content-row">
						<?php while( $get_featured_pages->have_posts() ):$get_featured_pages->the_post(); ?>

							<div class="bs-content-col">
								<?php if (!empty($icons_array)){ ?>
									<div class="bs-c-ico">
									<i class="<?php echo esc_attr( str_replace( [ 'fab', 'fas', 'far'], [ 'fab ', 'fas ', 'far '], $icons_array[$j] ) );
					?>"></i>
								</div><!-- .bs-c-ico -->
								<?php } ?>
								
								<div class="bs-c-content">
									<div class="bs-c-content-holder">
										<h4 class="bs-c-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
										<div class="bs-c-text">
											<?php the_excerpt(); ?>
										</div><!-- .bs-c-text -->
									</div><!-- .bs-c-content-holder -->
								</div><!-- .bs-c-content -->
							</div><!-- .bs-content-col -->
						<?php $j++;
						endwhile;
						wp_reset_postdata(); ?>

					</div><!-- .bs-content-row -->
				</div><!-- .bs-content -->
			<?php echo $after_widget. '<!-- .widget_brandstory_section -->';
		}
	}
}
