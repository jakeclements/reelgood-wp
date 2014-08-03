<?php
/*
	Plugin Name: Video widget
	Plugin URI: http://www.kirstyburgoine.co.uk/news/responsive-video-wordpress-plugin-released/
	Description: Adds a sidebar widget to show a video using the share URL.
	Author: Kirsty Burgoine
	Version: 1.0
	Author URI: http:www.kirstyburgoine.co.uk
   License:	GPLv2


Copyright 2012-2013  Kirsty Burgoine

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License version 2 as published by
the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/



/**
 * Adds Video_Widget widget.
 */
class Video_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'video_widget', // Base ID
			'Video Widget', // Name
			array( 'description' => __( 'Add responsive YouTube or Vimeo videos to widget ready areas', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		
		// Find all of the settings stored
		$title = apply_filters( 'widget_title', $instance['title'] );
		$video_type = $instance['video-type'];
		$video_url = $instance['video-url'];
		$description = $instance['video-description'];
		
		
		/**
		 * Outputs the code for the video
		 */
		
		
		// If a YouTube video was selected show YouTube embed code
		if ($video_type == "youtube") {
		
			$loc = strpos($video_url,"v=");
			$videoid = substr($video_url, $loc + 2);
		
			$videowidget = 
			"<div class=\"video-wrapper\"> 
			<div class=\"video-container\">
			
			<iframe src=\"http://www.youtube.com/embed/%video%\" frameborder=\"0\" %fullscreen% style=\"margin-bottom: 10px;\"></iframe>
			
			</div>
			</div>
			<p>%description%</p>";
			
			
			
		} else {
		// else Vimeo was selected so show Vimeo embed code
			
			$loc = explode( "/", $video_url );
			$videoid = end($loc);
			
	
			$videowidget = 
			"<div class=\"video-wrapper\"> 
			<div class=\"video-container\">
			
			<iframe src=\"http://player.vimeo.com/video/%video%\" frameborder=\"0\" ></iframe> 
			
			</div>
			</div>
			<p>%description%</p>";
		
		
		}
		
		// Replace all of the shortcodes above with the saved settings
		$content = str_replace(
			array(
				"%video%",
				"%description%",
			), 
			array(
				$videoid,
				$description,
			), 
			$videowidget
		);
		
		
		// Echo the full widget
		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
				
		echo $content;
		
		echo $after_widget;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['video-type'] = $new_instance['video-type'];
		$instance['video-url'] = strip_tags( $new_instance['video-url'] );
		$instance['video-description'] = strip_tags( $new_instance['video-description'] );


		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
	
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}
		
		if ( isset( $instance[ 'video-url' ] ) ) {
			$video_url = $instance['video-url'];
		}
		else {
			$video_url = __( 'http://www.youtube.com/watch?v=0Bmhjf0rKe8', 'text_domain' );
		}
		
		$type = $instance['video-type'];
		$description = $instance['video-description'];	

		
		
		?>
		
        <p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        
        <p>
		<label for="<?php echo $this->get_field_id( 'video-type' ); ?>"><?php _e( 'Type:' ); ?></label> 
        
        <select id="<?php echo $this->get_field_id( 'video-type' ); ?>" name="<?php echo $this->get_field_name( 'video-type' ); ?>">
        	<option value="<?php _e( 'youtube' ); ?>" <?php if ($type == "youtube") { ?> selected="selected" <?php } ?>><?php _e( 'YouTube' ); ?></option>
        	<option value="<?php _e( 'vimeo' ); ?>"<?php if ($type == "vimeo") { ?> selected="selected" <?php } ?>><?php _e( 'Vimeo' ); ?></option>
        </select>
		</p>
        
        		
		<p>
        <label for="<?php echo $this->get_field_id( 'video-url' ); ?>"><?php _e( 'Video URL:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'video-url' ); ?>" name="<?php echo $this->get_field_name( 'video-url' ); ?>" type="text" value="<?php echo esc_attr( $video_url ); ?>" />
        </p>
		
		
		<p>
        <label for="<?php echo $this->get_field_id( 'video-description' ); ?>"><?php _e( 'Optional Description:' ); ?></label>
        <textarea class="widefat" style="height:75px;" id="<?php echo $this->get_field_id( 'video-description' ); ?>" name="<?php echo $this->get_field_name( 'video-description' ); ?>"><?php echo esc_attr( $description ); ?></textarea>
        </p>
		
       
		<?php 
	}

} // class Video_Widget


// register Video_Widget widget
add_action( 'widgets_init', create_function( '', 'register_widget( "video_widget" );' ) );

?>
