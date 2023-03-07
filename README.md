# GM Adaptive CSS Grid

### Description

This mini plugin helps you to create fast and easy grid layouts with CSS. The plugin is lightweight and won't affect your pagespeed.

Set your values for the max column count, gap size and use default or own breakpoint sizes and the magic happens in the background. You start by setting a maximum column count for a medium breakpoint, and large breakpoint. It's easy to match your existing breakpoints, just add the width in **em**.

You don't know how to convert pixel into the em unit? Then take a look at this example: 1200px / 16px = 75em. (Parent width in pixel divided by 16px equals XXem).

### How to use

To get this grid onto your website all you have to do is to apply a CSS class to your parent element. Usually the parent element is a **wrapper** or **container** element like a **section** or **div**. The parent must have direct children to work, otherwise the plugin can't do it's magic.

Parent Element Class: **grid-container**
Child's Element Class: **grid-items**

**Important notice:** At the moment this plugin only works with Bricks, Oxygen and Breakdance pagebuilder. Or inside of a custom project where you can define HTML-Elements very precisely.
