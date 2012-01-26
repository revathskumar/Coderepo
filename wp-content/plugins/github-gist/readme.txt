=== GitHub Gist Wordpress Plugin ===
Contributors: Jingwen Owen Ou
Donate link: http://owenou.com
Requires at least: 2.5.1
Tested up to: 3.0
Stable tag: trunk
Tags: github, gist, shortcode, embed, git, code, script

GitHub Gist Wordpress Plugin allows you to embed GitHub Gists from http://gist.github.com/ in a post or page.

== Description ==

GitHub Gist Wordpress Plugin allows you to embed [GitHub Gist](http://gist.github.com) snippets with a [gist] tag, instead of copying and pasting HTML. For example, to embed the [github_gist_wordpress_plugin_test.txt](http://gist.github.com/447298.js?file=github_gist_wordpress_plugin_test.txt) file from [gist: 447298](http://gist.github.com/447298.js), fill in the id and file attributes in the [gist] tag:

[gist id=447298 file=github_gist_wordpress_plugin_test.txt]

or

copy the embedding JavaScript code from GitHub and directly paste it in the body of the [gist] tag:

[gist]<code><script src="http://gist.github.com/447298.js?file=github_gist_wordpress_plugin_test.txt"></script></code>[/gist].

The [gist] tag also expands the content of the embedded Gist and wraps it with "<code><noscript><code><pre></code>" so that search engine spiders, users with javascript disabled and users reading your blog through RSS will still see your code in a blog entry.

== Installation ==

1) Download the plugin zip file.

2) Unzip.

3) Upload the github_gist_wordpress_plugin directory to your wordpress plugin directory (/wp-content/plugins).

4) Activate the plugin.

5) Use the [gist] tag in your posts or pages

== Changelog ==

= 1.0 =
* quote a Gist with id and file attribute.
* quote a Gist with the embedded JavaScript code.
* expand a Gist's content and wrap it with <code><code></code>

= 1.1 =
* fixed margin of the display when JavaScript is disabled.
* added branding information.

== Upgrade Notice ==

View the revision log from here [http://plugins.trac.wordpress.org/log/github-gist/](http://plugins.trac.wordpress.org/log/github-gist/)

== Screenshots ==

1. With JavaScript On
2. With JavaScript Off