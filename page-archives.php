<?php

/**
 * Archives Page template
 *
 * This template displays the site archives by month, category, and tag. It
 * will be used by a page with the "archives" slug. Alternatively, change the
 * file name and add a "Template Name" comment to allow the template to be
 * selected in the WordPress admin section.
 */

?>
<?php get_header(); ?>

    <div class="main">

<?php if(have_posts()): ?>
<?php while(have_posts()): the_post(); // Start loop ?>
        <h1><?php the_title(); ?></h1>
        <?php the_content('Read more'); // Print content ?>
<?php endwhile; ?>
<?php endif; ?>

        <h2>Archives by month</h2>

        <ul>
            <?php

                // Print archives by month
                wp_get_archives(
                    array(
                        'type' => 'monthly',
                        'limit' => 12
                    )
                );

            ?>
        </ul>

<?php if(get_terms('category')): ?>
        <h2>Archives by category</h2>

        <ul>
            <?php echo z_taxon_list('category'); ?>

        </ul>
<?php endif; ?>

<?php if(get_terms('post_tag')): ?>
        <h2>Archives by category</h2>

        <ul>
            <?php echo z_taxon_list('post_tag'); ?>

        </ul>
<?php endif; ?>

    </div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
