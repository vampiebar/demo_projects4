<?php 
include("config.php");
$card = $_POST["card"];
if(isset($card)){
	$q=mysql_query("select * from binlist where bin like '%$card%'");
	$r=mysql_num_rows($q);
	if($r>0){
		$bankname = mysql_result($q,0,"banka_adi");
		echo $bankname;
		}else{
			echo "Yok";
			}
	}
?>
