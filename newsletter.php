<?php if ( ( is_page() and of_get_option( 'page_newsletter_form', true ) ) or ( is_single() and of_get_option( 'post_newsletter_form', true ) ) ) { ?>

<div id="newsletter">
	<div class="white-border">
		<div class="newsletter-wrap">
			<h4><?php echo __( 'Newsletter', 'spritz' ); ?></h4>
			<p><?php echo __( 'Stay up to date with my web activities', 'spritz' ); ?></p>
			<p><?php echo spritz_twitter_badge(); ?></p>
			<?php echo spritz_mailchimp_form(); ?>
		</div>
	</div>
</div>
<?php } ?>