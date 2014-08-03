<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Custom Popular Posts Widget
	Plugin URI: http://www.themezilla.com
	Description: A widget that allows the display of popular blog posts.
	Version: 1.0
	Author: ThemeZilla
	Author URI: http://www.themezilla.com

-----------------------------------------------------------------------------------*/


/*---------------------------------------------------------------------------------*/
/*  Create the widget
/*---------------------------------------------------------------------------------*/
add_action( 'widgets_init', 'zilla_popularposts_widget' );

function zilla_popularposts_widget() {
	register_widget( 'zilla_popularposts_widget' );
}


/*-----------------------------------------------------------------------------------*/ 
/*  Widget class
/*-----------------------------------------------------------------------------------*/
class zilla_popularposts_widget extends WP_Widget {

/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
	function zilla_popularposts_widget() {
	
		/* Widget settings. ---------------------------------------------------------*/
		$widget_ops = array( 'classname' => 'zilla-popular-widget', 'description' => __('A widget that displays your popular posts with a short excerpt.', 'zilla') );

		/* Widget control settings. -------------------------------------------------*/
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'zilla-popular-widget' );

		/* Create the widget --------------------------------------------------------*/
		$this->WP_Widget( 'zilla-popular-widget', __('Custom Popular Posts Widget', 'zilla'), $widget_ops, $control_ops );
	}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );
		
		/* Our variables from the widget settings. ----------------------------------*/
		$title = apply_filters('widget_title', $instance['title'] );
		$number = $instance['number'];

		/* Display Widget -----------------------------------------------------------*/		
		echo $before_widget;
        
		if ( $title ) { echo $before_title . $title . $after_title; }
		?>
		                            
        <ul data-delay="<?php echo $instance['delay']; ?>">
        
			<?php 
            $query = new WP_Query();
            $query->query( array(
                'posts_per_page' => $number,
                'post_type' => 'post',
                'ignore_sticky_posts' => 1,
                'orderby' => 'comment_count'
            ));
            ?>
            <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
            <li>
                
				<?php /* if the post has a WP 2.9+ Thumbnail */
				if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
				<div class="post-thumb">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('sidebar-thumb'); ?></a>
				</div>
				<?php } ?>
                
                <h5 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            
            </li>
            <?php endwhile; endif; ?>
            
            <?php wp_reset_query(); ?>

        </ul>
        
        <div class="zilla-popular-widget-nav"></div>
		
		<?php

		echo $after_widget;
	}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		/* Strip tags to remove HTML (important for text inputs). -------------------*/
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = strip_tags( $new_instance['number'] );
		$instance['delay'] = strip_tags( $new_instance['delay'] );

		return $instance;
	}
	

/*-----------------------------------------------------------------------------------*/
/*	Widget Settings
/*-----------------------------------------------------------------------------------*/
	 
	function form( $instance ) {

		/* Set up some default widget settings. -------------------------------------*/
		$defaults = array(
    		'title' => 'Popular Posts',
    		'number' => 4,
    		'delay' => '0'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'zilla') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
        
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Amount to show:', 'zilla') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'delay' ); ?>"><?php _e('Delay (in secs, leave blank for no auto play):', 'zilla') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'delay' ); ?>" name="<?php echo $this->get_field_name( 'delay' ); ?>" value="<?php echo $instance['delay']; ?>" />
		</p>
	
	<?php
	}
}
?>