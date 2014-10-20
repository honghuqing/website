	<div class="row">
		<div class="twelve columns">
			<?php $the_query = new WP_Query( 'posts_per_page=1' );
				while ( $the_query->have_posts() ) :
				$the_query->the_post();
				?>
			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<h1 class="latest-title">
					<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
					<?php the_title(); ?>
					</a>
				</h1>
					<section class="homesubtitle">
						<?php { 
							$subtitle = get_post_meta
							($post->ID, 'subtitle', $single = true);
							if($subtitle !== '') echo $subtitle;
							} ?>
					</section><!-- .subtitle -->
			</div>
		</div>
<!-- Featured Video -->
<?php $newsframevideopromote = get_post_meta ($post->ID, 'nf-promote-video', true);
	if ($newsframevideopromote != 'no' ) { 
		?>
	<div class="row">
		<div class="nine columns centered">
			<div class="flex-video">
				<?php echo get_post_meta($post->ID, 'newsframe_video', true); ?>
			</div>
		</div>
	</div>
<?php } ?>
<?php $newsframevideopromote = get_post_meta ($post->ID, 'nf-promote-video', true);
	if ($newsframevideopromote != 'yes') { ?>
		<div class="latest-image">
		<?php if ( has_post_thumbnail() ) {
				$img_id = get_post_thumbnail_id($post->ID); // This gets just the ID of the img
				the_post_thumbnail('large');
				$alt_text = get_post_meta($img_id , '_wp_attachment_image_alt', true);
				}
				?>
		</div><!--end latest image Section-->
	<?php } ?>
<div class="row">
	<div class="twelve columns">
		<div class="latest-content">
			<?php the_excerpt(); ?>
		</div><!-- .latest-content -->
		<?php endwhile; ?>
	</div>
</div>
