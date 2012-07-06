<?php
/*----------------------------------------/
	CONTENT WIDTH
/----------------------------------------*/
if ( ! isset( $content_width ) )
	$content_width = 423;
	
	
	
/*----------------------------------------/
	DEFINE PATHS
/----------------------------------------*/
define('PT_FUNCTIONS', get_template_directory_uri() . '/functions');
define('PT_FRAMEWORK', TEMPLATEPATH . '/functions');
define('PT_SHORTCODES', PT_FUNCTIONS . '/shortcodes');
define('PT_PLUGINS', PT_FRAMEWORK . '/plugins');
define('PT_JS', get_template_directory_uri() . '/js');
define('PT_CSS', get_stylesheet_directory_uri() . '/css');
define('PT_INDEX', get_stylesheet_directory_uri());




/*----------------------------------------/
	THEME VARIABLES
/----------------------------------------*/
$themename = "ShowyCase";
$shortname = "sc";
$folioImgWidth = __('726px', 'premitheme');
$sliderImgWidth = __('726px', 'premitheme');
$memberImgWidth = __('180px height x 159px width', 'premitheme');




/*----------------------------------------/
	THEME SETUP
/----------------------------------------*/
if ( ! function_exists( 'pt_theme_setup' ) ):
function pt_theme_setup() {
	
	//------ Translation text domain ------//
	load_theme_textdomain( 'premitheme', TEMPLATEPATH.'/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH."/languages/$locale.php";
	if ( is_readable($locale_file) )
	require_once($locale_file);
	
	
	//------ Featured Images (post thumbnail) ------//
	add_theme_support( 'post-thumbnails' );
	
	
	//------ Add default posts and comments RSS feed links to <head> section ------//
	add_theme_support( 'automatic-feed-links' );
	
	
	//------ WP menus ------//
	register_nav_menu( 'header', __( 'Main Navigation', 'premitheme' ) );
	
	
	//------ Post Formats ------//
	add_theme_support( 'post-formats', array( 'link', 'video', 'quote', 'gallery', 'status' ) );
	
	
	//------ Sets the post excerpt length ------//
	function pt_excerpt_length( $length ) {
		return 25; // Number of words
	}
	add_filter( 'excerpt_length', 'pt_excerpt_length' );
	
	
	//------ "Read more" link ------//
	function pt_read_more_link() {
	return '<a class="more-btn" href="'. esc_url( get_permalink() ) . '">' . __( 'Read more &raquo;', 'premitheme' ) . '</a>';
	}
	
	
	//----- Replaces "[...]" with just "..." ------//
	function pt_excerpt_more( $more ) {
		return ' &hellip; '.pt_read_more_link();
	}
	add_filter( 'excerpt_more', 'pt_excerpt_more' );
		
}
endif;

add_action( 'after_setup_theme', 'pt_theme_setup' );




/*----------------------------------------/
	PLUGINS
/----------------------------------------*/

//------ IMAGE RESIZER ------//
require_once(PT_FRAMEWORK . '/vt_resize.php');


//------ UPDATES NOTIFIER ------//
require_once(PT_FRAMEWORK . '/update-notifier.php');


//------ YOUTUBE IFRAME EMBED ------//
require_once(PT_FRAMEWORK . '/plugins/iframe-embed/embed.php');


//------ TWITTER FUNCTION ------//
require_once(PT_FRAMEWORK . '/twitter-parse-function.php');


//------ THEME OPTIONS PANEL ------//
if ( !function_exists( 'optionsframework_init' ) ) {
	if ( STYLESHEETPATH == TEMPLATEPATH ) {
		define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/');
	} else {
		define('OPTIONS_FRAMEWORK_URL', STYLESHEETPATH . '/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_stylesheet_directory_uri() . '/admin/');
	}
	
	require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');
}


//------ SHORTCODES ------//
require_once(PT_FRAMEWORK . '/shortcodes/shortcodes_func.php');
require_once(PT_FRAMEWORK . '/shortcodes/shortcodes.php');


//------ WIDGETS ------//
require_once(PT_FRAMEWORK . '/widget-video.php');
require_once(PT_FRAMEWORK . '/widget-twitter.php');
require_once(PT_FRAMEWORK . '/widget-flickr.php');
require_once(PT_FRAMEWORK . '/widget-posts-thumb.php');


//------ CUSTOM POST TYPES ------//
require_once(PT_FRAMEWORK . '/post-types/slides-post-type.php');
require_once(PT_FRAMEWORK . '/post-types/portfolio-post-type.php');
require_once(PT_FRAMEWORK . '/post-types/team-post-type.php');


//------ CUSTOM METABOXES ------//
require_once(PT_FRAMEWORK . '/metaboxes/post-metaboxes.php');
require_once(PT_FRAMEWORK . '/metaboxes/slides-metaboxes.php');
require_once(PT_FRAMEWORK . '/metaboxes/portfolio-metaboxes.php');
require_once(PT_FRAMEWORK . '/metaboxes/team-metaboxes.php');
require_once(PT_FRAMEWORK . '/metaboxes/page-metaboxes.php');
require_once(PT_FRAMEWORK . '/metaboxes/links-metaboxes.php');


//------ PAGINATION ------//
require_once(PT_FRAMEWORK . '/pagination.php');


//------ SIDEBARS ------//
require_once(PT_FRAMEWORK . '/sidebars.php');





/*----------------------------------------/
	ADD CLASS NAME FOR PARENT MENU ITEMS
/----------------------------------------*/
class Arrow_Walker_Nav_Menu extends Walker_Nav_Menu {
    function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
        $id_field = $this->db_fields['id'];
        if (!empty($children_elements[$element->$id_field])) { 
            $element->classes[] = 'parent-menu-item'; //enter any classname you like here!
        }
        Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}




/*----------------------------------------/
	COMMENTS LIST STRUCTURE
/----------------------------------------*/
if ( ! function_exists( 'pt_comment' ) ) :

function pt_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="pingback">
		<p><?php _e( '<span>Pingback:</span>', 'premitheme' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'premitheme' ), '<span class="edit-link">', '</span>' ); ?></p>
		
	<?php break; 
	default :
	?>
	
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<header class="comment-meta">
			<div class="comment-avatar">
				<?php echo get_avatar( $comment, 40 ); ?>
			</div>
			
			<?php
			printf( __( '<div class="comment-date">On <a href="%1$s">%2$s</a></div>', 'premitheme' ),
			esc_url( get_comment_link( $comment->comment_ID ) ),
			sprintf( __( '%1$s at %2$s', 'premitheme' ), get_comment_date(), get_comment_time() )
			);
			?>
			
			<div class="comment-author-name"><?php comment_author_link(); ?> <span><?php _e('Says', 'premitheme'); ?></span></div>
			
			<div class="clear"></div>
		</header><!-- .comment-meta -->
		
		<div class="comment-content">
			<?php comment_text(); ?>
			
			<?php if ( $comment->comment_approved == '0' ) : ?>
			<p><em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'premitheme'); ?></em></p>
			<?php endif; ?>
			
			<footer>
				<span><?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'premitheme'), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span>
				<?php edit_comment_link( __('Edit', 'premitheme' ), '<span class="edit-link">', '</span>' ); ?>
			</footer>
		</div><!-- .comment-content -->

	<?php break;
	endswitch;
}
endif;




/*----------------------------------------------/
	FUNCTION TO CHECK IF POST HAS SHORTCODE
/----------------------------------------------*/
function has_shortcode($shortcode = '') {  
  	
  	if ( have_posts() ){
	    $postID = get_the_ID();
	    $post_to_check = get_post($postID);  
	  
	    // false because we have to search through the post content first  
	    $found = false;  
	  
	    // if no short code was provided, return false  
	    if (!$shortcode) {  
	        return $found;  
	    }  
	    // check the post content for the shortcode  
	    if ( stripos($post_to_check->post_content, '[' . $shortcode) !== false ) {  
	        // we have found the short code  
	        $found = true;  
	    }
	  
	    // return our final results  
	    return $found; 
    } 
}




/*----------------------------------------------/
	ENQUEUE SCRIPTS
/----------------------------------------------*/

//------ FRONT END ------//
function pt_enqueue_scripts() {

if ( !is_admin() ):
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js', FALSE, '1.6.4');
	wp_register_script('nivo', get_template_directory_uri() . '/js/jquery.nivo.slider.pack.js', 'jquery', FALSE, FALSE );
	wp_register_script('gridnav', get_template_directory_uri() . '/js/jquery.gridnav.js', 'jquery', TRUE, FALSE );
	wp_register_script('color', get_template_directory_uri() . '/js/jquery.color.js', 'jquery', FALSE, FALSE );
	wp_register_script('slides', get_template_directory_uri() . '/js/slides.min.jquery.js', 'jquery', FALSE, FALSE );
	wp_register_script('prettyphoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', 'jquery', FALSE, TRUE );
	wp_register_script('superfish', get_template_directory_uri() . '/js/superfish.js', 'jquery', FALSE, TRUE );
	wp_register_script('jcarousel', get_template_directory_uri() . '/js/jquery.jcarousel.min.js', 'jquery', FALSE, FALSE );
	wp_register_script('accordion', get_template_directory_uri() . '/js/jquery-ui-1.8.16.accordion.min.js', 'jquery', FALSE, FALSE );
	wp_register_script('reveal', get_template_directory_uri() . '/js/jquery.reveal.js', 'jquery', FALSE, FALSE );
	wp_register_script('quicksand', get_template_directory_uri() .'/js/jquery.quicksand.js', 'jquery', FALSE, TRUE);
	wp_register_script('validate', 'http://ajax.microsoft.com/ajax/jQuery.Validate/1.8.1/jQuery.Validate.min.js', FALSE, FALSE);
	wp_register_script('gmap', get_template_directory_uri() .'/js/jquery.gmap-1.1.0-min.js', 'jquery', FALSE, TRUE);
	wp_register_script('client', get_template_directory_uri() .'/js/jquery.client.js', 'jquery', FALSE, FALSE);
	wp_register_script('pt-custom', get_template_directory_uri() . '/js/custom.js', 'jquery', '1.0', TRUE );
	

    wp_enqueue_script('jquery');
    wp_enqueue_script('superfish');
    wp_enqueue_script('color');
    wp_enqueue_script('client');
    wp_enqueue_script('pt-custom');
    
    if( has_shortcode('image') ||
    	has_shortcode('slider') ||
    	has_shortcode('gallery') ||
    	( is_single() && get_post_type() == 'portfolio' ) ||
    	( is_single() && get_post_format() == 'gallery' ) ||
    	is_home() ||
    	is_archive() ||
    	is_search() ){
    wp_enqueue_script('prettyphoto');
    }
    
    if( has_shortcode('slider') ||
    	is_page_template('home1.php') ||
    	is_home() ||
    	is_archive() ||
    	is_search() ||
    	( is_single() && get_post_format() == 'gallery' ) ||
    	( is_single() && get_post_type() == 'portfolio' ) ){
    wp_enqueue_script( 'nivo' );
    }
    
    if( has_shortcode('tabs') ){
	wp_enqueue_script('jquery-ui-tabs');
	}
	
	if( has_shortcode('accordion') ){
	wp_enqueue_script( 'accordion' );
	}
	
	if( has_shortcode('popup') ){
	wp_enqueue_script( 'reveal' );
	}
	
	if( is_page_template('contact.php') ){
	wp_enqueue_script( 'validate' );
	wp_enqueue_script( 'gmap' );
	}
	
	if( ( is_page_template('portfolio-3col.php') || is_page_template('portfolio-1col.php') || is_page_template('portfolio-3col-cat.php') || is_page_template('portfolio-1col-cat.php') ) && of_get_option('filtering_on') != '0' ){
	wp_enqueue_script( 'quicksand' );
	}
    
    if( is_page_template('home1.php') ||
		is_page_template('home2.php') ||
    	is_page_template('home3.php') ||
    	is_page_template('home4.php') ){
	wp_enqueue_script( 'jcarousel' );
	}
	
	if( is_page_template('home2.php') ){
	wp_enqueue_script( 'gridnav' );
	}
    
    if ( is_singular() && get_option( 'thread_comments' ) ){
    wp_enqueue_script( 'comment-reply' );
    }
endif;
}    
add_action('wp_enqueue_scripts', 'pt_enqueue_scripts');


//------ ADMIN ------//

function pt_metabox_scripts() {
    wp_register_script('my-upload', PT_FUNCTIONS.'/js/my_upload.js', array('jquery','media-upload','thickbox'));
	wp_register_script('metaboxes', PT_FUNCTIONS.'/js/metaboxes_scripts.js', 'jquery');
	wp_register_script('clone-field', PT_FUNCTIONS.'/js/jquery.dynamicField-1.0.js', 'jquery');
    
    
    wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('my-upload');
	wp_enqueue_script('metaboxes');
	wp_enqueue_script('clone-field');
}    
add_action('admin_print_scripts-post-new.php', 'pt_metabox_scripts');
add_action('admin_print_scripts-post.php', 'pt_metabox_scripts');




/*----------------------------------------------/
	ENQUEUE STYLES 
/----------------------------------------------*/
function pt_enqueue_styles() {

if ( !is_admin() ):
    wp_register_style('prettyphoto', get_template_directory_uri() . '/css/prettyPhoto.css' );
	wp_register_style('nivo', get_template_directory_uri() . '/css/nivo-slider.css' );
	wp_register_style('gridnav', get_template_directory_uri() . '/css/gridNavigation.css' );
	wp_register_style('reveal', get_template_directory_uri() . '/css/reveal.css' );
	wp_register_style('dark', get_template_directory_uri() . '/style-dark.css' );
    

    if( has_shortcode('image') ||
    	has_shortcode('slider') ||
    	( is_single() && get_post_type() == 'portfolio' ) ||
    	( is_single() && get_post_format() == 'gallery' ) ||
    	is_home() ||
    	is_archive() ||
    	is_search() ){
    wp_enqueue_style( 'prettyphoto' );
    }
    
    if( has_shortcode('slider') ||
    	is_page_template('home1.php') ||
    	is_home() ||
    	is_archive() ||
    	is_search() ||
    	( is_single() && get_post_format() == 'gallery' ) ||
    	( is_single() && get_post_type() == 'portfolio' ) ){
    wp_enqueue_style( 'nivo' );
    }
    
    if( is_page_template('home2.php') ){
	wp_enqueue_style( 'gridnav' );
	}
    
    if( has_shortcode('popup') ){
	wp_enqueue_style( 'reveal' );
	}
    
    if( of_get_option('skin_color') == 'dark' ){
	wp_enqueue_style('dark');
	}
endif;
}
add_action('wp_print_styles', 'pt_enqueue_styles');


//------ ADMIN ------//

function pt_metabox_styles() {
    
    wp_register_style('metaboxes', PT_FUNCTIONS.'/css/metaboxes_styles.css');
    
    
    wp_enqueue_style('thickbox');
    wp_enqueue_style('metaboxes');
}
add_action('admin_print_styles-post-new.php', 'pt_metabox_styles');
add_action('admin_print_styles-post.php', 'pt_metabox_styles');



//------ THEME-OPTIONS-RELATED SCRIPTS ------//
function optionsframework_custom_scripts() { ?>
<script type="text/javascript">
jQuery(document).ready(function() {

	var socialFields = jQuery("#section-social_twitter, #section-social_facebook, #section-social_myspace, #section-social_deviant, #section-social_flickr, #section-social_linkedin, #section-social_vimeo, #section-social_youtube, #section-social_rss, #section-social_skype, #section-social_aim, #section-social_yahoo, #section-social_gtalk, #section-social_dribbble");
	
	var description = jQuery("#section-site_description");
	
	var sliderFields = jQuery("#section-featured_work_label, #section-slider_height, #section-slider_delay, #section-slider_effect, #section-slider_order");
	
	
	jQuery('#show_social').parent().click(function() {
  		jQuery(socialFields).slideToggle(400);
	});
	
	jQuery('#show_description').parent().click(function() {
  		jQuery(description).slideToggle(400);
	});
	
	jQuery('#show_slider').parent().click(function() {
  		jQuery(sliderFields).slideToggle(400);
	});
	
	jQuery('#recent_work').parent().click(function() {
  		jQuery("#section-recent_work_label").slideToggle(400);
  		jQuery("#section-recent_work_order").slideToggle(400);
	});
	
	jQuery('#recent_posts').parent().click(function() {
  		jQuery("#section-recent_posts_label").slideToggle(400);
	});
	
	jQuery('#grid_showcase').parent().click(function() {
  		jQuery("#section-grid_showcase_label").slideToggle(400);
  		jQuery("#section-grid_showcase_effect").slideToggle(400);
  		jQuery("#section-grid_showcase_order").slideToggle(400);
	});
	
	
	if (jQuery('#show_slider:checked').val() !== undefined) {
		jQuery(sliderFields).show();
	}
	
	if (jQuery('#show_social:checked').val() !== undefined) {
		jQuery(socialFields).show();
	}
	
	if (jQuery('#show_description:checked').val() !== undefined) {
		jQuery(description).show();
	}
	
	if (jQuery('#recent_work:checked').val() !== undefined) {
		jQuery("#section-recent_work_label").show();
		jQuery("#section-recent_work_order").show();
	}
	
	if (jQuery('#recent_posts:checked').val() !== undefined) {
		jQuery("#section-recent_posts_label").show();
	}
	
	if (jQuery('#grid_showcase:checked').val() !== undefined) {
		jQuery("#section-grid_showcase_label").show();
		jQuery("#section-grid_showcase_effect").show();
		jQuery("#section-grid_showcase_order").show();
	}
	
	
});
</script>
<?php
}
add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');




/*----------------------------------------------/
	HEAD STYLES & SCRIPTS
/----------------------------------------------*/
require_once(PT_FRAMEWORK . '/head-styles.php');
require_once(PT_FRAMEWORK . '/head-scripts.php');




/*----------------------------------------/
	CUSTOM IMAGE SIZES
/----------------------------------------*/
add_image_size('blog-standard-thumb', 473, 9999);
add_image_size('blog-fullwidth-thumb', 726, 9999);
add_image_size('fullwidth-page-image', 726, 200, true);
add_image_size('default-page-image', 473, 200, true);
add_image_size('blog-related-thumb', 130, 75, true);
add_image_size('folio-related-thumb', 154, 75, true);
add_image_size('sidebar-thumb', 50, 50, true);
add_image_size('folio-3-col', 240, 240, true);
add_image_size('folio-1-col', 473, 240, true);
add_image_size('100x100', 100, 100, true);




/*----------------------------------------/
	EXCLUDE / INCLUDE TO SEARCH QUERY
/----------------------------------------*/
function pt_search_query($query) {
if ($query->is_search) {
$query->set('post_type', array('post', 'portfolio'));
}
return $query;
}

add_filter('pre_get_posts','pt_search_query');




/*----------------------------------------/
	RELATIVE TIME FUNCTION ( FOR TWITTER )
/----------------------------------------*/
define("SECOND", 1);
define("MINUTE", 60 * SECOND);
define("HOUR", 60 * MINUTE);
define("DAY", 24 * HOUR);
define("MONTH", 30 * DAY);

function relativeTime($time)
{
	$delta = strtotime('+0 hours') - $time;
	if ($delta < 2 * MINUTE) {
		return "1 min ago";
	}
	if ($delta < 45 * MINUTE) {
		return floor($delta / MINUTE) . " min ago";
	}
	if ($delta < 90 * MINUTE) {
		return "1 hour ago";
	}
	if ($delta < 24 * HOUR) {
		return floor($delta / HOUR) . " hours ago";
	}
	if ($delta < 48 * HOUR) {
		return "yesterday";
	}
	if ($delta < 30 * DAY) {
		return floor($delta / DAY) . " days ago";
	}
	if ($delta < 12 * MONTH) {
		$months = floor($delta / DAY / 30);
		return $months <= 1 ? "1 month ago" : $months . " months ago";
	} else {
		$years = floor($delta / DAY / 365);
		return $years <= 1 ? "1 year ago" : $years . " years ago";
	}
}




/*----------------------------------------------------/
	TRUNCATE LONG TEXT STRINGS ( LIKE LONG TITLES )
/----------------------------------------------------*/
function truncate_text($string, $count, $ellipsis = TRUE){
	$words = explode(' ', $string);
	if (count($words) > $count){
		array_splice($words, $count);
		$string = implode(' ', $words);
		if (is_string($ellipsis)){
			$string .= $ellipsis;
		}
		elseif ($ellipsis){
			$string .= '&hellip;';
		}
	}
	return $string;
}




/*----------------------------------------------------/
	GET IMAGE PATH WITH MULTISITE SUPPORT
/----------------------------------------------------*/

function pt_get_image_path($imgPath, $post_id = null) {
	if ($post_id == null) {
		global $post;
		$post_id = $post->ID;
	}
	$theImageSrc = $imgPath;
	global $blog_id;
	if (isset($blog_id) && $blog_id > 0) {
		$imageParts = explode('/files/', $theImageSrc);
		if (isset($imageParts[1])) {
			$theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
		}
	}
	return $theImageSrc;
}





/*----------------------------------------------------/
	GET ATTACHMENT ID ACCORDING TO ITS SRC
/----------------------------------------------------*/
function pt_get_attachment_id_by_src($image_src) {

	global $wpdb;
	$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
	$id = $wpdb->get_var($query);
	return $id;

}




/*----------------------------------------------------/
	INCLUDE PORTFOLIO ITEMS IN MAIN RSS FEEDS
/----------------------------------------------------*/
if( of_get_option('folio_rss') == '' || of_get_option('folio_rss') != '0' ):
	function myfeed_request($qv) {
		if (isset($qv['feed']) && !isset($qv['post_type']))
			$qv['post_type'] = array('post', 'portfolio');
		return $qv;
	}
	add_filter('request', 'myfeed_request');
endif;



 
/*----------------------------------------------------/
	ADD LIGHTBOX SUPPORT FOR WP GALLERIES & LIKED ATTACHMENTS
/----------------------------------------------------*/

add_filter( 'wp_get_attachment_link', 'gallery_prettyPhoto');

function gallery_prettyPhoto ($content) {
	return str_replace("<a", "<a rel=\"prettyPhoto[slides]\"", $content);
}
