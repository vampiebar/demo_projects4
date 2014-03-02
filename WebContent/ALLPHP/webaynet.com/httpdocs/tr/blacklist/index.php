<? include "../setting.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
body {
	margin: 0px;
	padding: 0px;
	font-family: Trebuchet MS, Verdana, Geneva, sans-serif;
	font-size: 11px;
}
#maincont {
	width: 600px;
	border: 1px solid #0099CC;
	margin: auto;
	overflow: hidden;
}
#head {
	width: 594px;
	height: 24px;
	line-height: 24px;
	background-color:#0099CC;
	color: #FFFFFF;
	font-size: 16px;
	padding: 3px;
	text-align: center;
	font-weight: bold;
	clear: both;
}

#q {
	width: 300px;
	border: 0px;
	border-bottom: 1px solid #09C;
	color: #333;
	font-family: Trebuchet MS, Verdana, Geneva, sans-serif;
}

#q:hover {
	border-bottom: 1px solid #030;
}

#submit {
	width: 90px;
	border: 0px;
	border-bottom: 1px solid #09C;
	color: #333;
	font-family: Trebuchet MS, Verdana, Geneva, sans-serif;
}

#submit:hover {
	border-bottom: 1px solid #030;
}


#main {
	padding-top: 24px;
	padding-bottom: 24px;
	margin: auto;
	text-align: center;
	color: #000;
}
#headexp {
	clear: both;
	padding: 4px;
	text-align: left;
	margin-bottom: 8px;
	text-align: justify;
}

#status {
	margin: auto;
	width: 400px;
}

#f {
	padding: 4px;
	border: 1px solid #900;
	margin: 24px 24px 0px 24px;
}

#nf {
	padding: 4px;
	border: 1px solid #060;
	margin: 24px 24px 0px 24px;
}
.NEW {
	font-weight: bold;
	color: #FFF;
}
.new2 {
	color: #F00;
	font-weight: bold;
}
.style16 {color: #353535}
</style>
<title>Webaynet.com :: Yasaklı Site Listesi</title>
</head>
<?php
if(isset($_GET['q'],$_POST['q'])) {
	$Found = false;
	include_once("mysql_connection.php");
	$DBServ['TIB'] = "localhost";
	$DBUser['TIB'] = "tibcafe";
	$DBPass['TIB'] = "11012007";
	$DBName['TIB'] = "tib";
	$QueryString = $_POST['q'];
	if(substr($QueryString,0,7) == "http://") {
		$QueryString = substr($QueryString,7,strlen($QueryString) - 7);
	}
	if(substr($QueryString,0,4) == "www.") {
		$QueryString = substr($QueryString,4,strlen($QueryString) - 4); 
	}
	if($rr_vt = new bf_vt($DBServ['TIB'],$DBUser['TIB'],$DBPass['TIB'],$DBName['TIB'])) {
		$q = "SELECT * FROM `guncellemeler`   WHERE tur='E' and `webAdres` LIKE '".$QueryString."'  order by guncellemeId desc limit 0,1 ";
		
		$q = "select * from guncellemeler  where  tur='E'  and   ( select tur  from guncellemeler  where    webadres like '".$QueryString."'  order by guncellemeid desc  limit 0,1)='E'  and webadres like'".$QueryString."'  order by guncellemeid desc  limit 0,1 ";
		
		echo $q;
		
		$s = $rr_vt->bf_vt_sqlsorgu($q);
		if($rr_vt->bf_vt_numrows($s)){ 
			@$f = $rr_vt->bf_vt_sqldongu();
			for($i=0;$i<count($f);$i++) {
				$Found = true;
			}
		}
	}
}
?>
<body>
<div style="padding: 16px;"><center>
</center>
</div>
<form id="mainform" action="index.php?q" method="post">
    <div id="maincont">
        <div id="head">TELEKOMÜNİKASYON KURUMU YASAKLI SİTE ARAMA SAYFASI</div>
            <div id="main">
                <div id="headexp">Bu sayfadan erişmeye çalıştığınız internet sitesinin <strong>Telekomünikasyon İletişim Bakanlığı</strong> (TİB) tarafından yasaklı olup olmadığını sorgulayabilirsiniz. <br />
                  <br />
                  <span class="new2">ÖNEMLİ NOT:</span> T.İ.B. Kurumu bir domain (<span class="new2">youtube.com</span> gibi) yerine bir linki veya aramayı da (<span class="new2">site.mynet.com/dostserkantv</span>) yasaklayabilir. Bundan dolayı burada yapacağınız aramalarda buna dikkat ediniz.</div>
                  <span style="font-size: 13px;">http://</span><input name="q" type="text" id="q" value="<?php if(isset($_POST['q'])) { echo stripslashes(htmlspecialchars($_POST['q'])); } else { echo "www.casino.com"; } ?>" />
                  <input id="submit" name="Submit" type="submit" value="Sorgula"  />
                  <br />
                  <?php
                  if(@$_POST['q'] != "") {
					// Sayaç
						$Last = file_get_contents("count.dat");
						$Open = fopen("count.dat","w");
						$Write = fwrite($Open,($Last + 1));
						$Close = fclose($Open);
					// -----
                    if(@$Found == true) { ?>
                    <div id="f" style="background:#F00; color: #FFF;">"<strong style="font-style:oblique" ><u><?php echo $QueryString; ?></u></strong>" <span class="NEW">BU SİTE VEYA LİNK T.İ.B. KURUMU YASAKLI SİTELER İÇERİSİNDEDİR.</span></div>
                    <?php	}
                  ?>
                  <?php
                    if(@$Found == false) { ?>
                    <div class="NEW" id="nf" style="background:#0C0; color: #000; font-weight: bold;">"<strong style="font-style:oblique"><u><?php echo $QueryString; ?></u></strong>" BU SİTE VEYA LİNK T.İ.B. KURUMU YASAKLI SİTELER İÇERİSİNDE DEĞİLDİR.</div>
                    <?php	}
                  }
                  ?>
            <br />
            <br />
            Bu Sayfada Yapılan Sorgu Sayısı : <?php echo file_get_contents("count.dat");  ?><br />
            <span class="style16">Şu andaki IP Adresiniz : <font face="Verdana" size="2">
            <?php $ip=$_SERVER['REMOTE_ADDR']; echo "$ip"; ?>
          </font></span></div>	
        </div>
    </div>
</form>
</body>
   </html>    