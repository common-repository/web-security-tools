<?php

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR."stand_alone_config.php");
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR."library.php");

?>
<html><head><title></title></head><body>
<h1>PHP Antivirus Cleaner</h1>
<?php
    phpwebsectools::autoclean();
?>
</body>
</html>