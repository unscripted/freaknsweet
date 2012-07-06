<?php




/* Create one or more meta boxes to be displayed on the post editor screen. */
function post_links_metabox() {

	add_meta_box(
		'post_links',			// Unique ID
		__( 'Post Links', 'freaknsweet' ),		// Title
		'post_links_metabox_inner',		// Callback function
		'post',					// Admin page (or post type)
		'side',
		'default'					// Priority
	);
}

add_action( 'add_meta_boxes', 'post_links_metabox' );
add_action( 'save_post', 'post_links_metabox_save' );

/* Display the post meta box. */
function post_links_metabox_inner( $post ) { 
	global $post;
	$post_vals = get_post_custom( $post->ID );
	$price = isset( $post_vals['price'] ) ? esc_attr( $post_vals['price'][0] ) : '';
	$buylinkURL = isset( $post_vals['price'] ) ? esc_attr( $post_vals['buylinkURL'][0] ) : '';
	$sourceURL = isset( $post_vals['price'] ) ? esc_attr( $post_vals['sourceURL'][0] ) : '';
	wp_nonce_field( 'post_links_metabox_nonce', 'post-links-metabox-nonce' );
	?>
	
	<div class="section first">
		<label for="price"><strong><?php _e( 'Price', 'freaknsweet' ); ?></strong></label>
		<input type="text" id="price" name="price" value="<?php echo $price; ?>" class="small">
		<br /><br />
		<label for="buylinkURL"><strong><?php _e( 'Purchase URL', 'freaknsweet' ); ?></strong></label>
		<input type="text" id="buylinkURL" name="buylinkURL" value="<?php echo $buylinkURL; ?>" style="width:255px">
		<p><?php _e( 'Insert the full absolute URL to product site including "http://"', 'freaknsweet' ); ?></p>
	</div>
    
    <div class="section">
		<label for="sourceURL"><strong><?php _e( 'Source URL', 'freaknsweet' ); ?></strong></label>
		<input type="text" id="sourceURL" name="sourceURL" value="<?php echo $sourceURL; ?>" style="width:255px">
		<p><?php _e( 'Insert the full absolute URL to source including "http://" <br />
<strong>Do not use for products.</strong> ', 'freaknsweet' ); ?></p>
	</div>
	
	<?php 
}

/* Save the post meta box. */
function post_links_metabox_save( $post_id )  {  
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
	if( !isset( $_POST['post-links-metabox-nonce'] ) || !wp_verify_nonce( $_POST['post-links-metabox-nonce'], 'post_links_metabox_nonce' ) ) return; 
	if( !current_user_can( 'edit_post' ) ) return;  
	
	if( isset( $_POST['price'] ) )  
		update_post_meta( $post_id, 'price', esc_attr( $_POST['price'] ) );
	
	if( isset( $_POST['buylinkURL'] ) )  
        update_post_meta( $post_id, 'buylinkURL', esc_attr( $_POST['buylinkURL'] ) );

	if( isset( $_POST['sourceURL'] ) )  
        update_post_meta( $post_id, 'sourceURL', esc_attr( $_POST['sourceURL'] ) );
}


?>