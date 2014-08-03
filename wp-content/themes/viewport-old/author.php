<?php
/**
 * The template for displaying Author Archive pages.
 *
 */?>
<?php get_header(); ?>
			<div class="clearfix">
				<!--BEGIN #primary .hfeed-->
				<div id="primary" class="hfeed full-width">
               
                    <?php $author = get_user_by( 'slug', get_query_var( 'author_name' ) );
					$ACF = $author->ID;?>
					
                    <?php $attachment_id = get_field('display_picture', 'user_'.$ACF);
					echo wp_get_attachment_image( $attachment_id, 'directory-userimg'); ?>
                    
					<?php echo $authorname = the_author_meta('first_name', $ACF); ?> <?php echo $authorname = the_author_meta('last_name', $ACF); ?>, <?php the_field('user_role', 'user_'.$ACF); ?> at <?php the_field('production_company_name', 'user_'.$ACF); ?><br />
                    Bio: <?php the_field('user_bio', 'user_'.$ACF); ?>
                    
									
						

				<!--END #primary .hfeed-->
				</div>
			</div>

<?php get_footer(); ?>


