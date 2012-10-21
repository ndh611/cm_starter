<?php
/*********************************************************************************
LAUNCH BONES
Let's fire off all the functions
and tools. I put it up here so it's
right up top and clean.
*********************************************************************************/

// we're firing all out initial functions at the start
add_action('after_setup_theme','CM_start', 15);

function CM_start() {

    // launching operation cleanup
    add_action('init', 'CM_head_cleanup');
	
    // remove WP version from RSS
    add_filter('the_generator', 'CM_rss_version');
	
    // remove pesky injected css for recent comments widget
    add_filter( 'wp_head', 'CM_remove_wp_widget_recent_comments_style', 1 );
	
    // clean up comment styles in the head
    add_action('wp_head', 'CM_remove_recent_comments_style', 1);
	
    // clean up gallery output in wp
    add_filter('gallery_style', 'CM_gallery_style');

    // enqueue base scripts and styles
    add_action('wp_enqueue_scripts', 'CM_scripts_and_styles', 999);
	
    // ie conditional wrapper
    add_filter( 'style_loader_tag', 'CM_ie_conditional', 10, 2 );

    // launching this stuff after theme setup
    add_action('after_setup_theme','CM_theme_support');
    
    // cleaning up random code around images
    add_filter('the_content', 'CM_filter_ptags_on_images');
	
    // cleaning up excerpt
    add_filter('excerpt_more', 'CM_excerpt_more');
	
	// set custom excerpt length
	add_filter( 'excerpt_length', 'CM_custom_excerpt_length', 999 );
	
	//Edit editors's admin capabilities (ability to access Appearance?)
	add_action( 'admin_init', 'CM_editor_cap' );
	
	//Remove unwanted menu from Dashboard
	add_action( 'admin_menu', 'CM_remove_menus' );

	//RTE style sheet is enabled, located as theme-folder/editor-style.css
	add_editor_style();

} /* end bones ahoy */

/*********************************************************************************
WP_HEAD GOODNESS
*********************************************************************************/

function CM_head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// index link
	remove_action( 'wp_head', 'index_rel_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
	// remove WP version from css
	add_filter( 'style_loader_src', 'CM_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'CM_remove_wp_ver_css_js', 9999 );

} /* end bones head cleanup */

// remove WP version from RSS
function CM_rss_version() { return ''; }

// remove WP version from scripts
function CM_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

// remove injected CSS for recent comments widget
function CM_remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}

// remove injected CSS from recent comments widget
function CM_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}

// remove injected CSS from gallery
function CM_gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}


/*********************************************************************************
SCRIPTS & ENQUEUEING
*********************************************************************************/

function CM_scripts_and_styles() {
	if (!is_admin()) {

		// modernizr (without media query polyfill)
		//wp_register_script( 'modernizr', get_stylesheet_directory_uri() . '/js/modernizr.custom.min.js', array(), '2.5.3', false );

		// register main stylesheet
		wp_register_style( 'main-stylesheet', get_stylesheet_directory_uri() . '/css/main.css', array(), '', 'all' );

		// ie-only style sheet
		//wp_register_style( 'bones-ie-only', get_stylesheet_directory_uri() . '/css/ie.css', array(), '' );

		// comment reply script for threaded comments
		if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
		  wp_enqueue_script( 'comment-reply' );
		}

		//adding scripts file in the footer
		//wp_register_script( 'scripts-js', get_stylesheet_directory_uri() . '/js/scripts.js', array( 'jquery' ), '', true );

		// enqueue styles and scripts		
		wp_enqueue_style( 'main-stylesheet' );
		//wp_enqueue_style('bones-ie-only');
		
		//wp_enqueue_script( 'modernizr' );
		wp_enqueue_script( 'jquery' );
		//wp_enqueue_script( 'scripts-js' );
	}
}

// adding the conditional wrapper around ie stylesheet
// source: http://code.garyjones.co.uk/ie-conditional-style-sheets-wordpress/
function CM_ie_conditional( $tag, $handle ) {
	if ( 'bones-ie-only' == $handle )
		$tag = '<!--[if lt IE 9]>' . "\n" . $tag . '<![endif]-->' . "\n";
	return $tag;
}

/*********************************************************************************
THEME SUPPORT
*********************************************************************************/

function CM_theme_support() {

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support('post-thumbnails');

	// default thumb size
	//set_post_thumbnail_size(125, 125, true);

	// wp custom background (thx to @bransonwerner for update)
	/*add_theme_support( 'custom-background',
	    array(
	    'default-image' => '',  // background image default
	    'default-color' => '', // background color default (dont add the #)
	    'wp-head-callback' => '_custom_background_cb',
	    'admin-head-callback' => '',
	    'admin-preview-callback' => ''
	    )
	);*/

	// rss thingy
	add_theme_support('automatic-feed-links');

	// to add header image support go here: http://themble.com/support/adding-header-background-image-support/

	// adding post format support
	/*add_theme_support( 'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
		)
	);*/

	// wp menus
	add_theme_support( 'menus' );
	
} /* end bones theme support */

/*********************************************************************************
RANDOM CLEANUP ITEMS
*********************************************************************************/

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function CM_filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// This removes the annoying […] to a Read More link
function CM_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a href="'. get_permalink($post->ID) . '" title="Read '.get_the_title($post->ID).'">'.__('Read more','CM Starter').'</a>';
}

/*********************************************************************************
SET CUSTOM EXCERPT LENGTH
*********************************************************************************/
function CM_custom_excerpt_length( $length ) {
	return 36;
}

/*********************************************************************************
EDITORS' ADMIN FUNCTIONS/CAPABILITIES
*********************************************************************************/
function CM_editor_cap(){  
	//Ability to access Appearance
	$role = get_role( 'editor' );	
	$role->add_cap( 'edit_theme_options' );
}

/*********************************************************************************
REMOVE UNWANTED MENU FROM DASHBOARD
*********************************************************************************/
function CM_remove_menus () {
	// For all users
	remove_menu_page('link-manager.php');
	
	// For non-admin
	if( !current_user_can( 'administrator' ) ):
        remove_menu_page('tools.php');
		remove_menu_page('themes.php');	
    endif;	
}