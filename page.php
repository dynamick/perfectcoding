<?php get_header(); ?>

<div class="row">	

	<!-- Section -->
	<section  class="span8">
		
		<div class="main">
	
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
			<!-- Article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class('post_content'); ?>>
				
				<div class="inner">
		
					<?php echo bootstrapwp_breadcrumbs(); ?>
					
					<div class="prefix"><?php the_tags('');?></div>

					<!-- Post Title -->
					<h1>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</h1>
					<!-- /Post Title -->
			
					<!-- Post Details -->
					<ul class="post_details">
						<li class="posted_by"><?php twentyten_posted_by(); ?></li>
						<li class="date"><?php twentyten_posted_on(); ?></li>
						<li class="comments"><?php comments_popup_link( __( 'Leave your thoughts', 'perfectcoding' ), __( '1 Comment', 'perfectcoding' ), __( '% Comments', 'perfectcoding' )); ?></li>
					</ul>
					<!-- /Post Details -->

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