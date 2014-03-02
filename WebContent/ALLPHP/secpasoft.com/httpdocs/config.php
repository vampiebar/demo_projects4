<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('error_reporting', E_ALL ^ E_NOTICE);
$host="localhost:3306";
$user="secpaonur";
$password="secpa2013*";
$database="secpasoft_site";
mysql_connect($host,$user,$password) or die ("Veritabanına Bağlanırken Hata Oluştu");
mysql_select_db($database) or die ("Veritabanı Seçilirken Hata Oluştu");
mysql_query("SET NAMES UTF8");
?>