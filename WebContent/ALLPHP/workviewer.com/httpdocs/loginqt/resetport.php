<?php
session_start();
$session = $_SESSION["workviewer"];
if($session){
$key = $_GET["key"];
if($_GET){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/resetrequestcon?client_id='.$key.'';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
echo $data;
}else{
	header("location:home.php");
	}
}else{
header("location:index.php");	
}
?>
