<?
if(!isset($Load)) { die("Unauthorized access."); } 
// Import MySQL Class
include_once("mysql_connection.php");

// Set Connection variables 
$DBServ = "register.webaynet.com";
$DBUser = "filteruser";
$DBPass = "!dadi!2006";
$DBName = "wfilter";
/*
$DBServ = "register.webaynet.com";
$DBUser = "testuser";
$DBPass = "dia115599";
$DBName = "test_wfilter";
*/
// Set database variables
$DBTables[0] = "ccserverusers"; 	$ProductName[0] = "NETPATRON CAFE SÜRÜMÜ(TIB ONAYLI)";	$ProductType[0] = "NPK";
$DBTables[1] = "dadifreeusers";		$ProductName[1] = "NETDADI TEST SÜRÜMÜ";				$ProductType[1] = "NDD";
$DBTables[2] = "dadiregusers";		$ProductName[2] = "NETDADI BIREYSEL KULLANIM";			$ProductType[2] = "NDN";
$DBTables[3] = "serverregusers";	$ProductName[3] = "NETPATRON SIRKET SÜRÜMÜ";			$ProductType[3] = "NPN";

if($rr_vt = new bf_vt($DBServ,$DBUser,$DBPass,$DBName)) {
	$j = $f = 0;
	$Fount = false;
	foreach($DBTables as $DBTable) {
		$sorgu = $rr_vt->bf_vt_sqlsorgu("SELECT *  FROM `".$DBTable."` WHERE `dbemail` = '".$Mail."'");
		if($rr_vt->bf_vt_numrows($sorgu)){
			$P = $rr_vt->bf_vt_sqldongu();
			$T = count($P);
			for($i=0;$i<$T;$i++) {
				 $Data[$f]['PT'] = $ProductType[$j];
				 $Data[$f]['PN'] = $ProductName[$j];
				 $Data[$f]['ID'] = $P[$i]['dbGuid'];
				 $Data[$f]['UN'] = $P[$i]['dbUserName'];
				 $Data[$f]['UP'] = $P[$i]['dbUserPass'];
				 $Found = true;
				 $f++;
			}
		}
		$j++;
	}
}
?>