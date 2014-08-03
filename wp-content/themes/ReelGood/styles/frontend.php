<?php
/*-----------------------------------------------------------------------------------*/
/* Hide Admin Bar
/*-----------------------------------------------------------------------------------*/
add_filter('show_admin_bar', '__return_false');

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

function get_homepage_slider(){

	$output  = '';
	
	$posts = get_field('slider_posts', 'options');
	
	if( $posts ):
	
		$output .= '<ul class="slides">';
		
		foreach( $posts as $i=>$p ){
			
			//Create image src
			$image_obj = get_field('featured_wide', $p->ID);
			$image_src = wp_get_attachment_image_src($image_obj['id'], 'rg_slide');
	    	
	    	if($i == 0){
	    	
	    		$output .= '<li class="current">';
	    	
	    	}else{
	    	
	    		$output .= '<li>';
	    	
	    	}
	    	
	    	
	    	
	    	$output .= '<div class="slide-title">' . get_the_title($p->ID) . '</div>';
	    	
	    	$output .= '<span class="slide-break"></span>';
	    	
	    	$output .= '<a class="slide-more" href="' . get_permalink( $p->ID ) . '">READ MORE</a>';
	    	
	    	$output .= '<img src="' . $image_src[0] . '" alt="' . get_the_title( $p->ID ) . '" />';
	    	
	    	$output .= '</li>';
		
		}
	
		$output .= '</ul>';
	
	endif;

	echo $output;
	
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

?>