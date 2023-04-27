<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
header ('Content-Type: text/html; charset=utf-8');
include_once('globalJunson.inc.php');
include_once($JUNSON_COMMON_INC);
include_once($JUNSON_AUTH_INC);

$data = GetInput();
if (isset($data['msg'])) { $msg=$data['msg']; } else { $msg=""; }
if (isset($data['error'])) { $error=$data['error']; } else { $error=""; }

if($msg!='' or $error!='') {
	$msg = urldecode($msg); 
	$error = urldecode($error);
	$message=GetLangStr($junsonlanguage,$error).$msg;
	echo $message;
}else {
	echo GetLangStr($junsonlanguage,"Empty Message~");
}
echo "<br><a href='index.php'>".GetLangStr($junsonlanguage,"Home")."</a>";
if(strpos($error,"License Timeout") >-1) {
	echo "<br><a href='logout.php'>".GetLangStr($junsonlanguage,"Logout")."</a>";
}
exit;
?>