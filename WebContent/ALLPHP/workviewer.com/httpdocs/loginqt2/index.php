<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='https://fonts.googleapis.com/css?family=Noto+Sans:400,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/userlogin.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$(".username").focus();
	$(".username").focus(function() {
		if($(".user-error").hasClass("acik")){
		$(".user-error").animate({
				right:"0px"
				},function(){
					$(".user-icon").css("left","-48px");
					}).removeClass("acik");
		}else{
			$(".user-icon").css("left","-48px");
			}
	});
	$(".email").focus(function() {
		if($(".email-error").hasClass("acik")){
		$(".email-error").animate({
				right:"0px"
				}).removeClass("acik");
		}
	});
	$(".username").blur(function() {
		$(".user-icon").css("left","0px");
	});
	
	$(".password").focus(function() {
		if($(".pass-error").hasClass("acik")){
		$(".pass-error").animate({
				right:"0px"
				},function(){
					$(".pass-icon").css("left","-48px");
					}).removeClass("acik");
		}else{
			$(".pass-icon").css("left","-48px");
			}
	});
	$(".password").blur(function() {
		$(".pass-icon").css("left","0px");
	});
		$(".forgot_password").click(function(){
			$(".email").val('');
			$(".user-error").animate({
				right:"0px"
				}).removeClass("acik");
			$("#userlogin").fadeOut(700,function(){
				$("#fp").fadeIn(700);
				$(".forgot_password").text("Giriş Yap").addClass("giris");
				$(".button").val("Şifremi Gönder").addClass("password_forgot");
				$(".header h1").text("Şifremi Unuttum");
				$(".header span").text("Yazılımızı satın alırken kullandığınız e-posta adresini yazın.");
				});
			});
		$("body").on("click",".giris",function(){
			$(".email-success,.email-error").animate({
			right:"0px"
			}).removeClass("acik");
			$("#fp").fadeOut(700,function(){
				$("#userlogin").fadeIn(700);
				$(".forgot_password").text("Şifremi Unuttum").removeClass("giris");
				$(".button").val("Giriş Yap").removeClass("password_forgot");
				$(".header h1").text("Kullanıcı Girişi");
				$(".header span").text("Kullanıcı kontrol paneline girmek için aşağıdaki formu doldurun");
				});
			});
	$("body").on("submit",".login-form",function(e){
		if(!$(".button").hasClass("password_forgot")){
		var username = $(".username").val();
		var password = $(".password").val();
		if(username.length < 1){
			$(".user-error").animate({
				right:"-309px"
				}).addClass("acik");
			}else
		if(password.length < 1){
			$(".pass-error").animate({
				right:"-309px"
				}).addClass("acik");
		}else{
			$(".loading_overlay").fadeIn(700);
			$(".loading_text").fadeIn(700).html("Lütfen bilgileriniz kontrol edilirken bekleyiniz...").delay(2000).fadeOut(700);
			$.ajax({
                type:"POST",
                url:"authority.php",
                data:"username="+$(".username").val()+"&pass="+$(".password").val(),
                success:function(e){
                    if(e=="yok"){
                      $(".loading_text").html("Kullanıcı adı sistemde kayıtlı değildir.").fadeIn(700).delay(2000).fadeOut(700,function(){
						  $(".loading_overlay").fadeOut(700);
						  }); 
                    }else
                    if(e=="yanlis"){
                       $(".loading_text").html("Kullanıcı adınızı veya şifrenizi yanlış girdiniz.").fadeIn(700).delay(2000).fadeOut(700,function(){
						  $(".loading_overlay").fadeOut(700);
						  }); 
                    }
					if(e=="Bağlanamadı"){
                       $(".loading_text").html("Sistemle ilgili bir hata oluştu.").fadeIn(700).delay(2000).fadeOut(700,function(){
						  $(".loading_overlay").fadeOut(700);
						  }); 
                    } 
                    if(e=="ok"){
						$(".loading_text").html("Bilgileriniz Doğru. Giriş Yapılıyor...").fadeIn(700,function(){
							setTimeout(function(){
								self.location=("home.php");
								},1500);
							});
                    }
                    
                }
            })
		}
		}else{
		var email = $(".email").val();
		if(email.length < 1){
			$(".email-error").html("Lütfen e-posta adresinizi girin").animate({
				right:"-309px"
				}).addClass("acik");
			}else{
				var filter = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if(!filter.test(email)){
					$(".email-error").html("Lütfen geçerli bir e-posta adresi girin").animate({
					right:"-309px"
					}).addClass("acik");
					}else{
					$(".email-success").html("Şifreniz e-posta adresinize gönderilmiştir.").animate({
					right:"-309px"
					}).addClass("acik");	
						}
				}	
		}
		e.preventDefault();
		});
});
</script>

<title>WorkViewer Kullanıcı Girişi</title>
</head>

<body>
<div class="loading_overlay">
<div class="overlay"></div>
<div class="loading_text"></div>
</div>
<div id="wrapper">
	<div class="images_login">
	<img style="margin-left:90px;" src="images/work_login.png" />
	</div>
    <div class="user-icon"></div>
    <div class="pass-icon"></div>
    <div class="user-error">Lütfen Kullanıcı Adınızı Girin.</div>
    <div class="pass-error">Lütfen Şifrenizi Girin.</div>
    <div class="email-error"></div>
    <div class="email-success"></div>
<form name="login-form" class="login-form" action="" method="post">
    <div class="header">
	<h1>Kullanıcı Girişi</h1>
	<span>Kullanıcı kontrol paneline girmek için aşağıdaki formu doldurun</span>
    </div>
    <div class="content" id="userlogin">
	<input name="username" type="text" class="input username" placeholder="Kullanıcı Adı"/>
    <input name="password" type="password" class="input password" placeholder="Şifre" />
    </div>
    <div class="content" id="fp">
    <input name="email" type="text" class="input email" placeholder="E-posta adresiniz" />
    </div>
    <div class="footer">
    <input type="submit" name="submit" value="Giriş Yap" class="button" />
    <a class="forgot_password" href="#">Şifremi Unuttum</a>
    </div>
</form>
<p class="copyright">2013 Seçpa Yazılım ve İnternet Teknolojileri Ltd Şti.</p>
</div>
<!-- <div class="gradient"></div> -->
</body>
</html>