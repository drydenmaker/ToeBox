<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h4 class="comments-title">
		<?php
		  sprintf('%1$s thoughts on %2$s', number_format_i18n( get_comments_number() ), get_the_title());
		?>
	   </h4>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 56,
				) );
			?>
		</ol><!-- .comment-list -->

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'toebox' ); ?></p>
	<?php endif; ?>

	<?php comment_form(array(
		      'class_submit' => 'btn btn-default comment-submit',
		      'comment_field' => 
                    		      '<div class="comment-form-comment form-group">' .
                        		      '<label for="comment" class="control-label">' . _x( 'Comment', 'noun' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label>' .
                        		      '<div class="">' .
                            		      '<textarea name="comment" type="text" class="form-control" id="comment" placeholder="" ' .
                            		      'value="' . esc_attr(  $commenter['comment_author'] ) . '"  aria-describedby="email-notes" rows="8" aria-describedby="form-allowed-tags" aria-required="true">' .
                            		      '</textarea>'.
                        		      '</div>' .
                    		      '</div>',
		      
              'fields' => array(
              
            		            'author'  =>
                        		            '<div class="form-group">' .
                            		            '<label for="author" class="control-label">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label>' .
                            		            '<div class="">' .
                            		            '<input name="author" type="text" class="form-control" id="email" placeholder="" ' .
                            		            'value="' . esc_attr(  $commenter['comment_author'] ) . '" ' . $aria_req . ' size="30" >' .
                            		            '</div>' .
                        		            '</div>',
                        		'email'  => 
                                            '<div class="form-group">' .
                                                '<label for="email" class="control-label">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label>' .
                                                '<div class="">' .
                                                  '<input name="email" type="' . 
                                                        ( $html5 ? 'email' : 'text' ) . 
                                                        '" class="form-control" id="email" placeholder="user@example.com" ' .
					                                   'value="' . esc_attr(  $commenter['comment_author_email'] ) . '"  aria-describedby="email-notes"' . $aria_req . '  size="30" >' .
                                                '</div>' .
                                            '</div>',
                                            
                                'url'  =>
                                            '<div class="form-group">' .
                                                '<label for="url" class="control-label">' . __( 'Website' ) . '</label>' .
                                                '<div class="">' .
                                                    '<input name="url" type="' . 
                                                        ( $html5 ? 'text' : 'text' ) . 
                                                        '" class="form-control" id="url" placeholder="http://example.com" ' .
                                                    'value="' . esc_attr(  $commenter['comment_author_url'] ) . '" size="30">' .
                                                '</div>' .
                                            '</div>',
                                            
        		    
                        	)
            )); ?>

</div><!-- .comments-area -->

