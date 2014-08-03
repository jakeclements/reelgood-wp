

<div class="post-block column large-6">

	<h5 class="post-title"><a href="<?php echo $permalink; ?>"><?php echo $title;?></a></h5>

	<?php if($thumbnail): ?>

		<figure>
			<a class="image-link" href="<?php echo $permalink; ?>"><img src="<?php echo $thumbnail;?>" alt="<?php echo title; ?>"></a>
		</figure>

	<?php endif; ?>

	<div class="post-block__description">
		<?php echo $excerpt; ?>
	</div>

	<?php include(locate_template('partials/post-meta.php')); ?>

</div>