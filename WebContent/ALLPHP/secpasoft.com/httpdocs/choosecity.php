<?php 
if (isset($_POST['query'])) {
include("config.php");
$query = $_POST['query'];
$other = $_POST['country'];
$sql = mysql_query("select il.ad as iladi from il,ulke where il.ulke_id=ulke.id and ulke.ad like '$other'");
$array = array();

while ($row = mysql_fetch_assoc($sql)) {
    $array[] = $row['iladi'];
}
echo json_encode($array);
}else{
	header("location:../deneme");
	}
?>