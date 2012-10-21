<?php get_header(); ?>

<div id="main">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<article id="post" class="entry-full">			
			<h2><?php the_title(); ?></h2>
			<?php 
				//$date_format = CM_itl_date_format(ICL_LANGUAGE_CODE); 
				$date_format = 'M j, Y';
			?>
			<p class="date"><?php the_time($date_format); ?> &nbsp;|&nbsp; <?php the_category(', ') ?> &nbsp;|&nbsp; <?php comments_popup_link(__('No Comments','CM Starter'), __('1 Comment','CM Starter'), __('% Comments','CM Starter') ); ?></p>
			
			<?php the_content(); ?>
			
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

	<?php comments_template( '', true ); ?>
</div><!--#main-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>