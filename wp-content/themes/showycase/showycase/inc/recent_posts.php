<?php
global $post;
$tmp_post = $post;
$myposts = get_posts('numberposts=9&order=DESC&orderby=post_date');
if( !empty($myposts) ): ?>

<ul class="recent-posts jcarousel-skin-posts">
	<?php foreach( $myposts as $post ) : setup_postdata($post); ?>
	
	<li>
		<div <?php post_class('recent-post-wrap');?>>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<div class="recent-post-content">
				<?php the_excerpt(); ?>
			</div>
			<div class="recent-post-meta">
				<a class="recent-post-date" href="<?php echo get_permalink(); ?>" title="<?php echo get_the_time();; ?>"><?php echo get_the_date(); ?></a>
				<?php if( !is_single() ) comments_popup_link( __( '0', 'premitheme' ), __( '1', 'premitheme' ), '%', 'comments-link', __( '--', 'premitheme' ) ); ?>
			</div>
			<div class="recent-post-format">
				<div class="format-icon"></div>
			</div>
		</div>
	</li>
	
	<?php endforeach; ?>
	<?php $post = $tmp_post;
	wp_reset_query(); ?>
</ul><!-- .recent-posts -->
<div class="home-block-title">
	<span></span>
	<h2><?php if( of_get_option('recent_posts_label') ) echo of_get_option('recent_posts_label'); ?></h2>
</div>

<?php endif; ?>