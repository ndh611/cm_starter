<?php
/**
 * Template Name: One column
 */
?>
 
<?php get_header(); ?>

<article id="main-one-column">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>				
		<h1><?php the_title(); ?></h1>
		<?php the_content(); ?>		
	<?php endwhile; wp_reset_query(); ?>
</article><!--#main-one-column-->

<?php get_footer(); ?>