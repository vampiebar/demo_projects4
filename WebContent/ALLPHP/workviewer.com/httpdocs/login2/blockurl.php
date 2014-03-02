<?php
session_start();
$session = $_SESSION["workviewer"];
if($session){  
$port = $_GET["port"];
$urladres=$_GET["urladres"];
$url_limit_start=$_GET["url_limit_start"];
$url_limit_end=$_GET["url_limit_end"];
$url_limit_weekday=$_GET["url_limit_weekday"];
$url_limit_weekday = explode(",",$url_limit_weekday);
$port = explode(",",$port);
if($_GET){
for($k=0;$k<count($port);$k++){ 	
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port[$k].'&showerrorinxml=yes&link=proc_list?_set_proc_settings___ctrl.url_limit=true';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
for($i=0;$i<count($url_limit_weekday);$i++){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port[$k].'&showerrorinxml=yes&link=url_list?url_limit='.$urladres.'___url_limit_desc=Limiting_www.'.$urladres.'___url_limit_end='.$url_limit_end.'___url_limit_start='.$url_limit_start.'___url_limit_weekday='.$url_limit_weekday[$i].'___xxbatch_id=0';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port[$k].'&showerrorinxml=yes&link=url_list?url_limit=www.'.$urladres.'___url_limit_desc=Limiting_www.'.$urladres.'___url_limit_end='.$url_limit_end.'___url_limit_start='.$url_limit_start.'___url_limit_weekday='.$url_limit_weekday[$i].'___xxbatch_id=0';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
}
}
}
}else{
header("location:index.php");	
}
?>