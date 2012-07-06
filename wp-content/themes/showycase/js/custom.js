jQuery.noConflict();
(function($) {

$(document).ready(function(){

/*----------------------------------------------------*/
// DETECT IF OS IS WINDOWS
/*----------------------------------------------------*/

	if ($.client.os == "Windows"){
		jQuery('html').addClass('win');
	}
	
	
	
/*----------------------------------------------------*/
// RESIZE EMBED VIDEOS
/*----------------------------------------------------*/
	/*
	// SIDEBAR VIDEOS
	$("#sidebar .embed-video iframe, #sidebar .embed-video object").each(function() {
	
		$(this)
		.data('aspectRatio', this.height / this.width)
		.removeAttr('width')
		.removeAttr('height')
		.width('192')
		.height('192' * $(this).data('aspectRatio'));
	});
	
	// FOOTER WIDGETS VIDEOS
	// ONE COLUMN
	$("#footer-wid.one .embed-video iframe, #footer-wid.one .embed-video object").each(function() {
	
		$(this)
		.data('aspectRatio', this.height / this.width)
		.removeAttr('width')
		.removeAttr('height')
		.width('696')
		.height('696' * $(this).data('aspectRatio'));
	});
	
	// TWO COLUMNS
	$("#footer-wid.two .embed-video iframe, #footer-wid.two .embed-video object").each(function() {
	
		$(this)
		.data('aspectRatio', this.height / this.width)
		.removeAttr('width')
		.removeAttr('height')
		.width('333')
		.height('333' * $(this).data('aspectRatio'));
	});
	
	// THREE COLUMNS
	$("#footer-wid.three .embed-video iframe, #footer-wid.three .embed-video object").each(function() {
	
		$(this)
		.data('aspectRatio', this.height / this.width)
		.removeAttr('width')
		.removeAttr('height')
		.width('212')
		.height('212' * $(this).data('aspectRatio'));
	});
	*/
	
/*----------------------------------------------------*/
// FOCUS EFFECT FOR FORM FIELDS
/*----------------------------------------------------*/

	$(".light-skin #branding input").focus(function() {
		$(this)
		.css({backgroundColor: '#ffffff'})
		.animate({ backgroundColor: '#161617', color: '#ffffff' }, 150);
		}).blur(function() {
		if ( $(this).val() == '' || $(this).val() == 'Search...' ){
			$(this).animate({ backgroundColor: '#ffffff', color: '#888888' }, 150);
		}
	});
	
	
	$(".dark-skin #branding input").focus(function() {
		$(this)
		.css({backgroundColor: '#161617'})
		.animate({ backgroundColor: '#ffffff', color: '#161617' }, 150);
		}).blur(function() {
		if ( $(this).val() == '' || $(this).val() == 'Search...' ){
			$(this).animate({ backgroundColor: '#161617', color: '#eeeeee' }, 150);
		}
	});

/*----------------------------------------------------*/
// SUPERFISH MENU
/*----------------------------------------------------*/

    $(".main-menu").superfish({
	    delay: 500,
	    hoverClass: 'hover-menu-item',
	    autoArrows: false,
	    animation: {opacity:'show', width:'show'},
		speed: 300
    }); 

/*----------------------------------------------------*/
// MENU HOVER EFFECT
/*----------------------------------------------------*/

	$(".light-skin nav .menu-item").live({
	mouseenter:
		function(){
			
			$(this).children("a:first")
			.css({backgroundColor:'#ffffff', minWidth: '15'})
			.animate({backgroundColor:'#f7f7f7', minWidth: '182'}, 250)
			
		},
	mouseleave:
		function(){
			
			$(this).children("a:first")
			.animate({backgroundColor:'#ffffff', minWidth: '15'}, 250)
			
		}
	});
	
	
	$(".dark-skin nav .menu-item").live({
	mouseenter:
		function(){
			
			$(this).children("a:first")
			.css({backgroundColor:'#161617', minWidth: '15'})
			.animate({backgroundColor:'#000000', minWidth: '182'}, 250)
			
		},
	mouseleave:
		function(){
			
			$(this).children("a:first")
			.animate({backgroundColor:'#161617', minWidth: '15'}, 250)
			
		}
	});

/*----------------------------------------------------*/
// SMOOTH BACK TO TOP
/*----------------------------------------------------*/

	$('a[href=#main_container]').click(function(){
			$('html, body').animate({scrollTop:0}, 'slow');
		return false;
	});

/*----------------------------------------------------*/
// HOVERS & OVERLAYS
/*----------------------------------------------------*/

	/*/// BLOG THUMBS OVERLAY ///*/
	$(".blog-overlay").live({
	mouseenter:
		function(){
			
			$(this).find(".more-hover").stop()
			.css({ right: "-42px", bottom: "-42px", opacity: 0 })
			.animate({ right: "0", bottom: "0", opacity: 1 }, { duration: 250, queue: false });
			
			$(this).find("img").stop()
			.css({ opacity: 1 })
			.animate({ opacity: 0.7 }, { duration: 250, queue: false });
			
		},
	mouseleave:
		function(){
			
			$(this).find(".more-hover").stop().animate({ right: "-42px", bottom: "-42px", opacity: 0 }, { duration: 250, queue: false });
			$(this).find("img").stop().animate({ opacity: 1 }, { duration: 250, queue: false });
			
		}
	});
	
	
	/*/// SQUARE PORTFOLIO THUMBS OVERLAY ///*/
	$(".folio-overlay").live({
	mouseenter:
		function(){
			
			$(this).find(".more-hover").stop()
			.css({ right: "-42px", bottom: "-42px", opacity: 0 })
			.animate({ right: "0", bottom: "0", opacity: 1 }, { duration: 250, queue: false });
			
			$(this).find(".folio-title").stop()
			.css({ opacity: 0 })
			.animate({ opacity: 1 }, { duration: 250, queue: false });
			
			$(this).find("img").stop()
			.css({ opacity: 1 })
			
		},
	mouseleave:
		function(){
			
			$(this).find(".more-hover").stop().animate({ right: "-42px", bottom: "-42px", opacity: 0 }, { duration: 250, queue: false });
			$(this).find(".folio-title").stop().animate({ opacity: 0 }, { duration: 250, queue: false });
			
		}
	});
	
	
	/*/// 1-COL PORTFOLIO THUMBS OVERLAY ///*/
	$(".page-template-portfolio-1col-php .folio-overlay, .page-template-portfolio-1col-cat-php .folio-overlay").live({
	mouseenter:
		function(){
			
			$(this).find(".more-hover").stop()
			.css({ right: "-42px", bottom: "-42px", opacity: 0 })
			.animate({ right: "0", bottom: "0", opacity: 1 }, { duration: 250, queue: false });
			
			$(this).find("img").stop()
			.css({ opacity: 1 })
			.animate({ opacity: 0.7 }, { duration: 250, queue: false });
			
		},
	mouseleave:
		function(){
			
			$(this).find(".more-hover").stop().animate({ right: "-42px", bottom: "-42px", opacity: 0 }, { duration: 250, queue: false });
			$(this).find("img").stop().animate({ opacity: 1 }, { duration: 250, queue: false });
			
		}
	});



/*----------------------------------------------------*/
// EQUAL HEIGHT COLUMNS
/*----------------------------------------------------*/

    equalHeight('.recent-posts > li');
    

}); // END $(document).ready


var maxHeight = 0;
function equalHeight(column) {
    
    column = $(column);
    
    column.each(function() {       
        
        if($(this).height() > maxHeight) {
            maxHeight = $(this).height();;
        }
    });
    
    column.height(maxHeight);
}

/*----------------------------------------------------*/
// CHECK IE VERSION & ADD CLASSES
/*----------------------------------------------------*/

if (jQuery.browser.msie && jQuery.browser.version == '8.0' ) {
	jQuery('html').addClass('ie8');
}

if (jQuery.browser.msie && jQuery.browser.version == '9.0' ) {
	jQuery('html').addClass('ie9');
}

/*----------------------------------------------------*/
// CLEAR FORM FIELDS ON FOCUS
/*----------------------------------------------------*/

$(function() {
	$('input:text, textarea').each(function() {
	var field = $(this);
	var default_value = field.val();
	field.focus(function() {
	if (field.val() == default_value) {
	field.val('');
	}
	});
	field.blur(function() {
	if (field.val() == '') {
	field.val(default_value);
	}
	});
	});
});




})(jQuery);