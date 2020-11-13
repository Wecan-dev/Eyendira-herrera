<?php
if ( post_password_required() ) {
	return;
}

if ( comments_open() || get_comments_number()) { ?>

	<div class="edge-comment-holder clearfix <?php if(get_comments_number() == 0){echo "edge-comment-holder-no-comments";} ?>" id="comments">
		<div class="edge-comment-holder-inner">
			<div class="edge-comments-title">
				<h4>
                    <span class="edge-comments-number"> <?php comments_number(); ?> </span>
                </h4>
			</div>
			<div class="edge-comments">
				<?php if ( have_comments() ) { ?>
					<ul class="edge-comment-list">
						<?php wp_list_comments(array( 'callback' => 'adorn_edge_comment')); ?>
					</ul>
				<?php } ?>
				<?php if( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' )) { ?>
					<p><?php esc_html_e('Sorry, the comment form is closed at this time.', 'adorn'); ?></p>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php
		$edge_commenter = wp_get_current_commenter();
		$edge_req = get_option( 'require_name_email' );
		$edge_aria_req = ( $edge_req ? " aria-required='true'" : '' );
	    $edge_consent  = empty( $edge_commenter['comment_author_email'] ) ? '' : ' checked="checked"';

		$edge_args = array(
			'id_form' => 'commentform',
			'id_submit' => 'submit_comment',
			'title_reply'=> esc_html__( 'Leave a Comment','adorn' ),
			'title_reply_before' => '<h4 id="reply-title" class="comment-reply-title">',
			'title_reply_after' => '</h4>',
			'title_reply_to' => esc_html__( 'Post a Reply to %s','adorn' ),
			'cancel_reply_link' => esc_html__( 'cancel reply','adorn' ),
			'label_submit' => esc_html__( 'Submit','adorn' ),
			'comment_field' => '<textarea id="comment" placeholder="'.esc_attr__( 'Write a comment...','adorn' ).'" name="comment" cols="45" rows="6" aria-required="true"></textarea>',
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'fields' => apply_filters( 'comment_form_default_fields', array(
				'author' => '<input id="author" name="author" placeholder="'. esc_attr__( 'Full Name*','adorn' ) .'" type="text" value="' . esc_attr( $edge_commenter['comment_author'] ) . '"' . $edge_aria_req . ' />',
				'email' => '<input id="email" name="email" placeholder="'. esc_attr__( 'Email Address*','adorn' ) .'" type="text" value="' . esc_attr(  $edge_commenter['comment_author_email'] ) . '"' . $edge_aria_req . ' />',
				'cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" ' . $edge_consent . ' />' .
					'<label for="wp-comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'adorn' ) . '</label></p>'
			) ) );
	 ?>
	<?php if(get_comment_pages_count() > 1){ ?>
		<div class="edge-comment-pager">
			<p><?php paginate_comments_links(); ?></p>
		</div>
	<?php } ?>
	<div class="edge-comment-form">
		<div class="edge-comment-form-inner">
			<?php comment_form($edge_args); ?>
		</div>
	</div>
<?php } ?>
