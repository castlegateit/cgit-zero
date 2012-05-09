<?php

/**
 * Single post template
 */

?>
<?php get_header(); ?>

    <div class="main">

<?php if(have_posts()): ?>
<?php while(have_posts()): the_post(); // Start loop ?>
        <h1><?php the_title(); ?></h1>
        <?php

            // Display featured image (use z_thumbnail_url() to get URL)
            if(has_post_thumbnail()) {
                the_post_thumbnail('thumbnail');
            }

            // Print content
            the_content('Read more');

        ?>
        <p class="article-meta"><?php

            // Print author name
            //the_author();

            // Print author name and URL
            //the_author_link();

            // Print author name linked to archive
            //$author_id = get_the_author_meta('ID');
            //$author_url = get_author_posts_url($author_id);
            //$author_name = get_the_author();
            //echo "<a href=\"$author_url\">$author_name</a>";

            // Print date published
            the_time('j F Y');

            // Print categories
            echo z_taxon('category', ' | Categories: ');

            // Print tags
            echo z_taxon('post_tag', ' | Tags: ');

            // Print comments link
            if(get_comments_number() > 0) {
                echo ' | ';
                comments_popup_link(
                    'Comments: 0',
                    'Comments: 1',
                    'Comments: %',
                    '',
                    'Comments disabled'
                );
            }

            // Print Twitter link
            $twitter_url = get_permalink();
            $twitter_text = urlencode(the_title('', '', false));
            echo " | <a href=\"http://twitter.com/share?url=$twitter_url&amp;text=$twitter_text\">Share on Twitter</a>";

            // Print edit link
            //edit_post_link('Edit', ' | ', '');

        ?></p>

<?php endwhile; ?>
<?php endif; // End if posts returned ?>

<?php comments_template(); ?>

    </div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
