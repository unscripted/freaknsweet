	<?php
	// CHILD PAGE NAVIGATION (FOR PAGE WITH CHILD PAGES)
	if ( is_page() ):
	if($post->post_parent)
	$children = wp_list_pages('title_li=&child_of='.$post->post_parent.'&echo=0'); else
	$children = wp_list_pages('title_li=&child_of='.$post->ID.'&echo=0');
	if ($children): ?>
	
	<aside id="sub-page-nav" class="widget widget-subnav">
	<h3 class="widget-title">
	<?php
	$parent_title = get_the_title($post->post_parent);
	echo $parent_title;
	?>
	</h3>
	 
	<ul>
	<?php echo $children; ?>
	</ul>
	</aside>
	 
	<?php endif; endif;
	
	// ABOUT AUTHOR (FOR SINGLE POST)
	if ( is_single() || is_author() ):
	if ( get_the_author_meta( 'description' ) ) : ?>
	<aside id="author-info" class="widget widget-aboutauthor">
		<div id="author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), 40); ?>
		</div><!-- #author-avatar -->
		
		<h2><?php printf( __( '<span>About the author</span> %s', 'premitheme' ), get_the_author() ); ?></h2>
		
		<div class="clear"></div>
		
		<div id="author-description">
			<p><?php the_author_meta( 'description' ); ?></p>
		</div><!-- #author-description	-->
		
		<?php if ( is_single() ):
		$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
		?>
		<a id="author-posts-link" href="<?php echo $author_url; ?>"><?php printf( __( 'All posts by %s', 'premitheme' ), get_the_author() ); ?> <span class="arr">&rarr;</span></a>
		<?php endif; ?>
		
		<div class="clear"></div>
	</aside><!-- #author-info -->
	<?php endif; endif; ?>
	
	<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ): ?>

		<aside id="archives" class="widget widget-archive">
			<h3 class="widget-title"><?php _e( 'Archives', 'ultymighty' ); ?></h3>
			<ul>
				<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
			</ul>
		</aside>

		<aside id="meta" class="widget widget-links">
			<h3 class="widget-title"><?php _e( 'Meta', 'ultymighty' ); ?></h3>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<?php wp_meta(); ?>
			</ul>
		</aside>

	<?php endif; // end sidebar widget area ?>
		
