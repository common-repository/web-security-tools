<?php

class_exists("phpwebsectools") || die();

class phpwebsectools_shutdown {

     public $htaccess_content;

     protected $time;
     
     function shutdown($file) {
         if (!isset($this->htaccess_content)) {
              $this->htaccess_content =  'ErrorDocument 503 "Our website is temporarily closed for maintenance. It should reopen shortly."'."\n"
                                .'RewriteEngine On'."\n"
                                . '# TO ALLOW YOURSELF TO VISIT THE SITE, CHANGE 111 222 333 444 TO YOUR IP ADDRESS.'."\n"
                                . 'RewriteCond %{REMOTE_ADDR} !^111\\.222\\.333\\.444$'."\n"
                                . 'RewriteRule .* - [R=503,L]'."\n";         
         
         }
         $parts = explode(DIRECTORY_SEPARATOR,$file);        
         $fname = array_pop($parts);         
         if ($fname == ".htaccess") {              
             $path = dirname($file);
             rename($file,$path.DIRECTORY_SEPARATOR.".htaccess.".$this->time);
             file_put_contents($file,$this->htaccess_content);         
         }     
     }
     
     function __construct() {
         $this->time = time();
     }     
}

global $phpwebsectools_path;

$shutdown = new phpwebsectools_shutdown();
 
$scan = new phpwebsectools_lib_scan($phpwebsectools_path);
$scan->addHandler(array($shutdown,"shutdown"));
$scan->execute();


