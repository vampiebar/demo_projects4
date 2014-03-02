<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

$connection = pg_connect("host='register.workviewer.com' port='6432' dbname='icaosctrl' user='postgres' password='secpa!74!'") or die ("Bağlanamadı");
$sql=pg_query("select * from registered_users order by install_type desc");
$sayi=pg_num_rows($sql);
?>
