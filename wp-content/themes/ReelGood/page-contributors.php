<?php get_header(); ?>

<?php 

	$args = array(
		'posts_per_page'   => 200,
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'post_type'        => 'post',
		'post_status'      => 'publish',
		'suppress_filters' => true 
	); 
	
	$posts = get_posts( $args );			
	$authors = array();

	foreach($posts as $p){
		
		$a = get_field('author_name', $p->ID);
		
		array_push($authors, $a);
		
	}
	
	$result = array_unique($authors);

	foreach($result as $a){
		
		if($a == 'Douglas Whyte'){
			
			echo '<span style="background:yellow;">' . $a . '</span><br/><br/>';
			continue;
		};
		
		echo $a .'<br/><br/>';
		
	};

	?>

<?php get_footer(); // This fxn gets the footer.php file and renders it ?>