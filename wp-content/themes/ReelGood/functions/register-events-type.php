<?php 

function create_events() {
  
  $labels = array(
    'name' => 'Events',
    'singular_name' => 'Event',
    'add_new' => 'Add Event',
    'add_new_item' => 'Add New Event',
    'edit_item' => 'Edit Event',
    'new_item' => 'New Event',
    'all_items' => 'All Events',
    'view_item' => 'View Event',
    'search_items' => 'Search Events',
    'not_found' =>  'No events found',
    'not_found_in_trash' => 'No events found in Trash', 
    'parent_item_colon' => '',
    'menu_name' => 'Events'
  );
  
  

  $args = array(
    'labels' => $labels,
    'taxonomies' => array('category'),
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => 'event' ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 4,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
  ); 

  register_post_type( 'events', $args );
  
}

add_action( 'init', 'create_events' );

?>