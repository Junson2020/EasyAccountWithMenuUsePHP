<?php

include_once('global.inc.php');

function enCodeText($tStr) {
	mt_srand((double)microtime()*1000000);
	$slen=strlen($tStr);
	$tflag=$slen;
	$retStr="";
	for($i=0;$i < $slen;$i++) {
		$rand=mt_rand(10000,99999).microtime(true);
		$rand=substr(md5($rand),0,$tflag);
		$retStr=$retStr.$rand.$tStr[$i];
		$tflag--;
	}
	return $retStr;
}

function deCodeText($tStr) {
	$slen=strlen($tStr);
	$n=1; $m=0;
	for($i=0;$i < $slen;$i++) {
		$n=$n+$i+1;
		if($n >= $slen) { break; }
		$m++;
	}
	$tflag=$m;
	$retStr="";
	$tmpStr=$tStr;
	$tmpLen=$slen;
	for($i=$tflag;$i > 0;$i--) {
	  if($i == $tflag) {
			$tmpLen=$tmpLen-$i;
			$tmpStr=substr($tmpStr,$i,$tmpLen);
		}else { 
			$tmpLen=$tmpLen-$i-1; 
			$tmpStr=substr($tmpStr,$i+1,$tmpLen);
		}
		$retStr=$retStr.substr($tmpStr,0,1);
	}
	return $retStr;
}
/* 連結資料庫 */
function GetDBH() {
	global $JUNSON_DB_USER;
	global $JUNSON_DB_ACCOUNT;
	global $JUNSON_DB_PASSWORD;
	global $JUNSON_DB_HOST;
	
  $arg_list = func_get_args();
  $db = '';
  if(isset($arg_list[0])) { $db = trim($arg_list[0]); }

  if(preg_match("/^(".$JUNSON_DB_USER.")$/i", $db)) {
    $dbuser = deCodeText($JUNSON_DB_ACCOUNT);
    $dbpwd  = deCodeText($JUNSON_DB_PASSWORD);
    $dbname = strtolower($JUNSON_DB_USER);
  }else {
  	$dbuser="";
  	$dbpwd="";
  	$dbname="";
  }
  
  if($dbname!="") {
  	$dbh = new mysqli(deCodeText($JUNSON_DB_HOST), $dbuser, $dbpwd, $dbname);
  	if ($dbh->connect_error) {
  	  PrintMesg('DB Connect Error:',$db);
  	}
    $dbh->set_charset("utf8mb4");
  }else {
    PrintMesg('Please Setup DB Name',$db);
  }
  return $dbh;
}

/* 傳回 $_GET 或 $_POST 的值, 並且過濾不合法字元 */
function GetInput() {
  return strfilter(!empty($_POST) ? $_POST : (!empty($_GET) ? $_GET : ''));
}

/* 過濾不當字元 */
function strfilter($val) {
  return is_array($val) ? array_map('strfilter', $val) : trim(preg_replace('/[<>"\']/', '', $val));
}

/* 訊息畫面, 並且離開程式 */
function PrintMesg($error,$mesg) {
  //echo $mesg . "\n";
  $mesg=urlencode($mesg);
  $error=urlencode($error);
  header("Location: mesgprint.php?error=".$error."&msg=".$mesg);
  exit;  
}

function echobr($msg) {
	echo $msg."</br>";
}

function echoary($arytmp) {
	print_r($arytmp);
}

function GetAccountByLicense($userlicense) {
	global $JUNSON_DB_USER;
	$mydbh=GetDBH($JUNSON_DB_USER);
	$account="";
  $myresult = $mydbh->prepare("select u_account from `userlicenseall` where `licensenumber`=?");
  $myresult->bind_param("s", $userlicense);
  $myresult->execute();
  $myresult->store_result();
  $myresult->bind_result($userAccount);
  if ($myresult->num_rows > 0) {	
	  $row = $myresult->fetch();
	  $account=$userAccount;
  }else { $account="NULL"; }
  mysqli_close($mydbh);
  return $account;
}

function CheckAccountLogin($uaccount,$upswd) {
	global $JUNSON_DB_USER;
	$mydbh=GetDBH($JUNSON_DB_USER);
  $myresult = $mydbh->prepare("select u_name,u_group,u_language from userinfo where u_account=? and u_pswd=? and stopyn ='N'");
  $myresult->bind_param("ss", $uaccount,$upswd);
  $myresult->execute();
  $myresult->store_result();
  $myresult->bind_result($uname,$ugroup,$ulanguage);
  if ($myresult->num_rows > 0) {
	  $row = $myresult->fetch();
	  $retD=$uname.",".$ugroup.",".$ulanguage;
  }else { $retD="NULL"; }
  mysqli_close($mydbh);
  return $retD;
}

function CheckRandomLogin($ulicense,$randpswd) {
	global $JUNSON_DB_USER;
	$mydbh=GetDBH($JUNSON_DB_USER);
  $myresult = $mydbh->prepare("select pswd from randpswd where licensenumber=?");
  $myresult->bind_param("s", $ulicense);
  $myresult->execute();
  $myresult->store_result();
  $myresult->bind_result($unumber);
  if ($myresult->num_rows > 0) {
	  $row = $myresult->fetch();
	  if($unumber==$randpswd) {
	  	$retD="PASS";
	  }else{
	  	$retD="NULL";
	  }
  }else { $retD="NULL"; }
  mysqli_close($mydbh);
  return $retD;
}

function InsSuccessLogin($username,$uName,$stepTwo,$endtime,$uGroup,$uLanguage) {
	global $JUNSON_DB_USER;
	$mydbh=GetDBH($JUNSON_DB_USER);
  $InsSQL="insert into userlicenseall (ulid,u_account,u_name,licensenumber,endtime,u_group,u_language) values (NULL,'$username','$uName','$stepTwo','$endtime','$uGroup','$uLanguage')";	
  try {
    $myst = $mydbh->prepare($InsSQL);
    $myst->execute();
  }catch (Exception $e) {
		PrintMesg("ERROR: SQL:",$e->getMessage());
	}
	mysqli_close($mydbh);
}

function GetLicenseRandom($userlicense) {
	global $JUNSON_DB_USER;
	$mydbh=GetDBH($JUNSON_DB_USER);
  $myresult = $mydbh->prepare("select pswd from `randpswd` where `licensenumber`=?");
  $myresult->bind_param("s", $userlicense);
  $myresult->execute();
  $myresult->store_result();
  $myresult->bind_result($userPswd);
  if ($myresult->num_rows > 0) {	
	  $row = $myresult->fetch();
	  $pswd=$userPswd;
  }else { $pswd="NULL"; }
  mysqli_close($mydbh);
  return $pswd;
}

function InsLicenseRandom($userlicense,$randpswd) {
	global $JUNSON_DB_USER;
	$mydbh=GetDBH($JUNSON_DB_USER);
  $InsSQL="insert into randpswd (licensenumber,pswd) values ('$userlicense','$randpswd')";	
  try {
    $myst = $mydbh->prepare($InsSQL);
    $myst->execute();
  }catch (Exception $e) {
		PrintMesg("ERROR: SQL:",$e->getMessage());
	}
	mysqli_close($mydbh);
}

function UptLicenseRandom($userlicense,$randpswd) {
	global $JUNSON_DB_USER;
	$mydbh=GetDBH($JUNSON_DB_USER);
  $uptSQL="update randpswd set pswd= '$randpswd' where licensenumber='$userlicense'";
  try {
    $myst = $mydbh->prepare($uptSQL);
    $myst->execute();
  }catch (Exception $e) {
		PrintMesg("ERROR: SQL:",$e->getMessage());
	}
	mysqli_close($mydbh);
}

function CheckTimeoutByLicense($userlicense) {
	global $JUNSON_DB_USER;
	$mydbh=GetDBH($JUNSON_DB_USER);
	$today=getdate(); $nowtime=mktime($today["hours"],$today["minutes"],$today["seconds"],$today["mon"],$today["mday"],$today["year"]);
	try {
    $myresult = $mydbh->prepare("select endtime from `userlicenseall` where `licensenumber`=?");
    $myresult->bind_param("s", $userlicense);
    $myresult->execute();
    $myresult->store_result();
    $myresult->bind_result($endtime);
    if ($myresult->num_rows > 0) {
	    $row = $myresult->fetch();
	    $etime=$endtime;
    }else { $etime=""; }
  }catch (Exception $e) {
		PrintMesg('ERROR: SQL:',$e->getMessage());
	}
  mysqli_close($mydbh);
  if($etime < $nowtime or $etime=="") {
    PrintMesg('License Timeout','License Timeout');
  }else {
  }
  return $nowtime.",".$etime;
}

function CheckLevelByLicense($userlicense,$func,$ret) {
	global $JUNSON_DB_USER;
	$mydbh=GetDBH($JUNSON_DB_USER);
  $myresult = $mydbh->prepare("select u_account,u_group from `userlicenseall` where `licensenumber`=?");
  $myresult->bind_param("s", $userlicense);
  $myresult->execute();
  $myresult->store_result();
  $myresult->bind_result($userAccount,$userGroup);
  if ($myresult->num_rows > 0) {	
	  $row = $myresult->fetch();
	  $account=$userAccount;
	  $group=$userGroup;	  
  }
  $LevelFlag=0;
  $chklicense="select `lname` from `userlevel` where `u_account`='".$account."' and `lname`='".$func."' ";
  $myresult=$mydbh->query($chklicense);
  if($rowU = $myresult->fetch_assoc()){
  	$LevelFlag=1;
  }else {
  	$chklicense2="select `lname` from `grouplevel` where `u_group`='".$group."' and `lname`='".$func."' ";
    $myresult2=$mydbh->query($chklicense2);
    if($rowG = $myresult2->fetch_assoc()){
    	$LevelFlag=1;
    }
  }
  mysqli_close($mydbh);
  if($ret==0) {
    if($LevelFlag==0) {
  	  PrintMesg('Error: Level Deny',$func);
    }else{
    	return $LevelFlag;
    }
  }else {
  	return $LevelFlag;
  }
}

function GetAccountGroupByLicense($userlicense) {
	global $JUNSON_DB_USER;
	$mydbh=GetDBH($JUNSON_DB_USER);
  $myresult = $mydbh->prepare("select u_group from `userlicenseall` where `licensenumber`=?");
  $myresult->bind_param("s", $userlicense);
  $myresult->execute();
  $myresult->store_result();
  $myresult->bind_result($userGroup);
  if ($myresult->num_rows > 0) {
	  $row = $myresult->fetch();
	  $groupa=$userGroup;
  }else { $group="NULL"; }
  mysqli_close($mydbh);
  return $groupa;
}

function insRandKey($key,$value,$license) {
	global $JUNSON_DB_USER;
	$mydbh=GetDBH($JUNSON_DB_USER);
	mt_srand((double)microtime()*1000000);
	$today=getdate(); $nowtime=mktime($today["hours"],$today["minutes"],$today["seconds"],$today["mon"],$today["mday"],$today["year"]);
  $randtime = microtime(true);
	$tmp=$license.$nowtime.$randtime.$value.mt_rand(111111,999999);
  $randsn=md5($tmp);
  try {
    $mystA = $mydbh->prepare("insert into `randkey` (`randsn`,`keyitem`,`addtime`) values (?,?,?)");
	  $mystA->bind_param("sss", $randsn,$key,$nowtime);
    $mystA->execute();      
  }catch (Exception $e) {
		PrintMesg("ERROR: SQL:",$e->getMessage());
	}
  mysqli_close($mydbh);
  return $randsn;
}

function GetKeyByRand($rkey) {
	global $JUNSON_DB_USER;
	$mydbh=GetDBH($JUNSON_DB_USER);
	$keyitem="";
  $myresult = $mydbh->prepare("select keyitem,addtime from `randkey` where `randsn`=? order by addtime desc");
  $myresult->bind_param("s", $rkey);
  $myresult->execute();
  $myresult->store_result();
  $myresult->bind_result($keytmp,$addtime);
  if ($myresult->num_rows > 0) {
    $row = $myresult->fetch();
    $today=getdate(); $nowtime=mktime($today["hours"],$today["minutes"],$today["seconds"],$today["mon"],$today["mday"],$today["year"]);
    if(($addtime+600) < $nowtime) {
    	$keyitem="";
    }else {
      $keyitem=$keytmp;
    }
  }
  mysqli_close($mydbh);
  return $keyitem;
}

function CheckData($key,$func) {
	global $JUNSON_DB_USER;
	$mydbh=GetDBH($JUNSON_DB_USER);
	if($func=="ACCOUNTCHECK") {
		$myresult = $mydbh->prepare("select u_account from `userinfo` where `u_account`=?");
    $myresult->bind_param("s", $key);
	}elseif($func=="LEVELCHECK") {
		$myresult = $mydbh->prepare("select lname from `levelitem` where `lname` like ?");
		$key2="%$key%";
    $myresult->bind_param("s", $key2);
	}elseif($func=="USERLEVELCHECK") {
		if(strpos($key,"~") > -1) {
			$tmpk=explode("~",$key);
			if(count($tmpk) ==2) {
				$keyA=$tmpk[0];
				$keyB=$tmpk[1];
			}else {
				return "NULL";
			}
		}else {
			return "NULL";
		}
		$myresult = $mydbh->prepare("select lname from `userlevel` where `u_account`=? and `lname` =?");
    $myresult->bind_param("ss", $keyA,$keyB);
	}elseif($func=="GROUPCHECK") {
		$myresult = $mydbh->prepare("select gname from `groupitem` where `gname` like ?");
		$key2="%$key%";
    $myresult->bind_param("s", $key2);
	}elseif($func=="LANGCHECK") {
		$myresult = $mydbh->prepare("select lname from `langitem` where `lname` like ?");
    $key2="%$key%";
    $myresult->bind_param("s", $key2);
	}
  $myresult->execute();
  $myresult->store_result();
  $myresult->bind_result($userID);
  if ($myresult->num_rows > 0) {
	  $row = $myresult->fetch();
	  $retD=$userID;
  }else { $retD="NULL"; }
  mysqli_close($mydbh);
  return $retD;
}

function UptData($row,$key,$func) {
	global $JUNSON_DB_USER;
	$mydbh=GetDBH($JUNSON_DB_USER);
	$itemStr="";
  $valueStr="";
	if(strpos($func,"UPT") > -1) {
		$n=0;
		foreach( $row as $item => $value) {
			$tmpV=mysqli_real_escape_string($mydbh,$value);
		  if(strpos($tmpV,"NULL") > -1 or $tmpV=='') {
		  	$tmpV="''";
		  }else {
		  	$tmpV="'".$tmpV."'";
		  }
		  if($n==0) {
		  	$valueStr=$valueStr.$item."=".$tmpV;
		  }else {
		  	$valueStr=$valueStr." ,".$item."=".$tmpV;
		  }
		  $n++;
		}
	}elseif(strpos($func,"INS") > -1) {
		$n=0;
		foreach( $row as $item => $value) {
			$tmpV=mysqli_real_escape_string($mydbh,$value);
		  if(strpos($tmpV,"NULL") > -1 or $tmpV=='') {
		  	$tmpV="''";
		  }else {
		  	$tmpV="'".$tmpV."'";
		  }
		  if($n==0) {
		  	$itemStr=$itemStr.$item;
		  	$valueStr=$valueStr.$tmpV;
		  }else {
		  	$itemStr=$itemStr.",".$item;
		  	$valueStr=$valueStr.",".$tmpV;
		  }
		  $n++;
		}
	}
	
	if($func=="ACCOUNTUPT") {
		$UptSQL="update userinfo set ".$valueStr." where u_account='".$key."'";
  }elseif($func=="ACCOUNTINS") {
  	$UptSQL="insert into userinfo (".$itemStr.") values (".$valueStr.")";
  }elseif($func=="LEVELUPT") {
		$UptSQL="update levelitem set ".$valueStr." where lname='".$key."'";
  }elseif($func=="LEVELINS") {
  	$UptSQL="insert into levelitem (".$itemStr.") values (".$valueStr.")";
  }elseif($func=="GROUPUPT") {
		$UptSQL="update groupitem set ".$valueStr." where gname='".$key."'";
  }elseif($func=="GROUPINS") {
  	$UptSQL="insert into groupitem (".$itemStr.") values (".$valueStr.")";
  }elseif($func=="ACCOUNTDEL") {
  	$UptSQL="delete from userinfo where u_account='".$key."'";
  }elseif($func=="LEVELDEL") {
  	$UptSQL="delete from levelitem where lname='".$key."'";
  }elseif($func=="GROUPDEL") {
  	$UptSQL="delete from groupitem where gname='".$key."'";
  }elseif($func=="USERLEVELINS") {
  	$UptSQL="insert into userlevel (".$itemStr.") values (".$valueStr.")";
  }elseif($func=="USERLEVELDEL") {
  	$UptSQL="delete from userlevel where u_account='".$key."'";
  }elseif($func=="GROUPLEVELINS") {
  	$UptSQL="insert into grouplevel (".$itemStr.") values (".$valueStr.")";
  }elseif($func=="GROUPLEVELDEL") {
  	$UptSQL="delete from grouplevel where u_group='".$key."'";
  }elseif($func=="LANGDEL") {
  	$UptSQL="delete from langitem where lname='".$key."'";
  }elseif($func=="LANGUPT") {
		$UptSQL="update langitem set ".$valueStr." where lname='".$key."'";
  }elseif($func=="LANGINS") {
  	$UptSQL="insert into langitem (".$itemStr.") values (".$valueStr.")";
  }
  try {
    $myst = $mydbh->prepare($UptSQL);
    $myst->execute();
  }catch (Exception $e) {
		PrintMesg("ERROR: SQL:",$e->getMessage());
	}
  mysqli_close($mydbh);
  return $UptSQL;
}

function GetDataList($func,$item,$UserFlag) {
  global $JUNSON_DB_USER;
	$mydbh=GetDBH($JUNSON_DB_USER);
	$DataList=array();
	if($func=='USERLIST') {
		$UserID=$item;
    if($UserFlag==1) { $GETdata="select * from `userinfo`"; } else { $GETdata="select * from `userinfo` where `u_account`='".$UserID."'"; }
  }elseif($func=="GETGROUPITEM") {
  	$GETdata="select gname from groupitem order by power desc";
  }elseif($func=="GETGROUPITEMASC") {
  	$GETdata="select gname from groupitem order by power asc";
  }elseif($func=="GETLEVELITEMALL") {
  	$GETdata="select * from levelitem";
  }elseif($func=="GETUSERLEVEL") {
  	$GETdata="select lname from userlevel where u_account='".$item."'";
  }elseif($func=="GETLEVELITEM") {
  	$GETdata="select * from levelitem where lname='".$item."'";
  }elseif($func=="GETGROUPITEMALL") { 
  	$GETdata="select * from groupitem ";
  }elseif($func=="GETGROUPITEMBYNAME") { 
  	$GETdata="select * from groupitem where gname='".$item."'";
  }elseif($func=="GETGROUPLEVELBYNAME") { 
  	$GETdata="select * from grouplevel where u_group='".$item."'";
  }elseif($func=="GETLANGITEMALL") {
  	$GETdata="select * from langitem";
  }elseif($func=="GETLANGITEM") {
  	$GETdata="select * from langitem where lname='".$item."'";
  }  
  
  try {
    $alldataresult=$mydbh->query($GETdata);
    while($row = $alldataresult->fetch_assoc()){
    	array_push($DataList,$row);
    }
	}catch (Exception $e) {
		PrintMesg("ERROR: SQL:",$e->getMessage());
	}
  mysqli_close($mydbh);
  return $DataList;
}

function GetGroupPower(&$GroupPower) {
  global $JUNSON_DB_USER;
	$mydbh=GetDBH($JUNSON_DB_USER);
  $GetAllGroup="select gname,power from groupitem order by power desc";
  try {
    $allgroupresult=$mydbh->query($GetAllGroup);
    while($rowGroup = $allgroupresult->fetch_assoc()){
    	$gname=$rowGroup['gname'];
    	$power=$rowGroup['power'];
    	$GroupPower[$gname]=$power;
    }
	}catch (Exception $e) {
		PrintMesg("ERROR: SQL:",$e->getMessage());
	}
  mysqli_close($mydbh);
  return $GroupPower;
}

function GetLangStr($lang,$wording) {
  global $JUNSON_DB_USER;
	$mydbh=GetDBH($JUNSON_DB_USER);
	if($lang=='en') {
		return $wording;
	}else {
    $myresult = $mydbh->prepare("select trans from langword where lang=? and wording=?");
    $myresult->bind_param("ss", $lang,$wording);
    $myresult->execute();
    $myresult->store_result();
    $myresult->bind_result($trans);
    if ($myresult->num_rows > 0) {
    	$row = $myresult->fetch();
	    $retD=$trans;
    }else {
    	$retD=$wording;
    }
    mysqli_close($mydbh);
    return $retD;
  }
}

function log2db($s,$func) {
	global $JUNSON_DB_USER;
	$mydbh=GetDBH($JUNSON_DB_USER);
	$today=getdate();
  $logtime=mktime($today["hours"],$today["minutes"],$today["seconds"],$today["mon"],$today["mday"],$today["year"]);
  try {
    $myst = $mydbh->prepare("insert into `logdata` (`logid`,`logtext`,`logtime`,`logfrom`) values (NULL,?,?,?)");
    $myst->bind_param("sss", $s,$logtime,$func);
    $myst->execute();	
	}catch (Exception $e) {
		PrintMesg("ERROR: SQL:",$e->getMessage());
	}
  mysqli_close($mydbh);
}

?>
