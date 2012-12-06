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
	
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />		
	
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Comments Feed" href="<?php bloginfo('comments_rss2_url'); ?>" />	
	
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon-iphone.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon-ipad.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon-iphone4.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon-ipad3.png" />
		
	<!-- CSS + jQuery + JavaScript -->
	<?php wp_head(); ?>
	
</head>
<body <?php body_class(); ?>>

	<!-- Header -->
	<header class="head">
	
		<!-- Wrapper -->
		<div class="wrapper container">
			

						
			
			<div class="row">
		
				<div class="span8 ">
					
					<div class="inner">

						<!-- Logo -->
						<div id="logo">
							<?php if (true or get_custom_header()->url != '') { ?>
							<h1><a href="<?php echo home_url(); ?>">
								<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="Dynamick, web design, web development and seo" />
							</a></h1>
							 <?php } ?>
						</div>
						 <!--/Logo -->	

						<!-- Nav -->
						<nav>
							<div class="ribbon">
								<?php #perfectcoding_nav(); ?>
								
								
								
								
								
								<div class=" navbar">
									<div class="navbar-inner">
										<div class="container">
											<!--
								            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
								              <span class="icon-bar"></span>
								              <span class="icon-bar"></span>
								              <span class="icon-bar"></span>
								            </a>						
											<div class="nav-collapse collapse" >				
											-->
											<?php
				
												$args = array(
													'theme_location' => 'top-bar',
													'depth'		 => 2,
													'container'	 => false,
													'menu_class'	 => 'nav',
													'walker'	 => new Bootstrap_Walker_Nav_Menu()
												);

												wp_nav_menu($args);
			
											?>
											<!--</div>-->
										</div>
									</div>
								</div>
								






								
								
								
							</div> <!-- /.ribbon -->
						</nav>	<!-- /Nav -->

					</div>

				</div>
				
				<div class="span4">
							
								
 					<ul class="channels">
 						<li class="rss"><a title="Iscriviti al nostro feed" href="<?php echo of_get_option('feed_url', '/feed'); ?>">RSS</a></li>
 						<li class="facebook"><a title="Seguici attraverso Facebook" href="<?php echo of_get_option('facebook_url', '#'); ?>">Facebook</a></li>
 						<li class="twitter"><a title="Seguici con Twitter" href="<?php echo of_get_option('twitter_url', '#'); ?>">Twitter</a></li>
 						<li class="newsletter"><a title="Sottoscrivi la nostra newsletter" href="<?php echo of_get_option('mailchimp_link_url', '#'); ?>">Newsletter</a></li>
 					</ul>							
								
					
					
				</div>
			
				
			</div> <!-- /row -->
			
		</div>
		<!-- /Wrapper -->
	
	</header>
	<!-- /Header -->
	
	<!-- Wrapper -->
	<div class="wrapper container">
		
		
			