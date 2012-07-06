<?php require_once('config.php');
if ( !is_user_logged_in() || !current_user_can('edit_posts') ) wp_die(__('You are not allowed to be here', 'premitheme')); ?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php _e('Premitheme Shortcodes', 'premitheme');?></title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />

<script language="javascript" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/functions/shortcodes/shortcodes-scripts.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/functions/shortcodes/send_to_editor.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>

<base target="_self" />
<link href="<?php echo get_template_directory_uri() ?>/functions/shortcodes/style.css" rel="stylesheet" type="text/css" />
</head>
<body onLoad="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';" id="link">
<form name="pt_shortcode_form" action="#">

<div id="shortcode_wrap">
<div id="shortcode_panel" class="current">
<fieldset style="border:0;">

<h2><?php _e('Select Shortcode', 'premitheme');?></h2>

<div class="row">
	<label for="scSelect"><?php _e('Shortcode', 'premitheme');?></label>
	<select id="scSelect" name="scSelect">
		<option value="0" style="font-weight:bold;font-style:italic;"><?php _e('Select Option &hellip;', 'premitheme');?></option>
		<option value="scColumn"><?php _e('Layout Columns', 'premitheme');?></option>
		<option value="scTypography"><?php _e('Typography', 'premitheme');?></option>
		<option value="scButton"><?php _e('Button', 'premitheme');?></option>
		<option value="scDivider"><?php _e('Divider', 'premitheme');?></option>
		<option value="scList"><?php _e('List', 'premitheme');?></option>
		<option value="scAccordion"><?php _e('Accordion', 'premitheme');?></option>
		<option value="scTabs"><?php _e('Tabs', 'premitheme');?></option>
		<option value="scImage"><?php _e('Image', 'premitheme');?></option>
		<option value="scVideo"><?php _e('Video', 'premitheme');?></option>
		<option value="scTestimonial"><?php _e('Testimonial', 'premitheme');?></option>
		<option value="scNotification"><?php _e('Notification Box', 'premitheme');?></option>
		<option value="scService"><?php _e('Service/Feature Block', 'premitheme');?></option>
		<option value="scSlider"><?php _e('Image Slider', 'premitheme');?></option>
		<option value="scPopup"><?php _e('Popup Box (lightbox)', 'premitheme');?></option>
		<option value="scPrice"><?php _e('Price Label', 'premitheme');?></option>
	</select>
	<div class="clear"></div>
</div>

<div id="scColumn">
	<h2><?php _e('Layout Columns Shortcode', 'premitheme');?></h2>
	<div class="row">
		<label for="columnLayout"><?php _e('layout', 'premitheme');?></label>
		<select id="columnLayout" name="columnLayout">
			<option value="0" style="font-weight:bold;font-style:italic;"><?php _e('Select Option &hellip;', 'premitheme');?></option>
			<option value="fullwidth_column"><?php _e('Full-width Column', 'premitheme');?></option>
			<option value="two_columns"><?php _e('2 Columns', 'premitheme');?></option>
			<option value="three_columns"><?php _e('3 Columns', 'premitheme');?></option>
			<option value="four_columns"><?php _e('4 Columns', 'premitheme');?></option>
			<option value="five_columns"><?php _e('5 Columns', 'premitheme');?></option>
			<option value="six_columns"><?php _e('6 Columns', 'premitheme');?></option>
			<option value="one_fourth_three_fourth_columns"><?php _e('1/4 + 3/4', 'premitheme');?></option>
			<option value="three_fourth_one_fourth_columns"><?php _e('3/4 + 1/4', 'premitheme');?></option>
			<option value="one_third_two_third_columns"><?php _e('1/3 + 2/3', 'premitheme');?></option>
			<option value="two_third_one_third_columns"><?php _e('2/3 + 1/3', 'premitheme');?></option>
			<option value="one_fourth_one_half_one_fourth_columns"><?php _e('1/4 + 1/2 + 1/4', 'premitheme');?></option>
			<option value="one_half_one_fourth_one_fourth_columns"><?php _e('1/2 + 1/4 + 1/4', 'premitheme');?></option>
			<option value="one_fourth_one_fourth_one_half_columns"><?php _e('1/4 + 1/4 + 1/2', 'premitheme');?></option>
		</select>
		<div class="clear"></div>
	</div>
	<p class="insertNotice"><?php _e('Select layout and "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scTypography">
	<h2><?php _e('Typography Shortcode', 'premitheme');?></h2>
	<div class="row">
		<label for="typoElement"><?php _e('Element', 'premitheme');?></label>
		<select id="typoElement" name="typoElement">
			<option value="0" style="font-weight:bold;font-style:italic;"><?php _e('Select Option &hellip;', 'premitheme');?></option>
			<option value="typoHighlighted"><?php _e('Highlighted Text', 'premitheme');?></option>
			<option value="typoDropcap"><?php _e('Dropcap Letter', 'premitheme');?></option>
			<option value="typoBlockquote"><?php _e('Blockquote', 'premitheme');?></option>
			<option value="typoPullquoteLeft"><?php _e('Pullquote - Left Aligned', 'premitheme');?></option>
			<option value="typoPullquoteRight"><?php _e('Pullquote - Right Aligned', 'premitheme');?></option>
		</select>
		<div class="clear"></div>
	</div>
	<p class="insertNotice"><?php _e('Select element and "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scButton">
	<h2><?php _e('Button Shortcode', 'premitheme');?></h2>
	<div class="row">
		<label for="btnColor"><?php _e('Button Color', 'premitheme');?></label>
		<select id="btnColor" name="btnColor">
			<option value="0" style="font-weight:bold;font-style:italic;"><?php _e('Select Option &hellip;', 'premitheme');?></option>
			<option value="turquoise"><?php _e('Turquoise', 'premitheme');?></option>
			<option value="orange"><?php _e('Orange', 'premitheme');?></option>
			<option value="pink"><?php _e('Pink', 'premitheme');?></option>
			<option value="blue"><?php _e('Blue', 'premitheme');?></option>
			<option value="brown"><?php _e('Brown', 'premitheme');?></option>
			<option value="green"><?php _e('Green', 'premitheme');?></option>
			<option value="purple"><?php _e('Purple', 'premitheme');?></option>
			<option value="gray"><?php _e('Light Gray', 'premitheme');?></option>
			<option value="dark_gray"><?php _e('Dark Gray', 'premitheme');?></option>
		</select>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="btnText"><?php _e('Button Text', 'premitheme');?></label>
		<input id="btnText" name="btnText" type="text" value="<?php _e('Sample Link', 'premitheme');?>"/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="btnUrl"><?php _e('Button URL', 'premitheme');?></label>
		<input id="btnUrl" name="btnUrl" type="text" value="http://"/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="btnLiquid" class="for_checkbox"><?php _e('Liquid Width', 'premitheme');?></label>
		<input id="btnLiquid" class="checkbox" name="btnLiquid" type="checkbox"/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="btnTarget" class="for_checkbox"><?php _e('Open Link in New Window', 'premitheme');?></label>
		<input id="btnTarget" class="checkbox" name="btnTarget" type="checkbox"/>
		<div class="clear"></div>
	</div>
	
	<p class="insertNotice"><?php _e('Customize and "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scDivider">
	<h2><?php _e('Divider Shortcode', 'premitheme');?></h2>
	<div class="row">
		<label for="divType"><?php _e('Type', 'premitheme');?></label>
		<select id="divType" name="divType">
			<option value="0" style="font-weight:bold;font-style:italic;"><?php _e('Select Option &hellip;', 'premitheme');?></option>
			<option value="divNormal"><?php _e('Standard Divider', 'premitheme');?></option>
			<option value="divTop"><?php _e('Standard Divider with Top Link', 'premitheme');?></option>
			<option value="divSpace"><?php _e('Horizontal space', 'premitheme');?></option>
		</select>
		<div class="clear"></div>
	</div>
	<p class="insertNotice"><?php _e('Select type and "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scList">
	<h2><?php _e('List Shortcode', 'premitheme');?></h2>
	<div class="row">
		<label for="listType"><?php _e('List Type', 'premitheme');?></label>
		<select id="listType" name="listType">
			<option value="0" style="font-weight:bold;font-style:italic;"><?php _e('Select Option &hellip;', 'premitheme');?></option>
			<option value="arrow"><?php _e('Arrow List', 'premitheme');?></option>
			<option value="check"><?php _e('Check List', 'premitheme');?></option>
			<option value="square"><?php _e('Square List', 'premitheme');?></option>
			<option value="circle"><?php _e('Circle List', 'premitheme');?></option>
		</select>
		<div class="clear"></div>
	</div>
	<p class="insertNotice"><?php _e('Select type and "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scAccordion">
	<h2><?php _e('Accordion Shortcode', 'premitheme');?></h2>
	<p class="insertNotice"><?php _e('Now "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scTabs">
	<h2><?php _e('Tabs Shortcode', 'premitheme');?></h2>
	<p class="insertNotice"><?php _e('Now "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scImage">
	<h2><?php _e('Image Shortcode', 'premitheme');?></h2>
	<div class="row">
		<label for="imgPath"><?php _e('Image Path', 'premitheme');?></label>
		<input id="imgPath" name="imgPath" type="text" value=""/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="imgWidth"><?php _e('Image Width in Pixels', 'premitheme');?></label>
		<input id="imgWidth" name="imgWidth" type="text" value=""/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="imgHeight"><?php _e('Image Height in Pixels', 'premitheme');?></label>
		<input id="imgHeight" name="imgHeight" type="text" value=""/>
		<div class="clear"></div>
		<p>Leave height empty for auto height</p>
	</div>
	
	<div class="row">
		<label for="imgAlt"><?php _e('Alt Attribute Text', 'premitheme');?></label>
		<input id="imgAlt" name="imgAlt" type="text" value=""/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="imgTitle"><?php _e('Title Attribute Text', 'premitheme');?></label>
		<input id="imgTitle" name="imgTitle" type="text" value=""/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="imgAlign"><?php _e('Align', 'premitheme');?></label>
		<select id="imgAlign" name="imgAlign">
			<option value="alignnone"><?php _e('None', 'premitheme');?></option>
			<option value="alignleft"><?php _e('Left', 'premitheme');?></option>
			<option value="alignright"><?php _e('Right', 'premitheme');?></option>
			<option value="aligncenter"><?php _e('Center', 'premitheme');?></option>
		</select>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="imgLink"><?php _e('Link URL (optional)', 'premitheme');?></label>
		<input id="imgLink" name="imgLink" type="text" value=""/>
		<div class="clear"></div>
		<p>Insert the same image path to open in lightbox</p>
	</div>
	
	<div class="row">
		<label for="imgFrame" class="for_checkbox"><?php _e('Image with frame', 'premitheme');?></label>
		<input id="imgFrame" class="checkbox" name="imgFrame" type="checkbox" checked="checked"/>
		<div class="clear"></div>
	</div>
	
	<p class="insertNotice"><?php _e('Customize and "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scVideo">
	<h2><?php _e('Video Shortcode', 'premitheme');?></h2>
	<div class="row">
		<label for="vidUrl"><?php _e('Video URL', 'premitheme');?></label>
		<input id="vidUrl" name="vidUrl" type="text" value=""/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="vidWidth"><?php _e('Video Width in Pixels', 'premitheme');?></label>
		<input id="vidWidth" name="vidWidth" type="text" value=""/>
		<div class="clear"></div>
	</div>
	<p>Leave width empty for full width. <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F"><?php _e('List of supported video types', 'premitheme');?></a></p>
	
	<p class="insertNotice"><?php _e('Customize and "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scTestimonial">
	<h2><?php _e('Testimonial Shortcode', 'premitheme');?></h2>
	<p class="insertNotice"><?php _e('Now "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scNotification">
	<h2><?php _e('Notification Box Shortcode', 'premitheme');?></h2>
	<div class="row">
		<label for="boxType"><?php _e('Message Type', 'premitheme');?></label>
		<select id="boxType" name="boxType">
			<option value="0" style="font-weight:bold;font-style:italic;"><?php _e('Select Option &hellip;', 'premitheme');?></option>
			<option value="success"><?php _e('Success', 'premitheme');?></option>
			<option value="error"><?php _e('Error', 'premitheme');?></option>
			<option value="warning"><?php _e('Warning', 'premitheme');?></option>
			<option value="idea"><?php _e('Idea', 'premitheme');?></option>
			<option value="info"><?php _e('Info', 'premitheme');?></option>
			<option value="general"><?php _e('General (no icon)', 'premitheme');?></option>
		</select>
		<div class="clear"></div>
	</div>
	<p class="insertNotice"><?php _e('Select type and "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scService">
	<h2><?php _e('Service/Feature Block Shortcode', 'premitheme');?></h2>
	<div class="row">
		<label for="iconType"><?php _e('Icon', 'premitheme');?>
		<div class="help">
			<img title="Icons Guide" alt="Help" src="<?php echo get_template_directory_uri() ?>/functions/shortcodes/images/help.png" />
			<div class="help_popup">
				<p><?php _e('Icons Guide', 'premitheme');?>:</p>
				<img alt="" src="<?php echo get_template_directory_uri() ?>/functions/shortcodes/images/icons_guide.png" />
			</div>
		</div>
		</label>
		<select id="iconType" name="iconType">
			<option value="0" style="font-weight:bold;font-style:italic;"><?php _e('Select Option &hellip;', 'premitheme');?></option>
			<option value="0" style="font-weight:bold;font-style:italic;"></option>
			<option value="0" style="font-weight:bold;font-style:italic;">--- <?php _e('Small Size', 'premitheme');?> ---</option>
			<option value="clock_icon"><?php _e('1- Clock Icon (small)', 'premitheme');?></option>
			<option value="tag_icon"><?php _e('2- Tag/Label Icon (small)', 'premitheme');?></option>
			<option value="globe_icon"><?php _e('3- Globe Icon (small)', 'premitheme');?></option>
			<option value="magn_icon"><?php _e('4- Magnifier (small)', 'premitheme');?></option>
			<option value="gear_icon"><?php _e('5- Gear Icon (small)', 'premitheme');?></option>
			<option value="rss_icon"><?php _e('6- RSS Icon (small)', 'premitheme');?></option>
			<option value="screen_icon"><?php _e('7- Screen/Computer Icon (small)', 'premitheme');?></option>
			<option value="message_icon"><?php _e('8- Message/Envelope Icon (small)', 'premitheme');?></option>
			<option value="add_icon"><?php _e('9- Add/Plus Icon (small)', 'premitheme');?></option>
			<option value="stat_icon"><?php _e('10- Statistics/Chart Icon (small)', 'premitheme');?></option>
			<option value="check_icon"><?php _e('11- Check/Success Icon (small)', 'premitheme');?></option>
			<option value="food_icon"><?php _e('12- Food/Restaurants Icon (small)', 'premitheme');?></option>
			<option value="flag_icon"><?php _e('13- Flag Icon (small)', 'premitheme');?></option>
			<option value="cal_icon"><?php _e('14- Calendar Icon (small)', 'premitheme');?></option>
			<option value="inbox_icon"><?php _e('15- Inbox Icon (small)', 'premitheme');?></option>
			<option value="refresh_icon"><?php _e('16- Refresh Icon (small)', 'premitheme');?></option>
			<option value="speaker_icon"><?php _e('17- Speaker Icon (small)', 'premitheme');?></option>
			<option value="doc_icon"><?php _e('18- Document/Paper Icon (small)', 'premitheme');?></option>
			<option value="home_icon"><?php _e('19- Home Icon (small)', 'premitheme');?></option>
			<option value="info_icon"><?php _e('20- Information Icon (small)', 'premitheme');?></option>
			<option value="shield_icon"><?php _e('21- Shield Icon (small)', 'premitheme');?></option>
			<option value="help_icon"><?php _e('22- Help Icon (small)', 'premitheme');?></option>
			<option value="task_icon"><?php _e('23- Task List Icon (small)', 'premitheme');?></option>
			<option value="vcard_icon"><?php _e('24- VCard Icon (small)', 'premitheme');?></option>
			<option value="0" style="font-weight:bold;font-style:italic;"></option>
			<option value="0" style="font-weight:bold;font-style:italic;">--- <?php _e('Large Size', 'premitheme');?> ---</option>
			<option value="clock_icon_b"><?php _e('1- Clock Icon (large)', 'premitheme');?></option>
			<option value="tag_icon_b"><?php _e('2- Tag/Label Icon (large)', 'premitheme');?></option>
			<option value="globe_icon_b"><?php _e('3- Globe Icon (large)', 'premitheme');?></option>
			<option value="magn_icon_b"><?php _e('4- Magnifier (large)', 'premitheme');?></option>
			<option value="gear_icon_b"><?php _e('5- Gear Icon (large)', 'premitheme');?></option>
			<option value="rss_icon_b"><?php _e('6- RSS Icon (large)', 'premitheme');?></option>
			<option value="screen_icon_b"><?php _e('7- Screen/Computer Icon (large)', 'premitheme');?></option>
			<option value="message_icon_b"><?php _e('8- Message/Envelope Icon (large)', 'premitheme');?></option>
			<option value="add_icon_b"><?php _e('9- Add/Plus Icon (large)', 'premitheme');?></option>
			<option value="stat_icon_b"><?php _e('10- Statistics/Chart Icon (large)', 'premitheme');?></option>
			<option value="check_icon_b"><?php _e('11- Check/Success Icon (large)', 'premitheme');?></option>
			<option value="food_icon_b"><?php _e('12- Food/Restaurants Icon (large)', 'premitheme');?></option>
			<option value="flag_icon_b"><?php _e('13- Flag Icon (large)', 'premitheme');?></option>
			<option value="cal_icon_b"><?php _e('14- Calendar Icon (large)', 'premitheme');?></option>
			<option value="inbox_icon_b"><?php _e('15- Inbox Icon (large)', 'premitheme');?></option>
			<option value="refresh_icon_b"><?php _e('16- Refresh Icon (large)', 'premitheme');?></option>
			<option value="speaker_icon_b"><?php _e('17- Speaker Icon (large)', 'premitheme');?></option>
			<option value="doc_icon_b"><?php _e('18- Document/Paper Icon (large)', 'premitheme');?></option>
			<option value="home_icon_b"><?php _e('19- Home Icon (large)', 'premitheme');?></option>
			<option value="info_icon_b"><?php _e('20- Information Icon (large)', 'premitheme');?></option>
			<option value="shield_icon_b"><?php _e('21- Shield Icon (large)', 'premitheme');?></option>
			<option value="help_icon_b"><?php _e('22- Help Icon (large)', 'premitheme');?></option>
			<option value="task_icon_b"><?php _e('23- Task List Icon (large)', 'premitheme');?></option>
			<option value="vcard_icon_b"><?php _e('24- VCard Icon (large)', 'premitheme');?></option>
		</select>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="serviceTitle"><?php _e('Service/Feature Title', 'premitheme');?></label>
		<input id="serviceTitle" name="serviceTitle" type="text" value="Sample title"/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="iconLayout"><?php _e('Layout', 'premitheme');?></label>
		<select id="iconLayout" name="iconLayout">
			<option value="left" style="font-weight:bold;font-style:italic;"><?php _e('Select Option &hellip;', 'premitheme');?></option>
			<option value="left"><?php _e('Icon on left', 'premitheme');?></option>
			<option value="right"><?php _e('Icon on right', 'premitheme');?></option>
			<option value="center"><?php _e('Icon on top', 'premitheme');?></option>
		</select>
		<div class="clear"></div>
	</div>
	
	<p class="insertNotice"><?php _e('Customize and "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scSlider">
	<h2><?php _e('Image Slider Shortcode', 'premitheme');?></h2>
	<div class="row">
		<label for="sliderWidth"><?php _e('Slider Width in Pixels', 'premitheme');?></label>
		<input id="sliderWidth" name="sliderWidth" type="text" value=""/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="sliderHeight"><?php _e('Slider Height in Pixels', 'premitheme');?></label>
		<input id="sliderHeight" name="sliderHeight" type="text" value=""/>
		<div class="clear"></div>
	</div>
	<p class="insertNotice"><?php _e('Customize and "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scPopup">
	<h2><?php _e('Popup Box Shortcode', 'premitheme');?></h2>
	<div class="row">
		<label for="popupColor"><?php _e('Trigger Button Color', 'premitheme');?></label>
		<select id="popupColor" name="popupColor">
			<option value="0" style="font-weight:bold;font-style:italic;"><?php _e('Select Option &hellip;', 'premitheme');?></option>
			<option value="turquoise"><?php _e('Turquoise', 'premitheme');?></option>
			<option value="orange"><?php _e('Orange', 'premitheme');?></option>
			<option value="pink"><?php _e('Pink', 'premitheme');?></option>
			<option value="blue"><?php _e('Blue', 'premitheme');?></option>
			<option value="brown"><?php _e('Brown', 'premitheme');?></option>
			<option value="green"><?php _e('Green', 'premitheme');?></option>
			<option value="purple"><?php _e('Purple', 'premitheme');?></option>
			<option value="gray"><?php _e('Light Gray', 'premitheme');?></option>
			<option value="dark_gray"><?php _e('Dark Gray', 'premitheme');?></option>
		</select>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="popupText"><?php _e('Trigger Button Text', 'premitheme');?></label>
		<input id="popupText" name="popupText" type="text" value=""/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="popupId"><?php _e('Popup ID', 'premitheme');?></label>
		<input id="popupId" name="popupId" type="text" value=""/>
		<div class="clear"></div>
		<p>Must be unique ID, Don't use it in multiple popups</p>
	</div>
	<p class="insertNotice"><?php _e('Customize and "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scPrice">
	<h2><?php _e('Price Label Shortcode', 'premitheme');?></h2>
	<div class="row">
		<label for="colSize"><?php _e('Column Size', 'premitheme');?></label>
		<select id="colSize" name="colSize">
			<option value="0" style="font-weight:bold;font-style:italic;"><?php _e('Select Option...', 'premitheme');?></option>
			<option value="fullwidth"><?php _e('Full Width', 'premitheme');?></option>
			<option value="one_half"><?php _e('One Half', 'premitheme');?></option>
			<option value="one_third"><?php _e('One Third', 'premitheme');?></option>
			<option value="one_fourth"><?php _e('One Fourth', 'premitheme');?></option>
			<option value="one_fifth"><?php _e('One Fifth', 'premitheme');?></option>
			<option value="one_sixth"><?php _e('One Sixth', 'premitheme');?></option>
		</select>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="itemName"><?php _e('Item Name', 'premitheme');?></label>
		<input id="itemName" name="itemName" type="text" value=""/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="itemPrice"><?php _e('Item Price', 'premitheme');?></label>
		<input id="itemPrice" name="itemPrice" type="text" value=""/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="priceSuffix"><?php _e('Price Suffix (optional e.g "/month")', 'premitheme');?></label>
		<input id="priceSuffix" name="priceSuffix" type="text" value=""/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="itemFeatured" class="for_checkbox"><?php _e('Make this featured Item', 'premitheme');?></label>
		<input id="itemFeatured" class="checkbox" name="itemFeatured" type="checkbox"/>
		<div class="clear"></div>
	</div>	
	<p class="insertNotice"><?php _e('Customize and "Insert" the shortcode', 'premitheme');?></p>
</div>

</fieldset>
</div><!-- end shortcode_panel -->

<div class="buttons">
<img style="float:left" alt="" src="<?php echo get_template_directory_uri() ?>/functions/shortcodes/logo.png"/>
<div style="float:right"><input type="submit" id="insert" name="insert" value="<?php _e('Insert', 'premitheme');?>" onClick="embedshortcode();" /></div>
<div style="float:right; margin-right:10px;"><input type="button" id="cancel" name="cancel" value="<?php _e('Close', 'premitheme');?>" onClick="tinyMCEPopup.close();" /></div>
<div class="clear"></div>
</div>

</div><!-- end shortcode_wrap -->

</form>

</body>
</html>
