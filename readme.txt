=== Web Security Tools === 

Contributors: rritoch, dritoch
Donate link: http://www.vnetpublishing.com/websecuritytools
Requires at least: 3.0
Tested up to: 3.2
Stable tag: 1.0.8
Tags: antivirus, scanner, spam, virus

== Description ==

VNet Publishing's Web Security tools will automatically monitor your site
for PHP viruses and .htaccess infections. If a problem is detected, the system 
will attempt to automatically clean your site using administrator-installed virus definitions. 
If the system is unable to clean a virus that has propegated through your system, 
the site will be shutdown by renaming all of your .htaccess files and installing a new 
.htaccess file which disables the site. 

== Installation ==

1. Upload and extract the plugin to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= How do I initiate a scan =

  You can initiate a scan by going to your admin dashboard and clicking the `WebSec Scan` link and then clicking the scan button. If you many files in your site than this may take a long time to complete.

= What features does this plugin provide? =

  1. The logger

All activity by the security tools is logged to a file named websec.log
which will be created in your document root folder.

  2. Custom Definitions

If you have found a PHP virus or htaccess infection then you will need to 
create a definition file. The definition file must contain the exact PHP code 
to be removed to disable the infection. The definition is placed in the definitions folder.

For A PHP Virus...

wp-content/plugins/web-security-tools/phpwebsectools/modules/virus_clean/definitions

For a .htaccess infection

wp-content/plugins/web-security-tools/phpwebsectools/modules/htaccess_clean/definitions

Definition files must be named with the extension of .static

Note: To automate removal of an infection without your web site shutting down,
the virus definition must exactly match the code the virus injected.
This includes spaces and hidden characters.

= How do I recover from an infection? =

  1. The first thing you must do is remove the virus. 
    To do this you can add the virus you have as a static virus definition file.
    If the security system has already shut down your site, you will need to
    rename or delete all of the .htaccess files on your site.
     
    Next open your browser to the folowing page on in your wordpress installation.
     
    `/wp-content/plugins/web-security-tools/phpwebsectools/clean.php`
            
  2. Once your site is clean, you will need to uninstall and reinstall this plugin
   with a fresh copy to ensure it has not been altered in any way by the infection.
   
  3. Modify or replace the .htaccess files created by this plugin to bring your
   site back online.   


== Changelog ==

= 1.0.3 =
* First public release      

= 1.0.4 =
* Minor bug fixes

= 1.0.5 =
* Serious bug fixes and new virus defintion

= 1.0.6 =
* Virus definition update
* Added stand alone configuration file

= 1.0.7 =
* Critical file check added
* htaccess cleaner added

= 1.0.8 =
* Removed logging of critical scan event
* Added logging of cleaning events
* Added new virus definition
* Added scanner to admin tools menu