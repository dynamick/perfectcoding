<?php get_header(); ?>

<div class="row">

	<!-- Section -->
	<section class="span8">

		<div class="main">		

			<div class="section"><h2><?php echo sprintf( __( '%s Search Results for ', 'perfectcoding' ), $wp_query->found_posts ); echo get_search_query(); ?></h2></div>

			<?php get_template_part( 'loop' ); ?>

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