jQuery(document).ready(function() {

// upload button for slider one full
jQuery('#upload_newsframe_logo').click(function() {

formfield = jQuery('#newsframe_logo');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true'); 
window.send_to_editor = function(html) {
 imgurl = jQuery('img',html).attr('src');
 jQuery('#newsframe_logo').val(imgurl);
 tb_remove();
}
return false;
});
});