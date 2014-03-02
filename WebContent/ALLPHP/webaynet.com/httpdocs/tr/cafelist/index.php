<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
<title>TİB ONAYLI FİLTREMİZİ KULLANAN CAFELERİMİZ</title>
<?php

include_once("mysql_connection.php");

$DBServ['TIB'] = "register.webaynet.com";
$DBUser['TIB'] = "tibcafe";
$DBPass['TIB'] = "11012007";
$DBName['TIB'] = "tib";

$DAServ = "register.webaynet.com";
$DAUser = "filteruser";
$DAPass = "!dadi!2006";
$DAName = "wfilter";

if($WF = new bf_vt($DAServ,$DAUser,$DAPass,$DAName)) {
	$LQuery = $WF->bf_vt_sqlsorgu("SELECT * FROM `ccserverusers`");
	if($WF->bf_vt_numrows($LQuery)){
		$DataArray = $WF->bf_vt_sqldongu();
		$CCServ = $DataArray;
	}
}

function strtolower_tr($string)
{
	$low=array("Ü" => "ü", "Ö" => "ö", "Ğ" => "ğ", "Ş" => "ş", "Ç" => "ç", "İ" => "i", "I" => "ı");
	return strtolower(strtr($string,$low));
}


if($rr_vt = new bf_vt($DBServ['TIB'],$DBUser['TIB'],$DBPass['TIB'],$DBName['TIB'])) {
		if(!isset($_GET['s'])) {
			$START = 0;				
		} else {
			$START = $_GET['s'];
		}
		$START += 3;
		$END = 100;
		if(isset($_GET['sehir'])) {
			$QAdd = "WHERE `il` = '".$_GET['sehir']."'";
			$LIMIT = "";
		} else {
			$QAdd = "";	
			$LIMIT = "LIMIT ".$START.", ".$END;
		}
		$q = "SELECT * FROM `kullanicibilgileri`";
		$s = $rr_vt->bf_vt_sqlsorgu($q);
		if($rr_vt->bf_vt_numrows($s)){ 
			$f = $rr_vt->bf_vt_sqldongu();
			$T = count($f);
			for($i=0;$i<$T;$i++) {
				$L[$i] = $f[$i]['il'];
			}
		}
		$K = count($f);
		
		$query = "SELECT * FROM `kullanicibilgileri` ".$QAdd." ".$LIMIT;
		$sorgu = $rr_vt->bf_vt_sqlsorgu($query);
		if($rr_vt->bf_vt_numrows($sorgu)){
			$P = $rr_vt->bf_vt_sqldongu();
			$T = count($P);
			for($i=0;$i<$T;$i++) {
				$Cafe[$i]['ID'] = $P[$i]['kullaniciId'];
				$Cafe[$i]['A'] = $P[$i]['isletmeAd'];
				$Cafe[$i]['T'] = $P[$i]['telefon'];
				$Cafe[$i]['K1'] = $P[$i]['ilce'];
				$Cafe[$i]['K2'] = $P[$i]['il'];
			}
		}

	}

?>
<style type="text/css">
<!--

body,table,td,tr,th,a,link,div,select, option {
	font-family: "Trebuchet MS", Verdana, Geneva, sans-serif;
	font-size: 11px;
}

select,option {
	font-size: 13px;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	text-align: right;
	color: #FFF;
	background-color:#09C;
	font-weight: bold;
	border: 0px;
	width: 200px;
}

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
<script type="text/javascript">
	function goTo(val) {
		if(val.value != "null") {
			location.href = "index.php?sehir="+val.value;
		}
	}
</script>
</head>

<body>
<table width="660" border="0" align="center" cellpadding="4" cellspacing="0">
  <tr class="int">
    <td colspan="2" align="center"><img src="../gfx/logo.gif" alt="" width="259" height="93" /></td>
    <td colspan="3" class="a"><a href="http://www.webaynet.com"><img src="../images/homepage.jpg" alt="" width="82" height="50" border="0" /></a></td>
  </tr>
  <tr class="int">
    <td colspan="5" align="center">
        <form name="iller" id="iller" style="display: inline">
        <table width="660" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="right">
            <div align="right">
            Toplam <?php echo count($L)-3; ?> kayıt : 
            <select name="il" id="il" onChange="goTo(this);">
            	<option value="null" selected>İl Seçiniz... </option>
            <?php
                $F = array_count_values($L);
                foreach($F as $Sehir => $Sayi) {
					echo "<option value=\"".$Sehir."\">".$Sehir."(".$Sayi.") </option>";
					$Toplam += $Sayi;
                }
            ?>
            </select>
            </div>
            </td>
          </tr>
        </table>
        </form>
    </td>
  </tr>
  <tr class="int">
    <td colspan="5" align="center" bgcolor="#0099CC"><span class="top"><center>T.İ.B. (TELEKOMÜNİKASYON İLETİŞİM BAŞKANLIĞI) ONAYLI İÇERİK FİLTREMİZİ KULLANAN CAFELERİMİZ</center></span></td>
  </tr>
  <tr class="int">
    <td width="40" align="center">#</td>
    <td width="386" class="a">CAFE ADI</td>
    <td width="74" class="a" align="center"><center>Lisans Sayısı</center></td>
    <td width="104" class="a">İLÇE VE İL</td>
    <td width="24" class="a">Aktif</td>
  </tr>
  <?php
  	$j = $XX = $TNUse = $TYUse = $SNUse = $SYUse = 0;
	$Once = true;
	$Max = 100; if(isset($_GET['s'])) { $Max = 99999; }
	$f = 0;
	foreach($CCServ as $SServ) {
		$Date = strtotime($SServ['dbLastAccessDate']);
		$Now = time();
		$Passed = ($Now - $Date);
		$SetTime = 60 * 60 * 168; // 60 saniye * 60 dakika * 24 saat
		if($Passed > $SetTime) {
			$TNUse++;
		} else {
			$TYUse++;
		} $f++;
	}
	foreach($Cafe as $C) {
		if(($C['A'] != "ENGİN MIHÇIOĞLU") && ($C['A'] != "BÜLENT ŞEKER") && ($C['A'] != "T.İ.B. KURUMU")) {
		if($j < $Max) {
		foreach($CCServ as $CServ) {
			if($CServ['dbUserId4TIB'] == $C['ID']) {
				$LCount = $CServ['dbLicenceCount'];
				$Date = strtotime($CServ['dbLastAccessDate']);
				$Now = time();
				$Passed = ($Now - $Date);
				$SetTime = 60 * 60 * 168; // 60 saniye * 60 dakika * 24 saat
				if($Passed > $SetTime) {
					$NotInUse = true;	
				} else {
					$NotInUse = false;	
				}
			}
		}
		$j++;
		if(!isset($_GET['sehir'],$_GET['s'])) {
		?>
		<tr class="int" id="<?php if($j % 2 == 0) { echo "bgdiff"; } ?>">
		<td><?php echo ($START-3)+$j; ?></td>
		<td align="left"><?php echo $C['A']; ?></td>
		<td align="center"><center><?php echo $LCount; ?></center></td>
		<td align="left">
		<?php
			if($C['K1'].$C['K2'] != "") { 
				 echo ucwords(strtolower_tr($C['K2'])); ?>/<?php echo ucwords(strtolower_tr($C['K1']));
			} else {
				echo "-";	
			}
	?>
            </td>
            <td align="center"><center><?php if($NotInUse == true) { $SNUse++; ?><img src="n.gif" align="Aktif Değil" width="16" height="16"><?php } else { $SYUse++; ?><img src="y.gif" align="Aktif" width="16" height="16"><?php } ?></center></td>           
          </tr>
         <?php 	} else if(isset($_GET['sehir'],$_GET['s'])) {
			if(($j >= $_GET['s']) && ($XX <= 100)) {
			$XX++; 
			?> 
		 <tr class="int" id="<?php if($j % 2 == 0) { echo "bgdiff"; } ?>">
		  <td><?php echo $_GET['s']+$XX; ?></td>
		  <td align="left"><?php echo $C['A']; ?></td>
		  <td align="center"><center><?php echo $LCount; ?></center></td>
		  <td align="left"><?php
				if($C['K1'].$C['K2'] != "") { 
					 echo ucwords(strtolower_tr($C['K2'])); ?>/<?php echo ucwords(strtolower_tr($C['K1']));
				} else {
					echo "-";	
				} ?>
			</td>
	         <td align="center">
	             <center>
                 <?php if($NotInUse == true) { $SNUse++; ?><img src="n.gif" align="Aktif Değil" width="16" height="16"><?php } else { $SYUse++; ?><img src="y.gif" align="Aktif" width="16" height="16"><?php } ?></center></td>           
				<?php
			}
		}
	}
	?>

	<?php		} 
	}
	
  ?>

         <tr class="int">
           <td colspan="5">Bu sayfada <strong><?php echo $SYUse; ?></strong> güncel, <strong><?php echo $SNUse++; ?></strong> güncel olmayan kayıt bulunuyor. <br />
						   Toplam <strong><?php echo $TYUse; ?></strong> güncel, <strong><?php echo $TNUse++; ?></strong> güncel olmayan kayıt bulunuyor. <br />            </td>
</table>
<br /><center>
<div class="botlink">
	<?php
		if(!isset($_GET['sehir'])) {
	    	if($K > 100) {
				$TP = floor($K / 100);
				for($a=0;$a<=$TP;$a++) {
				?>
					<a href="index.php?s=<?php echo $a*100; ?>"><?php echo $a+1; ?></a>
				<?php
				}
			}
		} else {
	    	if($T > 100) {
				$TJ = floor($T / 100);
				for($a=0;$a<=$TJ;$a++) {
				?>
					<a href="index.php?sehir=<?php echo $_GET['sehir']; ?>&s=<?php echo $a*100; ?>"><?php echo $a+1; ?></a>
				<?php
				}
			}
		}
	?>
</div>
</center>
</body>
    </html>    