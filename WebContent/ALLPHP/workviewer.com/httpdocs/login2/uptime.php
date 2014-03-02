<?php
include("functions.php"); 
$port = $_GET["port"];
if($_GET){ 
$url2='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=wmi_list?get_system_uptime';
$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch2, CURLOPT_URL, $url2);
$data2 = curl_exec($ch2);
curl_close($ch2);
$xml2 = simplexml_load_string($data2);
$saniye = $xml2->system_uptime;
echo nekadaronce($saniye);
}
?>