<?php get_header(); ?>

			<div class="clearfix">
				<!--BEGIN #primary .hfeed-->
				<div id="primary" class="hfeed">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
					<?php zilla_post_before(); ?>
					<!--BEGIN .hentry -->
					<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
					<?php zilla_post_start(); ?>
					
						<?php 
						// If there is a post thumbnail, we output
						// the title and meta in header.php
						$post_format = get_post_format();
						if( !has_post_thumbnail() || $post_format == 'gallery' || $post_format == 'video' || $post_format == 'audio' ){ ?>
							<h1 class="entry-title"><?php the_title(); ?></h1>
							
							<!--BEGIN .entry-meta .entry-header-->
							<div class="entry-meta entry-header">
							
								<span class="published"><?php the_time( 'd M Y' ); ?></span>
								<span class="meta-sep">/</span>
								<?php edit_post_link( __('edit', 'zilla'), '<span class="meta-sep">/</span> <span class="edit-post">', '</span>' ); ?>
								
							<!--END .entry-meta entry-header -->
							</div>
						<?php } ?>
						
						<?php /* if show post image is checked */
						if (zilla_get_option('post_show_featured_image') == 'on') { ?>
						<?php /* if the post has a WP 2.9+ Thumbnail */
						if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
						<div class="post-thumb">
							<?php the_post_thumbnail('thumbnail-large'); /* post thumbnail settings configured in functions.php */ ?>
						</div>
						<?php } } ?>
						
						<!--BEGIN .entry-content -->
						<div class="entry-content">
							<?php the_content(__('...', 'zilla')); ?>
							<?php if( get_field('multipage') == 'multi' ){ include(locate_template('partials/multi.php')); }; ?>
							<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'zilla').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
						<!--END .entry-content -->
						</div>
						
						<!--BEGIN .entry-meta .entry-footer -->
						<div class="entry-meta entry-footer">
    						<span class="entry-categories"><?php _e('Posted in', 'zilla') ?>: <?php the_category(', ') ?></span>
                            <span class="entry-tags"><?php the_tags('/&nbsp;'.__('Tagged:', 'zilla').' ', ', ', ''); ?></span>
						</div>
						<!--END .entry-meta .entry-footer -->


						<?php if(get_field('auth_biotext')){ ?>
							<div class="authorpanel" style="padding: 40px 0 20px 0;
							margin: 0;
							list-style-type: none;
							background: url(http://www.reelgood.com.au/wp-content/themes/viewport/images/splitter.png) repeat-x;
							}">
							
							<?php $authorname = get_field('auth_biotext');?>
							
							<h4 style="margin-bottom: 6px;">About the author: <?php echo $authorname; ?></h4>
							<?php
							if(get_field('authorrepeater', 'options')){
								while(the_repeater_field('authorrepeater', 'options')){ ?>
									
									<?php  if(get_sub_field('bioauthorname')==$authorname){
										the_sub_field('bioauthorbio');
									}else{
									
									};?>
									
									
									
									
							<?php }}; ?>
							
							
							
							</div>
						<?php }; ?>

                   
	                <?php zilla_post_end(); ?>
	                <!--END .hentry-->  
					</div>
					<?php zilla_post_after(); ?>
	
	
	
					<?php 
					    zilla_comments_before();
					    comments_template('', true); 
					    zilla_comments_after();
					?>
					
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
			
			<!--BEGIN .navigation .page-navigation -->
			<div class="navigation single-page-navigation clearfix">
				<div class="nav-next"><?php previous_post_link(__('%link', 'zilla'), __('<span>&larr;</span> %title', 'zilla')) ?></div>
				<div class="nav-previous"><?php next_post_link(__('%link', 'zilla'), __('%title <span>&rarr;</span>', 'zilla')) ?></div>
			<!--END .navigation .page-navigation -->
			</div>

<?php get_footer(); ?>