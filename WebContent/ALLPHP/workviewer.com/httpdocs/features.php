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
<meta name="description" content="Workviewer Özellikler Sayfası" />
<meta name="Robots" content="index,follow" />
<title>Workviewer | Özellikler</title>
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
				});
				var hash = window.location.hash.split("#");
				if(hash[1].length>0){
					$(".feature").addClass("hide");
					$("."+hash[1]).removeClass("hide");
					$(".feature_left ul li a").removeClass("aktif");
					$(".feature_left ul li a[href$=#"+hash[1]+"]").addClass("aktif");
					var textlink = $(".feature_left ul li a[href$=#"+hash[1]+"]").text();
					$(".replace").text(textlink);
					}else{
					$(".screen_watch").removeClass("hide");	
					}
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
            <li class="active"><a href="/ozellikler"><?php echo $dil["ozellikler_big"]; ?></a></li>
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
<div class="features_cont">
	<div id="breadcrumb">
			<ul class="crumbs">
				<li class="first"><a href="/anasayfa" style="z-index:9;"><span></span><?php echo $dil["neden_wv"]; ?></a></li>
				<li><a href="/ozellikler" style="z-index:8;"><?php echo $dil["ozellikler"]; ?></a></li>
                <li><a class="replace" href="#" style="z-index:7;"><?php echo $dil["ekran_izleme"]; ?></a></li>
			</ul>
	</div>
    <div class="clearfix"></div>
    <div class="feature_left">
    	<ul>
        	<li><a class="aktif" href="#screen_watch"><i class="icon-desktop"></i> <?php echo $dil["ekran_izleme"]; ?></a></li>
            <li><a href="#filter"><i class="icon-umbrella"></i> <?php echo $dil["filtreleme"]; ?></a></li>
            <!-- <li><a href="#downloadsection"><i class="icon-minus-sign"></i> <?php echo $dil["download_kisitlamasi"]; ?></a></li> -->
            <li><a href="#time"><i class="icon-time"></i> <?php echo $dil["sure_sinirlamasi"]; ?></a></li>
            <!--<li><a href="#bandwidth"><i class="icon-exchange"></i> <?php echo $dil["bandwidth_kontrol"]; ?></a></li> -->
            <li><a href="#kullanim"><i class="icon-ban-circle"></i> <?php echo $dil["program_kullanim_siniri"]; ?></a></li>
            <!--<li><a href="#multimedia"><i class="icon-headphones"></i> <?php echo $dil["multimedia_filtresi"]; ?></a></li> -->
            <li><a href="#bilgi"><i class="icon-briefcase"></i> <?php echo $dil["bilgi_guvenligi"]; ?></a></li>
            <!--<li><a href="#mesajlas"><i class="icon-envelope"></i> <?php echo $dil["ag_ici_ag_disi_mesajlasabilme"]; ?></a></li> -->
            <!--<li><a href="#yonetici"><i class="icon-user"></i> <?php echo $dil["yonetici_atama_yetkilendirme"]; ?></a></li>
            <li><a href="#raporlama"><i class="icon-bar-chart"></i> <?php echo $dil["raporlama"]; ?></a></li>-->
            <li><a href="#esnek"><i class="icon-tablet"></i> <?php echo $dil["esnek_kontrol"]; ?></a></li>
            <!--<li><a href="#tib"><i class="icon-check"></i> <?php echo $dil["tib_onayi"]; ?></a></li>-->
            <li><a href="#kk"><i class="icon-thumbs-up"></i> <?php echo $dil["kolay_kullanim"]; ?></a></li>
        </ul>
    </div>
    <div class="feature_right">
    	<div class="feature screen_watch">
    	<h2><i class="icon-desktop"></i> <?php echo $dil["ekran_izleme"]; ?></h2>
        <p>Dilediğiniz personelinizin bilgisayar ekranını izleyebilir, istediğiniz gün sayısı kadar kayıt altına alabilirsiniz. Bu işlemi firma içindeki veya dışındaki herhangi bir bilgisayara uygulayabilir ve izleme işlemini firma dışında dilediğiniz yerde yapabilirsiniz. Bu özellik ile personelinizin gerçek verimini, performansını ve mesai zamanının ne kadarını işinize ayırdığını gerçek zamanlı ölçebilme özelliği sunar.</p>
        <img src="img/screens/14.jpg" width="840" />
        </div>
        <div class="feature filter hide">
    	<h2><i class="icon-umbrella"></i> <?php echo $dil["filtreleme"]; ?></h2>
        <p>Ekranlarını izlediğiniz bilgisayarlardaki tespit ettiğiniz bilgilere göre istenilen internet sitesine yasak koyabilirsiniz. İnternet sitesinin adresini bilmek zorunda bırakmayan akıllı algoritmalar sayesinde yalnızca yasak kelime yazarak içinde yasakladığınız kelimenin bolca bulunduğu tüm siteleri otomatik olarak sizin yerinize yasaklayacaktır.</p>
        <img src="img/screens/1.jpg" width="840" />
        </div>
        <div class="feature downloadsection hide">
    	<h2><i class="icon-minus-sign"></i> <?php echo $dil["download_kisitlamasi"]; ?></h2>
        <p>Bilgisayarlarınızda sizin istediğiniz dosya türlerinin dışında zararlı olabileceğine inandığınız hiçbir dosyanın indirme işlemi gerçekleşmeyecektir. Sadece dosya uzantısı girerek (.mp3, .exe, .bat, .zip mpeg) bu tür dosyaların bilgisayarlarınıza verebileceği zararlardan koruma sağlar.</p>
        <img src="img/screens/13.jpg" width="840" />
        </div>
        <div class="feature time hide">
    	<h2><i class="icon-time"></i> <?php echo $dil["sure_sinirlamasi"]; ?></h2>
        <p>Kullanıcıların hangi günlerde hangi saatlerde internete girebileceğini hatta daha da ileri giderek hangi saatte bilgisayarı açabileceğine siz karar verebilirsiniz.</p>
        <img src="img/screens/2.jpg" width="840" />
        </div>
        <div class="feature bandwidth hide">
    	<h2><i class="icon-exchange"></i> <?php echo $dil["bandwidth_kontrol"]; ?></h2>
        <p>Firmanızdaki departmanların gelen internetin yüzde kaçını kullanabileceğini kontrol edebilme özelliği. Yani örneğin 16 megabit bir ADSL bağlantısına sahipsiniz. Bunun bağlantının 6 megabitini resmi işlerin (e-beyanname, sgk vb.) internette yürüdüğü Muhasebe departmanına, 1 megabitini Mail dışında internetle başka işi olmayan sekretaryaya atanabilir. Böylece internette hız sıkıntısı yaşanmayacak, gereksiz kullanımın önüne geçilecektir.</p>
        <img src="img/screens/3.jpg" width="840" />
        </div>
        <div class="feature kullanim hide">
    	<h2><i class="icon-ban-circle"></i> <?php echo $dil["program_kullanim_siniri"]; ?></h2>
        <p>Kullanıcının bilgisayarında hangi programı açacağını, hangisini açamayacağına karar verebilme yeteneği. Örneğin sekretarya da yalnızca Outlook kullanılabilir başka hiçbir program ve uygulamaya izin verilmiyorken muhasebe departmanındaki kullanıcıya hem Outlook hem muhasebe programını açma yetkisi verilebilir.</p>
        <img src="img/screens/4.jpg" width="840" />
        </div>
        <div class="feature multimedia hide">
    	<h2><i class="icon-headphones"></i> <?php echo $dil["multimedia_filtresi"]; ?></h2>
        <p>Bilgisayar başındaki kullanıcıların internette en fazla zaman geçirdiği siteler dizi-film ve sosyal paylaşım siteleri olarak tespit edilmiştir. Bu sitelerde harcanan zaman hem iş kaybına hem de işlerinizi yürütmek için vazgeçilmez bir araç olan internette hız kaybına yok açmaktadır. Bu kayıpları önlemek için tek tek internet adreslerini bloklamak yerine yalnızca bir tuş ile tüm ağınızda video, radyo, oyun ve dilerseniz resimlerin dahi açılmasını engelleyebilirsiniz.</p>
        <img src="img/screens/5.jpg" width="840" />
        </div>
        <div class="feature bilgi hide">
    	<h2><i class="icon-briefcase"></i> <?php echo $dil["bilgi_guvenligi"]; ?></h2>
        <p>Firmanıza ait özel veya gizli bilgilerin, yedeklerin dışarı çıkarılmasına karşı koruma sistemi geliştirilmiştir. İstenilen yerdeki belgelerin kopyalanabilmesi, silinebilmesine karşı koruma sistemi ile belgeleriniz güvenli ortamda tutulur.</p>
        <img src="img/screens/6.jpg" width="840" />
        </div>
        <div class="feature mesajlas hide">
    	<h2><i class="icon-envelope"></i> <?php echo $dil["ag_ici_ag_disi_mesajlasabilme"]; ?></h2>
        <p>Ağ içinde veya ağınız dışındaki herhangi bir kullanıcıya veya tüm kişilere anlık mesaj gönderebilirsiniz. Böylelikle göndereceğiniz mesaj tüm ekranların üzerinde görüneceğinden acaba mesajım gitti mi veya gördü mü kaygısı taşımazsınız ve mail prosedürlerinden kurtulmuş olursunuz.</p>
        <img src="img/screens/7.jpg" width="840" />
        </div>
        <div class="feature yonetici hide">
    	<h2><i class="icon-user"></i> <?php echo $dil["yonetici_atama_yetkilendirme"]; ?></h2>
        <p>Ortaklarınıza, yöneticilerinize veya dilediğiniz kişilere kısıtlı veya tam yetkiler vererek kullanıcıları kontrol etme yetkisi kazandırabilirsiniz. Örneğin Üretim Müdürünüze Üretim departmanındaki kullanıcıları sadece izleme ve kısıtlama yetkisi verebilir, böylece daha etkili kullanım ile performans ve verimlilik artırımında maksimum düzeylere çıkabilirsiniz.</p>
        <img src="img/screens/8.jpg" width="840" />
        </div>
        <div class="feature raporlama hide">
    	<h2><i class="icon-bar-chart"></i> <?php echo $dil["raporlama"]; ?></h2>
        <p>Artık personelinizle ilgili kararları almadan önce mutlaka Workviewer’a soracaksınız. Çünkü Workviewer’ın size söyleyeceği çok şey var. Örneğin;</p>
        <ul>
            <li>Kullanıcının çalışması gereken asıl işi olan programda ne kadar çalıştığını,</li>
            <li>İnternette hangi siteye saat kaçta girildiğini ve burada ne kadar zaman geçirildiğini,</li>
            <li>Yasakladığınız halde hangi siteye kaç kez giriş yapmayı denediğini</li>
            <li>İnternetten indirilen dosyaların listesini tutabilme,</li>
            <li>Bilgisayardaki programların listesini çıkarıp, yapılan değişiklikleri bildirebilme,</li>
            <li>Bilgisayarın donanım listesini (Bilgisayarın tüm parçaları) kayıt edip, değişiklikleri bildirme.</li>
        </ul>
        <img src="img/screens/9.jpg" width="840" />
        </div>
        <div class="feature esnek hide">
    	<h2><i class="icon-tablet"></i> <?php echo $dil["esnek_kontrol"]; ?></h2>
        <p>Workviewer’ın size sağladığı en büyük özelliklerden biride yukarıda yazılı işlemleri yapabilmeniz için iş yerinizde olmanıza gerek kalmamasıdır. Dilediğinizde yerde dizüstü bilgisayar, tablet, cep telefonu ile şirketinizi görüntüleyebilir, raporlarınıza ulaşabilir ve kurallar koyabilirsiniz. Siz sanki işyerinizdeymişsiniz gibi etki bırakarak personeliniz üzerindeki kontrolünüzü kaybetmezsiniz.</p>
        <img src="img/screens/10.jpg" width="840" />
        </div>
        <div class="feature tib hide">
    	<h2><i class="icon-check"></i> <?php echo $dil["tib_onayi"]; ?></h2>
        <p>5651 numaralı Kanun gereği internet sağlayıcılar (Firmalar, İnternet Cafeler vb.) kullandıkları ve dışardan internet kullanımına izin verdiğiniz tüm bilgisayarların İP Loglarını tutma zorunluluğu vardır. Tutulmadığı takdirde; herhangi bir suç teşkil eden durumda ADSL aboneliği kimin üzerine ise sorumluluk ona aittir. Workviewer bu sorumluluğu üzerinizden atmanızı sağlayacak TİB’in kabul ettiği zaman damgalı iç İP Loglarını tutabilme ve bunları raporlayabilme yeteneğine sahip bir yazılımdır.</p>
        <img src="img/screens/11.jpg" width="840" />
        </div>
        <div class="feature kk hide">
    	<h2><i class="icon-thumbs-up"></i> <?php echo $dil["kolay_kullanim"]; ?></h2>
        <p>Tüm bu işlemleri yaparken ileri düzeyde bilgisayar kullanım bilgisine ihtiyaç yoktur. Basit bir bilgisayar kullanıcısı bile bu işlemleri kolaylıkla yapabilir ve yine aynı kolaylıkta kullanabilir.</p>
        <img src="img/screens/12.jpg" width="840" />
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="footer_cont"><?php include("footer.html"); ?></div>
</body>
</html>