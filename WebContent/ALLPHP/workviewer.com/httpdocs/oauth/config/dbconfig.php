<?php
define('DB_SERVER', 'localhost:3306');
define('DB_USERNAME', 'secpaonur');
define('DB_PASSWORD', 'secpa2013*');
define('DB_DATABASE', 'secpasoft_site');
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());
mysql_query("SET NAMES UTF8");
?>