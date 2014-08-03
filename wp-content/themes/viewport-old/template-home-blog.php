<?php
/*
Template Name: Home Page Blog Style
*/
?>

<?php get_header(); ?>

			<div class="clearfix">
				<!--BEGIN #primary .hfeed-->
				<div id="primary" class="hfeed">

				<?php 
                if ( get_query_var('paged') ) {
        			$paged = get_query_var('paged');
        		} elseif ( get_query_var('page') ) {
        			$paged = get_query_var('page');
        		} else {
        			$paged = 1;
        		}

        		$temp = $wp_query;
                $wp_query= null;

                $wp_query = new WP_Query( array(
                    'post_type' => 'post',
                    'paged' => $paged
                ) );						
                while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

					<?php zilla_post_before(); ?>
					<!--BEGIN .hentry -->
					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">				
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

						<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'zilla'), get_the_title()); ?>"> <?php the_title(); ?></a></h2>

						<!--BEGIN .entry-meta .entry-header-->
						<div class="entry-meta entry-header">
						
							<span class="published"><?php the_time( 'd M Y' ); ?></span>
							<span class="meta-sep">/</span>
							<span class="comment-count"><?php comments_popup_link(__('No Comments', 'zilla'), __('1 Comment', 'zilla'), __('% Comments', 'zilla')); ?></span>
							<?php edit_post_link( __('edit', 'zilla'), '<span class="meta-sep">/</span> <span class="edit-post">', '</span>' ); ?>
							
						<!--END .entry-meta entry-header -->
						</div>

						<!--BEGIN .entry-content -->
						<div class="entry-content">
							<?php the_excerpt(); ?>
						<!--END .entry-content -->
						</div>

	                <?php zilla_post_end(); ?>
					<!--END .hentry-->  
					</div>
					<?php zilla_post_after(); ?>

					<?php endwhile; ?>

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
<?php $wp_query = null; $wp_query = $temp;?>
<?php get_footer(); ?>