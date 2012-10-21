<?php get_header(); ?>

<div id="main">
	<?php if ( have_posts() ): ?>	
		<?php while ( have_posts() ) : the_post(); ?>
			<article class="entry-compact">						
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				
				<?php //$date_format = CM_itl_date_format(ICL_LANGUAGE_CODE); 
					$date_format = 'M j, Y';
				?>	
				<p class="date"><?php the_time($date_format); ?> &nbsp;|&nbsp; <?php the_category(', ') ?> &nbsp;|&nbsp; <?php comments_popup_link(__('No Comments','CM Starter'), __('1 Comment','CM Starter'), __('% Comments','CM Starter') ); ?></p>
				
				<?php if (has_post_thumbnail()) : ?>
					<p><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full');?></a></p>			
				<?php endif; ?>
				
				<?php the_excerpt(); ?>
				
				<?php
					$postTags = get_the_tags();
					if ($postTags) {
						echo '<p class="tags">'.__('Tags: ','CM Starter');
						foreach($postTags as $tag => $tag_value) {
							echo '<a href="'.get_tag_link($tag_value->term_id).'">'.$tag_value->name.'</a>';
							
							//If not last tag, out put ','
							end($postTags);
							if ($tag !== key($postTags))
								echo ', ';
						}
						echo '</p>';
					}
				?>
			</article>
		<?php endwhile; wp_reset_query(); ?>
		
	<?php else: ?>
		<h2>No posts found</h2>
	<?php endif; ?>

	<?php if ( $wp_query->max_num_pages > 1 ) : ?>
		<div class="paging">
			<div class="paging-prev">
				<?php next_posts_link( __( '&larr; Older posts' ), 'CM Starter' ); ?>
			</div>
			<div class="paging-next">
				<?php previous_posts_link( __( 'Newer posts &rarr;' ), 'CM Starter' ); ?>
			</div>
			<div class="clear"></div>
		</div>
	<?php endif; ?>
</div><!--#main-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>