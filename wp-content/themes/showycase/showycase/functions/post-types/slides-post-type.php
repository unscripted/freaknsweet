<?php
/*-----------------------------/
	REGISTER POST TYPE
/-----------------------------*/
add_action( 'init', 'slides_post_type' );

function slides_post_type() {
	register_post_type( 'slides',
	array(
		'labels' => array(
			'name' => __( 'Home Slider', 'premitheme' ),
			'singular_name' => __( 'Slide', 'premitheme' ),
			'add_new' => __( 'Add New slide', 'premitheme' ),
			'add_new_item' => __( 'Add New Slide', 'premitheme' ),
			'edit' => __( 'Edit', 'premitheme' ),
			'edit_item' => __( 'Edit Slide', 'premitheme' ),
			'new_item' => __( 'New Slide', 'premitheme' ),
			'view' => __( 'View Slide', 'premitheme' ),
			'view_item' => __( 'View Slide', 'premitheme' ),
			'search_items' => __( 'Search Slides', 'premitheme' ),
			'not_found' => __( 'No Slides Found', 'premitheme' ),
			'not_found_in_trash' => __( 'No Slides Found in Trash', 'premitheme' ),
	
		),
		'description' => __( 'Create, delete and edit slides for the home page slider', 'premitheme' ),
		'public' => true,
		'show_ui' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => true,
		'menu_position' => 20,
		'query_var' => true,
		'supports' => array( 'title' ),
		'menu_icon' => get_template_directory_uri().'/functions/post-types/slides.png',
		'rewrite' => true
		)
	);
	flush_rewrite_rules( false );
}



/*-----------------------------/
	EDIT LIST CUSTOM COLUMNS
/-----------------------------*/
add_filter("manage_edit-slides_columns", "slides_edit_columns");

add_action("manage_posts_custom_column",  "slides_columns_display", 10, 2);

add_theme_support( 'post-thumbnails', array( 'slides' ) );
   
function slides_edit_columns($slides_columns){
    $slides_columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => _x('Title', 'column name', 'premitheme'),
        "slides_thumbnail" => __('Thumbnail', 'premitheme'),
        "author" => __('Author', 'premitheme'),
        "date" => __('Date', 'premitheme'),
    );
    return $slides_columns;
}

function slides_columns_display($slides_columns, $post_id){
    switch ($slides_columns)
    {
        // Code from: http://wpengineer.com/display-post-thumbnail-post-page-overview
 
        case "slides_thumbnail":
            $thumb_src = get_post_meta($post_id, 'nivoImgURL', TRUE);
            $thumb_id = pt_get_attachment_id_by_src($thumb_src);
                
            if ($thumb_id != ''){
                $thumb = wp_get_attachment_image( $thumb_id, '100x100', true );
                echo $thumb;
            } else {
                echo __('None', 'premitheme');
            }
            
         break;
    }
}