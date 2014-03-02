<?php 
$port = $_GET["port"];
$appid=$_GET["appid"];
if($_GET){
$url='linkgelecek';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
}
?>
