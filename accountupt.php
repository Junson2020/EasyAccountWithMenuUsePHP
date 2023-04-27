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
if(isset($data['account'])) { $account = $data['account']; } else { $account=""; }
if(isset($data['userid'])) { $userid = $data['userid']; } else { $userid=""; }
if(isset($data['pswd'])) { $pswd = $data['pswd']; } else { $pswd=""; }
if(isset($data['pswd2'])) { $pswd2 = $data['pswd2']; } else { $pswd2=""; }
if(isset($data['uname'])) { $row[$JUNSON_ACCOUNTLIST_STR004] = $data['uname']; } else { $row[$JUNSON_ACCOUNTLIST_STR004]=""; }
if(isset($data['ucell'])) { $row[$JUNSON_ACCOUNTLIST_STR005] = $data['ucell']; } else { $row[$JUNSON_ACCOUNTLIST_STR005] =""; }
if(isset($data['uemail'])) { $row[$JUNSON_ACCOUNTLIST_STR006] = $data['uemail']; } else { $row[$JUNSON_ACCOUNTLIST_STR006]=""; }
if(isset($data['randkey'])) { $randkey = $data['randkey']; } else { $randkey=""; }
if(isset($data['ugroup'])) { $row[$JUNSON_ACCOUNTLIST_STR003] = $data['ugroup']; } else { $row[$JUNSON_ACCOUNTLIST_STR003]=""; }
if(isset($data['stopyn'])) { $row[$JUNSON_STOPYN] = $data['stopyn']; } else { $row[$JUNSON_STOPYN]=""; }
if(isset($data['chkdel'])) { $chkdel = $data['chkdel']; } else { $chkdel=""; }
if(isset($data['ulang'])) { $row[$JUNSON_ACCOUNTLIST_STR007] = $data['ulang']; } else { $row[$JUNSON_ACCOUNTLIST_STR007]=""; }

$keyitem=GetKeyByRand($randkey);
if(empty($keyitem) or $keyitem=="") {	echo "EPARA"; exit; }
if($keyitem!="ACCOUNTEDIT") { echo "EFUNC"; exit; }

if($chkdel==1) {
	if(CheckLevelByLicense($junsonlicense,"UserDEL",0)==1) {
	  UptData($row,$account,'ACCOUNTDEL');
	  echo $account." ".GetLangStr($junsonlanguage,"Account Deleted"); exit; 
	}else {
		echo "NODEL"; exit;
	}
}

if($userid!=$account) {
	if(CheckLevelByLicense($junsonlicense,"UserEdit",0)==1) {
		
	}else {
		echo "NOEDIT"; exit;
	}
}else {
  if($pswd!=$pswd2) { echo "VPSWD"; exit; }
}

if($pswd=='') { echo "EPSWD"; exit; } else {	$row[$JUNSON_ACCOUNTEDIT_STR002]=$pswd; }

if(CheckData($account,'ACCOUNTCHECK')=='NULL') {
	$row['u_account']=$account;
  UptData($row,$account,'ACCOUNTINS');
  echo 'OK';
}else {
	UptData($row,$account,'ACCOUNTUPT');
	echo 'OK';
}

?>