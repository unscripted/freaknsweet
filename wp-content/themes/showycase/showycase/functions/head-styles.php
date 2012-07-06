<?php
add_action('wp_head', 'pt_theme_style_settings');
function pt_theme_style_settings() {
	$accent_color = of_get_option('cus_accent_color');
	
	if(
	
	of_get_option('bg_img') ||
	( of_get_option('bg_x_pos') && of_get_option('bg_y_pos') ) ||
	of_get_option('bg_att') != '0' ||
	of_get_option('bg_repeat') != '0' ||
	of_get_option('bg_color') ||
	of_get_option('description_color') ||
	of_get_option('cus_accent_color') ||
	of_get_option('custom_css')
	
	):
	
	?>
	<style type="text/css">
		<?php if( of_get_option('bg_img') ): ?>
		body { background-image: url(<?php echo of_get_option('bg_img');?>); }
		<?php endif; ?>
		
		<?php if( of_get_option('bg_x_pos') && of_get_option('bg_y_pos') ): ?>
		body { background-position: <?php echo of_get_option('bg_x_pos');?> <?php echo of_get_option('bg_y_pos');?>; }
		<?php endif; ?>
		
		<?php if( of_get_option('bg_att') != '0' ): ?>
		body { background-attachment: <?php echo of_get_option('bg_att');?>; }
		<?php endif; ?>
		
		<?php if( of_get_option('bg_repeat') != '0' ): ?>
		body { background-repeat: <?php echo of_get_option('bg_repeat');?>; }
		<?php endif; ?>
		
		<?php if( of_get_option('bg_color') ): ?>
		body { background-color: <?php echo of_get_option('bg_color');?>; }
		<?php endif; ?>
		
		<?php if( of_get_option('description_color') ): ?>
		h2#site-description { color: <?php echo of_get_option('description_color');?>; }
		<?php endif; ?>
		
		<?php if( of_get_option('cus_accent_color') ): ?>
		a:hover,
		.main-menu li.current-menu-item > a,
		.current-menu-ancestor > a,
		.current-menu-parent > a,
		.format-link .format-content h2 a:hover,
		.format-link .format-content h1 a:hover,
		#comments .comment-author-name a:hover,
		#related-posts a:hover h4,
		.folio-overlay .folio-title h3,
		.folio-wrap .folio-title h2 a:hover,
		.folio-wrap .folio-title h3,
		#filtering-links li.current a,
		#filtering-links li.current:hover a,
		#folio-meta span#folio-date,
		.priceFeatured .labelPrice,
		aside.widget_twitter ul#twitter_update_list li > a:hover,
		aside.widget_posts_thumbs a:hover h2,
		aside.widget_calendar #wp-calendar tbody a,
		.entry-wrap h2.entry-title a:hover,
		h2#site-description a {
		color: <?php echo $accent_color; ?>;
		}
		
		.sticky .sticky-badge,
		aside.widget_calendar #today,
		#pagination .page-numbers.current,
		.dropcap,
		.priceFeatured .labelTitle,
		.highlightedText,
		#related-posts a:hover .related-thumb,
		aside.widget_flickr .flickr_badge_image a:hover,
		aside.widget_posts_thumbs a:hover .wid_thumb,
		.gallery a:hover {
		background-color: <?php echo $accent_color; ?>;
		}
		
		#comments .bypostauthor > header .comment-avatar,
		#related-posts a:hover .related-thumb,
		aside.widget_flickr .flickr_badge_image a:hover,
		aside.widget_posts_thumbs a:hover .wid_thumb,
		.gallery a:hover {
		border: 1px solid <?php echo $accent_color; ?>;
		}
		
		#filtering-links li.current a,
		#filtering-links li.current:hover a,
		#filtering-links li:hover a,
		.priceFeatured .labelPrice {
		border-bottom: 3px solid <?php echo $accent_color; ?>;
		}
		
		h2#site-description a:hover {
		border-bottom: 1px dotted <?php echo $accent_color; ?>;
		}
		<?php endif; ?>
		
		<?php if( of_get_option('custom_css') ){
		echo of_get_option('custom_css');
		} ?>
	</style>
	<?php endif; ?>

<?php }