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
<meta name="description" content="Workviewer Pc izleme ve kontrol yazılımı İndirme Sayfası" />
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
	$(".buttonx").click(function(){
		var name = $("#login-name").val();
		var username = $("#login-username").val();
		var password = $("#login-password").val();
		var pc = $("#pc_count").val();
		var city = $("#login-city").val();
		var cityname = $("#login-city").find('option:selected').text();
		if(name.length<1){
			$(".formerror").html("Lütfen adınızı giriniz.").fadeIn(700);
			}else
		if(username.length<1){
			$(".formerror").html("Lütfen e-posta adresinizi giriniz.").fadeIn(700);
			}else{
				var filter = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if(!filter.test(username)){
				$(".formerror").html("Lütfen geçerli bir e-posta adresinizi giriniz.").fadeIn(700);	
					}else
					if(password.length<1){
					$(".formerror").html("Lütfen şifrenizi giriniz.").fadeIn(700);
					}else
					if(pc.length<1){
					$(".formerror").html("Lütfen bilgisayar sayısını giriniz.").fadeIn(700);
					}else
					if(city==0){
					$(".formerror").html("Lütfen şehri seçiniz.").fadeIn(700);
					}else
					{
						$(".formerror").fadeOut(700);
						$.ajax({
						type:"POST",
						url:"kayit.php",
						data:"name="+name+"&username="+username+"&password="+password+"&city="+city+"&pc="+pc+"&cityname="+cityname,
						success:function(a){
							if(a.substr(0,6)=="TR_000"){
								$(".step_overlay").slideDown(700);
								$(".step2_overlay").slideUp(700);
								}else{
								$("#step1").css("height","370px");
								$(".formerror").html('Bu e posta adresi kayıtlı. Şifrenizi unuttuysanız <a href="http://www.workviewer.com/password?email='+username+'" target="_blank">buraya tıklayın.</a>').fadeIn(700);	
									}
							}	
						})
						}
				}
		});
		$(".full-width-input").keyup(function(e){
			var id = $(this).attr("id");
			var length = $(this).val().length;
			var code = e.keyCode || e.which;
		   if (code == '9') {
			 return false;
		   }
			if(length>0){
			$(".formerror").fadeOut(700);
			}else{
			if(id == "login-name"){
			$(".formerror").html("Lütfen adınızı giriniz.").fadeIn(700);
			}else
			if(id=="login-username"){
			$(".formerror").html("Lütfen e-posta adresinizi giriniz.").fadeIn(700);	
			}else
			if(id=="login-password"){
			$(".formerror").html("Lütfen şifrenizi giriniz.").fadeIn(700);	
			}
			if(id=="pc_count"){
			$(".formerror").html("Lütfen bilgisayar sayısı giriniz.").fadeIn(700);	
			}
			}
			});
		$(".gotostep3").click(function(){
			$(".step2_overlay").slideDown(700);
			$(".step3_overlay").slideUp(700);
			});
		$(".access").click(function(){
			var username2 = $("#login-username2").val();
			var password2 = $("#login-password2").val();
			if(username2.length<1){
			$(".formerror2").html("Lütfen e-posta adresinizi giriniz.").fadeIn(700);
			}else
			var filter2 = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(!filter2.test(username2)){
			$(".formerror2").html("Lütfen geçerli bir e-posta adresinizi giriniz.").fadeIn(700);	
				}else
				if(password2.length<1){
				$(".formerror2").html("Lütfen şifrenizi giriniz.").fadeIn(700);
				}else{
					$(".formerror2").html("Lütfen Bekleyiniz.");
					$.ajax({
						type:"POST",
						data:"username="+username2+"&pass="+password2,
						url:"login/authority.php",
						success:function(a){
							if(a=="yok"){
								$(".formerror2").html("Kayıt Bulunamadı.").fadeIn(700);
								}
							if(a=="yanlis"){
								$(".formerror2").html("E-posta adresi veya şifre yanlış").fadeIn(700);
								}
							if(a=="ok"){
								$(".formerror2").html("Lütfen Bekleyiniz. Giriş Yapılıyor...");
								setTimeout(function(){
								self.location=("login/home.php");
								},1500);
								}
							}
						})
					}
			});
			$(".greenx").click(function(){
				$(".step_overlay").slideDown(700);
				$(".step2_overlay").slideUp(700);
				});
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
    <div class="step" id="step1">
    <div class="step_overlay"></div>
    	<h1>Adım 1</h1>
        <p>WorkViewer'ı denemek için kayıt olmalısınız.</p>
        <p class="formerror"></p>
        <fieldset>
        		<p>
					<label for="login-username">Adınız(Ünvanınız):</label>
					<input type="text" id="login-name" class="round full-width-input">
				</p>
				<p>
					<label for="login-username">E-posta adresiniz:</label>
					<input type="text" id="login-username" class="round full-width-input">
				</p>
				<p>
					<label for="login-password">Şifreniz:</label>
					<input type="password" id="login-password" class="round full-width-input">
				</p>
                <p>
					<label for="login-password">PC Sayısı:</label>
					<input type="text" id="pc_count" class="round full-width-input" style="width:50px;" maxlength="3">
				</p>
                <p>
                <label for="login-city">Şehir:</label>
                <select class="locationCity" id="login-city" name="address_city"> <option value="0">Lütfen Seçin</option><option value="34">İstanbul</option><option value="06">Ankara</option><option value="35">İzmir</option><option value="01">Adana</option><option value="02">Adıyaman</option><option value="03">Afyonkarahisar</option><option value="04">Ağrı</option><option value="68">Aksaray</option><option value="05">Amasya</option><option value="07">Antalya</option><option value="75">Ardahan</option><option value="08">Artvin</option><option value="09">Aydın</option><option value="10">Balıkesir</option><option value="74">Bartın</option><option value="72">Batman</option><option value="69">Bayburt</option><option value="11">Bilecik</option><option value="12">Bingöl</option><option value="13">Bitlis</option><option value="14">Bolu</option><option value="15">Burdur</option><option value="16">Bursa</option><option value="17">Çanakkale</option><option value="18">Çankırı</option><option value="19">Çorum</option><option value="20">Denizli</option><option value="21">Diyarbakır</option><option value="81">Düzce</option><option value="22">Edirne</option><option value="23">Elazığ</option><option value="24">Erzincan</option><option value="25">Erzurum</option><option value="26">Eskişehir</option><option value="27">Gaziantep</option><option value="28">Giresun</option><option value="29">Gümüşhane</option><option value="30">Hakkari</option><option value="31">Hatay</option><option value="76">Iğdır</option><option value="32">Isparta</option><option value="46">Kahramanmaraş</option><option value="78">Karabük</option><option value="70">Karaman</option><option value="36">Kars</option><option value="37">Kastamonu</option><option value="38">Kayseri</option><option value="71">Kırıkkale</option><option value="39">Kırklareli</option><option value="40">Kırşehir</option><option value="79">Kilis</option><option value="41">Kocaeli</option><option value="42">Konya</option><option value="43">Kütahya</option><option value="44">Malatya</option><option value="45">Manisa</option><option value="47">Mardin</option><option value="33">Mersin</option><option value="48">Muğla</option><option value="49">Muş</option><option value="50">Nevşehir</option><option value="51">Niğde</option><option value="52">Ordu</option><option value="80">Osmaniye</option><option value="53">Rize</option><option value="54">Sakarya</option><option value="55">Samsun</option><option value="56">Siirt</option><option value="57">Sinop</option><option value="58">Sivas</option><option value="63">Şanlıurfa</option><option value="73">Şırnak</option><option value="59">Tekirdağ</option><option value="60">Tokat</option><option value="61">Trabzon</option><option value="62">Tunceli</option><option value="64">Uşak</option><option value="65">Van</option><option value="77">Yalova</option><option value="66">Yozgat</option><option value="67">Zonguldak</option> </select>
                </p>	
				<a href="javascript:void(0)" class="buttonx round bluex image-right ic-right-arrow fr">Devam Et</a>
                <a href="javascript:void(0)" class="buttonxx round greenx fl">Bu işlemi daha önce yaptım</a>
		</fieldset>
    </div>
    <div class="step" id="step2">
    <div class="step2_overlay"></div>
    	<h1>Adım 2</h1>
        <p>Şimdi izlemek ve kontrol etmek istediğiniz <b>bütün bilgisayarlara</b> aşağıdaki kullanıcı uygulamasını indirip kurunuz.</p>
        <a href="application/workviewer_kullanici.exe" class="button_download round yellowx large">Kullanıcı Uygulamasını İndirin</a>
        <a href="application/workviewer_yonetici.exe" class="button_download round yellowx large">Yönetici Uygulamasını İndirin</a>
        <a href="javascript:void(0)" class="buttonx round bluex gotostep3">Kullanıcı Uygulamasını Kurdum Şimdi Ne Yapmalıyım?</a>
    </div>
    <div class="step" id="step3">
    <div class="step3_overlay"></div>
    <h1>Adım 3</h1>
        <p>Devam etmek için giriş yapın.</p>
        <p class="formerror2"></p>
        <fieldset>
				<p>
					<label for="login-username">E-posta adresiniz:</label>
					<input type="text" id="login-username2" class="round full-width-input">
				</p>
				<p>
					<label for="login-password">Şifreniz:</label>
					<input type="password" id="login-password2" class="round full-width-input">
				</p>	
				<a href="javascript:void(0)" class="buttonxx round bluex fr access">Giriş Yap</a>
		</fieldset>
    </div>
    <div class="clearfix"></div>
</div>
<div class="footer_cont"><?php include("footer.html"); ?></div>
</body>
</html>
