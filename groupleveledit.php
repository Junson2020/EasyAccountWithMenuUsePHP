<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

session_start();

include_once('globalJunson.inc.php');
include_once($JUNSON_COMMON_INC);
include_once($JUNSON_AUTH_INC);
CheckTimeoutByLicense($junsonlicense);

$today=getdate(); $starttime=mktime($today["hours"],$today["minutes"],$today["seconds"],$today["mon"],$today["mday"],$today["year"]);

$data = GetInput();
if(isset($data['param'])) { $param = $data['param']; } else { $param=""; }

if(empty($param) or $param=="") {	echo GetLangStr($junsonlanguage,"ERROR: Parameter Empty ~"); exit; }

$keyitem=GetKeyByRand($param);
if(empty($keyitem) or $keyitem=="") {	echo GetLangStr($junsonlanguage,"ERROR: Item Empty ~"); exit; }

$UserListLevel=CheckLevelByLicense($junsonlicense,"GroupLevel",1);

?>
<HTML><HEAD>
<meta charset="utf-8">
<link href="css/multi-select.css" media="screen" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/material-design-iconic-font.css" />
<link rel="stylesheet" href="css/hs-menu.css" />
<script src='//code.jquery.com/jquery-2.1.3.min.js'></script>
<script src="js/jquery.hsmenu.js"></script>
<script src='js/jquery.multi-select.js'></script>
<script> 
<?php
  echo "var Estr001='".GetLangStr($junsonlanguage,'Ajax request Fail~')."';";
  echo "var Estr002='".GetLangStr($junsonlanguage,'Not Modify ~ Parameter Empty~')."';";
  echo "var Estr003='".GetLangStr($junsonlanguage,'Not Modify ~ Function Error~')."';";
  echo "var Estr004='".GetLangStr($junsonlanguage,'Not Modify ~ Level Deny Error~')."';";
  echo "var Estr005='".GetLangStr($junsonlanguage,'Not Modify ~ Group Level Duplicate Error~')."';";
  echo "var Estr008='".GetLangStr($junsonlanguage,'OK')."';";
  echo "var Fstr001='".GetLangStr($junsonlanguage,'Selectable items')."';";  
  echo "var Fstr002='".GetLangStr($junsonlanguage,'Selection items')."';";  
?>
$(document).ready ( function() {
	$(".hs-menubar").hsMenu(); 
	$('#grouplevel').multiSelect({
    	selectableHeader: "<div class='custom-header'>"+Fstr001+"</div>",
      selectionHeader: "<div class='custom-header'>"+Fstr002+"</div>"
  });
  $('#edit').click(function() {
    $.ajax (
            {
              url:'grouplevelupt.php',
              data:
              {
                grouplevel: $('#grouplevel').val(),
                group:$('#group').val(),
                randkey: $('#randkey').val()
              },
              error: function(xhr)
              {
                alert(Estr001);
              },
              success:function(response)
              { 
                if(response=='EPARA') {
                	alert(Estr002);
                	document.getElementById('AfterEditMessage').innerHTML=Estr002;
                }else if(response=='EFUNC') { 
                	alert(Estr003);
                	document.getElementById('AfterEditMessage').innerHTML=Estr003;
                }else if(response=='EDENY') { 
                	alert(Estr004);
                	document.getElementById('AfterEditMessage').innerHTML=Estr004;
                }else if(response=='EDOUB') { 
                	alert(Estr005);
                	document.getElementById('AfterEditMessage').innerHTML=Estr005;
                }else if(response=='OK') { 
                	alert(Estr008);
                  document.getElementById('#AfterEditMessage').innerHTML=response;
                }else {
                	alert(response);
                	document.getElementById('#AfterEditMessage').innerHTML=response;
                }
              }
    });
  });
});
</script>
</HEAD>
<body>
<?php
include_once('header.php');
$LevelData=array();
$LevelData=GetDataList("GETLEVELITEMALL",$keyitem,0);
$groupLevelData=array();
$groupLevelData=GetDataList("GETGROUPLEVELBYNAME",$keyitem,0);

$groupLevelStr="";
$n=count($groupLevelData);
for($i=0;$i < $n;$i++) {
	if($i==0) { $sp=""; } else { $sp=",";}
	$tmpAry=$groupLevelData[$i];
	$groupLevelStr=$groupLevelStr.$sp.$tmpAry[$JUNSON_LEVELLIST_STR001];
}
echo "<br><br><br>";
echo "<table cellspacing='1' cellpadding='1' border='1' width='800'>";  
echo " <caption><font color='black' size='3'>".GetLangStr($junsonlanguage,"Group Level Edit")."</font></caption>";
echo "<thead>";
echo "  <tr bgcolor='#e2f5cf' valign='center' align='center'>";
echo "    <th><font size='2'>".GetLangStr($junsonlanguage,"Item")."</font></th>";
echo "    <th><font size='2'>".GetLangStr($junsonlanguage,"Value")."</font></th>";
echo "  </tr>";
echo "</thead>";

echo "<tbody>";

echo " <tr>";
echo "  <td>".GetLangStr($junsonlanguage,"Group")."</td>";
echo "  <td>".$keyitem."<input type='hidden' id='group' value='".$keyitem."'></td>";
echo " </tr>";

echo "  <td>".GetLangStr($junsonlanguage,"Level")."</td>";
echo "  <td>";
echo "   <select id='grouplevel' multiple='multiple'>";
$n=count($LevelData);
for($i=0; $i < $n;$i++) {
	$tmpData=$LevelData[$i];
	if(strpos($groupLevelStr,$tmpData[$JUNSON_LEVELLIST_STR001]) >-1) { $sel="selected"; } else { $sel=""; }
	echo "<option value='".$tmpData[$JUNSON_LEVELLIST_STR001]."' ".$sel.">".$tmpData[$JUNSON_LEVELLIST_STR001]."(".$tmpData[$JUNSON_DESCR].")</option>";
}
echo "   </select>";
echo "  </td>";
echo " </tr>";

echo " <tr>";
echo "  <td>".GetLangStr($junsonlanguage,"Action")."</td>";
$action=GetLangStr($junsonlanguage,"Modify");
echo "  <td><input name='edit' id='edit' type='submit' value='".$action."' >";
echo " </tr>";

$keyA="GROUPLEVELEDIT";
$randsnA=insRandKey($keyA,$keyitem,$junsonlicense);
echo "<input type='hidden' id='randkey' name='randkey' value='".$randsnA."'>";

echo " <tr><td colspan='2'>";
echo "  <font color='red'><span id=\"AfterEditMessage\"></span></font>";
echo " </td></tr>";

echo "</tbody>";
echo "</table>"; 

?>
</body>
</HTML>
