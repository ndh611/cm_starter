<?php
/**
 * Template Name: Multiple content per page
 */
?>
 
<?php get_header(); ?>

<div id="main">
	<?php
		$rows = get_field('multiple_content_block'); 
		if($rows) {			
			echo '<a name="top"></a>';
			
			$count=0;
			$headings = array();
			
			foreach($rows as $row) {
				$count++;
				echo '<a name="anchor-'.$count.'"></a>';
				echo '<h2>'.$row['multiple_content_heading'].'</h2>';
				echo $row['multiple_content_main'];
				echo '<div class="back-to-top"><a href="#">'.__('Back to top','CM Starter').'</a></div>';
				
				$headings[] = $row['multiple_content_heading'];
			}	
		}		
	?>
</div><!--#main-->

<aside>
	<h3><?php the_title(); ?></h3>
	<?php
		if ($count) {
			echo '<nav><ul>';
			for ($i=1; $i<=$count; $i++) {
				echo '<li><a href="#anchor-'.$i.'">'.$headings[$i-1].'</a></li>'; 
			}
			echo '</ul></nav>';
		}	
	?>
</aside>

<?php get_footer(); ?>