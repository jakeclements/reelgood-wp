<?php
	$postsperpage 	= get_field('posts_per_page');
	$multi 			= get_field('multi_post');
?>

<div class="multi-post-container" data-page="<?php echo $postsperpage; ?>">
	<?php foreach( $multi as $i=>$p ): 
		$postLink = $p['post_link']; 
	?>
		
		<div class="multi-single">
			<div class="multi-img"><img src="<?php echo $p['post_image']['url']; ?>" ?></div>
			<h4><?php echo $p['post_title']; ?></h4>
			<p><?php echo $p['post_content']; ?></p>
			<?php if( $postLink ){ ?><a href="http://www.<?php echo $postLink; ?>">Read review</a><?php }; ?>
		</div>	
		
	<?php endforeach; ?>
</div>