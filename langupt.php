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
if(isset($data['langname'])) { $langname = $data['langname']; } else { $langname=""; }
if(isset($data['descr'])) { $row[$JUNSON_DESCR] = $data['descr']; } else { $row[$JUNSON_DESCR]=""; }
if(isset($data['stopyn'])) { $row[$JUNSON_STOPYN] = $data['stopyn']; } else { $row[$JUNSON_STOPYN]=""; }
if(isset($data['chkdel'])) { $chkdel = $data['chkdel']; } else { $chkdel=""; }
if(isset($data['randkey'])) { $randkey = $data['randkey']; } else { $randkey=""; }

$keyitem=GetKeyByRand($randkey);
if(empty($keyitem) or $keyitem=="") {	echo "EPARA"; exit; }
if($keyitem!="LANGEDIT") { echo "EFUNC"; exit; }

if($chkdel==1) {
	if(CheckLevelByLicense($junsonlicense,"LangSave",0)==1) {
	  UptData($row,$langname,'LANGDEL');
	  echo $langname." Language Deleted(".GetLangStr($junsonlanguage,"Language Deleted").")"; exit; 
	}else {
		echo "NODEL"; exit;
	}
}

if(CheckData($langname,'LANGCHECK')=='NULL') {
	$row[$JUNSON_LEVELLIST_STR001]=$langname;
  UptData($row,$langname,'LANGINS');
  echo 'OK';
}else {
	UptData($row,$langname,'LANGUPT');
	echo 'OK';
}

?>