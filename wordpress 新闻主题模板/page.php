<?php // generic page template
get_header(); 

?>
<div class="row content-wrap">
<div class="nine columns main-content-area">
	<div class="single-article" role="main">
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
<!-- .page-content -->
</div>
		<?php endwhile; ?>
<section id="commentbox">
	<?php comments_template(); ?>
</section>
<?php else : ?>
	<h2 class="center">
		<?php _e('Nothing is Here - Page Not Found', 'newsframe'); ?>
	</h2>
	<div class="entry-content">
	<p><?php _e( 'Sorry, but we couldn\'t find what you we\'re looking for.', 'newsframe' ); ?></p>
	</div><!-- .entry-content -->
<?php endif; ?>
</div>
</div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
