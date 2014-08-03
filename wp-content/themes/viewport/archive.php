<?php get_header(); ?>
<?php /* Get author data */
	if(get_query_var('author_name')) :
	$curauth = get_user_by('login', get_query_var('author_name'));
	endif;
?>

			<div class="clearfix">
				<!--BEGIN #primary .hfeed-->
				<div id="primary" class="hfeed">
				
				<?php if (have_posts()) : ?>			
		
		 	  	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
		 	  	<?php /* If this is a category archive */ if (is_category()) { ?>
					<h1 class="page-title"><?php printf(__('All posts in %s', 'zilla'), single_cat_title('',false)); ?></h1>
		 	  	<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
					<h1 class="page-title"><?php printf(__('All posts tagged %s', 'zilla'), single_tag_title('',false)); ?></h1>
		 	  	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
					<h1 class="page-title"><?php _e('Archive for', 'zilla') ?> <?php the_time('F jS, Y'); ?></h1>
		 	 	 <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
					<h1 class="page-title"><?php _e('Archive for', 'zilla') ?> <?php the_time('F, Y'); ?></h1>
		 		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
					<h1 class="page-title"><?php _e('Archive for', 'zilla') ?> <?php the_time('Y'); ?></h1>
			  	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
					<h1 class="page-title"><?php _e('All posts by', 'zilla') ?> <?php echo $curauth->display_name; ?></h1>
		 	  	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
					<h1 class="page-title"><?php _e('Blog Archives', 'zilla') ?></h1>
		 	  	<?php } ?>
		
				<?php while (have_posts()) : the_post(); ?>
				    
				    <?php zilla_post_before(); ?>
					<!--BEGIN .hentry -->
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php zilla_post_start(); ?>
					
    					<?php /* if the post has a WP 2.9+ Thumbnail */
    					if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
    					<div class="post-thumb">
    						<?php 
    						$post_format = get_post_format();
    						if( $post_format == 'gallery' || $post_format == 'video' || $post_format == 'audio' ){ ?>
    						<div class="format-icon <?php echo $post_format; ?>"></div>
    						<?php } ?>
    						<a title="<?php printf(__('Permanent Link to %s', 'zilla'), get_the_title()); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('index-thumb-cropped'); /* post thumbnail settings configured in functions.php */ ?></a>
    					</div>
    					<?php } ?>
					    
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'zilla'), get_the_title()); ?>"><?php the_title(); ?></a></h2>
						<!--BEGIN .entry-meta .entry-header-->
						<div class="entry-meta entry-header">
						
							<span class="published"><?php the_time( 'd M Y' ); ?></span>
							<span class="meta-sep">/</span>
							<span class="comment-count"><?php comments_popup_link(__('No Comments', 'zilla'), __('1 Comment', 'zilla'), __('% Comments', 'zilla')); ?></span>
							<?php edit_post_link( __('edit', 'zilla'), '<span class="meta-sep">/</span> <span class="edit-post">', '</span>' ); ?>
							
						<!--END .entry-meta entry-header -->
						</div>
		
						<!--BEGIN .entry-summary -->
						<div class="entry-summary">
							<?php the_excerpt(); ?>
						<!--END .entry-summary -->
						</div>
	                    
	                <?php zilla_post_end(); ?>
	            	<!--END .hentry -->
					</div>
					<?php zilla_post_after(); ?>
		
				<?php endwhile; ?>
				
				<?php else :
		
	    			if ( is_category() ) { // If this is a category archive
	    				printf(__('<h2>Sorry, but there aren\'t any posts in the %s category yet.</h2>', 'zilla'), single_cat_title('',false));
	    			} else if ( is_date() ) { // If this is a date archive
	    				echo(__('<h2>Sorry, but there aren\'t any posts with this date.</h2>', 'zilla'));
	    			} else if ( is_author() ) { // If this is a category archive
	    				$userdata = get_userdatabylogin(get_query_var('author_name'));
	    				printf(__('<h2>Sorry, but there aren\'t any posts by %s yet.</h2>', 'zilla'), $userdata->display_name);
	    			} else {
	    				echo(__('<h2>No posts found.</h2>', 'zilla'));
	    			}
		
				endif; ?>
				
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