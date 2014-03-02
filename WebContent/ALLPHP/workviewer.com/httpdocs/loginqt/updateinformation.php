<?php 
session_start();
$session = $_SESSION["workviewer"];
if($session){
sleep(1);
include("config.php");
$userName = $_POST["userName"];
$user_pass = $_POST["user_pass"];
$city = $_POST["city"];
$district = $_POST["district"];
$address = $_POST["address"];
$homephone = $_POST["homephone"];
$mobilephone = $_POST["mobilephone"];
$clientCount = $_POST["clientCount"];
$user_id= $_POST["user_id"];
if($_POST){
$query = pg_query("update registered_users set 
user_pass='$user_pass',
company_person_name='$userName',
phone1='$homephone',
phone2='$mobilephone',
district='$district',
city='$city',
address1='$address',
license_client_count='$clientCount' where id ='$user_id'");
if($query){
	echo "ok";
	}
}else{
	header("location:home.php");
	}
}else{
	header("location:index.php");
	}
?>