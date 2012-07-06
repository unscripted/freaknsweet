<?php
/*
Template Name: Home Page 3 - with fixed image
*/
?>
<?php get_header();?>
	
	<section id="content-wrap">
		<div id="main">
			
			<?php the_post(); ?>
			
			<article id="post-<?php the_ID();?>" <?php post_class('entry-wrap');?>>
			
				<?php // SHOW HOME FIXED IMAGE
				if( of_get_option('home_banner') ):
				
				if( of_get_option('banner_label') ): ?>
				<div class="home-block-title">
					<h2><?php echo of_get_option('banner_label'); ?></h2>
				</div>
				<?php endif; ?>
							
				<?php
				$bannerHeight = of_get_option('home_banner_height');
				$bannerPath = of_get_option('home_banner');
				$bannerImgUrl = vt_resize( '', $bannerPath, 726, $bannerHeight, true );
				
				echo '<div id="home-fixed"><img src="'.$bannerImgUrl['url'].'" width="'.$bannerImgUrl['width'].'" height="'.$bannerImgUrl['height'].'" alt="'.of_get_option('banner_label').'"/></div>';
					
				endif; ?>
				
				
				<?php // SHOW WORK CAROUSEL IF HAVE FOLIO ITEMS
				if( of_get_option('recent_work') == '' || of_get_option('recent_work') != '0' ): ?>
					
					<?php get_template_part('inc/recent_work'); ?>
					
				<?php endif; ?>
				
				
				<?php // SHOW CONTENT IF NOT EMPTY
				if(trim($post->post_content) != '' ): ?>
				<div class="entry-content">
					<?php the_content(); ?>
					
					<?php wp_link_pages( array( 'before' => '<p><span>' . __( 'Pages:', 'premitheme' ) . '</span>', 'after' => '</p>' ) ); ?>
					
					<div class="footer-entry-meta">
					<?php edit_post_link( __( 'Edit', 'premitheme'), '<span class="edit-link">', '</span>' ); ?>
					</div>
				</div>
				<?php endif; ?>
				
				
				<?php // SHOW RECENT POSTS IF HAVE ANY
				if( of_get_option('recent_posts') == '' || of_get_option('recent_posts') != '0' ): ?>
					
					<?php get_template_part('inc/recent_posts'); ?>
					
				<?php endif; ?>
				
			</article>
			
		</div><!-- #main -->
		
<?php get_footer();?>