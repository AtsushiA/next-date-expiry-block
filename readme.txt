
=== Date Expiry Text Block ===

Contributors:      WordPress Telex
Tags:              block, custom-field, date, expiry, conditional
Tested up to:      6.8
Stable tag:        0.2.0
License:           GPLv2 or later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html
A block that displays custom text when a specified custom field date has passed.

== Description ==

Date Expiry Text Block allows you to conditionally display text based on whether a date stored in a custom field has expired. This is useful for showing expiration notices, deadline alerts, sale-ended messages, and other time-sensitive content.

**Features:**

* Specify any custom field name that contains a date value.
* Set the date format used in the custom field (default: Y-m-d).
* Write custom text to display when the date has passed.
* Full paragraph-level text styling: text color, background color, font size, text alignment, and typography controls.
* On the front end, the block only renders when the custom field date is in the past — otherwise nothing is shown.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/next-date-expiry-block` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress

== Frequently Asked Questions ==

= What date formats are supported? =

By default the block expects dates in `Y-m-d` format (e.g., 2026-03-04). You can change the date format in the block settings to match the format stored in your custom field.

= What happens if the custom field doesn't exist? =

If the custom field is not found on the current post, the block will not render anything on the front end.

= Can I use this with ACF or other custom field plugins? =

Yes, as long as the custom field stores a date string, you can specify that field name in the block settings.

== Changelog ==

= 0.2.0 =
* Changed prefix from telex- to next-

= 0.1.0 =
* Initial release
