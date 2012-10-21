<?php

/*********************************************************************************
SHOW BREADCRUMBS IN TEMPLATE
Usage: <?php CM_breadcrumbs('»','You are here') ?> 
*********************************************************************************/
function CM_breadcrumbs( $sep = '/', $label = 'You are here: ' ) {
	global $post;
	
	// If this is front-page (home), output nothing and EXIT
    if(is_front_page()):        
		return;
	endif;
	
	// Create a constant for the separator, with space padding.
	$SEP = '  ' . $sep . '  ';
	
	// Output HTML wrapper and label
	echo '<div class="breadcrumbs">';
	echo '<span class="label">'.$label.'</span>';    
	
	// Output Home link
	echo CM_make_link( get_bloginfo('url'), __('Home','CM Starter'), get_bloginfo('name'), true ) . $SEP;
	
	// If this is home (blog)
	if (is_home()):
		echo 'Blog';		
		//Close wrapper and EXIT
		echo '</div>';
		return;
	endif;	
	
	//If this is an archive
	if (is_archive()):
		echo 'Archive';
		//Close wrapper and EXIT
		echo '</div>';
		return;
	endif;
		
	// If this is a blog entry
    if (is_single()) :
        the_category(', '); echo $SEP;
	
	// If this is a page
	elseif (is_page()):
        $parent_id = $post->post_parent;
		$parents = array();
        while($parent_id) {
            $page = get_page($parent_id);
            $parents[]  = CM_make_link( get_permalink($page->ID), get_the_title($page->ID) ) . $SEP;
            $parent_id  = $page->post_parent;
        }
        $parents = array_reverse($parents);
        foreach($parents as $parent) {
            echo $parent;
        }
   endif;
   
    // Wordpess function that output current post/page title.
    the_title();
	
	// Close wrapper
    echo '</div>
';
}

/*********************************************************************************
HELPER FUNCTION FOR PRINTING LINK
*********************************************************************************/
function CM_make_link ( $url, $anchortext, $title=null, $nofollow=false ) {
   if ( $title == null ) $title=$anchortext;
   $nofollow==true ? $rel=' rel="nofollow"' : $rel = ''; 

   $link = sprintf( '<a href="%s" title="%s" %s="">%s</a>', $url, $title, $rel, $anchortext );
   return $link;
}

/*********************************************************************************
Taxonomy Breadcrumb
Usage: <?php CM_taxonomy_breadcrumb(); ?>
*********************************************************************************/
function CM_taxonomy_breadcrumb() {
	// Get the current term
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	
	// Create a list of all the term's parents
	$parent = $term->parent;
	while ($parent):
		$parents[] = $parent;
		$new_parent = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
		$parent = $new_parent->parent;
	endwhile;
	
	if(!empty($parents)): 
		$parents = array_reverse($parents);	
		
		// For each parent, create a breadcrumb item
		foreach ($parents as $parent):
			$item = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
			$url = get_bloginfo('url').'/'.$item->taxonomy.'/'.$item->slug;
			echo '<li><a href="'.$url.'">'.$item->name.'</a></li>';
		endforeach;
	endif;
	
	// Display the current term in the breadcrumb
	echo '<li>'.$term->name.'</li>';
}

?>