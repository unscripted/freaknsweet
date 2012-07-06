	<?php
	// CHILD PAGE NAVIGATION (FOR PAGE WITH CHILD PAGES)
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
	 
	<?php endif; ?>
	
	
	<?php if ( ! dynamic_sidebar( 'sidebar-3' ) ): ?>

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
		
