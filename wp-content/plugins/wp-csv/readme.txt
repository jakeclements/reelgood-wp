=== WP CSV ===
Contributors: cpkwebsolutions
Donate link: http://cpkwebsolutions.com/donate
Tags: csv, import, export, bulk, easy, all, importer, exporter, posts, pages, tags, custom, images
Requires at least: 3.3
Tested up to: 3.7.1
Stable tag: 1.4.5

A powerful, yet simple, CSV importer and exporter for Wordpress posts, pages, and custom post types. 

== Description ==
Most WP features are fully supported:


* Posts, pages, and custom post types
* Tags, categories, and custom taxonomies  
* Custom fields (simple and complex)
* Thumbnails
* Flexible filter system to easily control which fields export
* Simple User Interface (if you know Excel or another spreadsheet program, you will find this plugin quite easy)

The plugin should now be usable with Woo Commerce, eShop, and most other plugins that are fully Wordpress compliant.

Learn more <a href='http://cpkwebsolutions.com/wp-csv'>here</a> and read the full documentation including a <a href='http://cpkwebsolutions.com/plugins/wp-csv/quick-start-guide/'>quick start guide</a> and a description of all the kinds of fields you'll see.

We welcome your feedback and feature requests.  Please also remember to <a href='http://cpkwebsolutions.com/donate'>support</a> the plugin.  A lot of time and effort goes into maintaining it!

== Installation ==

Refer to the <a href='http://cpkwebsolutions.com/wp-csv/quick-start-guide'>Quick Start Guide</a>.

== Frequently Asked Questions ==

<a href='http://cpkwebsolutions.com/wp-csv/faq'>Frequently Asked Questions</a> are stored on our main website.

== Screenshots ==

No screenshots available.

== Changelog ==

= 1.4.5 =
* Improved error handling and user feedback for badly formatted taxonomy terms.
= 1.4.4 =
* Added row limit and row offset as a work around for when memory limit/timeouts are being hit
* Added post and page to the post type filter, for greater control over what exports
= 1.4.3 =
* Enabled export of 'hidden' post meta fields
* Added include/exclude filtering for fields
* Convert complex (serialized) custom fields to JSON and back
= 1.4.2 =
* Code cleanup
* Fixed post_author bug (non-existant user ids will now export blank)
= 1.4.1 =
* Fixed minor export bug
= 1.4.0 =
* Added support for custom taxonomies (NOTE: Old export files are not compatible since the column heading names have changed)
* Added a check for iconv support
* Tweak to reduce memory footprint (experimental)
= 1.3.8 =
* Added a custom post type filter for export (thanks to Phillip Temple for the idea and for submitting the code)
= 1.3.7 =
* Added error checking and helpful messages when the wrong data is put into the Author field.
* Improved validation of comma separated category lists
= 1.3.6 =
* Added support for post_author field.
= 1.3.5 =
* Fixed: Error 'creating default object from empty value'.
= 1.3.4 =
* Enhancement: Plugin will now automatically create a backup folder in one of 4 locations (in order of preference) and add an .htaccess file to prevent unauthorized download.
= 1.3.3 =
* Fixed: Another session bug
= 1.3.2 =
* Fixed: Session bug preventing download of CSVs
* Fixed: Version string not being updated
* Added: Automatic search and/or creation of a safe download folder
= 1.3.1 =
* Fixed: mysqli_real_escape_string issue
= 1.3 =
* Fixed: minor incompatibility with WP 3.5
= 1.2 =
* Fixed: minor incompatibility with PHP 5.4
* Fixed: small improvement to the download mechanism
= 1.1 =
* Made csv file path configurable
= 1.0 =
* Initial upload

== Upgrade Notice ==

1.4.3 - All custom fields now exportable (even 'hidden' ones).  Complex custom field data exported and re-imported in JSON format.  Field include and exclude filtering added to help manage the large number of fields that may now be exported.
