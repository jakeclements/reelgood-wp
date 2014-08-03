<div class="article-block">

	<div class="article-block__post-image right-image">
		<a href="<?php echo $permalink ?>"><img src="<?php echo $thumbnail ;?>" alt="<?php echo $title ?>"></a>
	</div>

	<div class="article-block__post-content archive-block">

		<h4><a href="<?php echo $permalink ?>"><?php echo $title ?></a></h4>
		<?php include(locate_template('partials/post-meta.php')); ?>
		<p><?php echo $excerpt ?></p>

	</div>

</div>