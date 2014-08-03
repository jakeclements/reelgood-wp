<?php

/*
*  Functions
*
*  This file should be used to set any theme specific constants and include the
*  individual function files found in the 'functions' folder.
*
*  @note	Do not place any actions, filters or functions in this file
*  @type	file
*  @date	5/08/13
*/


// constants
define('SITE_URL',		get_site_url());
define('SITE_PATH',		ABSPATH);
define('THEME_PATH',	ABSPATH . 'wp-content/themes/' . get_template());
define('THEME_URL',		get_bloginfo('template_url'));
define('DEV_MODE',		true);
define('T4_ENABLE_SITE_SEARCH', true);

// theme support
add_theme_support('menus');
add_theme_support( 'post-thumbnails' );


// includes
include_once( THEME_PATH . '/library/api.php' );
include_once( THEME_PATH . '/library/post_types.php' );
include_once( THEME_PATH . '/library/field_groups.php' );
include_once( THEME_PATH . '/library/json.php' );
include_once( THEME_PATH . '/library/front.php' );


// admin
if( is_admin() )
{
	include_once( THEME_PATH . '/library/admin.php' );
}


// special views
include_once( THEME_PATH . '/library/wp-views.php' );


register_sidebar( array(
    'name'         => __( 'Right Hand Sidebar' ),
    'id'           => 'sidebar-1',
    'description'  => __( 'Widgets in this area will be shown on the right-hand side.' ),
    'before_title' => '<h4>',
    'after_title'  => '</h4>',
) );

?>