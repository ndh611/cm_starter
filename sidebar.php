<aside>
	<?php	
		// If this is homepage
		if ( is_front_page() ) {
			// DO NOTHING
		}
		
		// If this is a post archive or a single post			
		else if ( is_home() || is_archive() || is_single() ) {
			dynamic_sidebar('Primary Sidebar'); 
		}		
		
		// If this is a page
		else if (is_page())	{	
			
			// Print Sub-menu
			$ultimate_parent_id = CM_find_ultimate_parent_ID($wp_query->post->ID, 1);
			$ultimate_parent_title = get_the_title($ultimate_parent_id);
			
			CM_print_submenu(
				$ultimate_parent_id,
				$ultimate_parent_title,
				'<nav><ul>',
				'</ul></nav>'
			);
			
			// If the template is Custom Post
			if (is_page_template('page-custom-post.php')) {
				dynamic_sidebar('Secondary Sidebar'); 
			
				// BENCHMARK EMAIL
				echo '<section id="newsletter-signup">';
				require_once ('benchmark_email.php');
				echo '</section>';
			}		
		}	
	?>
</aside>