<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'CM Starter' ); ?></p>
</div><!-- #comments -->

	<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;?>
	
	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h3><?php _e( 'Comments', 'CM Starter' ); ?></h3>
		
		<ol class="commentlist">
		<?php 
			//List all the comments
			wp_list_comments( array( 'callback' => 'CM_starter_comment', 'CM Starter' ) );
		?>
		</ol>
		
		<!-- COMMENT PAGING -->
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>			
			<?php previous_comments_link( __( '&larr; Older Comments', 'CM Starter') ); ?>
			<?php next_comments_link( __( 'Newer Comments &rarr;', 'CM Starter') ); ?>
		<?php endif; // check for comment navigation ?>
		<br />
	  
	<?php 
	/* If there are no comments and comments are closed, let's leave a little note, shall we?
	 * But we don't want the note on pages or post types that do not support comments.
	 */
	elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :?>
		<p><?php _e( 'Comments are closed.', 'CM Starter' ); ?></p>
	<?php endif; ?>
	

	<?php // Start Comment Form ?>
	<?php if ('open' == $post->comment_status) : ?>
		<?php comment_form(); ?> 		
	<?php endif;?>
	
</div><!--#comments -->