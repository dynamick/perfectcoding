<?php /* Template Name: Contacts */ ?>

<?php get_header(); ?>

<div class="row">	

	<!-- Section -->
	<section  class="span8">
		
		<div class="main">
	
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
			<!-- Article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class('post_content'); ?>>
				
				<!-- Post Title -->
				<div class="section">
					<?php echo bootstrapwp_breadcrumbs(); ?>
					<h1><?php the_title(); ?></h1>
				</div>
				<!-- /Post Title -->				
				
				<div class="inner">
							
					<?php the_content(); ?>
			
					<?php edit_post_link(); ?>

				</div>
			
			</article>
			<!-- /Article -->
		
		<?php endwhile; ?>
	
		<?php else: ?>
	
			<!-- Article -->
			<article>
			
				<div class="inner">
			
					<h2><?php _e( 'Sorry, nothing to display.', 'perfectcoding' ); ?></h2>
					
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