<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<title>Workviewer Mobile</title>
<link type="text/css" rel="stylesheet" href="css/jquery.mobile-1.3.2.min.css" />
<link type="text/css" rel="stylesheet" href="css/styles.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.mobile-1.3.2.min.js"></script>
<script type="text/javascript">
$(function(){
	$(".loginbutton").click(function(a){
		$.mobile.showPageLoadingMsg();
		$.ajax({
			type:"POST",
			url:"../login/authority.php",
            data:"username="+$(".username").val()+"&pass="+$(".password").val(),
			success:function(resp){
				if(resp=="ok"){
				setTimeout(function(){
				self.location=("home.php");
				},1500);
				}
				if(resp=="yok"){
					$.mobile.hidePageLoadingMsg();
					$(".inputError").fadeOut().find("p").html("Kullanıcı adı sistemde kayıtlı değil.").parent().fadeIn();
					}
				if(resp=="yanlis"){
					$(".inputError").fadeOut().find("p").html("Kullanıcı adı veya şifre yanlış.").parent().fadeIn();
					}
				
				}
			})
		a.preventDefault();
		})
	});
</script>
</head>

<body>
<div data-role="page" id="home">
<div data-position="fixed" data-role="header" data-theme="b">
<h1>Workviewer Login</h1>
</div>
<div align="center" data-role="content" id="contentConfirmation" name="contentConfirmation">
<form id="login">
<div data-role="fieldcontain">
    <label for="textinput-fc">Kullanıcı Adınız</label>
    <input type="text" class="username" name="textinput-fc" id="textinput-fc" placeholder="Kullanıcı Adınız" value="">
</div>
<div data-role="fieldcontain">
    <label for="textinput-fp">Şifreniz:</label>
    <input type="password" class="password" name="textinput-fc" id="textinput-fp" placeholder="Şifreniz" value="">
</div>
<div data-role="fieldcontain">
	<label for="textinput-fp">&nbsp;</label>
    <input type="submit" name="textinput-fc" class="loginbutton" id="textinput-fp" value="Giriş Yap" data-theme="b">
</div>
<div class="inputError"><p></p></div>
</form>
</div>
</div>

</body>
</html>
