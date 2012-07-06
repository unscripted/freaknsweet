<?php

function pt_add_page_metabox() {
add_meta_box( 'folio_cat_settings', __('Portfolio Category Settings', 'premitheme'), 'pt_folio_cat_metabox_inner', 'page', 'normal' , 'high' );
}
add_action( 'add_meta_boxes', 'pt_add_page_metabox' );


add_action( 'save_post', 'pt_folio_cat_metabox_save' );




//========================================//
// RENDER METABOXS
//========================================//
//-----------------------------//
// PORTFOLIO CATEGORY METABOX
//-----------------------------//
function pt_folio_cat_metabox_inner( $post ) {
	global $post, $post_vals;
	$post_vals = get_post_custom( $post->ID );
	$folioCat = isset( $post_vals['folioCat'] ) ? esc_attr( $post_vals['folioCat'][0] ) : '0';
	wp_nonce_field( 'folio_cat_meta_box_nonce', 'folio-cat-meta-box-nonce' );
	
	$folio_cats = get_categories('taxonomy=portfolio_cats');
	
	?>
	
	<div class="section first">
		<label for="folioCat"><strong><?php _e( 'Portfolio Category', 'premitheme' ); ?></strong></label>
		<select id="folioCat" name="folioCat">
		
			<option value="0">Please select &hellip;</option>
		
		<?php foreach ( $folio_cats as $folio_cat ): ?>
			<option value="<?php echo $folio_cat->cat_ID; ?>" <?php selected( $folio_cat->cat_ID, $folioCat ); ?>><?php echo $folio_cat->cat_name; ?></option>
		<?php endforeach; ?>
		
		</select>
		<p><?php _e( 'Select portfolio category to display its items', 'premitheme' ); ?></p>
	</div>
	
	<?php 
}



//========================================//
// SAVE METABOXS
//========================================//
//-----------------------------//
// PORTFOLIO CATEGORY SAVE
//-----------------------------//
function pt_folio_cat_metabox_save( $post_id )  {  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['folio-cat-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['folio-cat-meta-box-nonce'], 'folio_cat_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;  
    
    if( isset( $_POST['folioCat'] ) )  
        update_post_meta( $post_id, 'folioCat', esc_attr( $_POST['folioCat'] ) );
}

