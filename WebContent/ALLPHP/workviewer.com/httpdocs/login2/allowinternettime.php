<?php
session_start();
$session = $_SESSION["workviewer"];
if($session){  
$port = $_GET["port"];
$appid=$_GET["desc"];
$appid = str_replace(" ","+",$appid);
$appid = urlencode($appid);
if($_GET){
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=net_list?set_net_run_name_limited___xnet_run_limit_name='.$appid.'___status=false';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
}
}else{
header("location:index.php");	
}
?>