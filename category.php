<?php get_header(); ?>
	
<div class="row">
	
	<!-- Section -->
	<section class="span8">
	
		<div class="main">
	
			<div class="section"><h2><?php _e( 'Categories for', 'perfectcoding' ); the_category(); ?></h2></div>
	
			<?php get_template_part('loop'); ?>
		
			<!-- Pagination -->
			<nav id="pagination">
				<?php perfectcoding_pagination(); ?>
			</nav>
			<!-- /Pagination -->
			
		</div>
	
	</section>
	<!-- /Section -->
	
	<?php get_sidebar(); ?>
	
</div>

<?php get_footer(); ?>