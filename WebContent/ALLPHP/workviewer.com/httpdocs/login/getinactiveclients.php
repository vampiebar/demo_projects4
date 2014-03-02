<?php
$key = $_GET["key"];//"TR_00034_5012-0243-6826-8360";
if($_GET){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getclients?reg_id='.$key.'';
//echo $url;
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
$sayi=0;
$active_client=0;
foreach($xml->clients->client as $client){
	$gecenzaman = time()-strtotime($client->last_reach_time);
	if($gecenzaman>=40){
	$active_client++;
	if($active_client<=1){
	echo $client->client_id;
	}else{
		echo ",".$client->client_id;
		}
	$sayi++;
	}
	}
}else{
	header("location:home.php");
	}
?>