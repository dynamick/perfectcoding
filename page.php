<?php get_header(); ?>

<div class="row">	

	<!-- Section -->
	<section  class="span8">
		
		<div class="main">
	
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
			<!-- Article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class('post_content'); ?>>
				
				<div class="inner">
		
					<h1><?php the_title(); ?></h1>

					<?php the_content(); ?>
					
					<?php get_template_part('newsletter'); ?>
			
					<?php edit_post_link(); ?>

					<?php comments_template( '', true ); // Remove if you don't want comments ?>
			
				</div>
			
			</article>
			<!-- /Article -->
		
		<?php endwhile; ?>
	
		<?php else: ?>
	
			<!-- Article -->
			<article>
			
				<div class="inner">
			
					<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
					
				</div>
			
			</article>
			<!-- /Article -->
	
		<?php endif; ?>
		
		</div>
	
	</section>
	<!-- /Section -->
	
<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>