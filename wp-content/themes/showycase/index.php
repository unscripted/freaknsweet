<?php get_header();?>
	
	<section id="content-wrap">
		<div id="main">
		<?php if ( have_posts() ) : ?>
			
			<!-- ***** TITLE IF SEARCH ***** -->
			<?php if ( is_search() ) : ?>
			<div id="page-title">
				<h1><?php printf( __( 'Search Results for: %s', 'premitheme' ), get_search_query() ); ?></h1>
			</div>
			
			<!-- ***** TITLE IF AUTHOR ***** -->
			<?php elseif ( is_author() ) : the_post(); ?>
			<div id="page-title">
				<h1><?php printf( __( 'Author Archives: %s', 'premitheme' ), get_the_author() ); ?></h1>
			</div>
			<?php rewind_posts(); ?>
			
			<!-- ***** TITLE IF CATEGORY ***** -->
			<?php elseif ( is_category() ) : ?>
			<div id="page-title">
				<h1><?php _e( 'Category Archives: ', 'premitheme' ). single_cat_title(); ?></h1>
			</div>
			
			<!-- ***** TITLE IF TAG ***** -->
			<?php elseif ( is_tag() ) : ?>
			<div id="page-title">
				<h1><?php _e( 'Tag Archives: ', 'premitheme' ). single_tag_title(); ?></h1>
			</div>
			
			<!-- ***** TITLE IF ARCHIVE ***** -->
			<?php elseif ( is_archive() ) : ?>
			<div id="page-title">
				<h1><?php
				if ( is_day() ):
					printf( __( 'Daily Archives: %s', 'premitheme' ), get_the_date() );
				elseif ( is_month() ):
					printf( __( 'Monthly Archives: %s', 'premitheme' ), get_the_date( 'F, Y' ) );
				elseif ( is_year() ):
					printf( __( 'Yearly Archives: %s', 'premitheme' ), get_the_date( 'Y' ) );
				else:
					_e( 'Blog Archives: ', 'premitheme' );
				endif;
				?></h1>
			</div>
			
			<?php endif; ?>
			
			<?php while ( have_posts() ) : the_post(); ?>
			
			<?php
			if( of_get_option('fullwidth_blog') == '' || of_get_option('fullwidth_blog') != '1' ):
			get_template_part( 'inc/content', get_post_format() );
			else:
			get_template_part( 'inc/content-fullwidth', get_post_format() );
			endif;
			?>
			
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