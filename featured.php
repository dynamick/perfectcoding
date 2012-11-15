		<div id="featured">
			<div class="xrow">
				<ul class="thumbnails">
					<li class="span8">
						<!-- Post Thumbnail -->
						<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="thumbnail">
								<?php the_post_thumbnail(); // Fullsize image for the single post ?>
							</a>
						<?php else: ?>
							<a class="thumbnail"><img src="http://placehold.it/500x300" /></a>
						<?php endif; ?>
						<!-- /Post Thumbnail -->						
						
					</li>
				</ul>
			</div>
		</div>