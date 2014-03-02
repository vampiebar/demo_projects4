<?php
$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
header('Location:../mobile');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='https://fonts.googleapis.com/css?family=Noto+Sans:400,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="../login/css/userlogin.css" />
<script type="text/javascript" src="../login/js/jquery.js"></script>
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
				$(".forgot_password").text("Giriş Yap").addClass("giris").attr("href","#giris");
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
				$(".forgot_password").text("Şifremi Unuttum").removeClass("giris").attr("href","#forgot");;
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
					console.log(e);
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
					$(".email-success").html("Lütfen Bekleyiniz...").animate({
					right:"-309px"
					}).addClass("acik");
					$.ajax({
						type:"POST",
						url:"forgotpassword.php",
						data:"email="+email,
						success:function(resp){
							if(resp!="yok"){
								$(".email-success,.email-error").animate({
									right:"0px"
									}).removeClass("acik");
								$(".email-success").html("Şifreniz e-posta adresinize gönderilmiştir.").animate({
									right:"-309px"
									}).addClass("acik");
								}else{
									$(".email-success,.email-error").animate({
									right:"0px"
									}).removeClass("acik");
									$(".email-error").html("E-posta adresi bulunamadı.").animate({
									right:"-309px"
									}).addClass("acik");
									}
							}
						})
						
						}
				}	
		}
		e.preventDefault();
		});
		if(window.location.hash=="#forgot") {
  		$(".email").val('');
			$(".user-error").animate({
				right:"0px"
				}).removeClass("acik");
			$("#userlogin").fadeOut(700,function(){
				$("#fp").fadeIn(700);
				$(".forgot_password").text("Giriş Yap").addClass("giris").attr("href","#giris");
				$(".button").val("Şifremi Gönder").addClass("password_forgot");
				$(".header h1").text("Şifremi Unuttum");
				$(".header span").text("Yazılımızı satın alırken kullandığınız e-posta adresini yazın.");
				});
		}
		if(window.location.hash=="#giris") {
  		$(".email-success,.email-error").animate({
			right:"0px"
			}).removeClass("acik");
			$("#fp").fadeOut(700,function(){
				$("#userlogin").fadeIn(700);
				$(".forgot_password").text("Şifremi Unuttum").removeClass("giris").attr("href","#forgot");;
				$(".button").val("Giriş Yap").removeClass("password_forgot");
				$(".header h1").text("Kullanıcı Girişi");
				$(".header span").text("Kullanıcı kontrol paneline girmek için aşağıdaki formu doldurun");
				});
		}
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
	<img style="margin-left:90px;" src="../login/images/work_login.png" />
	</div>
    <div class="user-icon"></div>
    <div class="pass-icon"></div>
    <div class="user-error">Lütfen Kullanıcı Adınızı Girin.</div>
    <div class="pass-error">Lütfen Şifrenizi Girin.</div>
    <div class="email-error"></div>
    <div class="email-success"></div>
<form name="login-form" autocomplete="on" class="login-form" action="" method="post">
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
    <a class="forgot_password" href="#forgot">Şifremi Unuttum</a>
    </div>
</form>
<p class="copyright">2013 Seçpa Yazılım ve İnternet Teknolojileri Ltd Şti.</p>
</div>
<!-- <div class="gradient"></div> -->
</body>
</html>