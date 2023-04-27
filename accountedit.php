<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

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

$keytmp=explode("~",$keyitem);
if(count($keytmp)!=2) { echo GetLangStr($junsonlanguage,"ERROR: Parameter Fail ~"); exit; }
if(isset($keytmp[0])) { $modifiedAccount=$keytmp[0]; } else { $modifiedAccount=""; }
if(isset($keytmp[1])) { $modifiedGroup=$keytmp[1]; } else { $modifiedGroup=""; }

$UserListLevel=CheckLevelByLicense($junsonlicense,"UserEdit",1);
$UserID=GetAccountByLicense($junsonlicense);
$UserGROUP=GetAccountGroupByLicense($junsonlicense);

$GroupPower=array();
GetGroupPower($GroupPower);
$GroupItem=array();
$GroupItem=GetDataList("GETGROUPITEMASC",'','');
$LangItem=array();
$LangItem=GetDataList("GETLANGITEMALL",'','');

$tg=array();
$nGroup=count($GroupItem);
$n=0;
for($i=0;$i < $nGroup;$i++) {
	$tgroup=$GroupItem[$i][$JUNSON_ACCOUNTEDIT_STR001];
	$getflag=0;
	if($UserID==$modifiedAccount) {
		if($GroupPower[$tgroup] <= $GroupPower[$UserGROUP]) { $getflag=1; }
	}elseif($UserGROUP=='root') {  
		if($GroupPower[$tgroup] <= $GroupPower[$UserGROUP]) { $getflag=1; }
	}else {
    if($GroupPower[$tgroup] < $GroupPower[$UserGROUP]) { $getflag=1; }
  }
  if($getflag==1) { $tg[$n]=$tgroup; $n++;}
}

?>
<HTML><HEAD>
<meta charset="utf-8">
<link rel="stylesheet" href="css/material-design-iconic-font.css" />
<link rel="stylesheet" href="css/hs-menu.css" />
<script src='//code.jquery.com/jquery-2.1.3.min.js'></script>
<script src="js/jquery.hsmenu.js"></script>
<script> 
<?php
  echo "var Estr001='".GetLangStr($junsonlanguage,'Ajax request Fail~')."';";
  echo "var Estr002='".GetLangStr($junsonlanguage,'Not Modify ~ Parameter Empty~')."';";
  echo "var Estr003='".GetLangStr($junsonlanguage,'Not Modify ~ Function Error~')."';";
  echo "var Estr004='".GetLangStr($junsonlanguage,'Not Modify ~ Password Verify Not Match~')."';";
  echo "var Estr005='".GetLangStr($junsonlanguage,'Not Modify ~ Password Empty~')."';";
  echo "var Estr006='".GetLangStr($junsonlanguage,'Not Modify ~ Delete Not Permit~')."';";
  echo "var Estr007='".GetLangStr($junsonlanguage,'Not Modify ~ Modify Not Permit~')."';";
  echo "var Estr008='".GetLangStr($junsonlanguage,'OK')."';";
?>
$(document).ready ( function() {
	$(".hs-menubar").hsMenu(); 
	$('#chkpswd2').click(function() {
		if($('#chkpswd2:checked').val()) {
			$('#pswd2').attr('type','text');
		}else {
			$('#pswd2').attr('type','password');
		}
	});
	$('#chkpswd1').click(function() {
		if($('#chkpswd1:checked').val()) {
			$('#pswd').attr('type','text');
		}else {
			$('#pswd').attr('type','password');
		}
	});
  $('#edit').click(function() {
    $.ajax (
            {
              url:'accountupt.php',
              data:
              { userid: $('#userid').val(),
                account: $('#account').val(),
                pswd:$('#pswd').val(),
                pswd2: $('#pswd2').val(),
                uname: $('#uname').val(),
                ucell: $('#ucell').val(),
                uemail: $('#uemail').val(),
                ugroup: $('#ugroup').val(),
                ulang: $('#ulang').val(),
                stopyn: $('#stopyn').val(),
                chkdel: $('#chkdel:checked').val(),
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
                }else if(response=='VPSWD') { 
                	alert(Estr004);
                	document.getElementById('AfterEditMessage').innerHTML=Estr004;
                }else if(response=='EPSWD') { 
                	alert(Estr005);
                	document.getElementById('AfterEditMessage').innerHTML=Estr005;
                }else if(response=='NODEL') { 
                	alert(Estr006);
                	document.getElementById('AfterEditMessage').innerHTML=Estr006;
                }else if(response=='NOEDIT') { 
                	alert(Estr007);
                	document.getElementById('AfterEditMessage').innerHTML=Estr007;
                }else if(response=='OK') { 
                	alert(Estr008);
                	location.href='accountlist.php';
                }else if(response.indexOf('Deleted') > -1) {
                	alert(response); 
                	location.href='accountlist.php';
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
$UserData=array();
if($modifiedAccount=="NEW") {
	
}else {
  $UserData=GetDataList("USERLIST",$modifiedAccount,0);
}

echo "<br><br><br>";
echo "<table cellspacing='1' cellpadding='1' border='1' width='600'>";  
echo " <caption><font color='black' size='3'>".GetLangStr($junsonlanguage,"Account Edit")."</font></caption>";
echo "<thead>";
echo "  <tr bgcolor='#e2f5cf' valign='center' align='center'>";
echo "    <th><font size='2'>".GetLangStr($junsonlanguage,"Item")."</font></th>";
echo "    <th><font size='2'>".GetLangStr($junsonlanguage,"Value")."</font></th>";
echo "  </tr>";
echo "</thead>";

echo "<tbody>";

echo " <tr>";
echo "  <td>".GetLangStr($junsonlanguage,"Account")."</td>";
if($modifiedAccount=='NEW') {
	$UserData[0][$JUNSON_ACCOUNTEDIT_STR002]="";
	$UserData[0][$JUNSON_ACCOUNTLIST_STR004]="";
	$UserData[0][$JUNSON_ACCOUNTLIST_STR005]="";
	$UserData[0][$JUNSON_ACCOUNTLIST_STR006]="";
	$UserData[0][$JUNSON_ACCOUNTLIST_STR003]="";
	$UserData[0][$JUNSON_ACCOUNTLIST_STR007]="";
	$UserData[0][$JUNSON_STOPYN]="";
	echo "  <td><input type='text' id='account' size='20' maxlength='20'></td>";
} else {
  echo "  <td>".$modifiedAccount."<input type='hidden' id='account' value='".$modifiedAccount."' ></td>";
}
echo " </tr>";

echo " <tr>";
echo "  <td>".GetLangStr($junsonlanguage,"Password")."</td>";
echo "  <td><input type='password' id='pswd' value='".$UserData[0][$JUNSON_ACCOUNTEDIT_STR002]."' size='20' maxlength='20'>".GetLangStr($junsonlanguage,"Watched")."<input type='checkbox' id='chkpswd1'></td>";
echo " </tr>";

echo " <tr>";
echo "  <td>".GetLangStr($junsonlanguage,"Password Verify")."</td>";
echo "  <td><input type='password' id='pswd2' name='pswd2' size='20' maxlength='20'>".GetLangStr($junsonlanguage,"Watched")."<input type='checkbox' id='chkpswd2'></td>";
echo " </tr>";

echo " <tr>";
echo "  <td>".GetLangStr($junsonlanguage,"Username")."</td>";
echo "  <td><input type='text' id='uname' value='".$UserData[0][$JUNSON_ACCOUNTLIST_STR004]."' size='20' maxlength='20'></td>";
echo " </tr>";

echo " <tr>";
echo "  <td>".GetLangStr($junsonlanguage,"Cell")."</td>";
echo "  <td><input type='text' id='ucell' value='".$UserData[0][$JUNSON_ACCOUNTLIST_STR005]."' size='30' maxlength='30'></td>";
echo " </tr>";

echo " <tr>";
echo "  <td>".GetLangStr($junsonlanguage,"Email")."</td>";
echo "  <td><input type='text' id='uemail' value='".$UserData[0][$JUNSON_ACCOUNTLIST_STR006]."' size='50' maxlength='30'></td>";
echo " </tr>";

echo " <tr>";
echo "  <td>".GetLangStr($junsonlanguage,"Group")."</td>";
echo "  <td>";
echo "   <select id='ugroup'>";
$n=count($tg);
for($i=0; $i < $n;$i++) {
	if($UserData[0][$JUNSON_ACCOUNTLIST_STR003]==$tg[$i]) { $sel="selected"; } else { $sel=""; }
	echo "<option value='".$tg[$i]."' ".$sel.">".$tg[$i]."</option>";
}
echo "   </select>";
echo "  </td>";
echo " </tr>";

echo "  <td>".GetLangStr($junsonlanguage,"Language")."</td>";
echo "  <td>";
echo "   <select id='ulang'>";
$n=count($LangItem);
for($i=0; $i < $n;$i++) {
	$tmpLang=$LangItem[$i];
	if($UserData[0][$JUNSON_ACCOUNTLIST_STR007]==$tmpLang[$JUNSON_LEVELLIST_STR001]) { $sel="selected"; } else { $sel=""; }
	echo "<option value='".$tmpLang[$JUNSON_LEVELLIST_STR001]."' ".$sel.">".$tmpLang[$JUNSON_LEVELLIST_STR001]."</option>";
}
echo "   </select>";
echo "  </td>";
echo " </tr>";

$stoptmp[0]="N";
$stoptmp[1]="Y";
echo "  <td>".GetLangStr($junsonlanguage,"Stop")."</td>";
echo "  <td>";
echo "   <select id='stopyn'>";
$n=count($stoptmp);
for($i=0; $i < $n;$i++) {
	if($UserData[0][$JUNSON_STOPYN]==$stoptmp[$i]) { $sel="selected"; } else { $sel=""; }
	echo "<option value='".$stoptmp[$i]."' ".$sel.">".$stoptmp[$i]."</option>";
}
echo "   </select>";
echo "  </td>";
echo " </tr>";

echo " <tr>";
echo "  <td>".GetLangStr($junsonlanguage,"DeleteAccount")."</td>";
echo "  <td><input type='checkbox' id='chkdel' value='1'><font color='red'>".GetLangStr($junsonlanguage,"Will Delete This Account")."</font></td>";
echo " </tr>";

$keyA="ACCOUNTEDIT";
$randsnA=insRandKey($keyA,$modifiedAccount,$junsonlicense);
echo "<input type='hidden' id='randkey' name='randkey' value='".$randsnA."'>";
echo "<input type='hidden' id='userid' name='userid' value='".$UserID."'>";

echo " <tr>";
echo "  <td>".GetLangStr($junsonlanguage,"Action")."</td>";
if($modifiedAccount=='NEW') { $action=GetLangStr($junsonlanguage,"Add"); } else { $action=GetLangStr($junsonlanguage,"Modify"); }
echo "  <td><input name='edit' id='edit' type='submit' value='".$action."' >";
echo " </tr>";

echo " <tr><td colspan='2'>";
echo "  <font color='red'><span id=\"AfterEditMessage\"></span></font>";
echo " </td></tr>";

echo "</tbody>";
echo "</table>"; 

?>
</body>
</HTML>
