<?php

class phpwebsectools_modules_htaccess_clean {

      
    protected $static_definitions = array();

    public function isStaticDefinition($inode) {
       if (is_dir($inode)) return false;       
	     $a = explode(".",$inode);
	     $ext = (count($a) > 1) ? array_pop($a) : null;
	     return strtolower($ext) == strtolower("static");
    }
    
        
    public function load_static_definitions() {
    
            $this->static_definitions = array();
            
            $dir = dirname(__FILE__).DIRECTORY_SEPARATOR.'htaccess_clean'.DIRECTORY_SEPARATOR.'definitions';
            
            $child_inodes = array();
	          if ($handle = opendir($dir)) {				        
		            while (false !== ($file = readdir($handle))) {		                
		                $child_inodes[] = $dir.DIRECTORY_SEPARATOR.$file;		                
                }
                closedir($handle);
            }
            
            
            foreach($child_inodes as $inode) {
                if ($this->isStaticDefinition($inode)) {
                    $this->static_definitions[] = file_get_contents($inode);
                }
            }                                      
    }
    
    function isHtaccess($inode) {
       if (is_dir($inode)) return false;
       $parts = explode(DIRECTORY_SEPARATOR,$inode);
       $file = array_pop($parts);
       return $file == ".htaccess"; 
    }

    public function clean_static($inode) {
                       
         if ($this->isHtaccess($inode)) {
             $modified = false;
             $php_file_content = file_get_Contents($inode);
                                      
             foreach($this->static_definitions as $definition) {
                                   
                 $clean_parts = explode($definition,$php_file_content);
                 
                 $result = implode("",$clean_parts);
                                                                                                      
                 if (0 != strcmp($php_file_content,$result)) {
                    $php_file_content = $result;
                    $modified = true;                                                              
                 }
             }                          
             if ($modified) {
                 $t = time();
                 rename($inode,$inode.'.infected.'.$t);                                                                    
                 if (false !== file_put_contents($inode,$php_file_content)) {
                     phpwebsectools::log("Cleaning .htaccess infection in $inode [success]");
                     @unlink($inode.'.infected.'.$t);
                     echo "<li class=\"cleaned\">$inode [cleaned]</li>";
                 } else {
                     phpwebsectools::log("Cleaning .htaccess infection in $inode [fail]");
                     echo "<li class=\"failed\">$inode [failed]</li>";
                 }
                 flush();
             }
         }           
    }
    
    public function clean($inode) {
        $this->clean_static($inode);     
    }
          
     public static function install() {
         global $phpwebsectools_clean_modules_classes;        
         if (!isset($phpwebsectools_clean_modules_classes)) $phpwebsectools_clean_modules_classes = array(); 
         $phpwebsectools_clean_modules_classes["htaccess_clean"] = "phpwebsectools_modules_htaccess_clean";    
     }
     
     
     function __construct($cleaner,$silent = false) {
         $this->load_static_definitions();
         if (!$silent) {                  
          ?>
          <p>PHP htaccess cleaner initialized...</p>
          <?php
          }
          $cleaner->addHandler(array($this,'clean'));         
     }
}



phpwebsectools_modules_htaccess_clean::install();