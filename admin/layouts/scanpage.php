<h2>Web Security Tools Scanner</h2>

<script type="text/javascript">
 websecuritytools_scan = function()  {    
    document.getElementById('websectools_scan').setAttribute('src',unescape('<?php echo rawurlencode(get_option('siteurl'));?>')+"/wp-content/plugins/web-security-tools/phpwebsectools/clean.php");
    alert('Scan started. Please allow a few minutes for the scan to complete. Press ok to continue.');
    return false;
 }
</script>
<form method="get" action="#websectools_scan" onsubmit="return websecuritytools_scan()">
<input type="submit" value="Start Scan">
</form>

</form>
<iframe id="websectools_scan" style="border: 2px solid #808080;" border="2" width="80%" height="500">Scanner requires iFrame support</iframe>