
<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<!-- Article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>
									
		<div class="inner">
									
			<div class="prefix"><?php twentyten_posted_on(); ?> - <?php the_tags('');?></div>
			
			<!-- Post Title -->
			<h2>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h2>
			<!-- /Post Title -->
			
			
			<!-- Post Details -->
			<ul class="post_details">
				<li class="posted_by"><span class="postit"><?php twentyten_posted_by(); ?></span></li>
			</ul>
			<!-- /Post Details -->

			<div class="catribbon" style=""><?php
				$category = get_the_category(); 
				//echo '<img src="' . get_template_directory_uri() . '/img/icons/' . $category[0]->cat_ID . '.jpg" alt="" />' ;
				echo '<span>'.$category[0]->cat_name.'</span>';
			?></div>

			<!-- Post Thumbnail -->
			<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="thumbnail post_thumbnail" style="margin:0 -60px; position:relative">
					<?php echo the_post_thumbnail(); // Declare pixel size you need inside the array ?>
				</a>					
			<?php endif; ?>
			<!-- /Post Thumbnail -->			
		
			<?php html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>
		
			<!--br class="clear"-->
		
			<?php #edit_post_link('Edit','<span class="label">', '</span>'); ?>
			
		</div>
		
	</article>
	<!-- /Article -->

<?php endwhile; ?>

<?php else: ?>

	<!-- Article -->
	<article>
		<div class="inner">
			<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
		</div>
	</article>
	<!-- /Article -->

<?php endif; ?>
