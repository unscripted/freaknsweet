<?php
/*-----------------------------/
	REGISTER POST TYPE
/-----------------------------*/
add_action( 'init', 'portfolio_post_type' );

function portfolio_post_type() {
	$folioSlug = of_get_option('folio_slug');
	
	register_post_type( 'portfolio',
	array(
		'labels' => array(
			'name' => __( 'Portfolio Items', 'premitheme' ),
			'singular_name' => __( 'Portfolio Item', 'premitheme' ),
			'add_new' => __( 'Add New Item', 'premitheme' ),
			'add_new_item' => __( 'Add New Portfolio Item', 'premitheme' ),
			'edit' => __( 'Edit', 'premitheme' ),
			'edit_item' => __( 'Edit Portfolio Item', 'premitheme' ),
			'new_item' => __( 'New Portfolio Item', 'premitheme' ),
			'view' => __( 'View Portfolio Item', 'premitheme' ),
			'view_item' => __( 'View Portfolio Item', 'premitheme' ),
			'search_items' => __( 'Search Portfolio Items', 'premitheme' ),
			'not_found' => __( 'No Portfolio Items Found', 'premitheme' ),
			'not_found_in_trash' => __( 'No Portfolio Items Found in Trash', 'premitheme' ),
		),
		'description' => __( 'You can put your portfolio items here. They can be design work, photography, projects or any kind of content you want to showcase', 'premitheme' ),
		'public' => true,
		'menu_position' => 20,
		'capability_type' => 'post',
		'has_archive' => false,
		'exclude_from_search' => false,
		'hierarchical' => false,
		'supports' => array( 'title', 'editor', 'thumbnail' ),
		'menu_icon' => get_template_directory_uri().'/functions/post-types/portfolio.png',
		'rewrite' => array( 'slug' => $folioSlug, 'with_front' => FALSE )
		)
	);
	flush_rewrite_rules( false );
}



/*-----------------------------/
	REGISTER TAXONOMIES
/-----------------------------*/
add_action( 'init', 'portfolio_taxonomies' );

function portfolio_taxonomies() {
	
	// PORTFOLIO CATEGORIES
	register_taxonomy(  
	'portfolio_cats', 'portfolio',  
	array(  
	    'hierarchical' => true,  
	    'labels' => array(
	    	'name' => __( 'Portfolio Categories', 'premitheme' ),
	    	'singular_name' => __( 'Portfolio Category', 'premitheme' ),
	    	'search_items' => __( 'Search Portfolio Categories', 'premitheme' ),
	    	'popular_items' => __( 'Popular Portfolio Categories', 'premitheme' ),
	    	'all_items' => __( 'All Portfolio Categories', 'premitheme' ),
	    	'edit_item' => __( 'Edit Portfolio Category', 'premitheme' ),
	    	'update_item' => __( 'Update Portfolio Category', 'premitheme' ),
	    	'add_new_item' => __( 'Add New Portfolio Category', 'premitheme' ),
	    	'new_item_name' => __( 'New Portfolio Category Name', 'premitheme' ),
	    	'separate_items_with_commas' => __( 'Separate Portfolio Categories With Commas', 'premitheme' ),
	    	'add_or_remove_items' => __( 'Add or Remove Portfolio Categories', 'premitheme' ),
	    	'choose_from_most_used' => __( 'Choose From Most Used Portfolio Categories', 'premitheme' ),  
	    	'parent' => __( 'Parent Portfolio Category', 'premitheme' )      	
	    	),
	    'query_var' => true,  
	    'rewrite' => true  
		)  
	);
	
	// PORTFOLIO SKILLS
	register_taxonomy(  
	'portfolio_skills', 'portfolio',  
	array(  
	    'hierarchical' => false,  
	    'labels' => array(
	    	'name' => __( 'Skills', 'premitheme' ),
	    	'singular_name' => __( 'Skill', 'premitheme' ),
	    	'search_items' => __( 'Search Skills', 'premitheme' ),
	    	'popular_items' => __( 'Popular Skills', 'premitheme' ),
	    	'all_items' => __( 'All Skills', 'premitheme' ),
	    	'edit_item' => __( 'Edit Skill', 'premitheme' ),
	    	'update_item' => __( 'Update Skill', 'premitheme' ),
	    	'add_new_item' => __( 'Add New Skill', 'premitheme' ),
	    	'new_item_name' => __( 'New PSkill Name', 'premitheme' ),
	    	'separate_items_with_commas' => __( 'Separate Skills With Commas', 'premitheme' ),
	    	'add_or_remove_items' => __( 'Add or Remove Skills', 'premitheme' ),
	    	'choose_from_most_used' => __( 'Choose From Most Used Skills', 'premitheme' ),  
	    	),
	    'query_var' => true,  
	    'rewrite' => true  
		)  
	);
}



/*-----------------------------/
	EDIT LIST CUSTOM COLUMNS
/-----------------------------*/
add_filter("manage_edit-portfolio_columns", "portfolio_edit_columns");

add_action("manage_posts_custom_column",  "portfolio_columns_display", 10, 2);

add_theme_support( 'post-thumbnails', array( 'portfolio' ) );
 
function portfolio_edit_columns($portfolio_columns){
    $portfolio_columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => _x('Title', 'column name', 'premitheme'),
        "folio_thumbnail" => __('Thumbnail', 'premitheme'),
        "portfolio-cats" => __('Portfolio Categories', 'premitheme'),
        "author" => __('Author', 'premitheme'),
        "date" => __('Date', 'premitheme'),
    );
    return $portfolio_columns;
}
 
function portfolio_columns_display($portfolio_columns, $post_id){
    switch ($portfolio_columns)
    {
        // Code from: http://wpengineer.com/display-post-thumbnail-post-page-overview
 
        case "folio_thumbnail":
            $thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );

            if ($thumbnail_id) $thumb = wp_get_attachment_image( $thumbnail_id, '100x100', true );
            
            if ( isset($thumb) && $thumb ) {
                echo $thumb;
            } else {
                echo __('None', 'premitheme');
            }
        break;
        
        case "portfolio-cats":
            global $post;
            if ($cat_list = get_the_term_list( $post->ID, 'portfolio_cats', '', ', ', '' ) ) {
                echo $cat_list;
            } else {
                echo __('None', 'premitheme');
            }
        break;
    }
}


/*-----------------------------------------/
	CHANGE TITLE FIELD PLACEHOLDER TEXT
/-----------------------------------------*/
function folio_title_text( $title ){
	$screen = get_current_screen();
	if ( 'portfolio' == $screen->post_type ) {
		$title = "Enter portfolio items's name here";
	}
	return $title;
}
add_filter( 'enter_title_here', 'folio_title_text' );