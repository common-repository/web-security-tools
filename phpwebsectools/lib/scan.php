<?php

class phpwebsectools_lib_scan {

    protected $handlers = array();
    protected $inode_count = 0;
    protected $inode;
        
    protected function deep_scan($inode) {
    
        $child_inodes = array();        
        if (is_dir($inode)) {            
	          if ($handle = opendir($inode)) {				        
		            while (false !== ($file = readdir($handle))) {
                    if (!in_array($file,array(".",".."))) {                    		                
		                    $child_inodes[] = $inode.DIRECTORY_SEPARATOR.$file;
		                }
                }
            }
            closedir($handle);    
        }

        foreach($this->handlers as $handler) {
            call_user_func($handler,$inode);
        }
        
        $this->inode_count++;
        
        foreach($child_inodes as $child_inode) {
            $this->deep_scan($child_inode);
        }                         
    }
    
    function check_file($file) {
        if (!is_dir($cf)) {
            $this->deep_scan($this->inode);
        }
    }
                       
    function execute() {
        $this->inode_count = 0;
        $this->deep_scan($this->inode);
    }
          
    static function init_env() {              
         set_time_limit(0);
         ignore_user_abort(true);
         ini_set('display_errors',1);
         error_reporting(E_ALL | E_STRICT);     
    }
     
    function addHandler($callback) {
        $this->handlers[] = $callback;
    }     

    function __construct($inode) {
        $this->inode = $inode;
    }
     
}