jQuery(document).ready(function($){
	$(window).scroll(function(){
        if ($(this).scrollTop() < 200) {
			$('#top-return') .fadeOut();
        } else {
			$('#top-return') .fadeIn();
        }
    });
	$('#top-return').on('click', function(){
		$('html, body').animate({scrollTop:0}, 'slow');
		return false;
		});
});