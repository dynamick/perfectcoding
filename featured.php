<?php if (of_get_option('home_slides', true) and !isset($_GET['paged'])) { ?>
<div id="featured-wrapper">
	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">
			<?php 
				$the_query = new WP_Query(array(
					'category_name' => of_get_option('home_slides_category', '') , 
					'posts_per_page' => 5, 
					'offset' => 0 
					)); 
	   			 while ( $the_query->have_posts() ) : $the_query->the_post();
				 	if ( has_post_thumbnail() ) { // the current post has a thumbnail
			?>
			<div class="item <?php if($count=="1"){ echo 'active' ; } ?>">
				<a href="<?php the_permalink();?>"><?php the_post_thumbnail('slides');?></a>
				<div class="carousel-caption">
					<h4><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
				</div>
			</div>
			<?php 
					}
					$count++;
				endwhile; 
				wp_reset_postdata();
			?>
		</div><!-- carousel-inner -->
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
	</div><!-- #myCarousel -->
</div>
<?php } ?>
