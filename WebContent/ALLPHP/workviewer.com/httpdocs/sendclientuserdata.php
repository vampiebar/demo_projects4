<?php 
$userAgentLanguage = $_POST["userAgentLanguage"];
$userAgentBrowser = $_POST["userAgentBrowser"];
$userAgentIp = $_POST["userAgentIp"];
$userAgentOS = $_POST["userAgentOS"];
$userAgentResolution = $_POST["userAgentResolution"];
if($_POST){
	include("config.php");
	$sql=mysql_query("insert into WorkviewerClientUserInformation (
	ClientUserAgentLanguage,
	ClientUserAgentBrowser,
	ClientUserAgentIp,
	ClientUserAgentOS,
	ClientUserAgentResolution,
	ClientUserAgentDate
	) values (
	'$userAgentLanguage',
	'$userAgentBrowser',
	'$userAgentIp',
	'$userAgentOS',
	'$userAgentResolution',
	NOW()
	)");
	mysql_query("update WorkviewerClientUserInformation set ClientUserAgentHit=ClientUserAgentHit+1");
}
?>