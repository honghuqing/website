<?php global $newsframe_options; $newsframe_settings = get_option( 'newsframe_options', $newsframe_options ); ?>
	<?php if ( $newsframe_settings['newsframe_logo'] != '' ): ?>
	<img src="<?php echo $newsframe_settings['newsframe_logo']; ?>" alt="Logo" />
<?php else : ?>
	<h1>
		<?php echo bloginfo( 'name' ); ?>
	</h1>
<?php endif; ?>
