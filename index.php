<?php

/**
 * Main template
 *
 * This file displays the main posts page, archives, and search results. Where
 * archives and search results need to be formatted differently, use separate
 * templates with a common loop template or a common content template.
 *
 * Note that post_class() or get_post_class() can be used to add the default
 * WordPress class names to posts; the_ID() can be used to add a unique
 * identifier to each post.
 */

?>
<?php get_header(); ?>

    <div class="main">

<?php if(get_previous_posts_link()): // If not first page, print pagination links ?>
        <div class="pagination">
            <span class="next"><?php next_posts_link('Older'); ?></span>
            <span class="prev"><?php previous_posts_link('Newer'); ?></span>
        </div>
<?php endif; ?>

<?php if(have_posts()): ?>

<?php if(is_archive() || is_search()): // If archive or search, print title ?>
        <h1><?php

            if(is_category()) {
                $term = single_cat_title('', false);
                echo "Archive for the <em>$term</em> category";
            } elseif(is_tag()) {
                $term = single_tag_title('', false);
                echo "Archive for the <em>$term</em> tag";
            } elseif(is_day()) {
                $time = get_the_time('j F Y');
                echo "Archive for $time";
            } elseif(is_month()) {
                $time = get_the_time('F Y');
                echo "Archive for $time";
            } elseif(is_year()) {
                $time = get_the_time('Y');
                echo "Archive for $time";
            } elseif(is_author()) {
                $author = get_user_by('slug', get_query_var('author_name'));
                echo "Posts by {$author->first_name} {$author->last_name}";
            } elseif(is_search()) {
                $term = get_search_query();
                echo "Search results for <em>$term</em>";
            } else {
                echo 'Archive';
            }

?></h1>
<?php endif; ?>

<?php while(have_posts()): the_post(); // Start loop ?>
        <div class="article">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php

                // Display featured image (use z_thumbnail_url() to get URL)
                if(has_post_thumbnail()) {
                    the_post_thumbnail('thumbnail');
                }

                // Print excerpt (see functions.php for ellipsis and length)
                the_excerpt();

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

        </div>

<?php endwhile; ?>

<?php else: // If no posts are returned, print a message ?>

        <h1>No posts found<?php

            // If search, show search term
            if(is_search()) {
                echo ' for <em>' . get_search_query() . '</em>';
            }

        ?></h1>

        <p>Sorry, but <?php

            // Print an appropriate apology
            if(is_category()) {
                echo 'there aren&rsquo;t any posts in the %s category';
            } elseif(is_date()) {
                echo 'there aren&rsquo;t any posts with this date';
            } elseif(is_author()) {
                echo 'there aren&rsquo;t any posts by %s';
            } else {
                echo 'no posts were found';
            }

        ?>. Try searching for something else or go back to the <a href="<?php bloginfo('url'); ?>/">home page</a>.</p>

<?php endif; // End if posts returned ?>

<?php if($wp_query->max_num_pages > 1): // If multiple pages, print pagination links ?>
        <div class="pagination">
            <span class="next"><?php next_posts_link('Older'); ?></span>
            <span class="prev"><?php previous_posts_link('Newer'); ?></span>
        </div>
<?php endif; ?>

    </div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
