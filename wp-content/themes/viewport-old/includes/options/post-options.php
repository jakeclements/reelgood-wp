<?php 

/**
 * Create the Post Options section
 */
add_action('admin_init', 'zilla_post_options');
function zilla_post_options(){
	$post_options['description'] = __('Here you can configure how you would like your featured posts to function.', 'zilla');

    $post_options[] = array('title' => __('Display Header Featured Posts', 'zilla'),
                            	'desc' => __('If you would like to display featured posts in the header of the homepage, please enter the number to display here. If you do not want to display posts in the featured area leave this field blank or set to 0.', 'zilla'),
                            	'type' => 'text',
                            	'id' => 'home_feature_posts');
                            	
    $post_options[] = array('title' => __('Header Featured Posts Delay', 'zilla'),
                            	'desc' => __('If you would like the posts to automatically change, please enter the delay in seconds here. If you do not want the posts to change automatically leave this field blank or set to 0.', 'zilla'),
                            	'type' => 'text',
                            	'id' => 'home_feature_posts_delay');
                            	
	$post_options[] = array('title' => __('Default Header Image for Archive Pages', 'zilla'),
                            	'desc' => __('This adds a header images to all archive pages (tags, categories, author, and date archive pages), search, and the 404 page.', 'zilla'),
                            	'type' => 'file',
                            	'id' => 'post_default_header_image');
                            	
    $post_options[] = array('title' => __('Default Header Image Height', 'zilla'),
                            'desc' => __('Please enter the height of the image to be used as the default image.', 'zilla'),
                            'type' => 'text',
                            'id' => 'post_default_header_height');

    $post_options[] = array('title' => __('Default Header Image Width', 'zilla'),
                            'desc' => __('Please enter the width of the image to be used as the default image.', 'zilla'),
                            'type' => 'text',
                            'id' => 'post_default_header_width');
                            	
    $post_options[] = array('title' => __('Default Header Caption', 'zilla'),
                                'desc' => __('If you would like a caption for the default header image, please enter it here.', 'zilla'),
                                'type' => 'textarea',
                                'id' => 'post_default_header_caption');
    
    $post_options[] = array('title' => __('Gallery Post Format Delay', 'zilla'),
                            	'desc' => __('If you would like the posts to automatically transition within gallery posts, please enter the delay in seconds here. If you do not want the posts to change automatically leave this field blank or set to 0.', 'zilla'),
                            	'type' => 'text',
                            	'id' => 'post_gallery_delay');
                            	
    $feature_count = array(
        0 => 0,
        4 => 4,
        8 => 8,
        12 => 12);
                            	
    $post_options[] = array('title' => 'Display Footer Carousel',
                            	'desc' => 'If you would like to display featured posts in the footer carousel, please enter the number to display here. If you do not want to display the footer carousel set to 0.',
                            	'type' => 'select',
                            	'options' => $feature_count,
                            	'id' => 'footer_feature_posts');
                                
    zilla_add_framework_page( 'Post Options', $post_options, 15 );
}

?>