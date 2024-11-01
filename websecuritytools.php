<?php

/**
 * @package Websecuritytools
 */

/*
Plugin Name: Web Security Tools
Plugin URI: http://www.vnetpublishing.com/websecuritytools
Description: Protect your site and immediatly lock-down if your security is compromised.. <br> VNet Publishings Web Security tools will automatically monitor your sitefor PHP viruses. If a virus is detected, the system will attempt to automatically clean your site using administrator installed virus definitions. If the system is unable to clean the infection, the site will be shutdown by renaming all of your .htaccess files and installing a new .htaccess file which disables the site.  
Version: 1.0.8
Author: Ralph Ritoch <rritoch@gmail.com>
Author URI: http://www.vnetpublishing.com
License: GPLv2 or later
*/

define('WEBSECURITYTOOLS_VERSION', '1.0.8');

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'admin.php');

function websecuritytools_lock() {
    require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'phpwebsectools'.DIRECTORY_SEPARATOR.'library.php');    
    phpwebsectools::check(dirname(dirname(dirname(dirname(__FILE__)))));
}

function websecuritytools_install() {   
    $check = dirname(dirname(dirname(dirname(__FILE__)))).DIRECTORY_SEPARATOR.'.phpwebscancheck';
    if (file_exists($check)) {
        unlink($check);
    }
}

function websecuritytools_init() {
     add_action('wp_footer', 'websecuritytools_lock');
}

add_action('init', 'websecuritytools_init');

add_action('activate_websecuritytools/websecuritytools.php', 'websecuritytools_install');

