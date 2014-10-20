<?php
/*
Template Name Posts: Full-Width
*/
?>
<?php get_header(); ?>
<div class="row content-wrap">
	<div class="twelve columns">
		<div class="single-article" role="main">
		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<article <?php post_class(); ?>>
			<h1 id="post-<?php the_ID(); ?>" class="article-title">
			<?php the_title(); ?>
			</h1>
	<h2 id="article-subtitle">
	<?php { $subtitle = get_post_meta
	($post->ID, 'subtitle', $single = true);
	if($subtitle !== '') echo $subtitle;} ?>
	</h2><!-- #article-subtitle -->
	<section class="byline">
		<span class="postinfo "><?php _e('By ' , 'newsframe' ); ?>
			<?php the_author_posts_link(); ?>
		</span> - 
		<span class="postinfo hideforprint">Published: <?php the_time('m/d/Y'); ?> - Section: <?php the_category(', ') ?>
		</span>
	</section><!-- .byline -->	<!-- Featured Video -->		
	<?php $newsframevideometa = get_post_meta ($post->ID, 'newsframe_video', true);		
		if ($newsframevideometa != '') { ?>	
		<div class="flex-video">			
			<?php echo get_post_meta($post->ID, 'newsframe_video', true); ?>		
		</div>		
			<?php } ?>		
	<section id="post-content">
		<?php the_content(); ?>
		<?php wp_link_pages('before=<div id="page-links">&after=</div>'); ?>
	<div style="clear:both;"></div>
	<footer id="post-footer">
		<span class="tag-links">
		<?php the_tags(); ?>
		</span>
	<section class="relatedarticles">
		<?php do_action( 'before_widget' ); ?>
		<?php if ( !dynamic_sidebar( 'belowposts-sidebar' ) ) : ?>
		<?php endif; ?>
	</section>
	<section id="article-nav">
		<?php previous_post_link(); ?> - <?php next_post_link(); ?>
	</section><!--End Article Navigation-->
	</footer>
	</section><!-- #post-content -->
		</article>
<?php endwhile; ?>
<?php comments_template( '', true ); ?>
<?php else : ?>
<h2 class="center"><?php _e('Nothing is Here - Page Not Found', 'newsframe'); ?></h2>
<div class="entry-content">
<p><?php _e( 'Sorry, but we couldn\'t find what you we\'re looking for.', 'newsframe' ); ?></p>
</div><!-- .entry-content -->
<?php endif; ?>
</div><!--End Single Article-->
</div>
</div>
<?php get_footer(); ?>