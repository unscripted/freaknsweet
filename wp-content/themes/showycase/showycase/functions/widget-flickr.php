<?php

add_action( 'widgets_init', 'pt_flickr_widget' );

function pt_flickr_widget() {
	register_widget( 'Flickr_Widget' );
}


class Flickr_Widget extends WP_Widget {
	
	function Flickr_Widget() {
		global $themename;
		
		$widget_ops = array( 'classname' => 'widget_flickr', 'description' => __('Add flickr photostream to the sidebar', 'premitheme') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'flickr-widget' ); //default width = 250
		$this->WP_Widget( 'flickr-widget', $themename.' - '.__('Flickr Photostream', 'premitheme'), $widget_ops, $control_ops );
	}


/*-------------------------------/
	UPDATE & SAVE SETTINGS
/-------------------------------*/
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['id'] = strip_tags( $new_instance['id'] );
		$instance['display'] = strip_tags( $new_instance['display'] );
		$instance['count'] = strip_tags( $new_instance['count'] );
		
		return $instance;
	}
	
	
/*-------------------------------/
	RENDER WIDGET
/-------------------------------*/
	function widget($args, $instance) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$id = $instance['id'];
		$display = $instance['display'];
		$count = $instance['count'];
		
		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;
		if ( $id ) ?>
		
		<div id="flickr_badge_uber_wrapper">
			<div id="flickr_badge_wrapper">
			
			<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $count; ?>&display=<?php echo $display; ?>&size=s&layout=x&source=user&user=<?php echo $id; ?>"></script>
			
			<div class="clear"></div>
			</div>
		</div>
		
		<?php
		echo $after_widget;
	}
	
	
/*-------------------------------/
	WIDGET SETTINGS
/-------------------------------*/
	function form($instance) {
		$defaults = array( 'title' => 'Flickr', 'id' => '', 'count' => '6', 'display' => 'latest');
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		
		<p>
			<label><?php _e('Title', 'premitheme');?>:
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
			</label>
		</p>
		
		<p>
			<label><?php _e('ID', 'premitheme');?>: <i style="font-size:11px;"><?php _e('Get yours from', 'premitheme');?> <a href="http://idgettr.com" target="_blank">idgettr.com</a></i>
			<input id="<?php echo $this->get_field_id( 'id' ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>" value="<?php echo $instance['id']; ?>" class="widefat" type="text"/>
			</label>
		</p>
		
		<p>
			<label><?php _e('Photos to diplay', 'premitheme');?>:
			<select class="widefat" id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>">
			<option value="0" style="font-weight:bold;font-style:italic;"><?php _e('Select Option...', 'premitheme');?></option>
			<option value="latest" <?php selected($instance['display'], 'latest'); ?>><?php _e('Latest', 'premitheme');?></option>
			<option value="random" <?php selected($instance['display'], 'random'); ?>><?php _e('Random', 'premitheme');?></option>
			</select>
			</label>
		</p>
		
		<p>
			<label><?php _e('No. of photos', 'premitheme');?>:
			<select class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>">
			<option value="0" style="font-weight:bold;font-style:italic;"><?php _e('Select Option...', 'premitheme');?></option>
			<option value="3" <?php selected($instance['count'], '3'); ?>>3</option>
			<option value="6" <?php selected($instance['count'], '6'); ?>>6</option>
			<option value="9" <?php selected($instance['count'], '9'); ?>>9</option>
			</select>
			</label>
		</p>
		
		<?php		
	}
}
