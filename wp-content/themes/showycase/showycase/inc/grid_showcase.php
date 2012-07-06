<?php
$homeGridOrder = of_get_option('grid_showcase_order');
if( $homeGridOrder != '' ) $orderOption = $homeGridOrder; else $orderOption = 'post_date';
global $post;
$tmp_post = $post;
$myposts = get_posts('posts_per_page=18&order=DESC&orderby='.$orderOption.'&post_type=portfolio');
if( !empty($myposts) ): ?>

<div class="home-block-title">
	<span></span>
	<h2><?php if( of_get_option('grid_showcase_label') ) echo of_get_option('grid_showcase_label'); ?></h2>
</div>
<div id="tj_container" class="tj_container">
	<div class="tj_nav">
		<span id="tj_prev" class="tj_prev">Previous</span>
		<span id="tj_next" class="tj_next">Next</span>
	</div>
	<div class="tj_wrapper">
		<ul class="tj_gallery recent-work">
			<?php foreach( $myposts as $post ) : setup_postdata($post);
			
			$folio_cats =  get_the_terms( get_the_ID(), 'portfolio_cats' );
			$cat_name = '';
			$cats_names = array();
			if( !empty($folio_cats) ):
				foreach( $folio_cats as $folio_cat ):
					$cats_names[] = $folio_cat->name;
				endforeach; 
				$cat_name = join( ', ', $cats_names );
			endif; ?>
			
			<li>
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
			
			<?php endforeach; ?>
			<?php $post = $tmp_post;
			wp_reset_query(); ?>
		</ul>
		<div class="clear"></div>
	</div>
</div>


<?php endif; ?>
