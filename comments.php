<section id="comments">
	<?php if (post_password_required()) : ?>
	<p><?php _e( 'Post is password protected. Enter the password to view any comments.', 'html5blank' ); ?></p>
</section> <!-- END: comments if password protected -->

	<?php return; endif; ?>

<?php if (have_comments()) : ?>

	<!--h3 class="comments-title"><?php comments_number(); ?></h3-->

	<ol class="commentlist">
		<?php wp_list_comments('type=comment&callback=html5blankcomments'); // Custom callback in functions.php ?>
	</ol>
	
    <nav id="pagination">
     <?php paginate_comments_links(); ?> 
    </nav>	
	
	

<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
	
	<p><?php _e( 'Comments are closed here.', 'html5blank' ); ?></p>
	
<?php endif; ?>

<?php comment_form(); ?>

</section> <!-- END: comments if not password protected -->

<!--
<?php if (comments_open()) : ?>
<section id="respond">
<h3><?php comment_form_title(__('Leave a Reply', 'html5blank'), __('Leave a Reply to %s', 'html5blank')); ?></h3>
<p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>
<?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'html5blank'), wp_login_url(get_permalink())); ?></p>
<?php else : ?>
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="form-horizontal">
<?php if (is_user_logged_in()) : ?>
<p><?php printf(__('Logged in as <a href="%s/wp-admin/profile.php">%s</a>.', 'roots'), get_option('siteurl'), $user_identity); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php __('Log out of this account', 'html5blank'); ?>"><?php _e('Log out &raquo;', 'html5blank'); ?></a></p>
<?php else : ?>
<div class="control-group"><label for="author" class="control-label"><?php _e('Name', 'html5blank'); if ($req) _e(' (required)', 'html5blank'); ?></label>
<div class="controls"><input type="text" class="text span4" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?>></div></div>
<div class="control-group"><label for="email" class="control-label"><?php _e('Email (will not be published)', 'html5blank'); if ($req) _e(' (required)', 'html5blank'); ?></label>
<div class="controls"><input type="email" class="text span4" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?>></div></div>
<div class="control-group"><label for="url" class="control-label"><?php _e('Website', 'html5blank'); ?></label>
<div class="controls"><input type="url" class="text span4" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" tabindex="3"></div></div>
<?php endif; ?>
<div class="control-group"><label for="comment" class="control-label"><?php _e('Comment', 'html5blank'); ?></label>
<div class="controls"><textarea name="comment" id="comment" class="span4" tabindex="4"></textarea></div></div>
<div class="controls"><input name="submit" class="btn btn-primary btn-large" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'html5blank'); ?>"></div>
<?php comment_id_fields(); ?>
<?php do_action('comment_form', $post->ID); ?>
</form>
<?php endif; // if registration required and not logged in ?>
  </section>
<?php endif; ?>
-->