<?php 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port=48600&showerrorinxml=yes&link=screen_list?fetch_data___table=window_text_log___table_field_id=window_text_log_id___value1=0___value2=z';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
$sayi = count($xml->fetch_data->table_to_xml->window_text_log->row);
$xml = json_decode(json_encode((array) simplexml_load_string($data)), 1);
$sum = 0;
$newarray = array();
$arraypathpathcount = array();
for($i=0;$i<count($xml["fetch_data"]["table_to_xml"]["window_text_log"]["row"]);$i++){
	$date = $xml["fetch_data"]["table_to_xml"]["window_text_log"]["row"][$i]["data_datetime"];
	$timestamp = strtotime($date);
	//echo $timestamp."<br>";
	$newarray["paths"][] = $xml["fetch_data"]["table_to_xml"]["window_text_log"]["row"][$i]["window_prg_path"];
	$newarray["seconds"][] = $xml["fetch_data"]["table_to_xml"]["window_text_log"]["row"][$i]["window_text_count"];
	$newarray["texts"][] = $xml["fetch_data"]["table_to_xml"]["window_text_log"]["row"][$i]["window_text"];
	$newarray["dates"][] = $xml["fetch_data"]["table_to_xml"]["window_text_log"]["row"][$i]["data_datetime"];
	if($timestamp>=1387451069 && $timestamp<=1387537469 ){	
	$arraypathpathcount[$newarray["texts"][$i]] = array("pencere"=>$newarray["texts"][$i],"yol"=>$newarray["paths"][$i],"toplam_zaman"=>($newarray["seconds"][$i]+$arraypathpathcount[$newarray["texts"][$i]]["toplam_zaman"]),"tarih"=>$newarray["dates"][$i]);
	}
	//$toplam = $newarray["seconds"][$i] + $arraypathpathcount[$newarray["texts"][$i][1]];
}
function subval_sort($a,$subkey) {
	foreach($a as $k=>$v) {
		$b[$k] = strtolower($v[$subkey]);
	}
	arsort($b);
	foreach($b as $key=>$val) {
		$c[] = $a[$key];
	}
	return $c;
}
$arraypathpathcount = subval_sort($arraypathpathcount,'toplam_zaman'); 
print_r($arraypathpathcount);
/*echo "<pre>";
print_r($arraypathpathcount);
echo "</pre>";
*/
?>