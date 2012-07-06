<?php

function pt_add_nivoSlides_metabox() {
add_meta_box( 'nivo_slide_settings', __('Slide Settings', 'premitheme'), 'pt_nivo_metabox_inner', 'slides', 'normal' , 'high' );
}
add_action( 'add_meta_boxes', 'pt_add_nivoSlides_metabox' );


add_action( 'save_post', 'pt_nivo_metabox_save' );




//========================================//
// RENDER METABOXS
//========================================//
//-----------------------------//
// NIVO SLIDER
//-----------------------------//
function pt_nivo_metabox_inner( $post ) {
	global $post, $post_vals, $sliderImgWidth;
	$post_vals = get_post_custom( $post->ID );
	$nivoImgURL = isset( $post_vals['nivoImgURL'] ) ? esc_attr( $post_vals['nivoImgURL'][0] ) : '';
	$nivoLink = isset( $post_vals['nivoLink'] ) ? esc_attr( $post_vals['nivoLink'][0] ) : '';
	$nivoCaption1 = isset( $post_vals['nivoCaption1'] ) ? esc_attr( $post_vals['nivoCaption1'][0] ) : '';
	$nivoCaption2 = isset( $post_vals['nivoCaption2'] ) ? esc_attr( $post_vals['nivoCaption2'][0] ) : '';
	wp_nonce_field( 'nivo_meta_box_nonce', 'nivo-meta-box-nonce' ); 
	?>
	
	<div class="section first">
		<label for="nivoImgURL"><strong><?php _e( 'Slide Image URL', 'premitheme' ); ?></strong></label>
		<input type="text" id="nivoImgURL" name="nivoImgURL" value="<?php echo $nivoImgURL; ?>">
		<input type="button" name="upload_image_button" class="upload_img button" value="<?php _e( 'Upload', 'premitheme' ); ?>" />
		<p><?php printf( __( 'Image MUSTN\'T be less than <strong>%s width</strong> with no height limitations. But all slides should be the same height, and set slider height from <strong>Theme Options > Home Settings</strong> to the same. Always use the full absolute URL including "http://"', 'premitheme' ), $sliderImgWidth ); ?></p>
	</div>
	
	<div class="section">
		<label for="nivoLink"><strong><?php _e( 'Slide Link (optional)', 'premitheme' ); ?></strong></label>
		<input type="text" id="nivoLink" name="nivoLink" value="<?php echo $nivoLink; ?>">
		<p><?php _e( 'Insert a link URL if you want the slide to be hyperliked to somewhere. Always use the full absolute URL including "http://"', 'premitheme' ); ?></p>
	</div>
	
	<div class="section">
		<label for="nivoCaption1"><strong><?php _e( 'Slide Caption - First Line (optional)', 'premitheme' ); ?></strong></label>
		<textarea id="nivoCaption1" name="nivoCaption1" cols="50" rows="4"><?php echo $nivoCaption1; ?></textarea>
		<p><?php _e( 'First line caption text for this slide.', 'premitheme' ); ?></p>
	</div>
	
	<div class="section">
		<label for="nivoCaption2"><strong><?php _e( 'Slide Caption - Second Line (optional)', 'premitheme' ); ?></strong></label>
		<textarea id="nivoCaption2" name="nivoCaption2" cols="50" rows="4"><?php echo $nivoCaption2; ?></textarea>
		<p><?php _e( 'Second line caption text for this slide.', 'premitheme' ); ?></p>
	</div>
	
	<p><?php _e( '<strong>Note:</strong> Go to <strong>Theme Options > Home Settings</strong> for the available customization options for the slider', 'premitheme' ); ?></p>
	
	<?php 
}


//========================================//
// SAVE METABOXS
//========================================//
//-----------------------------//
// NIVO SLIDER
//-----------------------------//
function pt_nivo_metabox_save( $post_id )  {  
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
	if( !isset( $_POST['nivo-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['nivo-meta-box-nonce'], 'nivo_meta_box_nonce' ) ) return; 
	if( !current_user_can( 'edit_post' ) ) return;  
	
	if( isset( $_POST['nivoImgURL'] ) )  
		update_post_meta( $post_id, 'nivoImgURL', esc_attr( $_POST['nivoImgURL'] ) );
	if( isset( $_POST['nivoLink'] ) )  
		update_post_meta( $post_id, 'nivoLink', esc_attr( $_POST['nivoLink'] ) );
	if( isset( $_POST['nivoCaption1'] ) )  
		update_post_meta( $post_id, 'nivoCaption1', esc_attr( $_POST['nivoCaption1'] ) );
	if( isset( $_POST['nivoCaption2'] ) )  
		update_post_meta( $post_id, 'nivoCaption2', esc_attr( $_POST['nivoCaption2'] ) );
}

