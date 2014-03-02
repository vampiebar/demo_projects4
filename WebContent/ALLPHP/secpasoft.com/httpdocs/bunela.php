<?php 
$url="http://217.131.190.11:8081/screen_list?screen_get_last_data&h=1080&q=100&w=1920";
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
echo $xml->screen_last_data;
?>
