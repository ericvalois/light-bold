<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
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
<div id="comments" class="comments-area hide-print">

	<?php if ( have_comments() ) : ?>
		<h4 class="comments-title mt3 mb3">
			<?php
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) {
					/* translators: %s: post title */
					printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'light-bold' ), get_the_title() );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s thought on &ldquo;%2$s&rdquo;',
							'%1$s thoughts on &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'light-bold'
						),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				}
			?>
		</h4>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list list-reset">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 56,
					'callback'	  => 'light_bold_custom_comments',
				) );
			?>
		</ol><!-- .comment-list -->

		<?php the_comments_navigation(); ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'light-bold' ); ?></p>
	<?php endif; ?>

	<?php

		comment_form( array(
			'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title separator mb2">',
			'title_reply_after'  => '</h3>',
			'class_submit'		 => 'perf_btn alt2 col-12 mb2 btn_comment',
			'class_form' => ' clearfix',
			'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( '<a href="%1$s" class="tags">Logged in as %2$s</a> <a href="%3$s" class="tags" title="Log out of this account">Log out?</a>','light-bold' ), esc_url( admin_url( 'profile.php' ) ), $user_identity, esc_url( wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) ) . '</p>',
			'comment_field' => '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Comment', 'light-bold' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" ></textarea></p>',
			'fields' => apply_filters( 'comment_form_default_fields', array(

			'author' =>
				'<div class="clearfix mxn1"><div class="lg-col lg-col-4 px1"><p class="comment-form-author">' .
				'<label for="author">' . esc_html__( 'Name', 'light-bold' ) . '</label> ' .
				( $req ? '<span class="required">*</span>' : '' ) .
				'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
				'" size="30" aria-required="true" required /></p></div>',

			'email' =>
				'<div class="lg-col lg-col-4 px1"><p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'light-bold' ) . '</label> ' .
				( $req ? '<span class="required">*</span>' : '' ) .
				'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" size="30" aria-required="true" required /></p></div>',

			'url' =>
				'<div class="lg-col lg-col-4 px1"><p class="comment-form-url"><label for="url">' .
				esc_html__( 'Website', 'light-bold' ) . '</label>' .
				'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
				'" size="30" /></p></div></div>'
			))
		) );

	?>

</div><!-- .comments-area -->
