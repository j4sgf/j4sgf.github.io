<?php
/**
 * Template Name: Home Template
 *
 * @package businessdeal
 * 
 */

get_header();
?>
	<div id="main-content-area" class="main-content-area">
		<div class="main-content-holder">
			<?php

				if ( is_active_sidebar( 'businessdeal-template-main' ) ) {
					dynamic_sidebar( 'businessdeal-template-main' );
				}
			?>
		</div><!-- .main-content-holder -->
	</div><!-- .main-content-area -->

	<?php
get_footer();