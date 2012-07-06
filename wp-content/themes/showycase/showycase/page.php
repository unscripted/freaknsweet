<?php get_header();?>
	
	<section id="content-wrap">
		<div id="main">
			
			<?php the_post(); ?>
			
			<article id="post-<?php the_ID();?>" <?php post_class('entry-wrap');?>>
				<?php if ( has_post_thumbnail()): ?>
				<div class="entry-thumb">
					<?php the_post_thumbnail('blog-standard-thumb'); ?>
				</div>
				<?php endif; ?>
				
				<h1 class="entry-title"><?php the_title(); ?></h1>
				
				<div class="entry-content">
					<?php the_content(); ?>
					
					<?php wp_link_pages( array( 'before' => '<p><span>' . __( 'Pages:', 'premitheme' ) . '</span>', 'after' => '</p>' ) ); ?>
				</div>
				
				<div class="clear"></div>
				
				<div class="footer-entry-meta">
					<?php edit_post_link( __( 'Edit', 'premitheme'), '<span class="edit-link"><span>&middot;</span>', '</span>' ); ?>
				</div>
			</article>
			
		</div><!-- #main -->
		
		<div id="sidebar">
			<?php
			if( is_active_sidebar( 'sidebar-3' ) ):
			get_sidebar('page');
			else:
			get_sidebar();
			endif;
			?>
		</div><!-- #sidebar -->
		
<?php get_footer();?>