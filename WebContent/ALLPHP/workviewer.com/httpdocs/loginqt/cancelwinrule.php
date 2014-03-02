<?php
session_start();
$session = $_SESSION["workviewer"];
if($session){  
$port = $_GET["port"];
$rule=$_GET["rule"];
if($_GET){
$url1='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=proc_list?_set_proc_settings___ctrl.windows_limit=true';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url1);
$data = curl_exec($ch);
curl_close($ch);
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=proc_list?set_windows_limit___zzz'.$rule.'=0';
echo $url;
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
