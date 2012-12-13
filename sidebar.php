<!-- Sidebar -->
<aside id="sidebar" class="span4">
	<?php # get_template_part('searchform'); # uncomment at will?>

	<div class="sidebar">
		<div class="sidebar-widget first">
			<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'widget-area-1' ) ) ?>
		</div>

		<div class="sidebar-widget second">
			<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'widget-area-2' ) ) ?>
		</div>
	</div>
</aside>
<!-- /Sidebar -->