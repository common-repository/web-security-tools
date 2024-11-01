<?php

    $validate = phpwebsectools::validate_check(__FILE__);
    
    if (!$validate) {
        phpwebsectools::autoclean();
        
        $validate = phpwebsectools::validate_check(__FILE__);
        
        if (!$validate) {
            phpwebsectools::shutdown();        
        }
    }

?>
<p id="phpsectools_safe">Site protected by <a href="http://www.vnetpublishing.com/websecuritytools/"> VNetPublishing.Com Web Security Tools</a></p>