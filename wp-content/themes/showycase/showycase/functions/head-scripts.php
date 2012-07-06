<?php
add_action('wp_head', 'pt_theme_head_scripts');
function pt_theme_head_scripts() { 

if(

has_shortcode('image') ||
has_shortcode('slider') ||
has_shortcode('tabs') ||
has_shortcode('accordion') ||
is_page_template('home1.php') ||
is_page_template('home2.php') ||
is_page_template('home3.php') ||
is_page_template('home4.php') ||
is_page_template('contact.php') ||
( is_page_template('portfolio-3col.php') || is_page_template('portfolio-1col.php') || is_page_template('portfolio-3col-cat.php') || is_page_template('portfolio-1col-cat.php') ) && of_get_option('filtering_on') != '0' ||
( is_single() && get_post_type() == 'portfolio' ) ||
( is_single() && get_post_format() == 'gallery' ) ||
is_home() ||
is_archive() ||
is_search()

):
?>

	<script type="text/javascript">
	jQuery.noConflict(); (function($) {
	
	<?php if( has_shortcode('image') ||
    		  has_shortcode('slider') ||
     		  has_shortcode('gallery') ||
     		  ( is_single() && get_post_type() == 'portfolio' ) ||
     		  ( is_single() && get_post_format() == 'gallery' ) ||
     		  is_home() ||
     		  is_archive() ||
     		  is_search() ):?>
	    $(document).ready(function() {
	    	var items = jQuery('.entry-content a').filter(function() {
				if (jQuery(this).attr('href'))	
					return jQuery(this).attr('href').match(/\.(jpg|png|gif|JPG|GIF|PNG|Jpg|Gif|Png|JPEG|Jpeg)/);
			});
			items.attr('rel','prettyPhoto');
			items.attr('title','');
			
	    	$("a[rel^='prettyPhoto']").prettyPhoto();
	    });
    <?php endif; ?>
	
	<?php if( has_shortcode('tabs') ): ?>
		$(document).ready(function() {
			$( ".tabs" ).tabs({ fx: { opacity: 'toggle' } });
		});
	<?php endif; ?>
	
	
	<?php if( has_shortcode('accordion') ): ?>
		$(document).ready(function() {
			$( ".accordion" ).accordion({ collapsible: true, autoHeight: false });
		});
	<?php endif; ?>
	
	
	<?php if( is_page_template('contact.php') ): ?>
		$(document).ready(function(){
			$("#contactf").validate({
				errorElement: "p",
				errorPlacement: function(error, element) { error.appendTo( element.parent() ); }
			});
		});
		
		$(function() {
		    $("#contact-map").gMap({
		    	address: "<?php echo of_get_option('google_map'); ?>",
		    	zoom: 14,
		    	markers:[{ address: "<?php echo of_get_option('google_map'); ?>" }]
		    });
		});
	<?php endif; ?>
	
	
	<?php if( ( is_page_template('portfolio-3col.php') || is_page_template('portfolio-1col.php') || is_page_template('portfolio-3col-cat.php') || is_page_template('portfolio-1col-cat.php') ) && of_get_option('filtering_on') != '0' ): ?>
		$(document).ready(function() {
		
			var filterLink = $('#filtering-links li.filter');
			
			var folioItems = $('#folio-items');
			
			var cache_list = folioItems.clone();
			
			filterLink.each(function(){
				$(this).click(function(e) {
				
					$("#filtering-links li.filter").removeClass("current");
					$(this).addClass("current");
					
					var filteredItems = cache_list.find('li.'+$(this).attr('data-value'));
					
					folioItems.quicksand(filteredItems, {
						duration: 800,
						adjustHeight: 'dynamic'
					});
					e.preventDefault();
				});
			});
		
		});
	<?php endif; ?>
	
	
	<?php if( is_page_template('home1.php') || is_page_template('home3.php') || is_page_template('home4.php') ): ?>
		$(document).ready(function() {
		    $('.recent-work').jcarousel({
		    	animation: 1000,
		    	scroll: 3
		    });
		    
		    $('.recent-posts').jcarousel({
		    	animation: 1000,
		    	scroll: 3
		    });
		});
	<?php endif; ?>
	
	<?php if( is_page_template('home2.php') ):
		if( of_get_option('grid_showcase_effect') != '' ) $gridEffect = of_get_option('grid_showcase_effect'); else $gridEffect = 'disperse';
	?>
		$(function() {
			$('#tj_container').gridnav({
				rows	: 3,
				type	: {
					mode		: '<?php echo $gridEffect; ?>', 	// use def | fade | seqfade | updown | sequpdown | showhide | disperse | rows
					speed		: 400,			// for fade, seqfade, updown, sequpdown, showhide, disperse, rows
					easing		: '',			// for fade, seqfade, updown, sequpdown, showhide, disperse, rows	
					factor		: 80,			// for seqfade, sequpdown, rows
					reverse		: false			// for sequpdown
				}
			});
		});
		
		$(document).ready(function() {
		    $('.recent-posts').jcarousel({
		    	animation: 1000,
		    	scroll: 3
		    });
		});
	<?php endif; ?>
	
	
	<?php if( has_shortcode('slider') ): ?>
		$(window).load(function() {
		    $('.general-nivo').nivoSlider({
		    directionNav: true,
		    controlNav: false,
		    captionOpacity: 1,
		    startSlide: 0,
		    directionNavHide: false,
		    manualAdvance: false,
		    effect: 'fade',
		    pauseTime: 3500
		    });
		});
	<?php endif; ?>
	
	
	<?php if( is_single() && get_post_type() == 'portfolio' ): ?>
		$(window).load(function() {
		    $('#folio-nivo').nivoSlider({
		    directionNav: true,
		    controlNav: false,
		    captionOpacity: 1,
		    startSlide: 0,
		    directionNavHide: false,
		    manualAdvance: false,
		    effect: 'fade',
		    pauseTime: 3500
		    });
		});
	<?php endif; ?>
	
	
	<?php if( is_page_template('home1.php') ): ?>
	<?php if( of_get_option('show_slider') != '0' ):
	if( of_get_option('slider_effect') != '' ){
	$nivo_effect = of_get_option('slider_effect');
	} else { $nivo_effect = 'random'; }
	
	if( of_get_option('slider_delay') != '' ){
	$nivo_delay = of_get_option('slider_delay');
	} else { $nivo_delay = '3500'; }
	?>
		$(window).load(function() {
		    $('#home-slider').nivoSlider({
		    directionNav: true,
		    controlNav: true,
		    captionOpacity: 1,
		    startSlide: 0,
		    directionNavHide: false,
		    manualAdvance: false,
		    effect: '<?php echo $nivo_effect; ?>',
		    pauseTime: <?php echo $nivo_delay; ?>
		    });
		});
	<?php endif; ?>
	<?php endif; ?>
		
	})(jQuery);
	</script>
<?php endif; ?>
	
	<?php if( of_get_option('tracking_code') ){
	echo of_get_option('tracking_code');
	} ?>

<?php }
