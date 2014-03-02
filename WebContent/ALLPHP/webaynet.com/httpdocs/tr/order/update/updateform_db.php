<?
@session_start();
if(!isset($Load)) { die("Unauthorized access."); } 
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
$DBUser = "testuser";
$DBPass = "dia115599";
$DBName = "test_wfilter";

// Set database variables
if($_POST['pro'] == "nd")	{ $PTable = "dadiregusers";		$include = "netdkkform";	 $VerificationType = 1; }
if($_POST['pro'] == "np")	{ $PTable = "serverregusers";	$include = "netpkkform";	 $VerificationType = 0; }
if($_POST['pro'] == "npk")	{ $PTable = "ccserverusers";	$include = "netckkform";	 $VerificationType = 0; }
if($rr_vt = new bf_vt($DBServ,$DBUser,$DBPass,$DBName)) {
	$sorgu =  $rr_vt->bf_vt_sqlsorgu("SELECT * FROM `".$PTable."` WHERE `dbGuid` = '".$DBGuid."' LIMIT 0 , 1");
	if($rr_vt->bf_vt_numrows($sorgu)){
		$P = $rr_vt->bf_vt_sqldongu();
		$T = count($P);
		for($i=0;$i<$T;$i++) {
			$_SESSION['dbData']['dbGuid'] = $P[$i]['dbGuid'];
			$_SESSION['dbData']['dbinstallDate'] = $P[$i]['dbinstallDate'];
			$_SESSION['dbData']['dbLicenceDays'] = $P[$i]['dbLicenceDays'];
			$_SESSION['dbData']['dbLicenceCount'] = @$P[$i]['dbLicenceCount'];
			$NotFound = false;
			$includeFile = true;
		}
	}
}
?>