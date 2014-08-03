<?php get_header(); ?>
			
			<div class="clearfix">
				<!--BEGIN #primary .hfeed-->
				<div id="primary" class="hfeed masonry">			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<?php zilla_post_before(); ?>
					<!--BEGIN .hentry -->
					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">				
					<?php zilla_post_start(); ?>
					
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'zilla'), get_the_title()); ?>"> <?php the_title(); ?></a></h2>
										
						<!--BEGIN .entry-meta .entry-header-->
						<div class="entry-meta entry-header">
							<span class="published"><?php the_time( 'd M Y' ); ?></span>
							<span class="meta-sep">/</span>
							<span class="comment-count"><?php comments_popup_link(__('No Comments', 'zilla'), __('1 Comment', 'zilla'), __('% Comments', 'zilla')); ?></span>
							<?php edit_post_link( __('edit', 'zilla'), '<span class="meta-sep">/</span> <span class="edit-post">', '</span>' ); ?>
						<!--END .entry-meta entry-header -->
						</div>
						
						<?php /* if the post has a WP 2.9+ Thumbnail */
						if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
						<div class="post-thumb">
							<?php 
							$post_format = get_post_format();
							if( $post_format == 'gallery' || $post_format == 'video' || $post_format == 'audio' ){ ?>
							<div class="format-icon <?php echo $post_format; ?>"></div>
							<?php } ?>
							<a title="<?php printf(__('Permanent Link to %s', 'zilla'), get_the_title()); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('index-thumb'); /* post thumbnail settings configured in functions.php */ ?></a>
						</div>
						<?php } ?>
	
						<!--BEGIN .entry-content -->
						<div class="entry-content">
							<?php // the_excerpt();
							if(get_field('acfexcerpt')){
								the_field('acfexcerpt');
							}else{
								the_excerpt();
								}; ?>
						<!--END .entry-content -->
						</div>
	                
	                <?php zilla_post_end(); ?>
					<!--END .hentry-->  
					</div>
					<?php zilla_post_after(); ?>
	
					<?php endwhile; ?>
	
				<?php else : ?>
	
					<!--BEGIN #post-0-->
					<div id="post-0" <?php post_class(); ?>>
					
						<h2 class="entry-title"><?php _e('Error 404 - Not Found', 'zilla') ?></h2>
					
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
			<div class="navigation page-navigation clearfix">
				<div class="nav-next"><?php next_posts_link(__('<span>&larr;</span> Older Entries', 'zilla')) ?></div>
				<div class="nav-previous"><?php previous_posts_link(__('Newer Entries <span>&rarr;</span>', 'zilla')) ?></div>
			<!--END .navigation .page-navigation -->
			</div>

<?php get_footer(); ?>