<?php

/*
*  WP Views
*
*  This class is to be extended and provides the logic to create custom views
*  such as '/account/edit' and alike
*
*  @type	class
*  @date	16/08/13
*
*/

class wpview {


	// public vars
	var $include_functions 		= '',
		$include_controller 	= '',
		$include_view 			= '',

		$post					= array(),
		$data					= array();


	// private vars
	private static $instance;


	/*
	*  instance
	*
	*  Insures that only one instance of 'wpview' exists in memory at any one
	*  time. Also prevents needing to define globals all over the place.
	*
	*  @type	function
	*  @date	16/08/13
	*
	*  @param	N/A
	*  @return	The one true 'wpview'
	*/

	public static function instance()
	{
		if ( ! isset( self::$instance ) )
		{
			self::$instance = new wpview();
		}

		return self::$instance;
	}


	/*
	*  Construct
	*
	*  Setup actions / filters
	*
	*  @type	function
	*  @date	16/08/13
	*
	*  @param	N/A
	*  @return	N/A
	*/

	function __construct()
	{
		add_action('wp', array($this, 'wp'), 1);
  }


   	/*
   	*  wp
   	*
   	*  This function is hooked onto the wp action and will calculate if this url is a custom one
   	*
   	*  @type	action (wp)
   	*  @date	20/08/13
   	*
   	*  @param	N/A
   	*  @return	N/A
   	*/

   	function wp()
   	{

	   	// vars
   		$url = $_SERVER['REQUEST_URI'];

   		if( strpos($url,'?') !== false )
   		{
   			$url = explode('?', $url);
   			$url = $url[0];
			}


			// turn into string without the '/' at start or end
			$url = explode('/', $url);
			$url = array_filter($url);
			$url = array_values($url);


			// bail if no $url[0]
			if( !isset($url[0]) )
			{
				return false;
			}


			// create dummy posts!
			$the_post = null;
			foreach( $url as $i => $post_name )
			{
				// args
				$post = array(
					'ID' => 1000000000 + $i,
					'post_parent' => 0,
					'post_title' => ucwords(str_replace('-', ' ', $post_name)),
					'post_name' => $post_name
				);


				// is this a child?
				if( $i > 0 )
				{
					$post['post_parent'] = $the_post->ID;
				}

				$the_post = wpv_create_post( $post );
			}


			// update vars
			$base = array_shift( $url );


			// no tmpl?
			if( count($url) == 0 )
			{
				$tmpl = 'index';
			}
			else
			{
				$tmpl = implode('-', $url);
			}


			// vars
			$path_controllers = get_template_directory() . '/wp-controllers';
	   		$path_views = get_template_directory() . '/wp-views';


	   		// include functions
			if( file_exists( $path_controllers . "/{$base}/functions.php" ) )
			{
				$this->include_functions = $path_controllers . "/{$base}/functions.php";
			}


			// include controller
			if( file_exists( $path_controllers . "/{$base}/{$tmpl}.php" ) )
			{
				$this->include_controller = $path_controllers . "/{$base}/{$tmpl}.php";
			}
			elseif( file_exists( $path_controllers . "/{$base}.php" ) )
			{
				$this->include_controller = $path_controllers . "/{$base}.php";
			}


			// include view
			if( file_exists( $path_views . "/{$base}/{$tmpl}.php" ) )
			{
				$this->include_view = $path_views . "/{$base}/{$tmpl}.php";
			}
			elseif( file_exists( $path_views . "/{$base}.php" ) )
			{
				$this->include_view = $path_views . "/{$base}.php";
			}


			// set fake post?
			if( $this->include_view )
			{
				wpv_set_post( $the_post );
			}


			// this is a custom wpv, add action
			add_action('template_redirect', array($this, 'template_redirect'), 1);

   	}


   	/*
   	*  template_redirect
   	*
   	*  This function will hook into the 'template_redirect' action and compare the URL
   	*  to this instances $slug. If there is a match, include the view's template
   	*
   	*  @type	action (template_redirect)
   	*  @date	16/08/13
   	*
   	*  @param	N/A
   	*  @return	N/A
   	*/

   	function template_redirect()
   	{
		// include
		if( $this->include_functions )
		{
			$this->include_file( $this->include_functions );
		}

		if( $this->include_controller )
		{
			$this->include_file( $this->include_controller );
		}

		if( $this->include_view )
		{
			$this->include_file( $this->include_view );
			exit;
		}

	}


	/*
	*  include_file
	*
	*  This function will simply include a file. This allows the file to return false which will terminate the function,
	*  but will not terminate the next file included (controller then view)
	*
	*  @type	function
	*  @date	19/08/13
	*
	*  @param	$path (string) the file to be loaded
	*  @return	N/A
	*/

	function include_file( $path = "" )
	{
		include_once( $path );
	}

}


/*
*  wpview
*
*  The main function responsible for returning the one true wpview Instance
*  to functions everywhere.
*
*  Example: <?php $wpview = wpview(); ?>
*
*  @type	function
*  @date	16/08/13
*
*  @param	N/A
*  @return	The one true wpview Instance
*/

function wpview()
{
	return wpview::instance();
}


wpview();


/*
*  wpv_create_post
*
*  This function will create a dummy post and save it to the WP cache
*
*  @type	function
*  @date	20/08/13
*
*  @param	$post_id (int) the post_id
*  @param	$post_name (string) the post name (slug)
*  @return	(object) $post
*/

function wpv_create_post( $args )
{
	// defaults
	$defaults = array(
		'ID' => 0,
		'post_title' => '',
		'post_parent' => 0,
		'post_name' => '',
		'guid' => ''
	);


	// override defaults
	$args = wp_parse_args( $args, $defaults );


	// generate guid from parent
	if( $args['post_parent'] !== 0 )
	{
		$parent = get_post( $args['post_parent'] );
		$args['guid'] = $parent->guid . '/' .$args['post_name'];

	}
	else
	{
		$args['guid'] = get_bloginfo('url') . '/' .$args['post_name'];
	}


	// $post
	$post = new stdClass();
	$post->ID						= $args['ID'];
	$post->post_status				= 'publish';
	$post->post_author				= 0;
	$post->post_parent				= $args['post_parent'];
	$post->post_type				= 'page';
	$post->post_date				= 0;
	$post->post_date_gmt			= 0;
	$post->post_modified			= 0;
	$post->post_modified_gmt		= 0;
	$post->post_content				= '';
	$post->post_title				= $args['post_title'];
	$post->post_category			= 0;
	$post->post_excerpt				= '';
	$post->post_content_filtered	= '';
	$post->post_mime_type			= '';
	$post->post_password			= '';
	$post->post_name				= $args['post_name'];
	$post->guid						= $args['guid'];
	$post->menu_order				= 0;
	$post->pinged					= '';
	$post->to_ping					= '';
	$post->ping_status				= '';
	$post->comment_status			= 'closed';
	$post->comment_count			= 0;


	if( isset($parent) )
	{
		if( isset($parent->ancestors) )
		{
			$post->ancestors = $parent->ancestors;
		}
		else
		{
			$post->ancestors = array();
		}

		array_unshift( $post->ancestors, $post->post_parent );
	}


	// update cache (allows get_post to work)
	wp_cache_set( $post->ID, $post, 'posts' );


	// return
	return $post;

}


/*
*  wpv_set_post
*
*  This function will set a dummy post as the global post
*
*  @type	function
*  @date	20/08/13
*
*  @param	$the_post (object) the post
*  @return	N/A
*/

function wpv_set_post( $the_post )
{
	// set header
   	status_header( "200" );


	// global
	global $wp_query, $post;


	// vars
    $post = $the_post;


    // $wp_query
	$wp_query->post = $post;
	$wp_query->posts = array($post);
	$wp_query->found_posts = 1;
	$wp_query->post_count = 1;
	$wp_query->max_num_pages = 1;
	$wp_query->is_single = 1;
	$wp_query->is_posts_page = 1;

	$wp_query->is_page = true;
    $wp_query->is_singular = true;
    $wp_query->is_home = false;
    $wp_query->is_archive = false;
    $wp_query->is_category = false;
	$wp_query->is_404 = false;
}


/*
*  wpv_update_data
*
*  Updates a variable in the wpview->data array.
*
*  @type	function
*  @date	19/08/13
*
*  @param	$name (mixed) the name of the data, or an array of data to be merged in
*  @param	$data (mixed) the data to be saved
*  @return	(boolean)
*/

function wpv_update_data( $name = "", $data = false )
{
	// vars
	$wpview = wpview();


	// update
	if( is_array($name) )
	{
		$wpview->data = wp_parse_args( $name, $wpview->data );
	}
	else
	{
		$wpview->data[ $name ] = $data;
	}


	// return
	return true;
}


/*
*  wpv_get_data
*
*  Retrieves a variable in the wpview->data array. If not set, this function will return false
*
*  @type	function
*  @date	19/08/13
*
*  @param	$name (string) the name of the data
*  @return	(mixed)
*/

function wpv_get_data( $name = false )
{
	// vars
	$wpview = wpview();


	// return all?
	if( !$name )
	{
		return $wpview->data;
	}


	// return specific?
	if( isset($wpview->data[ $name ]) )
	{
		return $wpview->data[ $name ];
	}


	// return
	return false;
}

?>