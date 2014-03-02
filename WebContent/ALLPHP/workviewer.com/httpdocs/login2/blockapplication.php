<?php 
session_start();
$session = $_SESSION["workviewer"];
if($session){  
$port = $_GET["port"];
$proc_limit=urlencode(str_replace(" ","+",$_GET["proc_limit"]));
$proc_limit_file_desc=urlencode(str_replace(" ","+",$_GET["proc_limit_file_desc"]));
$proc_limit_full_path=urlencode(str_replace(" ","+",$_GET["proc_limit_full_path"]));
$proc_limit_start=$_GET["proc_limit_start"];
$proc_limit_end=$_GET["proc_limit_end"];
$proc_limit_weekday=$_GET["proc_limit_weekday"];
$proc_limit_weekday = explode(",",$proc_limit_weekday);
if($_GET){
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=proc_list?_set_proc_settings___ctrl.proc_limit=true';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
for($i=0;$i<count($proc_limit_weekday);$i++){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=proc_list?proc_limit='.$proc_limit.'___proc_limit_file_desc='.$proc_limit_file_desc.'___proc_limit_file_hash=CCC___proc_limit_end='.$proc_limit_end.'___proc_limit_start='.$proc_limit_start.'___proc_limit_weekday='.$proc_limit_weekday[$i].'___xproc_limit_full_path='.$proc_limit_full_path.'___xxbatch_id=33';
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