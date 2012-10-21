<?php
/*********************************************************************************
REGISTER MENU
*********************************************************************************/
add_action( 'init', 'register_my_menus' );
function register_my_menus() {
	register_nav_menus(
		array(
			'top-menu' => 'Top Menu',
			'bottom-menu' => 'Bottom Menu'
		)
	);   
}

/*********************************************************************************
WALKER PAGE FOR HIERARCHICAL SUBMENU
Sample usage:
<?php
	$walker = new CM_Selective_Walker();
	wp_list_pages( array(
		'title_li' => '',
		'child_of' => PAGE_ID,
		'walker' => $walker,
    ) );
?>
*********************************************************************************/
class CM_Selective_Walker extends Walker_Page {
    /**
     * Walk the Page Tree.
     *
     * @global stdClass WordPress post object.
     * @uses Walker_Page::$db_fields
     * @uses Walker_Page::display_element()
     *
     * @since 2010-05-28
     * @alter 2010-10-09
     */
    function walk( $elements, $max_depth ) {
        global $post;
        $args = array_slice( func_get_args(), 2 );		
        $output = '';
 
        /* invalid parameter */
        if ( $max_depth < -1 ) {
            return $output;
        }
 
        /* Nothing to walk */
        if ( empty( $elements ) ) {
            return $output;
        }
 
        /* Set up variables */
        $top_level_elements = array();
        $children_elements  = array();
        $parent_field = $this->db_fields['parent'];
		$id_field = $this->db_fields['id'];
        $child_of = ( isset( $args[0]['child_of'] ) ) ? (int) $args[0]['child_of'] : 0;
 
        /* Loop elements */
        foreach ( (array) $elements as $e ) {
			
            $parent_id = $e->$parent_field;
			
            if ( isset( $parent_id ) ) {
			
                /* Top level pages. */
                if( $child_of === $parent_id ) {
                    $top_level_elements[] = $e;
                }
				
                /******************************************************** 
					Only display children of the current hierarchy. 
					This is where we can adjust the output.
				********************************************************/
                else if (
                    ( isset( $post->ID ) && $parent_id == $post->ID ) ||
                    ( isset( $post->post_parent ) && $parent_id == $post->post_parent ) ||
                    ( isset( $post->ancestors ) && in_array( $parent_id, (array) $post->ancestors ) )
                ){
					$children_elements[ $e->$parent_field ][] = $e;					
					//DEBUG					
					//$post_data = get_post($e->$id_field);
					//print_r ('<p><small>'.$post_data->post_title.'</small></p>');
                }
            }
        }		
 
        /* Define output. */
        foreach ( $top_level_elements as $e ) {
            $this->display_element( $e, $children_elements, $max_depth, 0, $args, $output );
        }
        return $output;
    }
}/* END of class */

/*********************************************************************************
FIND THE ULTIMATE PARENT
Sample usage:
<?php CM_find_ultimate_parent_ID($id, $level); ?>
*********************************************************************************/
function CM_find_ultimate_parent_ID($id, $level=1) {
	
	if ($level==0) return 0;	
	
	// Get parent ID of the post given ID
	$current_post = get_post ($id);	
	$parent_id = $current_post->post_parent;
	
	// Set up array
	$parents = array();
	$parents[] = $parent_id;
	
	// Traverse and keep record of all parent ID up the tree
	while ($parent_id != 0) {		
		$page = get_page($parent_id);		
		$parent_id = $page->post_parent;
		$parents[] = $parent_id;
	}
	
	// Reverse the array, return value of the corresponding level
	$parents = array_reverse($parents);	
	
	if ($level > count($parents)) {
		return -1;
	}
	else if ($level == count($parents)) {
		return $id;
	}
	else {
		return $parents[$level];
	}
	
} /* End of function*/

/*********************************************************************************
PRINT THE SUB-MENU
*********************************************************************************/
function CM_print_submenu($ultimate_parent, $title, $before='<ul>', $after='</ul>') {
	
	$walker = new CM_Selective_Walker();
	
	// Array for wp_list_pages
	$args = array(
		'title_li' => '',
		'child_of' => $ultimate_parent,
		'walker' => $walker,
		'depth' => 0,
		'echo' => 0 //wp_list_pages will not echo but return a value
	);
	
	// If there is any pages found in the submenu, print it
	if (wp_list_pages ($args)) {	
		if ($title!='') echo '<h3>'.$title.'</h3>';		
		echo $before;
		echo wp_list_pages ($args);
		echo $after;
	}
		
} /* End of function*/

?>