<?php
/**
 * Template Name: Custom Page Query
 */
?>
 
<?php get_header(); ?>

<div id="main">
	<?php 		
		global $post;
		// Set parent ID to current Page ID
		$parentID = $post->ID;			
		
		// Array for querying: we look for pages that are children of parentID and order by menu_order (ASC)
		// we will display 20 per page
		$args = array(
			'post_type' 		=> 'page',
			'post_parent' 		=> $parentID,
			'posts_per_page' 	=> '20',
			'orderby'			=> 'menu_order',
			'order'				=> 'ASC',
			'paged'				=> $paged
		);
		
		// Query
		$temp = $wp_query;	
		$wp_query = new WP_Query($args);
		$count = 0;
		
		// Loop
		while ($wp_query->have_posts()) : 
			$wp_query->the_post();
			$count++;		

			// Check if this is the 3rd block, then output last class
			$class = ($count % 3 == 0) ? ' content-block-last' : '';
			$class .= ($count % 3 == 1) ? ' content-block-first' : ''; // Fisrt of 3
			$class .= (floor(($count-1) / 3) == 0) ? ' content-block-first-line' : ''; // First lines
			
		?>
			<section class="content-block<?php echo $class; ?>">
				<h2><strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong></h2>
				<?php the_excerpt(); ?>
			</section>
		<?php endwhile; 
	?>
	
	<?php if ( $wp_query->max_num_pages > 1 ) : ?>
		<div class="paging">
			<div class="paging-next">
				<?php next_posts_link( __( 'Next &rarr;','CM Starter' ) ); ?>
			</div>
			<div class="paging-prev">
				<?php previous_posts_link( __( '&larr; Previous','CM Starter' ) ); ?>
			</div>
			<div class="clear"></div>
		</div>
	<?php endif; ?>
	
	<?php  
		$wp_query = $temp;
		wp_reset_query(); // IMPORTANT 
	?>
</div><!--#main-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>