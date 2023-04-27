<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include_once('globalJunson.inc.php');
include_once($JUNSON_COMMON_INC);
include_once($JUNSON_AUTH_INC);
?>
<HTML><HEAD>
<meta charset="utf-8">
<link rel="stylesheet" href="css/material-design-iconic-font.css" />
<link rel="stylesheet" href="css/hs-menu.css" />
<script src='//code.jquery.com/jquery-2.1.3.min.js'></script>
<script src="js/jquery.hsmenu.js"></script>
<script>
$(document).ready(function () {
  $(".hs-menubar").hsMenu(); 
}); 
</script>
</HEAD>
<body class="background">
<?php

if(empty($junsonlicense) or $junsonlicense=="") {
	header("Location: login.php");
  exit;
}else {
	include_once('header.php');
	echo '<iframe id="main" name="main" height="100%" width="100%"></iframe>';
}

?>
</body>
</HTML>
