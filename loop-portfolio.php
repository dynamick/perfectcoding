
<div class="row-fluid" >

	<?php if (have_posts()): ?>
		
	<div class="portfolio-container">	
			
		<ul class="thumbnails" >
			
			<?php while (have_posts()) : the_post(); ?>
		
			<li class="span6">
			
				<!-- Article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class('thumbnail ' . get_post_meta( get_the_ID(), 'ribbon_type', true ) ); ?> >

					<!-- Post Thumbnail -->
					<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="" style="">
							<?php echo the_post_thumbnail('portfolio'); // Declare pixel size you need inside the array ?>
						</a>					
					<?php endif; ?>
					<!-- /Post Thumbnail -->			
					
					<!-- Post Title -->
					<h3>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</h3>
					<!-- /Post Title -->
			
					<?php the_tags( '<span class="label label-warning">', '</span> <span class="label label-warning">', '</span>'); // Separated by commas with a line break at the end ?>
		
					<?php #edit_post_link('Edit','<span class="label">', '</span>'); ?>

				</article>
				<!-- /Article -->

			</li>
			
			<?php
				$count++;
				if ($count%2==0) {echo "</ul><ul class=\"thumbnails\">";}
			?>
		
			<?php endwhile; ?>

		</ul> <!-- end of ul.thumbnails -->
		
	</div>
		
	<?php else: ?>

	<!-- Article -->
	<article>
		<div class="inner">
			<h2><?php _e( 'Sorry, nothing to display.', 'perfectcoding' ); ?></h2>
		</div>
	</article>
	<!-- /Article -->
			

	<?php endif; ?>

</div> <!-- end of row-fluid -->