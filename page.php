<?php get_header(); ?>

<div class="row">	

	<!-- Section -->
	<section  class="span8">

		<div class="main">

		<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

			<!-- Article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'post_content' ); ?>>

				<!-- Post Title -->
				<div class="section">
					<?php echo bootstrapwp_breadcrumbs(); ?>
					<h1><?php the_title(); ?></h1>
				</div>
				<!-- /Post Title -->

				<div class="inner">

					<!-- Post Details -->
					<ul class="post_details">
						<li class="date"><?php spritz_posted_on(); ?></li>
						<li class="comments"><?php comments_popup_link( __( 'Leave your thoughts', 'spritz' ), __( '1 Comment', 'spritz' ), __( '% Comments', 'spritz' )); ?></li>
					</ul>
					<!-- /Post Details -->

					<?php the_content(); ?>
					
					<?php get_template_part( 'newsletter' ); ?>
			
					<?php # edit_post_link( 'Edit Post', '<p class="label label-warning">', '</p>' ); // Always handy to have Edit Post Links available ?>

					<?php comments_template( '', true ); // Remove if you don't want comments ?>

				</div>

			</article>
			<!-- /Article -->

		<?php endwhile; ?>

		<?php else: ?>

			<!-- Article -->
			<article>

				<div class="inner">

					<h2><?php _e( 'Sorry, nothing to display.', 'spritz' ); ?></h2>
					<p><?php _e( 'You are looking for an empty page. We are sorry for the inconvenience.', 'spritz' ); ?></p>
					<p><a href="/"><?php _e( 'Return to home', 'spritz' ); ?></a></p>

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