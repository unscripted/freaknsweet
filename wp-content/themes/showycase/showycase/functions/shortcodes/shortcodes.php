<?php 

//==============================================//
// disables WP auto formatting
//==============================================//

function my_formatter($content) {
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
	
	foreach ($pieces as $piece) {
	if (preg_match($pattern_contents, $piece, $matches)) {
	$new_content .= $matches[1];
	} else {
	$new_content .= wptexturize(wpautop($piece));
	}
	}
	
	return $new_content;
}

remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

add_filter('the_content', 'my_formatter', 99);




//==============================================//
// LAYOUT COLUMNS SHORTCODES
//==============================================//


function pt_fullwidth($atts, $content = null) {
	extract(shortcode_atts(array(
		"content_align" => ''
	), $atts));
	
	return '[raw]<div class="fullwidthCol content_'.$content_align.'">[/raw]'. do_shortcode($content) .'[raw]<div class="clear"></div></div>[/raw]';
}
add_shortcode("fullwidth", "pt_fullwidth");


function pt_one_half($atts, $content = null) {
	extract(shortcode_atts(array(
		"content_align" => ''
	), $atts));
	
	return '[raw]<div class="one_half content_'.$content_align.'">[/raw]'. do_shortcode($content) .'[raw]</div>[/raw]';
}
add_shortcode("one_half", "pt_one_half");


function pt_one_half_last($atts, $content = null) {
	extract(shortcode_atts(array(
		"content_align" => ''
	), $atts));
	
	return '[raw]<div class="one_half_last content_'.$content_align.'">[/raw]'. do_shortcode($content) .'[raw]</div><div class="clear"></div>[/raw]';
}
add_shortcode("one_half_last", "pt_one_half_last");


/////////////////////////////////////////////////////


function pt_one_third($atts, $content = null) {
	extract(shortcode_atts(array(
		"content_align" => ''
	), $atts));
	
	return '[raw]<div class="one_third content_'.$content_align.'">[/raw]'. do_shortcode($content) .'[raw]</div>[/raw]';
}
add_shortcode("one_third", "pt_one_third");


function pt_one_third_last($atts, $content = null) {
	extract(shortcode_atts(array(
		"content_align" => ''
	), $atts));
	
	return '[raw]<div class="one_third_last content_'.$content_align.'">[/raw]'. do_shortcode($content) .'[raw]</div><div class="clear"></div>[/raw]';
}
add_shortcode("one_third_last", "pt_one_third_last");


/////////////////////////////////////////////////////


function pt_one_fourth($atts, $content = null) {
	extract(shortcode_atts(array(
		"content_align" => ''
	), $atts));
	
	return '[raw]<div class="one_fourth content_'.$content_align.'">[/raw]'. do_shortcode($content) .'[raw]</div>[/raw]';
}
add_shortcode("one_fourth", "pt_one_fourth");


function pt_one_fourth_last($atts, $content = null) {
	extract(shortcode_atts(array(
		"content_align" => ''
	), $atts));
	
	return '[raw]<div class="one_fourth_last content_'.$content_align.'">[/raw]'. do_shortcode($content) .'[raw]</div><div class="clear"></div>[/raw]';
}
add_shortcode("one_fourth_last", "pt_one_fourth_last");


/////////////////////////////////////////////////////


function pt_one_fifth($atts, $content = null) {
	extract(shortcode_atts(array(
		"content_align" => ''
	), $atts));
	
	return '[raw]<div class="one_fifth content_'.$content_align.'">[/raw]'. do_shortcode($content) .'[raw]</div>[/raw]';
}
add_shortcode("one_fifth", "pt_one_fifth");


function pt_one_fifth_last($atts, $content = null) {
	extract(shortcode_atts(array(
		"content_align" => ''
	), $atts));
	
	return '[raw]<div class="one_fifth_last content_'.$content_align.'">[/raw]'. do_shortcode($content) .'[raw]</div><div class="clear"></div>[/raw]';
}
add_shortcode("one_fifth_last", "pt_one_fifth_last");


/////////////////////////////////////////////////////


function pt_one_sixth($atts, $content = null) {
	extract(shortcode_atts(array(
		"content_align" => ''
	), $atts));
	
	return '[raw]<div class="one_sixth content_'.$content_align.'">[/raw]'. do_shortcode($content) .'[raw]</div>[/raw]';
}
add_shortcode("one_sixth", "pt_one_sixth");


function pt_one_sixth_last($atts, $content = null) {
	extract(shortcode_atts(array(
		"content_align" => ''
	), $atts));
	
	return '[raw]<div class="pt_one_sixth_last content_'.$content_align.'">[/raw]'. do_shortcode($content) .'[raw]</div><div class="clear"></div>[/raw]';
}
add_shortcode("one_sixth_last", "pt_one_sixth_last");


/////////////////////////////////////////////////////


function pt_three_fourth($atts, $content = null) {
	extract(shortcode_atts(array(
		"content_align" => ''
	), $atts));
	
	return '[raw]<div class="three_fourth content_'.$content_align.'">[/raw]'. do_shortcode($content) .'[raw]</div>[/raw]';
}
add_shortcode("three_fourth", "pt_three_fourth");


function pt_three_fourth_last($atts, $content = null) {
	extract(shortcode_atts(array(
		"content_align" => '',
	), $atts));
	
	return '[raw]<div class="three_fourth_last content_'.$content_align.'">[/raw]'. do_shortcode($content) .'[raw]</div><div class="clear"></div>[/raw]';
}
add_shortcode("three_fourth_last", "pt_three_fourth_last");


/////////////////////////////////////////////////////


function pt_two_third($atts, $content = null) {
	extract(shortcode_atts(array(
		"content_align" => ''
	), $atts));
	
	return '[raw]<div class="two_third content_'.$content_align.'">[/raw]'. do_shortcode($content) .'[raw]</div>[/raw]';
}
add_shortcode("two_third", "pt_two_third");


function pt_two_third_last($atts, $content = null) {
	extract(shortcode_atts(array(
		"content_align" => ''
	), $atts));
	
	return '[raw]<div class="two_third_last content_'.$content_align.'">[/raw]'. do_shortcode($content) .'[raw]</div><div class="clear"></div>[/raw]';
}
add_shortcode("two_third_last", "pt_two_third_last");




//==============================================//
// TYPOGRAPHY SHORTCODES
//==============================================//


function pt_pullquote_r($atts, $content = null) {
	extract(shortcode_atts(array(
		"align" => ''
	), $atts));
	
	return '[raw]<blockquote class="pullquote alignright">'. do_shortcode($content) .'</blockquote>[/raw]';
}
add_shortcode("pullquote_r", "pt_pullquote_r");


function pt_pullquote_l($atts, $content = null) {
	extract(shortcode_atts(array(
		"align" => '',
	), $atts));
	
	return '[raw]<blockquote class="pullquote alignleft">'. do_shortcode($content) .'</blockquote>[/raw]';
}
add_shortcode("pullquote_l", "pt_pullquote_l");


/////////////////////////////////////////////////


function pt_blockquote($atts, $content = null) {
	
	return '[raw]<blockquote>'. do_shortcode($content) .'</blockquote>[/raw]';
}
add_shortcode("blockquote", "pt_blockquote");


/////////////////////////////////////////////////


function pt_htext($atts, $content = null) {
	
	return '<span class="highlightedText">'. do_shortcode($content) .'</span>';
}
add_shortcode("highlighted", "pt_htext");


/////////////////////////////////////////////////


function pt_dropcap($atts, $content = null) {
	
	return '<span class="dropcap">'. do_shortcode($content) .'</span>';
}
add_shortcode("dropcap", "pt_dropcap");




//==============================================//
// BUTTONS SHORTCODES
//==============================================//


function pt_button($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" => 'http://',
		"color" => 'orange',
		"target" => '',
		"liquid" => ''
	), $atts));
	
	if( $liquid == 'yes' ){
		$btn_liquid = ' liquid';
	} else {
		$btn_liquid = '';
	}
	
	if( $target != '' ){
		$btn_target = ' target="_blank"';
	} else {
		$btn_target = '';
	}
	
	return '[raw]<a href="'.$url.'" class="pt_btn '.$color.'_btn'.$btn_liquid.'"'.$btn_target.'>'.$content.'</a>[/raw]';
}
add_shortcode("button", "pt_button");




//==============================================//
// DIVIDERS
//==============================================//


function pt_divider () {
	
	return '<div class="hdivider"><hr/></div>';
}
add_shortcode("divider", "pt_divider");


///////////////////////////////////////////////////


function pt_divider_top () {
	
	return '<div class="hdivider"><a href="#main_container">Top</a><hr/><div class="clear"></div></div>';
}
add_shortcode("divider_top", "pt_divider_top");


///////////////////////////////////////////////////


function pt_hspace () {
	
	return '<div class="hspace"><hr/></div>';
}
add_shortcode("hspace", "pt_hspace");




//==============================================//
// LISTS
//==============================================//


function pt_list($atts, $content = null) {
	extract(shortcode_atts(array(
		"type" => ''
	), $atts));
	
	return '<ul class="list '.$type.'">'. do_shortcode($content) .'</ul>';
}
add_shortcode("list", "pt_list");


///////////////////////////////////////////////////


function pt_list_item ($atts, $content = null) {
	
	return '<li>'. do_shortcode($content) .'</li>';
}
add_shortcode("item", "pt_list_item");




//==============================================//
// ACCORDIONS
//==============================================//


function pt_acc ($atts, $content = null) {
		
	return '[raw]<div class="accordion">[/raw]'. do_shortcode($content) .'[raw]</div>[/raw]';
}
add_shortcode("accordion", "pt_acc");


///////////////////////////////////////////////////


function pt_panel ($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => ''
	), $atts));

	return '[raw]<div class="accHead">[/raw]'.$title.'[raw]</div>[/raw][raw]<div class="accBody">[/raw]'. do_shortcode($content) .'[raw]</div>[/raw]';
}
add_shortcode("panel", "pt_panel");




//==============================================//
// TABS
//==============================================//


$i = 0;
function pt_tabs( $atts, $content = null ) {
	global $i;
	extract(shortcode_atts(array(), $atts));

	
	$output = '[raw]<div class="tabs">[/raw]';
	
	$output .= '[raw]<ul class="tabset">[/raw]';
	foreach ($atts as $tab) {
		$tabID = "tab-" . $i++;
		$output .= '[raw]<li><a href="#' . $tabID . '" class="tab">' .$tab. '</a></li>[/raw]';
	}
	$output .= '[raw]<li class="clear"></li></ul>[/raw]';

	$output .= do_shortcode($content) .'[raw]</div>[/raw]';
	
	return $output;
	
}
add_shortcode('tabs', 'pt_tabs');


///////////////////////////////////////////////////


$j = 0;
function pt_tab( $atts, $content = null ) {
	global $j;
	extract(shortcode_atts(array(), $atts));
	$tabID = "tab-" . $j++;
	$output = '[raw]<div id="' . $tabID . '" class="tabContent">[/raw]' . do_shortcode($content) .'[raw]</div>[/raw]';
	
	return $output;
}
add_shortcode('tab', 'pt_tab');




//==============================================//
// TESTIMONIALS
//==============================================//

function pt_testimonial ($atts, $content = null) {
	extract(shortcode_atts(array(
		"author" => ''
	), $atts));

	return '[raw]<blockquote class="testimonial">[/raw]'. do_shortcode($content) .'[raw]<footer class="testimonialAuthor">' .$author. '</footer></blockquote>[/raw]';
}
add_shortcode("testimonial", "pt_testimonial");




//==============================================//
// NOTIFICATION BOXES
//==============================================//


function pt_box ($atts, $content = null) {
	extract(shortcode_atts(array(
		"type" => ''
	), $atts));
	
	return '[raw]<div class="box '.$type.'Box">[/raw]'. do_shortcode($content) .'[raw]</div>[/raw]';
	
}
add_shortcode("box", "pt_box");




//==============================================//
// SERVICE/FEATURE
//==============================================//


function pt_service($atts, $content = null) {  
      extract(shortcode_atts(array(  
            'icon' => '',
            'title' => '',
            'layout' => ''
        ), $atts));
        
        if($title != ''){
        $serviceTitle = '<h2>'.$title.'</h2>';
        }
        else {
        $serviceTitle = '';
        }
        
        if (preg_match('/_b$/', $icon)) {
		$size= 'large';
		} else {
		$size= 'small';
		}
		
		if( of_get_option('skin_color') == 'dark' ){
		$icon = $icon.'_w';
		}
        
        return '[raw]<div class="pt_service service_'.$layout.' service_'.$size.'"><img class="pt_icon_'.$layout.'" alt="" src="'. PT_INDEX .'/images/icons/'.$icon.'.png"/>'.$serviceTitle.'[/raw]'. do_shortcode($content) .'[raw]<div class="clear"></div></div>[/raw]';  
}  
add_shortcode("service", "pt_service");




//==============================================//
// PRICE LABEL
//==============================================//


function pt_price_label($atts, $content = null) {  
      extract(shortcode_atts(array(  
            'size' => '',
            'featured' => '',
            'title' => '',
            'price' => '',
            'suffix' => ''
        ), $atts));
        
        if( $suffix != '' ){
        $price_suffix = ' <span>'.$suffix.'</span>';
        }else{
        $price_suffix = '';
        }
        
        if( $featured == 'yes' ){
        $featuredClass = ' priceFeatured';
        }else{
        $featuredClass = '';
        }
        
        return '[raw]<div class="priceLabel '.$size.'_label'.$featuredClass.'"><div class="labelWrap"><div class="labelTitle">'.$title.'</div><div class="labelPrice">'.$price.$price_suffix.'</div><div class="labelContent">[/raw]'. do_shortcode($content) .'[raw]</div></div></div>[/raw]';  
}  
add_shortcode("price_label", "pt_price_label");




//==============================================//
// IMAGES
//==============================================//


function pt_img ($atts, $content = null) {
	extract(shortcode_atts(array(
		"path" => '',
		"width" => '',
		"height" => '',
		"frame" => '',
		"align" => '',
		"title" => '',
		"alt" => '',
		"link" => ''
	), $atts));

	$imgPath = vt_resize( '', $path, $width, $height, true );
	$lightboxPath = pt_get_image_path($path);
	
	$linkWidth = $width;
	
	if( $frame == 'yes' ){ $width = $width - 8; $height = $height - 8; }
	
	if( $frame == 'yes' ){ $frameClass = ' frame'; }else{ $frameClass = ''; }
	
	if( $link != '' ):
		if( $path == $link ):
			
			return '[raw]<a class="'.$align.'" title="'.$title.'" href="'.$lightboxPath.'" rel="prettyPhoto" style="width: '.$linkWidth.'px;"><img class="pt-img'.$frameClass.'" src="'.$imgPath['url'].'" width="'.$imgPath['width'].'" height="'.$imgPath['height'].'" alt="'.$alt.'"/></a>[/raw]';
			
		else:
			
			return '[raw]<a class="'.$align.'" title="'.$title.'" href="'.$link.'" style="width: '.$linkWidth.'px;"><img class="pt-img'.$frameClass.'" src="'.$imgPath['url'].'" width="'.$imgPath['width'].'" height="'.$imgPath['height'].'" alt="'.$alt.'"/></a>[/raw]';
			
		endif;
	else:
		
		return '[raw]<img class="pt-img '.$align.$frameClass.'" src="'.$imgPath['url'].'" width="'.$imgPath['width'].'" height="'.$imgPath['height'].'" alt="'.$alt.'" title="'.$title.'"/>[/raw]';
		
	endif;
}
add_shortcode("image", "pt_img");




//==============================================//
// POPUP LIGHTBOX
//==============================================//


function pt_popup($atts, $content = null) {
    extract(shortcode_atts(array(
		"id" => '',
		"text" => '',
		"color" => ''
	), $atts));
    
	return '[raw]<a href="#" class="pt_btn '.$color.'_btn" data-reveal-id="'.$id.'" data-animation="fadeAndPop" data-animationspeed="300" data-closeonbackgroundclick="true" data-dismissmodalclass="close-reveal-modal">'.$text.'</a><div id="'.$id.'" class="reveal-modal">[/raw]'. do_shortcode($content) .'[raw]<a class="close-reveal-modal">&#215;</a></div>[/raw]';
}

add_shortcode("popup", "pt_popup");




//==============================================//
// IMAGE SLIDER
//==============================================//


function pt_slider($atts, $content = null) {  
	extract(shortcode_atts(array(
		"width" => '',
		"height" => ''
	), $atts));
	
	return '[raw]<div class="general-nivo" style="width: '.$width.'px; height: '.$height.'px;">[/raw]'. do_shortcode($content) .'[raw]</div>[/raw]';  
}  
add_shortcode("slider", "pt_slider");


function pt_slide($atts, $content = null) {  
    extract(shortcode_atts(array(
		"path" => '',
		"width" => '',
		"height" => ''
	), $atts));
	
	$imgPath = vt_resize( '', $path, $width, $height, true );
	$lightboxPath = pt_get_image_path($path);
	
	return '[raw]<a title="" href="'.$lightboxPath.'" rel="prettyPhoto"><img src="'.$imgPath['url'].'" width="'.$imgPath['width'].'" height="'.$imgPath['height'].'" alt=""/></a>[/raw]';  
}  
add_shortcode("slide", "pt_slide");



