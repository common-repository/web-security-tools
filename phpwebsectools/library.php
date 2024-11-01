<?php

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'config.php');

class phpwebsectools {
    static $logfile;
    

    public static function log($message) {
       if (!isset(self::$logfile)) {
           self::$logfile =$_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR.'websec.log';
       }    
       $str = gmdate("M d Y H:i:s") . "\t" . addslashes($message) . "\r\n";
       if ($fh = fopen(self::$logfile, 'a')) {
           fwrite($fh,$str);
           fclose($fh);
       }
    }

    public static function shutdown() {    
        self::log("Shutdown initiated!");
        require_once(dirname(__FILE__).DIRECTORY_SEPARATOR."shutdown.php");        
    }
    
    public static function autoclean() {
        global $phpwebsectools_path,
                $phpwebsectools_clean_modules,
                $phpwebsectools_clean_modules_path;
        self::log("Autoclean initiated");        
        require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'clean.php');        
        phpwebsectools_lib_clean::init_env();
        $cleaner = new phpwebsectools_lib_clean($phpwebsectools_path);
        $cleaner->loadModules($phpwebsectools_clean_modules_path,$phpwebsectools_clean_modules);          
        $cleaner->execute();        
    }
    
    public static function check_critical() {
           // Critical file check
           $src = $_SERVER["DOCUMENT_ROOT"] .DIRECTORY_SEPARATOR.ltrim($_SERVER["SCRIPT_NAME"],DIRECTORY_SEPARATOR);
           $checkfiles = array($src);
           $parts = explode(DIRECTORY_SEPARATOR,$src);
           
           while(count($parts) > 0) {               
               $dir = dirname(implode(DIRECTORY_SEPARATOR,$parts));
               array_pop($parts);
               if (@file_exists($dir.DIRECTORY_SEPARATOR.'.htaccess')) {
                   $checkfiles[] = $dir.DIRECTORY_SEPARATOR.'.htaccess';
               }
           }
           
           global $phpwebsectools_path,
                $phpwebsectools_clean_modules,
                $phpwebsectools_clean_modules_path;                   
           require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'clean.php');           
           $cleaner = new phpwebsectools_lib_clean($phpwebsectools_path);
           $cleaner->loadModules($phpwebsectools_clean_modules_path,$phpwebsectools_clean_modules,true);          
                                   
           foreach($checkfiles as $cf) {                
                    $cleaner->check_file($cf);
                    
           }
    }
    
    public static function validate_check($file) {
        $ds = DIRECTORY_SEPARATOR;
        
        if (!file_exists(dirname(__FILE__).$ds.".check_signature")) {
           self::log("Check signature built!");
           $data = file_get_contents(dirname(__FILE__).$ds.'lib'.$ds.'check.php');           
           file_put_contents(dirname(__FILE__).$ds.".check_signature",sha1($data));           
        }
        
        $real_signature = file_get_contents(dirname(__FILE__).$ds.".check_signature");
        $data = file_get_contents($file);   
        $signature = sha1($data);
        
        $ret = $signature == $real_signature;
        if ($ret) {
        
            self::check_critical();         
           
        } else {
           self::log("Check of $file failed!");
        }
        return $ret;                 
    }
    
    public static function check($file) {
        require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'check.php');
        phpwebsectools_check::check($file);
    }
   

}