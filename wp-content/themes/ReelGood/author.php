<?php
if (! is_user_logged_in() ) {
	$location = home_url().'/no-fly';
	wp_redirect( $location, 301 );
	exit;	
}
?>

<?php get_header(); ?>

<section class="home-slide">

		
</section>

<div class="homepage-content">
	
	<div class="row" style="min-height: 800px;">
		
		<div class="row" style=" min-height:800px; margin-bottom: 25px;">			
		
		<!-- What's new at Reel Good -->
		<div class="column large-8" style="min-height: 800px;">
			
			<div class="post-panel-title">AUTHOR TITLE</div>

				<?php if (have_posts()) :
               		while (have_posts()) : the_post();   
					
					foreach($posts as $p):
					
						include(locate_template('partials/home-loop.php'));
					
					endforeach;
				
					endwhile;
     			endif; ?>
				
			<!-- Start mini posts? 
			
				<div class="post-overview--mini column large-16"></div>
			
				<div class="post-overview--mini column large-16"></div>
			-->
			
		</div>
		
		<!-- Sidebar -->
		<div class="column large-4" style="min-height:800px;">
			
			<div class="sidebar">
			
				<?php get_sidebar();?>
			
				<!-- <div class="divlabel">Calendar, Social, Popular Posts</div> -->
			
			</div>
			
		</div>
				
	</div><!--end row -->
		
	</div><!--end featured row -->
	
</div>

<?php get_footer();?>