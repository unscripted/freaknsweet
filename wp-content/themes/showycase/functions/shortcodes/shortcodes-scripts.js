jQuery.noConflict();
(function($) {

$(document).ready(function() {
  
	// ASSIGN CONTAINER FOR EACH VALUE
	$.scSelect = {
		'0' : $([]),
		'scColumn' : $('#scColumn'),
		'scTypography' : $('#scTypography'),
		'scButton' : $('#scButton'),
		'scDivider' : $('#scDivider'),
		'scList' : $('#scList'),
		'scAccordion' : $('#scAccordion'),
		'scTabs' : $('#scTabs'),
		'scImage' : $('#scImage'),
		'scVideo' : $('#scVideo'),
		'scTestimonial' : $('#scTestimonial'),
		'scNotification' : $('#scNotification'),
		'scService' : $('#scService'),
		'scSlider' : $('#scSlider'),
		'scPopup' : $('#scPopup'),
		'scPrice' : $('#scPrice'),
		'scTable' : $('#scTable')
	};
	
	// HIDE ALL ON LOAD
	$.each($.scSelect, function() { this.css({ display: 'none' }); });
	
	// ON SELECT SHORTCODE MENU CHANGE
	$('#scSelect').change(function() {
		$.each($.scSelect, function() { this.css({ display: 'none' }); }); // MAKE SURE ALL IS HIDDEN
		$.scSelect[$(this).val()].css({ display: 'block' }); // THEN SHOW THE CURRENT SELECTION
	});
  
});

})(jQuery);