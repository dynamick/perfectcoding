<?php
/*
 *  Author: Michele Gobbi | @dynamick.it
 *  URL: dynamick.it | @dynamick
 *  Custom functions, support, custom post types and more.
 */

/*
 * ========================================================================
 * External Modules/Files
 * ========================================================================
 */

require_once dirname( __FILE__ ) . '/framework/boxed_text_widget.php';
require_once dirname( __FILE__ ) . '/framework/class-tgm-plugin-activation.php';
require_once dirname( __FILE__ ) . '/framework/bootstrap_walker_menu.php';
require_once dirname( __FILE__ ) . '/framework/bootstrap_breadcrumbs.php';

/*
 * ========================================================================
 * Theme Support
 * ========================================================================
 */

if ( ! isset( $content_width ) ) 
	$content_width = 900;

if ( function_exists( 'add_theme_support' ) ) {

	// Add Menu Support
	add_theme_support( 'menus' );

	// Add Thumbnail Theme Support
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'large', 700, '', true ); // Large Thumbnail
	add_image_size( 'medium', 250, '', true ); // Medium Thumbnail
	add_image_size( 'small', 120, '', true ); // Small Thumbnail
	add_image_size( 'portfolio', 584, 584, true ); // Small Thumbnail
	add_image_size( 'slides', 650, 290, true ); // Custom Thumbnail Size call using the_post_thumbnail('slides');

	// Add Support for Custom Backgrounds - Uncomment below if you're going to use
	add_theme_support( 'custom-background', array(
		'default-color' => 'FFF',
		'default-image' => get_template_directory_uri() . '/img/body.gif'
    ));

	// Add Support for Custom Header - Uncomment below if you're going to use
	add_theme_support( 'custom-header', array(
		'default-image'         => get_template_directory_uri() . '/img/spritz-header.png',
		'header-text'           => false,
		'default-text-color'    => '000',
		'width'                 => 158,
		'height'                => 110,
		'random-default'        => false
	));

	// Enables post and comment RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Localisation Support
	load_theme_textdomain( 'spritz', get_template_directory() . '/languages' );
}

/*
 * ========================================================================
 * Functions
 * ========================================================================
 */

// Load Custom Theme Scripts using Enqueue

function spritz_scripts() {
	if ( ! is_admin() ) {
		wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array('jquery'), '2.6.2' ); // Modernizr with version Number at the end
		wp_enqueue_script( 'modernizr' ); // Enqueue it!

		wp_register_script( 'selectnav', get_template_directory_uri() . '/js/selectnav.min.js', array('jquery'), '1.0.0' ); // SelectNav script with version number
		wp_enqueue_script( 'selectnav'); // Enqueue it!

		wp_register_script( 'spritzscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0' ); // Spritz script with version number
		wp_enqueue_script( 'spritzscripts' ); // Enqueue it!

		wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '1.0.0' ); // Bootstrap script with version number
		wp_enqueue_script( 'bootstrap' ); // Enqueue it!
    }
}

// Loading Conditional Scripts
// use it for conditional javascript inclusions

function conditional_scripts() {
	if ( is_page( 'pagenamehere' ) ) {
		wp_register_script( 'scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0' ); // Our Script for Conditional loading
		wp_enqueue_script( 'scriptname' ); // Enqueue it!
	}
}

// Load Optimised Google Analytics in the footer

function add_google_analytics() {
	$google  = "<!-- Optimised Asynchronous Google Analytics -->";
	$google .= "<script>"; // Change the UA-XXXXXXXX-X to your Account ID
	$google .= "var _gaq=[['_setAccount','" . of_get_option('analytics_uid', 'UA-795127-3') . "'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));";
	$google .= "</script>";
	echo $google;
}

// Facebook script

function add_facebook_script() {
	$appId = of_get_option( 'facebook_app_id', '235354229916474' );

	$fbscript  = "<div id=\"fb-root\"></div>";
	$fbscript .= "<script>(function(d, s, id) {";
	$fbscript .= "  var js, fjs = d.getElementsByTagName(s)[0];";
	$fbscript .= "  if (d.getElementById(id)) return;";
	$fbscript .= "  js = d.createElement(s); js.id = id;";
	$fbscript .= "  js.src = \"//connect.facebook.net/it_IT/all.js#xfbml=1&appId={$appId}\";";
	$fbscript .= "  fjs.parentNode.insertBefore(js, fjs);";
	$fbscript .= "}(document, 'script', 'facebook-jssdk'));</script>";
	
    echo $fbscript;
}

// Threaded Comments

function enable_threaded_comments() {
	if ( ! is_admin() ) {
		if ( is_singular() AND comments_open() AND ( get_option( 'thread_comments' ) == 1 ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}

// Custom Comments Callback

function spritzcomments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	extract( $args, EXTR_SKIP );

	if ( 'div' == $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
		<article id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<header>
		<div class="comment-author vcard">
			<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, '180' ); ?>
			<?php printf(__( '<cite class="fn">%s</cite> <span class="says">says:</span>', 'spritz' ), get_comment_author_link()) ?>
		</div>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'spritz' ) ?></em>
			<br />
		<?php endif; ?>
		<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
			<?php printf( __( '%1$s at %2$s', 'spritz' ), get_comment_date(),  get_comment_time() ) ?></a><?php edit_comment_link( __( '(Edit)', 'spritz' ),'  ','' ); ?>
		</div>
	</header>
	<div class="comment-text">
		<?php comment_text() ?>
	</div>

	<div class="reply">
		<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
		</article>
	<?php endif; ?>
<?php 
}

// Theme Stylesheets using Enqueue

function spritz_styles() {
	
	wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'bootstrap' ); // Enqueue it!

	wp_register_style( 'spritz', get_template_directory_uri() . '/style.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'spritz' ); // Enqueue it!

	wp_register_style( 'lora_font', 'http://fonts.googleapis.com/css?family=Lora:400,700', array(), '1.0', 'all' );
	wp_enqueue_style( 'lora_font' ); // Enqueue it!

	wp_register_style( 'open_sans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300', array(), '1.0', 'all' );
	wp_enqueue_style( 'open_sans' ); // Enqueue it!
}

// Register Spritz's Navigation menu, other than header menu defined above

function register_spritz_menu() {	
	register_nav_menus( array( // Using array to specify more menus if needed
		'top-bar'       => __( 'Header Menu', 'spritz' ), // custom menu 1
		'custom-menu1'  => __( 'Custom Menu 1', 'spritz' ), // custom menu 1
		'custom-menu2'  => __( 'Custom Menu 2', 'spritz' ), // custom menu 2
		'custom-menu3'  => __( 'Custom Menu 3', 'spritz' )  // custom menu 3
	));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup

function my_wp_nav_menu_args( $args = '' ) {
	$args['container'] = false;
	return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items

function my_css_attributes_filter( $var ) {
	return is_array( $var ) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist

function remove_category_rel_from_category_list( $thelist ) {
	return str_replace( 'rel="category tag"', 'rel="tag"', $thelist );
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme

function add_slug_to_body_class( $classes ) {
	global $post;
	if ( is_home() ) {
		$key = array_search( 'blog', $classes );
		if ( $key > -1 ) 
			unset( $classes[$key] );
	} elseif ( is_page() ) {
		$classes[] = sanitize_html_class( $post->post_name );
	} elseif ( is_singular() ) {
		$classes[] = sanitize_html_class( $post->post_name );
	}

	return $classes;
}

// If Dynamic Sidebar Exists

if ( function_exists( 'register_sidebar' ) ) {

	// Define Sidebar Widget Area 1 - sidebar top
	
	register_sidebar( array(
		'name'          => __( 'Top Sidebar', 'spritz' ),
		'description'   => __( 'Top part of the sidebar', 'spritz' ),
		'id'            => 'widget-area-1',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3  class="">',
		'after_title'   => '</h3>'
	));

	// Define Sidebar Widget Area 2 - sidebar middle

	register_sidebar( array(
		'name'          => __( 'Bottom Sidebar', 'spritz' ),
		'description'   => __( 'Bottom part of the sidebar', 'spritz' ),
		'id'            => 'widget-area-2',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	));

	// Define Sidebar Widget Area 3 - footer 1° col

	register_sidebar( array(
		'name'          => __( 'Footer left', 'spritz' ),
		'description'   => __( 'Footer left area', 'spritz' ),
		'id'            => 'widget-area-3',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	));

	// Define Sidebar Widget Area 4 - footer 2° col

	register_sidebar( array(
		'name'          => __( 'Footer Middle', 'spritz' ),
		'description'   => __( 'Footer middle area', 'spritz' ),
		'id'            => 'widget-area-4',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	));

	// Define Sidebar Widget Area 5 - footer 3° col

	register_sidebar( array(
		'name'          => __( 'Footer Right', 'spritz' ),
		'description'   => __( 'Footer right area', 'spritz' ),
		'id'            => 'widget-area-5',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	));
}

// Remove wp_head() injected Recent Comment styles

function my_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array(
		$wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
		'recent_comments_style'
	));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin

function spritz_pagination() {
	global $wp_query;
	$big = 999999999;
	echo paginate_links( array(
		'base'    => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
		'format'  => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total'   => $wp_query->max_num_pages
	));
}

// Custom Excerpts
// Create 20 Word Callback for Index page Excerpts, call using spritz_excerpt('spritz_index');

function spritz_index( $length ) { 
	return 30;
}

// Create 40 Word Callback for Custom Post Excerpts, call using spritz_excerpt('spritz_custom_post');
function spritz_custom_post( $length ) {
	return 40;
}

// Create the Custom Excerpts callback

function spritz_excerpt( $length_callback = '', $more_callback = '' ) {
	global $post;
	if ( function_exists( $length_callback ) ) {
		add_filter( 'excerpt_length', $length_callback );
	}
	if ( function_exists( $more_callback ) ) {
		add_filter( 'excerpt_more', $more_callback );
	}
	$output = get_the_excerpt();
	$output = apply_filters( 'wptexturize', $output );
	$output = apply_filters( 'convert_chars', $output );
	$output = '<p class="excerpt">' . $output . '</p>';
	echo $output;
}

// Custom View Article link to Post

function spritz_view_article( $more ) {
	global $post;
	return '... <a class="view-article" href="' . get_permalink( $post->ID ) . '">' . __( 'View Article', 'spritz' ) . '</a>';
}

// Remove 'text/css' from our enqueued stylesheet

function html5_style_remove( $tag ) {
	return preg_replace( '~\s+type=["\'][^"\']++["\']~', '', $tag );
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail

function remove_thumbnail_dimensions( $html ) {
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	return $html;
}

// Custom Gravatar in Settings > Discussion

function spritzgravatar ( $avatar_defaults ) {
	$myavatar                   = get_template_directory_uri() . '/img/default-avatar.png';
	$avatar_defaults[$myavatar] = "Custom Gravatar";
	return $avatar_defaults;
}

/**
 * Prints HTML with meta information for the current post—date/time.
 *
 * @since Spritz  1.0
 */

if ( ! function_exists( 'spritz_posted_on' ) ) :
	function spritz_posted_on() {
		printf( __( 'Posted on %2$s', 'spritz' ),
			'meta-prep meta-prep-author',
			sprintf( '<a href="%1$s" rel="bookmark"><time datetime="%2$s">%3$s</time></a>',
				get_permalink(),
				get_the_date('c'),
				get_the_date())
		);
	}
endif;

/**
 * Prints HTML with meta information for the current author.
 *
 * @since Spritz 1.0
 */

if ( ! function_exists( 'spritz_posted_by' ) ) :
	function spritz_posted_by() {
		printf( __( 'Published by', 'spritz' ).' %1$s',
			sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
				get_author_posts_url( get_the_author_meta( 'ID' ) ),
				sprintf( esc_attr__( 'Published by', 'spritz' ).' %1$s', get_the_author() ),
				get_the_author() )
		);
	}
endif;

/**
 * Customise the Spritz comments fields with HTML5 form elements
 *
 *	Adds support for 	placeholder
 *						required
 *						type="email"
 *						type="url"
 *
 * @since Spritz 1.0
 */

function spritz_comments() {

	$req = get_option( 'require_name_email' );
	$commenter = wp_get_current_commenter();
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$fields =  array(
		'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'spritz' ) . ( $req ? '<span class="required">*</span>' : '' ) .'</label> ' . 
 		            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder = "' . __( 'How could we call you?', 'spritz' ). '"' . ( $req ? ' required' : '' ) . '/></p>',
 		'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'spritz' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' . 
 		            '<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="' . __( 'How could we contact you?', 'spritz' ). '"' . ( $req ? ' required' : '' ) . ' /></p>',		            
 		'url'    => '' /*'<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label>' .
 		            '<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="Have you got a website?" /></p>'*/
 	);

 	return $fields;
 }

function spritz_commentfield() {	

	$commentArea = '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'spritz' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required placeholder="' . __( 'What do you want ask me?', 'spritz' ). '"	></textarea></p>';

	return $commentArea;

}

 add_filter( 'comment_form_default_fields', 'spritz_comments' );
 add_filter( 'comment_form_field_comment', 'spritz_commentfield' );

/*
 * ========================================================================
 * Actions + Filters + ShortCodes
 * ========================================================================
 */

// Add Actions

add_action( 'init', 				'spritz_scripts' ); // Add Custom Scripts
add_action( 'wp_footer', 			'add_google_analytics' ); // Google Analytics optimised in footer
add_action( 'get_header', 			'enable_threaded_comments' ); // Enable Threaded Comments
add_action( 'wp_enqueue_scripts',	'spritz_styles' ); // Add Theme Stylesheet
add_action( 'init', 				'register_spritz_menu' ); // Add Spritz Menu
add_action( 'init', 				'create_post_type_portfolio' ); // Add our Portfolio Post Type
add_action( 'widgets_init', 		'my_remove_recent_comments_style' ); // Remove inline Recent Comment Styles from wp_head()
add_action( 'init', 				'spritz_pagination' ); // Add our HTML5 Pagination
# add_action( 'wp_print_scripts', 	'conditional_scripts' ); // Add Conditional Page Scripts
# add_action( 'wp_footer', 			'add_facebook_script' ); // Facebook SDK

// Remove Actions
// uncomment at will

# remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
# remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
# remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
# remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
# remove_action( 'wp_head', 'index_rel_link' ); // Index link
# remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // Prev link
# remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // Start link
# remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
# remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
# remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
# remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
# remove_action( 'wp_head', 'rel_canonical' );
# remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

// Add Filters

add_filter( 'avatar_defaults', 		'spritzgravatar' ); // Custom Gravatar in Settings > Discussion
add_filter( 'body_class', 			'add_slug_to_body_class' ); // Add slug to body class (Starkers build)
add_filter( 'widget_text', 			'do_shortcode' ); // Allow shortcodes in Dynamic Sidebar
add_filter( 'widget_text', 			'shortcode_unautop' ); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter( 'wp_nav_menu_args', 	'my_wp_nav_menu_args' ); // Remove surrounding <div> from WP Navigation
add_filter( 'the_category', 		'remove_category_rel_from_category_list' ); // Remove invalid rel attribute
add_filter( 'the_excerpt', 			'shortcode_unautop' ); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter( 'the_excerpt', 			'do_shortcode' ); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter( 'excerpt_more', 		'spritz_view_article' ); // Add 'View Article' button instead of [...] for Excerpts
add_filter( 'post_thumbnail_html', 	'remove_thumbnail_dimensions', 10 ); // Remove width and height dynamic attributes to thumbnails
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 ); // Remove width and height dynamic attributes to post images
# add_filter( 'style_loader_tag', 	'html5_style_remove' ); // Remove 'text/css' from enqueued stylesheet
# add_filter( 'nav_menu_css_class', 'my_css_attributes_filter', 100, 1 ); // Remove Navigation <li> injected classes (Commented out by default)
# add_filter( 'nav_menu_item_id', 	'my_css_attributes_filter', 100, 1 ); // Remove Navigation <li> injected ID (Commented out by default)
# add_filter( 'page_css_class', 	'my_css_attributes_filter', 100, 1 ); // Remove Navigation <li> Page ID's (Commented out by default)

// Remove Filters

remove_filter( 'the_excerpt', 'wpautop' ); // Remove <p> tags from Excerpt altogether

// Shortcodes

add_shortcode( 'row', 'spritz_shortcode_row' );
add_shortcode( 'col', 'spritz_shortcode_col' );

// Shortcodes above would be nested like this -
// [spritz_shortcode_demo] [spritz_shortcode_demo_2] Here's the page title! [/spritz_shortcode_demo_2] [/spritz_shortcode_demo]

/*
 * ========================================================================
 * Custom Post Types
 * ========================================================================
 */

// Create Portfolio Post type

function create_post_type_portfolio() {
	register_taxonomy_for_object_type( 'category', 'portfolio' ); // Register Taxonomies for Category
	register_taxonomy_for_object_type( 'post_tag', 'portfolio' );
	register_post_type( 'portfolio', // Register Custom Post Type
		array(
			'labels' 			=> array(
			'name' 				=> __( 'Portfolio', 'spritz' ), // Rename these to suit
			'singular_name' 	=> __( 'Portfolio post', 'spritz' ),
			'add_new' 			=> __( 'Add New', 'spritz' ),
			'add_new_item' 		=> __( 'Add New Portfolio Post', 'spritz' ),
			'edit' 				=> __( 'Edit', 'spritz' ),
			'edit_item' 		=> __( 'Edit Portfolio Post', 'spritz' ),
			'new_item' 			=> __( 'New Portfolio Post', 'spritz' ),
			'view' 				=> __( 'View Portfolio Post', 'spritz' ),
			'view_item' 		=> __( 'View Portfolio Post', 'spritz' ),
			'search_items' 		=> __( 'Search Portfolio Post', 'spritz' ),
			'not_found' 		=> __( 'No portfolio post found', 'spritz' ),
			'not_found_in_trash'=> __( 'No Portfolio Posts found in Trash', 'spritz' )
		),
		'public' 		=> true,
		'hierarchical' 	=> true, // Allows your posts to behave like Hierarchy Pages
		'has_archive' 	=> true,
		'supports' 		=> array(
			'title',
			'editor',
			'excerpt',
			'thumbnail'
		), // Go to Dashboard Custom Spritz post for supports
		'can_export' => true, // Allows export in Tools > Export
		'taxonomies' => array(
			'post_tag',
			'category'
		) // Add Category and Post Tags support
	));
}

 /*
 * ========================================================================
 *  Shortcodes
 * ========================================================================
 */

// Shortcode Row with Nested Capability

function spritz_shortcode_row( $atts, $content = null ) {
	return '<div class="row-fluid">' . do_shortcode( $content ) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Col 

function spritz_shortcode_col( $atts, $content = null) {
	extract( shortcode_atts( array( 'span' => 12 ), $atts) );	 
	return '<div class="span' . $span . '">' . do_shortcode( $content ) . '</div>';
}

/*
* ========================================================================
*  Social Badges
* ========================================================================
*/

function spritz_twitter_badge() {
	$twitter_url 	= of_get_option( 'twitter_url', "https://twitter.com/dynamick" );
	$twitter_label 	= __( 'follow @dynamick', 'spritz' );
	$twitter_lang 	= "en";
	$ret 			= <<<EOF
<a href="{$twitter_url}" class="twitter-follow-button" data-show-count="true" data-lang="{$twitter_lang}" data-size="large">{$twitter_label}</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
EOF;
	return $ret;	
}

function spritz_mailchimp_form() {
	$placeholder 		= __( 'Add your email', 'spritz' );
	$subscribe_label 	= __( 'Subscribe', 'spritz' );
	$action 			= of_get_option( 'mailchimp_link_url', '#' ); 
	$ret 				= <<<EOF
	<!-- Begin MailChimp Signup Form -->
	<form action="{$action}" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
		<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="{$placeholder}" required>
		<input type="submit" value="{$subscribe_label}" name="subscribe" id="mc-embedded-subscribe" class="btn btn-info">
	</form>
	<!--End mc_embed_signup-->	
EOF;
	return $ret;	
}

function curPageURL() {
	$pageURL = 'http';
	if ( $_SERVER["HTTPS"] == "on" ) 
		$pageURL .= "s";
	$pageURL .= "://";
	if ( $_SERVER["SERVER_PORT"] != "80" )
		$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
	else
		$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	return $pageURL;
}

/*
* ========================================================================
* Include the TGM_Plugin_Activation class.
* ========================================================================
*/

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 */

function my_theme_register_required_plugins() {

	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme
		/*
		array(
			'name'     				=> 'TGM Example Plugin', // The plugin name
			'slug'     				=> 'tgm-example-plugin', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/lib/plugins/tgm-example-plugin.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),*/

		array(
			'name' 				=> 'Option Framework',
			'slug' 				=> 'options-framework',
			'force_activation' 	=> true,
			'required' 			=> true
		)
	);

	$theme_text_domain = 'spritz';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'           => $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path'     => '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' => 'themes.php', 				// Default parent menu slug
		'parent_url_slug'  => 'themes.php', 				// Default parent URL slug
		'menu'             => 'install-required-plugins', 	// Menu slug
		'has_notices'      => true,                       	// Show admin notices or not
		'is_automatic'     => false,					   	// Automatically activate plugins after installation or not
		'message'          => '',							// Message to output right before the plugins table
		'strings'          => array(
			'page_title'                      => __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                      => __( 'Install Plugins', $theme_text_domain ),
			'installing'                      => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                            => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                          => __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                => __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete'                        => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}

/*
* ========================================================================
* Helper function to return the theme option value. If no value has been saved, it returns $default.
* Needed because options are saved as serialized strings.
* ========================================================================
*/

if ( !function_exists( 'of_get_option' ) ) {
	function of_get_option( $name, $default = false ) {
	
		$optionsframework_settings = get_option( 'optionsframework' );
	
		// Gets the unique option id
		$option_name = $optionsframework_settings['id'];
	
		if ( get_option( $option_name ) ) 
			$options = get_option( $option_name );
		
		if ( isset( $options[$name] ) ) 
			return $options[$name];
		else
			return $default;
	}
}


/*
* ========================================================================
* Define the Ribbon Type box 
* ========================================================================
*/

add_action( 'add_meta_boxes', 'spritz_add_ribbon_box' );
add_action( 'save_post', 'spritz_ribbon_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */

function spritz_add_ribbon_box() {
	add_meta_box( 
		'myplugin_sectionid',
		__( 'Ribbon Type', 'spritz' ),
		'spritz_ribbon_box',
		'portfolio'
	);
}

/* Prints the box content */

function spritz_ribbon_box( $post ) {

	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename' );

	// get existing value
	$meta_value = get_post_meta( $post->ID, 'ribbon_type', true );

	// The actual fields for data entry
	echo '<label for="myplugin_new_field">';
	_e( "Ribbon type", 'spritz' );
	echo '</label> ';
	echo '<select id="ribbon_type_field" name="ribbon_type_field" >';
	echo '<option value="" >';
	_e( "[none]", 'spritz' );
	echo '</option><option value="red" '. ( $meta_value == 'red' ? 'selected="selected"' : '' ) .'>';
	_e( "Red", 'spritz' );
	echo '</option><option value="blue" '. ( $meta_value == 'blue' ? 'selected="selected"' : '' ) .'>';
	_e( "Blue", 'spritz' );
	echo '</option><option value="yellow" '. ( $meta_value == 'yellow' ? 'selected="selected"' : '' ) .'>';
	_e( "Yellow", 'spritz' );
	echo '</option><option value="green" '. ( $meta_value == 'green' ? 'selected="selected"' : '' ) .'>';
	_e( "Green", 'spritz' );
	echo '</option><option value="violet" '. ( $meta_value == 'violet' ? 'selected="selected"' : '' ) .'>';
	_e( "Violet", 'spritz' );
	echo '</option></select>';
}

/* When the post is saved, saves our custom data */

function spritz_ribbon_save_postdata( $post_id ) {

	// verify if this is an auto save routine. 
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( ! array_key_exists( 'myplugin_noncename', $_POST ) || ! wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename( __FILE__ ) ) )
		return;

	// Check permissions
  	if ( 'portfolio' == $_POST['post_type'] )  {
		if ( !current_user_can( 'edit_post', $post_id ) )
			return;
	}

	// OK, we're authenticated: we need to find and save the data
	// if saving in a custom table, get post_ID
	// $post_ID = $_POST['post_ID'];
	$meta_key 		= 'ribbon_type';
	$new_meta_value = $_POST['ribbon_type_field'];

	update_post_meta( $post_id, $meta_key, $meta_value, $prev_value );

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( ! update_post_meta( $post_id, $meta_key, $new_meta_value ) ) 
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );
	/* If there is no new meta value but an old value exists, delete it. */
	if ( '' == $new_meta_value && $meta_value ) 
		delete_post_meta( $post_id, $meta_key, $meta_value );
}  

?>