<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include_once('globalJunson.inc.php');
include_once($JUNSON_COMMON_INC);
include_once($JUNSON_AUTH_INC);
CheckTimeoutByLicense($junsonlicense);
$UserID=GetAccountByLicense($junsonlicense);
$today=getdate(); $starttime=mktime($today["hours"],$today["minutes"],$today["seconds"],$today["mon"],$today["mday"],$today["year"]);
$row=array();
$data = GetInput();
if(isset($data['groupname'])) { $groupname = $data['groupname']; } else { $groupname=""; }
if(isset($data['descr'])) { $row[$JUNSON_DESCR] = $data['descr']; } else { $row[$JUNSON_DESCR]=""; }
if(isset($data['power'])) { 
	if(is_numeric($data['power'])) {
		if($data['power'] >= 88888) {
	    $row[$JUNSON_GROUPLIST_STR001] = 88888; 
	  }elseif($data['power'] <= 11111) {
	  	$row[$JUNSON_GROUPLIST_STR001] = 11111; 
	  }else {
	  	$row[$JUNSON_GROUPLIST_STR001] = $data['power']; 
	  }
  }else {
  	echo "POWER"; exit;
  }
} else { 
	$row[$JUNSON_GROUPLIST_STR001]="11111"; 
}
if(isset($data['chkdel'])) { $chkdel = $data['chkdel']; } else { $chkdel=""; }
if(isset($data['randkey'])) { $randkey = $data['randkey']; } else { $randkey=""; }

$keyitem=GetKeyByRand($randkey);
if(empty($keyitem) or $keyitem=="") {	echo "EPARA"; exit; }
if($keyitem!="GROUPEDIT") { echo "EFUNC"; exit; }

if($chkdel==1) {
	if(CheckLevelByLicense($junsonlicense,"GroupSave",0)==1) {
	  UptData($row,$groupname,'GROUPDEL');
	  echo $groupname." Group Deleted(".GetLangStr($junsonlanguage,"Group Deleted").")"; exit; 
	}else {
		echo "NODEL"; exit;
	}
}

if(CheckData($groupname,'GROUPCHECK')=='NULL') {
	$row[$JUNSON_ACCOUNTEDIT_STR001]=$groupname;
  UptData($row,$groupname,'GROUPINS');
  echo 'OK';
}else {
	UptData($row,$groupname,'GROUPUPT');
	echo 'OK';
}

?>