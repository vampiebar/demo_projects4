<?php
session_start();
$session = $_SESSION["workviewer"];
if($session){
$port = $_GET["port"];
$alias = str_replace(" ","+",$_GET["alias"]);
$alias = urlencode($alias);
if($_GET){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=proc_list?set_alias_name='.$alias.'';
echo $url;
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
}else{
	header("location:home.php");
	}
}else{
header("location:index.php");	
}
?>
