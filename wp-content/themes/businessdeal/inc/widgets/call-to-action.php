<?php
 /**
 * Register widget area.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_widget
 * @package businessdeal
 */

 class BusinessDeal_call_to_action extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_call_to_action_section', 'description' => esc_html__( 'Display  Personal Section in home page', 'businessdeal') );
		$control_ops = array('width' => 200, 'height' => 250);
		parent::__construct( false, $name=esc_html__('T-Spiral: Call to Action','businessdeal'), $widget_ops, $control_ops );
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 */
	public function form( $instance ) {
		$instance = wp_parse_args((array) $instance, array('button_text' => '','button_url' => '','page_id0'=>'','select_layout' => esc_html__('Black Overlay','businessdeal') ));

		$button_text = esc_attr($instance['button_text']);
		$button_text = esc_url($instance['button_url']);
		$select_layout = esc_attr($instance['select_layout']);
		$welcome_design = array(
                        'default' => esc_html__( 'Black Overlay', 'businessdeal' ),
                        'simple' => esc_html__( 'Simple', 'businessdeal' ),
                    );
			$var            = 'page_id0';
			$defaults[$var] = '';
		$instance = wp_parse_args((array)$instance, $defaults);
		$var = 'page_id0';
		$var = absint($instance[$var]);
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'select_layout' ) ); ?>">
				<?php esc_html_e( 'Select Action Layout:', 'businessdeal' ); ?>
			</label>
			<br/>
			<select class='widefat' id="<?php echo esc_attr( $this->get_field_id( 'select_layout' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'select_layout' ) ); ?>" type="text">
				<?php foreach ( $welcome_design as $key_value => $welcome_designs  ) : ?>

					 <option value="<?php echo esc_attr( $key_value ); ?>" <?php selected( $key_value, $instance['select_layout'] ); ?>><?php echo esc_html( $welcome_designs ); ?></option>

				<?php endforeach; ?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( key($defaults) ); ?>"><?php _e( 'Page', 'businessdeal' ); ?>:</label>
			<?php wp_dropdown_pages( array( 'show_option_none' =>' ','name' => $this->get_field_name( key($defaults) ), 'selected' => $instance[key($defaults)] ) ); ?>
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'button_text' )); ?>"><?php esc_html_e( 'Button Text:', 'businessdeal' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'button_text' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'button_text' )); ?>" type="text" value="<?php echo esc_attr( $instance[ 'button_text' ] ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'button_url' )); ?>"><?php esc_html_e( 'Button Url:', 'businessdeal' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'button_url' ); ?>" name="<?php echo $this->get_field_name( 'button_url' ); ?>" type="text" value="<?php echo esc_url( $instance[ 'button_url' ] ); ?>">
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
		$instance = $old_instance;
		$instance['button_text'] = sanitize_text_field( $new_instance['button_text'] );
		$instance['button_url'] = esc_url_raw( $new_instance['button_url'] );
		$instance['select_layout']    = sanitize_key( $new_instance['select_layout'] );
		$var            = 'page_id0';
		$instance[$var] = absint($new_instance[$var]);
		
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
		$button_text = ! empty( $instance['button_text'] ) ? esc_attr( $instance['button_text'] ) : '';
		$button_url = ! empty( $instance['button_url'] ) ? esc_url( $instance['button_url'] ) : '';
		$select_layout = isset( $instance[ 'select_layout' ] ) ? esc_attr($instance[ 'select_layout' ] ) : 'Black Overlay';
		$page_array = array();
		$var = 'page_id0';
		$page_id = isset( $instance[ $var ] ) ? $instance[ $var ] : '';

 			if( !empty( $page_id ) )
 				array_push( $page_array, $page_id );// Push the page id in the array
 		if( !empty($page_array) ) {
			$get_featured_pages = new WP_Query( array(
				'posts_per_page' 			=> -1,
				'post_type'					=>  array( 'page' ),
				'post__in'		 			=> $page_array,
				'orderby' 		 			=> 'post__in'
			) );

			if ($select_layout == 'default'){
				$custom_class = 'black-overlay ';
				$args['before_widget'] = str_replace('class="', "class=\"$custom_class", $args['before_widget']);
			}

			echo $args['before_widget']; ?>
			<?php while( $get_featured_pages->have_posts() ):$get_featured_pages->the_post();
			$thumbnail = get_the_post_thumbnail_url(); ?>
			<div class="ca-image-overly" <?php if (!empty($thumbnail)){ ?> style='background-image: url("<?php echo esc_url ($thumbnail); ?>")'<?php } ?>>
				<div class="wrap">
						<div class="ca-item-inside">
							<h2 class="widget-title"><?php the_title(); ?></h2>
							<div class="ca-text">
								<?php the_content(); ?>
							</div><!-- .ca-text -->
							<?php 
							if(!empty($button_text) ){ ?>
							<div class="call-to-action-btn">
								<a href="<?php echo esc_url($button_url); ?>"><?php echo esc_html ($button_text);?> <i class="fas fa-arrow-right"></i></a>
							</div>
						<?php } ?>
						</div>
				</div><!-- .wrap -->
			</div><!-- .image-overly -->
			<?php endwhile;
			wp_reset_postdata();
			echo $after_widget. '<!-- .widget_person_section -->';
		}
	}
}
