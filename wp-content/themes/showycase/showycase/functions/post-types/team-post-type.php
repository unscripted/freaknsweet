<?php
/*-----------------------------/
	REGISTER POST TYPE
/-----------------------------*/
add_action( 'init', 'team_post_type' );

function team_post_type() {
	register_post_type( 'team',
	array(
		'labels' => array(
			'name' => __( 'Work Team', 'premitheme' ),
			'singular_name' => __( 'Team Member', 'premitheme' ),
			'add_new' => __( 'Add New Member', 'premitheme' ),
			'add_new_item' => __( 'Add New Member', 'premitheme' ),
			'edit' => __( 'Edit', 'premitheme' ),
			'edit_item' => __( 'Edit Member', 'premitheme' ),
			'new_item' => __( 'New Member', 'premitheme' ),
			'view' => __( 'View', 'premitheme' ),
			'view_item' => __( 'View Member', 'premitheme' ),
			'search_items' => __( 'Search Team Members', 'premitheme' ),
			'not_found' => __( 'No Members Found', 'premitheme' ),
			'not_found_in_trash' => __( 'No Members Found in Trash', 'premitheme' ),
	
		),
		'description' => __( 'Create, delete and edit Team members to be shown in "About us" page template', 'premitheme' ),
		'public' => true,
		'show_ui' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => true,
		'menu_position' => 20,
		'query_var' => true,
		'supports' => array( 'title' ),
		'menu_icon' => get_template_directory_uri().'/functions/post-types/team.png',
		'rewrite' => true
		)
	);
	flush_rewrite_rules( false );
}



/*-----------------------------/
	EDIT LIST CUSTOM COLUMNS
/-----------------------------*/
add_filter("manage_edit-team_columns", "team_edit_columns");

add_action("manage_posts_custom_column",  "team_columns_display", 10, 2);

add_theme_support( 'post-thumbnails', array( 'team' ) );
   
function team_edit_columns($team_columns){
    $team_columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => _x('Member', 'column name', 'premitheme'),
        "team_thumbnail" => __('Thumbnail', 'premitheme'),
        "author" => __('Author', 'premitheme'),
        "date" => __('Date', 'premitheme'),
    );
    return $team_columns;
}

function team_columns_display($team_columns, $post_id){
    switch ($team_columns)
    {
        // Code from: http://wpengineer.com/display-post-thumbnail-post-page-overview
            
        case "team_thumbnail":
            $thumb_src = get_post_meta($post_id, 'memberImgURL', TRUE);
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



/*-----------------------------------------/
	CHANGE TITLE FIELD PLACEHOLDER TEXT
/-----------------------------------------*/
function team_title_text( $title ){
	$screen = get_current_screen();
	if ( 'team' == $screen->post_type ) {
		$title = "Enter member's name here";
	}
	return $title;
}
add_filter( 'enter_title_here', 'team_title_text' );
