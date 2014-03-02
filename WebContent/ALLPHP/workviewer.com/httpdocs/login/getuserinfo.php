<?php
$port =$_GET["port"];
if($_GET){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=proc_list?get_proc_settings';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
$sayi=0;
foreach($xml->settings as $client){
	echo $client[$sayi]->user_alias;
	$sayi++;
	}
echo $xml->getdata;
}else{
	header("location:home.php");
	}
?>