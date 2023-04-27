<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include_once('globalJunson.inc.php');
include_once($JUNSON_COMMON_INC);
include_once($JUNSON_AUTH_INC);
CheckTimeoutByLicense($junsonlicense);
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
<body>
<?php
include_once('header.php');
$today=getdate(); $starttime=mktime($today["hours"],$today["minutes"],$today["seconds"],$today["mon"],$today["mday"],$today["year"]);
  
$GroupListLevel=CheckLevelByLicense($junsonlicense,"GroupList",0);
$GroupList=array(); $GroupList=GetDataList("GETGROUPITEMALL",'',$GroupListLevel); 

echo "<br><br><br>";
echo "<table cellspacing='1' cellpadding='1' border='1' width='800'>";  
echo " <caption><font color='black' size='3'>".GetLangStr($junsonlanguage,"Group List")."</font></caption>";
echo "<thead>";
	$keyA="NEW";
  $randsnA=insRandKey($keyA,'NEW',$junsonlicense);
	echo "  <tr>";
	echo "      <td colspan='8'><a href='groupedit.php?param=".$randsnA."'><font size='2'>".GetLangStr($junsonlanguage,"New Group")."</font></a></td>";
  echo "  </tr>";
echo "  <tr bgcolor='#e2f5cf' valign='center' align='center'>";
echo "      <th><font size='2'>".GetLangStr($junsonlanguage,"Modify")."</font></th>";
echo "      <th><font size='2'>".GetLangStr($junsonlanguage,"GroupName")."</font></th>";
echo "      <th><font size='2'>".GetLangStr($junsonlanguage,"Description")."</font></th>";
echo "      <th><font size='2'>".GetLangStr($junsonlanguage,"Power")."</font></th>";
echo "  </tr>";
echo "</thead>";

echo "<tbody>";
$n=count($GroupList);
for($i=0;$i < $n;$i++) {
	$tmpData=$GroupList[$i];
	if($tmpData[$JUNSON_ACCOUNTEDIT_STR001]==$JUNSON_ROOT) {}else {
    echo "<tr>";
    $fcol="black";
    $keyA=$tmpData[$JUNSON_ACCOUNTEDIT_STR001];
    $randsnA=insRandKey($keyA,$tmpData[$JUNSON_ACCOUNTEDIT_STR001],$junsonlicense);
    echo "<td width='200' align='center'><a href='groupedit.php?param=".$randsnA."'><img src=images/pencil.png width='24'></img></a></td>";
    echo "<td width='200'><font size='2' color='".$fcol."'>".$tmpData[$JUNSON_ACCOUNTEDIT_STR001]."</font></td>"; 
    echo "<td width='200'><font size='2' color='".$fcol."'>".$tmpData[$JUNSON_DESCR]."</font></td>"; 
    echo "<td width='200'><font size='2' color='".$fcol."'>".$tmpData[$JUNSON_GROUPLIST_STR001]."</font></td>";
    echo "</tr>";
  }
}

echo "</tbody>";
echo "</table>";

?>
</body>
</HTML>
