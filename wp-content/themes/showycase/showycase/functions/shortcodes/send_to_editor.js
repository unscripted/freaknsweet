function embedshortcode() {
	
	var shortcodeText;	
	var style = document.getElementById('shortcode_panel');
	

	if (style.className.indexOf('current') != -1) {
		
		// SHORTCODES SELEC MENU //
		var shortcodeSelect = document.getElementById('scSelect').value;
		
		
		// COLUMN //
		var columnLayout = document.getElementById('columnLayout').value;
		
		
		// TYPOGRAPHY //
		var typoElement = document.getElementById('typoElement').value;
		
		
		// BUTTON //
		var btnColor = document.getElementById('btnColor').value;
		var btnUrl = document.getElementById('btnUrl').value;
		var btnText = document.getElementById('btnText').value;
		
		if (document.getElementById('btnLiquid').checked) { var btnLiquid = "yes"; }
		else { var btnLiquid = "no"; }
		
		if (document.getElementById('btnTarget').checked) { var btnTarget = " target=\"new\""; }
		else { var btnTarget = ""; }
		
		
		// DIVIDER //
		var divType = document.getElementById('divType').value;
		
		
		// LIST //
		var listType = document.getElementById('listType').value;
		
		
		// VIDEO //
		var vidUrl = document.getElementById('vidUrl').value;
		var vidWidthVal = document.getElementById('vidWidth').value;
		
		if ( vidWidthVal != '') { var vidWidth = ' width="'+ vidWidthVal +'"'; }
		else { var vidWidth = ''; }
		
		
		// NOTIFICATION //
		var boxType = document.getElementById('boxType').value;
		
		
		// SERVICE //
		var iconType = document.getElementById('iconType').value;
		var iconLayout = document.getElementById('iconLayout').value;
		var serviceTitle = document.getElementById('serviceTitle').value;
		
		
		// PRICE LABEL //
		var colSize = document.getElementById('colSize').value;
		var itemName = document.getElementById('itemName').value;
		var itemPrice = document.getElementById('itemPrice').value;
		var priceSuffix = document.getElementById('priceSuffix').value;
		
		if (document.getElementById('itemFeatured').checked) { var itemFeatured = 'yes'; }
		else { var itemFeatured = 'no'; }
		
		
		// IMAGE //
		var imgPath = document.getElementById('imgPath').value;
		var imgHeight = document.getElementById('imgHeight').value;
		var imgWidth = document.getElementById('imgWidth').value;
		var imgTitle = document.getElementById('imgTitle').value;
		var imgAlt = document.getElementById('imgAlt').value;
		var imgAlign = document.getElementById('imgAlign').value;
		var imgLink = document.getElementById('imgLink').value;
		
		if (document.getElementById('imgFrame').checked) { var imgFrame = "yes"; }
		else { var imgFrame = "no"; }
		
		
		// IMAGE SLIDER //
		var sliderWidth = document.getElementById('sliderWidth').value;
		var sliderHeight = document.getElementById('sliderHeight').value;
		
		
		// POPUP LIGHTBOX //
		var popupID = document.getElementById('popupId').value;
		var popupText = document.getElementById('popupText').value;
		var popupColor = document.getElementById('popupColor').value;
		
		
		
//=================================//
// LAYOUT COLUMN SHORTCODE
//=================================//

if ( shortcodeSelect == 'scColumn' && columnLayout == 'fullwidth_column' ){
	shortcodeText = "[fullwidth content_align=\"left\"]<br />Fullwidth sample text...<br />[/fullwidth]";	
}


if ( shortcodeSelect == 'scColumn' && columnLayout == 'two_columns' ){
	shortcodeText = "[one_half content_align=\"left\"]<br />1/2 Sample text...<br />[/one_half]<br /><br />[one_half_last content_align=\"left\"]<br />1/2 Sample text...<br />[/one_half_last]";	
}


if ( shortcodeSelect == 'scColumn' && columnLayout == 'three_columns'){
	shortcodeText = "[one_third content_align=\"left\"]<br />1/3 Sample text...<br />[/one_third]<br /><br />[one_third content_align=\"left\"]<br />1/3 Sample text...<br />[/one_third]<br /><br />[one_third_last content_align=\"left\"]<br />1/3 Sample text...<br />[/one_third_last]";	
}


if ( shortcodeSelect == 'scColumn' && columnLayout == 'four_columns'){
	shortcodeText = "[one_fourth content_align=\"left\"]<br />1/4 Sample text...<br />[/one_fourth]<br /><br />[one_fourth content_align=\"left\"]<br />1/4 Sample text...<br />[/one_fourth]<br /><br />[one_fourth content_align=\"left\"]<br />1/4 Sample text...<br />[/one_fourth]<br /><br />[one_fourth_last content_align=\"left\"]<br />1/4 Sample text...<br />[/one_fourth_last]";	
}


if ( shortcodeSelect == 'scColumn' && columnLayout == 'five_columns'){
	shortcodeText = "[one_fifth content_align=\"left\"]<br />1/5 Sample text...<br />[/one_fifth]<br /><br />[one_fifth content_align=\"left\"]<br />1/5 Sample text...<br />[/one_fifth]<br /><br />[one_fifth content_align=\"left\"]<br />1/5 Sample text...<br />[/one_fifth]<br /><br />[one_fifth content_align=\"left\"]<br />1/5 Sample text...<br />[/one_fifth]<br /><br />[one_fifth_last content_align=\"left\"]<br />1/5 Sample text...<br />[/one_fifth_last]";	
}


if ( shortcodeSelect == 'scColumn' && columnLayout == 'six_columns'){
	shortcodeText = "[one_sixth content_align=\"left\"]<br />1/6 Sample text...<br />[/one_sixth]<br /><br />[one_sixth content_align=\"left\"]<br />1/6 Sample text...<br />[/one_sixth]<br /><br />[one_sixth content_align=\"left\"]<br />1/6 Sample text...<br />[/one_sixth]<br /><br />[one_sixth content_align=\"left\"]<br />1/6 Sample text...<br />[/one_sixth]<br /><br />[one_sixth content_align=\"left\"]<br />1/6 Sample text...<br />[/one_sixth]<br /><br />[one_sixth_last content_align=\"left\"]<br />1/6 Sample text...<br />[/one_sixth_last]";	
}


if ( shortcodeSelect == 'scColumn' && columnLayout == 'one_fourth_three_fourth_columns'){
	shortcodeText = "[one_fourth content_align=\"left\"]<br />1/4 Sample text...<br />[/one_fourth]<br /><br />[three_fourth_last content_align=\"left\"]<br />3/4 Sample text...<br />[/three_fourth_last]";	
}


if ( shortcodeSelect == 'scColumn' && columnLayout == 'three_fourth_one_fourth_columns'){
	shortcodeText = "[three_fourth content_align=\"left\"]<br />3/4 Sample text...<br />[/three_fourth]<br /><br />[one_fourth_last content_align=\"left\"]<br />1/4 Sample text...<br />[/one_fourth_last]";	
}


if ( shortcodeSelect == 'scColumn' && columnLayout == 'one_third_two_third_columns'){
	shortcodeText = "[one_third content_align=\"left\"]<br />1/3 Sample text...<br />[/one_third]<br /><br />[two_third_last content_align=\"left\"]<br />2/3 Sample text...<br />[/two_third_last]";	
}


if ( shortcodeSelect == 'scColumn' && columnLayout == 'two_third_one_third_columns'){
	shortcodeText = "[two_third content_align=\"left\"]<br />2/3 Sample text...<br />[/two_third]<br /><br />[one_third_last content_align=\"left\"]<br />1/3 Sample text...<br />[/one_third_last]";	
}

if ( shortcodeSelect == 'scColumn' && columnLayout == 'one_fourth_one_half_one_fourth_columns'){
	shortcodeText = "[one_fourth content_align=\"left\"]<br />1/4 Sample text...<br />[/one_fourth]<br /><br />[one_half content_align=\"left\"]<br />1/2 Sample text...<br />[/one_half]<br /><br />[one_fourth_last content_align=\"left\"]<br />1/4 Sample text...<br />[/one_fourth_last]";	
}

if ( shortcodeSelect == 'scColumn' && columnLayout == 'one_half_one_fourth_one_fourth_columns'){
	shortcodeText = "[one_half content_align=\"left\"]<br />1/2 Sample text...<br />[/one_half]<br /><br />[one_fourth content_align=\"left\"]<br />1/4 Sample text...<br />[/one_fourth]<br /><br />[one_fourth_last content_align=\"left\"]<br />1/4 Sample text...<br />[/one_fourth_last]";	
}

if ( shortcodeSelect == 'scColumn' && columnLayout == 'one_fourth_one_fourth_one_half_columns'){
	shortcodeText = "[one_fourth content_align=\"left\"]<br />1/4 Sample text...<br />[/one_fourth]<br /><br />[one_fourth content_align=\"left\"]<br />1/4 Sample text...<br />[/one_fourth]<br /><br />[one_half_last content_align=\"left\"]<br />1/2 Sample text...<br />[/one_half_last]";	
}


//=================================//
// TYPOGRAPHY SHORTCODE
//=================================//

if ( shortcodeSelect == 'scTypography' && typoElement == 'typoHighlighted' ){
	shortcodeText = '[highlighted]Sample text here...[/highlighted]';	
}


if ( shortcodeSelect == 'scTypography' && typoElement == 'typoDropcap' ){
	shortcodeText = '[dropcap]Sample text here...[/dropcap]';	
}


if ( shortcodeSelect == 'scTypography' && typoElement == 'typoBlockquote' ){
	shortcodeText = '[blockquote]Sample text here...[/blockquote]';	
}


if ( shortcodeSelect == 'scTypography' && typoElement == 'typoPullquoteLeft' ){
	shortcodeText = '[pullquote_l]Sample text here...[/pullquote_l]';	
}


if ( shortcodeSelect == 'scTypography' && typoElement == 'typoPullquoteRight' ){
	shortcodeText = '[pullquote_r]Sample text here...[/pullquote_r]';	
}


//=================================//
// BUTTON SHORTCODE
//=================================//

if ( shortcodeSelect == 'scButton' && btnColor != '0' ){
	shortcodeText = '[button url="'+ btnUrl +'" color="'+ btnColor +'" liquid="'+ btnLiquid +'"'+ btnTarget +']'+ btnText +'[/button]';	
}


//=================================//
// DIVIDER SHORTCODE
//=================================//

if ( shortcodeSelect == 'scDivider' && divType == 'divNormal' ){
	shortcodeText = '[divider]';	
}


if ( shortcodeSelect == 'scDivider' && divType == 'divTop' ){
	shortcodeText = '[divider_top]';	
}


if ( shortcodeSelect == 'scDivider' && divType == 'divSpace' ){
	shortcodeText = '[hspace]';	
}


//=================================//
// LIST SHORTCODE
//=================================//

if ( shortcodeSelect == 'scList' && listType != '0' ){
	shortcodeText = '[list type="'+ listType +'"]<br />[item]List item text[/item]<br />[item]List item text[/item]<br />[item]List item text[/item]<br />[/list]';
}


//=================================//
// ACCORDION SHORTCODE
//=================================//

if ( shortcodeSelect == 'scAccordion' ){
	shortcodeText = '[accordion]<br />[panel title="Title one"]Accordion text one[/panel]<br />[panel title="Title two"]Accordion text two[/panel]<br />[panel title="Title three"]Accordion text three[/panel]<br />[/accordion]';
}


//=================================//
// TABS SHORTCODE
//=================================//

if ( shortcodeSelect == 'scTabs' ){
	shortcodeText = '[tabs tab1="Tab one" tab2="Tab two" tab3="Tab three"]<br />[tab]Tab one Content[/tab]<br />[tab]Tab two Content[/tab]<br />[tab]Tab three Content[/tab]<br />[/tabs]';
}


//=================================//
// IMAGE SHORTCODE
//=================================//

if ( shortcodeSelect == 'scImage' && imgPath != '' && imgWidth != '' ){
	shortcodeText = '[image path="'+ imgPath +'" width="'+ imgWidth +'" height ="'+ imgHeight +'" alt="'+ imgAlt +'" title="'+ imgTitle +'" align="'+ imgAlign +'" frame="'+ imgFrame +'" link="'+ imgLink +'"]';
}


//=================================//
// VIDEO SHORTCODE
//=================================//

if ( shortcodeSelect == 'scVideo' && vidUrl != '' ){
	shortcodeText = '[embed'+ vidWidth +']'+ vidUrl +'[/embed]';
}


//=================================//
// TESTIMONIAL SHORTCODE
//=================================//

if ( shortcodeSelect == 'scTestimonial' ){
	shortcodeText = '[testimonial author="Author Name"]Testimonial content[/testimonial]';
}


//=================================//
// NOTIFICATION SHORTCODE
//=================================//

if ( shortcodeSelect == 'scNotification' && boxType != '0' ){
	shortcodeText = '[box type="'+ boxType +'"]Notification box content[/box]';
}


//=================================//
// SERVICE SHORTCODE
//=================================//

if ( shortcodeSelect == 'scService' && iconType != '0' ){
	shortcodeText = '[service icon="' + iconType + '" layout="' + iconLayout + '" title="'+ serviceTitle +'"]Sample Text Here...[/service]';	
}


//=================================//
// SLIDER SHORTCODE
//=================================//

if ( shortcodeSelect == 'scSlider' && sliderWidth != '' && sliderHeight != '' ){
	shortcodeText = '[slider width="'+ sliderWidth +'" height="'+ sliderHeight +'"]<br/>[slide path="http://path to image" width="'+ sliderWidth +'" height="'+ sliderHeight +'"]<br/>[slide path="http://path to image" width="'+ sliderWidth +'" height="'+ sliderHeight +'"]<br/>[slide path="http://path to image" width="'+ sliderWidth +'" height="'+ sliderHeight +'"]<br/>[/slider]';	
}


//=================================//
// POPUP LIGHTBOX SHORTCODE
//=================================//

if ( shortcodeSelect == 'scPopup' && popupID != '' && popupColor != '0' ){
	shortcodeText = '[popup text="' + popupText + '" color="' + popupColor + '" id="'+ popupID +'"]Insert content Here...[/popup]';	
}


//=================================//
// PRICE LABEL SHORTCODE
//=================================//

if ( shortcodeSelect == 'scPrice' && colSize != '0' ){
	shortcodeText = '[price_label size="'+ colSize +'" title="'+ itemName +'" price="'+ itemPrice +'" suffix="'+ priceSuffix +'" featured="'+ itemFeatured +'"]<br />Sample text...<br />[/price_label]';	
}




////////////////////////////////////////////////////////////////////////////


	if ( shortcodeSelect == '0' ){tinyMCEPopup.close();}}
	if(window.tinyMCE) {
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortcodeText);
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}return;
}