<?php
$title = "首頁";
ob_start();
?>
<p>123</p>
<?php
$content = ob_get_clean();
include("template.php");
?>