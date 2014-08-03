<?php
/*--------------------------------------------------------------------------
*
*	SIDEBAR: Post-Slider
*
*-------------------------------------------------------------------------*/
?>
<?php if($type == 'category'){

	$slides = get_posts(array(
	'posts_per_page'   => 6,
	'category_name'	   => $category_name
	));

}else if($type == 'popular'){

	$pop = array(
		'posts_per_page'   => 6,
		'meta_key' => 'wpb_post_views_count',
		'orderby' => 'meta_value_num',
		'order' => 'DESC'
	);

	$slides = get_posts($pop);

};
?>

<div class="sidebar-module sidebar-post-slider">
	<h4><?php echo $title; ?></h4>
	<ul class="slides">
	<?php foreach($slides as $sb):
		$title = $sb->post_title;
		$permalink = get_permalink($sb->ID);
		$thumbnail = catch_first_image($sb->ID);
	?>
		<li><a href="<?php echo $permalink ?>"><img src="<?php echo $thumbnail ?>" alt="<?php echo $title ?>"><footer class="caption"><span class="caption-text"><?php echo $title ?></span></footer></a></li>
	<?php endforeach;?>
	</ul>
</div>