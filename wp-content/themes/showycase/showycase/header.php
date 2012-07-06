<?php
//--- TITLE FORMATTING ---//
global $page, $paged, $post, $posts;
$site_name = get_bloginfo( 'name', 'display' );
$site_description = get_bloginfo( 'description', 'display' );
if ( is_front_page() ){ $pt_site_title = $site_name.' | '.$site_description; }
else { $pt_site_title = wp_title( '|', false, 'right' ).' '.$site_name; }


$bodyID = 'posts-general';
if( is_page() ) { $bodyID = 'pages-general'; }
if( is_page_template('archives.php') ) { $bodyID = 'archives-temp'; }
if( is_page_template('home1.php') || is_page_template('home2.php') || is_page_template('home3.php') || is_page_template('home4.php') ) { $bodyID = 'home-temp'; }
if( is_page_template('contact.php') ) { $bodyID = 'contact-temp'; }
if( is_page_template('about.php') ) { $bodyID = 'about-temp'; }
if( is_page_template('portfolio-1col.php') || is_page_template('portfolio-3col.php') || is_page_template('portfolio-3col-cat.php') || is_page_template('portfolio-1col-cat.php') ) { $bodyID = 'folio-temp'; }
if( is_page_template('fullwidth.php') ) { $bodyID = 'full-width'; }
if( is_404() ) { $bodyID = 'error404'; }
if( is_single() && get_post_type() == 'portfolio' ) { $bodyID = 'folio-single'; }
if( ( is_home() || is_search() || is_archive() ) && of_get_option('fullwidth_blog') == '1' ) { $bodyID = 'posts-general-fullwidth'; }
if( is_single() && get_post_type() == 'post' && of_get_option('fullwidth_blog') == '1' ) { $bodyID = 'posts-single-fullwidth'; }

if ( has_post_thumbnail() ):
$postThumbID = get_post_thumbnail_id( $post->ID );
$attachments = wp_get_attachment_image_src( $postThumbID, 'full' );
$thumbSrc = $attachments[0];
else:
$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
if( isset($matches [1] [0]) ){
$first_img = $matches [1] [0];
}
if(empty($first_img)){ //Defines a default image
    $first_img = "";
}
$thumbSrc = $first_img;
endif;
?>

<!DOCTYPE HTML>
<html <?php language_attributes();?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type');?>; charset=<?php bloginfo('charset');?>" />

<meta property="og:title" content="<?php the_title(); ?>" />
<meta property="og:image" content="<?php echo $thumbSrc; ?>" />

<!-- PAGE TITLE -->
<title><?php echo $pt_site_title;?></title>

<?php if( of_get_option('favicon') ){ ?>
<!-- FAVICON -->
<link rel="shortcut icon" href="<?php echo of_get_option('favicon');?>" type="image/x-icon" />
<?php } ?>

<?php if( of_get_option('apple_icon') ){ ?>
<!-- APPLE TOUCH DEVICES ICON -->
<link rel="apple-touch-icon" href="<?php echo of_get_option('apple_icon');?>"/>
<?php } ?>

<!-- MAIN STYLESHEET -->
<link rel="stylesheet" title="style"  type="text/css" href="<?php bloginfo('stylesheet_url');?>" media="screen" />

<!-- PINGBACK -->
<link rel="pingback" href="<?php bloginfo('pingback_url');?>" />

<!-- HTML5/CSS3 SUPPORT FOR OLD IE BROWSERS -->
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php if( is_page_template('contact.php') && of_get_option('google_key') ): ?>
<script type="text/javascript" src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo of_get_option('google_key'); ?>"></script>
<?php endif; ?>

<!-- WP HEAD -->
<?php wp_head();?>
</head>
	
<body id="<?php echo $bodyID; ?>" <?php if( of_get_option('skin_color') == 'dark' ) body_class('dark-skin'); else body_class('light-skin'); ?>>
<div id="main-wrapper">
	<header id="branding" <?php if( of_get_option('fixed_nav') == '1' ) echo 'class="fixed"'; ?>>
		<!-- SITE LOGO -->
		<?php if( of_get_option('site_logo') ): ?>
		<a id="logo" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
			<img alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> logo" src="<?php echo of_get_option('site_logo'); ?>" />
		</a>
		<?php else: ?>
		<a id="logo" class="logo_ph" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
		<?php endif; ?>
		
		<!-- WP NAV MENU -->
		<nav>
		<?php if (has_nav_menu('header')) {
			wp_nav_menu( array(
				'container' => '',
				'theme_location' => 'header',
				'walker' => new Arrow_Walker_Nav_Menu(),
				'menu_class' => 'main-menu',
				'fallback_cb' => 'false'
			));
		}?>
		</nav>
		
		<?php if( of_get_option('show_description') == '' || of_get_option('show_description') != '0' )
		echo '<h2 id="site-description">'. of_get_option('site_description') .'</h2>'; ?>
		
		<!-- SEARCH FIELD -->
		<?php if( of_get_option('show_search') == '' || of_get_option('show_search') != '0' ) get_search_form();?>
		
		<!-- SOCIAL LINKS -->
		<?php if( of_get_option('show_social') == '' || of_get_option('show_social') != '0' ): ?>
		<ul class="social-wrap">
			<?php   if( of_get_option('social_twitter') ){ ?>
			<li class="twitter social-link"><a href="<?php echo of_get_option('social_twitter');?>" title="Twitter" target="_blank">Twitter</a></li>
			
			<?php } if( of_get_option('social_facebook') ){ ?>
			<li class="facebook social-link"><a href="<?php echo of_get_option('social_facebook');?>" title="Facebook" target="_blank">Facebook</a></li>
			
			<?php } if( of_get_option('social_myspace') ){ ?>
			<li class="myspace social-link"><a href="<?php echo of_get_option('social_myspace');?>" title="Myspace" target="_blank">Myspace</a></li>
			
			<?php } if( of_get_option('social_flickr') ){ ?>
			<li class="flickr social-link"><a href="<?php echo of_get_option('social_flickr');?>" title="Flickr" target="_blank">Flickr</a></li>
			
			<?php } if( of_get_option('social_deviant') ){ ?>
			<li class="deviant social-link"><a href="<?php echo of_get_option('social_deviant');?>" title="DeviantArt" target="_blank">DeviantArt</a></li>
			
			<?php } if( of_get_option('social_linkedin') ){ ?>
			<li class="linkedin social-link"><a href="<?php echo of_get_option('social_linkedin');?>" title="LinkedIn" target="_blank">LinkedIn</a></li>
			
			<?php } if( of_get_option('social_dribbble') ){ ?>
			<li class="dribbble social-link"><a href="<?php echo of_get_option('social_dribbble');?>" title="Dribbble" target="_blank">Dribbble</a></li>
			
			<?php } if( of_get_option('social_skype') ){ ?>
			<li class="skype social-link"><a href="skype:<?php echo of_get_option('social_skype');?>?chat" title="Skype">Skype</a></li>
			
			<?php } if( of_get_option('social_gtalk') ){ ?>
			<li class="gtalk social-link"><a href="gtalk:chat?jid=<?php echo of_get_option('social_gtalk');?>" title="GTalk">GTalk</a></li>
			
			<?php } if( of_get_option('social_aim') ){ ?>
			<li class="aim social-link"><a href="aim:goim?screenname=<?php echo of_get_option('social_aim');?>" title="AIM">AIM</a></li>
			
			<?php } if( of_get_option('social_yahoo') ){ ?>
			<li class="yahoo social-link"><a href="ymsgr:sendim?<?php echo of_get_option('social_yahoo');?>" title="Yahoo">Yahoo</a></li>
			
			<?php } if( of_get_option('social_vimeo') ){ ?>
			<li class="vimeo social-link"><a href="<?php echo of_get_option('social_vimeo');?>" title="Vimeo" target="_blank">Vimeo</a></li>
			
			<?php } if( of_get_option('social_youtube') ){ ?>
			<li class="youtube social-link"><a href="<?php echo of_get_option('social_youtube');?>" title="YouTube" target="_blank">YouTube</a></li>
			
			<?php } if( of_get_option('social_rss') ){ ?>
			<li class="rss social-link"><a href="<?php echo of_get_option('social_rss');?>" title="RSS feeds" target="_blank">RSS feeds</a></li>
			<?php } ?>
			<li class="clear"></li>
		</ul>
		<?php endif; ?>
	</header><!-- #branding -->