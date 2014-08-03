<aside role="complementary">

	<?php include(locate_template('partials/sidebar/search-form.php'));?>

	<?php include(locate_template('partials/sidebar/newsletter-form.php'));?>

	<?php include(locate_template('partials/sidebar/ad-block.php')); ?>

	<?php
		$type = 'category';
		$title = 'Awesome Videos';
		$category_name = 'awesome-videos';
		include(locate_template('partials/sidebar/post-slider.php'));
	?>

	<?php if( get_field('quote', 'option') ): ?>

		<div class="sidebar-module sidebar-post-slider">
			<h4>ReelGood quote of the day</h4>
			<span class="width: 100%; margin-top: 6px; padding: 12px 0px 10px 0px; margin-bottom: 10px; float: left; font-size: 13px;"><?php the_field('quote', 'option'); ?></span>
			<footer class="caption"><span class="caption-text"><?php the_field('quote_author', 'option'); ?></span></footer>
		</div>

	<?php endif; ?>

	<?php
		$type = 'popular';
		$title = 'Popular Posts';
		include(locate_template('partials/sidebar/post-slider.php'));
	?>

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div class="sidebar-module sidebar-post-slider">
		<ul id="sidebar-1" style="margin: 0px; list-style-type: none; ">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</ul>
	</div>
	<?php endif; ?>

	<?php include(locate_template('partials/sidebar/ad-block-2.php')); ?>

</aside>
