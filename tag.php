<?php get_header(); ?>
	
<div class="row">
	
	<!-- Section -->
	<section class="span8">
	
		<div class="main">
	
			<h2 class="section"><?php /*_e( 'Tag Archive: ', 'perfectcoding' );*/ echo single_tag_title('', false); ?></h2>
	
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