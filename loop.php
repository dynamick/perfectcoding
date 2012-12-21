<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<!-- Article -->
	<?php $special_class = in_category( of_get_option( 'special_post_category', '' ) ) ? "spritz_special" : '' ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( $special_class ); ?> >

		<div class="inner">

			<div class="prefix"><?php spritz_posted_on(); ?> - <?php the_tags(''); ?></div>

			<!-- Post Title -->
			<h2>
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a>
			</h2>
			<!-- /Post Title -->

			<!-- Post Details -->
			<ul class="post_details">
				<li class="posted_by"><span class="postit"><?php spritz_posted_by(); ?></span></li>
			</ul>
			<!-- /Post Details -->

			<!-- Post Thumbnail -->
			<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
				
				<div class="catribbon"><?php
					$category = get_the_category(); 
					echo '<span>' . $category[0]->cat_name . '</span>';
				?></div>

				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" class="thumbnail post_thumbnail" >
					<?php echo the_post_thumbnail(); // Declare pixel size you need inside the array ?>
				</a>

			<?php endif; ?>
			<!-- /Post Thumbnail -->			
		
			<?php spritz_excerpt( 'spritz_index' ); // Build your custom callback length in functions.php ?>

			<?php #edit_post_link('Edit','<span class="label">', '</span>');  # uncomment at will?>

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