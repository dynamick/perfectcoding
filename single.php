<?php get_header(); ?>
	
<div class="row">
	
	<!-- Section -->
	<section class="span8">
		
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<?php #get_template_part('featured'); ?>

		<div class="main">

			<!-- Article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class('post_content'); ?>>
		
				<div class="inner">

					<?php echo bootstrapwp_breadcrumbs(); ?>


					<div class="prefix"><?php the_tags('');?></div>

					<!-- Post Title -->
					<h1>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</h1>
					<!-- /Post Title -->
			
					<!-- Post Details -->
					<ul class="post_details">
						<li class="posted_by"><?php twentyten_posted_by(); ?></li>
						<li class="date"><?php twentyten_posted_on(); ?></li>
						<li class="comments"><?php comments_popup_link( __( 'Leave your thoughts', 'html5blank' ), __( '1 Comment', 'html5blank' ), __( '% Comments', 'html5blank' )); ?></li>
					</ul>
					<!-- /Post Details -->
			
					<?php the_content(); // Dynamic Content ?>
			
					<?php get_template_part('newsletter'); ?>
			
					<?php #the_tags( __( 'Tags: ', 'html5blank' ), ', ', '<br>'); // Separated by commas with a line break at the end ?>
			
					<!--<p><?php #_e( 'Categorised in: ', 'html5blank' ); the_category(', '); // Separated by commas ?></p>-->
			
					<!--<p><?php #_e( 'This post was written by ', 'html5blank' ); the_author(); ?></p>-->
			
					<?php #edit_post_link(); // Always handy to have Edit Post Links available ?>
			
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
						<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>
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