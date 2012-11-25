<?php get_header(); ?>

	<!-- Section -->
	<section>
	
	<?php if (have_posts()): the_post(); ?>
	
		<h1><?php _e( 'Author Archives for ', 'perfectcoding' ); echo get_the_author(); ?></h1>

	<?php if ( get_the_author_meta('description')) : ?>
	
	<?php echo get_avatar(get_the_author_meta('user_email')); ?>
	
		<h2><?php e_( 'About', 'perfectcoding' ); echo get_the_author() ; ?></h2>
	
	<?php the_author_meta('description'); ?>
	
	<?php endif; ?>
	
	<?php rewind_posts(); while (have_posts()) : the_post(); ?>
	
		<!-- Article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
			<!-- Post Thumbnail -->
			<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
				</a>
			<?php endif; ?>
			<!-- /Post Thumbnail -->
			
			<!-- Post Title -->
			<h2>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h2>
			<!-- /Post Title -->
			
			<!-- Post Details -->
			<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
			<span class="author"><?php _e( 'Published by', 'perfectcoding' ); ?> <?php the_author_posts_link(); ?></span>
			<span class="comments"><?php comments_popup_link( __( 'Leave your thoughts', 'perfectcoding' ), __( '1 Comment', 'perfectcoding' ), __( '% Comments', 'perfectcoding' )); ?></span>
			<!-- /Post Details -->
			
			<?php html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>
			
			<br class="clear">
			
			<?php edit_post_link(); ?>
			
		</article>
		<!-- /Article -->
		
	<?php endwhile; ?>
	
	<?php else: ?>
	
		<!-- Article -->
		<article>
			
			<h2><?php _e( 'Sorry, nothing to display.', 'perfectcoding' ); ?></h2>
			
		</article>
		<!-- /Article -->
	
	<?php endif; ?>
		
		<!-- Pagination -->
		<div id="pagination">
			<?php html5wp_pagination(); ?>
		</div>
		<!-- /Pagination -->
	
	</section>
	<!-- /Section -->
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>