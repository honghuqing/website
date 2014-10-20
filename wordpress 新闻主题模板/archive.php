<?php get_header(); ?>
<div class="container">
<div class="col-lg-8">
	
	<div class="archive-view">
<?php if (have_posts()) : ?>
		<header id="archive-header">
		<h1 class="archive-title"><?php if ( is_day() ) : ?>
		<?php printf( __( 'Daily Archives: %s', 'newsframe' ), '<span>' . get_the_time() . '</span>' ); ?>
		<?php elseif ( is_month() ) : ?>
		<?php printf( __( 'Monthly Archives: %s', 'newsframe' ), '<span>' . get_the_time( _x( 'F Y', 'monthly archives date 			format', 'newsframe' ) ) . '</span>' ); ?>
		<?php elseif ( is_year() ) : ?>
		<?php printf( __( 'Yearly Archives: %s', 'newsframe' ), '<span>' . get_the_time( _x( 'Y', 'yearly archives date 		format', 'newsframe' ) ) . '</span>' ); ?>
			<?php else : ?>
			<?php _e( 'Blog Archives', 'newsframe' ); ?>
		<?php endif; ?>
		</h1>
		</header>
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
</div>
	<?php endwhile; ?>
	<?php endif; ?>
</div>
</div>
<?php get_sidebar(); ?>
<section id="post-nav">
	<?php posts_nav_link(' ', '<i class="icon-arrow-left"></i>', '<i class="icon-arrow-right"></i>'); ?>
</section><!--End Navigation-->
</div>
</div>
<?php get_footer(); ?>