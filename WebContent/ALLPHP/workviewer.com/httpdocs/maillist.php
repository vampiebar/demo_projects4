<?php 
include("config2.php");
while($rows=pg_fetch_object($sql)){
	$username=$rows->city;
	echo $username."\r\n";
	}
?>