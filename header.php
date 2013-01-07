<?php

/**
 * Header template
 *
 * Contains the <head> element applied to all pages and opens the <div>
 * element that contains the main content of the page. It also calls the
 * wp_head() function at the end of the <head> element for compatibility with
 * plugins and other WordPress functions.
 */

?>
<!DOCTYPE html>

<html lang="<?php bloginfo('language'); ?>">

<head>

<meta charset="<?php bloginfo('charset'); ?>" />

<title><?php wp_title('|', true, 'right'); ?></title>

<meta name="description" content="<?php bloginfo('description'); ?>" />
<?php /* <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> */ ?>

<?php /* <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style.css" /> */ ?>
<?php /* <link rel="alternate" type="application/atom+xml" href="<?php bloginfo('atom_url'); ?>" title="Atom Feed" /> */ ?>
<?php /* <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="RSS Feed" /> */ ?>
<?php /* <link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/icons/favicon.ico" /> */ ?>
<?php /* <link rel="apple-touch-icon-precomposed" href="<?php bloginfo('stylesheet_directory'); ?>/icons/touch.png" /> */ ?>

<?php /* <script src="<?php bloginfo('stylesheet_directory'); ?>/js/script.js"></script> */ ?>

<?php wp_head(); ?>

</head>

<body>

<div class="header">

<?php if(is_home()): ?>
    <h1 class="title"><a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a></h1>
<?php else: ?>
    <div class="title"><a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a></div>
<?php endif; ?>

    <div class="nav">
        <?php

            // Print navigation menu registered in functions.php
            wp_nav_menu(
                array(
                    'theme_location' => 'nav',
                    'container' => false,
                    'items_wrap' => '<ul>%3$s</ul>'
                )
            );

        ?>
    </div>

</div>

<div class="content">
