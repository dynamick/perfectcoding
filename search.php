<?php get_header(); ?>

<div class="row">
		
	<!-- Section -->
	<section class="span8">
		
		<div class="main">		
	
			<h2 class="section"><?php echo sprintf( __( '%s Search Results for ', 'html5blank' ), $wp_query->found_posts ); echo get_search_query(); ?></h2>
		
			<?php get_template_part('loop'); ?>
		
			<!-- Pagination -->
			<nav id="pagination">
				<?php html5wp_pagination(); ?>
			</nav>
			<!-- /Pagination -->
			
		</div>
	
	</section>
	<!-- /Section -->
	
	<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>