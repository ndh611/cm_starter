<?
/*********************************************************************************
REGISTER NEWS POST TYPE
*********************************************************************************/
add_action( 'init', 'create_news_type' );
function create_news_type() {    
    $labels = array(
		'name' => 'News',
		'add_new' => 'Add News Item',
        'all_items' => 'All News',
		'add_new_item' => 'Add New News Item',
		'edit_item' => 'Edit News Item',
		'new_item' => 'New News Item',
		'view_item' => 'View News Item',
		'search_items' => 'Search News Item',
		'not_found' =>  'No News Items found',
		'not_found_in_trash' => 'No News Items found in Trash',
		'parent_item_colon' => ''
	);    
    
    //Register non-hierachical type like Posts
	register_post_type( 'news', array(
        'labels' =>  $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title',
            'editor',
            'author',
            'thumbnail',
            'excerpt'
        ),
    ));
}

/*********************************************************************************
FIX WP MESSAGE WHEN EDITING NEWS
*********************************************************************************/
add_filter('post_updated_messages', 'news_type_updated_messages');
function news_type_updated_messages( $messages ) {
    global $post, $post_ID;

    $messages['news'] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => sprintf( 'News item updated. <a href="%s">View news item</a>', esc_url( get_permalink($post_ID) ) ),
        2 => 'Custom field updated.',
        3 => 'Custom field deleted.',
        4 => 'News item updated.',
        /* translators: %s: date and time of the revision */
        5 => isset($_GET['revision']) ? sprintf( 'News restored to revision from %s', wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( 'News item published. <a href="%s">View news item</a>', esc_url( get_permalink($post_ID) ) ),
        7 => 'News saved.',
        8 => sprintf( 'News submitted. <a target="_blank" href="%s">Preview news item</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( 'News scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview news item</a>',
        // translators: Publish box date format, see php.net/date
        date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( 'News draft updated. <a target="_blank" href="%s">Preview news item</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );

    return $messages;
}

/*********************************************************************************
REGISTER NEWS CATEGORY TAXONOMY
*********************************************************************************/
add_action( 'init', 'news_category_init' );
function news_category_init() {        
    $labels = array(
		'name' => 'News Categories',
		'search_items' => 'Search News Categories',
		'all_items' => 'All News Categories',
		'parent_item' => 'Parent News Category',
		'parent_item_colon' => 'Parent News Category:',
		'edit_item' => 'Edit News Category',
		'update_item' => 'Update News Category',
		'add_new_item' => 'Add New News Category',
		'new_item_name' => 'New News Category Name',
        'menu_name' => 'News Categories'
	); 	    
    
    // Add news hierarchical taxonomy (like categories)
	register_taxonomy( 'news-category', 'news', array(
        'hierarchical' => true,
        'labels' => $labels,
        'sort' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'news-category' ),
    ));    
}

?>