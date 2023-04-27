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
if(isset($data['userlevel'])) { $userlevel = $data['userlevel']; } else { $userlevel=""; }
if(isset($data['account'])) { $account = $data['account']; } else { $account=""; }
if(isset($data['randkey'])) { $randkey = $data['randkey']; } else { $randkey=""; }

$keyitem=GetKeyByRand($randkey);
if(empty($keyitem) or $keyitem=="") {	echo "EPARA"; exit; }
if($keyitem!="USERLEVELEDIT") { echo "EFUNC"; exit; }

if(CheckLevelByLicense($junsonlicense,"UserLevel",0) ==1) {
	if($userlevel=="") {
		UptData(0,$account,'USERLEVELDEL');
    echo 'OK';
	}else {
		UptData(0,$account,'USERLEVELDEL');
	  $n=count($userlevel);
    for($i=0;$i < $n;$i++) {
   		$row[$JUNSON_ACCOUNTLIST_STR002]=$account;
    	$row[$JUNSON_LEVELLIST_STR001]=$userlevel[$i];
      UptData($row,$account,'USERLEVELINS');
    }
    echo 'OK';
	}
}else {
	echo "EDENY"; exit;
}

?>