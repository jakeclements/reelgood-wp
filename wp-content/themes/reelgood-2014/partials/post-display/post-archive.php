<?php foreach($posts as $i=>$p):

	$title = $p->post_title;
	$permalink = get_permalink($p->ID);
	$excerpt = get_post_meta($p->ID, '_yoast_wpseo_metadesc', true);
	$thumbnail = catch_first_image($p->ID);
	$date = get_the_time( 'l, n M', $p->ID );
	$author_id = $p->post_author;
	$author_nickname = get_the_author_meta('nickname', $author_id);
	$author_link = get_author_posts_url( $author_id );

	if( get_field('author_name', $p->ID) ){
		$author_nickname = get_field('author_name', $p->ID);
	}

	include(locate_template('partials/post-display/post-block.php'));

endforeach; ?>