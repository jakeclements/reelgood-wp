<?php

/*
*  JSON
*
*  This class holds all the JSON functions accessable via a $_GET URL
*  Do not edit any of the code above the edit line.
*  Create a function "get_things" and access it via "http://SITE_URL/json/get_things?foo=bar"
*
*  @note	Add a $_GET param of 'dev=1' to render the JSON data for human readability
*  @note	Set the $nonce variable for extra security. Leave blank for ease of use
*  @note	When working in a function, use the $this->query instead of $_GET to find params
*  @type	class
*  @date	5/08/13
*/

class functions_json
{
	var $json	=	array(), // Add data to this array and it will be returned
		$query	=	array(), // Thi array will contain all the $_GET parameters
		$nonce	=	false; // enter a string nonce for extra security. Note: You will need to send the matching nonce through a $_GET parameter


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
		add_action( 'template_redirect', array( $this, 'template_redirect' ), 1 );
   	}


   	/*
   	*  template_redirect
   	*
   	*  This action will look for the string '/json/$function_name' and run the function accordingly
   	*
   	*  @type	action
   	*  @date	5/08/13
   	*
   	*  @param	N/A
   	*  @return	N/A
   	*/

   	function template_redirect()
   	{
   		// get URL
   		$url = $_SERVER['REQUEST_URI'];


   		// Remove $_GET params from the URL
   		if( strpos( $url,'?') !== false )
   		{
   			$url = explode( '?', $url );
   			$url = $url[0];
		}


		// turn into string without the '/' at start or end
		$url = explode( '/', $url );
		$url = array_filter( $url );
		$url = array_values( $url );


		// json?
		if( isset( $url[0], $url[1] ) && $url[0] == 'json' )
		{
			if( method_exists($this, $url[1]) )
			{
				// do not delete
				$this->json_init();

				call_user_func( array( $this, $url[1] ) );

				// do not delete
				$this->json_end();
			}
		}

	}


	/*
	*  json_init
	*
	*  This function is run before the json function and sets up varaibles
	*
	*  @type	function
	*  @date	5/08/13
	*
	*  @param	N/A
	*  @return	N/A
	*/

	function json_init()
	{
		// set header
		status_header( "200" );

		// json
		$this->json = array(
			'status' => 1
		);

		// query
		$this->query = array_merge(array(
			'dev' => 0
		), $_GET);

		// check nonce
		if( $this->nonce )
		{
			// if nonce does not match, bail early
   		if( !isset( $_GET['nonce']) || !wp_verify_nonce( $_GET['nonce'], $this->nonce ) )
   		{
	   		$this->json['status'] = 0;
	   		$this->json['error'] = 'Error';
	   		$this->json_end();
   		}
		}

		// allow custom json function to run...

	}


	/*
	*  json_end
	*
	*  This function is run after the json function and returns the json data
	*
	*  @type	function
	*  @date	5/08/13
	*
	*  @param	N/A
	*  @return	N/A
	*/

	function json_end()
	{
		if( $this->query['dev'] )
		{
			echo '<pre>';
   			print_r( json_encode( $this->json, JSON_PRETTY_PRINT ) );
   		echo '</pre>';
		}
		else
		{
   		echo json_encode( $this->json );
		}

		die;
	}


	/*--------------------------------------- Edit below this line ------------------------------------------*/


	/*
	*  get_posts
	*
	*  This example shows how you can use this class to return post data
	*
	*  @type	function
	*  @date	2/08/13
	*  @url		http:www.website.com/json/get_posts/?...
	*
	*  @param	paged (int) the page counter
	*  @param	category (string) the category to query
	*  @return	N/A
	*/

	function get_posts()
	{
		// defaults
		$this->json['next_page_exists'] = 1;
		$this->json['posts'] = array();

		// args for WP_Query
		$args = array(
   		'post_type' => 'project',
   		'posts_per_page' => 16,
   		'paged' => 1
   	);

   	// $_GET defaults
   	$options = array(
   		'paged'		=>	1,
   		'category'	=>	'',
   	);
   	$options = array_merge( $options, $_GET );

   	// paged
   	if( !empty($options['paged']) )
   	{
   		$args['paged'] = $options['paged'];
   	}

   	// update other $args here....

   	// query
   	$wp_query = new WP_Query( $args );

   	// loop
   	while( $wp_query->have_posts() )
   	{
   		$wp_query->the_post();

   		$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail' );

   		$this->json['posts'][] = array(
   			'title'		=> get_the_title(),
   			'thumbnail'	=> $image[0],
   			'permalink'	=> get_permalink(),
   			'excerpt'	=> get_truncated( get_field('excerpt'), 110 ),
   		);
   	}

   	// Restore original Post Data
   	wp_reset_postdata();

   	// update the next_page_exists JSON data
   	if( (int)$args['paged'] >= $wp_query->max_num_pages )
   	{
   		$this->json['next_page_exists'] = 0;
   	}
	}


	/*
	*  get_tweets
	*
	*  This function will return the latest tweets for the given user details
	*
	*  @type	function
	*  @date	2/08/13
	*  @url		http:www.website.com/json/get_tweets/?count=3
	*
	*  @param	$count (int) number of tweets
	*  @return	N/A
	*/

	function get_tweets()
	{
		// options
		$options = array(
   		'count' => 1,
   	);
   	$options = array_merge( $options, $_GET );


   	// vars
   	$twitteruser = "";
   	$consumerkey = "";
   	$consumersecret = "";
   	$accesstoken = "";
   	$accesstokensecret = "";


   	require_once( THEME_PATH . '/inc/twitter/twitteroauth/twitteroauth.php' ); //Path to twitteroauth library


   	function getConnectionWithAccessToken( $cons_key, $cons_secret, $oauth_token, $oauth_token_secret ) {
   		$connection = new TwitterOAuth( $cons_key, $cons_secret, $oauth_token, $oauth_token_secret );
   		return $connection;
   	}

   	$connection = getConnectionWithAccessToken( $consumerkey, $consumersecret, $accesstoken, $accesstokensecret );

   	$this->json['tweets'] = $connection->get( "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$options['count'] );

	}
}

new functions_json();
