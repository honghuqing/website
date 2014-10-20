<?php 
	get_header(); 
	global $authordata;
	$author_id=$authordata->data->ID;
?>
<div class="container main_index">
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" id="news_list">
		
		

		<?php if ( have_posts() ) : ?>
			<?php the_post(); ?>
			<div class="col-lg-12 col-md-12 col-sm-12 news list author">
			<div class="col-lg-3 col-md-3 col-sm-3">
			<div class="author_pic">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 250 ); ?>
			</div>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 author_content">
			<div class="author_name">
			<p class="author-title"><i class="icon-user"></i> <?php echo get_the_author();?></p>
			<p class="author-description"><b>简介：</b><?php echo get_the_author_description();?></p>
			</div>
			</div>
			</div>
			<div style="clear:both"></div>
			<?php rewind_posts(); ?>
			
		<?php endif; ?>

		<?php /* Start the Loop */ ?>
		<?php //rewind_posts(); ?>
		<?php while (have_posts()) : the_post(); ?>	
		<div class="news list ">
			<h2 class="index-title">
				<span class="post_class"><?php the_category(' '); ?></span>
				<span><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
					<?php the_title(); ?>
				</a></span>
				<span class="comment_number"><?php echo $post->comment_count;?></span>
			</h2>
			<p class="postinfo">
				<span class="spacer"></span>&nbsp;&nbsp;<i class="icon-user"></i> <?php the_author_posts_link(); ?>
				<span class="spacer"></span>&nbsp;&nbsp; <?php the_time ('Y-m-d'); ?>
				<span class="spacer"></span>&nbsp;&nbsp; 浏览：<span><?php echo $post->click;?></span>
			</p>
			<?php $newsframevideopromote = get_post_meta ($post->ID, 'newsframe_video', true);
			if (empty ($newsframevideopromote)) { ?>
				<div class="col-lg-12">
		<?php 
			if(get_post_thumbnail_url($post->ID)){
		?>
			<img src="/newslist/wp-content/themes/newsframe/loading.jpg" thissrc="<?php echo get_post_thumbnail_url($post->ID);?>" class='attachment-large img-responsive'>
			
		<?php
			}
		?>
				</div><!--end latest image Section-->
			<?php } ?>	
				<div class="col-lg-12">
				<?php the_excerpt(); ?>
				</div><!-- .latest-content -->
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
	</div>
	<?php endwhile; ?>
	
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
	var cat=<?php echo $author_id;?>;
	var pages=<?php echo get_system_info('posts_per_page');?>;
    $(document).ready(function(){
        var range = 5;             //距下边界长度/单位px
        var elemt = 500;           //插入元素高度/单位px
        var maxnum = 60;           //设置加载最多次数
        var num = 1;
		var n=0;
		var a=0;
		$('#news_list .news').each(function(){
			n++;
		});
		if(n >=5){
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
				num += 1;
				var data={
					offset:num,
					cat:cat,
					number:pages
				}
				 $.ajax({
					url: '/newslist/wp-content/themes/newsframe/get_author_posts1.php',
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
		}
    });
</script>