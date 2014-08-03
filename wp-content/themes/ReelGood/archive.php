<?php 
	get_header();
	$obj = get_queried_object();	
?>

<div class="archive-content">
	
	<div class="row">
		
		<div class="row">			
		
		<!-- What's new at Reel Good -->
		<div class="column large-8">
			
			<div class="post-panel-title"><?php echo $obj->name ?></div>

				<?php if (have_posts()) :
				
               		while (have_posts()) : the_post();   
										
						include(locate_template('partials/home-loop.php'));
					
					endwhile;
					
					wp_pagenavi();
					
     			endif; ?>
				
		</div>
		
		<!-- Sidebar -->
		<div class="column large-4">
			
			<div class="sidebar">
			
				<?php get_sidebar();?>
			
			</div>
			
		</div>
				
	</div><!--end row -->
		
	</div><!--end featured row -->
	
</div>

<?php get_footer();?>