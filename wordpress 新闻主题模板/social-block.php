<?php global $newsframe_options; $newsframe_settings = get_option( 'newsframe_options', $newsframe_options ); ?>
<div id="social-bar">
<?php if ( $newsframe_settings['facebook_link'] !='' ) { ?>
	<a href="<?php echo $newsframe_settings['facebook_link']; ?>">
		<i class="icon-facebook icon-large"></i>
	</a>
<?php } ?>
<?php if ( $newsframe_settings['twitter_link'] !='' ) { ?>
	<a href="<?php echo $newsframe_settings['twitter_link']; ?>">
		<i class="icon-twitter icon-large"></i>
	</a>
<?php } ?>
<?php if ( $newsframe_settings['gplus_link'] !='' ) { ?>
	<a href="<?php echo $newsframe_settings['gplus_link']; ?>">
		<i class="icon-google-plus icon-large"></i>
	</a>
<?php } ?>
<?php if ( $newsframe_settings['linkedin_link'] !='' ) { ?>
	<a href="<?php echo $newsframe_settings['linkedin_link']; ?>">
		<i class="icon-linkedin icon-large"></i>
	</a>
<?php } ?>
<?php if ( $newsframe_settings['github_link'] !='' ) { ?>
	<a href="<?php echo $newsframe_settings['github_link']; ?>">
		<i class="icon-github icon-large"></i>
	</a>
<?php } ?>
<?php if ( $newsframe_settings['pinterest_link'] !='' ) { ?>
	<a href="<?php echo $newsframe_settings['pinterest_link']; ?>">
		<i class="icon-pinterest icon-large"></i>
	</a>
<?php } ?>
<?php if ( $newsframe_settings['feed_link'] !='' ) { ?>
	<a href="<?php echo $newsframe_settings['feed_link']; ?>">
		<i class="icon-rss icon-large"></i>
	</a>
<?php } ?>
</div>