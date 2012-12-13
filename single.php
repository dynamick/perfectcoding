<?php get_header(); ?>

<div class="row">

	<!-- Section -->
	<section class="span8">

	<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

		<div class="main">

			<!-- Article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'post_content' ); ?>>

				<div class="inner">

					<?php echo bootstrapwp_breadcrumbs(); ?>

					<div class="prefix"><?php the_tags( '' );?></div>

					<!-- Post Title -->
					<h1>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</h1>
					<!-- /Post Title -->

					<!-- Post Details -->
					<ul class="post_details">
						<li class="posted_by"><?php perfectcoding_posted_by(); ?></li>
						<li class="date"><?php perfectcoding_posted_on(); ?></li>
						<li class="comments"><?php comments_popup_link( __( 'Leave your thoughts', 'perfectcoding' ), __( '1 Comment', 'perfectcoding' ), __( '% Comments', 'perfectcoding' )); ?></li>
					</ul>
					<!-- /Post Details -->

					<?php the_content(); // Dynamic Content ?>
					
					<?php get_template_part( 'newsletter' ); ?>
			
					<?php #the_tags( __( 'Tags: ', 'perfectcoding' ), ', ', '<br>'); // Separated by commas with a line break at the end ?>

					<?php # Author section, to be developed
					/*
						<p><?php #_e( 'This post was written by ', 'perfectcoding' ); the_author(); ?></p>
					*/
					?>

					<?php edit_post_link( 'Edit Post', '<p class="label label-warning">', '</p>' ); // Always handy to have Edit Post Links available ?>

					<?php comments_template(); ?>

				</div>
			</article>
			<!-- /Article -->

		</div> <!-- </div class="main"> -->

		<?php endwhile; ?>

		<?php else: ?>

			<div class="main">

				<!-- Article -->
				<article>

					<div class="offset1 inner">
						<h1><?php _e( 'Sorry, nothing to display.', 'perfectcoding' ); ?></h1>
					</div>

				</article>
				<!-- /Article -->

			</div> <!-- </div class="main"> -->

		<?php endif; ?>

	</section>
	<!-- /Section -->

	<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>