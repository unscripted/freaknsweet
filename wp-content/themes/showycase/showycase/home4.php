<?php
/*
Template Name: Home Page 4 - with video banner
*/
?>
<?php get_header();?>
	
	<section id="content-wrap">
		<div id="main">
			
			<?php the_post(); ?>
			
			<article id="post-<?php the_ID();?>" <?php post_class('entry-wrap');?>>
			
				<?php // SHOW HOME VIDEO BANNER
				if( of_get_option('home_video') ):
				
				if( of_get_option('banner_label') ): ?>
				<div class="home-block-title">
					<h2><?php echo of_get_option('banner_label'); ?></h2>
				</div>
				<?php endif; ?>
							
				<?php
				$home_video_url = of_get_option('home_video');
				$embed_code = wp_oembed_get($home_video_url, array('width'=>726));
				?>
				<div id="home-fixed"><?php echo $embed_code; ?></div>
					
				<?php endif; ?>
				
				
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