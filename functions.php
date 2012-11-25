<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: perfectcoding.com | @perfectcoding
 *  Custom functions, support, custom post types and more.
 */

/*
 * ========================================================================
 * External Modules/Files
 * ========================================================================
 */

	// Load any external files you have here

/*
 * ========================================================================
 * Theme Support
 * ========================================================================
 */

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/body.gif'
    ));

    // Add Support for Custom Header - Uncomment below if you're going to use
   	add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.png',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 158,
	'height'			=> 110,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('perfectcoding', get_template_directory() . '/languages');
}

/*
 * ========================================================================
 * Functions
 * ========================================================================
 */

// Perfect Coding navigation
function perfectcoding_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '', 
		'container'       => 'div', 
		'container_class' => 'menu-{menu slug}-container', 
		'container_id'    => '',
		'menu_class'      => 'menu', 
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul id="main">%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}


#add_filter('wp_nav_menu_items', 'add_logo_to_nav', 10, 2);
function add_logo_to_nav($items, $args)
{
	if ($args->theme_location == 'header-menu') {
		$url =get_template_directory_uri();
		$logo = <<<EOF
			<li id="logo-small" >
				<a href="/" ><img src="{$url}/img/logo-dynamick.png" alt="Dynamick, Web design, develop and SEO"></a>
			</li>
EOF;
		$items = "{$logo}".$items;
	}
    return $items;
}

#add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class($classes, $item){
     $classes[] = "span1";
     return $classes;
}


// Load Custom Theme Scripts using Enqueue
function perfectcoding_scripts()
{
    if (!is_admin()) {
        wp_deregister_script('jquery'); // Deregister WordPress jQuery
        wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js', array(), '1.8.2'); // Load Google CDN jQuery
        wp_enqueue_script('jquery'); // Enqueue it!

        wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr.js', array('jquery'), '2.6.2'); // Modernizr with version Number at the end
        wp_enqueue_script('modernizr'); // Enqueue it!

        wp_register_script('perfectcodingscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Perfect Coding script with version number
        wp_enqueue_script('perfectcodingscripts'); // Enqueue it!

        wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '1.0.0'); // Perfect Coding script with version number
        wp_enqueue_script('bootstrap'); // Enqueue it!

    }
}

// Loading Conditional Scripts
function conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Our Script for Conditional loading
        wp_enqueue_script('scriptname'); // Enqueue it!
    }
}

// Load Optimised Google Analytics in the footer
function add_google_analytics()
{
    $google = "<!-- Optimised Asynchronous Google Analytics -->";
    $google .= "<script>"; // Change the UA-XXXXXXXX-X to your Account ID
    $google .= "var _gaq=[['_setAccount','UA-XXXXXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));";
    $google .= "</script>";
    echo $google;
}

// jQuery Fallbacks load in the footer
function add_jquery_fallback()
{
    $jqueryfallback = "<!-- Protocol Relative jQuery fall back if Google CDN offline -->";
    $jqueryfallback .= "<script>";
    $jqueryfallback .= "window.jQuery || document.write('<script src=\"" . get_template_directory_uri() . "/js/jquery-1.8.2.min.js\"><\/script>')";
    $jqueryfallback .= "</script>";
    echo $jqueryfallback;
}

// Facebook script
function add_facebook_script()
{
	$appId = "235354229916474";
	
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
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function perfectcodingcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
	
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<article id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<header>
		<div class="comment-author vcard">
			<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
			<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
		</div>
<?php if ($comment->comment_approved == '0') : ?>
		<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
		<br />
<?php endif; ?>
		<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
			<?php printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' ); ?>
		</div>
	</header>
	<div class="comment-text">
	<?php comment_text() ?>
	</div>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</article>
	<?php endif; ?>
<?php }

// Theme Stylesheets using Enqueue
function perfectcoding_styles()
{
	    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '1.0', 'all');
	    wp_enqueue_style('bootstrap'); // Enqueue it!

	    wp_register_style('perfectcoding', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
	    wp_enqueue_style('perfectcoding'); // Enqueue it!
		
	    wp_register_style('lora_font', 'http://fonts.googleapis.com/css?family=Lora:400,700', array(), '1.0', 'all');
	    wp_enqueue_style('lora_font'); // Enqueue it!
		
	    wp_register_style('open_sans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300', array(), '1.0', 'all');
	    wp_enqueue_style('open_sans'); // Enqueue it!
}

// Register Perfect Coding's Navigation
function register_perfectcoding_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'perfectcoding'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'perfectcoding'), // Sidebar Navigation
        'footer-col1' => __('Footer col1 Menu', 'perfectcoding'), // Footer Col1 Menu
        'footer-col2' => __('Footer col2 Menu', 'perfectcoding'), // Footer Col2 Menu
        'footer-col3' => __('Footer col3 Menu', 'perfectcoding') // Footer Col3 Menu
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1 - sidebar top
    register_sidebar(array(
        'name' => __('Widget Area 1', 'perfectcoding'),
        'description' => __('Description for Widget Area 1...', 'perfectcoding'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3  class="">',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2 - sidebar middle
    register_sidebar(array(
        'name' => __('Widget Area 2', 'perfectcoding'),
        'description' => __('Description for this Widget Area 2...', 'perfectcoding'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 3 - footer 1° col
    register_sidebar(array(
        'name' => __('Widget Area 3', 'perfectcoding'),
        'description' => __('Description for this Widget Area 3...', 'perfectcoding'),
        'id' => 'widget-area-3',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 4 - footer 2° col
    register_sidebar(array(
        'name' => __('Widget Area 4', 'perfectcoding'),
        'description' => __('Description for this Widget Area 4...', 'perfectcoding'),
        'id' => 'widget-area-4',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 5 - footer 3° col
    register_sidebar(array(
        'name' => __('Widget Area 5', 'perfectcoding'),
        'description' => __('Description for this Widget Area 5...', 'perfectcoding'),
        'id' => 'widget-area-5',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 30;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p class="excerpt">' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5wp_view_article($more)
{
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'perfectcoding') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return ( current_user_can( 'administrator' ) ) ? $content : false;
    #return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

// Custom Gravatar in Settings > Discussion
function perfectcodinggravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

/*
 * ========================================================================
 * Actions + Filters + ShortCodes
 * ========================================================================
 */

// Add Actions
add_action('init', 'perfectcoding_scripts'); // Add Custom Scripts
add_action('wp_print_scripts', 'conditional_scripts'); // Add Conditional Page Scripts
add_action('wp_footer', 'add_google_analytics'); // Google Analytics optimised in footer
add_action('wp_footer', 'add_jquery_fallback'); // jQuery fallbacks loaded through footer
//add_action('wp_footer', 'add_facebook_script'); // Facebook SDK
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'perfectcoding_styles'); // Add Theme Stylesheet
add_action('init', 'register_perfectcoding_menu'); // Add Perfect Coding Menu
add_action('init', 'create_post_type_html5'); // Add our Perfect Coding Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'perfectcodinggravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5wp_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*
 * ========================================================================
 * Custom Post Types
 * ========================================================================
 */

// Create 1 Custom Post type for a Demo, called HTML5-Blank
function create_post_type_html5()
{
    register_taxonomy_for_object_type('category', 'html5-blank'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'html5-blank');
    register_post_type('html5-blank', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Perfect Coding Custom Post', 'perfectcoding'), // Rename these to suit
            'singular_name' => __('Perfect Coding Custom Post', 'perfectcoding'),
            'add_new' => __('Add New', 'perfectcoding'),
            'add_new_item' => __('Add New Perfect Coding Custom Post', 'perfectcoding'),
            'edit' => __('Edit', 'perfectcoding'),
            'edit_item' => __('Edit Perfect Coding Custom Post', 'perfectcoding'),
            'new_item' => __('New Perfect Coding Custom Post', 'perfectcoding'),
            'view' => __('View Perfect Coding Custom Post', 'perfectcoding'),
            'view_item' => __('View Perfect Coding Custom Post', 'perfectcoding'),
            'search_items' => __('Search Perfect Coding Custom Post', 'perfectcoding'),
            'not_found' => __('No Perfect Coding Custom Posts found', 'perfectcoding'),
            'not_found_in_trash' => __('No Perfect Coding Custom Posts found in Trash', 'perfectcoding')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom Perfect Coding post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}

/*
| -------------------------------------------------------------------
| Adding Breadcrumbs
| -------------------------------------------------------------------
|
| */
 function bootstrapwp_breadcrumbs() {

  $delimiter = '<span class="divider">/</span>';
  $home = 'Home'; // text for the 'Home' link
  $before = '<li class="active">'; // tag before the current crumb
  $after = '</li>'; // tag after the current crumb

  if ( !is_home() && !is_front_page() || is_paged() ) {

    echo '<nav><ul class="breadcrumb">';

    global $post;
    $homeLink = home_url();
    echo '<li><a href="' . $homeLink . '">' . $home . '</a></li> ' . $delimiter . ' ';

    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;

    } elseif ( is_day() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
      echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;

    } elseif ( is_month() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;

    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;

    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        echo '<li>'.get_category_parents($cat, TRUE, ' ' . $delimiter . ' ').'</li>';
        echo $before . get_the_title() . $after;
      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;

    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li> ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;

    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;

    } elseif ( is_page() && $post->post_parent ) {
      $parent_id = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
        $parent_id = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;

    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;

    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;

    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }

    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page', 'bootstrapwp') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }

    echo '</ul></nav>';

  }
} // end bootstrapwp_breadcrumbs()


if ( ! function_exists( 'twentyten_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time.
 *
 * @since TwentyTen Five 1.0
 */
function twentyten_posted_on() {
	printf( __( 'Posted on %2$s', 'html5-blank' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" rel="bookmark"><time datetime="%2$s" pubdate>%3$s</time></a>',
			get_permalink(),
			get_the_date('c'),
			get_the_date())
	);
}
endif;

if ( ! function_exists( 'twentyten_posted_by' ) ) :
/**
 * Prints HTML with meta information for the current author.
 *
 * @since TwentyTen Five 1.0
 */
function twentyten_posted_by() {
	printf( __( 'Published by', 'perfectcoding' ).' %1$s',
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'Published by', 'perfectcoding' ).' %1$s', get_the_author() ),
			get_the_author() )
	);
}
endif;



/**
 * Customise the TwentyTen Five comments fields with HTML5 form elements
 *
 *	Adds support for 	placeholder
 *						required
 *						type="email"
 *						type="url"
 *
 * @since TwentyTen Five 1.0
 */
 function twentytenfive_comments() {

 	$req = get_option('require_name_email');

 	$fields =  array(
 		'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? '<span class="required">*</span>' : '' ) .'</label> ' . 
 		            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder = "Come ti possiamo chiamare?"' . ( $req ? ' required' : '' ) . '/></p>',
		            
 		'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' . 
 		            '<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="Come ti possiamo contattare?"' . ( $req ? ' required' : '' ) . ' /></p>',
		            
 		'url'    => ''/*'<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label>' .
 		            '<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="Have you got a website?" /></p>'*/

 	);
 	return $fields;
 }


 function twentytenfive_commentfield() {	

 	$commentArea = '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required placeholder="A cosa stai pensando?"	></textarea></p>';
	
 	return $commentArea;

 }

 add_filter('comment_form_default_fields', 'twentytenfive_comments');
 add_filter('comment_form_field_comment', 'twentytenfive_commentfield');
 /*
 * ========================================================================
 *  Shortcodes
 * ========================================================================
 */

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}

/*
* ==========================================================================
*  Add startup widgets 
* ==========================================================================
*/

add_action('switch_theme', 'perfectcoding_default_widget_demo');

#add_action('wp_head', 'perfectcoding_default_widget_demo');

function perfectcoding_default_widget_demo()
{
    // Register two sidebars.
    $sidebars = array ( 'a' => 'widget-area-1', 'b' => 'widget-area-2' );

    // We don't want to undo user changes, so we look for changes first.
    $active_widgets = get_option( 'sidebars_widgets' );

    if ( ! empty ( $active_widgets[ $sidebars['a'] ] )
        or ! empty ( $active_widgets[ $sidebars['b'] ] )
    )
    {   // Okay, no fun anymore. There is already some content.
        return;
    }

    // The sidebars are empty, let's put something into them.
    // How about a RSS widget and two instances of our demo widget?

    // Note that widgets are numbered. We need a counter:
    $counter = 1;

    // Add a 'demo' widget to the top sidebar …
    $active_widgets[ $sidebars['a'] ][0] = 'text-' . $counter;
    // … and write some text into it:
    $demo_widget_content[ $counter ] = array ( 'title' => "Super Titolo!", 'text' => "This works!\n\nAmazing!" );
    update_option( 'text_widget', $demo_widget_content );

    $counter++;

    // That was easy. Now a RSS widget. More fields, more fun!
    $active_widgets[ $sidebars['a'] ][] = 'rss-' . $counter;
    // The latest 15 questions from WordPress Stack Exchange.
    $rss_content[ $counter ] = array (
        'title'        => 'WordPress Stack Exchange',
        'url'          => 'http://wordpress.stackexchange.com/feeds',
        'link'         => 'http://wordpress.stackexchange.com/questions',
        'items'        => 15,
        'show_summary' => 0,
        'show_author'  => 1,
        'show_date'    => 1,
    );
    update_option( 'widget_rss', $rss_content );

    $counter++;

    // Okay, now to our second sidebar. We make it short.
    $active_widgets[ $sidebars['b'] ][] = 'text-' . $counter;
    #$demo_widget_content = get_option( 'widget_t5_demo_widget', array() );
    $demo_widget_content[ $counter ] = array ( 'text' => 'The second instance of our amazing demo widget.' );
    update_option( 'text_widget', $demo_widget_content );

    // Now save the $active_widgets array.
    update_option( 'sidebars_widgets', $active_widgets );
}

?>
