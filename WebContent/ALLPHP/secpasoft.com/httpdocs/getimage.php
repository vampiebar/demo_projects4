<?php
$id=trim($_POST["id"]); 
$url="http://78.190.203.244:8081/screen_list?get_id_recorded_data&id=$id";
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);    // get the url contents

$data = curl_exec($ch); // execute curl request
curl_close($ch);

$xml = simplexml_load_string($data);
echo '<img src="data:image/jpeg;base64,'.$xml->recorded_data_with_id->image_data.'" alt="Ekran Görüntüsü" />';
?>