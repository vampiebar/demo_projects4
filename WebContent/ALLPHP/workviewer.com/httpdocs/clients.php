<?php 
session_start();
if(!@$_SESSION["dil"]){
	@$_SESSION["dil"]="tr";
	require("dil/tr.php");
}else{
	require("dil/".$_SESSION["dil"].".php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width;minimum-scale=0.5,maximum-scale=1.0; user-scalable=1;" />
<meta name="keywords" content="Work, Viewer, Workviewer, WorkViewer, Workviever, WorkViever, Workwiever, WorkWiever, Workvıewer, WorkVıewer, Workvivır, Workvıvır, Workviwer, WorkViwer, Ekran izleme, network kontrol, filtreleme, canlı ekran izleme, personel takibi,Bilgisayar izleme, facebook engelleme, facebook engelle, twitter engelle, network izle, pc izle, takip programı, izleme programı, filtre programı, tib onaylı filtre,web filtresi, internet filtresi, tib onaylı filtre programı, onaylı filtre programı, onaylı filtre programları, antiporn uygulaması, porno engelleyici, antiporn, anti-porn, yasak site filtresi, web filter,network yönetimi, network izleme programı, 5651 nolu yasa gereği filtreleme, 5651 yasası açıklamalı, 5651 yasası kapsamı,Employee monitoring, worker monitor, worker activity logging, employee screen watching,Personel, İzleme"/>
<meta name="description" content="Workviewer Müşteriler Sayfası" />
<meta name="Robots" content="index,follow" />
<title>Workviewer | Müşterilerimiz</title>
<link rel="stylesheet" type="text/css" href="css/reset.css" />
<!-- <link rel="stylesheet" type="text/css" href="css/prettify.css" /> -->
<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css" /> -->
<!--<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" /> -->
<link href='http://fonts.googleapis.com/css?family=Merriweather+Sans:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/site.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/slider.js"></script>
<script type="text/javascript" src="js/jquery.dd.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#countries").msDropdown();
		$(".menu ul li").hover(function(){
			$(this).find("ul").show();
			$(this).find(".first").css({
				"background-color":"#444",
				"color":"#fff"
				});
			},function(){
			$(this).find("ul").hide();
			$(this).find(".first").css({
				"background-color":"",
				"color":""
				});	
				});
	$(".loginbutton").click(function(){
			$(".login").slideToggle(700);		
		});
	$("form.form-1").submit(function(a){
		var username = $("#username").val();
		var password = $("#password").val();
		if(username.length<1){
			$(".login_error").html("<?php echo $dil["lutfen_kullanici"]; ?>").slideDown(700).delay(2000).slideUp(700,function(){
				$("#username").focus();
				});
			}
		else if(password.length<1){
			$(".login_error").html("<?php echo $dil["lutfen_sifre"]; ?>").slideDown(700).delay(2000).slideUp(700,function(){
				$("#password").focus();
				});
		}else{
			$(".login_error").html("<?php echo $dil["lutfen_bekle"]; ?>").slideDown(700);
			}
		a.preventDefault();
		});
		$(".buynow").click(function(e){
			$(".loading_overlay").fadeIn(700,function(){
				$(".loading_text").animate({
				top:"35%"
				},500);
				});
			e.preventDefault();	
			});
		$(".close").click(function(){
			$(".loading_text").animate({
				top:"-500px"
				},500,function(){
					$(".loading_overlay").fadeOut(700);
					});
			});
			$(".topbar_menu ul li").hover(function(){
			$(this).find("ul").stop().slideDown(700);
			},function(){
			$(this).find("ul").hide();	
				});
			$(".closeit").click(function(){
			$(".login").slideUp();
			});
			$(".feature_left li a").click(function(a){
				$(".feature_left li a").removeClass("aktif");
				$(this).addClass("aktif");
				 var hrefnotsplitted = $(this).attr("href");
				 var href = hrefnotsplitted.split("#");
				 var text = $(this).text();
				 $(".replace").text(text);
				 $(".feature").addClass("hide").removeClass("show").slideUp(700);
				 $("."+href[1]).slideDown(700);
				a.preventDefault();
				});
		});
</script>
</head>

<body>
<?php include("topbarlogin.html"); ?>
<div class="topmenu">
	<div class="container">
	<div class="logo">
    	<a href="/anasayfa"></a>
        <span class="logo_slogan"><?php echo $dil["Kazancin_markasi"]; ?></span>
    </div>
    <div class="menu">
    	<ul>
            <li><a href="/ozellikler"><?php echo $dil["ozellikler_big"]; ?></a></li>
            <li><a href="/ekran-goruntuleri"><?php echo $dil["ekran_goruntuleri_big"]; ?></a></li>
            <li class="active"><a href="/musterilerimiz"><?php echo $dil["referanslar_big"]; ?></a></li>
            <li><a class="first" href="/indir"><?php echo $dil["yukleme"]; ?></a>
            	<ul>
                	<li><a href="/indir"><?php echo $dil["guncel_surum"]; ?></a></li>
                </ul>
            </li>
            <li><a href="https://www.secpayazilim.com/satinal" class="buynow"><?php echo $dil["satin_al"]; ?></a></li>
            <li><a href="/iletisim"><?php echo $dil["iletisim"]; ?></a></li>
        </ul>
    </div>
    <div class="clearfix"></div>
    </div>
</div>
<div class="clients_cont">
<div id="breadcrumb">
			<ul class="crumbs">
				<li class="first"><a href="index.php" style="z-index:9;"><span></span><?php echo $dil["neden_wv"]; ?></a></li>
				<li><a href="clients.php" style="z-index:8;"><?php echo $dil["referanslar"]; ?></a></li>
			</ul>
            <div class="clearfix"></div>
	</div>
	<?php
$dizin = opendir('referanslar');
while($dosya = readdir($dizin)) {
	if($dosya!="." && $dosya!=".."){
   echo '
   <div class="clients_column">
   <img title="'.md5($dosya).'" src="referanslar/'.$dosya.'" />
   </div>';
	}
}
?>
<div class="clearfix"></div>
</div>
<div class="footer_cont"><?php include("footer.html"); ?></div>
</body>
</html>
