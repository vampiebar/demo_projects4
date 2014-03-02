<?php
session_start();
if(!@$_SESSION["dil"]){
	@$_SESSION["dil"]="tr";
	require("dil/tr.php");
}else{
	require("dil/".$_SESSION["dil"].".php");
}
include("config.php");
$sql=mysql_query("select MAX(ManagerUserAgentHit) as managersayi from WorkviewerManagerUserInformation");
$managersayi=mysql_result($sql,0,"managersayi");
$sql=mysql_query("select MAX(ClientUserAgentHit) as clientsayi from WorkviewerClientUserInformation");
$clientsayi=mysql_result($sql,0,"clientsayi");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width;minimum-scale=0.5,maximum-scale=1.0; user-scalable=1;" />
<meta name="keywords" content="Work, Viewer, Workviewer, WorkViewer, Workviever, WorkViever, Workwiever, WorkWiever, Workvıewer, WorkVıewer, Workvivır, Workvıvır, Workviwer, WorkViwer, Ekran izleme, network kontrol, filtreleme, canlı ekran izleme, personel takibi,Bilgisayar izleme, facebook engelleme, facebook engelle, twitter engelle, network izle, pc izle, takip programı, izleme programı, filtre programı, tib onaylı filtre,web filtresi, internet filtresi, tib onaylı filtre programı, onaylı filtre programı, onaylı filtre programları, antiporn uygulaması, porno engelleyici, antiporn, anti-porn, yasak site filtresi, web filter,network yönetimi, network izleme programı, 5651 nolu yasa gereği filtreleme, 5651 yasası açıklamalı, 5651 yasası kapsamı,Employee monitoring, worker monitor, worker activity logging, employee screen watching,Personel, İzleme"/>
<meta name="description" content="Workviewer | Personel verimliliği, network izleme kontrol yazılımı İndirme Sayfası" />
<meta name="Robots" content="index,follow" />
<title>Workviewer | İndir</title>
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
<script src="js/tooltip.js"></script>
<script src="js/modernizr.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('a.yellow').tinyTips('yellow','title');
		$('a.blue').tinyTips('blue','title');
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
			var saniyemanager = 5;
			var saniyeclient = 5;
			var timer;
			var timer2;
			function countdownmanager() {
			saniyemanager--;
			if(saniyemanager >= 1) {
				$(".saniyemanager").html(saniyemanager);
			}else{
				clearInterval(timer);
				window.location.href = "application/setup_manager.exe";
				$.ajax({
					type:"POST",
					data:$(".hiddenform").serialize(),
					url:"sendmanageruserdata.php",
					success:function(){
						
						}
				});
				}
			}
			function countdownclient() {
			saniyeclient--;
			if(saniyeclient >= 1) {
				$(".saniyeclient").html(saniyeclient);
			}else{
				clearInterval(timer2);
				window.location.href = "application/setup_client.exe";
				$.ajax({
					type:"POST",
					data:$(".hiddenform").serialize(),
					url:"sendclientuserdata.php",
					success:function(){
						
						}
				});
				}
			}
			$(".yellow").click(function(){
				$(".download_cont").slideUp(700,function(){
					$("#manager").slideDown(700);
					timer = setInterval(countdownmanager, 1000);
					});
			});
			$(".blue").click(function(){
				$(".download_cont").slideUp(700,function(){
					$("#client").slideDown(700);
					timer2 = setInterval(countdownclient, 1000);
					});
			});
			$(".returnback").click(function(){
				$(".manager_container").slideUp(700,function(){
					$(".download_cont").slideDown(700);
					clearInterval(timer2);
					clearInterval(timer);
					});
				});
			var language = window.navigator.userLanguage || window.navigator.language;
			var viewportWidth = $(document).width();
			var viewportHeight = $(document).height();
			var ua = navigator.userAgent;
			console.log(ua);
			var browser="";
			var checker = {
			  iphone: ua.match(/(iPhone)/),
			  ipad: ua.match(/(iPad)/),
			  ipod: ua.match(/(iPod)/),
			  blackberry: ua.match(/BlackBerry/),
			  android: ua.match(/Android/),
			  chrome: ua.match(/Chrome/),
			  msie: ua.match(/MSIE/),
			  safari: ua.match(/Safari/),
			  isWin2K:  ua.match(/Windows NT 5.0/),
			  isXP:  ua.match(/Windows NT 5.1/),
			  isVista:  ua.match(/Windows NT 6.0/),
			  isWin7:  ua.match(/Windows NT 6.1/)
			};
			if (checker.isWin2K){
				$("#userAgentOS").val("Win2K");
			}
			if (checker.isXP){
				$("#userAgentOS").val("Windows XP");
			}
			if (checker.isVista){
				$("#userAgentOS").val("Windows Vista");
			}
			if (checker.isWin7){
				$("#userAgentOS").val("Windows 7");
			}
			if (checker.android){
				$("#userAgentBrowser").val("Android");
			}
			else if (checker.iphone){
				$("#userAgentBrowser").val("İphone");
			}
			else if (checker.ipad){
				$("#userAgentBrowser").val("İpad");
			}
			else if (checker.ipad){
				$("#userAgentBrowser").val("İpod");
			}
			else if (checker.blackberry){
				$("#userAgentBrowser").val("BlackBerry");
			}
			else if (checker.chrome){
				$("#userAgentBrowser").val("Chrome");
			}
			else if (checker.msie){
				$("#userAgentBrowser").val("İnternet Explorer");
			}
			$("#userAgentLanguage").val(language);
			$("#userAgentResolution").val(viewportWidth+"x"+viewportHeight);
		});
</script>
</head>

<body>
<?php include("topbarlogin.html"); ?>
<form class="hiddenform">
<input type="hidden" name="userAgentLanguage"  id="userAgentLanguage"/>
<input type="hidden" name="userAgentBrowser" id="userAgentBrowser" />
<input type="hidden" name="userAgentOS" id="userAgentOS" />
<input type="hidden" name="userAgentIp" id="userAgentIp" value="<?php echo $_SERVER["REMOTE_ADDR"]; ?>" />
<input type="hidden" name="userAgentResolution" id="userAgentResolution" />
</form>
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
            <li><a href="/musterilerimiz"><?php echo $dil["referanslar_big"]; ?></a></li>
            <li class="active"><a class="first" href="/indir"><?php echo $dil["yukleme"]; ?></a>
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
<div class="download_cont">
	<div class="slogan_cont">
    <h1>Workviewer</h1>
    <p><?php echo $dil["slogan_alt"]; ?></p>
    	<div class="download_link">
        <a class="download_now" href="javascript:void(0);"><?php echo $dil["simdi_ucretsiz_yukleyin"]; ?></a>
        </div>
    </div>
    <div class="software">
    	<div class="column2 windows">
        <a href="#">
        	<img width="128" height="128" src="img/windows.png" />
            <h2><?php echo $dil["windows_icin_wv"]; ?></h2>
            <a href="javascript:void(0)" class="button_download yellow large" title="<?php echo $managersayi ?> <?php echo $dil["indirildi"] ?>" style="margin-bottom:10px; margin-left:30px;"><?php echo $dil["server_uygulamasi"]; ?></a>
            <a href="javascript:void(0)" class="button_download blue large" title="<?php echo $clientsayi ?> <?php echo $dil["indirildi"] ?>" style="margin-left:30px;"><?php echo $dil["client_uygulamasi"]; ?></a>
            <p style="background-color:#C30; line-height:normal; color:#fff; margin:10px 0px; margin-left:30px; padding:5px; width:218px;"><?php echo $dil["download_notice"]; ?></p>
            <span class="supported"><?php echo $dil["desteklenen_platformlar"]; ?> <br />
            Windows 8 x32 x64<br />
            Windows 7 x32 x64<br />
            Windows Xp x32 x64</span>
        </a>
        </div>
        <div class="column2 linux">
        <div class="perde"></div>
        <div class="column2_text"><?php echo $dil["linux_surumu_cok_yakinda"]; ?></div>
        <a href="#">
        	<img width="128" height="128" src="img/Linux.png" />
            <h2>Linux için Workviewer</h2>
            <a href="#" class="button_download yellow large" style="margin-bottom:10px;"><?php echo $dil["server_uygulamasi"]; ?></a>
            <a href="#" class="button_download blue large"><?php echo $dil["client_uygulamasi"]; ?></a>
        </a>
        </div>
        <div class="column2 mac">
        <div class="perde"></div>
        <div class="column2_text"><?php echo $dil["mac_surumu_cok_yakinda"]; ?></div>
        <a href="#">
        	<img width="128" height="128" src="img/apple.png" />
            <h2>Mac için Workviewer</h2>
            <a href="#" class="button_download yellow large" style="margin-bottom:10px;"><?php echo $dil["server_uygulamasi"]; ?></a>
            <a href="#" class="button_download blue large"><?php echo $dil["client_uygulamasi"]; ?></a>
        </a>
        </div>
    </div>
</div>
<div class="manager_container" id="manager">
	<h1><?php echo $dil["indir_slogan"]; ?></h1>
    <h1 style="background-color:#C30; line-height:normal; color:#fff; margin-bottom:10px;"><?php echo $dil["download_notice2"]; ?></h1>
	<div class="manager_resim">
    	<object width="400" height="300"><param name="movie" value="//www.youtube.com/v/GaeUybFbuoA?hl=tr_TR&amp;version=3&amp;rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="//www.youtube.com/v/GaeUybFbuoA?hl=tr_TR&amp;version=3&amp;rel=0" type="application/x-shockwave-flash" width="400" height="300" allowscriptaccess="always" allowfullscreen="true"></embed></object>
    </div>
    <div class="manager_downloading">
    	<h2><?php echo $dil["indir_yukleniyor"]; ?></h2>
        <p><b>(<span class="saniyemanager">5</span></b> <?php echo $dil["indir_saniye"]; ?> <?php echo $dil["indir_baslamazsa"]; ?></p>
        <div class="platform_scene">
        <div class="platform">
        	<img src="img/windows.png" />
        </div>
        <div class="platform_text">
        	<p class="dp"><?php echo $dil["indir_platformlar"]; ?></p>
            <ul>
            	<li>Windows Xp - x86 - x64</li>
                <li>Windows Vista - x86 - x64</li>
                <li>Windows 7 - x86 - x64</li>
                <li>Windows 8 - x86 - x64</li>
            </ul>
        </div>
        <div class="clear"></div>
        </div>
        <div class="install_scene">
        <div class="install_text">
        	<p class="dp"><?php echo $dil["indir_kurulumnotlari"]; ?></p>
            <ol class="ol">
            	<li><?php echo $dil["indir_not_1"]; ?></li>
                <li><?php echo $dil["indir_not_2"]; ?></li>
                <li><?php echo $dil["indir_not_3"]; ?></li>
                <li><?php echo $dil["indir_not_4"]; ?></li>
                <li><?php echo $dil["indir_not_5"]; ?></li>
                <li><?php echo $dil["indir_not_6"]; ?></li>                
                <li><?php echo $dil["indir_not_7"]; ?></li>
                <li><?php echo $dil["indir_not_8"]; ?></li>
            </ol>
        </div>
        </div>
    </div>
    <div class="clear"></div>
    <a href="javascript:void(0)" class="button_download returnback large" style="margin-bottom:10px; margin-left:30px;"><?php echo $dil["indir_geri_don"]; ?></a>
</div>
<div class="manager_container" id="client">
	<h1><?php echo $dil["indir_slogan"]; ?></h1>
	<div class="manager_resim">
    	<object width="400" height="300"><param name="movie" value="//www.youtube.com/v/4eY-ay559ro?hl=tr_TR&amp;version=3&amp;rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="//www.youtube.com/v/4eY-ay559ro?hl=tr_TR&amp;version=3&amp;rel=0" type="application/x-shockwave-flash" width="400" height="300" allowscriptaccess="always" allowfullscreen="true"></embed></object>
    </div>
    <div class="manager_downloading">
    	<h2><?php echo $dil["indir_yukleniyor_client"]; ?></h2>
        <p><b>(<span class="saniyeclient">5</span></b> <?php echo $dil["indir_saniye"]; ?> <?php echo $dil["indir_baslamazsa2"]; ?></p>
        <div class="platform_scene">
        <div class="platform">
        	<img src="img/windows.png" />
        </div>
        <div class="platform_text">
        	<p class="dp"><?php echo $dil["indir_platformlar"]; ?></p>
            <ul>
            	<li>Windows Xp - x86 - x64</li>
                <li>Windows Vista - x86 - x64</li>
                <li>Windows 7 - x86 - x64</li>
                <li>Windows 8 - x86 - x64</li>
            </ul>
        </div>
        <div class="clear"></div>
        </div>
        <div class="install_scene">
        <div class="install_text">
        	<p class="dp"><?php echo $dil["indir_kurulumnotlari"]; ?></p>
            <ol class="ol">
            	<li><?php echo $dil["indir_not_9"]; ?></li>
                <li><?php echo $dil["indir_not_2"]; ?></li>
                <li><?php echo $dil["indir_not_6"]; ?></li>                
                <li><?php echo $dil["indir_not_7"]; ?></li>
                <li><?php echo $dil["indir_not_8"]; ?></li>
            </ol>
        </div>
        </div>
    </div>
    <div class="clear"></div>
    <a href="javascript:void(0)" class="button_download returnback large" style="margin-bottom:10px; margin-left:30px;"><?php echo $dil["indir_geri_don"]; ?></a>
</div>
<div class="footer_cont"><?php include("footer.html"); ?></div>
</body>
</html>