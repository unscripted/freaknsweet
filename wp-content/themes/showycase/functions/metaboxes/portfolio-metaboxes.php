<?php

function pt_add_portfolio_metabox() {
add_meta_box( 'portfolio_item_settengs', __('Portfolio Item Settings', 'premitheme'), 'pt_portfolio_metabox_inner', 'portfolio', 'normal' , 'high' );
}
add_action( 'add_meta_boxes', 'pt_add_portfolio_metabox' );

add_action( 'save_post', 'pt_portfolio_metabox_save' );



//-----------------------------//
// DYNAMIC IMAGE UPLOAD ROW
//-----------------------------//
function Print_folio_image_fileds($cnt, $prevImgUrl = null) {
if ($prevImgUrl === null){
    $a = '';
}else{
    $a = $prevImgUrl;
}
return 
'<div class="dynamicField">
	<input type="text" name="prevImg['.$cnt.']" value="'.$a.'">
	<input type="button" name="upload_image_button" class="upload_img button" value="'. __('Upload', 'premitheme') .'" />
	<input type="button" name="remove" class="remove button" value="&times;" />
</div>';}

//========================================//
// RENDER METABOXS
//========================================//
//-----------------------------//
// PORTFOLIO ITEM SETTINGS
//-----------------------------//
function pt_portfolio_metabox_inner( $post ) {
	global $post, $post_vals, $folioImgWidth;
	$prevImages = get_post_meta($post->ID,"prevImg",true);
	$post_vals = get_post_custom( $post->ID );
	$folioDate = isset( $post_vals['folioDate'] ) ? esc_attr( $post_vals['folioDate'][0] ) : '';
	$folioClient = isset( $post_vals['folioClient'] ) ? esc_attr( $post_vals['folioClient'][0] ) : '';
	$folioUrl = isset( $post_vals['folioUrl'] ) ? esc_attr( $post_vals['folioUrl'][0] ) : '';
	$prevVid = isset( $post_vals['prevVid'] ) ? esc_attr( $post_vals['prevVid'][0] ) : '';
	$prevHeight = isset( $post_vals['prevHeight'] ) ? esc_attr( $post_vals['prevHeight'][0] ) : '';
	
	wp_nonce_field( 'folio_meta_box_nonce', 'folio-meta-box-nonce' ); 
	?>
	
	<div class="section first">
		<label for="folioDate"><strong><?php _e( 'Completion Date', 'premitheme' ); ?></strong></label>
		<input type="text" id="folioDate" name="folioDate" value="<?php echo $folioDate; ?>" class="medium">
		<p><?php _e( 'e.g. "Sep 2011"', 'premitheme' ); ?></p>
	</div>
	
	<div class="section">
		<label for="folioClient"><strong><?php _e( 'Client', 'premitheme' ); ?></strong></label>
		<input type="text" id="folioClient" name="folioClient" value="<?php echo $folioClient; ?>">
	</div>
	
	<div class="section">
		<label for="folioUrl"><strong><?php _e( 'Project URL (if applicable)', 'premitheme' ); ?></strong></label>
		<input type="text" id="folioUrl" name="folioUrl" value="<?php echo $folioUrl; ?>">
	</div>
	
	<div class="section">
		<label for="prevHeight"><strong><?php _e( 'Preview Image(s) Height', 'premitheme' ); ?></strong></label>
		<input type="text" id="prevHeight" name="prevHeight" value="<?php echo $prevHeight; ?>" class="small">px
		<p><?php _e( 'You <strong>MUST</strong> set height if multiple images being used.', 'premitheme' ); ?></p>
	</div>
	
	<div class="section">
		<div id="prevImgs">
			<label for="prevImg"><strong><?php _e('Preview Image(s)', 'premitheme');?></strong></label>
			<?php
			$c = 1;
			if (count($prevImages) > 0){
				foreach((array)$prevImages as $prevImgUrl ){
					echo Print_folio_image_fileds($c,$prevImgUrl);
					$c = $c +1;
				}
			
			}?>
		</div>
		<span id="here"></span>
		<input type="button" name="add" class="add button" value="<?php _e('+ Add Preview Image', 'premitheme');?>" />
		<p><?php printf( __( "All images MUSTN'T be less than <strong>%s width</strong> with no max/min height", "premitheme" ), $folioImgWidth ); ?></p>
		
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
	                $('#prevImgs').append('<?php echo implode('',explode("\n",Print_folio_image_fileds('count'))); ?>'.replace(/count/g, count));
	                return false;
	            });
	            $(".remove").live('click', function() {
	                $(this).parent().remove();
	            });
	        });
	    </script>
	</div>
	
	<div class="section">
		<label for="prevVid"><strong><?php _e( 'Preview Video URL', 'premitheme' ); ?></strong></label>
		<input type="text" id="prevVid" name="prevVid" value="<?php echo $prevVid; ?>">
		<p><?php _e( 'Overrides any preview images. Only remotely-hosted videos supported (i.e. youtube, vimeo &hellip; etc). Always use the full absolute URL including "http://".', 'premitheme' ); ?> <a href="http://codex.wordpress.org/Embeds" target="_blank"><?php _e( 'List of supported video hosts', 'premitheme'); ?></a></p>
	</div>
	
	<?php 
}



//========================================//
// SAVE METABOXS
//========================================//
//-----------------------------//
// PORTFOLIO ITEM SETTINGS
//-----------------------------//
function pt_portfolio_metabox_save( $post_id )  {  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['folio-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['folio-meta-box-nonce'], 'folio_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;  
    
	if (isset($_POST['prevImg'])){
        $prevImages = $_POST['prevImg'];
        update_post_meta($post_id,'prevImg',$prevImages);
    }else{
        delete_post_meta($post_id,'prevImg');
    }
    
	if( isset( $_POST['prevVid'] ) )  
		update_post_meta( $post_id, 'prevVid', esc_attr( $_POST['prevVid'] ) );
	if( isset( $_POST['folioDate'] ) )  
		update_post_meta( $post_id, 'folioDate', esc_attr( $_POST['folioDate'] ) );
	if( isset( $_POST['folioClient'] ) )  
		update_post_meta( $post_id, 'folioClient', esc_attr( $_POST['folioClient'] ) );
	if( isset( $_POST['folioUrl'] ) )  
		update_post_meta( $post_id, 'folioUrl', esc_attr( $_POST['folioUrl'] ) );
	if( isset( $_POST['prevHeight'] ) )  
		update_post_meta( $post_id, 'prevHeight', esc_attr( $_POST['prevHeight'] ) );
}
