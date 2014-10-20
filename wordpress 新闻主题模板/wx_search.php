<?php
	include('../../../wp-blog-header.php');
	require_once('./functions.php');
	global $wpdb;
	$keywords=$_GET['kw'];
	$sql="select * from $wpdb->posts where post_status='publish' and post_type='post' and post_title like '%$keywords%' order by post_date desc limit 10";
	$posts=$wpdb->get_results($sql);
	
	echo '<pre>';var_dump($posts);exit;
?>  
