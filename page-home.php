<?php
/**
 * Template Name: Homepage
 */
?>
<?php get_header(); ?>

<div id="main">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<article id="page" class="entry-full">
			<h1><?php the_title(); ?> - haha</h1>
			<?php the_content(); ?>
		</article>
	<?php endwhile; wp_reset_query(); ?>
</div><!--#main-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>