jQuery.noConflict();
(function($) {

$(document).ready(function() {
	$('input.upload_img').live("click", function () {
		imgField = $(this).prev();
		
		window.send_to_editor = function(html) {
		imgurl = $('img',html).attr('src');
		$(imgField).val(imgurl);
		tb_remove();
		}
		
		tb_show('', 'media-upload.php?post_id=1&amp;type=image&amp;TB_iframe=true');
		return false;
	});
});

})(jQuery);
