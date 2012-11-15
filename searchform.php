<!-- Searchform -->
<form method="get" class="search form-search" action="<?php echo home_url(); ?>" >
	<div class="input-append">
	<input id="s" type="text" name="s" onfocus="if(this.value==''){this.value=''};" 
	onblur="if(this.value==''){this.value=''};" value="" class="input span2 search-query">
	<!--<input class="searchsubmit" type="submit" value="<?php _e( 'Search', 'html5blank' ); ?>">-->
	<button type="submit" class="btn btn-warning"><?php _e( 'Search', 'html5blank' ); ?></button>
	</div>
</form>
<!-- /Searchform -->