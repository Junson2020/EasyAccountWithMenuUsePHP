<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include_once('globalJunson.inc.php');
include_once($JUNSON_COMMON_INC);
include_once($JUNSON_AUTH_INC);
CheckTimeoutByLicense($junsonlicense);

$UserListLevel=CheckLevelByLicense($junsonlicense,"ENcode",1);

$today=getdate(); $starttime=mktime($today["hours"],$today["minutes"],$today["seconds"],$today["mon"],$today["mday"],$today["year"]);

$data = GetInput();
if(isset($data['randkey'])) { $param = $data['randkey']; } else { $param=""; }
if(isset($data['keyword'])) { $keyword = $data['keyword']; } else { $keyword=""; }

if($keyword!='') {
  $keyitem=GetKeyByRand($param);
  if(empty($keyitem) or $keyitem=="") {	
	  echo GetLangStr($junsonlanguage,"ERROR: Item Empty ~"); exit; 
  }else {
	  if($keyitem!="ENCODE") { echo GetLangStr($junsonlanguage,"ERROR: Function Error~"); exit; }
	  echo "<br><br><br>";
    echobr(GetLangStr($junsonlanguage,"Keyword")." => ".$keyword);
    echobr(GetLangStr($junsonlanguage,"Encode")." => ".enCodeText($keyword));
  }
}else {  
}

?>
<HTML><HEAD>
<meta charset="utf-8">
<link rel="stylesheet" href="../css/material-design-iconic-font.css" />
<link rel="stylesheet" href="../css/hs-menu.css" />
<script src='//code.jquery.com/jquery-2.1.3.min.js'></script>
<script src="../js/jquery.hsmenu.js"></script>
<script>
$(document).ready(function () {
  $(".hs-menubar").hsMenu(); 
}); 
</script>
</HEAD>
<body>
<?php
include_once('header.php');
echo "<br><br><br>";
echo "<form method='post' action='textencode.php' name='textencode'>";
echo "<table cellspacing='1' cellpadding='1' border='1' width='500'>";  
echo " <caption><font color='black' size='3'>".GetLangStr($junsonlanguage,"Encode Text")."</font></caption>";
echo "<thead>";
echo "  <tr bgcolor='#e2f5cf' valign='center' align='center'>";
echo "    <th><font size='2'>".GetLangStr($junsonlanguage,"Item")."</font></th>";
echo "    <th><font size='2'>".GetLangStr($junsonlanguage,"Value")."</font></th>";
echo "  </tr>";
echo "</thead>";

echo "<tbody>";

echo " <tr>";
echo "  <td>".GetLangStr($junsonlanguage,"Keyword")."</td>";
echo "  <td><input type='text' name='keyword' id='keyword' size='20' maxlength='30'></td>";
echo " </tr>";

$keyA="ENCODE";
$randsnA=insRandKey($keyA,$keyA,$junsonlicense);
echo "<input type='hidden' id='randkey' name='randkey' value='".$randsnA."'>";

echo " <tr>";
echo "  <td>".GetLangStr($junsonlanguage,"Action")."</td>";
$action=GetLangStr($junsonlanguage,"GO");  
echo "  <td><input name='edit' id='edit' type='submit' value='".$action."' >";
echo " </tr>";

echo "</tbody>";
echo "</table>"; 
echo "</form>";
?>
</body>
</HTML>
