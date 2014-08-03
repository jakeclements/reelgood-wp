<?php

/*-----------------------------------------------------------------------------------

	Here we have all the custom functions for the theme
	Please be extremely cautious editing this file,
	When things go wrong, they tend to go wrong in a big way.
	You have been warned!

-------------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*  Set Max Content Width (use in conjuction with ".entry-content img" css)
/* ----------------------------------------------------------------------------------*/
if ( ! isset( $content_width ) ) { $content_width = 600; }


/*-----------------------------------------------------------------------------------*/
/*	Our theme set up
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_theme_setup' ) ) {
    function zilla_theme_setup() {
        
		/* Load translation domain --------------------------------------------------*/
		load_theme_textdomain( 'zilla', TEMPLATEPATH . '/languages' );
		
		$locale = get_locale();
		$locale_file = TEMPLATEPATH . "/languages/$locale.php";
		if ( is_readable( $locale_file ) )
			require_once( $locale_file );
		
		/* Register WP 3.0+ Menus ---------------------------------------------------*/
		register_nav_menu( 'primary-menu', __('Primary Menu', 'zilla') );
		
		/* Configure WP 2.9+ Thumbnails ---------------------------------------------*/
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 50, 50, true ); // Normal post thumbnails
		add_image_size( 'sidebar-thumb', 260, 170, true );
		add_image_size( 'index-thumb', 300, '', true );
		add_image_size( 'index-thumb-cropped', 300, 225, true);
		add_image_size( 'footer-thumb', 200, 140, true );
		add_image_size( 'archive-thumnb', 300, 300); // used to add featured image to RSS
		
		/* Add support for post formats ---------------------------------------------*/
		/* 
		* To add an admin UI to the post formats, use Alex King's plugin at
		* https://github.com/crowdfavorite/wp-post-formats 
		*/
		add_theme_support( 
			'post-formats', 
			array(
				'gallery',
				'video',
				'audio'
			) 
		);
	}
}
add_action( 'after_setup_theme', 'zilla_theme_setup' );

/*-----------------------------------------------------------------------------------*/
/*	Create our Custom post type for authors
/*-----------------------------------------------------------------------------------*/
function my_custom_post_team() {
	$labels = array(
		'name'               => _x( 'Team', 'post type general name' ),
		'singular_name'      => _x( 'Team', 'post type singular name' ),
		'add_new'            => _x( 'Add Team Member', 'book' ),
		'add_new_item'       => __( 'Add New Team Member' ),
		'edit_item'          => __( 'Edit Member' ),
		'new_item'           => __( 'New Member' ),
		'all_items'          => __( 'All Team Members' ),
		'view_item'          => __( 'View Members' ),
		'search_items'       => __( 'Search Members' ),
		'not_found'          => __( 'No Staff found' ),
		'not_found_in_trash' => __( 'No Staff found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Team'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'The Reel Good Team',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
		'capability_type' => 'post',
	);
	register_post_type( 'team', $args );	
}
add_action( 'init', 'my_custom_post_team' );

/*-----------------------------------------------------------------------------------*/
/*	Add a Menu Item for Reel Good Staff
/*-----------------------------------------------------------------------------------*/

add_filter( 'wp_nav_menu_items', 'your_custom_menu_item', 10, 2 );
function your_custom_menu_item ( $items, $args ) {
    if (is_user_logged_in()) {
        $items .= '<li id="menu-item-337" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-337"><a href="http://www.reelgood.com.au/team-updates">Team Updates</a><span class="sep">/</span></li>';
	}
    return $items;
}

/*-----------------------------------------------------------------------------------*/
/*	Register Sidebars
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_sidebars_init' ) ) {

    function zilla_sidebars_init() {
    	register_sidebar(array(
    		'name' => __('Main Sidebar', 'zilla'),
    		'id' => 'sidebar-main',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget' => '</div>',
    		'before_title' => '<h3 class="widget-title">',
    		'after_title' => '</h3>',
    	));
    	
    	register_sidebar(array(
            'name' => __('Single Post Sidebar', 'zilla'),
            'id' => 'sidebar-single',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
    	));

    	register_sidebar(array(
            'name' => __('Page Sidebar', 'zilla'),
            'id' => 'sidebar-page',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
    	));
    	
    	register_sidebar(array(
    		'name' => __('Footer Column 1', 'zilla'),
    		'id' => 'footer1',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget' => '</div>',
    		'before_title' => '<h3 class="widget-title">',
    		'after_title' => '</h3>',
    	));
    	
    	register_sidebar(array(
    		'name' => __('Footer Column 2', 'zilla'),
    		'id' => 'footer2',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget' => '</div>',
    		'before_title' => '<h3 class="widget-title">',
    		'after_title' => '</h3>',
    	));
    	
    	register_sidebar(array(
    		'name' => __('Footer Column 3', 'zilla'),
    		'id' => 'footer3',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget' => '</div>',
    		'before_title' => '<h3 class="widget-title">',
    		'after_title' => '</h3>',
    	));
	}
	
}
add_action( 'widgets_init', 'zilla_sidebars_init' );


/*-----------------------------------------------------------------------------------*/
/*	Change Default Excerpt Length (uncomment if required)
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_excerpt_length' ) ) {
	function zilla_excerpt_length($length) {
		return 30; 
	}
}
add_filter('excerpt_length', 'zilla_excerpt_length');


/*-----------------------------------------------------------------------------------*/
/*	Configure Excerpt String
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_excerpt_more' ) ) {
	function zilla_excerpt_more($excerpt) {
		return str_replace('[...]', '...', $excerpt); 
	}
}
add_filter('wp_trim_excerpt', 'zilla_excerpt_more');


/*-----------------------------------------------------------------------------------*/
/*	Configure Default Title
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_wp_title' ) ) {
	function zilla_wp_title($title) {
		if( !zilla_is_third_party_seo() ){
			if( is_front_page() ){
				return get_bloginfo('name') .' | '. get_bloginfo('description'); 
			} else {
				return trim($title) .' | '. get_bloginfo('name'); 
			}
		}
		return $title;
	}
}
add_filter('wp_title', 'zilla_wp_title');


/*-----------------------------------------------------------------------------------*/
/*	Register and load JS
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_enqueue_scripts' ) ) {
	function zilla_enqueue_scripts() {
	    /* Register our scripts -----------------------------------------------------*/
		wp_register_script('validation', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', 'jquery', '1.9', true);
		wp_register_script('superfish', get_template_directory_uri() . '/js/superfish.js', 'jquery', '1.4.8');
		wp_register_script('supersubs', get_template_directory_uri() . '/js/supersubs.js', 'jquery', '0.2');
		wp_register_script('imagesLoaded', get_template_directory_uri() . '/js/jquery.imagesloaded.min.js', 'jquery', '1.0');
		wp_register_script('masonry', get_template_directory_uri() . '/js/jquery.masonry.min.js', 'jquery', '2.1');
		wp_register_script('carouFredSel', get_template_directory_uri() . '/js/jquery.carouFredSel.packed.js', 'jquery', '5.5');
		wp_register_script('jPlayer', get_template_directory_uri() . '/js/jquery.jplayer.min.js', 'jquery', '2.1');
		wp_register_script('selectivizr', get_template_directory_uri() . '/js/selectivizr.min.js', '', '1.0.2');
		wp_register_script('zilla-custom', get_template_directory_uri() . '/js/jquery.custom.js', 'jquery', '1.0', TRUE);
		
		/* Enqueue our scripts ------------------------------------------------------*/
		wp_enqueue_script('jquery');
		wp_enqueue_script('selectivizr');
		wp_enqueue_script('superfish');
		wp_enqueue_script('supersubs');
		wp_enqueue_script('imagesLoaded');
		wp_enqueue_script('masonry');
		wp_enqueue_script('carouFredSel');
		wp_enqueue_script('jPlayer');
		wp_enqueue_script('zilla-custom');
		
		if( is_singular() ) wp_enqueue_script( 'comment-reply' ); // loads the javascript required for threaded comments 
		if( is_page_template('template-contact.php') ) wp_enqueue_script('validation');
	}
}
add_action('wp_enqueue_scripts', 'zilla_enqueue_scripts');


/*-----------------------------------------------------------------------------------*/
/*	Register and load admin javascript
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_enqueue_admin_scripts' ) ) {
    function zilla_enqueue_admin_scripts() {
        wp_register_script( 'zilla-admin', get_template_directory_uri() . '/includes/js/jquery.custom.admin.js', 'jquery' );
        wp_enqueue_script( 'zilla-admin' );
    }
}
add_action( 'admin_enqueue_scripts', 'zilla_enqueue_admin_scripts' );


/*-----------------------------------------------------------------------------------*/
/*	Comment Styling
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_comment' ) ) {
	function zilla_comment($comment, $args, $depth) {
	
	    $isByAuthor = false;
	
	    if($comment->comment_author_email == get_the_author_meta('email')) {
	        $isByAuthor = true;
	    }
	
        $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class(($isByAuthor ? 'author-comment' : '')); ?> id="li-comment-<?php comment_ID() ?>">

            <div id="comment-<?php comment_ID(); ?>">
                <div class="line"></div>
                
                <?php echo get_avatar($comment,$size='35'); ?>
                
                <div class="comment-author vcard">
                    <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>', 'zilla'), get_comment_author_link()) ?>
                </div>

                <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)', 'zilla'),'  ','') ?> &middot; <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>

                <?php if ($comment->comment_approved == '0') : ?>
                    <em class="moderation"><?php _e('Your comment is awaiting moderation.', 'zilla') ?></em>
                    <br />
                <?php endif; ?>

                <div class="comment-body">
                    <?php comment_text() ?>
                </div>

            </div>
	<?php
	}
}


/*-----------------------------------------------------------------------------------*/
/*	Seperated Pings Styling
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_list_pings' ) ) {
	function zilla_list_pings($comment, $args, $depth) {
	    $GLOBALS['comment'] = $comment; ?>
		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
		<?php 
	}
}


/*-----------------------------------------------------------------------------------*/
/*  Output image
/*
/*  @param int $postid the post id
/*  @param int $imagesize the image size
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_image' ) ) {
    function zilla_image($postid, $imagesize) {
        // get the featured image for the post
        $thumbid = 0;
        if( has_post_thumbnail($postid) ) {
            $thumbid = get_post_thumbnail_id($postid);
        }
    
        // get first 2 attachments for the post
        $args = array(
            'orderby' => 'menu_order',
            'post_type' => 'attachment',
            'post_parent' => $postid,
            'post_mime_type' => 'image',
            'post_status' => null,
            'numberposts' => 2
        );
        $attachments = get_posts($args);

        if( !empty($attachments) ) {
            foreach( $attachments as $attachment ) {
                // if current image is featured image reloop
                if( $attachment->ID == $thumbid ) continue;
                $src = wp_get_attachment_image_src( $attachment->ID, $imagesize );
                $alt = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;
                echo "<div class='image-frame'>";
                echo "<img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' />";
                echo "</div>";
                // got image, time to exit foreach
                break;
            }
        }
    }
}

/*-----------------------------------------------------------------------------------*/
/*  Output gallery slideshow
/*
/*  @param int $postid the post id
/*  @param int $imagesize the image size 
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_gallery' ) ) {
    function zilla_gallery($postid, $imagesize) {
        $delay = zilla_get_option('post_gallery_delay');
        if( is_numeric($delay) && $delay > 0 ) {
            $delay = "data-delay='$delay'";
        } else {
            $delay = '';
        }
        
        // get all of the attachments for the post
        $args = array(
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'post_type' => 'attachment',
            'post_parent' => $postid,
            'post_mime_type' => 'image',
            'post_status' => null,
            'numberposts' => -1
        );
        $attachments = get_posts($args);
        if( !empty($attachments) ) {
            echo '<div id="feature-wrapper"' . $delay . ' class="zilla-gallery">';
            $i = 0;
            foreach( $attachments as $attachment ) {
                $src = wp_get_attachment_image_src( $attachment->ID, $imagesize );
                $caption = $attachment->post_excerpt;
                $caption = ($caption) ? "<div class='feature-credit'>$caption</div>" : '';
                $alt = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;
                echo "<div class='feature dark'><img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' />$caption<div class='feature-navigation'></div></div>";
                $i++;
            }
            echo '</div>';
        }
    }
}

/*-----------------------------------------------------------------------------------*/
/*	Output Audio
/* 
/*  @param int $postid the post id
/*  @param int $width the width of the audio player
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_audio' ) ) {
    function zilla_audio($postid, $width = 560) {
	
    	$mp3 = get_post_meta($postid, '_zilla_audio_mp3', TRUE);
    	$ogg = get_post_meta($postid, '_zilla_audio_ogg', TRUE);
    	$poster = get_post_meta($postid, '_zilla_audio_poster_url', TRUE);
    	$height = get_post_meta($postid, '_zilla_audio_height', TRUE);
	
    ?>

    		<script type="text/javascript">
		
    			jQuery(document).ready(function(){
	
    				if(jQuery().jPlayer) {
    					jQuery("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({
    						ready: function () {
    							jQuery(this).jPlayer("setMedia", {
    							    <?php if($poster != '') : ?>
    							    poster: "<?php echo $poster; ?>",
    							    <?php endif; ?>
    							    <?php if($mp3 != '') : ?>
    								mp3: "<?php echo $mp3; ?>",
    								<?php endif; ?>
    								<?php if($ogg != '') : ?>
    								oga: "<?php echo $ogg; ?>",
    								<?php endif; ?>
    								end: ""
    							});
    						},
    						<?php if( !empty($poster) ) { ?>
    						size: {
            				    width: "<?php echo $width; ?>px",
            				    height: "<?php echo $height . 'px'; ?>"
            				},
            				<?php } ?>
    						swfPath: "<?php echo get_template_directory_uri(); ?>/js",
    						cssSelectorAncestor: "#jp_interface_<?php echo $postid; ?>",
    						supplied: "<?php if($ogg != '') : ?>oga,<?php endif; ?><?php if($mp3 != '') : ?>mp3, <?php endif; ?> all"
    					});
					
    				}
    			});
    		</script>
		
    	    <div id="jquery_jplayer_<?php echo $postid; ?>" class="jp-jplayer jp-jplayer-audio"></div>

            <div class="jp-audio-container">
                <div class="jp-audio">
                    <div class="jp-type-single">
                        <div id="jp_interface_<?php echo $postid; ?>" class="jp-interface">
                            <ul class="jp-controls">
                            	<li><div class="seperator-first"></div></li>
                                <li><div class="seperator-second"></div></li>
                                <li><a href="#" class="jp-play" tabindex="1">play</a></li>
                                <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
                                <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
                                <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
                            </ul>
                            <div class="jp-progress-container">
                                <div class="jp-progress">
                                    <div class="jp-seek-bar">
                                        <div class="jp-play-bar"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="jp-volume-bar-container">
                                <div class="jp-volume-bar">
                                    <div class="jp-volume-bar-value"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    	<?php 
    }
}


/*-----------------------------------------------------------------------------------*/
/*  Output video
/*
/*  @param int $postid the post id
/*  @param int $width the width of the video player
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_video' ) ) {
    function zilla_video($postid, $width = 560) {
	
    	$height = get_post_meta($postid, '_zilla_video_height', true);
    	if( !is_numeric($height) || $height <= 0 ) $height = 500;
    	$m4v = get_post_meta($postid, '_zilla_video_m4v', true);
    	$ogv = get_post_meta($postid, '_zilla_video_ogv', true);
    	$poster = get_post_meta($postid, '_zilla_video_poster_url', true);
    	$embed = get_post_meta($postid, '_zilla_video_embed_code', true);
	
		if( $embed ){
			echo '<div class="embed-video" style="width:'. $width .'px;height:'. $height .'px;">'. stripslashes(htmlspecialchars_decode($embed)) .'</div>';
		} else {
    ?>
    <script type="text/javascript">
    	jQuery(document).ready(function(){
		
    		if(jQuery().jPlayer) {
    			jQuery("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({
    				ready: function () {
    					jQuery(this).jPlayer("setMedia", {
    						<?php if($m4v != '') : ?>
    						m4v: "<?php echo $m4v; ?>",
    						<?php endif; ?>
    						<?php if($ogv != '') : ?>
    						ogv: "<?php echo $ogv; ?>",
    						<?php endif; ?>
    						<?php if ($poster != '') : ?>
    						poster: "<?php echo $poster; ?>"
    						<?php endif; ?>
    					});
    				},
    				size: {
    				    width: "<?php echo $width ?>px",
    				    height: "<?php echo $height; ?>px"
    				},
    				swfPath: "<?php echo get_template_directory_uri(); ?>/js",
    				cssSelectorAncestor: "#jp_interface_<?php echo $postid; ?>",
    				supplied: "<?php if($m4v != '') : ?>m4v, <?php endif; ?><?php if($ogv != '') : ?>ogv, <?php endif; ?> all"
    			});
    		}
    	});
    </script>

    <div id="jquery_jplayer_<?php echo $postid; ?>" class="jp-jplayer jp-jplayer-video"></div>

    <div class="jp-video-container">
        <div class="jp-video">
            <div class="jp-type-single">
                <div id="jp_interface_<?php echo $postid; ?>" class="jp-interface">
                    <ul class="jp-controls">
                    	<li><div class="seperator-first"></div></li>
                        <li><div class="seperator-second"></div></li>
                        <li><a href="#" class="jp-play" tabindex="1">play</a></li>
                        <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
                        <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
                        <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
                    </ul>
                    <div class="jp-progress-container">
                        <div class="jp-progress">
                            <div class="jp-seek-bar">
                                <div class="jp-play-bar"></div>
                            </div>
                        </div>
                    </div>
                    <div class="jp-volume-bar-container">
                        <div class="jp-volume-bar">
                            <div class="jp-volume-bar-value"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php }
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Add page template to body class
/*-----------------------------------------------------------------------------------*/

function zilla_add_page_template($classes) {
    global $post;
    
    if( is_home() ) {
        $page = get_post_meta( get_option('page_for_posts'), '_wp_page_template', true);
        if( !empty( $page ) ) {
            $page = preg_replace('/\./', '-', $page);
            $page = 'page-template-' . $page;
            $classes[] = $page;
        }
    }
    
    return $classes;
}
add_filter('body_class', 'zilla_add_page_template');


/*-----------------------------------------------------------------------------------*/
/*	Include the ThemeZilla Framework
/*-----------------------------------------------------------------------------------*/

$tempdir = get_template_directory();
require_once($tempdir .'/framework/init.php');
require_once($tempdir .'/includes/init.php');


?>