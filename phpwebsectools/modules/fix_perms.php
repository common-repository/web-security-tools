<?php

class phpwebsectools_modules_fix_perms {
     
     public $dirperm = 0755;
     public $fileperm = 0644;
          
     public static function install() {
         global $phpwebsectools_clean_modules_classes;        
         if (!isset($phpwebsectools_clean_modules_classes)) $phpwebsectools_clean_modules_classes = array(); 
         $phpwebsectools_clean_modules_classes["fix_perms"] = "phpwebsectools_modules_fix_perms";    
     }
     
     function fix($inode) {
          if (is_dir($inode)) {
              $perm = $this->dirperm;
          } else {
              $perm = $this->fileperm;
          }    
          @chmod($inode,$perm);         
     }
                  
     function __construct($cleaner,$silent = false) {
         $this->cleaner  = $cleaner;
         if (!$silent) {         
          ?>
          <p>Permission cleaner initialized...</p>
          <?php
          }
          $cleaner->addHandler(array($this,'fix'));         
     }
}

phpwebsectools_modules_fix_perms::install();
