<?php
/**
 * Template Name: Home
 */
?>

<?php get_header(); ?>

<div class="home-slider slider">

	<?php

		$args = array(
			'posts_per_page'   => 5,
			'offset'           => 0,
			'meta_query' => array(
					'relation' => 'AND',
					array(
						'relation' => 'OR',
						array(
							'key' => '_zilla_feature_feature',
							'value' => 'on'
						),
						array(
							'key' => 'bool_feature',
							'value' => '1',
						)
					),
					array(
						'key' => '_thumbnail_id',
					)
				)
			);

		$slides = get_posts( $args );

		if( get_field('slides') ){

			$slides = get_field('slides');

		}

		include(locate_template('partials/slider.php'));

	?>

</div>
<!-- /home-slider -->

<?php include(locate_template('partials/message-bar.php')); ?>

<div class="home-post-list archive row">

	<div class="column medium-8 home-featured-posts page-content">


		<?php

			$homepage_posts = array(
				'posts_per_page'   => 10
			);

			$posts = get_posts($homepage_posts);
			include(locate_template('partials/post-display/post-archive.php'));

		?>

	</div>

	<div class="column medium-4 home-sidebar sidebar">

		<?php get_sidebar(); ?>

	</div>

</div>

<?php get_footer(); ?>