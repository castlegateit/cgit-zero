<?php

/**
 * Page template
 *
 * This template displays standard pages. Use page-*.php files to add
 * templates by slug; use the front-page.php template for static front pages;
 * and use individual named templates with "Template Name" comments to allow
 * templates to be selected in the WordPress admin section.
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

            // Print date updated
            echo 'Last updated ';
            the_modified_time('j F Y');

            // Print Twitter link
            $twitter_url = get_permalink();
            $twitter_text = urlencode(the_title('', '', false));
            echo " | <a href=\"http://twitter.com/share?url=$twitter_url&amp;text=$twitter_text\">Share on Twitter</a>";

            // Print edit link
            //edit_post_link('Edit', ' | ', '');

        ?></p>

<?php endwhile; ?>
<?php endif; // End if posts returned ?>

    </div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
