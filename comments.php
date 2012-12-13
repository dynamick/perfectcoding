<section id="comments">
	
	<?php if (post_password_required()) : ?>
	<p><?php _e( 'Post is password protected. Enter the password to view any comments.', 'perfectcoding' ); ?></p>
</section> <!-- END: comments if password protected -->
	<?php return; endif; ?>

<?php if (have_comments()) : ?>

	<?php # Enable the below link if you want the comment title ?>
	<?php # <h3 class="comments-title"><?php comments_number(); ></h3> ?>

	<ol class="commentlist">
		<?php wp_list_comments( 'type=comment&callback=perfectcodingcomments' ); // Custom callback in functions.php ?>
	</ol>

	<nav id="pagination">
		<?php paginate_comments_links(); ?> 
	</nav>	

<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

	<p><?php _e( 'Comments are closed here.', 'perfectcoding' ); ?></p>

<?php endif; ?>

<?php comment_form(); ?>

</section> <!-- END: comments if not password protected -->