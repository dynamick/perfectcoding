<?php get_header(); ?>
	
<div class="row">
	
	<!-- Section -->
	<section class="span8">
	
		<div class="main">
	
			<h1><?php _e( 'Categories for', 'html5blank' ); the_category(); ?></h1>
	
			<?php get_template_part('loop'); ?>
		
			<!-- Pagination -->
			<div id="pagination">
				<?php html5wp_pagination(); ?>
			</div>
			<!-- /Pagination -->
			
		</div>
	
	</section>
	<!-- /Section -->
	
	<?php get_sidebar(); ?>
	
</div>

<?php get_footer(); ?>