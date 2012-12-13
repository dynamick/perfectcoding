<?php get_header(); ?>

<div class="row">	

	<!-- Section -->
	<section  class="span8">

		<div class="main">

			<!-- Article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class('post_content'); ?>>

				<!-- Post Title -->
				<div class="section">
					<h1><?php _e( 'Page not found', 'perfectcoding' ); ?></h1>
				</div>
				<!-- /Post Title -->

				<div class="inner">

					<h2><a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'perfectcoding' ); ?></a></h2>
					<p style="height:400px">Something goes wrong.</p>

				</div>

			</article>
			<!-- /Article -->

		</div>

	</section>
	<!-- /Section -->

<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>