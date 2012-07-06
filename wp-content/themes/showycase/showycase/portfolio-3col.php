<?php
/*
Template Name: Portfolio Page (All) - 3 columns
*/

$args = array(
    'hide_empty'    => 1,
    'hierarchical'  => 0,
    'parent'        => 0,
    'taxonomy' => 'portfolio_cats');
    
$folioCats = get_categories($args);

?>
<?php get_header();?>
	
	<section id="content-wrap">
		<div id="main">
			
			<?php the_post(); ?>
			
			<article id="post-<?php the_ID();?>" <?php post_class('entry-wrap three-col');?>>
				<div id="portfolio-header">
					
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
					
					
					<?php
					if( of_get_option('filtering_on') == '' || of_get_option('filtering_on') != '0' ):
					if( !empty( $folioCats )): ?>
					
					<ul id="filtering-links">
						<li data-value="all" class="filter current">
							<a href="#" title="<?php _e('Show All', 'premitheme'); ?>"><?php _e('All', 'premitheme');?></a>
						</li>
						
						<?php foreach( $folioCats as $folioFilter ): ?>
						<li data-value="<?php echo $folioFilter->slug ?>" class="filter">
							<a href="#" title="<?php printf( __('Show %s Only', 'premitheme'), $folioFilter->cat_name ); ?>"><?php echo $folioFilter->cat_name ?></a>
						</li>
						<?php endforeach; ?>
						<li class="clear"></li>
					</ul>
					
					<?php endif; endif; ?>
				</div>
				
				<ul id="folio-items">
					
					<?php
					if( of_get_option('folio_perpage') ):
					$perPage = of_get_option('folio_perpage');
					else:
					$perPage = '-1';
					endif;
					
					$args = array(
						'paged' => $paged,
						'posts_per_page' => $perPage,
						'post_type' => 'portfolio'
					);
					
					$temp = $wp_query;
					$wp_query= null;
					$wp_query = new WP_Query();
					$wp_query->query($args);
					while ($wp_query->have_posts()) : $wp_query->the_post();	

					$folio_cats =  get_the_terms( get_the_ID(), 'portfolio_cats' );
					$cat_name = '';
					$cats_names = array();
					if( !empty($folio_cats) ):
						foreach( $folio_cats as $folio_cat ):
							$cats_names[] = $folio_cat->name;
						endforeach; 
						$cat_name = join( ', ', $cats_names );
					endif;
					?>
						
						<li class="<?php if( !empty($folio_cats) ){ foreach( $folio_cats as $filter_class ){ echo $filter_class->slug.' '; } } ?>all folio-wrap folio-thumb" data-id="<?php the_ID(); ?>">
							<a class="folio-overlay" href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
								<?php
								if ( has_post_thumbnail()):
								the_post_thumbnail('folio-3-col');
								else:?>
								<img src="<?php echo get_template_directory_uri();?>/images/no-image-thumb.png" alt="No Image"/>
								<?php endif;?>
								
								<div class="folio-title">
									<h2><?php the_title(); ?></h2>
									<h3><?php echo $cat_name; ?></h3>
								</div>
								
								<span class="more-hover"></span>
							</a>
						</li>
						
					<?php endwhile;
					wp_reset_query(); ?>
					<li class="clear"></li>
				</ul>
				<div class="clear"></div>
				
				<?php
				// Pagination
				if(function_exists('wp_pagenavi')): wp_pagenavi();
				elseif (function_exists('wp_corenavi')): wp_corenavi();
				else: pt_content_nav('nav_below');
				endif;
				?>
			</article>
			
		</div><!-- #main -->
		
<?php get_footer();?>