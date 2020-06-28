<?php
/**
 * Add the about page under appearance.
 *
 * Display the details about the theme information
 *
 * @package businessdeal
 */
?>
<?php
// About Information
add_action( 'admin_menu', 'businessdeal_about' );
function businessdeal_about() {    	
	add_theme_page( esc_html__('About Theme', 'businessdeal'), esc_html__('About Theme', 'businessdeal'), 'edit_theme_options', 'businessdeal-about', 'businessdeal_about_page');   
}

// CSS for About Theme Page
function businessdeal_admin_theme_style($hook) {

	if ( 'appearance_page_businessdeal-about' != $hook ) {
        return;
    }

   wp_enqueue_style('businessdeal-admin-style', get_template_directory_uri() . '/inc/about-theme/css/about-theme.css');
}
add_action('admin_enqueue_scripts', 'businessdeal_admin_theme_style');

function businessdeal_about_page() {
	$theme = wp_get_theme();

?>
<div class="wrapper-info">
	<div class="col-left">
		<div class="intro">
			<h3><?php /* translators: %s theme name */
				printf( esc_html__( 'Welcome to %s', 'businessdeal' ), esc_html( $theme->Name ) ); ?>
				<?php esc_html_e('Version:','businessdeal'); ?> <?php echo esc_html($theme['Version']);?></h3>
				<p>
					<?php esc_html_e('BusinessDeal theme is an amazing modern Corporate and Business WordPress theme. This theme is suitable to build Business, Corporate Office, Business landing page, Personal business, Agency, Company, Finance agency and many more. It is easy to customize. It also include all major aspects like responsive, performance, cross-browser compatible, SEO ready and supports RTL. It is ready to promotion with social media icons to reach maximum target audience. Responsive slider impress your customers with lively eye-catching images right on your banner section.','businessdeal'); ?>
				</p>
				<p>
				<?php /* translators: %s theme name */
					printf( esc_html__( '%s theme is designed with passion. Please click the below button to display how your site looks like', 'businessdeal' ), esc_html( $theme->Name ) );
				?></p>
				<p> &nbsp;</p>
				<a href="<?php echo esc_url('https://demo.themespiral.com/businessdeal'); ?>" class="button button-primary button-hero about-theme" target="_blank"><?php esc_html_e( 'Visit Free Demo', 'businessdeal' ); ?></a> &nbsp; <a href="<?php echo esc_url('https://demo.themespiral.com/businessdeal-pro'); ?>" class="button button-primary button-hero about-theme" target="_blank"><?php esc_html_e( 'Visit Pro Demo', 'businessdeal' ); ?></a>
		</div>
		<div class="theme-tabs">
			<input type="radio" name="nav" id="one" checked="checked"/>
			<label for="one" class="tab-label"><?php esc_html_e('Getting Started?','businessdeal');?></label>

			<input type="radio" name="nav" id="two"/>
			<label for="two" class="tab-label"><?php esc_html_e('Demo Importer','businessdeal');?></label>

			<input type="radio" name="nav" id="three"/>
			<label for="three" class="tab-label"><?php esc_html_e('Support','businessdeal');?></label>

			<input type="radio" name="nav" id="four"/>
			<label for="four" class="tab-label"><?php esc_html_e('Setup Section','businessdeal');?></label>

			<input type="radio" name="nav" id="five"/>
			<label for="five" class="tab-label"><?php esc_html_e('Pro Features','businessdeal');?></label>

			<article class="content one">
			    <h3><?php esc_html_e('About Documentation','businessdeal');?></h3>
			    <p><?php esc_html_e('Documentation is the information that describes the product to its users. Our documentation covers only related to Free Themes and Pro Extension Plugins. It will guide your to develop your Website as we displayed in demo site without any others help.','businessdeal');?></p>
			    <p>
					<a href="<?php echo esc_url('https://docs.themespiral.com/businessdeal/');?>" target="_blank" class="button button-primary"><?php printf( esc_html__( '%s Documentation', 'businessdeal' ), esc_html( $theme->Name ) ); ?></a>
				</p>
				<h3><?php esc_html_e('Theme Customizer','businessdeal');?></h3>
			   <p><?php printf( esc_html__( '%s supports the Theme Customizer for all theme settings. Click "Customize" to personalize your site.', 'businessdeal' ), esc_html( $theme->Name ) ); ?>
			   	<a href="<?php echo esc_url(admin_url( 'customize.php' )); ?>" target="_blank" class="button button-primary"> <?php esc_html_e('Start Customizing','businessdeal');?></a>
				</p>
				<h3><?php esc_html_e('F.A.Q (Frequently Asked Questions)','businessdeal');?></h3>
			   <p><?php esc_html_e('Want to know more about Themes and Plugins developed by Theme Spiral? ','businessdeal'); ?><a href="<?php echo esc_url('https://themespiral.com/f-a-q/');?>" class="button button-primary" target="_blank"><?php esc_html_e('F.A.Q','businessdeal');?></a></p>
				<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/screenshot.png">
			</article>

			<article class="content two">
			    <h3><?php esc_html_e('Demo Importer','businessdeal');?></h3>
				<p>
					<?php esc_html_e( 'If your site have your own content then do not use this plugins to import dummy content. It will mess your site with dummy content. Is your site fresh? Install the Demo importer plugins and activate it.', 'businessdeal' ); ?></p>
				<p><?php esc_html_e('Do you want to install One Click Demo Import Plugin? ','businessdeal'); ?></p>
					<?php if ( is_plugin_active( 'one-click-demo-import/one-click-demo-import.php' ) ) { ?>
					<a href="<?php echo esc_url( admin_url( 'themes.php?page=pt-one-click-demo-import' ) ) ?>" class="button button-primary" style="text-decoration: none;">
						<?php esc_html_e( 'Install Demo Plugin', 'businessdeal' ); ?>
					</a>
				<?php } else { ?>
					<a href="<?php echo esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ) ?>" class="button button-primary" style="text-decoration: none;">
						<?php esc_html_e( 'Install Demo Plugin', 'businessdeal' ); ?>
					</a>
				<?php } ?> &nbsp;&nbsp;

				<h3><?php esc_html_e('How to install Dummy Content ?','businessdeal');?></h3>

				<p><?php esc_html_e(' Please install One Click Demo Import plugins. You can install it after activating businessdeal theme. It is listed in recommended Plugins','businessdeal'); ?></p>
				<ul>
					<li><?php esc_html_e('After plugin is activated, it asks you to upload  XML, WIE and  DAT dummy file','businessdeal');?></li>
					<li><a href="https://themespiral.com/download/3970/" target="_blank"><?php esc_html_e('Download it from Here ','businessdeal');?></a></li>
					<li><?php esc_html_e('Unzip businessdeal-dummy-content.zip file. You can find all XML, WIE and  DAT dummy file','businessdeal');?></li>
					<li><?php esc_html_e('Navigate to Appearance > Import Demo Data','businessdeal');?> 
					<?php if ( is_plugin_active( 'one-click-demo-import/one-click-demo-import.php' ) ) { ?> <a href="<?php echo esc_url( admin_url( 'themes.php?page=pt-one-click-demo-import' ) ) ?>"><?php esc_html_e('Upload','businessdeal'); ?></a><?php } ?></li>
					<li><?php esc_html_e('Upload manually and Click on Import demo data.','businessdeal');?></li>
					<li><?php esc_html_e('Now all your files and settings has been imported. Now you just need to setup your menu and front page.','businessdeal');?></li>
				</ul>
				<p><?php esc_html_e('Now all your files and settings has been imported. Now you just need to setup your menu and front page.','businessdeal');?></p>
				<p><strong><?php esc_html_e('Setup Menu:','businessdeal');?> </strong></p>
				
				<ul>
					<li><?php esc_html_e('In the Blog Dashboard, select Appearance > Menus.','businessdeal');?></li>
					<li><?php esc_html_e('Under the Menu Settings, located at the bottom of your screen, select Primary/ Secondary menu','businessdeal');?></li>
					<li><?php esc_html_e('Click save menu','businessdeal');?></li>
				</ul>
				<p><strong><?php esc_html_e('Setup Home Page:','businessdeal');?></strong></p>
				<ul>
					<li><?php esc_html_e('Navigate to Dashboard > Reading > Click on ( A static page ) from Your homepage displays','businessdeal');?></li>
				
				<li><?php esc_html_e('Select Homepage as Home and Postpage as Blog','businessdeal');?></li>
			</ul>

			<p><strong><?php esc_html_e('Setup Widgets:','businessdeal');?></strong></p>
				<ul>
					<li><?php esc_html_e('Navigate to Dashboard > Appearance > Widgets > Drag and Drop T:Spiral custom widgets to BusinessDeal Template Main Section','businessdeal');?></li>
				
				<li><?php esc_html_e('Set up pages and posts from the selected widgets','businessdeal');?></li>
			</ul>
			</article>

			<article class="content three">
			   <h3><?php esc_html_e('About Support','businessdeal');?></h3>
				<p><?php esc_html_e('Need Help? Use our Forums if you have any Themes and Plugins related questions. Support will be provided only related to our Themes and Plugins','businessdeal');?>
					<a href="<?php echo esc_url('https://themespiral.com/forums/'); ?>" target="_blank" class="button button-primary"> <?php esc_html_e('Forums','businessdeal');?></a>
				</p>
				<h3><?php esc_html_e('Sales Questions','businessdeal');?></h3>
				<p><?php esc_html_e('Do you have discussion relating to billing, your account or have pre-sales questions? Get touch with us!','businessdeal');?>
					<a href="<?php echo esc_url('https://themespiral.com/contact-us/');?>" target="_blank" class="button button-primary"> <?php esc_html_e('Contact us','businessdeal');?></a>
				</p>
			   <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/screenshot.png">
			</article>

			<article class="content four">
			   <h3><?php esc_html_e('Setup Sections','businessdeal');?></h3>
				<h4> <?php esc_html_e('Setup Site Identity','businessdeal'); ?></h4>
					<a class="button button-secondary" href="<?php echo esc_url(admin_url('customize.php?autofocus[section]=title_tagline')); ?>"></span><?php esc_html_e( 'Site Identity', 'businessdeal' ); ?></a>

				<h4> <?php esc_html_e('Setup Main Banner','businessdeal'); ?></h4>
					<a class="button button-secondary" href="<?php echo esc_url(admin_url('customize.php?autofocus[section]=businessdeal_main_banner_section')); ?>"></span><?php esc_html_e( 'Main Banner', 'businessdeal' ); ?></a>

				<h4> <?php esc_html_e('Setup Social Icons','businessdeal'); ?></h4>
					<a class="button button-secondary" href="<?php echo esc_url(admin_url())?>nav-menus.php"></span><?php esc_html_e( 'Social Icons', 'businessdeal' ); ?></a>

				<h4> <?php esc_html_e('Setup Primary Menu','businessdeal'); ?></h4>
					<a class="button button-secondary" href="<?php echo esc_url(admin_url())?>nav-menus.php"></span><?php esc_html_e( 'Primary Menu', 'businessdeal' ); ?></a>

				<h4> <?php esc_html_e('Setup Header','businessdeal'); ?></h4>
					<a class="button button-secondary" href="<?php echo esc_url(admin_url('customize.php?autofocus[section]=header_image')); ?>"></span><?php esc_html_e( 'Setup Header', 'businessdeal' ); ?></a>
			</article>

			<article class="content five">
				 <h3><?php esc_html_e('Upgrade to Pro','businessdeal');?></h3>
				 <p><?php esc_html_e('Want additional features? Pro extension plugin adds additinal features for free themes. ','businessdeal')?><a href="<?php echo esc_url('https://themespiral.com/themes/businessdeal');?>" class="button button-primary button-hero" target="_blank"><?php esc_html_e('Upgrade to Pro','businessdeal');?></a></p>
			   <h3><?php esc_html_e('Pro Features Extension','businessdeal');?></h3>
				<div class="feature-content">
					<ul class="feature-text">
						<li><?php esc_html_e('Site Layout','businessdeal'); ?></li>
						<li><?php esc_html_e('Single Sidebar Layout','businessdeal'); ?></li>
						<li><?php esc_html_e('Flexible Content Width','businessdeal'); ?></li>
						<li><?php esc_html_e('Sidebar Content Width','businessdeal'); ?></li>
						<li><?php esc_html_e('Blog Column 1/2/3/4','businessdeal'); ?></li>
						<li><?php esc_html_e('Choose Main Banner','businessdeal'); ?></li>
						<li><?php esc_html_e('Excerpt Text edit','businessdeal'); ?></li>
						<li><?php esc_html_e('Footer Layout','businessdeal'); ?></li>
						<li><?php esc_html_e('Instagram Compatible','businessdeal'); ?></li>
						<li><?php esc_html_e('Unlimited Color','businessdeal'); ?></li>
						<li><?php esc_html_e('Font Color','businessdeal'); ?></li>
						<li><?php esc_html_e('Color Schemes','businessdeal'); ?></li>
						<li><?php esc_html_e('Background Color','businessdeal'); ?></li>
						<li><?php esc_html_e('Font Size','businessdeal'); ?></li>
						<li><?php esc_html_e('Font Family','businessdeal'); ?></li>
						<li><?php esc_html_e('Footer Column 1/2/3/4','businessdeal'); ?></li>
						<li><?php esc_html_e('More Social Icons','businessdeal'); ?></li>
						<li><?php esc_html_e('Widget Column 1/2/3/4','businessdeal'); ?></li>
						<li><?php esc_html_e('Pro Templates','businessdeal'); ?></li>

					</ul>
			    </div><!-- .feature-content -->
			</article>
		</div>
		<div class="pro-content">
			<div class="pro-content-wrap">
				<div class="pro-content-header">
					<h3><?php esc_html_e('Powerful Pro Extension Features','businessdeal');?></h3>
					<p><?php esc_html_e('Get unlimited features using Pro extension. Purchase Business Deal Pro extension and get additional features and advanced customization options to make your website look awesome in different styles. ','businessdeal'); ?></p>
				</div>
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/free_vs_pro.png" alt="<?php esc_attr_e('Free vs Pro','businessdeal');?>">
			</div>
		</div>
	</div>
</div>
<?php }