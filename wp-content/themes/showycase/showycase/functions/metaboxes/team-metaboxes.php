<?php

function pt_add_team_metabox() {
add_meta_box( 'team_settings', __('Team Member Settings', 'premitheme'), 'pt_team_metabox_inner', 'team', 'normal' , 'high' );
}
add_action( 'add_meta_boxes', 'pt_add_team_metabox' );


add_action( 'save_post', 'pt_team_metabox_save' );




//========================================//
// RENDER METABOXS
//========================================//
//-----------------------------//
// NIVO SLIDER
//-----------------------------//
function pt_team_metabox_inner( $post ) {
	global $post, $post_vals, $memberImgWidth;
	$post_vals = get_post_custom( $post->ID );
	$memberImgURL = isset( $post_vals['memberImgURL'] ) ? esc_attr( $post_vals['memberImgURL'][0] ) : '';
	$memberRole = isset( $post_vals['memberRole'] ) ? esc_attr( $post_vals['memberRole'][0] ) : '';
	$memberTwitter = isset( $post_vals['memberTwitter'] ) ? esc_attr( $post_vals['memberTwitter'][0] ) : '';
	$memberWeb = isset( $post_vals['memberWeb'] ) ? esc_attr( $post_vals['memberWeb'][0] ) : '';
	$memberBio = isset( $post_vals['memberBio'] ) ? esc_attr( $post_vals['memberBio'][0] ) : '';

	wp_nonce_field( 'team_meta_box_nonce', 'team-meta-box-nonce' ); 
	?>
	
	<div class="section first">
		<label for="memberImgURL"><strong><?php _e( 'Personal Photo', 'premitheme' ); ?></strong></label>
		<input type="text" id="memberImgURL" name="memberImgURL" value="<?php echo $memberImgURL; ?>">
		<input type="button" name="upload_image_button" class="upload_img button" value="<?php _e( 'Upload', 'premitheme' ); ?>" />
		<p><?php printf( __( 'Minimum <strong>%s</strong>. Always use the full absolute URL including "http://"', 'premitheme' ), $memberImgWidth ); ?></p>
	</div>
	
	<div class="section">
		<label for="memberRole"><strong><?php _e( 'Role', 'premitheme' ); ?></strong></label>
		<input type="text" id="memberRole" name="memberRole" value="<?php echo $memberRole; ?>">
		<p><?php _e( 'e.g. Designer', 'premitheme' ); ?></p>
	</div>
	
	<div class="section">
		<label for="memberTwitter"><strong><?php _e( 'Twitter', 'premitheme' ); ?></strong></label>
		<input type="text" id="memberTwitter" name="memberTwitter" value="<?php echo $memberTwitter; ?>">
		<p><?php _e( 'Enter personal twitter profile URL', 'premitheme' ); ?></p>
	</div>
	
	<div class="section">
		<label for="memberWeb"><strong><?php _e( 'Personal Website', 'premitheme' ); ?></strong></label>
		<input type="text" id="memberWeb" name="memberWeb" value="<?php echo $memberWeb; ?>">
		<p><?php _e( 'Enter personal website URL', 'premitheme' ); ?></p>
	</div>
		
	<div class="section">
		<label for="memberBio"><strong><?php _e( 'Bio', 'premitheme' ); ?></strong></label>
		<textarea id="memberBio" name="memberBio" cols="50" rows="4"><?php echo $memberBio; ?></textarea>
		<p><?php _e( 'Short member\'s biography.', 'premitheme' ); ?></p>
	</div>
	
	<?php 
}


//========================================//
// SAVE METABOXS
//========================================//
//-----------------------------//
// NIVO SLIDER
//-----------------------------//
function pt_team_metabox_save( $post_id )  {  
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
	if( !isset( $_POST['team-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['team-meta-box-nonce'], 'team_meta_box_nonce' ) ) return; 
	if( !current_user_can( 'edit_post' ) ) return;  
	
	if( isset( $_POST['memberImgURL'] ) )  
		update_post_meta( $post_id, 'memberImgURL', esc_attr( $_POST['memberImgURL'] ) );
		
	if( isset( $_POST['memberRole'] ) )  
		update_post_meta( $post_id, 'memberRole', esc_attr( $_POST['memberRole'] ) );
		
	if( isset( $_POST['memberTwitter'] ) )  
		update_post_meta( $post_id, 'memberTwitter', esc_attr( $_POST['memberTwitter'] ) );
		
	if( isset( $_POST['memberWeb'] ) )  
		update_post_meta( $post_id, 'memberWeb', esc_attr( $_POST['memberWeb'] ) );
		
	if( isset( $_POST['memberBio'] ) )  
		update_post_meta( $post_id, 'memberBio', esc_attr( $_POST['memberBio'] ) );
}

