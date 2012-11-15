<!DOCTYPE html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]--> 
<head>
	<meta charset="UTF-8">
	<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
	
	<!-- Meta -->
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0;">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	
	<meta name="description" content="<?php bloginfo('description'); ?>">
	
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		
	<!-- CSS + jQuery + JavaScript -->
	<?php wp_head(); ?>
	
</head>
<body <?php body_class(); ?>>

	<!-- Header -->
	<header>
	
		<!-- Wrapper -->
		<div class="wrapper container">
			
			<div class="row">
		
				<div class="span8 ">
					
					<div class="inner">

						<!-- Logo -->
						<div id="logo">
							<?php if (get_custom_header()->url != '') { ?>
							<h1><a href="<?php echo home_url(); ?>">
								<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="Logo" />
							</a></h1>
							 <?php } ?>
						</div>
						 <!--/Logo -->	
					 
										 

						<!-- Nav -->
						<nav>
							<div class="ribbon">
								<?php html5blank_nav(); ?>
							</div>
						</nav>
						<!-- /Nav -->

					</div>

				</div>
				
				<div class="span4">
							
					<ul class="channels">
						<li class="rss"><a title="Iscriviti al nostro feed" href="http://www.dynamick.it/feed">RSS</a></li>
						<li class="facebook"><a title="Seguici attraverso Facebook" href="http://www.facebook.com/dynamick.it">Facebook</a></li>
						<li class="twitter"><a title="Seguici con Twitter" href="http://twitter.com/dynamick">Twitter</a></li>
						<li class="newsletter"><a title="Sottoscrivi la nostra newsletter" href="#">Newsletter</a></li>
					</ul>							
					
					
				</div>
			
				
			</div> <!-- /row -->
			
		</div>
		<!-- /Wrapper -->
	
	</header>
	<!-- /Header -->
	
	<!-- Wrapper -->
	<div class="wrapper container">