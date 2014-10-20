<?php

	require_once('../../../wp-blog-header.php');
	require_once('./functions.php');
	global $wpdb;

	$count=$_POST['count'];
	$page =$_POST['page'];
	$s=$_POST['s'];

	$kw=urlencode($s);
	//file_get_contents("http://localhost/newslist/?json=get_search_results&search=$kw&count=$count&page=$page");
	$curl = curl_init();

	// 设置你需要抓取的URL
	curl_setopt($curl, CURLOPT_URL, "http://localhost/newslist/?json=get_search_results&search=$kw&count=$count&page=$page");

	// 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

	// 运行cURL，请求网页
	$data = curl_exec($curl);

	// 关闭URL请求
	curl_close($curl);

	$res=json_decode($data,true); //json转码


	if(count($res['posts']) == 0){
		echo '0';exit;
	}
	$content='';
	foreach($res['posts'] as $k=>$v){

		$sql='select click from wp_posts where ID='.$v['id'];
		$click=$wpdb->get_var($sql);

		$cat=get_the_category($v['id']);//获取文章所属分类 
		//拼接字符串
		$content.="<div class='news list'>";
		$content.="<h2 class='index-title'>";
		$content.="<span class='post_class'><a href='/newslist/?cat=".$cat[0]->term_id."' title='查看".$cat[0]->cat_name."中的全部文章' rel='category'>".$cat[0]->cat_name."</a></span>";
		$content.="&nbsp;&nbsp;<span><a href='/newslist/".urldecode($v['title'])."' rel='bookmark' title='".$v['title']."'>";
		$content.=$v['title'];
		$content.="</a></span><span class='comment_number'>".get_post($v['id'])->comment_count."</span>";
		$content.="</h2>";
		$content.="<p class='postinfo'>";
		$content.="";
		$content.="<span class='spacer'></span>";
		$content.="&nbsp;&nbsp;<i class='icon-user'></i> <a href='/newslist/?author=".$v['author']['id']."' title='由".$v['author']['name']."发布' rel='author'>".$v['author']['name']."</a><span class='spacer'></span>&nbsp;&nbsp;".$v['date']."<span class='spacer'></span>&nbsp;&nbsp; 浏览：<span>".$click."</span></p>";
		if(get_post_thumbnail_url($v['id'])){
		$content.="<div class='col-lg-12'>";
		$content.="<img id='tese-img".$v['id']."' src='./wp-content/themes/newsframe/images/loading.jpg' thissrc='".get_post_thumbnail_url($v['id'])."'
		class='attachment-large img-responsive' /><img src='".get_post_thumbnail_url($v['id'])."' onload='change_tese_img(".$v['id'].",this)' style='display:none'>";
		$content.="</div>";
		}
		$content.="<div class='col-lg-12'>";
		if($v['excerpt']){
			$content.="<p>".$v['excerpt']."</p>";
		}
		$content.="</div>";

		$content.="<div class='col-lg-12' id='tag-box'><ul>";
		$content.="<li class='post_tags'><a href='javascript:void()' class='post_tags'>标签:</a></li>&nbsp;&nbsp;"; 
		$tags = wp_get_post_tags($v['id']);
		foreach ($tags as $tag) {
			$content.="<li class='post_tag'><a href='/newslist/?tag=".$tag->name."'>".$tag->name."</a></li>";
		}
		if(count($tags) == 0){
		$content.="<li class='post_tag_none'><a href='javascript:void()'>暂无标签</a></li>";
		}

		$content.="</ul></div>";

		$content.="<div style='clear:both'></div>";
		$content.="</div>";
	}
	echo $content;
?>  
