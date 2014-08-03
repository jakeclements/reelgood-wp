<?php 
$footer_feature_posts = zilla_get_option('footer_feature_posts');
if( is_numeric($footer_feature_posts) && $footer_feature_posts > 0 ) {
    
	$args = array(
        'post_type' => 'post',
        'posts_per_page' => $footer_feature_posts,
        'ignore_sticky_posts' => true,
        'meta_query' => array(
            array(
                'key' => '_zilla_feature_footer',
                'value' => 'on'
            )
        )
    );
    
    $the_query = new WP_Query( $args );
	
	if( have_posts() ) : ?>
	
		<div id="footer-feature-wrapper" class="clearfix">
		
			<ul>
	
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			
				<li>
					<?php /* if the post has a WP 2.9+ Thumbnail */
					if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
						<div class="post-thumb">
							<?php
							$post_format = get_post_format();
							if( $post_format == 'gallery' || $post_format == 'video' || $post_format == 'audio' ){ ?>
							<div class="format-icon <?php echo $post_format; ?>"></div>
							<?php } ?>
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('footer-thumb'); ?></a>
						</div>
					<?php } ?>
					
					<h5 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf(__('Permanent Link to %s', 'zilla'), get_the_title()); ?>"><?php the_title(); ?></a></h5>
				</li>
				
			<?php endwhile; ?>
	
			</ul>
			
			<div id="footer-feature-nav"></div>
			
		</div>
	<?php 
	endif;
	wp_reset_postdata();
} 
?>