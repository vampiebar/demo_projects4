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
<meta name="keywords" content="Work, Viewer, Workviewer, WorkViewer, Workviever, WorkViever, Workwiever, WorkWiever, Workvıewer, WorkVıewer, Workvivır, Workvıvır, Workviwer, WorkViwer, Ekran izleme, network kontrol, filtreleme, canlı ekran izleme, personel takibi,Bilgisayar izleme, facebook engelleme, facebook engelle, twitter engelle, network izle, pc izle, takip programı, izleme programı, filtre programı, tib onaylı filtre,web filtresi, internet filtresi, tib onaylı filtre programı, onaylı filtre programı, onaylı filtre programları, antiporn uygulaması, porno engelleyici, antiporn, anti-porn, yasak site filtresi, web filter,network yönetimi, network izleme programı, 5651 nolu yasa gereği filtreleme, 5651 yasası açıklamalı, 5651 yasası kapsamı,Employee monitoring, worker monitor, worker activity logging, employee screen watching,Personel, İzleme, uzaktan pc takip, pc takip"/>
<meta name="description" content="Bilgisayar ağınızı canlı olarak dilediğiniz cihaz ve yerden izleyin, kontrol altına alın ve yönetin. Personel verimliliğini en üst seviye ye çıkartmak elinizde." />
<meta name="author" content="Seçpa Yazılım" />
<meta name="Robots" content="index,follow" />
<title>Workviewer Uzaktan Pc İzleme ve Kontrol Yazılımı | Anasayfa</title>
<meta name=\"norton-safeweb-site-verification\" content=\"authentication_string\"/>
<meta name="wot-verification" content="782f1e9e2ae54311b3be"/>
<link rel="stylesheet" type="text/css" href="css/reset.css" />
<!-- <link rel="stylesheet" type="text/css" href="css/prettify.css" /> -->
<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css" /> -->
<!--<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" /> -->
<link href='http://fonts.googleapis.com/css?family=Merriweather+Sans:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,400italic,700italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/animate.css" />
<link rel="stylesheet" type="text/css" href="css/site.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/slider.js"></script>
<!--<script type="text/javascript" src="js/bootstrap.min.js"></script>-->
<script src="http://a.vimeocdn.com/js/froogaloop2.min.js"></script>
<script src="js/modernizr.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
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
	var sure = 600000;
	var toplamLi = $(".banner ul li").length;
	var liWidth = 700;
	var toplamWidth = liWidth * toplamLi;
	var liDeger = 0;
	$(".banner ul").css("width", toplamWidth + "px");

	$(".next").click(function(){
		if (liDeger < toplamLi - 1){
			liDeger++;
			yeniWidth = liWidth * liDeger;
			$(".banner ul").animate({marginLeft: "-" + yeniWidth + "px"}, 500);
		}  else {
			liDeger = 0;
			$(".banner ul").animate({marginLeft: "0"}, 500);
		} 
		return false;
	})

	$(".prev").click(function(){
		if (liDeger > 0){
			liDeger--;
			yeniWidth = liWidth * liDeger;
			$(".banner ul").animate({marginLeft: "-" + yeniWidth + "px"}, 500);
		}
		return false;
	})

	$.Slider = function(){
		if (liDeger < toplamLi - 1){
			liDeger++;
			yeniWidth = liWidth * liDeger;
			$(".banner ul").animate({marginLeft: "-" + yeniWidth + "px"}, 500);
		} else {
			liDeger = 0;
			$(".banner ul").animate({marginLeft: "0"}, 500);
		}
	}

	var don = setInterval("$.Slider()", sure);

	$(".banner").hover(function(){
		clearInterval(don);
	}, function(){
		don = setInterval("$.Slider()", sure);
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
				top:"-700px"
				},500,function(){
					$(".loading_overlay").fadeOut(700);
					});
			});
		$(".close_video").click(function(){
			$(".loading_text_video").animate({
				top:"-700px"
				},500,function(){
					$(".loading_overlay_video").fadeOut(700);
					//var iframe = $('#video')[0];
					//var player = $f(iframe);
					//player.api('pause');
					player.pauseVideo();
					});
			});
		$(".videoplay").click(function(){
			$(".loading_overlay_video").fadeIn(700,function(){
				$(".loading_text_video").animate({
				top:"30%"
				},500);
				player.playVideo();
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
			Slider();
			var autoslider = setInterval(AutoSlider,6000);
			$("div.column").hover(function(){
				clearInterval(autoslider);
				},function(){
					autoslider = setInterval(AutoSlider,6000);
					});
		});
function Slider(){
    	if(jQuery("#gallery").length){
        var totalImages = jQuery("#gallery > li").length, 
            imageWidth = jQuery("#gallery > li:first").outerWidth(true),
            totalWidth = imageWidth * totalImages,
			maxWidth=imageWidth*3,
            visibleImages = Math.round(jQuery(".content").width() / imageWidth),
            visibleWidth = visibleImages * imageWidth,
            stopPosition = (visibleWidth - totalWidth);
			$(".content").css("width",maxWidth+5);
        	jQuery("#gallery").width(totalWidth);
        	jQuery("#gallery-prev").click(function(){
            if(jQuery("#gallery").position().left < 0 && !jQuery("#gallery").is(":animated")){
                jQuery("#gallery").animate({left : "+=" + imageWidth + "px"});
            }
            return false;
        	});
        	jQuery("#gallery-next").click(function(){
            if(jQuery("#gallery").position().left > stopPosition && !jQuery("#gallery").is(":animated")){
                jQuery("#gallery").animate({left : "-=" + imageWidth + "px"});
            }else{
				jQuery("#gallery").animate({left : "0px"});
				}
            return false;
        });
    }
		}
function AutoSlider(){
	var totalImages = jQuery("#gallery > li").length, 
	imageWidth = jQuery("#gallery > li").outerWidth(true),
	totalWidth = imageWidth * totalImages,
	maxWidth=imageWidth*3,
	visibleImages = Math.round(jQuery(".content").width() / imageWidth),
	visibleWidth = visibleImages * imageWidth,
	stopPosition = (visibleWidth - totalWidth);
	$(".content").css("width",maxWidth+5);
	jQuery("#gallery").width(totalWidth);
	if(jQuery("#gallery").position().left > stopPosition && !jQuery("#gallery").is(":animated")){
                jQuery("#gallery").animate({left : "-=" + imageWidth + "px"});
            }else{
				jQuery("#gallery").animate({left : "0px"});
				}      
	}
</script>
<script type="text/javascript">
var fb_param = {};
fb_param.pixel_id = '6008924536510';
fb_param.value = '0.00';
fb_param.currency = 'TRY';
(function(){
  var fpw = document.createElement('script');
  fpw.async = true;
  fpw.src = '//connect.facebook.net/en_US/fp.js';
  var ref = document.getElementsByTagName('script')[0];
  ref.parentNode.insertBefore(fpw, ref);
})();
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/offsite_event.php?id=6008924536510&amp;value=0&amp;currency=TRY" /></noscript>
</head>

<body>
<?php include("topbarlogin.html"); ?>
<div class="loading_overlay_video">
<div class="overlay_loading_video"></div>
<div class="loading_text_video">
<!--<iframe width="700" height="402" src="//www.youtube.com/embed/ksRTO8cNM_g" frameborder="0" allowfullscreen></iframe>-->
<div id="player"></div>
<div class="close_video">X</div>
</div>
</div>
<script>
    //Load player api asynchronously.
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    var done = false;
    var player;
    function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '402',
          width: '700',
          videoId: 'ksRTO8cNM_g'
        });
    }
</script>
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
<div class="slider_cont">
<div class="sliderkapsul">
<div class="sliderleft">
<div class="sliderleftimage">
<img src="img/anasayfasol.jpg" width="444" />
<div class="sliderimageslogan">
	<h2>Workviewer ile internet bağlantısı olan tüm cihazlardan PC'lerinize ulaşabilirsiniz.</h2>
</div>
</div>
<div class="download">
<!-- <span class="wm">Windows, Unix ve Mac tabanlı bilgisayarlar için uygundur.</span> -->
    <a href="/indir" class="a-btn bounceIn">
        <span class="a-btn-slide-text"></span>
        <span class="a-btn-text" <?php if($_SESSION["dil"]=="sp" || $_SESSION["dil"]=="alm" ){ echo 'style="font-size:24px;"';} ?>><?php echo $dil["ucretsiz_indir"]; ?></span> 
        <span class="a-btn-icon-right"><span></span></span>
    </a>
</div>
</div>
<div class="banner">
    <ul>
    	<li>
        <img width="700" height="402" src="img/workviewerbg.jpg" />
       	<p class="tanitim"><?php echo $dil["tanitim"]; ?></p> 
        <i class="icon-youtube-play icon-large videoplay"></i>
        </li>
        <li>
        <img width="700" height="402" src="img/slidertime.png" />
        <p class="image_slogan" style="top:345px;"><?php echo $dil["image_slogan9"]; ?></p>
        </li>
        <li>
        <img width="700" height="402" src="img/slidernew.png" />
        <p class="image_slogan"><?php echo $dil["image_slogan7"]; ?></p>
        <p class="image_slogan2" style="top:335px;"><?php echo $dil["image_slogan8"]; ?></p>
        </li>
        <li>
        <img width="700" height="402" src="img/slider2.jpg" />
        <p class="image_slogan"><?php echo $dil["image_slogan"]; ?></p>
        <p class="image_slogan2"><?php echo $dil["image_slogan2"]; ?></p>
        </li>
        <li>
        <img width="700" height="402" src="img/slider1.jpg" />
        <p class="image_slogan4"><?php echo $dil["image_slogan4"]; ?></p>
        <p class="image_slogan3"><?php echo $dil["image_slogan3"]; ?></p>
        </li>
        <li>
        <img width="700" height="402" src="img/moneycrush.png" />
        <p class="image_slogan5"><?php echo $dil["image_slogan5"]; ?></p>
        <a href="javascript:void(0)" class="image_slogan6"><?php echo $dil["image_slogan6"]; ?></a>
        </li>
        <div class="clearfix"></div>
    </ul>
    <a href="#" class="prev"></a>
	<a href="#" class="next"></a>
</div>
</div>
<div class="clearfix"></div>
 
</div>
</div>
<div class="content_cont">
	<div class="content">
    <div id="gallery-controls">
        <a href="#" id="gallery-prev">
        	<img src="img/prev_gallery.png" width="32" />
        </a>
        <a href="#" id="gallery-next">
        	<img src="img/next_gallery.png" width="32" />
        </a>
        </div>
        <ul id="gallery">
        	<li>
            	<div class="column">
                <div class="column_title">
                    <h2 class="right_title"><?php echo $dil["ekran_izleme"]; ?></h2>
                    <a href="features.php#screen_watch" class="plus">+</a>
                </div>
                    <a href="features.php#screen_watch"><p style="text-align:center;"><i class="icon-desktop" style="font-size:100px; color:#29a9df;"></i></p></a>
                    <h3><?php echo $dil["ekran_izleme"]; ?></h3>
                    <p><?php echo $dil["ekran_izleme_text"]; ?></p>
                    <a href="features.php#screen_watch"><?php echo $dil["daha_fazla"]; ?></a>
                </div>
            </li>
			<li>
            	<div class="column">
                    <div class="column_title">
                    <h2 class="right_title"><?php echo $dil["filtreleme"]; ?></h2>
                    <a href="features.php#filter" class="plus">+</a>
        		</div>
                    <a href="features.php#filter"><p style="text-align:center;"><i class="icon-umbrella" style="font-size:100px; color:#29a9df;"></i></p></a>
                    <h3><?php echo $dil["filtreleme"]; ?></h3>
                    <p><?php echo $dil["filtreleme_text"]; ?></p>
                    <a href="features.php#filter"><?php echo $dil["daha_fazla"]; ?></a>
        		</div>
            </li>
            <!--<li>
            	<div class="column">
                <div class="column_title">
                    <h2 class="right_title"><?php echo $dil["raporlama"]; ?></h2>
                    <a href="features.php#raporlama" class="plus">+</a>
                </div>
                    <a href="features.php#raporlama"><p style="text-align:center;"><i class="icon-bar-chart" style="font-size:100px; color:#29a9df;"></i></p></a>
                    <h3><?php echo $dil["raporlama"]; ?></h3>
                    <p><?php echo $dil["raporlama_text"]; ?></p>
                    <a href="features.php#raporlama"><?php echo $dil["daha_fazla"]; ?></a>
                </div>
            </li>
            --> 
            <li>
            	<div class="column">
                <div class="column_title">
                    <h2 class="right_title"><?php echo $dil["sure_sinirlamasi"]; ?></h2>
                    <a href="features.php#time" class="plus">+</a>
                </div>
                   <a href="features.php#time"><p style="text-align:center;"><i class="icon-time" style="font-size:100px; color:#29a9df;"></i></p></a>
                    <h3><?php echo $dil["sure_sinirlamasi"]; ?></h3>
                    <p><?php echo $dil["ss_text"]; ?></p>
                    <a href="features.php#time"><?php echo $dil["daha_fazla"]; ?></a>
                </div>
            </li>
            <!--<li>
            	<div class="column">
                <div class="column_title">
                    <h2 class="right_title"><?php echo $dil["bandwidth_kontrol"]; ?></h2>
                    <a href="features.php#bandwidth" class="plus">+</a>
                </div>
                    <a href="features.php#bandwidth"><p style="text-align:center;"><i class="icon-exchange" style="font-size:100px; color:#29a9df;"></i></p></a>
                    <h3><?php echo $dil["bandwidth_kontrol"]; ?></h3>
                    <p><?php echo $dil["band_text"]; ?></p>
                    <a href="features.php#bandwidth"><?php echo $dil["daha_fazla"]; ?></a>
                </div>
            </li>-->
			<li>
            	<div class="column">
                    <div class="column_title">
                    <h2 class="right_title"><?php echo $dil["program_kullanim_siniri"]; ?></h2>
                    <a href="features.php#kullanim" class="plus">+</a>
        		</div>
                    <a href="features.php#kullanim"><p style="text-align:center;"><i class="icon-ban-circle" style="font-size:100px; color:#29a9df;"></i></p></a>
                    <h3><?php echo $dil["program_kullanim_siniri"]; ?></h3>
                    <p><?php echo $dil["program_kullanim_siniri_text"]; ?></p>
                    <a href="features.php#kullanim"><?php echo $dil["daha_fazla"]; ?></a>
        		</div>
            </li>
            <!--<li>
            	<div class="column">
                <div class="column_title">
                    <h2 class="right_title"><?php echo $dil["multimedia_filtresi"]; ?></h2>
                    <a href="features.php#multimedia" class="plus">+</a>
                </div>
                    <a href="features.php#multimedia"><p style="text-align:center;"><i class="icon-headphones" style="font-size:100px; color:#29a9df;"></i></p></a>
                    <h3><?php echo $dil["multimedia_filtresi"]; ?></h3>
                    <p><?php echo $dil["multimedia_filtresi_text"]; ?></p>
                    <a href="features.php#multimedia"><?php echo $dil["daha_fazla"]; ?></a>
                </div>
            </li>--> 
            <li>
            	<div class="column">
                <div class="column_title">
                    <h2 class="right_title"><?php echo $dil["bilgi_guvenligi"]; ?></h2>
                    <a href="features.php#bilgi" class="plus">+</a>
                </div>
                    <a href="features.php#bilgi"><p style="text-align:center;"><i class="icon-briefcase" style="font-size:100px; color:#29a9df;"></i></p></a>
                    <h3><?php echo $dil["bilgi_guvenligi"]; ?></h3>
                    <p><?php echo $dil["bilgi_guvenligi_text"]; ?></p>
                    <a href="features.php#bilgi"><?php echo $dil["daha_fazla"]; ?></a>
                </div>
            </li>
            <!--<li>
            	<div class="column">
                <div class="column_title">
                    <h2 class="right_title"><?php echo $dil["ag_ici_ag_disi_mesajlasabilme"]; ?></h2>
                    <a href="features.php#mesajlas" class="plus">+</a>
                </div>
                    <a href="features.php#mesajlas"><p style="text-align:center;"><i class="icon-envelope" style="font-size:100px; color:#29a9df;"></i></p></a>
                    <h3><?php echo $dil["ag_ici_ag_disi_mesajlasabilme"]; ?></h3>
                    <p><?php echo $dil["ag_ici_ag_disi_mesajlasabilme_text"]; ?></p>
                    <a href="features.php#mesajlas"><?php echo $dil["daha_fazla"]; ?></a>
                </div>
            </li>
            <li>
            	<div class="column">
                <div class="column_title">
                    <h2 class="right_title"><?php echo $dil["yonetici_atama_yetkilendirme"]; ?></h2>
                    <a href="features.php#yonetici" class="plus">+</a>
                </div>
                    <a href="features.php#yonetici"><p style="text-align:center;"><i class="icon-user" style="font-size:100px; color:#29a9df;"></i></p></a>
                    <h3><?php echo $dil["yonetici_atama_yetkilendirme"]; ?></h3>
                    <p><?php echo $dil["yonetici_atama_yetkilendirme_text"]; ?></p>
                    <a href="features.php#yonetici"><?php echo $dil["daha_fazla"]; ?></a>
                </div>
            </li>-->
            <li>
            	<div class="column">
                <div class="column_title">
                    <h2 class="right_title"><?php echo $dil["esnek_kontrol"]; ?></h2>
                    <a href="features.php#esnek" class="plus">+</a>
                </div>
                    <a href="features.php#esnek"><p style="text-align:center;"><i class="icon-tablet" style="font-size:100px; color:#29a9df;"></i></p></a>
                    <h3><?php echo $dil["esnek_kontrol"]; ?></h3>
                    <p><?php echo $dil["esnek_kontrol_text"]; ?></p>
                    <a href="features.php#esnek"><?php echo $dil["daha_fazla"]; ?></a>
                </div>
            </li>
            <!--<li>
            	<div class="column">
                <div class="column_title">
                    <h2 class="right_title"><?php echo $dil["tib_onayi"]; ?></h2>
                    <a href="features.php#tib" class="plus">+</a>
                </div>
                    <a href="features.php#tib"><p style="text-align:center;"><i class="icon-check" style="font-size:100px; color:#29a9df;"></i></p></a>
                    <h3><?php echo $dil["tib_onayi"]; ?></h3>
                    <p><?php echo $dil["tib_onayi_text"]; ?></p>
                    <a href="features.php#tib"><?php echo $dil["daha_fazla"]; ?></a>
                </div>
            </li>-->
            <li>
            	<div class="column">
                <div class="column_title">
                    <h2 class="right_title"><?php echo $dil["kolay_kullanim"]; ?></h2>
                    <a href="features.php#kk" class="plus">+</a>
                </div>
                    <a href="features.php#kk"><p style="text-align:center;"><i class="icon-thumbs-up" style="font-size:100px; color:#29a9df;"></i></p></a>
                    <h3><?php echo $dil["kolay_kullanim"]; ?></h3>
                    <p><?php echo $dil["kolay_kullanim_text"]; ?></p>
                    <a href="features.php#kk"><?php echo $dil["daha_fazla"]; ?></a>
                </div>
            </li>       
        </ul>
    </div>
</div>
<div class="footer_cont"><?php include("footer.html"); ?></div>
</body>
</html>