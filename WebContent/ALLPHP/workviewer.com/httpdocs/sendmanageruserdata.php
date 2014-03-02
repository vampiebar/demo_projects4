<?php 
$userAgentLanguage = $_POST["userAgentLanguage"];
$userAgentBrowser = $_POST["userAgentBrowser"];
$userAgentIp = $_POST["userAgentIp"];
$userAgentOS = $_POST["userAgentOS"];
$userAgentResolution = $_POST["userAgentResolution"];
if($_POST){
	include("config.php");
	$sql=mysql_query("insert into WorkviewerManagerUserInformation (
	ManagerUserAgentLanguage,
	ManagerUserAgentBrowser,
	ManagerUserAgentIp,
	ManagerUserAgentOS,
	ManagerUserAgentResolution,
	ManagerUserAgentDate
	) values (
	'$userAgentLanguage',
	'$userAgentBrowser',
	'$userAgentIp',
	'$userAgentOS',
	'$userAgentResolution',
	NOW()
	)");
	mysql_query("update WorkviewerManagerUserInformation set ManagerUserAgentHit=ManagerUserAgentHit+1");
}
?>
