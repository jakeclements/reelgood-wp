<?php
/**
 * The template for displaying the home/index page.
 * This template will also be called in any case where the Wordpress engine 
 * doesn't know which template to use (e.g. 404 error)
 */

get_header(); // This fxn gets the header.php file and renders it ?>

<?php
	global $query_string;

	$query_args = explode("&", $query_string);
	$search_query = array();

	foreach($query_args as $key => $string) {
	
		$query_split = explode("=", $string);
		
		$search_query[$query_split[0]] = urldecode($query_split[1]);
	
	} // foreach

	$total_results = $wp_query->found_posts;
	$search = new WP_Query($search_query);
	
?>

<div class="homepage-content">
	
	<div class="row" style="min-height: 800px;">
	
		<!-- <div class="front-page-note"></div> -->
	
		<div class="row">			
		
		<!-- What's new at Reel Good -->
		<div class="column large-8 post-loop">
			
			<div style="text-transform:uppercase;" class="post-panel-title"><?php echo $total_results ?> results found for '<?php echo get_search_query(); ?>'</div>

				<?php 
					
					if (have_posts()) : while (have_posts()) : the_post();
					
						include(locate_template('partials/home-loop.php'));
				
					endwhile; endif;
				
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

<?php
get_footer(); // This fxn gets the footer.php file and renders it ?>