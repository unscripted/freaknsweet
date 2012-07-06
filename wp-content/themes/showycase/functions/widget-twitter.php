<?php

add_action( 'widgets_init', 'pt_twitter_widget' );

function pt_twitter_widget() {
	register_widget( 'Twitter_Widget' );
}


class Twitter_Widget extends WP_Widget {
	
	function Twitter_Widget() {
		global $themename;
		
		$widget_ops = array( 'classname' => 'widget_twitter', 'description' => __('Add Twitter feeds to the sidebar', 'premitheme') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'twitter-widget' ); //default width = 250
		$this->WP_Widget( 'twitter-widget', $themename.' - '.__('Twitter Feeds', 'premitheme'), $widget_ops, $control_ops );
	}


/*-------------------------------/
	UPDATE & SAVE SETTINGS
/-------------------------------*/
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['count'] = strip_tags( $new_instance['count'] );
		
		return $instance;
	}
	
	
/*-------------------------------/
	RENDER WIDGET
/-------------------------------*/
	function widget($args, $instance) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$username = $instance['username'];
		$count = $instance['count'];
		
		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;
		
		parse_cache_feed($username, $count); 
		
		echo $after_widget;
	}
	
	
/*-------------------------------/
	WIDGET SETTINGS
/-------------------------------*/
	function form($instance) {
		$defaults = array( 'title' => 'Twitter', 'username' => '', 'count' => 3 );
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		
		<p>
			<label><?php _e('Title', 'premitheme');?>:
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
			</label>
		</p>
		
		<p>
			<label><?php _e('Username', 'premitheme');?>:
			<input id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" class="widefat" type="text" />
			</label>
		</p>
		
		<p>
			<label><?php _e('No. of tweets', 'premitheme');?>:
			<input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" type="text" size="3" />
			</label>
		</p>
		
		<?php		
	}
}
