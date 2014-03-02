<?php 
/*if($_SERVER['HTTPS']){
     $url = 'http://www.secpayazilim.com/iletisim';
     header("Location: $url");
}
*/
session_start();
if(!$_SESSION["dil"]){
	require("dil/en.php");
}else{
	require("dil/".$_SESSION["dil"].".php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Seçpa, Secpa, Seçpa Soft, Secpa Soft, Seçpa Yazilim, Secpa Yazilim, WorkViewer, Work Viewer, Kids, Kids Viewer, KidsViewer,Work Viewer Buy,  Buy Work Viewer, WorkViewer Buy, Buy WorkViewer, Kids Viewer Buy, Buy Kids Viewer, KidsViewer Buy, Buy KidsViewer, ReadyCafe, Ready Cafe, Ready Cafe Satın Al, Ready Cafe Satin Al, ReadyCafe Buy, Ready Cafe Buy, Download Workviewer, Download Work viewer" />
<meta name="description" content="Seçpa Yazılım ve İnternet Teknolojileri İletişim Sayfası" />
<meta name="Robots" content="index,follow" />
<meta name="viewport" content="width=device-width;minimum-scale=0.5,maximum-scale=1.0; user-scalable=1;" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" type="text/css" href="css/da-slider.css" />
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="css/font-awesome-ie7.min.css" />
<!--<link rel="stylesheet" type="text/css" href="css/fractionslider.css">-->
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/prettify.js"></script>
<script type="text/javascript" src="js/modernizr.js"></script>
<script type="text/javascript" src="js/gmapsensor.js"></script>
<script type="text/javascript" src="js/gmaps.js"></script>
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css' />
<link href='https://fonts.googleapis.com/css?family=Economica:700,400italic' rel='stylesheet' type='text/css' />
<link href='https://fonts.googleapis.com/css?family=Noto+Sans:400,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css' />
<title>Seçpa Yazılım | İletişim</title>
		<script type="text/javascript">
			$(document).ready(function(){
				function cancelDefaultAction(e) {
				 var evt = e ? e:window.event;
				 if (evt.preventDefault) evt.preventDefault();
				 evt.returnValue = false;
				 return false;
				}
					prettyPrint();
					var harita = new GMaps({
					  div: '#map',
					  lat: 41.006917,
					  lng: 28.6612
					});
					harita.addMarker({
					  lat: 41.006917,
					  lng: 28.6612,
					  title: 'Seçpa Yazılım'
					});
					harita.drawOverlay({
					  lat: 41.006917,
					  lng: 28.6612,
					  content: '<div class="overlay"><?php echo $dil["companyname"]; ?><div class="overlay_arrow above"></div></div>',
					  verticalAlign: 'top',
					  horizontalAlign: 'center'
					});
					$("#contact_form").submit(function(a){
						cancelDefaultAction(a);
						var name = $("#contactname").val();
						var email =$("#contactemail").val();
						var message =$("#contactmessage").val();
						if(name.length<1){
							$(".error_bottom").removeClass("alert-success").addClass("alert-error").animate({
								bottom:"0px"
								}).html("<?php echo $dil["lutfen_ad"]; ?>").delay(1500).animate({
									bottom:"-150px"
									},500,function(){
										$("#contactname").focus();
										});
							}
						else
						if(email.length<1){
							$(".error_bottom").removeClass("alert-success").addClass("alert-error").animate({
								bottom:"0px"
								}).html("<?php echo $dil["lutfen_eposta"]; ?>").delay(1500).animate({
									bottom:"-150px"
									},500,function(){
										$("#contactemail").focus();
										});
							}else{
								var filter = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
								if(!filter.test(email)){
									$(".error_bottom").removeClass("alert-success").addClass("alert-error").animate({
									bottom:"0px"
									}).html("<?php echo $dil["lutfen_gecerli"]; ?>").delay(1500).animate({
									bottom:"-150px"
									},500,function(){
										$("#contactemail").focus();
										});
									}else
										if(message.length<1){
											$(".error_bottom").removeClass("alert-success").addClass("alert-error").animate({
											bottom:"0px"
											}).html("<?php echo $dil["lutfen_mesaj"]; ?>").delay(1500).animate({
											bottom:"-150px"
											},500,function(){
												$("#contactmessage").focus();
												});
											}else{
												$.ajax({
													type:"POST",
													data:$("#contact_form").serialize(),
													url:"send.php",
													success: function(b){
														$(".error_bottom").removeClass("alert-error").addClass("alert-success").animate({
														bottom:"0px"
														}).html("Mesajınız Gönderilmiştir. En kısa sürede dönüş yapılacaktır. ").delay(1500).animate({
														bottom:"-150px"
														},500,function(){
															$("#contactname").val('');
															$("#contactemail").val('');
															$("#contactmessage").val('');
															});
													}
															})
														
												}
										
								}
						})
						$(".topbar_menu ul li").hover(function(){
						$(this).find("ul").slideDown();
						},function(){
						$(this).find("ul").hide();	
							});
				});
		</script>
</head>

<body>
<?php 
include("topbarmenu.html");
?>
<div class="row-fluid">
	<div class="container">
    	<div class="span3">
        	<a href="../homepage">
            	<img class="logo" src="img/logo.png" width="138" height="64" alt="Seçpa Yazılım Logo" />
            </a>
        </div>
        <div class="span9 marginforheader">
        	<ul class="nav nav-pills pull-right">
            	<li><a href="../homepage" title="Seçpa Yazılım"><?php echo $dil["menu1"]; ?></a></li>
                <li><a href="../about" title="Seçpa Yazılım Hakkımızda"><?php echo $dil["menu2"]; ?></a></li>
                <li><a href="../products" title="Seçpa Yazılım Ürünlerimiz"><?php echo $dil["menu3"]; ?></a></li>
                <li><a href="../clients" title="Seçpa Yazılım Müşterilerimiz"><?php echo $dil["menu4"]; ?></a></li>
                <li><a href="../download" title="Seçpa Yazılım Müşterilerimiz"><?php echo $dil["menu7"]; ?></a></li>
                <li><a href="../buy" title="Seçpa Yazılım Satın Al"><?php echo $dil["menu5"]; ?></a></li>
                <li class="active"><a href="../contact" title="Seçpa Yazılım İletişim"><?php echo $dil["menu6"]; ?></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="row-fluid">
	<div class="span5 alert-error error_bottom"></div>
    <div id="map"></div>
    <div class="span5 contact_bottom">
    	<h2><?php echo $dil["b_t_g"]; ?></h2>
        <hr />
        <form class="form-horizontal" id="contact_form">
          <div class="control-group">
            <label class="control-label" for="inputname"><?php echo $dil["adiniz"]; ?></label>
            <div class="controls">
            <div class="input-prepend">
                   <input class="input-xlarge" name="inputname" type="text" id="contactname" placeholder="<?php echo $dil["adiniz"]; ?>">
                </div>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputemail"><?php echo $dil["epostaniz"]; ?></label>
            <div class="controls">
            	<div class="input-prepend">
                  <input class="input-xlarge" name="inputemail" type="text" id="contactemail" placeholder="<?php echo $dil["epostaniz"]; ?>">
                </div>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputmessage"><?php echo $dil["mesajiniz"]; ?></label>
            <div class="controls">
              <textarea class="input-block-level" style="height:200px;" name="contactmessage" id="contactmessage" placeholder="<?php echo $dil["mesajiniz"]; ?>"></textarea>
            </div>
          </div>
          <div class="control-group">
          <div class="controls">
              <button type="submit" class="btn btn-warning pull-right"><i class="icon-envelope icon-white" style="margin-top:3px;"></i> <?php echo $dil["gonder"]; ?></button>
              </div>
          </div>
        </form>
        <h2><?php echo $dil["iletisim_adres"]; ?></h2>
        <hr />
        <h3>Seçpa Yazılım ve İnternet Teknolojileri</h3>
		<p>Skyport Residence Merkez Mah. Hürriyet Bulvarı No:1 Kat:9 D:106 Beylikdüzü - İstanbul</p>
        <p><b>Tel:</b> <?php if($_SESSION["dil"]!="tr" || $_SESSION["dil"]=="") { echo " +90 212";} else{ echo " 0 212";} ?> 876 2 444 - <?php if($_SESSION["dil"]!="tr" || $_SESSION["dil"]=="") { echo " +90 212";} else{ echo " 0 212";} ?> 875 6610 - <?php if($_SESSION["dil"]!="tr" || $_SESSION["dil"]=="") { echo " +90 212";} else{ echo " 0 212";} ?> 875 6611</p>
        <p><b>Fax:</b> <?php if($_SESSION["dil"]!="tr" || $_SESSION["dil"]=="") { echo " +90 212";} else{ echo " 0 212";} ?> 875 26 14</p>
		<p><b>E-posta:</b> info@secpayazilim.com</p>
    </div>
</div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-42776363-3', 'secpasoft.com');
  ga('send', 'pageview');
</script>
</body>
</html>


