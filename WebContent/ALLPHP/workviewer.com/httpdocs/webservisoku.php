<?php
header('Content-type: application/json; Charset=utf-8;');
$json = file_get_contents("http://workviewer.com/webservis.php?user=300&format=json");
json_decode($json);
echo $json["id"];
?>
