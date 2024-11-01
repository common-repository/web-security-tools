<?php   

global $phpwebsectools_path,$phpwebsectools_clean_modules,$phpwebsectools_clean_modules_path;
   
$phpwebsectools_path = $_SERVER["DOCUMENT_ROOT"];

$phpwebsectools_clean_modules = array("virus_clean","htaccess_clean","fix_perms");

$phpwebsectools_clean_modules_path = dirname(__FILE__).DIRECTORY_SEPARATOR."modules";

   
   
   	