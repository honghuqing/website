<?php get_header(); ?>
<?php 
	add_views($post->ID);
?>
	<div class="container main_index">
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 news news_list">
			<div class="single-article" role="main">
			<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<article <?php post_class(); ?>>
					<div class="nav breadcrumbs">
						<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url"><?php _e( 'Home', 'newsframe' ); ?></a> &#8250;
							<?php the_category('<span class="category-space"> | </span>'); ?> &#8250; 
							<span itemprop="title"><?php the_title(); ?></span>
						</div>
					</div>
					<h2 id="post-<?php the_ID(); ?>" class="article-title">
						<span class="post_class"><?php the_category(' '); ?></span>&nbsp;&nbsp;
						<?php the_title(); ?>
					</h2>
					<h2 class="article-subtitle">
						<?php { $subtitle = get_post_meta
						($post->ID, 'subtitle', $single = true);
						if($subtitle !== '') echo $subtitle;} ?>
					</h2><!-- #article-subtitle -->
				
					<section class="byline">
						<span class="postinfo "><?php _e('<i class="icon-user"></i>' , 'newsframe' ); ?>
						<?php the_author_posts_link(); ?></span> 
						<span class="postinfo hideforprint"> &nbsp;&nbsp;<?php the_time('Y-m-d'); ?> 
						</span>
						<span>&nbsp;&nbsp;浏览量：<?php echo the_click($post->ID); ?></span>
					</section><!-- .byline -->
					<br />
					<!-- Featured Video -->
					<?php $newsframevideometa = get_post_meta ($post->ID, 'newsframe_video', true);
						if ($newsframevideometa != '') {
							?>
					<div class="flex-video">
						<?php echo get_post_meta($post->ID, 'newsframe_video', true); ?>
					</div>
					<?php } ?>
					<section class="post-content">
						<img src="<?php ECHO get_post_thumbnail_url($post->ID);?>" />
						<br />
						<?php the_content(); ?>
						<div style="clear:both;"></div>
					
					</section><!-- #post-content -->
				</article>
			<?php endwhile; ?>
		<div class='col-lg-12' id='tag-box'><ul>
			<li class='post_tags'><a href="javascript:void()" class="post_tags">标签:</a></li>&nbsp;&nbsp; 			
			<?php
				$tags = wp_get_post_tags($post->ID);
				foreach ($tags as $tag) {
			?>
					<li class="post_tag"><a href="/newslist/?tag=<?php echo $tag->name;?>" style="word-break:keep-all;white-space:nowrap;"><?php echo $tag->name;?></a></li>
			<?php
				}
				if(count($tags) == 0){
					echo '<li class="post_tag_none"><a  href="javascript:void()">暂无标签</a></li>';
				}
			?>
		</ul></div>
		<div style="clear:both"></div>
		<div class="col-lg-12">
			<!-- JiaThis Button BEGIN -->
				<div class="jiathis_style_32x32">
					<a class="jiathis_button_qzone"></a>
					<a class="jiathis_button_tsina"></a>
					<a class="jiathis_button_tqq"></a>
					<a class="jiathis_button_weixin"></a>
					<a class="jiathis_button_renren"></a>
					<a href="http://www.7hae.com/newslist" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
					<a class="jiathis_counter_style"></a>
				</div>
				<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
			<!-- JiaThis Button END -->
		</div>
		
		<div style="clear:both"></div>
		<section id="article-nav" style="margin-top:50px">
			上一篇<?php previous_post_link(); ?> -- <?php next_post_link(); ?>下一篇
		</section><!--End Article Navigation-->


<div class="col-lg-12 uj-news">
<!-- UJian Button BEGIN -->
<div class="ujian-hook"></div>
<script type="text/javascript">var ujian_config = {num:4,itemTitle:'相关新闻：',picSize:152,ad1:false,ad2:false,ujian_ad11:false,ujian_ad12:false,textHeight:45,mouseoverColor:'#ffffff',borderColor:'#ffffff'};</script>
<script type="text/javascript" src="http://v1.ujian.cc/code/ujian.js"></script>
<!-- UJian Button END -->
</div>

<div class="col-lg-12 xg-news">
	<h2>相关文章</h2>
	<ul id="tags_related">
	<?php
		global $post;
		$post_tags = wp_get_post_tags($post->ID);
		if ($post_tags) {
			foreach ($post_tags as $tag) {
				// 获取标签列表
				$tag_list[] .= $tag->term_id;
			}

			// 随机获取标签列表中的一个标签
			$post_tag = $tag_list[ mt_rand(0, count($tag_list) - 1) ];

			// 该方法使用 query_posts() 函数来调用相关文章，以下是参数列表
			$args = array(
				'tag__in' => array($post_tag),
				'category__not_in' => array(NULL),  // 不包括的分类ID
				'post__not_in' => array($post->ID),
				'showposts' => 6,                           // 显示相关文章数量
				'caller_get_posts' => 1
			);
			query_posts($args);

			if (have_posts()) {
				while (have_posts()) {
					the_post(); update_post_caches($posts); ?>
					<li class="col-lg-12">
						<h2 class="index-title">
							<span class="post_class"><?php the_category(' '); ?></span>&nbsp;&nbsp;&nbsp;
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h2>
						<p class="postinfo">
							<span class="spacer"></span>&nbsp;&nbsp;<i class="icon-user"></i> <?php the_author_posts_link(); ?>
							<span class="spacer"></span>&nbsp;&nbsp; <?php the_time ('Y-m-d'); ?>
							<span class="spacer"></span>&nbsp;&nbsp; 浏览：<i><?php echo $post->click;?></i>
						</p>
						<div class="col-lg-12">
						<?php the_excerpt(); ?>
						</div><!-- .latest-content -->
					</li>
				<?php
				}
			}
			else {
				echo '<li>* 暂无相关文章</li>';
			}
			wp_reset_query();
		}
		else {
			echo '<li>* 暂无相关文章</li>';
		}
	?>
	</ul>
</div>

<?php comments_template( '', true ); ?>
<?php else : ?>
<h2 class="center"><?php _e('Nothing is Here - Page Not Found', 'newsframe'); ?></h2>
<div class="entry-content">
<p><?php _e( 'Sorry, but we couldn\'t find what you we\'re looking for.', 'newsframe' ); ?></p>
</div><!-- .entry-content -->
<?php endif; ?>
</div><!--End Single Article-->
</div>

<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>