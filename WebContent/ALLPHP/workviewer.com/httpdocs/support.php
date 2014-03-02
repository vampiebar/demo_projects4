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
<title>Workviewer</title>
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
<script type="text/javascript" src="js/gmapsensor.js"></script>
<script type="text/javascript" src="js/gmaps.js"></script>
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
    	<a href="index.php"></a>
        <span class="logo_slogan"><?php echo $dil["Kazancin_markasi"]; ?></span>
    </div>
    <div class="menu">
    	<ul>
        	<li><a class="first" href="index.php"><?php echo $dil["neden_wv"]; ?></a>
            	<ul>
                	<li><a href="index.php"><?php echo $dil["anasayfa"]; ?></a></li>
                    <li><a href="features.php"><?php echo $dil["ozellikler"]; ?></a></li>
                    <li><a href="screenshots.php"><?php echo $dil["ekran_goruntuleri"]; ?></a></li>
                    <li><a href="clients.php"><?php echo $dil["referanslar"]; ?></a></li>
                </ul>
            </li>
            <li><a class="first" href="download.php"><?php echo $dil["yukleme"]; ?></a>
            	<ul>
                	<li><a href="download.php"><?php echo $dil["guncel_surum"]; ?></a></li>
                </ul>
            </li>
            <li class="active"><a class="first" href="support.php"><?php echo $dil["destek"]; ?></a>
            	<!--<ul>
                	<li><a href="#">Sıkça Sorulan Sorular</a></li>
                    <li><a href="#">Belgeler</a></li>
                    <li><a href="#">Videolar</a></li>
                </ul>
                -->
            </li>
            <li><a href="https://www.secpayazilim.com/satinal" class="buynow"><?php echo $dil["satin_al"]; ?></a></li>
            <li><a href="iletisim.php"><?php echo $dil["iletisim"]; ?></a></li>
        </ul>
    </div>
    <div class="clearfix"></div>
    </div>
</div>
<div class="features_cont">
	<div id="breadcrumb">
			<ul class="crumbs">
				<li class="first"><a href="support.php" style="z-index:9;"><span></span><?php echo $dil["destek"]; ?></a></li>
				<li><a href="support.php" style="z-index:8;"><?php echo $dil["faq"]; ?></a></li>
                <li><a class="replace" href="#" style="z-index:7;">Sorun 1</a></li>
			</ul>
	</div>
    <div class="clearfix"></div>
    <div class="feature_left">
    	<ul>
        	<li><a class="aktif" href="#screen_watch">Sorun 1</a></li>
            <li><a href="#filter">Sorun 2</a></li>
            <li><a href="#downloadsection">Sorun 3</a></li>
            <li><a href="#time">Sorun 4</a></li>
            <li><a href="#bandwidth">Sorun 5</a></li>
            <li><a href="#kullanim">Sorun 6</a></li>
            <li><a href="#multimedia">Sorun 7</a></li>
            <li><a href="#bilgi">Sorun 8</a></li>
            <li><a href="#mesajlas">Sorun 9</a></li>
            <li><a href="#yonetici">Sorun 10</a></li>
            <li><a href="#raporlama">Sorun 11</a></li>
            <li><a href="#esnek">Sorun 12</a></li>
            <li><a href="#tib">Sorun 13</a></li>
            <li><a href="#kk">Sorun 14</a></li>
        </ul>
    </div>
    <div class="feature_right">
    	<div class="feature screen_watch">
    	<h2>Sorun 1</h2>
        <p>Lorem Ipsum, dizgi ve baskı endüstrisinde kullanılan mıgır metinlerdir. Lorem Ipsum, adı bilinmeyen bir matbaacının bir hurufat numune kitabı oluşturmak üzere bir yazı galerisini alarak karıştırdığı 1500'lerden beri endüstri standardı sahte metinler olarak kullanılmıştır.</p>
        </div>
        <div class="feature filter hide">
    	<h2>Sorun 2</h2>
        <p>Lorem Ipsum, dizgi ve baskı endüstrisinde kullanılan mıgır metinlerdir. Lorem Ipsum, adı bilinmeyen bir matbaacının bir hurufat numune kitabı oluşturmak üzere bir yazı galerisini alarak karıştırdığı 1500'lerden beri endüstri standardı sahte metinler olarak kullanılmıştır.</p>
        </div>
        <div class="feature downloadsection hide">
    	<h2>Sorun 3</h2>
        <p>Lorem Ipsum, dizgi ve baskı endüstrisinde kullanılan mıgır metinlerdir. Lorem Ipsum, adı bilinmeyen bir matbaacının bir hurufat numune kitabı oluşturmak üzere bir yazı galerisini alarak karıştırdığı 1500'lerden beri endüstri standardı sahte metinler olarak kullanılmıştır.</p>
        </div>
        <div class="feature time hide">
    	<h2>Sorun 4</h2>
        <p>Lorem Ipsum, dizgi ve baskı endüstrisinde kullanılan mıgır metinlerdir. Lorem Ipsum, adı bilinmeyen bir matbaacının bir hurufat numune kitabı oluşturmak üzere bir yazı galerisini alarak karıştırdığı 1500'lerden beri endüstri standardı sahte metinler olarak kullanılmıştır.</p>
        </div>
        <div class="feature bandwidth hide">
    	<h2>Sorun 5</h2>
        <p>Lorem Ipsum, dizgi ve baskı endüstrisinde kullanılan mıgır metinlerdir. Lorem Ipsum, adı bilinmeyen bir matbaacının bir hurufat numune kitabı oluşturmak üzere bir yazı galerisini alarak karıştırdığı 1500'lerden beri endüstri standardı sahte metinler olarak kullanılmıştır.</p>
        </div>
        <div class="feature kullanim hide">
    	<h2>Sorun 6</h2>
        <p>Lorem Ipsum, dizgi ve baskı endüstrisinde kullanılan mıgır metinlerdir. Lorem Ipsum, adı bilinmeyen bir matbaacının bir hurufat numune kitabı oluşturmak üzere bir yazı galerisini alarak karıştırdığı 1500'lerden beri endüstri standardı sahte metinler olarak kullanılmıştır.</p>
        </div>
        <div class="feature multimedia hide">
    	<h2>Sorun 7</h2>
        <p>Lorem Ipsum, dizgi ve baskı endüstrisinde kullanılan mıgır metinlerdir. Lorem Ipsum, adı bilinmeyen bir matbaacının bir hurufat numune kitabı oluşturmak üzere bir yazı galerisini alarak karıştırdığı 1500'lerden beri endüstri standardı sahte metinler olarak kullanılmıştır.</p>
        </div>
        <div class="feature bilgi hide">
    	<h2>Sorun 8</h2>
        <p>Lorem Ipsum, dizgi ve baskı endüstrisinde kullanılan mıgır metinlerdir. Lorem Ipsum, adı bilinmeyen bir matbaacının bir hurufat numune kitabı oluşturmak üzere bir yazı galerisini alarak karıştırdığı 1500'lerden beri endüstri standardı sahte metinler olarak kullanılmıştır.</p>
        </div>
        <div class="feature mesajlas hide">
    	<h2>Sorun 9</h2>
        <p>Lorem Ipsum, dizgi ve baskı endüstrisinde kullanılan mıgır metinlerdir. Lorem Ipsum, adı bilinmeyen bir matbaacının bir hurufat numune kitabı oluşturmak üzere bir yazı galerisini alarak karıştırdığı 1500'lerden beri endüstri standardı sahte metinler olarak kullanılmıştır.</p>
        </div>
        <div class="feature yonetici hide">
    	<h2>Sorun 10</h2>
        <p>Lorem Ipsum, dizgi ve baskı endüstrisinde kullanılan mıgır metinlerdir. Lorem Ipsum, adı bilinmeyen bir matbaacının bir hurufat numune kitabı oluşturmak üzere bir yazı galerisini alarak karıştırdığı 1500'lerden beri endüstri standardı sahte metinler olarak kullanılmıştır.</p>
        </div>
        <div class="feature raporlama hide">
    	<h2>Sorun 11</h2>
        <p>Lorem Ipsum, dizgi ve baskı endüstrisinde kullanılan mıgır metinlerdir. Lorem Ipsum, adı bilinmeyen bir matbaacının bir hurufat numune kitabı oluşturmak üzere bir yazı galerisini alarak karıştırdığı 1500'lerden beri endüstri standardı sahte metinler olarak kullanılmıştır.</p>
        </div>
        <div class="feature esnek hide">
    	<h2>Sorun 12</h2>
        <p>Lorem Ipsum, dizgi ve baskı endüstrisinde kullanılan mıgır metinlerdir. Lorem Ipsum, adı bilinmeyen bir matbaacının bir hurufat numune kitabı oluşturmak üzere bir yazı galerisini alarak karıştırdığı 1500'lerden beri endüstri standardı sahte metinler olarak kullanılmıştır.</p>
        </div>
        <div class="feature tib hide">
    	<h2>Sorun 13</h2>
        <p>5651 numaralı Kanun gereği internet sağlayıcılar (Firmalar, İnternet Cafeler vb.) kullandıkları ve dışardan internet kullanımına izin verdiğiniz tüm bilgisayarların İP Loglarını tutma zorunluluğu vardır. Tutulmadığı takdirde; herhangi bir suç teşkil eden durumda ADSL aboneliği kimin üzerine ise sorumluluk ona aittir. Workviewer bu sorumluluğu üzerinizden atmanızı sağlayacak TİB’in kabul ettiği zaman damgalı iç İP Loglarını tutabilme ve bunları raporlayabilme yeteneğine sahip bir yazılımdır.</p>
        </div>
        <div class="feature kk hide">
    	<h2>Sorun 14</h2>
        <p>Lorem Ipsum, dizgi ve baskı endüstrisinde kullanılan mıgır metinlerdir. Lorem Ipsum, adı bilinmeyen bir matbaacının bir hurufat numune kitabı oluşturmak üzere bir yazı galerisini alarak karıştırdığı 1500'lerden beri endüstri standardı sahte metinler olarak kullanılmıştır.</p>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="footer_cont"><?php include("footer.html"); ?></div>
</body>
</html>