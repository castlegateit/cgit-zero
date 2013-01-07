<?php

/**
 * Sidebar template with widget area
 *
 * The sidebar contains the widgets set in the admin interface. If no widgets
 * are set, the content in the conditional statement will be loaded. If there
 * is no fallback content, just call the dynamic_sidebar() function.
 *
 * Multiple sidebars can be defined in the functions.php file and are
 * referenced using dynamic_sidebar($id), where $id is the sidebar ID.
 */

?>
    <div class="aside">

<?php if(!dynamic_sidebar('sidebar')): ?>

        <div class="section">
            <form action="<?php bloginfo('url'); ?>/" method="get">
                <p>
                    <label for="s" class="label-text">Search</label>
                    <input type="text" name="s" id="s" class="input-text" />
                    <input type="submit" value="Search" class="input-button" />
                </p>
            </form>
        </div>

<?php endif; ?>

    </div>
