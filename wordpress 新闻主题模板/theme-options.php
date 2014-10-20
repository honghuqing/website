<?php
// Default options values
$newsframe_options = array(
	'newsframe_logo' => '',
	'social_bar' => true,
	'facebook_link' => '',
	'twitter_link' => '',
	'gplus_link' => '',
	'linkedin_link' => '',
	'github_link' => '',
	'pinterest_link' => '',
	'feed_link' => '',
	'footer_link' => true,
	'featured_post_management' => false
);
if ( is_admin() ) :
function newsframe_register_settings() {
	register_setting( 'newsframe_theme_options', 'newsframe_options', 'newsframe_validate_options' );
}
add_action( 'admin_init', 'newsframe_register_settings' );
function newsframe_theme_options() {
	add_theme_page( 'Theme Options', 'Theme Options', 'edit_theme_options', 'theme_options', 'newsframe_theme_options_page' );
}add_action( 'admin_menu', 'newsframe_theme_options' );
function newsframe_theme_options_page() {
	global $newsframe_options, $newsframe_categories, $newsframe_layouts;
	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; ?>
	<div class="wrap">
	<?php screen_icon(); echo "<h2>" . __( 'NewsFrame Theme Options', 'newsframe' ) . "</h2>"; ?>
	
		<?php
		if ( locate_template ('newsframepro-options.php') != true ) {
				$convurl = 'http://www.edwardrjenkins.com/themes/newsframe-pro/?utm_source=wpupgrade&utm_medium=banner&utm_campaign=nfpro';
				echo '<a href="' . $convurl . '" target="_blank">' . '<img src="' . get_template_directory_uri() . '/images/nfpro-advert.png" /></a>';
				}
				?>
	<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div class="updated fade"><p><strong><?php esc_attr_e( 'Options saved' , 'newsframe' ); ?></strong></p></div>
	<?php endif; ?>
	<form method="post" action="options.php">
	<?php $settings = get_option( 'newsframe_options', $newsframe_options ); ?>
	
	<?php settings_fields( 'newsframe_theme_options' ); ?>
<table class="form-table">
	<h3><?php esc_attr_e('Featured Post Management' , 'newsframe' ); ?></h3>
	<p><?php esc_attr_e('Enable management of featured news stories by tag.' , 'newsframe'); ?></p>
	<tr valign="top">
	<td>
	<input type="checkbox" id="featured_post_management" name="newsframe_options[featured_post_management]" value="1" <?php checked( true, $settings['featured_post_management'] ); ?> />
	<label for="featured_post_management">Check to enable management of featured news stories by tag. Use the tag 'featured' to promote stories to the featured news section.</label>
	</td>
	</tr>
</table>
<table class="form-table">
<h3><?php esc_attr_e('Site Logo' , 'newsframe' ); ?></h3>
	<p><?php esc_attr_e('Enter the URL for your custom logo here.' , 'newsframe'); ?></p>
	<tr valign="top"><th scope="row"><label for="home_headline">Custom Logo</label></th>
	<td>
<input id="newsframe_logo" name="newsframe_options[newsframe_logo]" type="url" size="60" value="<?php esc_attr_e( $settings['newsframe_logo'] ); ?>" />
<input id="upload_newsframe_logo" type="button" value="Upload Image" />
<label class="description" for="newsframe_options[newsframe_logo]"><?php esc_attr_e( 'Leave blank to use the site title', 'newsframe' ); ?></label>
	</td>
	</tr>
<table class="form-table">
	<h3><?php esc_attr_e('Social Media Bar Settings' , 'newsframe' ); ?></h3>
	<p><?php esc_attr_e('Disable the bar if desired, or add your custom profile/page links.' , 'newsframe'); ?></p>
	<tr valign="top"><th scope="row">Social Media Bar</th>
	<td>
	<input type="checkbox" id="social_bar" name="newsframe_options[social_bar]" value="1" <?php checked( true, $settings['social_bar'] ); ?> />
	<label for="social_bar">Uncheck to disable the social media bar. Leave URL fields blank to disable specific icons.</label>
	</td>
	</tr>
	<tr valign="top"><th scope="row"><label for="facebook_link">Facebook URL</label></th>
	<td>
	<input id="facebook_link" name="newsframe_options[facebook_link]" type="url" size="60" value="<?php esc_attr_e($settings['facebook_link']); ?>" />
	</td>
	</tr>
<tr valign="top"><th scope="row"><label for="twitter_link">Twitter URL</label></th>
	<td>
	<input id="twitter_link" name="newsframe_options[twitter_link]" type="url" size="60" value="<?php esc_attr_e($settings['twitter_link']); ?>" />
	</td>
	</tr>
<tr valign="top"><th scope="row"><label for="gplus_link">Google+ URL</label></th>
	<td>
	<input id="gplus_link" name="newsframe_options[gplus_link]" type="url" size="60" value="<?php esc_attr_e($settings['gplus_link']); ?>" />
	</td>
	</tr>
<tr valign="top"><th scope="row"><label for="linkedin_link">LinkedIn URL</label></th>
	<td>
	<input id="linkedin_link" name="newsframe_options[linkedin_link]" type="url" size="60" value="<?php esc_attr_e($settings['linkedin_link']); ?>" />
	</td>
	</tr>
<tr valign="top"><th scope="row"><label for="Github URL">Github URL</label></th>
	<td>
	<input id="github_link" name="newsframe_options[github_link]" type="url" size="60" value="<?php esc_attr_e($settings['github_link']); ?>" />
	</td>
	</tr>
<tr valign="top"><th scope="row"><label for="Pinterest URL">Pinterest URL</label></th>
	<td>
	<input id="pinterest_link" name="newsframe_options[pinterest_link]" type="url" size="60" value="<?php esc_attr_e($settings['pinterest_link']); ?>" />
	</td>
	</tr>
<tr valign="top"><th scope="row"><label for="RSS Feed URL">RSS Feed URL</label></th>
	<td>
	<input id="feed_link" name="newsframe_options[feed_link]" type="url" size="60" value="<?php esc_attr_e($settings['feed_link']); ?>" />
	</td>
	</tr>
	</table>
<table class="form-table">
	<h3><?php esc_attr_e('Footer Link' , 'newsframe' ); ?></h3>
	<p><?php esc_attr_e('Disable the footer link.' , 'newsframe'); ?></p>
	<tr valign="top"><th scope="row">Footer Credit Link</th>
	<td>
	<input type="checkbox" id="footer_link" name="newsframe_options[footer_link]" value="1" <?php checked( true, $settings['footer_link'] ); ?> />
	<label for="footer_link">De-select to remove the footer credit link.</label>
	</td>
	</tr>
</table>
</table>
	<p class="submit"><input type="submit" class="button-primary" value="Save Options" /></p>
	</form>
<p>
<?php esc_attr_e('Thank you for using NewsFrame. A lot of time went into development. Donations small or large always appreciated.' , 'newsframe'); ?></p>
		<?php
		if ( locate_template ('newsframepro-options.php') != true ) {
				$convurl = 'http://www.edwardrjenkins.com/themes/newsframe-pro/?utm_source=wpupgrade&utm_medium=banner&utm_campaign=nfpro';
				$message = 'Or upgrade to NewsFrame Pro';
				echo '<a href="' . $convurl . '" target="_blank">' . $message . ' </a>';
				}
				?>
<form action="https://www.paypal.com/cgi-bin/webscr" target="_blank" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="QD8ECU2CY3N8J">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
<a href="http://www.edwardrjenkins.com/themes/newsframe/" target="_blank"><?php esc_attr_e('Newsframe Documentation' , 'newsframe' ); ?></a>
	</div>
	<?php
}
function newsframe_validate_options( $input ) {
	global $newsframe_options;
	$settings = get_option( 'newsframe_options', $newsframe_options );
	$input['newsframe_logo'] = esc_url( $input['newsframe_logo'] );
	$input['facebook_link'] = esc_url( $input['facebook_link'] );
	$input['twitter_link'] = esc_url( $input['twitter_link'] );
	$input['gplus_link'] = esc_url( $input['gplus_link'] );
	$input['linkedin_link'] = esc_url( $input['linkedin_link'] );
	$input['github_link'] = esc_url( $input['github_link'] );
	$input['pinterest_link'] = esc_url( $input['pinterest_link'] );
	$input['feed_link'] = esc_url( $input['feed_link'] );
	if ( ! isset( $input['social_bar'] ) )
	$input['social_bar'] = null;
	if ( ! isset( $input['footer_link'] ) )
	$input['footer_link'] = null;
	if ( ! isset( $input['featured_post_management'] ) )
	$input['featured_post_management'] = null;
	return $input;
}
endif;  // EndIf is_admin()