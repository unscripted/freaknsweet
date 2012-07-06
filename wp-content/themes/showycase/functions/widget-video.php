<?php

add_action( 'widgets_init', 'pt_video_widget' );

function pt_video_widget() {
	register_widget( 'Video_Widget' );
}


class Video_Widget extends WP_Widget {
	
	function Video_Widget() {
		global $themename;
		
		$widget_ops = array( 'classname' => 'widget_video', 'description' => __('Add video to the sidebar', 'premitheme') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'video-widget' ); //default width = 250
		$this->WP_Widget( 'video-widget', $themename.' - '.__('Video Embed', 'premitheme'), $widget_ops, $control_ops );
	}


/*-------------------------------/
	UPDATE & SAVE SETTINGS
/-------------------------------*/
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['url'] = strip_tags( $new_instance['url'] );
		$instance['caption'] = strip_tags( $new_instance['caption'] );
		
		return $instance;
	}
	
	
/*-------------------------------/
	RENDER WIDGET
/-------------------------------*/
	function widget($args, $instance) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$url = $instance['url'];
		$caption = $instance['caption'];
		
		
		echo $before_widget;
		if ( $title ) echo $before_title . $title . $after_title; 
		
		if ($url)
		$embed_code = wp_oembed_get($url, array('width'=>192));
		echo $embed_code;
		
		if ($caption)
		echo '<span class="video-caption">'.$caption.'</span>';
				
		echo $after_widget;
	}
	
	
/*-------------------------------/
	WIDGET SETTINGS
/-------------------------------*/
	function form($instance) {
		$defaults = array( 'title' => 'Video', 'url' => '', 'caption' => '');
		$instance = wp_parse_args( (array) $instance, $defaults );
?>
		
		<p>
			<label><?php _e('Title', 'premitheme');?>:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
			
		</p>
		
		<p>
			<label><?php _e('Video URL', 'premitheme');?>:</label>
			<input id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" value="<?php echo $instance['url']; ?>" class="widefat" type="text"/>
			
		</p>
		
		<p>
			<label><?php _e('Caption', 'premitheme');?>:</label>
			<input id="<?php echo $this->get_field_id( 'caption' ); ?>" name="<?php echo $this->get_field_name( 'caption' ); ?>" value="<?php echo $instance['caption']; ?>" class="widefat" type="text" />
			
		</p>
		
<?php		

	}
}
?>
