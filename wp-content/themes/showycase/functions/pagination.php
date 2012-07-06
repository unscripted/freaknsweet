<?php
function wp_corenavi() {
  global $wp_query, $wp_rewrite;
  $pages = '';
  $max = $wp_query->max_num_pages;
  if (!$current = get_query_var('paged')) $current = 1;
  $a['base'] = ($wp_rewrite->using_permalinks()) ? user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' ) : @add_query_arg('paged','%#%');
  if( !empty($wp_query->query_vars['s']) ) $a['add_args'] = array( 's' => get_query_var( 's' ) );
  $a['total'] = $max;
  $a['current'] = $current;
 
  $total = 1; //1 - display the text "Page N of N", 0 - not display
  $a['mid_size'] = 5; //how many links to show on the left and right of the current
  $a['end_size'] = 1; //how many links to show in the beginning and end
  $a['prev_text'] = __('&laquo; Prev', 'premitheme'); //text of the "Previous page" link
  $a['next_text'] = __('Next &raquo;', 'premitheme'); //text of the "Next page" link
  $a['show_all'] = 0;
 
  if ($max > 1) echo '<div id="pagination">';
  if ($total == 1 && $max > 1) $pages = '<span class="pages">'.__('Page', 'premitheme').' '. $current .' '.__('of', 'premitheme').' '. $max .'</span>'."\r\n";
  echo $pages . paginate_links($a);
  if ($max > 1) echo '<div class="clear"></div></div>';
}


// WP STANDARD POSTS NAV FUNCTION
function pt_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>">
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'premitheme' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'premitheme' ) ); ?></div>
		</nav><!-- #nav_below -->
	<?php endif;
}