=== Bangla Date (Bongabdo) ===
Contributors: Sajid Muhaimin Choudhury
Donate link: http://sajidmc.net/
Tags: multilingual, internationalization, bangla, date, calendar localization
Requires at least: 2.2.0
Tested up to: 3.0.1
Stable tag: 2.1

Convert English Dates to Bangla Dates, based on Dr. Muhammed Shahidullah's Bangla calendar approved by People's Republic of Bangladesh. Plugin autodetects the language, and displays Bangla / English version of the date.

== Description ==

**Update: Now automatically hooks the date and time functions. No need to edit any templates. To force output in Bengali, update the wordpress info properly, or edit the line 30 of bongabdo.php, and set the value of `$beng_date_options['use bangla']` to 1
Convert English Dates to Bangla Dates, based on Dr. Muhammed Shahidullah's Bangla calendar approved by People's Republic of Bangladesh. Plugin autodetects the language, and displays Bangla / English version of the date. This program was written back in 2001 in qbasic. The month names were in English Later in 2003 it was ported to visual basic. I didn't know how to use unicode, and used bijoy scripts for it. As I learnt about wp plugin system more, i decided to port it to Wordpress. Now I have Bangla Unicode, and thus can use it. The plugin enables some functions that can be used to insert a bengali date, either in transliterated English, or in Bangla Unicode in anywhere of a wordpress blog. 

These information were published in the New Nations:

Bengali Calendar was modified and deflawed by a Committee headed by Dr. Muhammad Shahidullah under the Bangla Academy in 1967 AP. The Committee made the following recommendations:
 
a. The first five months of the year from Baishakh to Bhadra will be of 31 one days' duration each.
b. The remaining seven months of the year with effect from Aswin to Chaitra will consists of 30 days each.
c. The 366th days after each fourth year will constitute what is known as a leap year which shall occur in the month of Falgaun corresponding to the month of February of the leap year in the Gregorian Calendar called as the English Calendar in popular parlance. Falgun will, therefore, have 31 days in the leap-year.
 
Now the Bengali New Year (the 1st of Baishakh) correspondences with April 14, the International Mother Language Day (Shahid Day) (on 21st February) with 9th Falgun, the Independence Day (26th March) with 12th Chairtra and the Victory Day (16th December) with 2nd Paush.

For an ajax based Bangla Calendar, please download: 
`http://wordpress.org/extend/plugins/bangla-ajax-calendar/`

For a demonstration visit: `http://www.sajidmc.net/`

== Functions ==

= bongabdo($inputdate) =
Convert English Dates to Bangla Dates. Call the function `bongabdo($indate)` any where in your template to return the Bangla Date. $indate can be left blank. Otherwise it must be a date in the format of php `'d-M-Y'` (DD-MM-YYYY)

= number2bengunicode($content) =
Derived from a function written by Hasyn Haider of ekushey.org. This function converts roman numbers to Bangla Unicode numbers.

= the_bongabdodate() =
a replacement for the `the_date()` wordpress function

= get_the_bongabdodate() =
a replacement for the `get_the_date()` wordpress function

= is_beng() =
returns true if the current language is Bengali.


== Installation ==

1. Upload folder to the `/wp-content/plugins/bongabdo` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Why does the plugin show date in latin alphabet in my blog? =

The plugin is programmed to detect the current language of the blog, and only if the current language is `bn_BD`, `bn_IN` or any `bn_XX`, (i. e. Bengali), the date will be shown with Bengali alphabets, otherwise, the date will be shown in Latin alphabet. Alternatively, in Version 2.0, you can edit the line 30 of bongabdo.php, and set the value of `$beng_date_options['use bangla']` to 1

To set language of your blog, edit the `wp-config.php` file. Add the following lines there:
`define('DB_CHARSET', 'utf8');`
`define('WPLANG', 'bn_BD');`

= How do I insert current date somewhere?  =

Place `<?php bongabdo(); ?>` where you want the Bangla Date to appear.

= How do I show Bangla Unicode date?  =

To show Bangla Unicode date, the current language of blog must be Bangla (`bn_BD`) or (`bn_IN`), (See above);

= Can it be used with multilingual sites? =

Yes, partially. I'm using it with qTranslate. (http://www.sajidmc.net) It outputs date in English if the current language is not Bangla. On later versions, I'll release a full gettext supported plugin.

= Does this calendar support Indian calendar?  =

No

== Screenshots ==

For a working demo of this plugin, please visit `http://www.sajidmc.net`

1. This is the plugin installed in default installation of WP 3.0.1, No hacking is done, just the plugin activated.

2. Plugin hacked to force Bangla Output