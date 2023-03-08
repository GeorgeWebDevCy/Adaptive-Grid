=== GM Adaptive CSS Grid Columns ===
Author URI: https://www.georgenicolaou.me/
Plugin URI: https://www.georgenicolaou.me/plugins/adaptive-css-grid-columns
Donate link: 
Contributors: 
Tags: 
Requires at least: 
Tested up to: 
Requires PHP: 
Stable tag: 1.0.5
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Allows you to create Adaptive CSS Grid Columns

== Description ==

Important Notice:

The plugin only works if you correctly identify and target the parent and it's direct child elements.
Recommended page builder are Bricks, Oxygen and Breakdance.

How to use:

The setup is quite simple. Basically you just add two CSS classes to your elements
and the plugin does the magic for you. Make sure to add fhe following clases to
the container and direct child elements.

Parent Element class: grid-container
Child Element class: grid-items
1. Define the maximum column count for your medium and large screen size.
2. Add the desired gap size (in rem)
3. Define the medium and large breakpoint (in em).


A few notes about the sections above:

*   "Contributors" is a comma separated list of wordpress.org usernames
*   "Tags" is a comma separated list of tags that apply to the plugin
*   "Requires at least" is the lowest version that the plugin will work on
*   "Tested up to" is the highest version that you've *successfully used to test the plugin*. Note that it might work on
higher versions... this is just the highest one you've verified.
*   Stable tag should indicate the Subversion "tag" of the latest stable version, or "trunk," if you use `/trunk/` for
stable.

    Note that the `readme.txt` of the stable tag is the one that is considered the defining one for the plugin, so
if the `/trunk/readme.txt` file says that the stable tag is `4.3`, then it is `/tags/4.3/readme.txt` that'll be used
for displaying information about the plugin.  In this situation, the only thing considered from the trunk `readme.txt`
is the stable tag pointer.  Thus, if you develop in trunk, you can update the trunk `readme.txt` to reflect changes in
your in-development version, without having that information incorrectly disclosed about the current stable version
that lacks those changes -- as long as the trunk's `readme.txt` points to the correct stable tag.

    If no stable tag is provided, it is assumed that trunk is stable, but you should specify "trunk" if that's where
you put the stable version, in order to eliminate any doubt.


== Frequently Asked Questions ==

= A question that someone might have =

An answer to that question.


== Installation ==

1. Go to `Plugins` in the Admin menu
2. Click on the button `Add new`
3. Search for `Adaptive CSS Grid Columns` and click 'Install Now' or click on the `upload` link to upload `adaptive-css-grid-columns.zip`
4. Click on `Activate plugin`

== Changelog ==

= 1.0.0: March 2, 2023 =
* Birthday of GM Adaptive CSS Grid Columns

= 1.0.1: March 3, 2023 =
* Minor text edits 


= 1.0.2: March 6, 2023 =
* Added text description to admin area of the GM Adaptive CSS Grid Columns Plugin
* Implementation of Automic Updates from the plugin screeen 

= 1.0.3: March 6, 2023 =
* Updater fix

= 1.0.5: March 6, 2023 =
* Set generated CSS file to minified

= 1.0.5.1: March 8, 2023 =
* Fixed Container not set to grid by default Issue #4 (Reported by Imran Siddiq)

= 1.0.5.2: March 8, 2023 =
Removed unused functions to clean up code