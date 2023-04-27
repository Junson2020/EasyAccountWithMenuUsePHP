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
if(isset($data['levelname'])) { $levelname = $data['levelname']; } else { $levelname=""; }
if(isset($data['descr'])) { $row[$JUNSON_DESCR] = $data['descr']; } else { $row[$JUNSON_DESCR]=""; }
if(isset($data['stopyn'])) { $row[$JUNSON_STOPYN] = $data['stopyn']; } else { $row[$JUNSON_STOPYN]=""; }
if(isset($data['chkdel'])) { $chkdel = $data['chkdel']; } else { $chkdel=""; }
if(isset($data['randkey'])) { $randkey = $data['randkey']; } else { $randkey=""; }

$keyitem=GetKeyByRand($randkey);
if(empty($keyitem) or $keyitem=="") {	echo "EPARA"; exit; }
if($keyitem!="LEVELEDIT") { echo "EFUNC"; exit; }

if($chkdel==1) {
	if(CheckLevelByLicense($junsonlicense,"LevelSave",0)==1) {
	  UptData($row,$levelname,'LEVELDEL');
	  echo $levelname." Level Deleted(".GetLangStr($junsonlanguage,"Level Deleted").")"; exit; 
	}else {
		echo "NODEL"; exit;
	}
}

if(CheckData($levelname,'LEVELCHECK')=='NULL') {
	$row[$JUNSON_LEVELLIST_STR001]=$levelname;
  UptData($row,$levelname,'LEVELINS');
  echo 'OK';
}else {
	UptData($row,$levelname,'LEVELUPT');
	echo 'OK';
}

?>