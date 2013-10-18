<?php

/**
 * Comments template
 *
 * The template is used to display the comments area, including the comments
 * form. The output of individual comments is controlled by a callback to the
 * z_comment() function, which is defined in the functions.php file. If
 * comments are closed, the comment form is not printed.
 */

?>
		<div id="comments">

<?php if(post_password_required()): // Check if password protected ?>
            <p>This post is password protected. Enter the password to view comments.</p>
<?php return; ?>
<?php endif; ?>

<?php if(have_comments()): ?>

            <h2>Comments: <?php comments_number('0', '1', '%'); ?></h2>

<?php if(get_comment_pages_count() > 1 && get_option('page_comments')): ?>
            <div class="pagination">
                <span class="next"><?php next_comments_link('Older'); ?></span>
                <span class="prev"><?php previous_comments_link('Newer'); ?></span>
            </div>
<?php endif; ?>

            <ol>
                <?php

                    // Print list of comments using z_comment callback
                    wp_list_comments(
                        array(
                            'type' => 'comment',
                            'style' => 'ol',
                            'login_text' => 'Log in to reply',
                            'callback' => 'z_comment'
                        )
                    );

                ?>
            </ol>

<?php if(get_comment_pages_count() > 1 && get_option('page_comments')): ?>
            <div class="pagination">
                <span class="next"><?php next_comments_link('Older'); ?></span>
                <span class="prev"><?php previous_comments_link('Newer'); ?></span>
            </div>
<?php endif; ?>

<?php endif; ?>

<?php

    // If comments open, print form
    if(comments_open()):

        $commenter = wp_get_current_commenter();
        $req = get_option( 'require_name_email' ) ? ' (required)' : '';

        // Fields
        $fields = array(

            'author' => '<p><label for="author">Name' . $req . '</label>'
                . '<input type="text" name="author" id="author" value="'
                . $commenter['comment_author'] . '" /></p>',

            'email' => '<p><label for="email">Email' . $req . '</label>'
                . '<input type="text" name="email" id="email" value="'
                . $commenter['comment_author_email'] . '" /></p>',

            'url' => '<p><label for="url">Website</label>'
                . '<input type="text" name="url" id="url" value="'
                . $commenter['comment_author_url'] . '" /></p>'

        );

        // Message field
        $message = '<p><label for="comment">Comment</label>'
            . '<textarea name="comment" id="comment"></textarea></p>';

        /*
         * Print the comment form. This function can be called without any
         * arguments to print the default form. It can also be replaced
         * with a form that posts to wp-comments-post.php, but this may
         * break some plugins.
         */
        comment_form(
            array(
                'fields' => apply_filters( 'comment_form_default_fields', $fields ),
                'comment_field' => $message,
                'title_reply' => 'Leave a reply',
                'title_reply_to' => 'Leave a reply to %s',
                'cancel_reply_link' => 'Cancel reply',
                'label_submit' => 'Post Comment'
            )
        );

    // If comments closed, print message
    else:

?>
            <p>Comments are closed.</p>
<?php endif; ?>

		</div>
