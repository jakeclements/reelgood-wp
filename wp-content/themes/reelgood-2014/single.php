<?php
/*--------------------------------------------------------------------------
*
*	Single: Fallback
*
*-------------------------------------------------------------------------*/
?>
<?php get_header(); ?>

<?php include(locate_template('partials/share.php'));?>

<?php
	// Show how many times this post has been viewed - sneaky though

    $count = get_post_meta($post->ID, 'wpb_post_views_count', true);

    if($count==''){

        delete_post_meta($post->ID, 'wpb_post_views_count');

        add_post_meta($post->ID, 'wpb_post_views_count', '0');

        $count = 0;

    }

?>


<div data-views="<?php echo $count; ?>" class="single-slider slider">

	<?php

		$slides = array($post);
		include(locate_template('partials/slider.php'));

	?>

</div>
<!-- /home-slider -->

<div class="single-post archive row">

	<div class="column large-8 single-post-content page-content">

		<article>

			<?php echo apply_filters('the_content', $post->post_content); ?>

			<?php if(get_field('bool_digging', $post->ID) == true):

				include(locate_template('partials/post-display/default-tag.php'));

			endif; ?>

		</article>

		<div class="facebook-module">
			<div class="fb-comments" data-href="<?php echo get_permalink($post->ID); ?>" data-width="637" data-numposts="10" data-colorscheme="light"></div>
		</div>

	</div>

	<div class="column large-4 post-sidebar sidebar">

		<?php get_sidebar(); ?>

	</div>

</div>
<!-- mfunc set_post_views( $post->ID ); --><!-- /mfunc -->
<?php get_footer(); ?>