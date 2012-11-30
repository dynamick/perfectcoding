<?php get_header(); ?>

<div class="row">
	
	<!-- Section -->
	<section class="span8">
	
		<div class="main">
		
			<div class="section"><h1><?php _e( 'Archives', 'perfectcoding' ); ?> <small>
				<?php if ( is_day() ) : ?>
					<?php printf( __( 'Daily Archives: %s', 'perfectcoding' ), '<span>' . get_the_date() . '</span>' ); ?>
				<?php elseif ( is_month() ) : ?>
					<?php printf( __( 'Monthly Archives: %s', 'perfectcoding' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'perfectcoding' ) ) . '</span>' ); ?>
				<?php elseif ( is_year() ) : ?>
					<?php printf( __( 'Yearly Archives: %s', 'perfectcoding' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'perfectcoding' ) ) . '</span>' ); ?>
				<?php endif; ?>
			</small></h1></div>
	
			<?php get_template_part('loop'); ?>
		
			<!-- Pagination -->
			<div id="pagination">
				<?php html5wp_pagination(); ?>
			</div>
			<!-- /Pagination -->
		
		</div>
	
	</section>
	<!-- /Section -->
	
	<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>