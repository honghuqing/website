<?php /*Template Name: Full Width */ ?>
<?php get_header(); ?>
<div class="row content-wrap">
	<div class="twelve columns">	
		<div class="full-page" role="main" class="main-content-area">		
			<?php if (have_posts()) : ?>		
			<?php while (have_posts()) : the_post(); ?>		
		<div <?php post_class(); ?>>		
			<h1 id="post-<?php the_ID(); ?>" class="page-title">		
				<?php the_title(); ?>		
			</h1>	
		<article class="page-content">	
			<?php the_content(); ?>		
		</article><!-- .page-content -->
		</div>
<?php endwhile; ?>
<section id="commentbox">	
	<?php comments_template( '', true ); ?>
</section>
<?php else : ?>
<h2 class="center">
<?php _e('Nothing is Here - Page Not Found', 'newsframe'); ?>
</h2>
<div class="entry-content">
<p>
<?php _e( 'Sorry, but we couldn\'t find what you we\'re looking for.', 'newsframe' ); ?>
</p>
</div><!-- .entry-content -->
<?php endif; ?>
</div>
</div>
</div>
<?php get_footer(); ?>