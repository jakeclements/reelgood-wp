<?php
/*--------------------------------------------------------------------------
*
*	Homepage and Post Slider
*
*-------------------------------------------------------------------------*/
?>

<ul class="slides">

	<?php

	foreach($slides as $s):

		$slide_object = null;

		$thumb_ID = get_post_thumbnail_id( $s->ID );
		$slide_object = wp_get_attachment_image_src( $thumb_ID, 'full' );
		$permalink = get_permalink( $s->ID );

		$author_id = $s->post_author;
		$author = get_the_author_meta('nickname', $author_id);

		if( get_field('author_name', $s->ID) ){
			$author = get_field('author_name', $s->ID);
		}

		if(!$slide_object[0]){
			continue;
		}

	?>

	<li class="slide__container" style="background-image: url('<?php echo $slide_object[0]; ?>');" >

		<div class="slide__content">
			<div class="row">
				<div class="column medium-10 medium-pull-1">

					<h2 class="post-title"><a href="<?php echo $permalink ?>"><?php echo $s->post_title; ?></a></h2>

					<?php if(count($slides) == 1): ?>

						<a href="<?php echo get_the_author_meta('user_url'); ?>" class="author-more slide-meta outlined-button">Read more by <?php echo $author ?></a>
						<div class="date-button slide-meta outlined-button">Posted <?php the_date(); ?></div>

					<?php else: ?>

						<a href="<?php echo get_the_author_meta('user_url', $s->post_author); ?>" class="author-more slide-meta outlined-button">By <?php echo $author ?></a>
						<a href="<?php echo $permalink; ?>" class="read-more slide-meta outlined-button">Read More</a>

					<?php endif; ?>

				</div>
			</div>
		</div>

	</li>

	<?php endforeach ?>
</ul>