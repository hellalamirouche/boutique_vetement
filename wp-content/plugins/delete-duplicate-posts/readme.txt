=== Delete Duplicate Posts ===
Contributors: cleverplugins, lkoudal, freemius
Tags: delete duplicate posts, delete duplicate,
Donate link: https://cleverplugins.com
Requires at least: 4.7
Tested up to: 5.1
Stable tag: 4.2.1
Requires PHP: 5.6

Get rid of duplicate blogposts on your blog!

== Description ==
This plugin searches and removes duplicate posts and their meta data. You can change in the settings how many at a time and if the plugin should run automatically every hour.

You can delete posts, pages and other Custom Post Types enabled on your website.

The plugin deletes not only the post, but post meta and other references to the post, cleaning up space in your WordPress website.

Read more on the [plugin page on cleverplugins.com](https://cleverplugins.com/delete-duplicate-posts/).

== Installation ==
1. Upload the delete-duplicate-posts folder to the /wp-content/plugins/ directory
2. Activate the Delete Duplicate Posts plugin through the \'Plugins\' menu in WordPress
3. Use the plugin by going to Tools -> Delete Duplicate Posts

== Frequently Asked Questions ==
= Should I take a backup before using this tool? =
Yes! You should always take a backup before deleting posts or pages on your website.

= What happens if it deletes something I do not want to delete? =
You should restore the backup you took of your website before you ran this tool.


== Screenshots ==
1. Duplicate posts were found
2. Details in the log

== Changelog ==

= 4.2.1 = 
* Direct link to support forum
* Fixed missing file in 3rd party SDK.

= 4.2 =
* Fix - the limitation on how many posts were deleted per batch did not always work, it does not.
* PHP notices removed from the log thank you @brianbrown

= 4.1.9.5 =
* Security fix

= 4.1.9.4 =
* Added two more intervals, every minute and every 5 minutes.
* Updated 3rd party script Freemius

= 4.1.9.3 =
* Fixed bugs introduced with updating to WordPress 4.9.1 - Thank you to all who reported the problem.

= 4.1.9.2 =
* Fixed esc_sql() for WordPress 4.8.3

= 4.1.9.1 =
* Fix missing 3rd party scripts.

= 4.1.9 =
* Optimized delete routines - Thank you Claire and Vaclav :-) Up to 20-30% faster deleting.
* Added timing functions so you can see how long it takes to delete in the log.
* Permanently delete posts and pages - no longer goes to trash.
* Fix - The log is now shown with latest events at top.
* Updated 3rd party scripts - Freemius update 1.2.1.7.1 to 1.2.2.9

= 4.1.8 =
* Updated Freemius SDK.
* Fixing problem with keeping latest or oldests posts.

= 4.1.7 =
* Fixed PHP Notification - Logs were not automatically cleaned.

= 4.1.6 =
* Fixed missing icon
* Listed freemius as contributer

= 4.1.5 =
* Fixing PHP Warning if no post types selected

= 4.1.3 =
* Fixed a mistake in Freemius configuration :-/

= 4.1.2 =
* Added language .pot file
* Improved Danish translation
* Added Fremius for more usage details - Opt-in

= 4.1.1 =
* Fix PHP notices
* Clean up code comments
* Logo now in Retina

= 4.1 =
* Fixes which kinds of posts that can be cleaned- Thanks Mark - https://cleverplugins.com/support/topic/delete-duplicate-post-of-a-different-post-type/
* Option up from max 250 posts to 500 - Thanks Mark.
* Improved visual style in the table listing.

= 4.0.2 =
* Fixes problem with cron job not working properly.
* New: Choose interval for automated cron job to run.
* Adds 3 cron interval 10 min, 15 min and 30 minutes to WordPress.
* Minor PHP Notice fix.
* Code cleaning up

= 4.0.1 =
* Added log notes for cron jobs and manual cleaning.
* Added missing screenshots, banners and icons.

= 4.0 =
* Big rewrite, long overdue, many bugs fixed
* NEW: Choose between post types.
* Optional cron job now runs every hour, not every half hour.
* The log was broken, it has now been fixed.
* Removed unused and old code.
* Improved plugin layout.

= 3.1 =
* Fix for deleting any dupes but posts - ie. not menu items :-/
* Fix for PHP warnings.
* Fix for old user capabilities code.

= 3.0 =
* Code refactoring and updates - Basically rewrote most of the plugin.
* Removed link in footer.
* Removed dashboard widget.
* Internationalization - Now plugin can be translated
* Danish language file added.

= 2.1 =
* Bugfixes

= 2.0.6 =
* Bugfix: Problem with the link-donation logic. Hereby fixed.

= 2.0.5 =
* Bugfix: Could not access the settings page from the Plugins page.
* Ads are no longer optional. Sorry about that :-)
* Changes to the amount of duplicates you can delete using CRON.


= 2.0.4 =
* Bugfix : A minor speed improvement.

= 2.0.3 =
* Bugfix : Minor logic error fixed.

= 2.0.2 =
* Bugfix : Now actually deletes duplicate posts when clicking the button manually.. Doh...


= 2.0 =
* Design interface updated
+ New automatic CRON feature as per many user requests
+ Optional: E-mail notifications


= 1.3.1 =
* Fixes problem with dashboard widget. Thanks to Derek for pinpointing the error.

= 1.3 =
* Ensures all post meta for the deleted blogposts are also removed...

= 1.1 =
* Uses internal delete function, which also cleans up leftover meta-data. Takes a lot more time to complete however and might time out on some hosts.

= 1.0 =
* First release

== Upgrade Notice ==
4.2  Contains security fixes, please update now.