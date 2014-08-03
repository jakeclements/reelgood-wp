<?php

class functions_post_types
{

	/*
	*  Constructor
	*
	*  Add actions and filters and theme_support
	*
	*  @type	function
	*  @date	5/08/13
	*
	*  @param	N/A
	*  @return	N/A
	*/

	function __construct()
	{

    	// actions
    	add_action( 'init', array( $this, 'init') );

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
		// register taxonomies
		$this->register_taxonomies();


		// register post types
		$this->register_post_types();
	}


	/*
	*  register_taxonomy
	*
	*  This function uses the native WP register_taxonomy function but adds in extra generated data
	*
	*  @type	function
	*  @date	5/08/13
	*
	*  @param	$name (string) Name of post type. Should be lowercase and single - post, page, project
	*  @param	$single (string) Human readable single name - Post, Page, Project
	*  @param	$plural (string) Human readable plural name - Posts, Pages, Projects
	*  @param	$args (array) post type settings
	*  @return  N/A
	*/

	function register_taxonomy( $name, $single, $plural, $args )
	{
		// create labels
		$args['labels'] = array(
		    'name' 					=> '{plural_label}',
		    'singular_name' 		=> '{single_label}',
		    'search_items' 			=> __( 'Search {plural_label}' ),
		    'all_items' 			=> __( 'All {plural_label}' ),
		    'parent_item'         	=> __( 'Parent {single_label}' ),
		    'parent_item_colon'   	=> __( 'Parent {single_label}:' ),
		    'edit_item'           	=> __( 'Edit {single_label}' ),
		    'update_item'         	=> __( 'Update {single_label}' ),
		    'add_new_item'        	=> __( 'Add New {single_label}' ),
		    'new_item_name'       	=> __( 'New {single_label} Name' ),
		    'menu_name'           	=> __( '{single_label}' )
		);

		foreach( $args['labels'] as &$label)
		{
			$label = str_replace('{plural_label}', $plural, $label);
			$label = str_replace('{single_label}', $single, $label);
		}


		// register
		register_taxonomy( $name, null, $args );
	}


	/*
	*  register_post_type
	*
	*  This function uses the native WP register_post_type function but adds in extra generated data
	*
	*  @type	function
	*  @date	5/08/13
	*
	*  @param	$name (string) Name of post type. Should be lowercase and single - post, page, project
	*  @param	$single (string) Human readable single name - Post, Page, Project
	*  @param	$plural (string) Human readable plural name - Posts, Pages, Projects
	*  @param	$args (array) post type settings
	*  @return  N/A
	*/

	function register_post_type( $name, $single, $plural, $args )
	{
		// create labels
		$args['labels'] = array(
		    'name' 					=> '{plural_label}',
		    'singular_name' 		=> '{single_label}',
		    'add_new' 				=> __('Add New' ),
		    'add_new_item' 			=> __('Add New {single_label}' ),
		    'edit_item' 			=> __('Edit {single_label}' ),
		    'new_item' 				=> __('New {single_label}' ),
		    'all_items' 			=> __('All {plural_label}' ),
		    'view_item' 			=> __('View {single_label}' ),
		    'search_items' 			=> __('Search {plural_label}' ),
		    'not_found' 			=> __('No {plural_label} found' ),
		    'not_found_in_trash' 	=> __('No {plural_label} found in Trash' ),
		    'parent_item'         	=> __( 'Parent {single_label}' ),
		    'parent_item_colon'   	=> __( 'Parent {single_label}:' ),
		    'menu_name' 			=> '{plural_label}'
		);

		foreach( $args['labels'] as &$label)
		{
			$label = str_replace('{plural_label}', $plural, $label);
			$label = str_replace('{single_label}', $single, $label);
		}


		// add custom roles?
		if( is_admin() && isset($args['capability_type']) && $args['capability_type'] == 'custom' )
		{
			// this is a custom capability for this post type!
			$args['capability_type'] = $name;
			$args['map_meta_cap'] = true;


			$role = get_role( 'administrator' );

			$role->add_cap( "edit_{$name}" );
			$role->add_cap( "read_{$name}" );
			$role->add_cap( "delete_{$name}" );
			$role->add_cap( "edit_{$name}s" );
			$role->add_cap( "edit_others_{$name}s" );
			$role->add_cap( "publish_{$name}s" );
			$role->add_cap( "read_private_{$name}s" );
			$role->add_cap( "delete_{$name}s" );
			$role->add_cap( "delete_private_{$name}s" );
			$role->add_cap( "delete_published_{$name}s" );
			$role->add_cap( "delete_others_{$name}s" );
			$role->add_cap( "edit_private_{$name}s" );
			$role->add_cap( "edit_published_{$name}s" );
		}


		// register
		register_post_type( $name, $args );

	}


	/*--------------------------------------- Edit below this line ------------------------------------------*/


	/*
	*  register_taxonomies
	*
	*  This function will create custom taxonomies
	*
	*  @type	function
	*  @date	5/08/13
	*
	*  @param	N/A
	*  @return	N/A
	*/

	function register_taxonomies()
	{
		// blog-category
		$this->register_taxonomy( 'blog-category', 'Category', 'Categories', array(
			'hierarchical'      => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'blog/category' ),
		));


		/*
		// blog-category (with custom capabilities for custom user role)
		$this->register_taxonomy( 'blog-category', 'Category', 'Categories', array(
			'hierarchical'      => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'blog/category' ),
			'capabilities'		=> array(
				'assign_terms'	=>	'edit_blogs',
				'edit_terms'	=>	'edit_blogs',
				'manage_terms'	=>	'edit_blogs'
			)
		));
		*/


		// blog-tag
		$this->register_taxonomy( 'blog-tag', 'Tag', 'Tags', array(
			'hierarchical'      => false,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'blog/tag' ),
		));
	}


	/*
	*  register_post_types
	*
	*  This function will create custom post types
	*
	*  @type	function
	*  @date	5/08/13
	*
	*  @param	N/A
	*  @return	N/A
	*/

	function register_post_types()
	{
		// blog
		$this->register_post_type( 'blog', 'Blog', 'Blog', array(
			'public'				=> true,
		    'publicly_queryable'	=> true,
		    'show_ui'				=> true,
		    'query_var'				=> true,
		    'rewrite'				=> array(
	            'slug'				=> 'blog',
	            'with_front'		=> false
	        ),
	        //'capability_type' => 'custom', setting this to 'custom' will create custom user capabilities for this post type!
	        'has_archive'			=> true,
		    'hierarchical'			=> false,
		    'menu_position'			=> null,
		    'supports'				=> array( 'title', 'editor', 'author', 'thumbnail', 'comments', 'revisions' ),
		    'taxonomies'			=> array( 'blog-category', 'blog-tag' )
		));
	}

}

new functions_post_types();

?>