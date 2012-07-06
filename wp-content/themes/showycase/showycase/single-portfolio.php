<?php
$itemDate = get_post_meta($post->ID, 'folioDate', TRUE);
$prevVid = get_post_meta($post->ID, 'prevVid', TRUE);
$prevHeight = get_post_meta($post->ID, 'prevHeight', TRUE);
$folioClient = get_post_meta($post->ID, 'folioClient', TRUE);
$folioUrl = get_post_meta($post->ID, 'folioUrl', TRUE);
$prevImages = get_post_meta($post->ID, 'prevImg', TRUE);

$folio_cats =  get_the_terms( get_the_ID(), 'portfolio_cats' ); 
$cats_names = array();
if( !empty($folio_cats) ):
	foreach( $folio_cats as $folio_cat ):
		$cats_names[] = $folio_cat->name;
	endforeach; 
	$cat_name = join( ', ', $cats_names );
endif;

$folio_skills =  get_the_terms( get_the_ID(), 'portfolio_skills' ); 
if ( $folio_skills && ! is_wp_error( $folio_skills ) ):
	$skills_names = array();
	foreach( $folio_skills as $folio_skill ):
		$skills_names[] = $folio_skill->name;
	endforeach; 
endif;
?>
<?php get_header();?>
	
	<section id="content-wrap">
		<div id="main">
			
			<?php while ( have_posts() ) : the_post(); ?>
			
			<article id="post-<?php the_ID();?>" <?php post_class('entry-wrap three-col');?>>
				<div id="previews-wrap">
					<?php if( $prevVid != '' ):
					$embed_code = wp_oembed_get($prevVid, array('width'=>726));
					?>
					<div id="vid-preview"><?php echo $embed_code; ?></div>
					<?php elseif (count($prevImages) > 0): ?>
					<?php if (count($prevImages) > 1): ?>
					<div id="folio-nivo" style="height: <?php echo $prevHeight; ?>px;">
						<?php foreach((array)$prevImages as $prevImg ):
							
							$prevImgUrl = vt_resize( '', $prevImg, 726, $prevHeight, true );
							$lightboxUrl = pt_get_image_path($prevImg);
							
							echo '<a title="" href="'.$lightboxUrl.'" rel="prettyPhoto[group-'.get_the_ID().']"><img src="'.$prevImgUrl['url'].'" width="'.$prevImgUrl['width'].'" height="'.$prevImgUrl['height'].'" alt=""/></a>';
						endforeach; ?>
					</div>
					<?php else: ?>
					<div id="folio-preview" style="height: <?php echo $prevHeight; ?>px;">
						<?php foreach((array)$prevImages as $prevImg ):
							
							$prevImgUrl = vt_resize( '', $prevImg, 726, $prevHeight, true );
							$lightboxUrl = pt_get_image_path($prevImg);
							
							echo '<a title="" href="'.$lightboxUrl.'" rel="prettyPhoto[group-'.get_the_ID().']"><img src="'.$prevImgUrl['url'].'" width="'.$prevImgUrl['width'].'" height="'.$prevImgUrl['height'].'" alt=""/></a>';
						endforeach; ?>
					</div>
					<?php endif; ?>
					<?php endif; ?>
				</div>
				
				<div id="folio-content">
					<h1 class="entry-title"><?php the_title(); ?></h1>
						
					<div id="folio-meta">
						<?php if( !empty($cat_name) ){ ?><span id="folio-cats"><?php echo $cat_name; ?></span><?php } ?>
						
						<?php if($itemDate != ''){ ?><span id="folio-date"><?php echo $itemDate; ?></span><?php } ?>
					</div>
					
					<?php the_content(); ?>
					
					<?php wp_link_pages( array( 'before' => '<p><span>' . __( 'Pages:', 'premitheme' ) . '</span>', 'after' => '</p>' ) ); ?>
					
					<?php if( of_get_option('folio_sharing') == '' || of_get_option('folio_sharing') != '0' ): ?>
					<?php get_template_part('inc/sharing_btns'); ?>
					<?php endif; ?>
				</div>
				
				<div id="folio-sidebar">
					<div id="folio-nav">
						<span title="<?php _e('Go to previous project', 'premitheme'); ?>" class="nav-prev"><?php previous_post_link( '%link', ''); ?></span>
						
						<?php if( of_get_option('folio_parent') != '' ): ?>
						<span title="<?php _e('View all projects', 'premitheme'); ?>" class="all-folio"><a href="<?php echo get_permalink( of_get_option('folio_parent') ); ?>"></a></span>
						<?php endif; ?>
						
						<span title="<?php _e('Go to next project', 'premitheme'); ?>" class="nav-next"><?php next_post_link( '%link', '' ); ?></span>
						
						<span class="nav-label"><?php _e('Browse portfolio', 'premitheme');?></span>
						
						<div class="clear"></div>
					</div>
					
					<?php if( $folioClient ): ?>
					<div>
						<h3><?php _e('Client', 'premitheme');?></h3>
						<ul>
							<li><?php echo $folioClient; ?></li>
						</ul>
					</div>
					<?php endif; ?>
					
					<?php if( !empty($skills_names) ): ?>
					<div>
						<h3><?php _e('Skills', 'premitheme');?></h3>
						<ul>
							<?php foreach( $skills_names as $skillName ):?>
							<li><?php echo $skillName; ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
					<?php endif; ?>
					
					<?php if( $folioUrl ): ?>
					<div>
						<h3><a href="<?php echo $folioUrl; ?>" target="_blank"><?php _e('Visit Website &rarr;', 'premitheme');?></a></h3>
					</div>
					<?php endif; ?>
				</div>
				
				<div class="clear"></div>
			</article>
			
			<?php endwhile; ?>
			
			<?php
			if( of_get_option('show_similar') == '' || of_get_option('show_similar') != '0' ):
			//----------------------//
			// SIMILAR WORK
			//----------------------//
		    $cats = get_the_terms( get_the_ID(), 'portfolio_cats' ); 
		    if ($cats):  
		    $cat_ids = array();  
		    foreach($cats as $individual_cat) $cat_ids[] = $individual_cat->term_id;  
		      
		    $args=array(  
			    'post__not_in' => array($post->ID),  
			    'showposts'=>4,
			    'ignore_sticky_posts'=>1,
			    'tax_query' => array(
				    array(
				      'taxonomy' => 'portfolio_cats',
				      'field' => 'id',
				      'terms' => $cat_ids,
				      'operator' => 'IN'
				    )
				)
		    );  
		      
		    $my_query = new wp_query($args);  
		    if( $my_query->have_posts() ):
		    ?>
		    
		    <div id="related-posts">
		    <h3><?php _e('Similar Work', 'premitheme');?></h3>
		    <ul>
		    
		    <?php while ($my_query->have_posts()):  
		    $my_query->the_post();
		    
		    ?>  
		      
		    <li>
			    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
				    <?php if ( has_post_thumbnail() ) : ?>
				    <div class="related-thumb">
				    <?php the_post_thumbnail('folio-related-thumb'); ?>
				    </div>
				    <?php else: ?>
				    <div class="related-thumb">
				    	<img src="<?php echo get_template_directory_uri();?>/images/no-image-thumb-similar.png" alt="No Image"/>
				    </div>
				    <?php endif; ?>
				    <h4 class="related-title"><?php the_title(); ?></h4>
			    </a>
		    </li>  
		      
		    <?php endwhile; ?>
		    
		    </ul>
		    <div class="clear"></div>
		    </div>
		    
		    <?php endif; endif;
		    wp_reset_query();
		    // END SIMILAR WORK
		    endif;
		    ?>
			
		</div><!-- #main -->
		
<?php get_footer();?>