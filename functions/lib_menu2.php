<?php
/*********************************************************************************
ADD FIRST AND LAST CLASS TO MENU
*********************************************************************************/

add_filter('wp_nav_menu','add_first_last_item_class');

function add_first_last_item_class($strHTML) {
	$intPos = strripos($strHTML,'menu-item');	
	$output = substr($strHTML,0,$intPos)." last_item ".substr($strHTML,$intPos,strlen($strHTML));
	$strHTML = $output;	
	
	$intPos = stripos($strHTML,'page_item');
	$output = substr($strHTML,0,$intPos)." first_item ".substr($strHTML,$intPos,strlen($strHTML));
	echo $output;
}

/*********************************************************************************
SUBMENU - LISTING ALL CHILDREN OF A PAGE
Usage: put the following code in a template file or in a PHP widget
<?php
	global $post;
	echo hierarchical_submenu($post, "active"); 
?>
*********************************************************************************/
function hierarchical_submenu($post, $class, $before, $after) {
    $top_post = $post;
	$before_str = $before;
	$after_str = $after;
	$active_class = $class;
	
    // If the post has ancestors, get its ultimate parent and make that the top post
    if ($post->post_parent && $post->ancestors) {
        $top_post = get_post(end($post->ancestors));
    }
    // Always start traversing from the top of the tree
	$output = $before_str.hierarchical_submenu_get_children($top_post, $post, $active_class).$after_str;
	return $output;
}

/*********************************************************************************
SUBMENU - GET CHILDREN
*********************************************************************************/
function hierarchical_submenu_get_children($post, $current_page, $active_class) {
    $menu = '';
	
    // Get all immediate children of this page
    $children = get_pages('child_of=' . $post->ID . '&parent=' . $post->ID . '&sort_column=menu_order&sort_order=ASC');
    if ($children) {
        $menu = "\n<ul>\n";
        foreach ($children as $child) {
		
            // If the child is the viewed page or one of its ancestors, highlight it
            if (in_array($child->ID, get_post_ancestors($current_page)) || ($child->ID == $current_page->ID)) {
                $menu .= '<li class="'.$active_class.'"><a href="' . get_permalink($child) . '" class="sel">' . $child->post_title . '</a>';
            } else {
                $menu .= '<li><a href="' . get_permalink($child) . '">' . $child->post_title . '</a>';
            }
			
            // If the page has children and is the viewed page or one of its ancestors, get its children
            if (get_children($child->ID) && (in_array($child->ID, get_post_ancestors($current_page)) || ($child->ID == $current_page->ID))) {
                $menu .= hierarchical_submenu_get_children($child, $current_page, $active_class);
            }
            $menu .= "</li>\n";
        }
        $menu .= "</ul>\n";
    }
    return $menu;
}
?>