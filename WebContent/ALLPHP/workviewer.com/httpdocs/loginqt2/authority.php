<?php
ob_start();
session_start();
sleep(3);
include("config.php"); 
$username=$_POST["username"];
$password=$_POST["pass"];
$sql=pg_query("select * from registered_users where user_name='$username'");
$num=pg_num_rows($sql);
while($rows=pg_fetch_object($sql)){
	$dbpassword = $rows->user_pass;
	$id = $rows->id;	
}
if($num==0){
	echo "yok";
}else{
	if($password!=$dbpassword){
		echo "yanlis";
	}else{
		$UserId=mysql_result($sql,0,"UserId");
		$_SESSION["workviewer"] = $id;
		if(isset($_SESSION["workviewer"])){
			echo "ok";
		}
	}
}
ob_flush();
?>