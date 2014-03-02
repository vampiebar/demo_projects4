<?php
session_start();
$session = $_SESSION["workviewer"];
if($session){ 
$port = $_GET["port"];
$desc = $_GET["desc"];
$desc = str_replace(" ","+",$desc);
$desc = urlencode($desc);
$url_limit_start=$_GET["url_limit_start"];
$url_limit_end=$_GET["url_limit_end"];
$url_limit_weekday=$_GET["url_limit_weekday"];
$url_limit_weekday = explode(",",$url_limit_weekday);
if($_GET){
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=proc_list?_set_proc_settings___ctrl.pc_run_limit=true';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
for($i=0;$i<count($url_limit_weekday);$i++){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=proc_list?pc_run_limit='.$desc.'___pc_run_limit_end='.$url_limit_end.'___pc_run_limit_start='.$url_limit_start.'___pc_run_limit_weekday='.$url_limit_weekday[$i].'___xxbatch_id=33';
echo $url;
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
}
}
}else{
header("location:index.php");	
}
?>
