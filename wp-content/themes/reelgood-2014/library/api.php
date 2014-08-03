<?php

/*
*  has_children
*
*  a simple function that returns true / false if a page has children
*
*  @type	function
*  @date	11/07/13
*
*  @param	$post_id (int) The post to test against
*  @return	(boolean) True if has children
*/

function has_children( $post_id = 0 )
{
	// validate
	if( !$post_id )
	{
		global $post;
		$post_id = $post->ID;
	}


	// load children
    $children = get_pages( array(
    	'child_of' => $post_id
    ));


    // return
    if( !empty( $children ) )
    {
    	return true;
    }

    return false;
}


/*
*  get_image_field
*
*  This function will return a URL to an image given the ACF field_name
*
*  @type	function
*  @date	5/08/13
*
*  @param	$field_name (string) ACF field name for image
*  @param	$size (string) WP image size. Defaults to "full"
*  @param	$post_id (int) Which post to load the image from. Defaults to false (current post)
*  @return	(mixed) URL or false will be returned
*/

function get_image_field( $field_name, $size = 'full', $post_id = false )
{
	$image = get_field( $field_name, $post_id );
	$image = wp_get_attachment_image_src( $image, $size );

	if( $image )
	{
		return $image[0];
	}

	return false;
}


/*
*  get_sub_image_field
*
*  This function will return a URL to an image given the ACF field_name
*
*  @type	function
*  @date	5/08/13
*
*  @param	$field_name (string) ACF field name for image
*  @param	$size (string) WP image size. Defaults to "full"
*  @param	$post_id (int) Which post to load the image from. Defaults to false (current post)
*  @return	(mixed) URL or false will be returned
*/

function get_sub_image_field( $field_name, $size = 'full' )
{
	$image = get_sub_field( $field_name );
	$image = wp_get_attachment_image_src( $image, $size );

	if( $image )
	{
		return $image[0];
	}

	return false;
}


/*
*  get_valid_url
*
*  This function will make sure there is a http:// for the url
*
*  @type	function
*  @date	18/09/13
*
*  @param	$url (string) the url
*  @param	$scheme (string) http or https
*  @return	$url (string)
*/

function get_valid_url( $url, $scheme = 'http' )
{
	if( substr($url, 0, 7) != 'http://' && substr($url, 0, 8) != 'https://' )
	{
		$url = "{$scheme}://{$url}";
	}

	return $url;
}


/*
*  get_pretty_url
*
*  This function will remove the shceme from the url so it looks pretty
*
*  @type	function
*  @date	18/09/13
*
*  @param	$url (string) the url
*  @return	$url (string) the url
*/

function get_pretty_url( $url )
{
	$url = str_replace('http://', '', $url);
	$url = str_replace('https://', '', $url);

	return $url;
}


/*
*  get_truncated
*
*  This function will truncate a block of text. Good for excerpts
*
*  @type	function
*  @date	5/08/13
*
*  @param	$text (string) The text to truncate
*  @param	$length (int) The length of characters allowed. Defaults to 64
*  @return	(string) Truncated text based on parameters
*/

function get_truncated( $text = '', $length = 64 )
{
	// vars
	$the_length = strlen($text);

	//We'll use Regex instead of Substr to keep the last word.
	$return = '';
	if(preg_match('/^.{1,'.$length.'}\b/s', $text, $match))
	{
	    $return .= $match[0];
	}

	// add trailing '...'
	if( $the_length > ($length - 3) )
	{
		$return .= '...';
	}

	// return
	return $return;
}


/*
*  get_partial
*
*  This function will include a file from the '/partials/' folder.
*  The seccond parameter can be used to send through an array of options to be used in the partial
*
*  @type	function
*  @date	5/08/13
*
*  @param	$file_name (string) name of partial file (without extension)
*  @param	$options (array) Optional array of settings to be used in the partial file
*  @return	N/A
*/

function get_partial( $file_name = '', $options = array() )
{
	if( file_exists(THEME_PATH . '/partials/' . $file_name . '.php') )
	{
		require_once(THEME_PATH . '/partials/' . $file_name . '.php');
	}
}


/*
*  my_function
*
*  This function will ...
*
*  @type	function
*  @date	5/08/13
*
*  @param	$name (type) description
*  @param	$name (type) description
*  @return	(type) description
*/
