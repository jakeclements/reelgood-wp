<?php

class functions_admin
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
		add_action('admin_init', array($this, 'admin_init'));

		// add scripts/styles
    	add_action('admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts'));

		// Remove Yoast SEO columns
		// + http://wordpress.org/support/topic/plugin-wordpress-seo-by-yoast-remove-columns-in-post-list
		add_filter( 'wpseo_use_page_analysis', '__return_false' );

		// Lower the SEO metabox below ACF
		add_filter( 'wpseo_metabox_prio' , array($this, 'wpseo_metabox_prio') );

		// tinymce (customize the tinymce toolbar)
		add_filter('tiny_mce_before_init', array($this, 'tiny_mce_custom_toolbar'));
		add_filter('tiny_mce_before_init', array($this, 'tiny_mce_kitchen_open') );
   }


   	/*
   	*  admin_init
   	*
   	*  action is run during the 'init' for 'wp-admin'
   	*
   	*  @type	action
   	*  @date	2/08/13
   	*
   	*  @param	N/A
   	*  @return	N/A
   	*/

   	function admin_init()
   	{
  	    // vars
  		$version = '1.0.0';

  		// scripts
  		wp_register_script( 'admin', 	THEME_URL . '/js/admin.js', array('jquery'), $version );

  		// styles
  		wp_register_style( 'admin', 	THEME_URL . '/css/admin.css', false, $version );
   	}


   	/*
	*  admin_enqueue_scripts
	*
	*  This action is used to add the previously registered scripts/styles for 'wp-admin' <head>
	*
	*  @type	action
	*  @date	5/08/13
	*
	*  @param	N/A
	*  @return	N/A
	*/

	function admin_enqueue_scripts()
	{
		wp_enqueue_script(array(
			'admin'
		));

		wp_enqueue_style(array(
			'admin'
		));
	}


	/*
   	*  tiny_mce_kitchen_open
   	*
   	*  This filter will force tinymce kitchen sink always open
   	*
   	*  @type	filter
   	*  @date	2/08/13
   	*
   	*  @param	$args (array) Options for tinymce
   	*  @return	$args (array) Options for tinymce
   	*/

	function tiny_mce_kitchen_open( $args )
	{
		$args['wordpress_adv_hidden'] = false;

		return $args;
	}


	/*
   	*  tiny_mce_custom_toolbar
   	*
   	*  This filter will customize the tinymce toolbar
   	*
   	*  @type	filter
   	*  @date	2/08/13
   	*
   	*  @param	$args (array) Options for tinymce
   	*  @return	$args (array) Options for tinymce
   	*/

	function tiny_mce_custom_toolbar( $args )
	{
		$args['theme_advanced_blockformats'] = 'p,h2,h3, h4, h5, h6';

		// remove
		$remove = array(
			'underline',
			'forecolor',
			'outdent',
			'indent',
			'wp_help'
		);

		// explode into arrays
		$args['theme_advanced_buttons1'] = explode( ',', $args['theme_advanced_buttons1'] );
		$args['theme_advanced_buttons2'] = explode( ',', $args['theme_advanced_buttons2'] );

		// find difference
		$args['theme_advanced_buttons1'] = array_diff($args['theme_advanced_buttons1'], $remove);
		$args['theme_advanced_buttons2'] = array_diff($args['theme_advanced_buttons2'], $remove);

		// implode into strings
		$args['theme_advanced_buttons1'] = implode( ',', $args['theme_advanced_buttons1'] );
		$args['theme_advanced_buttons2'] = implode( ',', $args['theme_advanced_buttons2'] );

	    return $args;
	}


	/*
   	*  wpseo_metabox_prio
   	*
   	*  This filter will lower the WP seo priority and display after ACF metaboxes
   	*
   	*  @type	filter
   	*  @date	2/08/13
   	*
   	*  @param	$priority (string) Priority of the metabox
   	*  @return	(string) New priority of the metabox
   	*/

   	function wpseo_metabox_prio( $priority )
   	{
	   	return 'low';
   	}
}

new functions_admin();
