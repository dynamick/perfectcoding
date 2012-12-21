<?php get_header(); ?>

<div class="row">

	<!-- Section -->
	<section class="span8">

		<?php get_template_part( 'featured' ); ?>

		<div class="main">

			<?php get_template_part( 'loop' ); ?>

			<!-- Pagination -->
			<nav id="pagination">
				<?php spritz_pagination(); ?>
			</nav>
			<!-- /Pagination -->

		</div>

	</section>
	<!-- /Section -->

	<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>