<?
if(!isset($VT)) { die("Unauthorized access. #2"); } else { echo "<!-- Access Granted #P2 !-->"; }
// Import MySQL Class
include_once("mysql_connection.php");

// Set Connection variables
$DBServ = "register.webaynet.com";
$DBUser = "filteruser";
$DBPass = "!dadi!2006";
$DBName = "wfilter";

// Set minor database variables
if($VT == 0) {
	$softname = "NetPatron";
	$DBTable = "serverregusers";
	$InstallType = 6;
}
if($VT == 1) {
	$softname = "NetDadi";
	$DBTable = "dadiregusers";
	$InstallType = 3;
}
$ErrorType = "none";
$SQLActions = "failed";
$TD = false;
if($rr_vt = new bf_vt($DBServ,$DBUser,$DBPass,$DBName)) {
	$sorgu = $rr_vt->bf_vt_sqlsorgu("SELECT *  FROM `".$DBTable."` WHERE `dbInstallType` = ".$InstallType);
	if($rr_vt->bf_vt_numrows($sorgu)){
		$P = $rr_vt->bf_vt_sqldongu();
		$T = count($P);
		for($i=0;$i<$T;$i++) {
			if(($P[$i]['dbKKStatus'] == "") && ($TD == false)) {
				if($InstallType == 6) { $query = "UPDATE `serverregusers` SET `dbKKStatus` = '2', `dbLicenceCount` = '".$itotal."' WHERE dbGuid = '".$P[$i][0]."' LIMIT 1 ;"; }
				if($InstallType == 3) { $query = "UPDATE `dadiregusers` SET `dbKKStatus` = '2' WHERE dbGuid = '".$P[$i][0]."' LIMIT 1 ;"; }
				$rr_vt->bf_vt_sqlsorgu($query);
				$authcode = $P[$i][0];
				$SQLActions = "success";
				$TD = true;
			} else {
				$SQLActions = "failed";
				$ErrorType = "no_empty_key_data";
			}
		}
	} else {
		$SQLActions = "failed";
		$ErrorType = "empty_query_data";
	}
} else {
	$SQLActions = "failed";
	$ErrorType = "sql_connection_failed";
}

?>