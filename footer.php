	</div>
	<!-- /Wrapper -->

	<!-- Footer -->
	<footer>
		<div class="container">
			<div class="row">
				<div class="span3"><h4>Dynamick</h4>
					<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-3')) ?>
				</div>
				<div class="span3"><h4>Lavori &amp; Progetti</h4>
					<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-4')) ?>
				</div>
				<div class="span3"><h4>Info</h4>
					<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-5')) ?>
				</div>
				<!--<div class="span3"></div>-->
				<div class="span12">
		
					<!-- Copyright -->
					<p class="copyright">
						&copy; <?php echo date("Y"); ?> Copyright <?php bloginfo('name'); ?>. <?php _e('Powered by', 'html5blank'); ?> 
						<a href="//wordpress.org" title="WordPress">WordPress</a> &amp; <a href="https://github.com/dynamick/perfectcoding" title="PerfectCoding, a free HTML5 Wordpress theme">PerfectCoding</a>.
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