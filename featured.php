<?php if (of_get_option('home_slides', true)) { ?>
<div id="featured-wrapper">
	<?php if (function_exists('simple_nivo_slider')) simple_nivo_slider('featured', of_get_option('home_slides_category', '')); ?>
</div>
<?php } ?>
