# Zero

**Development of Castlegate IT fork of the Zero theme has now stopped. The theme has been replaced by [Terminus](https://github.com/castlegateit/terminus), which can be customized and extended using [child themes](https://github.com/castlegateit/terminus-child-template). Some of the functions provided by Zero can now be found in the [Contact Form](https://github.com/castlegateit/cgit-wp-contact-form), [Login Style](https://github.com/castlegateit/cgit-wp-login-style), [SEO](https://github.com/castlegateit/cgit-wp-cmb-seo), and [User Guide](https://github.com/castlegateit/cgit-wp-user-guide) plugins.**

---

Zero is a simple WordPress theme designed to act as a starting point for
development and customization. It contains theme files for pages, posts, and
archives but does not provide any style information.

## Templates

The theme contains templates for an archives page and a simple contact page.
The templates are assigned by page slug, but they can be modified so that they
can be used with any page in the WordPress administration screen. See the
[WordPress documentation](http://codex.wordpress.org/Template_Hierarchy) for
details.

## Widgets and Menus

The `functions.php` file defines one [widget
area](http://codex.wordpress.org/WordPress_Widgets) (dynamic sidebar) and one
customizable [navigation menu](http://codex.wordpress.org/Navigation_Menus).
These are provided as examples and can be extended or removed as required.

## ACF Options Page

To use the options page in the Zero theme please install Advanced Custom Fields
and the ACF Options Page. When both of these are installed then the options
page will appear.

The options page has the following fields, these are the names to use in your
template:

*   `telephone`
*   `email`
*   `address`
*   `registered_address`
*   `registered_number`
*   `registered_country`
*   `vat_number`

These options are created in the `acf.php` file. These can be edited through
this file, but will not display in the ACF interface.

To generate these fields, you create them in a WordPress site and use the
'Export' tool to 'Export to PHP', this generates code that you copy to the
`acf.php` file.

## License

Released under the [MIT License](http://www.opensource.org/licenses/MIT). See
[LICENSE](LICENSE) for details.
