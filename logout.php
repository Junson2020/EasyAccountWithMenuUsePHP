<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include_once('globalJunson.inc.php');
include_once($JUNSON_COMMON_INC);
include_once($JUNSON_AUTH_INC);

echo GetLangStr($junsonlanguage,"Logout OK~");

unset($_SESSION['junsonlicense']);
unset($_SESSION['junsonlanguage']);

echo '
<html>
<head>
<title>'.GetLangStr($junsonlanguage,"Logout").'</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv=refresh content=\'2;url=index.php\'>
</head>
</html>';
?>