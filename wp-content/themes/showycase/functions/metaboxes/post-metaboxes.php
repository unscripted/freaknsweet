<?php

function pt_add_post_metabox() {
add_meta_box( 'linkf_settings', __('"Link" Format Settings', 'premitheme'), 'pt_linkf_metabox_inner', 'post', 'normal' , 'high' );
add_meta_box( 'videof_settings', __('"Video" Format Settings', 'premitheme'), 'pt_videof_metabox_inner', 'post', 'normal' , 'high' );
//add_meta_box( 'audiof_settings', __('"Audio" Format Settings', 'premitheme'), 'pt_audiof_metabox_inner', 'post', 'normal' , 'high' );
add_meta_box( 'quotef_settings', __('"Quote" Format Settings', 'premitheme'), 'pt_quotef_metabox_inner', 'post', 'normal' , 'high' );
add_meta_box( 'galleryf_settings', __('"Gallery" Format Settings', 'premitheme'), 'pt_galleryf_metabox_inner', 'post', 'normal' , 'high' );
}
add_action( 'add_meta_boxes', 'pt_add_post_metabox' );


add_action( 'save_post', 'pt_linkf_metabox_save' );
add_action( 'save_post', 'pt_videof_metabox_save' );
//add_action( 'save_post', 'pt_audiof_metabox_save' );
add_action( 'save_post', 'pt_quotef_metabox_save' );
add_action( 'save_post', 'pt_galleryf_metabox_save' );



//-----------------------------//
// DYNAMIC IMAGE UPLOAD ROW
//-----------------------------//
function Print_gallery_image_fileds($cnt, $gallImgUrl = null) {
if ($gallImgUrl === null){
    $a = '';
}else{
    $a = $gallImgUrl;
}
return 
'<div class="dynamicField">
	<input type="text" name="gallImg['.$cnt.']" value="'.$a.'">
	<input type="button" name="upload_image_button" class="upload_img button" value="'. __('Upload', 'premitheme') .'" />
	<input type="button" name="remove" class="remove button" value="&times;" />
</div>';}


//========================================//
// RENDER METABOXS
//========================================//
//-----------------------------//
// LINK POST FORMAT
//-----------------------------//
function pt_linkf_metabox_inner( $post ) {
	global $post, $post_vals;
	$post_vals = get_post_custom( $post->ID );
	$linkURL = isset( $post_vals['linkURL'] ) ? esc_attr( $post_vals['linkURL'][0] ) : '';
	wp_nonce_field( 'link_meta_box_nonce', 'link-meta-box-nonce' ); 
	?>
	
	<div class="section first">
		<label for="linkURL"><strong><?php _e( 'Link URL', 'premitheme' ); ?></strong></label>
		<input type="text" id="linkURL" name="linkURL" value="<?php echo $linkURL; ?>">
		<p><?php _e( 'Insert the full absolute URL including "http://"', 'premitheme' ); ?></p>
	</div>
	
	<?php 
}


//-----------------------------//
// VIDEO POST FORMAT
//-----------------------------//
function pt_videof_metabox_inner( $post ) {
	global $post;
	$post_vals = get_post_custom( $post->ID );
	$videoURL = isset( $post_vals['videoURL'] ) ? esc_attr( $post_vals['videoURL'][0] ) : '';
	wp_nonce_field( 'video_meta_box_nonce', 'video-meta-box-nonce' ); 
	?>
	
	<div class="section first">
		<label for="videoURL"><strong><?php _e( 'Remotely Hosted Video URL', 'premitheme' ); ?></strong></label>
		<input type="text" id="videoURL" name="videoURL" value="<?php echo $videoURL; ?>">
		<p><?php _e( 'Only remotely-hosted videos supported (i.e. youtube, vimeo &hellip; etc). Always use the full absolute URL including "http://".', 'premitheme' ); ?> <a href="http://codex.wordpress.org/Embeds" target="_blank"><?php _e( 'List of supported video hosts', 'premitheme'); ?></a></p>
	</div>
	
	<?php 
}



//-----------------------------//
// QUOTE POST FORMAT
//-----------------------------//
function pt_quotef_metabox_inner( $post ) {
	global $post;
	$post_vals = get_post_custom( $post->ID );
	$quoteText = isset( $post_vals['quoteText'] ) ? esc_attr( $post_vals['quoteText'][0] ) : '';
	wp_nonce_field( 'quote_meta_box_nonce', 'quote-meta-box-nonce' ); 
	?>
	
	<div class="section first">
		<label for="quoteText"><strong><?php _e( 'Quote Text', 'premitheme' ); ?></strong></label>
		<textarea id="quoteText" name="quoteText" cols="50" rows="4"><?php echo $quoteText; ?></textarea>
		<p><?php _e( 'Insert the quote text here', 'premitheme' ); ?></p>
	</div>
	
	<?php 
}


//-----------------------------//
// GALLERY POST FORMAT
//-----------------------------//
function pt_galleryf_metabox_inner( $post ) {
	global $post;
	$gallImages = get_post_meta($post->ID,"gallImg",true);
	$post_vals = get_post_custom( $post->ID );
	$galleryHeight = isset( $post_vals['galleryHeight'] ) ? esc_attr( $post_vals['galleryHeight'][0] ) : '';
	wp_nonce_field( 'gallery_meta_box_nonce', 'gallery-meta-box-nonce' );
	?>
	
	<div class="section first">
		<label for="galleryHeight"><strong><?php _e( 'Gallery Slider Height', 'premitheme' ); ?></strong></label>
		<input type="text" id="galleryHeight" name="galleryHeight" value="<?php echo $galleryHeight; ?>" class="small">px
		<p><?php _e( 'Gallery slider height is a <strong>must</strong>. please insert height in pixels. e.g. 300', 'premitheme' ); ?></p>
	</div>
	
	<div class="section">
		<div id="gallImgs">
			<label for="prevImg"><strong><?php _e('Gallery Slides', 'premitheme');?></strong></label>
			<?php
			$c = 1;
			if (count($gallImages) > 0){
				foreach((array)$gallImages as $gallImgUrl ){
					echo Print_gallery_image_fileds($c,$gallImgUrl);
					$c = $c +1;
				}
			
			}?>
		</div>
		<span id="here"></span>
		<input type="button" name="add" class="add button" value="<?php _e('+ Add Preview Image', 'premitheme');?>" />
		
		<script>
	        var $ =jQuery.noConflict();
	            $(document).ready(function() {
	            
	            if ( $('.dynamicField:first input:first').val() == '' ){
	            	$('.dynamicField:first .remove').hide();
	            }
	            
	            
	            $('.dynamicField:first').find('input:first').change(function() {
	            	if ( $('.dynamicField:first input:first').val() == '' ){
	            		$('.dynamicField:first .remove').hide();
	            	}
	            	else {
	            		$('.dynamicField:first .remove').show();
	            	}
	            });
	            
	            $('.dynamicField:first').find('.upload_img').click(function() {
	            	if ( $('.dynamicField:first input:first').val() == '' ){
	            		$('.dynamicField:first .remove').show();
	            	}
	            });
	            
	            
	            var count = <?php echo $c; ?>;
	            $(".add").click(function() {
	                count = count + 1;
	                $('#gallImgs').append('<?php echo implode('',explode("\n",Print_gallery_image_fileds('count'))); ?>'.replace(/count/g, count));
	                return false;
	            });
	            $(".remove").live('click', function() {
	                $(this).parent().remove();
	            });
	        });
	    </script>
	</div>
	
	<?php 
}



//========================================//
// SAVE METABOXS
//========================================//
//-----------------------------//
// LINK POST FORMAT
//-----------------------------//
function pt_linkf_metabox_save( $post_id )  {  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['link-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['link-meta-box-nonce'], 'link_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;  
    
    if( isset( $_POST['linkURL'] ) )  
        update_post_meta( $post_id, 'linkURL', esc_attr( $_POST['linkURL'] ) );
}


//-----------------------------//
// VIDEO POST FORMAT
//-----------------------------//
function pt_videof_metabox_save( $post_id )  {  
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
	if( !isset( $_POST['video-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['video-meta-box-nonce'], 'video_meta_box_nonce' ) ) return; 
	if( !current_user_can( 'edit_post' ) ) return;  
	
	if( isset( $_POST['videoURL'] ) )  
		update_post_meta( $post_id, 'videoURL', esc_attr( $_POST['videoURL'] ) );
}


//-----------------------------//
// QUOTE POST FORMAT
//-----------------------------//
function pt_quotef_metabox_save( $post_id )  {  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['quote-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['quote-meta-box-nonce'], 'quote_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;  
    
    if( isset( $_POST['quoteText'] ) )  
        update_post_meta( $post_id, 'quoteText', esc_attr( $_POST['quoteText'] ) );
}


//-----------------------------//
// GALLERY POST FORMAT
//-----------------------------//
function pt_galleryf_metabox_save( $post_id )  {  
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
	if( !isset( $_POST['gallery-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['gallery-meta-box-nonce'], 'gallery_meta_box_nonce' ) ) return; 
	if( !current_user_can( 'edit_post' ) ) return;  
	
	if( isset( $_POST['galleryHeight'] ) )  
		update_post_meta( $post_id, 'galleryHeight', esc_attr( $_POST['galleryHeight'] ) );
	
	if (isset($_POST['gallImg'])){
        $gallImages = $_POST['gallImg'];
        update_post_meta($post_id,'gallImg',$gallImages);
    }else{
        delete_post_meta($post_id,'gallImg');
    }
}

