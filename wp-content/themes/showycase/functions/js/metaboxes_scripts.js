jQuery.noConflict();
(function($) {

$(document).ready(function() {

// POST FORMAT RADIO BUTTONS
var linkFormat = $("#post-format-link");
var videoFormat = $("#post-format-video");
var audioFormat = $("#post-format-audio");
var quoteFormat = $("#post-format-quote");
var galleryFormat = $("#post-format-gallery");


// POST FORMAT METABOXES
var linkMetabox = $("#linkf_settings");
var videoMetabox = $("#videof_settings");
var audioMetabox = $("#audiof_settings");
var quoteMetabox = $("#quotef_settings");
var galleryMetabox = $("#galleryf_settings");


// FOLIO CATEGORY METABOX
var folioCatMetabox = $("#folio_cat_settings");

// PAGE TEMPLATE SELECT MNEU
var pageTemplate = $("#page_template");


// HIDE ALL METABOXES ON LOAD
var allMetaboxes = $("#linkf_settings, #videof_settings, #audiof_settings, #quotef_settings, #galleryf_settings")
allMetaboxes.css({ display: 'none' });

folioCatMetabox.css({ display: 'none' });


// SHOW X METABOX IF X READIO IS CHECKED ON LOAD
if(linkFormat.is(':checked')){
linkMetabox.css({ display: 'block' });
}

if(videoFormat.is(':checked')){
videoMetabox.css({ display: 'block' });
}

if(audioFormat.is(':checked')){
audioMetabox.css({ display: 'block' });
}

if(quoteFormat.is(':checked')){
quoteMetabox.css({ display: 'block' });
}

if(galleryFormat.is(':checked')){
galleryMetabox.css({ display: 'block' });
}

if( pageTemplate.val() == 'portfolio-3col-cat.php' || pageTemplate.val() == 'portfolio-1col-cat.php' ){
folioCatMetabox.css({ display: 'block' });
}


//ON RADIO BUTTONS CHANGE
var radioSet = jQuery('#post-formats-select input');

radioSet.change( function() {
	if($(this).val() == 'link') {
		allMetaboxes.css({ display: 'none' });
		linkMetabox.css({ display: 'block' });
	}
	else if($(this).val() == 'video') {
		allMetaboxes.css({ display: 'none' });
		videoMetabox.css({ display: 'block' });
	}
	else if($(this).val() == 'audio') {
		allMetaboxes.css({ display: 'none' });
		audioMetabox.css({ display: 'block' });
	}
	else if($(this).val() == 'quote') {
		allMetaboxes.css({ display: 'none' });
		quoteMetabox.css({ display: 'block' });
	}
	else if($(this).val() == 'gallery') {
		allMetaboxes.css({ display: 'none' });
		galleryMetabox.css({ display: 'block' });
	}
	else {
		allMetaboxes.css({ display: 'none' });
	}
});


//ON PAGE TEMPLATE SELECT MNEU CHANGE
pageTemplate.change( function() {
	if( pageTemplate.val() == 'portfolio-3col-cat.php' || pageTemplate.val() == 'portfolio-1col-cat.php' ){
		folioCatMetabox.css({ display: 'block' });
	}
	else {
		folioCatMetabox.css({ display: 'none' });
	}
});


});

})(jQuery);