<?php get_header(); ?>
			
			<div class="clearfix">
				<!--BEGIN #primary .hfeed-->
				<div id="primary" class="hfeed">
				<?php if (have_posts()) : ?>
	
				<h1 class="page-title"><?php _e('Search Results for', 'zilla') ?> &#8220;<?php the_search_query(); ?>&#8221;</h1>
	
				<?php while (have_posts()) : the_post(); ?>
	            
	            <?php zilla_post_before(); ?>
				<!--BEGIN .hentry -->
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php zilla_post_start(); ?>
				    
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
	
				<?php else : ?>
					
					<h1 class="page-title"><?php _e('Your search did not match any entries', 'zilla') ?></h1>
					
					<!--BEGIN #post-0-->
					<div id="post-0" class="post">
						
						<!--BEGIN .entry-content-->
						<div class="entry-content">
							<?php get_search_form(); ?>
							<p><?php _e('Suggestions:','zilla') ?></p>
							<ul>
								<li><?php _e('Make sure all words are spelled correctly.', 'zilla') ?></li>
								<li><?php _e('Try different keywords.', 'zilla') ?></li>
								<li><?php _e('Try more general keywords.', 'zilla') ?></li>
							</ul>
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