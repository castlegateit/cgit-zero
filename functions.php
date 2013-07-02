<?php

/**
 * Zero functions and definitions
 *
 * This file contains the main settings for the Zero WordPress theme and
 * provides various functions that can be used in the other template files. It
 * is also used to activate support for featured images and to register menus
 * and widget areas.
 */

/**
 * Remove default actions
 *
 * By default, WordPress adds various elements to the <head> element using the
 * wp_head hook. This removes the default elements. Other elements may also be
 * removed from wp_head and wp_footer, but these may interfere with plugins.
 */
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
//remove_action('wp_head', 'locale_stylesheet');
//remove_action('wp_head', 'noindex');
//remove_action('wp_head', 'wp_enqueue_scripts');
//remove_action('wp_head', 'wp_print_head_scripts');
//remove_action('wp_head', 'wp_print_styles');
//remove_action('wp_head', 'wp_shortlink_wp_head');
//remove_action('wp_footer', 'wp_print_footer_scripts');

/**
 * Add support for visual editor styles with editor-style.css
 */
add_editor_style();

/**
 * Add featured image support
 */
add_theme_support('post-thumbnails');

/**
 * Register sidebar
 *
 * This registers a single widget area. To register multiple widget areas, use
 * the register_sidebars($number, $args) function, where $number is the number
 * of sidebars and $args is an array of settings as below.
 */
register_sidebar(
    array(
        'name' => 'Sidebar',
        'id' => 'sidebar',
        'before_widget' => '<div id="%1$s" class="section %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    )
);

/**
 * Register menu
 *
 * Multiple menus can be registered by adding to the associative array of menu
 * locations.
 */
register_nav_menus(
    array(
        'nav' => __('Navigation')
    )
);

/**
 * Edit title tag
 *
 * Additional content, such as the site name and description, is added using
 * the wp_title filter instead of adding manually in the header.php file. This
 * allows the title to be manipulated by plugins.
 */
function z_edit_title($title, $sep, $seplocation) {
    $output = '';
    $name = get_bloginfo('name');
    $description = get_bloginfo('description');
    if(is_front_page() && $description) {
        $name = "$name $sep $description";
    }
    if($seplocation == 'right') {
        $output = $title . $name;
    } else {
        $output = $name . $title;
    }
    return $output;
}

add_filter('wp_title', 'z_edit_title', 10, 3);

/**
 * Function to return a post taxonomy
 *
 * This returns a list of categories, tags, or other taxonomy terms for a
 * particular post, similar to the_category() or the_tags() but without the
 * unpleasant rel attributes. By default, it lists the "category" taxonomy;
 * use the "post_tag" taxonomy to list tags. This must be used within the
 * loop. The exclude argument accepts a single term ID, a comma-separated list
 * of IDs or an array of an IDs to exclude from the results.
 */
function z_taxon(
    $taxon = 'category',
    $before = '',
    $sep = ', ',
    $after = '',
    $exclude = false
) {

    global $post;
    $terms = get_the_terms($post->ID, $taxon);

    if(!empty($terms) && $exclude) {

        if(is_int($exclude)) {
            $exclude = array($exclude);
        } elseif(is_string($exclude)) {
            $exclude = explode(',', $exclude);
        }

        foreach($terms as $k => $v) {
            if(in_array($v->term_id, $exclude)) {
                unset($terms[$k]);
            }
        }

    }

    $output = '';

    if(!empty($terms)) {
        $output .= $before;
        $list = array();
        foreach($terms as $term) {
            $link = get_term_link($term);
            $name = $term->name;
            $list[] = "<a href=\"$link\">$name</a>";
        }
        $output .= implode($sep, $list);
        $output .= $after;
    }

    return $output;

}

/**
 * Function to return a complete taxonomy list
 *
 * This returns a list of all the terms in a particular taxonomy in <li>
 * elements, similar to wp_list_category(). By default, it lists the terms in
 * the "category" taxonomy.
 */
function z_taxon_list($taxon = 'category') {
    $terms = get_terms($taxon);
    $output = '';
    foreach($terms as $term) {
        $link = get_term_link($term);
        $name = $term->name;
        $output .= "<li><a href=\"$link\">$name</a></li>";
    }
    return $output;
}

/**
 * Function to return copyright date range based on content
 */
function z_copyright() {
    global $wpdb;
    $dates = $wpdb->get_results("
        SELECT
            YEAR(min(post_date_gmt)) AS first,
            YEAR(max(post_date_gmt)) AS latest
        FROM
            $wpdb->posts
        WHERE
            post_status = 'publish'
    ");
    if($dates) {
        $first = $dates[0]->first;
        $latest = $dates[0]->latest;
        if($first == $latest) {
            return $first;
        } else {
            return $first . '&ndash;' . $latest;
        }
    }
}

/**
 * Function to return image URL
 *
 * If no ID is specified and featured images are supported, this will default
 * to the featured image. The second optional parameter sets the image size.
 */
function z_image_url($id = false, $size = 'full') {
    if(!$id && has_post_thumbnail()) {
        $id = get_post_thumbnail_id();
    }
    if($id) {
        $image = wp_get_attachment_image_src($id, $size);
        return $image[0];
    }
}

/**
 * Function to generate comment output
 *
 * This defines a basic comment format and is used as a callback in
 * comments.php. Avatars, edit links, and reply links can also be added. The
 * comment closing tag is omitted here and inserted automatically by WordPress.
 */
function z_comment($comment, $args, $depth) {

    // Get comment object
    $GLOBALS['comment'] = $comment;

    // Get current comment data
    $author = get_comment_author_link();
    $class_name = implode(' ', get_comment_class());
    $date = get_comment_date();
    $id = get_comment_ID();
    $link = get_comment_link($comment->comment_ID);
    $time = get_comment_time();
    //$avatar = get_avatar($comment, 40);
    //$edit = get_edit_comment_link('Edit', '<p class="edit">', '</p>');
    //$reply = get_comment_reply_link();

    // Generate comment output
    $output = "<li class=\"$class_name\" id=\"comment-$id\">";
    $output .= "<h3>$author on <a href=\"$link\">$date at $time</a></h3>";
    if($comment->comment_approved) {
        $output .= get_comment_text();
    } else {
        $output .= '<p>Your comment is awaiting moderation.</p>';
    }
    echo $output;

}
