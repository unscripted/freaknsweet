<?php
function premi_widgets_init() {

	register_sidebar( array(
		'name' => __( 'General Sidebar', 'premitheme' ),
		'id' => 'sidebar-1',
		'description' => __( 'Drag widgets to this sidebar to be used with blog, single post or page. Page/Post sidebars (below) will override this sidebar if any of them has any widgets. Read the theme documentation for more info.', 'premitheme' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Single Post Sidebar', 'premitheme' ),
		'id' => 'sidebar-2',
		'description' => __( 'This sidebar will be used for single post pages automatically if it has any widget. Read the theme documentation for more info.', 'premitheme' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Page Sidebar', 'premitheme' ),
		'id' => 'sidebar-3',
		'description' => __( 'This sidebar will be used for pages automatically if it has any widget. Read the theme documentation for more info.', 'premitheme' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area One', 'premitheme' ),
		'id' => 'sidebar-4',
		'description' => __( 'An optional widget area for your site footer', 'premitheme' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title footer">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Two', 'premitheme' ),
		'id' => 'sidebar-5',
		'description' => __( 'An optional widget area for your site footer', 'premitheme' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title footer">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Three', 'premitheme' ),
		'id' => 'sidebar-6',
		'description' => __( 'An optional widget area for your site footer', 'premitheme' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title footer">',
		'after_title' => '</h3>',
	) );

}
add_action( 'widgets_init', 'premi_widgets_init' );


// Count the number of active footer widget areas to generate dynamic classes for the footer widgets container
function premi_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-5' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-6' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}