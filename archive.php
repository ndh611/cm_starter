<?php get_header(); ?>

<div id="main">
	<h1>
		<?php if( is_author() ): ?>
			<?php _e('Author','CM Starter'); ?>: <?php echo $author_name ?>
		<?php elseif( is_category() ): ?>
			<?php _e('Category','CM Starter'); ?>: <?php single_cat_title(); ?>
		<?php elseif( is_tag() ): ?>
			<?php _e('Tag','CM Starter'); ?>: <?php single_tag_title(); ?>
		<?php elseif( is_year() ): ?>
			<?php _e('Archive for','CM Starter'); ?> <?php the_time('Y'); ?>
		<?php elseif( is_month() ): ?>
			<?php _e('Archive for','CM Starter'); ?> <?php the_time('F Y'); ?>
		<?php else: ?>
			<?php _e('Archive','CM Starter'); ?>
		<?php endif; ?>
	</h1>

	<?php if ( have_posts() ): ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php $author_name = get_the_author_meta('nickname'); ?>
			<article class="entry-compact">
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?php the_excerpt(); ?>
			</article>
		
		<?php endwhile; wp_reset_query(); ?>
	<?php else: ?>
		<h2><?php _e('No posts found','CM Starter'); ?></h2>
	<?php endif; ?>

	<?php if ( $wp_query->max_num_pages > 1 ) : ?>
		<div class="paging">
			<div class="paging-prev">
				<?php next_posts_link( __( '&larr; Older posts','CM Starter' ) ); ?>
			</div>
			<div class="paging-next">
				<?php previous_posts_link( __( 'Newer posts &rarr;','CM Starter' ) ); ?>
			</div>
		</div>
		<div class="clear"></div>
	<?php endif; ?>
</div><!--#main-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>