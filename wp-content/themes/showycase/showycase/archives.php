<?php
/*
Template Name: Archives Page
*/
?>
<?php get_header();?>
	
	<section id="content-wrap">
		<div id="main">
			
			<?php the_post(); ?>
			
			<article id="post-<?php the_ID();?>" <?php post_class('entry-wrap');?>>
				<?php if ( has_post_thumbnail()): ?>
				<div class="entry-thumb">
					<?php the_post_thumbnail('fullwidth-page-image'); ?>
				</div>
				<?php endif; ?>
				
				<h1 class="entry-title"><?php the_title(); ?></h1>
				
				<?php if(trim($post->post_content) != '' ): ?>
				<div class="entry-content">
					<?php the_content(); ?>
					
					<?php wp_link_pages( array( 'before' => '<p><span>' . __( 'Pages:', 'premitheme' ) . '</span>', 'after' => '</p>' ) ); ?>
					
					<div class="footer-entry-meta">
					<?php edit_post_link( __( 'Edit', 'premitheme'), '<span class="edit-link">', '</span>' ); ?>
					</div>
				</div>
				<?php endif; ?>
				
				<div class="clear"></div>
				
				<div id="last-posts">
					<h2><?php _e('Last 30 posts on the blog', 'premitheme');?></h2>
					<ol>
						<?php wp_get_archives( 'type=postbypost&limit=30' ); ?>
					</ol>
				</div>
				
				<div id="archives-by">
					<div id="by-month">
						<h2><?php _e('Monthly Archives', 'premitheme');?></h2>
						<ul>
							<?php wp_get_archives( 'type=monthly&limit=12&show_post_count=1' ); ?>
						</ul>
					</div>
					<div id="by-category">
						<h2><?php _e('Categories', 'premitheme');?></h2>
						<ul>
							<?php wp_list_categories( 'title_li=&show_count=1' ); ?>
						</ul>
					</div>
					<div id="by-author">
						<h2><?php _e('Authors', 'premitheme');?></h2>
						<ul>
							<?php wp_list_authors( 'optioncount=1' ); ?>
						</ul>
					</div>
					<div id="by-tag">
						<h2><?php _e('Tag Cloud', 'premitheme');?></h2>
						<?php wp_tag_cloud(); ?> 
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</article>
			
		</div><!-- #main -->
		
<?php get_footer();?>