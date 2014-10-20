<?php // template for tag archives
	get_header(); 

	$tag=strchr($_SERVER['REQUEST_URI'],'%');
	$tag_name=substr($tag,0,strlen($tag)-1);
	
	global $wpdb;
	$tag_id=$wpdb->get_var("select term_id from $wpdb->terms where slug='$tag_name'");

	// $tag_posts=query_posts("showposts=-1&tag_id=$tag_id"); 
	// echo '<pre>';var_dump($tag_posts);exit;

	?>
<div class="container main_index">
	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 news_list" id="news_list">
		<div class="archive-view">
		<?php if (have_posts()) : ?>
		<header class="news">
			<h1 class="archive-title">
			<?php
			 echo single_tag_title( '', false );
			?>
			</h1>
			<?php
			$tag_description = tag_description();
			if ( ! empty( $tag_description ) )
			echo apply_filters( 'tag_archive_meta', '<div class="tag-archive-meta">' . $tag_description . '</div>' );
			?>
		</header>
		<?php while (have_posts()) : the_post(); ?>
			<div class="news list">
					<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
						<h2 class="index-title">
							<span class="post_class"><?php the_category(' '); ?></span>
							<span><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
								<?php the_title(); ?>
							</a></span>
							<span class="comment_number"><?php echo $post->comment_count;?></span>
						</h2>
						<p class="postinfo">							
							<span class="spacer"></span>&nbsp;&nbsp;<i class="icon-user"></i> <?php the_author_posts_link(); ?>
							<span class="spacer"></span>&nbsp;&nbsp; <?php the_time ('Y-m-d'); ?>
							<span class="spacer"></span>&nbsp;&nbsp; 浏览：<span><?php echo $post->click;?></span>
						</p>
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
		<?php 
			if(get_post_thumbnail_url($post->ID)){
		?>
			<img src="/newslist/wp-content/themes/newsframe/images/loading.jpg" thissrc="<?php echo get_post_thumbnail_url($post->ID);?>" class='attachment-large img-responsive'>
		<?php
			}
		?>
							</div>
							<?php } ?>
				<div class="archive-excerpt">
					<?php the_excerpt(); ?>
				</div>
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
				<?php } ?>
					</article>
<div style="clear:both"></div>
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

<?php get_sidebar(); ?>
</div>
<div id="jiazai" class="container" style="display:none;">
	<div class="col-md-12 news" style="text-align:center;">
		<p class="neirong" style="padding:10px 30px">
		<img src="<?php echo get_template_directory_uri();?>/images/zhuan.gif" style="display:inline" /><span id="neirong">正在加载，请稍候...</span>
		</p>
	</div>
</div>
<?php get_footer(); ?>

<script type="text/javascript">
	$(".wp-post-image").removeAttr('width');
	$(".wp-post-image").removeAttr('height');
</script>


<script type="text/javascript">
	var tagid=<?php echo $tag_id;?>;
	var pages=<?php echo get_system_info('posts_per_page');?>;
    $(document).ready(function(){
        var range = 0;             //距下边界长度/单位px
        var elemt = 500;           //插入元素高度/单位px
        var maxnum = 60;           //设置加载最多次数
        var a=0;                  //内容主体元素
        var num = 0;
        $(window).scroll(function(){

		　　var scrollTop = $(this).scrollTop();
		　　var scrollHeight = $(document).height();
		　　var windowHeight = $(this).height();

            var main = $("#newsmain");                        //主体元素
            var news_list = $("#news_list");
			
			if(scrollTop + windowHeight <= scrollHeight-100){
				a=0;
			}

            if(a == 0){
		　　if(scrollTop + windowHeight == scrollHeight){
		　　　　$("#jiazai").css('display','block');
					a = 1;
					num += pages;
					$("#load_number").val(num);
					var data={
						offset:num,
						tagid:tagid,
						number:pages
					}
					$.ajax({
						url: '/newslist/wp-content/themes/newsframe/get_tag_posts.php',
						type:"POST",
						data:data,
						success:function(msg)
						{
							if(msg == '0'){
								$(".neirong").html('没有更多文章了');
							}else{
								news_list.append(msg)
								$("#jiazai").css('display','none');
							}
						}
					})   
		　　}
			}
		});
 
    });
    </script>