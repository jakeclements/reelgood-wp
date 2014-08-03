<?php
/**
 * The template for displaying any single post.
 *
 */

get_header();

if (have_posts()) : while (have_posts()) : the_post();
	
	$imageObj = get_field('featured_wide');

?>
	
<div class="post-content row">
		
		<article class="large-8 columns">
			
			<h3><?php the_title(); ?></h3>
			
			<div class="post-meta">
				<div class="post-comments"><a href="<?php echo get_permalink($p->ID);?>"><span class="bold"><fb:comments-count href="<?php echo get_permalink($p->ID); ?>"></fb:comments-count></span> Comments</a></div>
			</div><!-- end post meta -->
			
			<?php the_content(); ?>
			
			<?php get_event_layout(); ?> 

			<div class="fb-comment-container">
				<div class="fb-comments"data-href="<?php the_permalink(); ?>" data-num-posts="10" mobile="false"></div>
			</div><!-- end facebook comments -->

			
		</article>
		
		<aside class="large-4 columns">
		
			<?php get_sidebar();?>
			
		</aside>
		
</div>

<?php endwhile; endif; ?>

<?php get_footer();?>
