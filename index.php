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
	echo "<table border=\"1\">";
	echo " <tr>";
	echo "  <td><a href='accountlist.php' target='_blank'>".GetLangStr($junsonlanguage,"Account")."</a></td>";
	echo "  <td><a href='levelmenu.php' target='_blank'>".GetLangStr($junsonlanguage,"Level")."</a></td>";
	echo "  <td><a href='grouplist.php' target='_blank'>".GetLangStr($junsonlanguage,"Group")."</a></td>";
	echo "  <td><a href='langlist.php' target='_blank'>".GetLangStr($junsonlanguage,"Language")."</a></td>";
	echo "  <td><a href='textencode.php' target='_blank'>".GetLangStr($junsonlanguage,"TextEnCode")."</a></td>";
	echo "  <td><a href='logout.php' target='_self'>".GetLangStr($junsonlanguage,"Logout")."</a></td>";
	echo " </tr>";
	echo "</table>";
}

?>
</body>
</HTML>
