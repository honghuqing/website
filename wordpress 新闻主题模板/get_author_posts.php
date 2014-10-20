<?php
	require_once('../../../wp-config.php');
	require_once('./functions.php');
	global $wpdb;
	$offset=$_POST['offset'];
	$number=$_POST['number'];
	
	$cat=$_POST['cat'];
	$sql="select * from $wpdb->posts where post_status='publish' and post_type='post' and post_author=$cat order by post_date desc limit $offset,$number";
	$posts=$wpdb->get_results($sql);
	if(count($posts) == 0){
		echo '0';exit;
	}
	$content='';
	foreach($posts as $k=>$v){
		$sql='select display_name from wp_users where ID='.$v->post_author;
		$author=$wpdb->get_var($sql);
		$cat=get_the_category($v->ID);//获取文章所属分类 
		//拼接字符串
		$content.="<div class='news list'>";
		$content.="<article class='post-11 post type-post status-publish format-standard has-post-thumbnail hentry category-news_ys last' id='post-11'>";
		$content.="<h2 class='index-title'>";
		$content.="<span class='post_class'><a href='/newslist/?cat=".$cat[0]->term_id."' title='查看".$cat[0]->cat_name."中的全部文章' rel='category'>".$cat[0]->cat_name."</a></span>";
		$content.="&nbsp;&nbsp;<span><a href='http://www.7hae.com/newslist/?p=".$v->ID."' rel='bookmark' title='".$v->post_title."'>";
		$content.=$v->post_title;
		$content.="</a></span><span class='comment_number'>".get_post($v->ID)->comment_count."</span>";
		$content.="</h2>";
		$content.="<p class='postinfo'>";
		$content.="";
		$content.="<span class='spacer'></span>";
		$content.="&nbsp;&nbsp;<i class='icon-user'></i> <a href='/newslist/?author=1' title='由".$author."发布' rel='author'>".$author."</a><span class='spacer'></span>&nbsp;&nbsp;".$v->post_date."<span class='spacer'></span>&nbsp;&nbsp; 浏览：<span>".$v->click."</span></p>";
		if(get_post_thumbnail_url($v->ID)){
		$content.="<img id='tese-img".$v->ID."' src='./wp-content/themes/newsframe/images/loading.jpg' thissrc='".get_post_thumbnail_url($v->ID)."'
		class='attachment-large img-responsive' /><img src='".get_post_thumbnail_url($v->ID)."' onload='change_tese_img(".$v->ID.",this)' style='display:none'>";
		}
		$content.="<div>";
		$content.="<p>".$v->post_excerpt."</p>";
		if($v->post_excerpt){
		$content.="<p class='read-more' style='text-align:right'><a href='/newslist/".urldecode($v->post_name)."' style='padding:3px 6px;background-color:#859FFF;color:#ffffff;border-radius:3px'>阅读全文</a></p>";
		}
		$content.="</div>";

		$content.="<div class='col-lg-12' id='tag-box'><ul>";
		$content.="<li class='post_tags'><a href='javascript:void()' class='post_tags'>标签:</a></li>&nbsp;&nbsp;"; 
		$tags = wp_get_post_tags($v->ID);
		foreach ($tags as $tag) {
			$content.="<li class='post_tag'><a href='/newslist/?tag=".$tag->name."'>".$tag->name."</a></li>";
		}
		if(count($tags) == 0){
		$content.="<li class='post_tag_none'><a href='javascript:void()'>暂无标签</a></li>";
		}

		$content.="</ul></div>";


		$content.="<div style='clear:both'></div>";
		$content.="</article>";
		$content.="</div>";
	}
	echo $content;
?>  
