<div class="wrap" style="max-width: 60em;">

    <h2>User Guide</h2>

    <h3>The Menu</h3>

    <img src="<?php bloginfo('stylesheet_directory'); ?>/images/wordpress-menu.jpg" alt="WordPress Menu" style="float: right; margin: 0 0 1em 1em;" />

    <p>The Menu will contain some of the following, in this order: Dashboard,
    Posts (sometimes called latest news), Media, Links, Pages and Comments.
    When you click on one of these, or when you click on the little arrow that
    appears to the right of each item, you will see a sub-menu appear. So for
    example, when we say ‘click on categories underneath posts’ we refer to
    the categories item in the menu that appears when you click on posts.</p>

    <h3>Post and Pages</h3>

    <p>You may have both Posts and Pages or you may just have one or the
    other. Posts usually manage your blog, or your news items and pages
    manages the static pages of your website. For simplicity from now on we
    will refer to both of them as posts.</p>

    <p>Click on posts or pages on the menu and you will see a list of your
    posts, from here you can edit or delete a post as well as adding a new one
    by clicking on the ‘add new’ button at the top, or add new on the left
    hand menu. Click on the name of post to go to the edit window. Note that
    adding new a post works in exactly the same way as editing a post. </p>

    <p>The <code>Page Attributes</code> on the right can be used to set the
    menu order of the page and the parent page. We recommend you do not add
    any top level pages (i.e. pages with <code>(no parent)</code>) as this
    will affect the main navigation.</p>

<?php if ( function_exists('get_field') ): ?>

    <h3>Search Engine Optimisation</h3>

    <p>The <code>SEO</code> on the right of the screen (for pages and posts)
    is for custom Search Engine Optimisation of each individual page and post.
    You must enter the following:</p>

    <ul>

        <li><code>Title</code> The title displayed in the tab or title bar in
        a web browser.</li>

        <li><code>Heading</code> This is a hidden heading that is not
        displayed. It is needed for a higher SEO rating. It should be relevant
        to the content of your page and similar to the SEO Title.</li>

        <li><code>Description</code> The text displayed on a Google search
        listing. Helps people to identify the aim of your webpage and directs
        viewers to your site. This is also highly recommended for better SEO
        ratings.</li>

    </ul>

<?php endif; ?>

    <h3>The Edit Window</h3>

    <p>In the centre of the screen you will see the main edit window, this you
    will notice looks a lot like Word, you have the usual controls, bold,
    italic etc and is where you input your content. One thing to point out is
    that most of the options in the ‘format’ drop down, i.e. address,
    preformatted, etc will not be used on your website, also note that the
    Heading 1 will ‘always’ be reserved for your websites banner or logo,
    therefore will not display and in some cases break your page.</p>

    <p>All formatting of your sites content will be managed behind the scenes,
    so unless you are told to do something specific just use, paragraph,
    heading 2, heading 3, heading 4 etc.</p>

    <h3>Pasting in from Word</h3>

    <p>Many people like to write their articles in Microsoft Word or similar
    programs and then when they are happy, copy and paste into Wordpress, this
    is OK, as long as you make sure never to copy in content ‘directly’ from
    Word. This has been known to cause all sorts of issues, mostly due to the
    fact that Word carries with it all sorts of strange tags and code, which
    can make your posts appear funny and in some cases breaks the page. In
    order to avoid this you need to paste in the content using the ‘paste as
    plain text’ button, usually found on the second row of buttons, it is the
    clipboard with the ‘T’ on it, which you can see in the screenshot
    below.</p>

</div>
