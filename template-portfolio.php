<?php /* Template Name: Portfolio */ ?>

<?php get_header(); ?>

<div class="row">

	<!-- Section -->
	<section class="span8">

		<div class="main">

			<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

			<div class="section"><h2><?php the_title(); ?> <small><?php echo strip_tags( get_the_content() ); ?></small></h2></div>

			<?php endwhile; endif; ?>

			<?php 
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged') : 1;
				query_posts ( array(
					'post_type'      => array('portfolio'), 
					'posts_per_page' => 8,
					'paged'          => $paged
				));
				get_template_part( 'loop-portfolio' ); 
			?>

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
