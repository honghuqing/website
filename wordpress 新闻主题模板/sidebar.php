<div class="col-lg-4 col-md-4 col-sm-4 three" id="right">
	<aside id="secondary" class="widget-area" role="complementary">
		<?php do_action( 'before_widget' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar' ) ) : ?>
	<aside id="archives" class="widget">
	<div class="sidebar-title-block">
		<h4 class="sidebar"><?php _e( 'Archives', 'newsframe' ); ?>
		</h4>
	<ul class="time_list">
	<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
	</ul>
	</div>
	</aside>
<?php endif; // end sidebar widget area ?>
	</aside><!-- #secondary .widget-area -->
	
</div>

<script type="text/javascript">

var obj11 = document.getElementById("two_code");

var top11 = getTop(obj11);

var isIE6 = /msie 6/i.test(navigator.userAgent);

window.onscroll = function(){

 

var bodyScrollTop = document.documentElement.scrollTop || document.body.scrollTop;

if (bodyScrollTop > top11){

obj11.style.position = (isIE6) ? "absolute" : "fixed";

obj11.style.top = (isIE6) ? bodyScrollTop + "px" : "10px";

} else {

obj11.style.position = "static";

}

}

function getTop(e){

 

var offset = e.offsetTop;

if(e.offsetParent != null) offset += getTop(e.offsetParent);

return offset;

}

</script>
