<?php
$homeSliderOrder = of_get_option('slider_order');
if( $homeSliderOrder != '' ) $orderOption = $homeSliderOrder; else $orderOption = 'post_date';
if( of_get_option('slider_height') ){ $sliderHeight = of_get_option('slider_height'); } else { $sliderHeight = '300'; }
?>
	
<div class="home-block-title">
	<span></span>
	<h2><?php if( of_get_option('featured_work_label') ) echo of_get_option('featured_work_label'); ?></h2>
</div>
<div id="home-slider" style="height: <?php echo $sliderHeight; ?>px;">
	<?php
	global $post;
	$tmp_post = $post;
	$myposts = get_posts('posts_per_page=-1&order=DESC&orderby='.$orderOption.'&post_type=slides');
						
	foreach( $myposts as $post ) : setup_postdata($post);
	
	$nivoImgPath =  get_post_meta($post->ID, 'nivoImgURL', TRUE);
	$nivoImg =  vt_resize( '', $nivoImgPath, 726, $sliderHeight, true );
	$nivoLink =  get_post_meta($post->ID, 'nivoLink', TRUE);
	$nivoCaption1 =  get_post_meta($post->ID, 'nivoCaption1', TRUE);
	$nivoCaption2 =  get_post_meta($post->ID, 'nivoCaption2', TRUE);
	
	if( $nivoCaption1 != '' ){ $caption1 = '<h2><span>'.$nivoCaption1.'</span></h2>'; } else { $caption1 = ''; }
	if( $nivoCaption2 != '' ){ $caption2 = '<h3><span>'.$nivoCaption2.'</span></h3>'; } else { $caption2 = ''; }
	
	if( $nivoLink != '' ):
		echo '<a href="'.$nivoLink.'" style="width: 726px; height: '.$sliderHeight.'px;">';
		echo '<img title="'.$caption1.$caption2.'" src="'.$nivoImg['url'].'" width="'.$nivoImg['width'].'" height="'.$nivoImg['height'].'" alt=""/>';
		echo '</a>';
	else:
		echo '<img title="'.$caption1.$caption2.'" src="'.$nivoImg['url'].'" width="'.$nivoImg['width'].'" height="'.$nivoImg['height'].'" alt=""/>';
	endif;
	
	endforeach;
	$post = $tmp_post;
	wp_reset_query(); ?>
	
</div>