<?php

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'scan.php');

class phpwebsectools_lib_clean extends phpwebsectools_lib_scan {
        
                       
    function execute() {
	     ?>	     
           <p>Cleaning: <?php echo htmlentities($this->inode); ?></p>           
           <ul>
       <?php
           parent::execute();       
       ?>        
        <li><dl><dt>Cleaned inodes</dt><dd><?php echo $this->inode_count+0; ?></dd></dl></li>               
           </ul>
       <?php
    }
     
     
     static function init_env() {

         ?>
         <p>Initializing environment...</p>
         <?php
              
         set_time_limit(0);
         ignore_user_abort(true);
         ini_set('display_errors',1);
         error_reporting(E_ALL | E_STRICT);     
     }     
     
     function loadModules($modulePath,$modules,$silent = false) {
          global $phpwebsectools_clean_modules_classes;
          
          if (!isset($phpwebsectools_modules_classes)) $phpwebsectools_clean_modules_classes = array();
                               
          foreach($modules as $module) {
              if (!isset($phpwebsectools_clean_modules_classes[$module])) {
                  $module_source = $modulePath.DIRECTORY_SEPARATOR.$module.'.php';
                  if (!$silent) {                  
                  ?><p>Loading module: <?php echo htmlentities($module); ?></p><?php                  
                  }
                  require_once($module_source);
              }              
          }
                    
          foreach($modules as $module) {
              $className = $phpwebsectools_clean_modules_classes[$module];
              $module = new $className($this,$silent);
          }
     }
}
