=== GM Adaptive CSS Grid Columns ===
Author URI: https://www.georgenicolaou.me/
Plugin URI: https://www.georgenicolaou.me/plugins/gm-adaptive-css-grid-columns
Donate link: 
Contributors: orionaselite,picsta
Tags: CSS GRID,CSS COLUMNS,BRICKS,BREAKDANCE,OXYGEN,PAGEBUILDER
Requires at least: 
Tested up to: 6.2
Requires PHP: 
Stable tag: 1.0.4
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Allows you to create Adaptive CSS Grid Columns

== Description ==

Who can benefit from the plugin GM Adaptive CSS Grid Columns? (Short: GM Grid)
The plugin is made to help everyone who wants to have an easy, lightweight and worry-free solution to set up a maximum grid count on their website.
Of course, you can have fewer columns as those you have defined. They will automatically take the right percentage like 33.3%, 50% or even 100% of the available width.

== Do I have to know CSS? ==
Absolutely not! Especially beginners and non-coders will start to love this plugin soon.

== Hold on, not another plugin, what happens to my page speed? ==
Don't panic, we took care of this by keeping this plugin lightweight and the CSS is minified by default.

== Important Notice: ==

The plugin only works if you correctly identify and target the parent, and it’s direct child elements. Otherwise, the plugin can't work.
Recommended page builder are Bricks, Oxygen and Breakdance.

== How to use: ==

The setup is quite simple. Basically, you just add two CSS classes to your elements and the plugin does the magic for you.
Make sure to add the following classes to the container and direct child elements. Use a DIV instead of a section, container, or block
to avoid conflicting predefined styles.

Parent/Container Element class: grid-container
Child Element class: grid-item

Additionally, there is one more CSS class available. By using grid-center on your parent (container) element, you achieve three things.
1. The container will be centred on the page
2. Add your desired width (in rem)
3. Add horizontal spacing across all break points

== Minimum Setup: ==

1. Define the maximum column count for your medium and large screen size.
2. Add the desired gap size (in rem)
3. Define the medium and large breakpoint (in em).
Save!

**Quick overview of GM Adaptive CSS Grid Columns by [Imran Siddiq](https://websquadron.co.uk/)**

https://www.youtube.com/watch?v=lDibIKlmyv4


== Translations ==

GM Adaptive CSS Grid Column can be used in these different languages thanks to the following translators:

* Afrikaans [George Nicolaou](https://www.georgenicolaou.me/)
* German [Michael Kellersmann](https://profiles.wordpress.org/picsta/)
* Greek [George Nicolaou](https://www.georgenicolaou.me/)


== Installation ==

1. Go to `Plugins` in the Admin menu
2. Click on the button `Add new`
3. Search for `GM Adaptive CSS Grid Columns` and click 'Install Now' or click on the `upload` link to upload `adaptive-css-grid-columns.zip`
4. Click on `Activate plugin`

= Manual installation =

1. Download the plugin
2. Extract the contents of the zip file
3. Upload the contents of the zip file to the `wp-content/plugins/` folder of your WordPress installation
4. Activate the GM Adaptive CSS Grid Columns plugin from 'Plugins' page.

== Frequently Asked Questions ==

= Why is this plugin not working for me? =

The plugin only works if you correctly identify and target the parent and it's direct child elements.
Recommended page builder are Bricks, Oxygen and Breakdance.

= Why is the small break point missing? =

This plugin works based on the “Mobile First” principle, which means everything below the medium break point is for small devices. This way, you can define when the medium and large break point should be applied.

== Screenshots ==

1. Define Your Desired Settings
2. Add the Parent Element class: grid-container and the Child Element class: grid-item

== Changelog ==

= 1.0.0: March 25, 2023 =
* Intial release of GM Adaptive CSS Grid Columns

= 1.0.1: March 27, 2023 =
* Fixed bug with css being cached after options had been changed. Thanks to Imran Siddiq / Websquadron aka @flickimp

= 1.0.2: March 27, 2023 =
* Label fixes

= 1.0.3: March 28, 2023 =
* Admin UI fixes

= 1.0.4: March 28, 2023 =
* WordPress 6.2 Compatibility Checks 