	</div>
	<!-- /Wrapper -->

	<!-- Footer -->
	<footer>
		<div class="container">
			<div class="row">
				<div class="span3">
					<?php if( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'widget-area-3' ) ) ?>
				</div>
				<div class="span3">
					<?php if( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'widget-area-4' ) ) ?>
				</div>
				<div class="span3">
					<?php if( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'widget-area-5' ) ) ?>
				</div>
				<div class="span12">

					<!-- Copyright -->
					<p class="copyright">
						&copy; <?php echo date( "Y" ); ?> Copyright <?php bloginfo( 'name' ); ?>. <?php _e( 'Powered by', 'spritz' ); ?>
						<a href="http://wordpress.org" title="WordPress">WordPress</a> &amp; <a href="https://freshnews.it" title="Spritz, a HTML5, responsive, Bootstrapped Wordpress theme">Spritz</a>.
					</p>
					<!-- /Copyright -->

				</div>
			</div>
		</div>

	</footer>
	<!-- /Footer -->

	<?php wp_footer(); ?>
</body>
</html>