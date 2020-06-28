<?php
 /**
 * Register widget area.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_widget
 * @package businessdeal
 */

 class BusinessDeal_personal_section extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_person_section', 'description' => esc_html__( 'Display  Personal Section in home page', 'businessdeal') );
		$control_ops = array('width' => 200, 'height' => 250);
		parent::__construct( false, $name=esc_html__('T-Spiral: Personal Section','businessdeal'), $widget_ops, $control_ops );
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 */
	public function form( $instance ) {
		$instance = wp_parse_args((array) $instance, array('welcome_title' => '','page_id0'=>'','page_id1'=>'','page_id2'=>'','page_id3'=>'','page_id4'=>'','page_id5'=>'','page_id6'=>'','page_id7'=>'','page_id8'=>'', 'select_layout' =>esc_html__('Default','businessdeal') ));

		$welcome_title = esc_attr($instance['welcome_title']);
		$select_layout = esc_attr($instance['select_layout']);
		$welcome_design = array(
                        'default' => esc_html__( 'Default', 'businessdeal' ),
                        'simple' => esc_html__( 'Simple', 'businessdeal' ),
                    );
		for ($i = 0; $i < 4; $i++) {
			$var            = 'page_id'.$i;
			$defaults[$var] = '';
		}

		$instance = wp_parse_args((array)$instance, $defaults);

		for ($i = 0; $i < 4; $i++) {
			$var = 'page_id'.$i;
			$var = absint($instance[$var]);
		}
		?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'welcome_title' )); ?>"><?php esc_html_e( 'Title:', 'businessdeal' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'welcome_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'welcome_title' )); ?>" type="text" value="<?php echo esc_attr( $instance[ 'welcome_title' ] ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'select_layout' ) ); ?>">
				<?php esc_html_e( 'Select Personal Layout:', 'businessdeal' ); ?>
			</label>
			<br/>
			<select class='widefat' id="<?php echo esc_attr( $this->get_field_id( 'select_layout' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'select_layout' ) ); ?>" type="text">
				<?php foreach ( $welcome_design as $key_value => $welcome_designs  ) : ?>

					 <option value="<?php echo esc_attr( $key_value ); ?>" <?php selected( $key_value, $instance['select_layout'] ); ?>><?php echo esc_html( $welcome_designs ); ?></option>

				<?php endforeach; ?>
			</select>
		</p>

		<?php for( $i=0; $i< 4; $i++) { ?>
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
		$instance['welcome_title'] = sanitize_text_field( $new_instance['welcome_title'] );
		$instance['select_layout']    = sanitize_key( $new_instance['select_layout'] );
		for ($i = 0; $i < 4; $i++) {
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
		$welcome_title = ! empty( $instance['welcome_title'] ) ? esc_attr( $instance['welcome_title'] ) : '';
		$select_layout = isset( $instance[ 'select_layout' ] ) ? esc_attr($instance[ 'select_layout' ] ) : 'Default';
		$page_array = array();
		for( $i=0; $i<4; $i++ ) {
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

			if ($select_layout == 'default'){
				$custom_class = 'ex_design ';
				$args['before_widget'] = str_replace('class="', "class=\"$custom_class", $args['before_widget']);
			}

			echo $args['before_widget']; ?>

			<div class="wrap">
				<?php 
				if(!empty($welcome_title) ){ ?>
					<h2 class="widget-title"><?php echo esc_attr($welcome_title); ?></h2>
				<?php } ?>
				<div class="row col-4 ch-row">
	 			<?php
	 				while( $get_featured_pages->have_posts() ):$get_featured_pages->the_post(); ?>
	 					<div class="column ch-column">
							<div class="person-item-inside">
								<?php if ( has_post_thumbnail() ) { ?>
									<div class="pi-thumbnail">
											<?php the_post_thumbnail('businessdeal-personal-widget'); ?>
									</div><!-- .pi-thumbnail -->
								<?php } ?>
								<div class="pi-content">
									<div class="pi-content-holder">
										<h4 class="pi-title"><?php the_title(); ?></h4>
										<div class="pi-text">
											<?php the_excerpt(); ?>
										</div><!-- .pi-text -->
									</div><!-- .pi-content-holder -->
								</div><!-- .pi-content -->
							</div><!-- .welcome-item-inside -->
						</div><!-- .column -->

					<?php
					endwhile;
					wp_reset_postdata(); ?>
				</div><!-- .row -->
			</div><!-- .wrap -->
			<?php echo $after_widget. '<!-- .widget_person_section -->';
		}
	}
}
