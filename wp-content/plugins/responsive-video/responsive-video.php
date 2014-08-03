<?php
   /*
   Plugin Name: Responsive Video
   Plugin URI: http://www.kirstyburgoine.co.uk/news/responsive-video-wordpress-plugin-released/
   Description: A plugin to add responsive videos to pages, posts and widget areas
   Version: 1.0
   Author: Kirsty Burgoine
   Author URI: http://www.kirstyburgoine.co.uk
   License:	GPLv2


Copyright 2012-2013  Kirsty Burgoine

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License version 2 as published by
the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/


// Include the plugin for video widgets
@require_once dirname( __FILE__ ) . '/video-widget/video-widget.php';


function responsive_css()  {
	// Register the css styling to make the video responsive:  
    wp_register_style( 'responsive-video', plugins_url( '/css/responsive-videos.css', __FILE__ ), array(), '27082012', 'all' ); 
   	wp_enqueue_style( 'responsive-video' );  
}  
add_action( 'wp_enqueue_scripts', 'responsive_css' );  

//-------------------------------------------------------------------------------------------------------------------------------
/**
 * Create the admin settings page
**
//---------------------------------------------------------------------------------------------------------------------------- */


add_action('admin_menu', 'vid_menu');

function vid_menu() {
  add_options_page('Responsive Video options', 'Responsive Video', 7, 'vid_options', 'vid_plugin_options');
  add_action( 'admin_init', 'register_vid_settings' );

}

add_filter('plugin_action_links', 'vid_plugin_action_links', 10, 2);

function vid_plugin_action_links($links, $file) {
    static $this_plugin;

    if (!$this_plugin) {
        $this_plugin = plugin_basename(__FILE__);
    }

    if ($file == $this_plugin) {
        $settings_link = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/admin.php?page=vid_options">Settings</a>';
        array_unshift($links, $settings_link);
    }

    return $links;
}



function register_vid_settings() { // whitelist options
  register_setting( 'vid_options', 'vid_options_field' );
}


//-------------------------------------------------------------------------------------------------------------------------------
/**
 * Admin page plugin options
**
//---------------------------------------------------------------------------------------------------------------------------- */

function vid_plugin_options() {
?>
<div class="wrap">
	<div id="icon-upload" class="icon32"></div>
    
    
    <div class="donate">
	<h3> Like this plugin?</h3>
    
    <p>Why not donate?</p>
    
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="width: 75%;">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="825QYFCWC5LB2">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form>

</div>
    
    
  
	<h2>Responsive Video Settings</h2>
  
	<form method="post" action="options.php">
    <?php
    wp_nonce_field('update-options'); 
    settings_fields( 'vid_options' ); 
    $options = get_option('vid_options_field');
	
	// get the standard page and post types
	$enable_post = $options["enable_post"];
	$enable_page = $options["enable_page"];
	
		// Find all custom post types
		$args=array(
        	'public'   => true,
            '_builtin' => false
		); 
		
		$output = 'names'; // names or objects, note names is the default
        $operator = 'and'; // 'and' or 'or'
        $p_types = get_post_types($args,$output,$operator); 
         
		// loop through all costom post types and create an array          
		$enable = array();
		foreach ($p_types as $p ) {
		
			$enable[$p] = $options["enable_$p"];
			 
		}
		
		//print_r($enable);
    ?>
    
  	<p>&nbsp;</p>
    
    <p>You can select which post, page or custom post type you want to allow the add video settings to display on. <br />Custom posts are added to this list automatically once they have been registered in functions.php in your theme.</p>

    <table>
    
		<tr valign="text-top">
        	<th scope="row">Select post types to allow videos to be displayed</th>
        	<td align="right">
        
                <ul>
                
                <li><label>posts </label><input name="vid_options_field[enable_post]" type="checkbox" value="1" <?php if ( $enable_post == "1" ) { ?> checked="checked" <?php } ?>/></li>
                
                <li><label>pages </label><input name="vid_options_field[enable_page]" type="checkbox" value="1" <?php if ( $enable_page == "1" ) { ?> checked="checked" <?php } ?>/></li>
                
                <?php
                // create a check box for each custom post type    
                $args=array(
                  'public'   => true,
                  '_builtin' => false
                ); 
                
                $output = 'names'; // names or objects, note names is the default
                $operator = 'and'; // 'and' or 'or'
                $post_types=get_post_types($args,$output,$operator); 
				
                // loop through and display a check box for each custom post type 
                foreach ($post_types  as $post_type ) { ?>
				  
					<li><label><?php echo $post_type; ?> </label><input name="vid_options_field[enable_<?php echo $post_type; ?>]" type="checkbox" value="1" class="<?php echo 'enable_' . $post_type; ?>" 
				  
				  	<?php 
				  	// loop through the $enable array from above and find all of the values 
				  	foreach ( $enable as $key => $value ) {
				  		
						// if any of the items in the array have a value of 1 mark them as checked
				  	 	//echo "Key: $key; Value: $value<br />\n";
				  		if ( $key == $post_type && $value == "1" ) { ?> checked="checked" <?php } 
				  	
					
				 	} ?>/>
                  
                  
                  	</li>
                    
<?php			}	// ends the $post_type foreach	
                            
                    
                    ?>
                </ul>         
                
			</td>
      	</tr>
    

    
    	<tr>
        	<td></td>
            
            <td align="right">
            	<p class="submit">
            	<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
            	</p>
       		</td>
            
   		</tr>
    	
    	<input type="hidden" name="action" value="update" />
    
    </table>
    
	</form>
    
<h3>Notes for theme developers</h3>    

<p>Each video is added as custom meta fields which means you can call auto-generated thumbnails from both YouTube and Vimeo to be used instead of a post thumbnail.</p>

<p>
<strong>To do this:</strong></p>

<p>
Open archive.php and find where your post thumbnail sits within the loop. Replace it with the code below.<br />
This code finds the meta information for each post, checks to see if a YouTube video is present. If it isn't, checks for a Vimeo video. If neither have been used, and assuming you are using the "Featured Image" for your thumbnail, it will fall back to the Featured Image. If that hasn't been set either, no image will display.</p>

<code>

		<p>
		global $post;<br />
 		$meta = get_post_meta($post->ID,'_video_meta',TRUE); <br />
        <span style="color: #999999;">/* Setup $post and get the meta data from the custom fields */</span></p>
		
        <p>
		if ( $meta['type'] == "youtube" ) { </p>
        <p style="margin-left: 20px;">
        
        	<span style="color: #999999;">/* Break the video URL apart to find the ID */</span><br />
        	$loc = strpos($meta['url'],"v="); <br />
			$videoid = substr($meta['url'], $loc + 2); </p>
            
            <p style="margin-left: 20px;">
            <span style="color: #999999;">/* YouTube give you a choice of 3 thumbnails: 0.jpg, 1.jpg, 2.jpg */</span><br />
        	echo '&#8249;img src="http://img.youtube.com/vi/'.$videoid.'/0.jpg" alt="the_title();>" /&#8250;';
            
        	
			</p>
			
        <p>
        } else if ( $meta['type'] == "vimeo" ) {</p>
		<p style="margin-left: 20px;">
        
        	<span style="color: #999999;">/* Vimeo's URL structure is slightly different and needs breaking apart differently */</span><br />
			$loc = explode( "/", $meta['url'] ); <br />
			$videoid = end($loc);</p>
			
            <p style="margin-left: 20px;">
        	<span style="color: #999999;">/* Vimeo stores all info about each video in JSON, PHP and XML Formats. This is the PHP version */</span><br />
			$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$videoid.php")); </p>
     		
            <p style="margin-left: 20px;">       
           	<span style="color: #999999;">/* Depending on the size of the image needed you could use ['thumbnail_large'], ['thumbnail_medium'] or ['thumbnail_small']  */</span><br />
			echo '&#8249;img src="'.$hash[0]['thumbnail_large'].'" alt="the_title();" /&#8250;';
        	
            </p>
        
        <p>
        } else { </p>
        
        <p style="margin-left: 20px;">
        	the_post_thumbnail( 'thumbnail' ); </p>
            
     <p>   } </p>
</code>

<p>The autogenerated images will need some styling to make them display the same way your post thumbnails do. This can be done with standard CSS though, exactly as you would do with any other images.</p>

<p>Happy coding! ~ grin!</p>






</div>
<?php
}

//-------------------------------------------------------------------------------------------------------------------------------
/**
 * Contextual help
 * 
**
//---------------------------------------------------------------------------------------------------------------------------- */


function vid_contextual_help($text) {
  $screen = $_GET['page'];
	if ($screen == 'vid_options') {
	$text = "<h5>Need help with the Responsive Videos plugin?</h5>";
	$text .= "<p>Check out the documentation.</p>";
	$text .= "<a href=\"http://wordpress.org/extend/plugins/responsive-video/installation/\">Documentation</a><br /><a href=\"http://wordpress.org/support/plugin/responsive-video\">Support forums</a>";
	}
	return $text;
}
	 
add_action('contextual_help', 'vid_contextual_help', 10, 1);


//-------------------------------------------------------------------------------------------------------------------------------
/**
 * Add the videos directly into pages and posts
 *
 *
**/
//---------------------------------------------------------------------------------------------------------------------------- */


// Creates custom meta box for video settings
define('MY_WORDPRESS_FOLDER',$_SERVER['DOCUMENT_ROOT']);
define('VIDEO_PLUGIN_FOLDER',get_settings('siteurl')."/wp-content/plugins/responsive-video/");
 
add_action('admin_init','video_meta_init');
 
function video_meta_init()
{
    
 
    // registers the style for the meta boxes in the admin panel
    wp_enqueue_style('video_meta_css', VIDEO_PLUGIN_FOLDER . 'css/admin-responsive-videos.css');
 
 	// Set up to use the selections from the main admin screen above to determine which add / edit screens allow videos to be inserted using the shortcode
 	$options = get_option('vid_options_field');
	
	// get the standard page and post types
	$enable_post = $options["enable_post"];
	$enable_page = $options["enable_page"];
	
	// if these have been selected show on the appropriate add / edit screens
	if ( $enable_post == "1" ) {
		add_meta_box('video_all_meta', 'Video Settings', 'video_meta_setup', 'post', 'normal', 'high');
	}
	
	
	if ( $enable_page == "1" ) {
		add_meta_box('video_all_meta', 'Video Settings', 'video_meta_setup', 'page', 'normal', 'high');
	}
	
	
	// Find all custom post types
		$args=array(
        	'public'   => true,
            '_builtin' => false
		); 
		
		$output = 'names'; // names or objects, note names is the default
        $operator = 'and'; // 'and' or 'or'
        $p_types = get_post_types($args,$output,$operator); 
         
		// loop through all costum post types and create an array          
		$enable = array();
		foreach ($p_types as $p ) {
		
			$enable[$p] = $options["enable_$p"];
			
			// loop through the $enable array to find post type and value 
			foreach ( $enable as $key => $value ) { 
				// if post type has a value of 1 display the custom meat box on this add / edit screen
				if ( $key == $p && $value == "1" ) {
				add_meta_box('video_all_meta', 'Video Settings', 'video_meta_setup', $p, 'normal', 'high');
				}
			} 
		}
		

    // original add a meta box for each of the wordpress page types: posts and pages
	/*
    foreach (array('post','page') as $type) 
    {
        add_meta_box('video_all_meta', 'Video Settings', 'video_meta_setup', $type, 'normal', 'high');
    }
	*/
     
    // add a callback function to save any data a user enters in
    add_action('save_post','video_meta_save');
}
 
 
function video_meta_setup()
{
    global $post;
  
    // using an underscore, prevents the meta variable
    // from showing up in the custom fields section
    $meta = get_post_meta($post->ID,'_video_meta',TRUE);
  
    // HTML for meta boxes ?>
    <div class="video_meta_control">
     
    <p>Inserts a video directly into your page / post content using the shortcode <code>[responsive_vid]</code>.</p>
 
    <label>Video Title</label>
 
    <p>
        <input type="text" name="_video_meta[name]" value="<?php if(!empty($meta['name'])) echo $meta['name']; ?>"/>
        <span>Enter in a name</span>
    </p>
    
    <label>Video Type</label>
    
    <p>
    <select name="_video_meta[type]">
        <option value="youtube" <?php if ( $meta['type'] == "youtube" ) { ?> selected="selected" <?php } ?>>YouTube</option>
        <option value="vimeo" <?php if ( $meta['type'] == "vimeo" ) { ?> selected="selected" <?php } ?>>Vimeo</option>
    </select>
        <span>Choose the video type</span>
    </p>
    
    <label>Video URL</label>
    
    <p>
        <input type="text" name="_video_meta[url]" value="<?php if(!empty($meta['url'])) echo $meta['url']; ?>"/>
        <span>Paste the URL of the video from the main address bar here</span>
    </p>
 
   
 
</div> 

<div class="video_meta_control right-box">
	

 	<label>Description </label>
 
    <p>
        <textarea name="_video_meta[description]" rows="5"><?php if(!empty($meta['description'])) echo $meta['description']; ?></textarea>
        <span>(optional) Enter in a description</span>
    </p>
    
    <p>Copy and paste the shortcode <code>[responsive_vid]</code> anywhere within the main content of the page</p>


</div>

<div class="seperator"></div>


<?php
  
    // create a custom nonce for submit verification later
    echo '<input type="hidden" name="video_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
}
  
function video_meta_save($post_id) 
{
    // authentication checks
 
    // make sure data came from our meta box
    if (!wp_verify_nonce($_POST['video_meta_noncename'],__FILE__)) return $post_id;
 
    // check user permissions
    if ($_POST['post_type'] == 'page') 
    {
        if (!current_user_can('edit_page', $post_id)) return $post_id;
    }
    else
    {
        if (!current_user_can('edit_post', $post_id)) return $post_id;
    }
 
    // authentication passed, save data
 
    // var types
    // single: _my_meta[var]
    // array: _my_meta[var][]
    // grouped array: _my_meta[var_group][0][var_1], _my_meta[var_group][0][var_2]
 
    $current_data = get_post_meta($post_id, '_video_meta', TRUE);  
  
    $new_data = $_POST['_video_meta'];
 
    video_meta_clean($new_data);
     
    if ($current_data) 
    {
        if (is_null($new_data)) delete_post_meta($post_id,'_video_meta');
        else update_post_meta($post_id,'_video_meta',$new_data);
    }
    elseif (!is_null($new_data))
    {
        add_post_meta($post_id,'_video_meta',$new_data,TRUE);
    }
 
    return $post_id;
}
 
function video_meta_clean(&$arr)
{
    if (is_array($arr))
    {
        foreach ($arr as $i => $v)
        {
            if (is_array($arr[$i])) 
            {
                video_meta_clean($arr[$i]);
 
                if (!count($arr[$i])) 
                {
                    unset($arr[$i]);
                }
            }
            else
            {
                if (trim($arr[$i]) == '') 
                {
                    unset($arr[$i]);
                }
            }
        }
 
        if (!count($arr)) 
        {
            $arr = NULL;
        }
    }
}


//-------------------------------------------------------------------------------------------------------------------------------
/**
 * Create the video Shortcode for use in content
**/
//---------------------------------------------------------------------------------------------------------------------------- */

function videoCode($atts, $content = null) {  

	global $post;

    $meta = get_post_meta($post->ID,'_video_meta',TRUE);
	
		
		
	
	// if the YouTube option is selected
	if ( $meta['type'] == "youtube" ) {
	
		// Find the YouTube ID
		$loc = strpos($meta['url'],"v=");
		$videoid = substr($meta['url'], $loc + 2);
		
				
		extract(shortcode_atts(array(  
			"vid_url" => $videoid,
			"vid_name" => $meta['name'],
			"vid_desc" => $meta['description'],
		), $atts));
		
		
	
		return '
		<h3>'.$vid_name.'</h3>
		
			<div class="video-wrapper"> 
				<div class="video-container">
				
				<iframe src="http://www.youtube.com/embed/'.$vid_url.'" frameborder="0" allowfullscreen></iframe>
								
				</div>
			</div>
		<p>'.$vid_desc.'</p>';  
		
	
	// Else this is a Vimeo video as there are only two options
	} else {
	
		// Find the Vimeo ID
		$loc = explode( "/", $meta['url'] );
		$videoid = end($loc);
		
		
	
		extract(shortcode_atts(array(  
			"vid_url" => $videoid,
			"vid_name" => $meta['name'],
			"vid_desc" => $meta['description'],
		), $atts));
	
		return '
		<h3>'.$vid_name.'</h3>
		
			<div class="video-wrapper"> 
				<div class="video-container">
				
				<iframe src="http://player.vimeo.com/video/'.$vid_url.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe> 
				
				</div>
			</div>
		<p>'.$vid_desc.'</p>';  
	
	}
} 

add_shortcode('responsive_vid', 'videoCode');  


?>