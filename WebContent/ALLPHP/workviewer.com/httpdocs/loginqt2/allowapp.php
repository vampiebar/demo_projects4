<?php 
$port = $_GET["port"];
$appid=$_GET["appid"];
if($_GET){
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=proc_list?set_proc_limited___xproc_limit_id='.$appid.'___status=false';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
}
?>
