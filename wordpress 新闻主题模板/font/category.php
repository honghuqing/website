<?php get_header(); ?>
<div class="container">
<div class="col-lg-8" id="news_list">
	<?php if (have_posts()) : ?>
	<div class="news">
		<header id="archive-header">
		<h1 class="archive-title">
		<?php
		printf( __( '%s', 'newsframe' ), '<span>' . single_cat_title( '', false ) . '</span>' );
		?></h1>
		<?php
		$category_description = category_description();
		if ( ! empty( $category_description ) )
		echo apply_filters( 'category_archive_meta',
		'<div class="cat-archive-meta">' . $category_description . '</div>' );
		?>
		</header>
	</div>
	<?php while (have_posts()) : the_post(); ?>
	<div class="news">
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<h2 class="index-title">
				<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
					<?php the_title(); ?>
				</a>
			</h2>
			<p class="postinfo">
				<i class="icon-tags"></i>文章分类: <?php the_category(', '); ?>
				<span class="spacer"></span>
				<i class="icon-user"></i>发布作者:  <?php the_author_posts_link(); ?><span class="spacer"></span> <i class="icon-calendar"></i>&nbsp;&nbsp;发布时间: <?php the_time ('m-d-Y'); ?>
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
			<div class="col-lg-12">
				<?php $img_id = get_post_thumbnail_id($post->ID); // This gets just the ID of the img
				the_post_thumbnail('thumbnail');
				$alt_text = get_post_meta($img_id , '_wp_attachment_image_alt', true); ?>
			</div>
			<?php } ?>
		
			<div class="col-lg-12">
				<?php the_excerpt(); ?>
			</div>
			<div style="clear:both"></div>
			<?php } ?>
		</article>
</div>
	<?php endwhile; ?>
	<?php endif; ?>
	</div>
<?php get_sidebar(); ?>
</div>
<section id="post-nav">
	<?php posts_nav_link(' ', '<i class="icon-arrow-left"></i>', '<i class="icon-arrow-right"></i>'); ?>
</section><!--End Navigation-->
<?php get_footer(); ?>

<script type="text/javascript">
	$(".wp-post-image").removeAttr('width');
	$(".wp-post-image").removeAttr('height');
</script>
<script type="text/javascript">
    $(document).ready(function(){
        var range = 20;             //距下边界长度/单位px
        var elemt = 500;           //插入元素高度/单位px
        var maxnum = 60;            //设置加载最多次数
        var num = 1;
        $(window).scroll(function(){
            var srollPos = $(window).scrollTop();    //滚动条距顶部距离(页面超出窗口的高度)
            var dbHiht = $(window).height();          //页面(约等于窗体)高度/单位px
            var main = $("#newsmain");                        //主体元素
            var news_list = $("#news_list");                  //内容主体元素
            var mainHiht = main.height();               //主体元素高度/单位px
		
            if((srollPos + dbHiht) >= (mainHiht-range)){
				num++;
				$("#load_number").val(num);
				var data={
					start:num,
					offer:'5'
				}
				 $.ajax({
					url: './get_news_list.php',
					type:"POST",
					data:data,
					success:function(msg)
					{
						alert(msg);
						/*
						news_list.append("<div style='border:1px solid tomato;margin-top:20px;color:#ac"+(num%60)+(num%60)+";height:"+elemt+"px' >hello world"+srollPos+"---"+num+"</div>");*/
					}
				})

                
				
            }
        });
    });
    </script>