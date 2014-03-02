<?php
$screenport = $_GET["port"];
$screenperiodday = $_GET["screenperiodday"];
$screenperiodday = 3600*24*$screenperiodday;
if($_GET){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$screenport.'&showerrorinxml=yes&link=screen_list?set_screen_record_period='.$screenperiodday.'';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
echo $xml;
}
?>
