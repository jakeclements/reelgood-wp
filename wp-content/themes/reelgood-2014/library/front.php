<?php

class functions_front
{

	/*
	*  Constructor
	*
	*  Add actions and filters
	*
	*  @type	function
	*  @date	5/08/13
	*
	*  @param	N/A
	*  @return	N/A
	*/

	function __construct()
	{
		// register scripts/styles
		add_action('init', array($this, 'init'));


		// add scripts/styles
    	add_action('wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts'));


    	// add inline script tags to the header (google analytics)
    	add_action('wp_head', array( $this, 'wp_head'));


    	// add inline script tags to the footer
    	add_action('wp_footer', array( $this, 'wp_foot'), 100);


    	// filters
    	add_filter('pre_get_posts', array($this, 'pre_get_posts'), 10);
   	}


   	/*
   	*  admin_init
   	*
   	*  action is run during the 'init' for front end
   	*
   	*  @type	action
   	*  @date	2/08/13
   	*
   	*  @param	N/A
   	*  @return	N/A
   	*/

	function init()
	{
		// vars
		$version = '1.0.0';

		// scripts
		//wp_register_script( 'bootstrap.min', 	THEME_URL . '/js/bootstrap.min.js', array('jquery',), $version, true );
		//wp_register_script( 'google.maps', 	'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', false, $version );
		wp_register_script( 'flex',				THEME_URL . '/js/flex/jquery.flexslider.js', array('jquery'), $version, true );
		wp_register_script( 'f',				THEME_URL . '/js/f.js', array('jquery'), $version, true );

		// styles
		wp_register_style( 'bootstrap.min', 	THEME_URL . '/css/bootstrap.min.css', false, $version );
		wp_register_style( 'jockstrap', 		THEME_URL . '/css/jockstrap.css', false, $version );
		wp_register_style( 'font-awesome', 		THEME_URL . '/library/font-awesome/css/font-awesome.min.css', false, $version );
		wp_register_style( 'layout', 			THEME_URL . '/css/layout.css', false, $version );
		wp_register_style( 'device', 			THEME_URL . '/css/device.css', false, $version );
		wp_register_style( 'print', 			THEME_URL . '/css/print.css', false, $version, 'print' );
		wp_register_style( 'min', 				THEME_URL . '/__nd/css/style.css', false, $version );

		// fancybox
		wp_register_script( 'fancybox',			THEME_URL . '/library/fancybox/jquery.fancybox.pack.js', false, $version, true );
		wp_register_style( 'fancybox',			THEME_URL . '/library/fancybox/jquery.fancybox.css', false, $version );

	}

	/*
	*  wp_enqueue_scripts
	*
	*  This action is used to add the previously registered scripts/styles to the theme's <head>
	*
	*  @type	action
	*  @date	5/08/13
	*
	*  @param	N/A
	*  @return	N/A
	*/

	function wp_enqueue_scripts()
	{

		// add scripts
		wp_enqueue_script(array(
			'jquery',
			'fancybox',
			'flex',
			'f',
		));

		// add styles
		wp_enqueue_style(array(
			'fancybox',
			//'bootstrap.min',
			//'jockstrap',
			'font-awesome',
			'min',
			//'layout',
			//'device',
			//'print'
		));
	}


	/*
	*  wp_head
	*
	*  This action is used to add inline script tags to the theme's <head>
	*
	*  @type	action
	*  @date	5/08/13
	*
	*  @param	N/A
	*  @return	N/A
	*/

	function wp_head()
	{
		// Google analytics
		?>
		<!-- Place Google Analytics here -->
		<?php

	}

   /*
	*  wp_foot
	*
	*  This action is used to add inline script tags before to the theme's closing body tag
	*
	*  @type	action
	*  @date	5/08/13
	*
	*  @param	N/A
	*  @return	N/A
	*/

	function wp_foot()
	{

		// Pass PHP variables to JS for use in ajax calls
		// "o" stands for options
		$o = array(
			'ajaxurl'	=> admin_url('admin-ajax.php'),
			'url'		=> get_bloginfo('url'),
			'nonce'		=> wp_create_nonce( '{website_name}' ),
		);


		// the following assumes you have a JS object called "f"
		// the object at "f.o" will be populated withe PHP $o array
		?>
		<script type="text/javascript">
		(function($) {

			f.o = <?php echo json_encode($o); ?>;

		})(jQuery);
		</script>
		<?php
	}


	/*
	*  pre_get_posts
	*
	*  This action is used to alter the WP_Query arguments before the SQL is generated
	*
	*  @type	filter
	*  @date	5/08/13
	*
	*  @param	$query (object): WP_Query object
	*  @return	$query (object)
	*/

	function pre_get_posts( $query )
	{

		// validate
		if( is_admin() )
		{
			return;
		}

	    if ( is_home() )
	    {
	        return;
	    }


	    // project example
	    /*
		   if( isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'project' )
	    {
	    	$query->set('orderby', 'date');
	    	$query->set('order', 'DESC');
	    	$query->set('posts_per_page', 16);
	    }
	    */

	    // always return
	    return $query;

	}

}

new functions_front();

function catch_first_image($id) {

  $post = get_post($id);

  $first_img = '';

  ob_start();

  ob_end_clean();

  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);

  $first_img = $matches [1] [0];

  if(empty($first_img)){ //Defines a default image

    $first_img = "http://placehold.it/315x170&text=REEL+GOOD";

  }

  return $first_img;

}


// Set post counts
function set_post_views( $postID ) {

    $count_key = 'wpb_post_views_count';

    $count = get_post_meta($postID, $count_key, true);

    if($count==''){

        $count = 0;

        delete_post_meta($postID, $count_key);

        add_post_meta($postID, $count_key, '0');

    }else{

        $count++;

        update_post_meta($postID, $count_key, $count);

    }

}

//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


