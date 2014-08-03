<?php 

function create_reviews() {
  
  $labels = array(
    'name' => 'Review',
    'singular_name' => 'Review',
    'add_new' => 'Manually Add Review',
    'add_new_item' => 'Add New Review',
    'edit_item' => 'Edit Review',
    'new_item' => 'New Review',
    'all_items' => 'All Uploaded Reviews',
    'view_item' => 'View Review',
    'search_items' => 'Search Reviews',
    'not_found' =>  'No reviews found',
    'not_found_in_trash' => 'No reviews found in Trash', 
    'parent_item_colon' => '',
    'menu_name' => 'Author Uploads'
  );
  
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => 'review' ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 4,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
  ); 

  register_post_type( 'reviews', $args );
  
}

add_action( 'init', 'create_reviews' );

?>