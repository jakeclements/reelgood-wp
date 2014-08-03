<?php get_header(); ?>

<?php include(locate_template('partials/message-bar.php')); ?>

<div class="single-post archive row">

	<div class="column large-8 single-post-content page-content single-page">

		<article>

			<h2 class="category-title"><?php echo $post->post_title ?></h2>

			<?php echo apply_filters('the_content', $post->post_content); ?>

		</article>

	</div>

	<div class="column large-4 post-sidebar sidebar">

		<?php get_sidebar(); ?>

	</div>

</div>

<?php get_footer(); ?>