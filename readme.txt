=== Plugin Name ===
Contributors: chillthemes
Donate link: http://chillthemes.com/donate
Tags: portfolio, post-type, taxonomies
Requires at least: 3.0
Tested up to: 3.6
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Enables a portfolio post type for use in any of our Chill Themes.

== Description ==

This plugin provides you with a new post type aptly named **Portfolio** and two new taxonomies; **Roles** and **Types** to use with any theme you want, obviously it was created for use in our themes.

If you're looking for a theme that was designed specifically to work with this plugin, here's two:

* <a href="http://demos.chillthemes.com/edgetype">EdgeType</a>
* <a href="http://demos.chillthemes.com/haystack">Haystack</a>

== Installation ==

1. Upload the 'chillthemes-portfolio' folder to the '/wp-content/plugins/' directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. That's it! You'll then see a new item in the admin menu.

== Frequently Asked Questions ==

= Will this work with any WordPress theme? =

In short, yes it will. This plugin will provide you with all you need to setup a portfolio using WordPress. You'll just have to provide the post type archive, taxonomy, single portfolio, and portfolio page templates.

= Are there filters? =

Yes! Here's a list of available filters:

1. 'apply_filters( 'chillthemes_portfolio', 'portfolio' );'
2. 'apply_filters( 'chillthemes_portfolio_args', $portfolio_args );'
3. 'apply_filters( 'chillthemes_portfolio_role_taxonomy', 'role' );'
4. 'apply_filters( 'chillthemes_portfolio_project', 'portfolio' );'
5. 'apply_filters( 'chillthemes_portfolio_role_taxonomy_args', $role_args );'
6. 'apply_filters( 'chillthemes_portfolio_type_taxonomy', 'type' );'
7. 'apply_filters( 'chillthemes_portfolio_project', 'portfolio' );'
8. 'apply_filters( 'chillthemes_portfolio_type_taxonomy_args', $type_args );'

== Changelog ==

= 1.0 =
* Fresh out of the oven, careful it's hot.