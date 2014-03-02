<html>
<head>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Seçpa Yazılım</title>
        <!-- Bootstrap -->
        <link href="../login/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../login/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="../login/assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
			var getphoto = function(){
          	$.ajax({
            method:'post',
            url:'bunela.php',
            success:function(data){
			if(data!=''){
              $('.resim').html('<img src="data:image/jpeg;base64,'+data+'" alt="Ekran Görüntüsü" />');
			}else{
				$('.resim').html("Şu anda geçici olarak görüntüler yüklenemiyor...");
				}
            },
			error:function(){
				$('.resim').html("Şu anda geçici olarak görüntüler yüklenemiyor...");
				setInterval(getphoto,1000);
				}
          });
        }
        setInterval(getphoto,1000);
		var seconds = 1;
		var timer;
		function countdown() {
		seconds--;
		if(seconds >= 0) {
			$(".resim").html('Lütfen <b>'+seconds+'</b> saniye bekleyiniz...');
		} else {
			clearInterval(timer);
		}
		}
		timer = setInterval(countdown, 1000);
	var customizeForDevice = function(){
	var viewportWidth = $(document).width();
	var viewportHeight = $(document).height();
    var ua = navigator.userAgent;
    var checker = {
      iphone: ua.match(/(iPhone|iPod|iPad)/),
      blackberry: ua.match(/BlackBerry/),
      android: ua.match(/Android/),
	  chrome: ua.match(/Chrome/),
	  msie: ua.match(/MSIE/)
    };
    if (checker.android){
        $('#navigator').html("Android bir cihaz üzerinden giriş yaptınız. Çözünürlüğünüz:"+viewportWidth+"x"+viewportHeight);
    }
    else if (checker.iphone){
        $('#navigator').html("Iphone üzerinden giriş yaptınız. Çözünürlüğünüz:"+viewportWidth+"x"+viewportHeight);
    }
    else if (checker.blackberry){
        $('#navigator').html("Blackberry üzerinden giriş yaptınız Çözünürlüğünüz:"+viewportWidth+"x"+viewportHeight);
    }
    else if (checker.chrome){
        $('#navigator').html("Chrome üzerinden giriş yaptınız Çözünürlüğünüz:"+viewportWidth+"x"+viewportHeight);
    }
	else if (checker.msie){
        $('#navigator').html("İnternet Explorer üzerinden giriş yaptınız Çözünürlüğünüz:"+viewportWidth+"x"+viewportHeight);
    }
}
customizeForDevice();
});
</script>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,400italic,700italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<style>
body{ padding:0; font-family:"Source Sans Pro";}
.resim{ font-size:48px; font-weight:bold;}

</style>
</head>
<body>
<div class="row-fluid">

<div class="device">Kullandığınız Navigator:<span id="navigator"></span></div>
<div class="thumbnail resim">
</div>
</div>
</body>
</html>