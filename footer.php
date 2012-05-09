<?php

/**
 * Footer template
 *
 * This template closes the <div> element containing the main content. It also
 * contains the page footer and calls the wp_footer() function to allow
 * plugins to add code at the end of the <body> element.
 */

?>
</div>

<div class="footer">
    <p>Copyright &copy; <?php

        // Print a comma-separated list of authors
        wp_list_authors(
            array(
                'exclude_admin' => true,
                'show_fullname' => true,
                'html' => false
            )
        );

        // Print a copyright date range
        echo ' ' . z_copyright();

    ?></p>
</div>

<?php wp_footer(); ?>

</body>

</html>
