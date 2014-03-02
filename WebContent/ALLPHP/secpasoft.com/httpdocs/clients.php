<?php 
/*if($_SERVER['HTTPS']){
     $url = 'http://www.secpayazilim.com/musterilerimiz';
     header("Location: $url");
}
*/
session_start();
if(!$_SESSION["dil"]){
	require("dil/en.php");
}else{
	require("dil/".$_SESSION["dil"].".php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Seçpa, Secpa, Seçpa Soft, Secpa Soft, Seçpa Yazilim, Secpa Yazilim, WorkViewer, Work Viewer, Kids, Kids Viewer, KidsViewer,Work Viewer Buy,  Buy Work Viewer, WorkViewer Buy, Buy WorkViewer, Kids Viewer Buy, Buy Kids Viewer, KidsViewer Buy, Buy KidsViewer, ReadyCafe, Ready Cafe, Ready Cafe Satın Al, Ready Cafe Satin Al, ReadyCafe Buy, Ready Cafe Buy, Download Workviewer, Download Work viewer" />
<meta name="description" content="Seçpa Yazılım ve İnternet Teknolojileri Müşterilerimiz Sayfası" />
<meta name="Robots" content="index,follow" />
<meta name="viewport" content="width=device-width;minimum-scale=0.5,maximum-scale=1.0; user-scalable=1;" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" type="text/css" href="css/da-slider.css" />
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="css/font-awesome-ie7.min.css" />
<!--<link rel="stylesheet" type="text/css" href="css/fractionslider.css">-->
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/prettify.js"></script>
<script type="text/javascript" src="js/modernizr.js"></script>
<script type="text/javascript" src="js/wookmark.js"></script>
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css' />
<link href='https://fonts.googleapis.com/css?family=Economica:700,400italic' rel='stylesheet' type='text/css' />
<link href='https://fonts.googleapis.com/css?family=Noto+Sans:400,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css' />
<title>Seçpa Yazılım | Müşterilerimiz</title>
		<script type="text/javascript">
			$(document).ready(function(){
					prettyPrint();
					$('.client_container').masonry({
					   itemSelector : '.box',
					   columnWidth : 240,
					   isAnimated: true
					 });
					$(".topbar_menu ul li").hover(function(){
						$(this).find("ul").slideDown();
						},function(){
						$(this).find("ul").hide();	
							});
				});
		</script>
        <style>
        	.thumbnail{ margin-bottom:5px;}
        </style>
</head>

<body>
<?php 
include("topbarmenu.html");
?>
<div class="row-fluid">
	<div class="container">
    	<div class="span3">
        	<a href="../homepage">
            	<img class="logo" src="img/logo.png" width="138" height="64" alt="Seçpa Yazılım Logo" />
            </a>
        </div>
        <div class="span9 marginforheader">
        	<ul class="nav nav-pills pull-right">
            	<ul class="nav nav-pills pull-right">
            	<li><a href="../homepage" title="Seçpa Yazılım"><?php echo $dil["menu1"]; ?></a></li>
                <li><a href="../about" title="Seçpa Yazılım Hakkımızda"><?php echo $dil["menu2"]; ?></a></li>
                <li><a href="../products" title="Seçpa Yazılım Ürünlerimiz"><?php echo $dil["menu3"]; ?></a></li>
                <li class="active"><a href="../clients" title="Seçpa Yazılım Müşterilerimiz"><?php echo $dil["menu4"]; ?></a></li>
                <li><a href="../download" title="Seçpa Yazılım Müşterilerimiz"><?php echo $dil["menu7"]; ?></a></li>
                <li><a href="../buy" title="Seçpa Yazılım Satın Al"><?php echo $dil["menu5"]; ?></a></li>
                <li><a href="../contact" title="Seçpa Yazılım İletişim"><?php echo $dil["menu6"]; ?></a></li>
            </ul>
            </ul>
        </div>
    </div>
</div>
<div class="row-fluid">
	<div class="container">
	<h1><?php echo $dil["musterilerimiz"]; ?></h1>
    <hr />
    <div class="boxes">
    <div class="row-fluid">
    <div class="span3 thumbnail">
    	<img src="img/referanslar/akcakoca.jpg" width="121" height="114" />
    </div>
	<div class="span3 thumbnail">
    	<img src="img/referanslar/alpuu.jpg" width="121" height="114" />
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/balikesirilozelidare.jpg" width="121" height="114" />
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/bitlisbel.jpg" width="121" height="114" />
    </div>
    </div>
    <div class="row-fluid">
    <div class="span3 thumbnail">
    	<img src="img/referanslar/bozdogan.png" width="121" height="114" />
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/nazilli.png" width="121" height="114" />
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/svlsv.jpg" width="121" height="114" />
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/balcioglu.jpg" width="200" height="62" />
    </div>
    </div>
    <div class="row-fluid">
    <div class="span3 thumbnail">
    	<img src="img/referanslar/akdenizboya.jpg" width="200" height="80" />
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/alanyatirim.jpg" width="188" height="109" />
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/anafenn.jpg" width="121" height="43" />
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/aras.jpg" width="121" height="83" />
    </div>
    </div>
    <div class="row-fluid">
    <div class="span3 thumbnail">
    	<img src="img/referanslar/arpekarkan.jpg" width="200" height="129" />
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/atamiksboya.jpg" width="200" height="67" />
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/balikesirsaglikmudurlugu.jpg" width="200" height="114" />
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/basyigit.png" width="205" height="86" />
    </div>
    </div>
    <div class="row-fluid">
    <div class="span3 thumbnail">
    	<img src="img/referanslar/beyazdevkutup.jpg" width="200" height="55" />
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/borazdenizcilik.jpg" width="200" height="85" />
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/bozdogan.jpg" width="112" height="110" />
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/ceymmobilya.jpg"  width="200" height="64"/>
    </div>
    </div>
    <div class="row-fluid">
    <div class="span3 thumbnail">
    	<img src="img/referanslar/cps.jpg" width="167" height="71" />
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/lojas.jpg"  width="136" height="66"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/elementloj.jpg"  width="200" height="81"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/formamakina.jpg" width="200" height="57" />
    </div>
    </div>
    <div class="row-fluid">
    <div class="span3 thumbnail">
    	<img src="img/referanslar/gebzeyesilay1.png" width="121" height="83" />
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/guzelis.jpg" width="200" height="200" />
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/hayatozalit.jpg" width="206" height="71" />
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/hisarlar.gif" width="200" height="104" />
    </div>
    </div>
    <div class="row-fluid">
    <div class="span3 thumbnail">
    	<img src="img/referanslar/ihlaspazarlama.jpg" width="171" height="72" />
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/isikgozmerkezi.jpg" width="215" height="115" />
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/karser.gif" width="121" height="43" />
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/kartalbombe.jpg" width="135" height="180" />
    </div>
    </div>
    <div class="row-fluid">
    <div class="span3 thumbnail">
    	<img src="img/referanslar/kazdalinsaat.jpg" width="184" height="129" />
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/kirikkalevaliligi.jpg" width="200" height="96" />
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/koytad.jpg"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/lojas.jpg"  width="200" height="77"/>
    </div>
    </div>
    <div class="row-fluid">
    <div class="span3 thumbnail">
    	<img src="img/referanslar/maygroup.jpg"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/metrokargoo.jpg"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/omsaoto2.png"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/oykuloj.jpg"  width="200" height="77"/>
    </div>
    </div>
    <div class="row-fluid">
    <div class="span3 thumbnail">
    	<img src="img/referanslar/palali.jpg"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/pelit.jpg"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/pelit-pastanesi.jpg"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/sadabad.jpg"  width="200" height="77"/>
    </div>
    </div>
    <div class="row-fluid">
    <div class="span3 thumbnail">
    	<img src="img/referanslar/sadabad_koleji.jpg"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/semerkandbasim.jpg"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/seyyahlojistik.jpg"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/side.jpg"  width="200" height="77"/>
    </div>
    </div>
    <div class="row-fluid">
    <div class="span3 thumbnail">
    	<img src="img/referanslar/simyaa.jpg"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/topaloglulojistik.jpg"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/urosanmobilya.jpg"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/2abilisim.png"  width="200" height="77"/>
    </div>
    </div>
    <div class="row-fluid">
    <div class="span3 thumbnail">
    	<img src="img/referanslar/4kbilgisayar.png"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/abaserdaytuk.png"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/akcan.png"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/akdenizboya.png"  width="200" height="77"/>
    </div>
    </div>
    <div class="row-fluid">
    <div class="span3 thumbnail">
    	<img src="img/referanslar/alanyatirim.png"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/alex.png"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/alpuilcehastane.png"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/anafen.png"  width="200" height="77"/>
    </div>
    </div>
    <div class="row-fluid">
    <div class="span3 thumbnail">
    	<img src="img/referanslar/arasloj.png"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/aricioglu.png"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/arpekarkan.png"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/asasistem.png"  width="200" height="77"/>
    </div>
    </div>
    <div class="row-fluid">
    <div class="span3 thumbnail">
    	<img src="img/referanslar/asteltelekom.png"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/avrupabilisim.png"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/bakaytekstil.png"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/balcioglu.png"  width="200" height="77"/>
    </div>
    </div>
    <div class="row-fluid">
    <div class="span3 thumbnail">
    	<img src="img/referanslar/balikesirilsaglik.png"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/balikesrilozelidare.png"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/basyigitins.png"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/besttur.png"  width="200" height="77"/>
    </div>
    </div>
    <div class="row-fluid">
    <div class="span3 thumbnail">
    	<img src="img/referanslar/betapaslanmaz.png"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/beyazdevkutup.png"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/bill.png"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/bitlisbelediye.png"  width="200" height="77"/>
    </div>
    </div>
    <div class="row-fluid">
    <div class="span3 thumbnail">
    	<img src="img/referanslar/borasdenizcilik.png"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/borpametal.png"  width="200" height="77"/>
    </div>
    <div class="span3 thumbnail">
    	<img src="img/referanslar/bozdoganbelediye.png"  width="200" height="77"/>
    </div>
    </div>
    </div>
</div>
<?php 
include("footer.html");
?>
</body>
</html>

