<?php
define( 'REELGOOD_VERSION', 1.1 );
define( 'REELGOOD_STAGE', false );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' ); 
/*-----------------------------------------------------------------------------------*/
/* Register Menus
/*-----------------------------------------------------------------------------------*/
register_nav_menus( 
	array(
		'primary'	=>	__( 'Primary Menu', 'RG' ),
		'footer'	=>	__( 'Footer Menu', 'RG' )
	)
);

/*-----------------------------------------------------------------------------------*/
/* Enqueue Styles and Scripts
/*-----------------------------------------------------------------------------------*/

function rg_scripts()  { 

	// get the theme directory style.css and link to it in the header
	wp_enqueue_style( 'naked-style', get_template_directory_uri() . '/style.css', '10000', 'all' );
	
	// get the theme directory style.css and link to it in the header
	wp_enqueue_style( 'foundation', get_template_directory_uri() . '/styles/foundation.css', '1000', 'all' );
	wp_enqueue_style( 'layout', get_template_directory_uri() . '/styles/layout.css', '1000', 'all' );
	wp_enqueue_style( 'fancy', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.css', '1000', 'all' );
	wp_enqueue_style( 'flex', get_template_directory_uri() . '/js/flexslider/flexslider.css', '1000', 'all' );
	wp_enqueue_style( 'device', get_template_directory_uri() . '/styles/device.css', '1000', 'all' );
	wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css', '1000', 'all' );

	// add fitvid
	wp_enqueue_script( 'flex-slider', get_template_directory_uri() . '/js/flexslider/jquery.flexslider-min.js', array(), REELGOOD_VERSION, true );
	wp_enqueue_script( 'thief', get_template_directory_uri() . '/js/color-thief.js', array(), REELGOOD_VERSION, true );
	wp_enqueue_script( 'naked-fitvid', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), REELGOOD_VERSION, true );
	wp_enqueue_script( 'imagesLoaded', get_template_directory_uri() . '/js/fn/libs/imagesloaded.pkgd.min.js', array(), REELGOOD_VERSION, true );
	wp_enqueue_script( 'underscore', get_template_directory_uri() . '/js/underscore-min.js', array(), REELGOOD_VERSION, true );
	wp_enqueue_script( 'moment-js', get_template_directory_uri() . '/js/moment.min.js', array(), REELGOOD_VERSION, true );	
	wp_enqueue_script( 'calendar', get_template_directory_uri() . '/js/clndr.min.js', array(), REELGOOD_VERSION, true );
	wp_enqueue_script( 'fancy', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.js', array( 'jquery' ), REELGOOD_VERSION, true );
	wp_enqueue_script( 'hoverintent', get_template_directory_uri() . '/js/hoverIntent.js', array(), REELGOOD_VERSION, true );
	wp_enqueue_script( 'post_actions', get_template_directory_uri() . '/js/fn/posts.js', array('imagesLoaded'), REELGOOD_VERSION, true );
	wp_enqueue_script( 'scroll_actions', get_template_directory_uri() . '/js/fn/scroller.js', array(), REELGOOD_VERSION, true );
	wp_enqueue_script( 'slider-init', get_template_directory_uri() . '/js/fn/slider.js', array(), REELGOOD_VERSION, true );
	wp_enqueue_script( 'sidebar', get_template_directory_uri() . '/js/fn/sidebar.js', array(), REELGOOD_VERSION, true );
	
	// add theme scripts
	wp_enqueue_script( 'naked', get_template_directory_uri() . '/js/theme.min.js', array(), REELGOOD_VERSION, true );
	
  
}
add_action( 'wp_enqueue_scripts', 'rg_scripts' );

/*-----------------------------------------------------------------------------------*/
/* Image Sizes
/*-----------------------------------------------------------------------------------*/
add_image_size( 'rg_slide', 0, 470, false );
add_image_size( 'rg_thumb', 316, 99999, false );


/*-----------------------------------------------------------------------------------*/
/* API
/*-----------------------------------------------------------------------------------*/
require_once('functions/api.php');

/*-----------------------------------------------------------------------------------*/
/* Custom Post Types
/*-----------------------------------------------------------------------------------*/
require_once('functions/register-events-type.php');
require_once('functions/register-review.php');
require_once('functions/custom-fields.php');

/*-----------------------------------------------------------------------------------*/
/* Custom User Types
/*-----------------------------------------------------------------------------------*/
require_once('functions/register-author-user.php');

/*-----------------------------------------------------------------------------------*/
/* Front/Backend
/*-----------------------------------------------------------------------------------*/
require_once('functions/frontend.php');
require_once('functions/sidebar.php');
require_once('functions/json.php');

add_filter('show_admin_bar', '__return_false');
