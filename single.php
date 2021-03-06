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
						<li class="posted_by"><?php spritz_posted_by(); ?></li>
						<li class="date"><?php spritz_posted_on(); ?></li>
						<li class="comments"><?php comments_popup_link( __( 'Leave your thoughts', 'spritz' ), __( '1 Comment', 'spritz' ), __( '% Comments', 'spritz' )); ?></li>
					</ul>
					<!-- /Post Details -->

					<?php the_content(); // Dynamic Content ?>
					
					<?php get_template_part( 'newsletter' ); ?>

					<?php if ( of_get_option( 'author_box', true ) ) : ?>

						<?php if ( get_the_author_meta( 'description' ) ) : ?>

							<div class="author-box">

								<a class="pull-left author-avatar" rel="author" href="<?php echo get_the_author_meta( 'user_url' ) ? get_the_author_meta( 'user_url' ) : '#' ?>"><?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?></a>

								<?php $author = get_the_author_meta( 'first_name' ) . ' ' . get_the_author_meta( 'last_name' ); ?>
								<?php if ( $author ) :?>
									<h2><a href="#"><?php echo $author ?> <small><?php _e( 'the author', 'spritz' );?></small></a></h2>
								<?php endif; ?>

								<div class="author-desc"><?php the_author_meta( 'description' ); ?></div>

							</div>

						<?php endif; ?>

					<?php endif; ?>

					<?php # edit_post_link( 'Edit Post', '<p class="label label-warning">', '</p>' ); // Always handy to have Edit Post Links available ?>

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
						<h1><?php _e( 'Sorry, nothing to display.', 'spritz' ); ?></h1>
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