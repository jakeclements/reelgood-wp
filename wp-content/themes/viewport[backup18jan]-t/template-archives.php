<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

			<div class="clearfix">
				<!--BEGIN #primary .hfeed-->
				<div id="primary" class="hfeed">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<?php zilla_page_before(); ?>
					<!--BEGIN .hentry -->
					<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
					<?php zilla_page_start(); ?>
					
						<h1 class="entry-title"><?php the_title(); ?></h1>
						
						<!--BEGIN .entry-content -->
						<div class="entry-content">
							<?php the_content(__('...', 'zilla')); ?>
							<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'zilla').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
						<!--END .entry-content -->
						</div>
						
						<!--BEGIN .archive-lists -->
						<div class="archive-lists">
							
							<h4><?php _e('Last 30 Posts', 'zilla') ?></h4>
							
							<ul>
							<?php $archive_30 = get_posts('numberposts=30');
							foreach($archive_30 as $post) : ?>
								<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
							<?php endforeach; ?>
							</ul>
							
							<h4><?php _e('Archives by Month:', 'zilla') ?></h4>
							
							<ul>
								<?php wp_get_archives('type=monthly'); ?>
							</ul>
				
							<h4><?php _e('Archives by Subject:', 'zilla') ?></h4>
							
							<ul>
						 		<?php wp_list_categories( 'title_li=' ); ?>
							</ul>
						
						<!--END .archive-lists -->
						</div>
	                
	                <?php zilla_page_end(); ?>
	                <!--END .hentry-->  
					</div>
					<?php zilla_page_after(); ?>
					
					<?php endwhile; else: ?>
	
					<!--BEGIN #post-0-->
					<div id="post-0" <?php post_class() ?>>
					
						<h1 class="entry-title"><?php _e('Error 404 - Not Found', 'zilla') ?></h1>
					
						<!--BEGIN .entry-content-->
						<div class="entry-content">
							<p><?php _e("Sorry, but you are looking for something that isn't here.", "zilla") ?></p>
						<!--END .entry-content-->
						</div>
					
					<!--END #post-0-->
					</div>
	
				<?php endif; ?>
				<!--END #primary .hfeed-->
				</div>
				
			<?php get_sidebar(); ?>
			</div>

<?php get_footer(); ?>