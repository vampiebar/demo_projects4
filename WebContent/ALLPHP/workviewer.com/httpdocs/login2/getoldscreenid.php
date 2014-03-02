<?php
$port = $_GET["port"];
$t1=$_GET["t1"];
$t2=$_GET["t2"];
$t1=str_replace(" ","T",$t1);
$t2=str_replace(" ","T",$t2);
$imagecount=10;
if($_GET){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=screen_list?get_recorded_data___t1='.$t1.'___t2='.$t2.'';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
for($i=0;$i<count($xml->recorded_data);$i++){
	if($i<(count($xml->recorded_data)-1)){
	echo $xml->recorded_data[$i]->id.";;";
	}else{
		echo $xml->recorded_data[$i]->id;
		}
	}
}
?>