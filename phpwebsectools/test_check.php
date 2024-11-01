<html><head><title>Test check</title></head>
<body>
<h1>Test Check</h1>
<?php


ini_set('display_errors',1);
error_reporting(E_ALL | E_STRICT); 

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'library.php');

phpwebsectools::check(__FILE__); 
 ?>
 </body>
 </html>