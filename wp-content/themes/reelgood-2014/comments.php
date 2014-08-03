<?php if ( have_comments() ) : ?>
	<h2 id="comments">
		<?php comments_number('No comments', '1 Comment', '% comments' );?> to &#8220;<?php the_title(); ?>&#8221;
	</h2>

	<ol class="commentlist">
		<?php wp_list_comments('type=comment'); ?>
	</ol>

	<div id="comment-nav">
		<ul class="hl">
			<li><?php previous_comments_link() ?></li>
			<li class="fr"><?php next_comments_link() ?></li>
		</ul>
	</div>

<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>

		<!-- If comments are open, but there are no comments. -->

	<?php else : // comments are closed ?>

		<!-- If comments are closed. -->

	<?php endif; ?>

<?php endif; ?>

<?php if ( comments_open() ) : ?>

	<div id="respond" class="respond-form">

		<h3><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s'); ?></h3>

		<div id="cancel-comment-reply">
			<p class="small"><?php cancel_comment_reply_link(); ?></p>
		</div>

		<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
			<div class="alert alert-help">
				<p><?php printf( __('You must be %1$slogged in%2$s to post a comment.'), '<a href="<?php echo wp_login_url( get_permalink() ); ?>">', '</a>' ); ?></p>
			</div>
		<?php else : ?>

		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

		<?php if ( is_user_logged_in() ) : ?>

		<p class="comments-logged-in-as"><?php _e("Logged in as"); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e("Log out of this account"); ?>"><?php _e("Log out"); ?> <?php _e("&raquo;"); ?></a></p>

		<?php else : ?>

		<ul id="comment-form-elements" class="clearfix">

			<li>
				<label for="author"><?php _e("Name"); ?> <?php if ($req) _e("(required)"); ?></label>
				<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" placeholder="<?php _e('Your Name*'); ?>" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
			</li>

			<li>
				<label for="email"><?php _e("Mail"); ?> <?php if ($req) _e("(required)"); ?></label>
				<input type="email" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" placeholder="<?php _e('Your E-Mail*'); ?>" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
				<small><?php _e("(will not be published)"); ?></small>
			</li>

			<li>
				<label for="url"><?php _e("Website"); ?></label>
				<input type="url" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" placeholder="<?php _e('Got a website?'); ?>" tabindex="3" />
			</li>

		</ul>

		<?php endif; ?>

		<p><textarea name="comment" id="comment" placeholder="<?php _e('Your Comment here...'); ?>" tabindex="4"></textarea></p>

		<p>
			<input name="submit" type="submit" id="submit" class="button" tabindex="5" value="<?php _e('Submit'); ?>" />
			<?php comment_id_fields(); ?>
		</p>

		<?php do_action('comment_form', $post->ID); ?>

		</form>

		<?php endif; // If registration required and not logged in ?>
	</div>

<?php endif; ?>
