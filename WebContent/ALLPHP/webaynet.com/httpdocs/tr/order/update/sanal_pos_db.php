<?
if(!isset($_POST['cardno'])) { die("Unauthorized Access"); }
@session_start();
// Import MySQL Class
include_once("mysql_connection.php");

// Set Connection variables 
/*
$DBServ = "register.webaynet.com";
$DBUser = "filteruser";
$DBPass = "!dadi!2006";
$DBName = "wfilter";
*/

$DBServ = "register.webaynet.com";
$DBUser = "filteruser";
$DBPass = "!dadi!2006";
$DBName = "wfilter";

// Set minor database variables
if($_GET['ptype'] == "NP") {
	$softname = "NetPatron";
	$DBTable = "serverregusers";
	$VT = 0;
}
if($_GET['ptype'] == "ND") {
	$softname = "NetDadi";
	$DBTable = "dadiregusers";
	$VT = 1;
}
if($_GET['ptype'] == "NC") {
	$softname = "NetPatronK";
	$DBTable = "ccserverusers";
	$VT = 2;
}
$ErrorType = "none";
$SQLActions = "failed";
if($rr_vt = new bf_vt($DBServ,$DBUser,$DBPass,$DBName)) {
		if($VT == 0) {$query = "UPDATE `".$DBTable."` SET `dbLicenceDays` = '".($_SESSION['dbData']['dbLicenceDays'] + 365)."', `dbLicenceCount` = '".$itotal."' WHERE dbGuid = '".$_SESSION['dbData']['dbGuid']."' LIMIT 1 ;";}
		if($VT == 1) {$query = "UPDATE `".$DBTable."` SET `dbLicenceDays` = '".($_SESSION['dbData']['dbLicenceDays'] + 365)."' WHERE `dbGuid` = '".$_SESSION['dbData']['dbGuid']."' LIMIT 1 ;";}
		if($VT == 2) {$query = "UPDATE `".$DBTable."` SET `dbLicenceDays` = '".($_SESSION['dbData']['dbLicenceDays'] + 365)."', `dbLicenceCount` = '".$itotal."' WHERE dbGuid = '".$_SESSION['dbData']['dbGuid']."' LIMIT 1 ;";}
		
		$rr_vt->bf_vt_sqlsorgu($query);
		$SQLActions = "success";
		$TD = true;
	} else {
	$SQLActions = "failed";
	$ErrorType = "sql_connection_failed";
}

?>