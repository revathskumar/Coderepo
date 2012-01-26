=== Captcha ===
Contributors: bestwebsoft
Donate link: http://bestwebsoft.com/
Tags: captcha, math captcha, text captcha, spam, antispam, login, registration, comment, lost password, capcha, catcha, captha
Requires at least: 2.9
Tested up to: 3.2
Stable tag: 2011.2.06

This plugin allows you to implement super security captcha form into web forms.

== Description ==

Captcha plugin allows you to protect your website from spam using math logic which can be used for login, registration, reseting password, comments forms.

== Installation ==

1. Upload `captcha` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Site wide Settings are located in "Settings", "Captcha".

== Frequently Asked Questions ==

= How to change captcha label =

Go to the Settings page and change value for the 'Label for CAPTCHA in form' field.

= During saving of settings I got an error: 'Please select one point in the blocks Arithmetic actions and Difficulty for CAPTCHA'. What is this? =

For correct work of Captcha plugin you need to choose at least one item from the 'Arithmetic actions' block and choose 'Difficulty' via Settings page, because math expression should be consisted minimum with 1 mathematical sign, and parts of mathematical expression should be displayed like words or like numbers, or both of them.

= Missing CAPTCHA on comment form? = 
You may have a theme that has a not properly coded comments.php. 

The version of WP makes a difference...

(WP2 series) Your theme must have a `<?php do_action('comment_form', $post->ID); ?>` tag inside your `/wp-content/themes/[your_theme]/comments.php` file. 
Most WP2 themes already do. The best place to locate the tag is before the comment textarea, you may want to move it up if it is below the comment textarea.

(WP3 series) Since WP3 there is new function comment_form inside `/wp-includes/comment-template.php`. 
Your is theme probably not up to current code to call that function from inside comments.php.
WP3 theme does not need the `do_action('comment_form'`... code line inside `/wp-content/themes/[your_theme]/comments.php`.
Instead, it uses a new function call inside comments.php: `<?php comment_form(); ?>`
If you have WP3 and still have the missing captcha, make sure your theme has `<?php comment_form(); ?>`
inside `/wp-content/themes/[your_theme]/comments.php`. (look inside the Twenty Ten theme's comments.php for proper example)

== Screenshots ==

1. Captcha Settings page.
2. Comments form with Captcha.
3. Registration form with Captcha.
4. Lost password form with Captcha.
5. Login form with Captcha.

== Changelog ==

= 2.06 =
*BWS Plugins sections was fixed and right now it is consisted with 3 parts: activated, installed and recommended plugins. The bug of position in the admin menu is fixed. 

= 2.05 =
*BWS Plugins sections was fixed and right now it is consisted with 2 parts: installed and recommended plugins. Icons displaying is fixed. Misalignment of math transaction is fixed.

= 2.04 =
*In this version of plugin a bug of CAPTCHa reflection (before and after the comment form) was fixed. Please upgrade Captcha plugin immediately. Thank you. For more details information please see the FAQ

= 2.03 =
*In this version of plugin a bug of CAPTCHa reflection was fixed in some of the themes for release of WordPress 3.0 and above. Please upgrade Captcha plugin immediately. Thank you

= 2.02 =
*The bug of the captcha setting page link is fixed in this version. Please upgrade the Captcha plugin immediately. Thank you

= 2.01 =
*Usability at the settings page of plugin was improved.

= 1.04 =
*The bug of the captcha output is fixed in this version. Please upgrade the Captcha plugin immediately. Thank you.

= 1.03 =
*Ability to add BestWebSoft Contact Form plugin into a Captcha plugin from wp-admin via Settings panel.

= 1.02 =
* Added "Settings", "FAQ", "Support" links to the plugin action page.
* Added links on the plugins page.

= 1.01 =
* Mathematical actions choosing functionality and level of difficulty was implemented.

== Upgrade Notice ==

= 2.06 =
BWS Plugins sections was fixed and right now it is consisted with 3 parts: activated, installed and recommended plugins.  The bug of position in the admin menu is fixed.

= 2.05 =
BWS Plugins sections was fixed and right now it is consisted with 2 parts: installed and recommended plugins. Icons displaying is fixed. Misalignment of math transaction is fixed.

= 2.04 =
In this version of plugin a bug of CAPTCHa reflection (before and after the comment form) was fixed. Please upgrade Captcha plugin immediately. Thank you. For more details information please see the FAQ

= 2.03 =
In this version of plugin a bug of CAPTCHa reflection was fixed in some of the themes for release of WordPress 3.0 and above. Please upgrade Captcha plugin immediately. Thank you

= 2.02 =
The bug of the captcha setting page link is fixed in this version. Please upgrade the Captcha plugin immediately. Thank you

= 2.01 =
Usability at the settings page of plugin was improved.

= 1.04 =
The bug of the captcha output is fixed in this version. Please upgrade the Captcha plugin immediately. Thank you

= 1.03 =
Ability to add BestWebSoft Contact Form plugin into a Captcha plugin from wp-admin via Settings panel.

= 1.02 =
Added "Settings", "FAQ", "Support" links to the plugin action page. Added links on the plugins page.

= 1.01 =
Mathematical actions choosing functionality and level of difficulty was implemented.