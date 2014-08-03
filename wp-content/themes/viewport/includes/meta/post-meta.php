<?php

/**
 * Create the Post meta boxes
 */
 
add_action('add_meta_boxes', 'zilla_metabox_posts');
function zilla_metabox_posts(){

	/* Create a featured post metabox -----------------------------------------------*/
    $meta_box = array(
		'id' => 'zilla-metabox-post-feature',
		'title' =>  __('Feature Post Settings', 'zilla'),
		'description' => __('Control how your posts appear in the featured section of the blog index page.', 'zilla'),
		'page' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
					'name' =>  __('Homepage Feature Post', 'zilla'),
					'desc' => __('Check this box to feature this post on the homepage.', 'zilla'),
					'id' => '_zilla_feature_feature',
					'type' => 'checkbox',
                    'std' => ''
				),
			array(
					'name' =>  __('Footer Feature Post', 'zilla'),
					'desc' => __('Check this box to feature this post in the footer carousel.', 'zilla'),
					'id' => '_zilla_feature_footer',
					'type' => 'checkbox',
                    'std' => ''
				),
			array(
					'name' =>  __('Background Image Brightness', 'zilla'),
					'desc' => __('Select the background image brightness of the feature for this post.', 'zilla'),
					'id' => '_zilla_feature_background',
					'type' => 'select',
					'std' => '',
                    'options' => array(
                    	'Dark' => 'Dark',
                    	'Light' => 'Light'
                    )
				)
		)
	);
    zilla_add_meta_box( $meta_box );

    /* Create an image metabox -------------------------------------------------------*/
	$meta_box = array(
		'id' => 'zilla-metabox-post-image',
		'title' =>  __('Image & Display Settings', 'zilla'),
		'description' => __('Upload images to this post using the below controls. Please note that the Featured Image will be used as the "cover" image and will be skipped in the gallery.', 'zilla'),
		'page' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
    		array(
    				'name' =>  __('Upload Images', 'zilla'),
    				'desc' => __('Click to upload images.', 'zilla'),
    				'id' => '_zilla_image_upload',
    				'type' => 'images',
    				'std' => __('Upload Images', 'zilla')
    			)
		)
	);
    zilla_add_meta_box( $meta_box );
        
    /* Create a video metabox -------------------------------------------------------*/
    $meta_box = array(
		'id' => 'zilla-metabox-post-video',
		'title' => __('Video Settings', 'zilla'),
		'description' => __('These settings enable you to embed videos into your portfolio pages.', 'zilla'),
		'page' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array( 
					'name' => __('Video Height', 'zilla'),
					'desc' => __('The video height (e.g. 500).', 'zilla'),
					'id' => '_zilla_video_height',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('M4V File URL', 'zilla'),
					'desc' => __('The URL to the .m4v video file', 'zilla'),
					'id' => '_zilla_video_m4v',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('OGV File URL', 'zilla'),
					'desc' => __('The URL to the .ogv video file', 'zilla'),
					'id' => '_zilla_video_ogv',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('Poster Image', 'zilla'),
					'desc' => __('The preview image.', 'zilla'),
					'id' => '_zilla_video_poster_url',
					'type' => 'text',
					'std' => ''
				),
			array(
					'name' => __('Embedded Code', 'zilla'),
					'desc' => __('If you are using something other than self hosted video such as Youtube or Vimeo, paste the embed code here. Width is best at 960px with any height.<br><br> This field will override the above.', 'zilla'),
					'id' => '_zilla_video_embed_code',
					'type' => 'textarea',
					'std' => ''
				)
		)
	);
	zilla_add_meta_box( $meta_box );
	
	/* Create an audio metabox ------------------------------------------------------*/
	$meta_box = array(
		'id' => 'zilla-metabox-post-audio',
		'title' =>  __('Audio Settings', 'zilla'),
		'description' => __('These settings enable you to embed audio into your portfolio pages.', 'zilla'),
		'page' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array( 
					'name' => __('MP3 File URL', 'zilla'),
					'desc' => __('The URL to the .mp3 audio file', 'zilla'),
					'id' => '_zilla_audio_mp3',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('OGA File URL', 'zilla'),
					'desc' => __('The URL to the .oga, .ogg audio file', 'zilla'),
					'id' => '_zilla_audio_ogg',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('Audio Poster Image', 'zilla'),
					'desc' => __('The preview image for this audio track', 'zilla'),
					'id' => '_zilla_audio_poster_url',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('Audio Poster Image Height', 'zilla'),
					'desc' => __('The height of the poster image', 'zilla'),
					'id' => '_zilla_audio_height',
					'type' => 'text',
					'std' => ''
				)
		)
	);
	zilla_add_meta_box( $meta_box );
	
}