<?php
$t1=str_replace(" ","%20",$_POST["t1"]); 
$t2=str_replace(" ","%20",$_POST["t2"]); 
$url="http://78.190.203.244:8081/screen_list?get_recorded_data&t1=$t1&t2=$t2";
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);    // get the url contents

$data = curl_exec($ch); // execute curl request
curl_close($ch);

$xml = simplexml_load_string($data);
foreach ($xml->recorded_data as $element) {
    if ($element) {
        foreach ($element->id as $el) {
            echo $el."<br>";
        }
		/*foreach ($element->date_time as $el2) {
            echo $el2.";";
        }
		*/
    }
}

?>