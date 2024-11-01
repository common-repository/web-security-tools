<?php

class_exists("phpwebsectools") || die();

class phpwebsectools_check {
     
     static $checkname = ".phpwebscancheck";
     
     public static function check($directory) {
         if (!is_dir($directory)) {
             $directory = dirname($directory);
         }
         
         $ds = DIRECTORY_SEPARATOR;

         if (!file_exists($directory.$ds.self::$checkname)) {
             phpwebsectools::log("Creating check file in $directory");

             $tmpfile = tempnam( $directory , "sec");
             $checkfile = $tmpfile.'.php';
             file_put_contents($directory.$ds.self::$checkname,$checkfile);                                                                
             $src = file_get_contents(dirname(__FILE__).$ds.'lib'.$ds.'check.php');
             file_put_contents($checkfile,$src);
             @chmod($checkfile,0644);            
         }
                           
         $checkfile = file_get_contents($directory.$ds.self::$checkname);
        
        
         if (!file_exists($checkfile)) {
             phpwebsectools::log("Rebuilding check file $checkfile");
             $src = file_get_contents(dirname(__FILE__).$ds.'lib'.$ds.'check.php');
             file_put_contents($checkfile,$src);
             @chmod($checkfile,0644);                                  
         }
         
         require_once($checkfile);         
         
     }


}