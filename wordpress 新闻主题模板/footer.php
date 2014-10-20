</div><!-- Ends Container -->

<div class="container news" style="padding-top:20px">
<div class="col-lg-12">
<ul id="footermenu">
	<?php wp_nav_menu( array( 'theme_location' => 'bottom-menu' ) ); ?>
</ul>
	<br /><br /><br />
<p style="text-align:center">&copy; <?php echo date('Y'); ?> - <?php bloginfo('name'); ?></p><br>
</div><br />
<p id="back-to-top"><a href="#top"><span></span></a></p>

</body>
</html>
<script type="text/javascript">
//友荐模块去圆角处理
<!--
	$('.JIATHIS_IMG_NO').css('border-radius','0px');
//-->
</script>
<script language="javascript">
//处理网站所有图片的自适应 img-responsive
imgs = document.getElementsByTagName("img");
imgsnum = imgs.length;
for(imgi = 0 ;imgi < imgsnum;imgi++){
     if (imgs[imgi].className != 'img-responsive'){
        imgs[imgi].className += ' img-responsive';
	 }
}

</script>
<script>
$(function(){
	//返回顶部
	$(function () {
		$(window).scroll(function(){
			if ($(window).scrollTop()>100){
				$("#back-to-top").css('display','block');
			}
			else
			{
				$("#back-to-top").css('display','none');
			}
		});

		//当点击跳转链接后，回到页面顶部位置

		$("#back-to-top").click(function(){
			$('body,html').animate({scrollTop:0},1000);
			return false;
		});
	});
});
</script>
<script type="text/javascript">
<!--
	//滚动加载文章的图片加载事件
	function change_tese_img(id,msg){
		var img='tese-img'+id;
		document.getElementById(img).src=msg.src;
	}
//-->
</script>
<script language="javascript">
//图片加载成功事件
var imgs=$("#news_list img");
imgsnum = imgs.length;
for(imgi = 0 ;imgi < imgsnum;imgi++){
     if (imgs[imgi].getAttribute('thissrc') != '' && imgs[imgi].getAttribute('thissrc') != null){
		 imgs[imgi].src = imgs[imgi].getAttribute('thissrc');
	 }
}
</script>