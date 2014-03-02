<?php
$port = $_GET["port"];
$t1=$_GET["t1"];
$t2=$_GET["t2"];
$t1=str_replace(" ","T",$t1);
$t2=str_replace(" ","T",$t2);
$imagecount=10;
if($_GET){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=screen_list?delete_screen_records___t1='.$t1.'___t2='.$t2.'';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
echo $xml->delete_screen_records;
}
?>