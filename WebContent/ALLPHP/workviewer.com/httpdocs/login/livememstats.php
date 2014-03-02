<?php
$port = $_GET["port"];
if($_GET){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=wmi_list?get_system_mem_stat';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
$mem = str_replace(",",".",$xml->system_mem_stat->used_percent);
$x = (time()+7200)*1000;
$ret = array("time"=>$x,"point"=>number_format($mem,2)*1);
echo json_encode($ret);
}
?>