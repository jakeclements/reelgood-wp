<?php
/*-----------------------------------------------------------------------------------*/
/* Hide Admin Bar
/*-----------------------------------------------------------------------------------*/
add_filter('show_admin_bar', '__return_false');

/*-----------------------------------------------------------------------------------*/
/* Get post details
/*-----------------------------------------------------------------------------------*/
function get_post_details(){

	$output = '';
	
	

	return $output;
}

/*-----------------------------------------------------------------------------------*/
/* Create Signup Bar
/*-----------------------------------------------------------------------------------*/

function get_signup_bar(){
	
	$get_call_to_actions = get_field('MC_cta', 'options');
	
	$random_call = $get_call_to_actions[array_rand($get_call_to_actions)];
	
	$output  = '<div class="large-12 columns signup-bar">';
	
		$output .= '<div class="row">';
	
			$output .= '<div class="columns large-7">';
			
			$output .= '<div class="signup-message">';		
			
				$output .= '<h4>'.$random_call['cta_title'].'</h4>';
				
				$output .= '<p>'.$random_call['cta_message'].'</p>';
				
			$output .= '</div>';
	
			$output .= '</div>';
	
			$output .= '<div class="columns large-5">';
				
				$output .= get_field('MC_embed', 'options');
				
				$output .= '<i class="icon-check-sign"></i>';
				
			$output .= '</div>';
	
		$output .= '</div>';
	
	$output .= '</div>';

	echo $output;

}

/*-----------------------------------------------------------------------------------*/
/* Get Homepage Items, post buttons, homepage slider etc..
/*-----------------------------------------------------------------------------------*/

function get_single_banner ($imageObj){

	$output = '';
	
	print_r($imageObj);
	
	
	return $output;
	
}

function get_slider($posts, $single){

	$output  = '';
	
	if($posts == null){
	
		$posts = get_field('slider_posts', 'options');
		
	}else{
	
		$posts = get_queried_object();
	
	};
	
	if( $posts ):
	
		$output .= '<ul class="slides">';
		
		foreach( $posts as $i=>$p ){
		
			//Create image src
			if( get_field('featured_wide', $p->ID) ){
				
				$image_obj = get_field('featured_wide', $p->ID);
				$image_src = wp_get_attachment_image_src($image_obj['id'], 'rg_slide');
				
			}else{
				
				$image_src = array();
				$image_src[0] = wp_get_attachment_url( get_post_thumbnail_id( $p->ID ) );
				
				if(REELGOOD_STAGE == true){ 
				
					$image_src[0] = str_replace('pilot.', '', $image_src[0]);
				
				}
			};
			
			if(!$single){
			
				$output .= get_home_slide_template($i, $p, $image_src);
			
			}else{
	    	
	    		$output .= get_single_slide_template($i, $p, $image_src);
	    	
				break;
	    		
	    	}
		
		}
	
		$output .= '</ul>';
	
	endif;

	echo $output;
	
}

function get_home_slide_template($i, $p, $image_src){

	$output = '';

	$output .= '<li>';
	    	
	$output .= '<div class="slide-title">' . get_the_title($p->ID) . '</div>';
	    	
	$output .= '<span class="slide-break"></span>';
	    	
	$output .= '<a class="slide-more" href="' . get_permalink( $p->ID ) . '">READ MORE</a>';
	    	
	$output .= '<img src="' . $image_src[0] . '" alt="' . get_the_title( $p->ID ) . '" />';
	    	
	$output .= '</li>';
	
	return $output;

}

function get_single_slide_template($i, $p, $image_src){
    	
	$output = '<li class="current single flex-active-slide">';

	$output .= '<div class="slide-title">' . get_the_title($p->ID) . '</div>';
	    	
	$output .= '<span class="slide-break"></span>';
	    	
	//$output .= '<a class="slide-more" href="' . get_permalink( $p->ID ) . '">BY JAKE CLEMENTS</a>';
	    	
	$output .= '<img src="' . $image_src[0] . '" alt="' . get_the_title( $p->ID ) . '" />';
	    	
	$output .= '</li>';
	
	return $output;

}

function get_post_button($category){

	$cat_Obj = get_category_by_slug( $category );
	
	$featured = get_field('featured_posts', 'options');
	
	$output  = '';
	
	$output .= '<div id="'.$category.'-panel" class="mockup large-3 small-12 columns">';
	
		$output .= '<a href="#"><div id="' . $cat_Obj->slug . '" class="panel">';
		
			$output .= '<img src="http://lorempixel.com/g/220/250/city/" alt="Title" />';
			
		$output .= '</div></a>';
		
	$output .= '</div>';
	
	echo $output;

}

function get_post_list($category){

	$cat_Obj = get_category_by_slug( $category ); 
	
	//Get the posts
	$posts = get_posts( array( 'posts_per_page' => 3, 'offset'=> 0, 'category' => $cat_Obj->term_id ) );

	$output  = '';	
	
	$output .= '<h4>'.$cat_Obj->name.'</h4>';
	
	$output .= '<a class="read-more-home" href="' . get_category_link( $cat_Obj->term_id ) . '">Read More ' . $cat_Obj->name . '<i class=""></i></a>';
	
	echo $output;
	
	foreach ( $posts as $p ){
	
		$postID = $p->ID;
		
		$featuredImg = get_field('small_feature_image', $postID);
	
		$tmpl = '';
		
		$tmpl .= '<a href=""><div class="home-post">';
		
		$tmpl .= '';
		
		$tmpl .= '<img src="http://lorempixel.com/220/250/sports/" alt="' . $p->post_title . '" />';
		
			$tmpl .= '<div class="post-meta-home">';
			
				$tmpl .= '<div class="title">' . $p->post_title . '</div>';
			
			$tmpl .= '</div>';
		
		$tmpl .= '</div></a>';
		
		echo $tmpl;
		
	}; 	

}

function get_popular_list($category){

	$output .= '<h4>Popular Posts</h4>';
	
	echo $output;

}

// Custom excerpt length, limit(23)
	
	function excerpt($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
      return $excerpt;
    }

    function content($limit) {
      $content = explode(' ', get_the_content(), $limit);
      if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
      } else {
        $content = implode(" ",$content);
      } 
      $content = preg_replace('/\[.+\]/','', $content);
      $content = apply_filters('the_content', $content); 
      $content = str_replace(']]>', ']]&gt;', $content);
      return $content;
    }

function get_event_layout(){
	
	global $post;
	
	$events = get_field('event_type', $post->ID);
	
	if($events == 'groupedevent'){
		
		$eventList = get_field('grouped_events', $post->ID);
		
		include(locate_template('partials/grouped-events.php'));
		
	}else{
		
		//include(locate_template('your-template-name.php'));
		
	};
	
}

function catch_first_image($postObj) {
  
  
  $first_img = '';
  
  ob_start();
  
  ob_end_clean();
  
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $postObj->post_content, $matches);
  
  $first_img = $matches[1][0];

  if(empty($first_img)) {
    $first_img = "/path/to/default.png";
  }
  
  return $first_img;
}

?>