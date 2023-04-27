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
if(isset($data['grouplevel'])) { $grouplevel = $data['grouplevel']; } else { $grouplevel=""; }
if(isset($data['group'])) { $group = $data['group']; } else { $group=""; }
if(isset($data['randkey'])) { $randkey = $data['randkey']; } else { $randkey=""; }

$keyitem=GetKeyByRand($randkey);
if(empty($keyitem) or $keyitem=="") {	echo "EPARA"; exit; }
if($keyitem!="GROUPLEVELEDIT") { echo "EFUNC"; exit; }

if(CheckLevelByLicense($junsonlicense,"GroupLevel",0) ==1) {
	if($grouplevel=="") {
		UptData(0,$group,'GROUPLEVELDEL');
    echo 'OK';
	}else {
		UptData(0,$group,'GROUPLEVELDEL');
	  $n=count($grouplevel);
    for($i=0;$i < $n;$i++) {
   		$row[$JUNSON_ACCOUNTLIST_STR003]=$group;
    	$row[$JUNSON_LEVELLIST_STR001]=$grouplevel[$i];
      UptData($row,$group,'GROUPLEVELINS');
    }
    echo 'OK';
	}
}else {
	echo "EDENY"; exit;
}

?>