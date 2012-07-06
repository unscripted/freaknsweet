<?php get_header();?>
	
	<section id="content-wrap">
		<div id="main">
		<?php if ( have_posts() ) : ?>
			
			<div id="page-title">
				<h1><?php printf( __( 'Search Results for: %s', 'premitheme' ), get_search_query() ); ?></h1>
			</div>
			
			<?php while ( have_posts() ) : the_post(); ?>
			
			<article id="post-<?php the_ID();?>" <?php post_class('entry-wrap');?>>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				
				<?php the_excerpt(); ?>
			</article>
			
			<?php endwhile;
			
			// PAGINATION
			if(function_exists('wp_pagenavi')): wp_pagenavi();
			elseif (function_exists('wp_corenavi')): wp_corenavi();
			else: pt_content_nav('nav_below');
			endif;
			
			// FALLBACK MESSAGE IF HAVE NO POSTS
			else: ?>
			<article id="post-0" class="entry-wrap">
				<h2 class="entry-title"><?php _e('Nothing found', 'premitheme'); ?></h2>
				
				<div class="entry-content">
					<p><?php _e('Sorry, no posts were found.', 'premitheme'); ?></p>
				</div>
				
				<?php get_search_form(); ?>
			</article>
			<?php endif; ?>
		</div><!-- #main -->
		
		<?php if( of_get_option('fullwidth_blog') == '' || of_get_option('fullwidth_blog') != '1' ): ?>
		<div id="sidebar">
			<?php get_sidebar(); ?>
		</div><!-- #sidebar -->
		<?php endif; ?>
		
<?php get_footer();?>