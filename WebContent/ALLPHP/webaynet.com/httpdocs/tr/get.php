<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
<title>Webaynet Software Engineering</title>
</head>
<body>
<?php
	include_once("mysql_connection.php");
	$WAUser = "Kullanıcımız";
	$WAProd = "np";
	$WALangStr = "tr";
	$WALink = "http://www.webaynet.com/tr/satinal.php";
	$WATable = "serverregusers";
	if(isset($_GET['exe'])) {
		if(isset($_GET['lang'])) {
			if($_GET['lang'] == 0) {
				// Türkçe
				$WAUser = "Kullanıcımız";
				$WALangStr = "tr";
				if($_GET['exe'] == "NetPatronServerTib")	{ $WAProd = "npc";	$WATable = "ccserverusers";		$WALink = "http://www.webaynet.com/tr/netpatron-tib-siparis.php"; }
				if($_GET['exe'] == "NetPatronServer") 		{ $WAProd = "np";	$WATable = "serverregusers";	$WALink = "http://www.webaynet.com/tr/netpatron-siparis.php"; }
				if($_GET['exe'] == "NetDadi") 				{ $WAProd = "nd";	$WATable = "dadiregusers";		$WALink = "http://www.webaynet.com/tr/netdadi-siparis.php"; }
			}
			if($_GET['lang'] == 1) {
				// İngilizce
				$WAUser = "User";			
				$WALangStr = "en";
				if($_GET['exe'] == "NetPatronServerTib")	{ $WAProd = "npc";	$WATable = "ccserverusers";		$WALink = "http://www.webaynet.com/en/netpatronccorder.php"; }
				if($_GET['exe'] == "NetPatronServer") 		{ $WAProd = "np";	$WATable = "serverregusers";	$WALink = "http://www.webaynet.com/en/netpatronorder.php"; }
				if($_GET['exe'] == "NetDadi") 				{ $WAProd = "nd";	$WATable = "dadiregusers";		$WALink = "http://www.webaynet.com/en/netdadiorder.php"; }
			}
		}
	}
	if(isset($_GET['guid'])) {
			$DAServ = "register.webaynet.com";
			$DAUser = "filteruser";
			$DAPass = "!dadi!2006";
			$DAName = "wfilter";
			
			if($WF = new bf_vt($DAServ,$DAUser,$DAPass,$DAName)) {
				$LQuery = $WF->bf_vt_sqlsorgu("SELECT * FROM `".$WATable."` WHERE `dbGuid` = '".$_GET['guid']."'");
				if($WF->bf_vt_numrows($LQuery)){
					$DataArray = $WF->bf_vt_sqldongu();
					$CCServ = $DataArray;
				}
			}
			if(isset($CCServ)) {
				$WAUser = $CCServ[0]['dbUserName'];
			}
	}
	if(isset($_GET['lang'])) {
		if($_GET['lang'] == 0) {
			$WALangStr = "tr";
		} else if ($_GET['lang'] == 1) {
			$WALangStr = "en";
		}
	}
	$File = file_get_contents("get.".$WALangStr.".html");
	$File = str_replace("{WA.Username}",$WAUser,$File);
	$File = str_replace("{WA.ProductType}",$WAProd,$File);
	$File = str_replace("{WA.Link}",$WALink,$File);
	echo $File;
?>
</body>
</html>