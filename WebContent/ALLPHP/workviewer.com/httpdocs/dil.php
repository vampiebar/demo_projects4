<?php 
session_start();
$dil =strip_tags($_GET["dil"]);
$sayfa =strip_tags($_GET["sayfa"]);
if($dil=="tr" || $dil=="en" || $dil=="alm" || $dil=="it" || $dil=="sp" || $dil=="fr"  || $dil=="ch" || $dil=="ar"){
	$_SESSION["dil"] = $dil;
	header("location:..$sayfa");
	}else{
		header("location:../");
		}
?>