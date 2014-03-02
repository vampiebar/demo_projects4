<?php
$port = $_GET["port"];
if($_GET){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=wmi_list?get_system_cpu_stat';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
$cpu = str_replace(",",".",$xml->system_cpu_stat->cpu_percent);
$x = time() * 1003.5;
$ret = array($x,number_format($cpu,2)*1);
echo json_encode($ret);
}
?>