<?php get_header(); ?>

<section class="home-slide">

	<?php get_slider(null, false); ?>
		
</section>

<div class="homepage-content">
	
	<div class="row" style="min-height: 800px;">
	
		<!-- <div class="front-page-note"></div> -->
	
		<div class="row" style=" min-height:800px; margin-bottom: 25px;">			
		
		<!-- What's new at Reel Good -->
		<div class="column large-8 post-loop" style="min-height: 800px;">
			
			<div class="post-panel-title">NEWSREEL</div>

				<?php 
				
					$posts = get_posts(array( 'posts_per_page' => 6, 'order'=> 'DESC' ));
					
					foreach($posts as $p):
					
						include(locate_template('partials/home-loop.php'));
					
					endforeach;
				
				?>
			
		</div>
		
		<!-- Sidebar -->
		<div class="column large-4" style="min-height:800px;">
			
			<div class="sidebar">
			
				<?php get_sidebar();?>
			
			</div>
			
		</div>
		
		<!-- Sidebar -->
		<!-- <div class="column large-12" style="background: rgba(0, 0, 0, .6); height:200px; margin-top: 25px;">
			
			<div class="divlabel">Video scroller</div>
			
		</div> -->
				
	</div><!--end row -->
		
	</div><!--end featured row -->
	
</div>

<?php get_footer();?>

<?php /*

<?php // get_signup_bar(); ?>
	
	<div class="row">
	
		<?php get_post_button('reviews'); ?>
		<?php get_post_button('events'); ?>
		<?php get_post_button('news'); ?>
		<?php get_post_button('articles'); ?>
		
	</div><!--end featured row -->
	
	

 */ ?>