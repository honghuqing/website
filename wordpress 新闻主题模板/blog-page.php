<?php
/*
Template Name: Blog Posts Page
*/
?>
<?php get_header(); ?>
<?php if (!is_paged() ) { ?>
<div class="row">
<div class="twelve columns">
	<div class="single-page" role="main">
		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<div <?php post_class(); ?>>
			<h1 id="post-<?php the_ID(); ?>" class="page-title">
			<?php the_title(); ?>
			</h1>
	<article class="page-content">
		<?php the_content(); ?>
	</article>
<div style="clear:both;"></div>
</div>
		<?php endwhile; ?>
<?php endif; ?>
</div>
</div>
<?php } ?>
<div class="row content-wrap">
<div class="nine columns main-content-area">
	
	<div class="archive-view">
<?php query_posts('post_type=post&post_status=publish&posts_per_page=10&paged='. get_query_var('paged')); ?>
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
	<div class="archive-item">
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
		<h2 class="index-title">
		<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
		<?php the_title(); ?>
		</a>
		</h2>
				<p class="postinfo"><i class="icon-tags"></i>: <?php the_category(', '); ?>
				<span class="spacer"></span>
				<i class="icon-user"></i>: Written by <?php the_author_posts_link(); ?><span class="spacer"></span> <i class="icon-calendar"></i>: <?php the_time ('m-d-Y'); ?></p>
								<?php // shows featured video embed if post is video format and featured video embed box is used
									if ( has_post_format('video') && ( get_post_meta ($post->ID, 'newsframe_video', true) != '' ) ) { ?>
								<div class="row">
									<div class="twelve columns centered">
										<div class="flex-video">
											<?php echo get_post_meta($post->ID, 'newsframe_video', true); ?>
										</div>
									</div>
								</div>
								<?php }
									?>
								<?php // content backup if featured video is unset
									if ( has_post_format('video') && ( get_post_meta ($post->ID, 'newsframe_video', true) == '' ) ) {
									the_content();
									}
									?>
							<?php if ( !has_post_format('video') ) { ?>
							<?php if ( has_post_thumbnail() ) { ?>
							<div class="index-thumb">
								<?php $img_id = get_post_thumbnail_id($post->ID); // This gets just the ID of the img
								the_post_thumbnail('thumbnail');
								$alt_text = get_post_meta($img_id , '_wp_attachment_image_alt', true); ?>
							</div>
							<?php } ?>
				<div class="archive-excerpt">
					<?php the_excerpt(); ?>
				</div>
				<?php } ?>
		</article>
            <?php wp_reset_postdata(); ?>
</div>
	<?php endwhile; ?>
<section id="post-nav">
<?php previous_posts_link('<i class="icon-arrow-left"></i> '); ?>
<?php next_posts_link('<i class="icon-arrow-right"></i>'); ?>
</section>
	<?php endif; ?>
<?php wp_reset_query(); ?>
</div>
</div>
<?php get_sidebar(); ?>
</div>
</div>
<?php get_footer(); ?>