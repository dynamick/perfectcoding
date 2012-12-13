<?php get_header(); ?>
	
<div class="row">
	
	<!-- Section -->
	<section class="span8">

		<div class="main">

			<div class="section">
				<?php if (have_posts()): the_post(); ?>

					<?php if ( get_the_author_meta( 'description' ) ) : ?>

						<a class="pull-left thumbnails"><?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?></a>

						<h2><?php echo get_the_author() ; ?> <small><?php _e( 'About me', 'perfectcoding' );?></small></h2>

						<div class="author-desc"><?php the_author_meta( 'description' ); ?></div>

					<?php endif; ?>

				<?php endif; ?>

				<?php rewind_posts(); ?>				
								
			</div>

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