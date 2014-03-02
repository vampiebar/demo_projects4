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
<meta name="viewport" content="width=device-width;minimum-scale=0.5,maximum-scale=1.0; user-scalable=1;" /><meta name="keywords" content="Work, Viewer, Workviewer, WorkViewer, Workviever, WorkViever, Workwiever, WorkWiever, Workvıewer, WorkVıewer, Workvivır, Workvıvır, Workviwer, WorkViwer, Ekran izleme, network kontrol, filtreleme, canlı ekran izleme, personel takibi,Bilgisayar izleme, facebook engelleme, facebook engelle, twitter engelle, network izle, pc izle, takip programı, izleme programı, filtre programı, tib onaylı filtre,web filtresi, internet filtresi, tib onaylı filtre programı, onaylı filtre programı, onaylı filtre programları, antiporn uygulaması, porno engelleyici, antiporn, anti-porn, yasak site filtresi, web filter,network yönetimi, network izleme programı, 5651 nolu yasa gereği filtreleme, 5651 yasası açıklamalı, 5651 yasası kapsamı,Employee monitoring, worker monitor, worker activity logging, employee screen watching,Personel, İzleme"/>
<meta name="description" content="Workviewer Müşteriler Sayfası" />
<meta name="Robots" content="index,follow" />
<title>Workviewer</title>
<link rel="stylesheet" type="text/css" href="css/reset.css" />
<!-- <link rel="stylesheet" type="text/css" href="css/prettify.css" /> -->
<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css" /> -->
<!--<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" /> -->
<link href='http://fonts.googleapis.com/css?family=Merriweather+Sans:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/site.css" />
<link rel="stylesheet" type="text/css" href="css/animate.css" />
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
				var form = $(".bbf_form");
				var firma_unvan = $("#firma_unvan");
				var tckimlik = $("#tckimlik");
				var adsoyad = $("#adsoyad");
				var eposta = $("#eposta");
				var gorev = $("#gorev");
				var faaliyet = $("#faaliyet");
				var telefon = $("#telefon");
				var sehir = $("#sehir");
				var ceptel = $("#ceptel");
				var vergi_dairesi = $("#vergi_dairesi");
				var vergi_numarasi = $("#vergi_numarasi");
				var adres = $("#adres");
				var captcha = $("#captcha");
				/* Blur Olayları*/
				firma_unvan.blur(ValidateFirmaUnvan);
				tckimlik.blur(ValidateTckimlik);
				adsoyad.blur(ValidateAdSoyad);
				eposta.blur(ValidateEposta);
				gorev.blur(ValidateGorev);
				faaliyet.blur(ValidateFaaliyet);
				telefon.blur(ValidateTelefon);
				sehir.blur(ValidateSehir);
				ceptel.blur(ValidateCeptel);
				vergi_dairesi.blur(ValidateVergiDairesi);
				vergi_numarasi.blur(ValidateVergiNumarasi);
				adres.blur(ValidateAdres);
				captcha.blur(ValidateCaptcha);
				/* Keypress Olayları*/
				firma_unvan.keyup(ValidateFirmaUnvan);
				tckimlik.keyup(ValidateTckimlik);
				adsoyad.keyup(ValidateAdSoyad);
				eposta.keyup(ValidateEposta);
				gorev.keyup(ValidateGorev);
				faaliyet.keyup(ValidateFaaliyet);
				telefon.keyup(ValidateTelefon);
				sehir.keyup(ValidateSehir);
				ceptel.keyup(ValidateCeptel);
				vergi_dairesi.keyup(ValidateVergiDairesi);
				vergi_numarasi.keyup(ValidateVergiNumarasi);
				adres.keyup(ValidateAdres);
				captcha.keyup(ValidateCaptcha);
				/* Form Gönderilirken Kontrol Et*/
				form.submit(function(a){
					if(ValidateFirmaUnvan() & ValidateTckimlik() & ValidateAdSoyad() & ValidateEposta() & ValidateGorev() & ValidateFaaliyet() & ValidateTelefon() & ValidateSehir() & ValidateCeptel() & ValidateVergiDairesi() & ValidateVergiNumarasi() & ValidateAdres() & ValidateCaptcha()){
						$.ajax({
							type:"POST",
							url:"sendapp.php",
							data:form.serialize(),
							success:function(a){
								if(a=="ok"){
									form.fadeOut(700,function(){
										$(".form_approved").fadeIn(700);
										})
									}
									else
								if(a=="kodyanlis"){
										captcha.parent().find(".success").hide();
										captcha.parent().find(".error").text("Güvenlik Kodunuzu Yanlış Girdiniz.").show();
										}
								else{
									alert(a);
									}
								},
							error:function(){
								alert("Form gönderilirken hata oluştu");
								}
							});
						a.preventDefault();
						return true;
						}else{
						a.preventDefault();
						return false;	
						}
					});
				function ValidateFirmaUnvan(){
				if(firma_unvan.val().length < 4){
					firma_unvan.parent().find(".success").hide();
					firma_unvan.parent().find(".error").show();
					return false;
				}
				else{
					firma_unvan.parent().find(".success").show();
					firma_unvan.parent().find(".error").hide();
					return true;
				}
				}
				function ValidateTckimlik(){
				if(tckimlik.val().length < 4){
					tckimlik.parent().find(".success").hide();
					tckimlik.parent().find(".error").show();
					return false;
				}
				else{
					tckimlik.parent().find(".success").show();
					tckimlik.parent().find(".error").hide();
					return true;
				}
				}
				function ValidateAdSoyad(){
				if(adsoyad.val().length < 4){
					adsoyad.parent().find(".success").hide();
					adsoyad.parent().find(".error").show();
					return false;
				}
				else{
					adsoyad.parent().find(".success").show();
					adsoyad.parent().find(".error").hide();
					return true;
				}
				}
				function ValidateEposta(){
				//testing regular expression
				var a = $("#eposta").val();
				var filter = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				//if it's valid email
				if(filter.test(a)){
					eposta.parent().find(".success").show();
					eposta.parent().find(".error").hide();
					return true;
				}
				//if it's NOT valid
				else{
					eposta.parent().find(".success").hide();
					eposta.parent().find(".error").show();
					return false
				}
				}
				function ValidateGorev(){
				if(gorev.val().length < 4){
					gorev.parent().find(".success").hide();
					gorev.parent().find(".error").show();
					return false;
				}
				else{
					gorev.parent().find(".success").show();
					gorev.parent().find(".error").hide();
					return true;
				}
				}
				function ValidateFaaliyet(){
				if(faaliyet.val().length < 4){
					faaliyet.parent().find(".success").hide();
					faaliyet.parent().find(".error").show();
					return false;
				}
				else{
					faaliyet.parent().find(".success").show();
					faaliyet.parent().find(".error").hide();
					return true;
				}
				}
				function ValidateTelefon(){
				if(telefon.val().length < 4){
					telefon.parent().find(".success").hide();
					telefon.parent().find(".error").show();
					return false;
				}
				else{
					telefon.parent().find(".success").show();
					telefon.parent().find(".error").hide();
					return true;
				}
				}
				function ValidateSehir(){
				if(sehir.val().length < 4){
					sehir.parent().find(".success").hide();
					sehir.parent().find(".error").show();
					return false;
				}
				else{
					sehir.parent().find(".success").show();
					sehir.parent().find(".error").hide();
					return true;
				}
				}
				function ValidateCeptel(){
				if(ceptel.val().length < 4){
					ceptel.parent().find(".success").hide();
					ceptel.parent().find(".error").show();
					return false;
				}
				else{
					ceptel.parent().find(".success").show();
					ceptel.parent().find(".error").hide();
					return true;
				}
				}
				function ValidateVergiDairesi(){
				if(vergi_dairesi.val().length < 4){
					vergi_dairesi.parent().find(".success").hide();
					vergi_dairesi.parent().find(".error").show();
					return false;
				}
				else{
					vergi_dairesi.parent().find(".success").show();
					vergi_dairesi.parent().find(".error").hide();
					return true;
				}
				}
				function ValidateVergiNumarasi(){
				if(vergi_numarasi.val().length < 4){
					vergi_numarasi.parent().find(".success").hide();
					vergi_numarasi.parent().find(".error").show();
					return false;
				}
				else{
					vergi_numarasi.parent().find(".success").show();
					vergi_numarasi.parent().find(".error").hide();
					return true;
				}
				}
				function ValidateAdres(){
				if(adres.val().length < 4){
					adres.parent().find(".success").hide();
					adres.parent().find(".error").show();
					return false;
				}
				else{
					adres.parent().find(".success").show();
					adres.parent().find(".error").hide();
					return true;
				}
				}
				function ValidateCaptcha(){
				if(captcha.val().length < 5){
					captcha.parent().find(".success").hide();
					captcha.parent().find(".error").show();
					return false;
				}
				else{
					captcha.parent().find(".success").show();
					captcha.parent().find(".error").hide();
					return true;
				}
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
<div class="clients_cont">
<div id="breadcrumb">
			<ul class="crumbs">
				<li class="first"><a href="index.php" style="z-index:9;"><span></span><?php echo $dil["neden_wv"]; ?></a></li>
				<li><a href="clients.php" style="z-index:8;">Bayi Başvuru Formu</a></li>
			</ul>
            <div class="clearfix"></div>
</div>
<div class="bbf">
	<h1 class="bbf_title"><?php echo $dil["bayi_b_f"]; ?></h1>
    <div class="form_approved">
    	<p><?php echo $dil["b_t_i"]; ?></p>
        <p><?php echo $dil["e_k_s_g_d_y"]; ?></p>
        <p><?php echo $dil["i_g_d"]; ?></p>
    </div>
    <form class="bbf_form" method="post">
    	<label for="firma_unvan">
        	<span class="label_text"><?php echo $dil["f_u"]; ?></span>
            <input type="text" name="firma_unvan" id="firma_unvan" />
            <span class="error"><?php echo $dil["f_u_error"]; ?></span>
            <span class="success"><?php echo $dil["tebrikler"]; ?></span>
        </label>
        <label for="tckimlik">
        	<span class="label_text"><?php echo $dil["ticari_no"]; ?></span>
            <input type="text" name="tckimlik" id="tckimlik" />
            <span class="error"><?php echo $dil["ticari_no_error"]; ?></span>
            <span class="success"><?php echo $dil["tebrikler"]; ?></span>
        </label>
        <label for="adsoyad">
        	<span class="label_text"><?php echo $dil["a_s"]; ?></span>
            <input type="text" name="adsoyad" id="adsoyad" />
            <span class="error"><?php echo $dil["a_s_error"]; ?></span>
            <span class="success"><?php echo $dil["tebrikler"]; ?></span>
        </label>
        <label for="eposta">
        	<span class="label_text"><?php echo $dil["b_f_email"]; ?></span>
            <input type="text" name="eposta" id="eposta" />
            <span class="error"><?php echo $dil["b_f_email_error"]; ?></span>
            <span class="success"><?php echo $dil["tebrikler"]; ?></span>
        </label>
        <label for="gorev">
        	<span class="label_text"><?php echo $dil["f_g"]; ?></span>
            <input type="text" name="gorev" id="gorev" />
            <span class="error"><?php echo $dil["f_g_error"]; ?></span>
            <span class="success"><?php echo $dil["tebrikler"]; ?></span>
        </label>
        <label for="faaliyet">
        	<span class="label_text"><?php echo $dil["f_a"]; ?></span>
            <input type="text" name="faaliyet" id="faaliyet" />
            <span class="error"><?php echo $dil["f_a_error"]; ?></span>
            <span class="success"><?php echo $dil["tebrikler"]; ?></span>
        </label>
        <label for="telefon">
        	<span class="label_text"><?php echo $dil["t_n"]; ?></span>
            <input type="text" name="telefon" id="telefon" />
            <span class="error"><?php echo $dil["t_n_error"]; ?></span>
            <span class="success"><?php echo $dil["tebrikler"]; ?></span>
        </label>
        <label for="faks">
        	<span class="label_text"><?php echo $dil["f_n"]; ?></span>
            <input type="text" name="faks" id="faks" />
            <span class="success"><?php echo $dil["tebrikler"]; ?></span>
        </label>
        <label for="sehir">
        	<span class="label_text"><?php echo $dil["b_f_sehir"]; ?></span>
            <input type="text" name="sehir" id="sehir" />
            <span class="error"><?php echo $dil["b_f_sehir_error"]; ?></span>
            <span class="success"><?php echo $dil["tebrikler"]; ?></span>
        </label>
        <label for="ceptel">
        	<span class="label_text"><?php echo $dil["c_t"]; ?></span>
            <input type="text" name="ceptel" id="ceptel" />
            <span class="error"><?php echo $dil["c_t_error"]; ?></span>
            <span class="success"><?php echo $dil["tebrikler"]; ?></span>
        </label>
        <label for="vergi_dairesi">
        	<span class="label_text"><?php echo $dil["v_d"]; ?></span>
            <input type="text" name="vergi_dairesi" id="vergi_dairesi" />
            <span class="error"><?php echo $dil["v_d_error"]; ?></span>
            <span class="success"><?php echo $dil["tebrikler"]; ?></span>
        </label>
        <label for="vergi_numarasi">
        	<span class="label_text"><?php echo $dil["v_n"]; ?></span>
            <input type="text" name="vergi_numarasi" id="vergi_numarasi" />
            <span class="error"><?php echo $dil["v_n_error"]; ?></span>
            <span class="success"><?php echo $dil["tebrikler"]; ?></span>
        </label>
        <label for="adres">
        	<span class="label_text"><?php echo $dil["b_f_adres"]; ?></span>
            <textarea name="adres" id="adres"></textarea>
            <span class="error"><?php echo $dil["b_f_adres_error"]; ?></span>
            <span class="success"><?php echo $dil["tebrikler"]; ?></span>
        </label>
        <label for="pm">
        	<span class="label_text"><?php echo $dil["o_m"]; ?></span>
            <textarea name="pm" id="pm"></textarea>
        </label>
        <img style="margin-left:250px; margin-top:10px;" src="captcha.php" />
        <label for="captcha">
        	<span class="label_text"><?php echo $dil["g_k"]; ?></span>
            <input type="text" name="captcha" id="captcha" />
            <span class="error"><?php echo $dil["g_k_error"]; ?></span>
        </label>
        <label for="pm">
        	<span class="label_text"></span>
            <button type="submit" class="bbf_gonder"><?php echo $dil["send_b_f"]; ?></button>
        </label>
        
    </form>
</div>
<div class="clearfix"></div>
</div>
<div class="footer_cont"><?php include("footer.html"); ?></div>
</body>
</html>
