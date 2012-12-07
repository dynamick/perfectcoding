<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);

	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __('One', 'options_check'),
		'two' => __('Two', 'options_check'),
		'three' => __('Three', 'options_check'),
		'four' => __('Four', 'options_check'),
		'five' => __('Five', 'options_check')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'options_check'),
		'two' => __('Pancake', 'options_check'),
		'three' => __('Omelette', 'options_check'),
		'four' => __('Crepe', 'options_check'),
		'five' => __('Waffle', 'options_check')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		//$options_categories[$category->cat_ID] = $category->cat_name;
		$options_categories[$category->slug] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => __('Social Settings', 'options_check'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Facebook Fan Page', 'options_check'),
		'desc' => __('The URL of your Facebook fan page', 'options_check'),
		'id' => 'facebook_url',
		'std' => 'http://www.facebook.com/dynamick.it',
		'type' => 'text');

	$options[] = array(
		'name' => __('Twitter Page', 'options_check'),
		'desc' => __('The url of your Twitter page.', 'options_check'),
		'id' => 'twitter_url',
		'std' => 'https://twitter.com/dynamick',
		'type' => 'text');

		$options[] = array(
			'name' => __('Feed URL', 'options_check'),
			'desc' => __('Leave blank for the default wordpress url', 'options_check'),
			'id' => 'feed_url',
			'std' => '/feed',
			'type' => 'text');

	$options[] = array(
		'name' => __('Mailchimp signup form link url', 'options_check'),
		'desc' => __('The url of your mailchimp signup form. You could specify any other newsletter signup url.', 'options_check'),
		'id' => 'mailchimp_link_url',
		'std' => 'http://eepurl.com/sgukr',
		'type' => 'text');

	$options[] = array(
		'name' => __('Mailchimp signup form action url', 'options_check'),
		'desc' => __('The url of the form action of your mailchimp list', 'options_check'),
		'id' => 'mailchimp_action_url',
		'std' => 'http://dynamick.us1.list-manage.com/subscribe/post?u=2e0cbefc07136553c3667da17&amp;id=c1b9885bf4',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('External API', 'options_check'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Google Analytics Account ID', 'options_check'),
		'desc' => __('Paste here your UA-XXXXXXXX-X code', 'options_check'),
		'id' => 'analytics_uid',
		'std' => 'UA-795127-3',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Facebook App ID', 'options_check'),
		'desc' => __('Paste here your Facebook app id', 'options_check'),
		'id' => 'facebook_app_id',
		'std' => '235354229916474',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Layout', 'options_check'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Home Slides?', 'options_check'),
		'desc' => __('Do u want slides in homepage?', 'options_check'),
		'id' => 'home_slides',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Select a slides category', 'options_check'),
		'desc' => __('Choose the category to show in the home slides show', 'options_check'),
		'id' => 'home_slides_category',
		'type' => 'select',
		'options' => $options_categories);
		
	$options[] = array(
		'name' => __('Select a special post category', 'options_check'),
		'desc' => __('Choose the category for special post', 'options_check'),
		'id' => 'special_post_category',
		'type' => 'select',
		'options' => $options_categories);
		
	$options[] = array(
		'name' => __('Favicon', 'options_check'),
		'desc' => __('Upload a 16x16 favicon image (.ico, .png or .gif).', 'options_check'),
		'id' => 'favicon_img',
		'type' => 'upload');		
		
		/*
	$options[] = array(
		'name' => __('Other', 'options_check'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Input Select Small', 'options_check'),
		'desc' => __('Small Select Box.', 'options_check'),
		'id' => 'example_select',
		'std' => 'three',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $test_array);

	$options[] = array(
		'name' => __('Input Select Wide', 'options_check'),
		'desc' => __('A wider select box.', 'options_check'),
		'id' => 'example_select_wide',
		'std' => 'two',
		'type' => 'select',
		'options' => $test_array);

	$options[] = array(
		'name' => __('Select a Category', 'options_check'),
		'desc' => __('Passed an array of categories with cat_ID and cat_name', 'options_check'),
		'id' => 'example_select_categories',
		'type' => 'select',
		'options' => $options_categories);
		
	$options[] = array(
		'name' => __('Select a Tag', 'options_check'),
		'desc' => __('Passed an array of tags with term_id and term_name', 'options_check'),
		'id' => 'example_select_tags',
		'type' => 'select',
		'options' => $options_tags);

	$options[] = array(
		'name' => __('Select a Page', 'options_check'),
		'desc' => __('Passed an pages with ID and post_title', 'options_check'),
		'id' => 'example_select_pages',
		'type' => 'select',
		'options' => $options_pages);

	$options[] = array(
		'name' => __('Input Radio (one)', 'options_check'),
		'desc' => __('Radio select with default options "one".', 'options_check'),
		'id' => 'example_radio',
		'std' => 'one',
		'type' => 'radio',
		'options' => $test_array);

	$options[] = array(
		'name' => __('Example Info', 'options_check'),
		'desc' => __('This is just some example information you can put in the panel.', 'options_check'),
		'type' => 'info');

	$options[] = array(
		'name' => __('Input Checkbox', 'options_check'),
		'desc' => __('Example checkbox, defaults to true.', 'options_check'),
		'id' => 'example_checkbox',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Advanced Settings', 'options_check'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Check to Show a Hidden Text Input', 'options_check'),
		'desc' => __('Click here and see what happens.', 'options_check'),
		'id' => 'example_showhidden',
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('Hidden Text Input', 'options_check'),
		'desc' => __('This option is hidden unless activated by a checkbox click.', 'options_check'),
		'id' => 'example_text_hidden',
		'std' => 'Hello',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('Uploader Test', 'options_check'),
		'desc' => __('This creates a full size uploader that previews the image.', 'options_check'),
		'id' => 'example_uploader',
		'type' => 'upload');

	$options[] = array(
		'name' => "Example Image Selector",
		'desc' => "Images for layout.",
		'id' => "example_images",
		'std' => "2c-l-fixed",
		'type' => "images",
		'options' => array(
			'1col-fixed' => $imagepath . '1col.png',
			'2c-l-fixed' => $imagepath . '2cl.png',
			'2c-r-fixed' => $imagepath . '2cr.png')
	);

	$options[] = array(
		'name' =>  __('Example Background', 'options_check'),
		'desc' => __('Change the background CSS.', 'options_check'),
		'id' => 'example_background',
		'std' => $background_defaults,
		'type' => 'background' );

	$options[] = array(
		'name' => __('Multicheck', 'options_check'),
		'desc' => __('Multicheck description.', 'options_check'),
		'id' => 'example_multicheck',
		'std' => $multicheck_defaults, // These items get checked by default
		'type' => 'multicheck',
		'options' => $multicheck_array);

	$options[] = array(
		'name' => __('Colorpicker', 'options_check'),
		'desc' => __('No color selected by default.', 'options_check'),
		'id' => 'example_colorpicker',
		'std' => '',
		'type' => 'color' );
		
	$options[] = array( 'name' => __('Typography', 'options_check'),
		'desc' => __('Example typography.', 'options_check'),
		'id' => "example_typography",
		'std' => $typography_defaults,
		'type' => 'typography' );
		
	$options[] = array(
		'name' => __('Custom Typography', 'options_check'),
		'desc' => __('Custom typography options.', 'options_check'),
		'id' => "custom_typography",
		'std' => $typography_defaults,
		'type' => 'typography',
		'options' => $typography_options );

	$options[] = array(
		'name' => __('Text Editor', 'options_check'),
		'type' => 'heading' );

	/**
	 * For $settings options see:
	 * http://codex.wordpress.org/Function_Reference/wp_editor
	 *
	 * 'media_buttons' are not supported as there is no post to attach items to
	 * 'textarea_name' is set by the 'id' you choose
	 */
	 /*
	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);
	
	$options[] = array(
		'name' => __('Default Text Editor', 'options_check'),
		'desc' => sprintf( __( 'You can also pass settings to the editor.  Read more about wp_editor in <a href="%1$s" target="_blank">the WordPress codex</a>', 'options_check' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
		'id' => 'example_editor',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
	*/
	return $options;
}