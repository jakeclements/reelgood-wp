<?php
/*-----------------------------------------------------------------------------------*/
/* Giveaway buttons
/*-----------------------------------------------------------------------------------*/

function get_giveaway_buttons(){

	$output .= '<div class="sidebar-module login-signup sidebar-big"><a class="sidebar__giveaway anim-fast" href="#">GIVEAWAYS</a><a class="sidebar__signup anim-fast" href="#">SIGN UP</a><a class="sidebar__login anim-fast" href="#">LOGIN</a></div>';
	
	echo $output;

};

function get_side_calendar(){

	$output .= '';
	
	echo $output;

};

function get_sidebar_posts($title, $slug){
	
	$args = array(
		'posts_per_page'   => 8,
		'category' 		   => $slug,
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'post_type'        => 'post',
		'post_status'      => 'publish'
	); 

	$posts = get_posts($args);
	
	$output .= '<div class="sidebar-module sidebar-big"><h3 class="sidebar__posts ' . $slug . '">' . $title . '</h3>';
	
		$output .= '<div class="post-list"><ul>';
	
			foreach($posts as $i=>$p){
				
				$image = get_field('small_feature_image', $p->ID);
				
				$title = substr(get_the_title($p->ID),0,40).'...';
				$thumb = $image['sizes']['rg_thumb'];
				
				if($thumb == ''){
					
					$thumb = catch_first_image(get_post($p->ID));
					
				};
				
				if(REELGOOD_STAGE == true){ 
					
					$thumb = str_replace('pilot.', '', $thumb);
					
				};
				
				$output .= '<li><a href="#" class="prev disabled">&#xf04b;</a><a href="' . get_permalink($p->ID) . '"><div class="imgconst"><img src="' . $thumb . '" alt="' . $title . '" /></div><div class="caption">' . $title . '</div></a><a href="#" class="next">&#xf04b;</a></li>';
				
			};
	
		$output .= '</ul></div>';
	
	$output .= '</div>';
	
	echo $output;

};


function get_sidebar_calendar($title){

	$output = '<div class="sidebar-module sidebar-big"><h3 class="sidebar__posts ' . $title . '">' . $title . '</h3>';

	$output .= '<div class="calendar-container">';
	
	$output .= get_template_part('partials/sidebar-calendar');

	$output .= '</div></div>';
	
	echo $output;
}

?>