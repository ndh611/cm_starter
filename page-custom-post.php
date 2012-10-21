<?php
/**
 * Template Name: Custom Posts Query
 */
?>
 
<?php get_header(); ?>

<div id="main">
	<?php 
		// Array for querying: we look for posts that belong to Category 3
		// We will display 2 posts per page
		$args = array(
			'post_type' 		=> 'post',
			'cat' 				=> '3',
			'posts_per_page' 	=> '2',
			'paged'				=> $paged
		);
		
		/// Query
		$temp = $wp_query;	
		$wp_query = new WP_Query($args);
		
		// Loop
		while ($wp_query->have_posts()) : $wp_query->the_post();
		?>
			<h2><strong><?php the_title(); ?></strong></h2>
			<?php the_excerpt(); ?>
		<?php endwhile;
	?>
	
	<?php if ( $wp_query->max_num_pages > 1 ) : ?>
		<?php if ( $wp_query->max_num_pages > 1 ) : ?>
		<div class="paging">
			<div class="paging-next">
				<?php next_posts_link( __( 'Older &rarr;','CM Starter' ) ); ?>
			</div>
			<div class="paging-prev">
				<?php previous_posts_link( __( '&larr; Newer','CM Starter' ) ); ?>
			</div>
			<div class="clear"></div>
		</div>
	<?php endif; ?>
		
		
		<?php 
			//BONES numeric paging - must be used with $wp_query
			CM_page_navi(); 
		?>
	<?php endif; ?>
	
	<?php  
		$wp_query = $temp;
		wp_reset_query(); // IMPORTANT 
	?>
	
</div><!--#main-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>