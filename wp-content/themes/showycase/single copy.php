<?php get_header();?>
	
	<section id="content-wrap">
		<div id="main">
			
			<?php while ( have_posts() ) : the_post(); ?>
			
			<?php get_template_part( 'inc/content', get_post_format() ); ?>
			
			<?php endwhile; ?>
			
			<?php
			if( of_get_option('show_related') == '' || of_get_option('show_related') != '0' ):
			//----------------------//
			// RELATED POSTS
			//----------------------//
		    $tags = wp_get_post_tags($post->ID);  
		    if ($tags):  
		    $tag_ids = array();  
		    foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;  
		      
		    $args=array(  
			    'tag__in' => $tag_ids,  
			    'post__not_in' => array($post->ID),  
			    'showposts'=>3,
			    'ignore_sticky_posts'=>1,
			    'tax_query' => array(
				    array(
				      'taxonomy' => 'post_format',
				      'field' => 'slug',
				      'terms' => 'post-format-status',
				      'operator' => 'NOT IN'
				    )
				)
		    );  
		      
		    $my_query = new wp_query($args);  
		    if( $my_query->have_posts() ):
		    ?>
		    
		    <div id="related-posts">
		    <h3><?php _e('Related Posts', 'premitheme');?></h3>
		    <ul>
		    
		    <?php while ($my_query->have_posts()):  
		    $my_query->the_post();  
		    ?>  
		      
		    <li>
			    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
				    <?php if ( has_post_thumbnail() ) : ?>
				    <div class="related-thumb">
				    <?php the_post_thumbnail('blog-related-thumb'); ?>
				    </div>
				    <?php else: ?>
				    <div class="related-thumb">
				    	<img src="<?php echo get_template_directory_uri();?>/images/no-image-thumb-related.png" alt="No Image"/>
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
		    // END RELATED POSTS
		    endif;
		    ?>
			
			<?php comments_template( '', true ); ?>
			
		</div><!-- #main -->
		
		<div id="sidebar">
			<?php
			if( is_active_sidebar( 'sidebar-2' ) ):
			get_sidebar('single');
			else:
			get_sidebar();
			endif;
			?>
		</div><!-- #sidebar -->
		
<?php get_footer();?>