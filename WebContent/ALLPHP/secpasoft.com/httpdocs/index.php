<?php 
/*if($_SERVER['HTTPS']){
     $url = 'http://www.secpayazilim.com/anasayfa';
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Seçpa, Secpa, Seçpa Soft, Secpa Soft, Seçpa Yazilim, Secpa Yazilim, WorkViewer, Work Viewer, Kids, Kids Viewer, KidsViewer,Work Viewer Buy,  Buy Work Viewer, WorkViewer Buy, Buy WorkViewer, Kids Viewer Buy, Buy Kids Viewer, KidsViewer Buy, Buy KidsViewer, ReadyCafe, Ready Cafe, Ready Cafe Satın Al, Ready Cafe Satin Al, ReadyCafe Buy, Ready Cafe Buy, Download Workviewer, Download Work viewer" />
<meta name="description" content="Seçpa Yazılım ve İnternet Teknolojileri Web Sayfası" />
<meta name="Robots" content="index,follow" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" type="text/css" href="css/da-slider.css" />
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="css/font-awesome-ie7.min.css" />
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.cslider.js"></script>
<script type="text/javascript" src="js/prettify.js"></script>
<script type="text/javascript" src="js/modernizr.js"></script>
<meta name="viewport" content="width=device-width;minimum-scale=0.5,maximum-scale=1.0; user-scalable=1;" />
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css' />
<link href='https://fonts.googleapis.com/css?family=Economica:700,400italic' rel='stylesheet' type='text/css' />
<link href='https://fonts.googleapis.com/css?family=Noto+Sans:400,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css' />
<title>Seçpa Yazılım | Anasayfa</title>
		<script type="text/javascript">
			$(document).ready(function(){
					prettyPrint();
					$('#da-slider').cslider({
					autoplay	: true,
					interval: 7000
					});
					$(".languages").hover(function(){
						$(".languages p").show();
						},function(){
						$(".languages p").hide();	
					});
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
            	<li class="active"><a href="../homepage" title="Seçpa Yazılım"><?php echo $dil["menu1"]; ?></a></li>
                <li><a href="../about" title="Seçpa Yazılım Hakkımızda"><?php echo $dil["menu2"]; ?></a></li>
                <li><a href="../products" title="Seçpa Yazılım Ürünlerimiz"><?php echo $dil["menu3"]; ?></a></li>
                <li><a href="../clients" title="Seçpa Yazılım Müşterilerimiz"><?php echo $dil["menu4"]; ?></a></li>
                <li><a href="../download" title="Seçpa Yazılım Müşterilerimiz"><?php echo $dil["menu7"]; ?></a></li>
                <li><a href="../buy" title="Seçpa Yazılım Satın Al"><?php echo $dil["menu5"]; ?></a></li>
                <li><a href="../contact" title="Seçpa Yazılım İletişim"><?php echo $dil["menu6"]; ?></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="row-fluid sliderbackground">
<div class="shadow-top"></div>
<div class="container">
<div id="da-slider" class="da-slider">
				<div class="da-slide">
					<h2>Work Viewer</h2>
					<p><?php echo $dil["workviewer_desc"]; ?></p>
					<a href="../workviewer" class="da-link btn btn-success btn-large "><?php echo $dil["daha_fazla"]; ?></a>
					<div class="da-img"><img src="img/workviewer.png" alt="Work Viewer" /></div>
				</div>
				<div class="da-slide">
					<h2>Kids Viewer</h2>
					<p><?php echo $dil["kidsviewer_desc"]; ?></p>
					<a href="../kidsviewer" class="da-link btn btn-success btn-large "><?php echo $dil["daha_fazla"]; ?></a>
					<div class="da-img"><img src="img/kidsviewer.png" alt="Kids Viewer" /></div>
				</div>
				<div class="da-slide">
					<h2>Ready Cafe</h2>
					<p><?php echo $dil["readycafe_desc"]; ?></p>
					<a href="#" class="da-link btn btn-success btn-large "><?php echo $dil["daha_fazla"]; ?></a>
					<div class="da-img"><img style="margin-top:-100px;" src="img/360x300_readycafe.png" alt="Ready Cafe" /></div>
				</div>
				<div class="da-arrows">
					<span class="da-arrows-prev"></span>
					<span class="da-arrows-next"></span>
				</div>
			</div>
        </div>
        <div class="shadow-bottom"></div>
</div>
<div class="row-fluid" style="margin-top:20px;">
	<div class="container">
    <div class="row">
    	<div class="span3">
        	<div class="box aligncenter">
            <div class="aligncenter icon">
                <i class="icon-thumbs-up icon-circled icon-64 active"></i>
            </div>
            <div class="text">
                <h2><?php echo $dil["kaliteli_hizmet"]; ?></h2>
                <p style="font-weight:normal">
                <?php echo $dil["kaliteli_hizmet_desc"]; ?>
                </p>
            </div>
       </div>
        </div>
        <div class="span3">
        	<div class="box aligncenter">
            <div class="aligncenter icon">
               <i class="icon-book icon-circled icon-64 active"></i>
            </div>
            <div class="text">
                <h2><?php echo $dil["yasal_sorumluluk"]; ?></h2>
                <p style="font-weight:normal">
                <?php echo $dil["yasal_sorumluluk_desc"]; ?>
                </p>
            </div>
       </div>
        </div>
        <div class="span3">
        	<div class="box aligncenter">
            <div class="aligncenter icon">
                <i class="icon-phone icon-circled icon-64 active"></i>
            </div>
            <div class="text">
                <h2><?php echo $dil["teknik_destek"]; ?></h2>
                <p style="font-weight:normal">
                <?php echo $dil["teknik_destek_desc"]; ?>
                </p>
            </div>
       </div>
        </div>
        <div class="span3">
        	<div class="box aligncenter">
            <div class="aligncenter icon">
                <i class="icon-trophy icon-circled icon-64 active"></i>
            </div>
            <div class="text">
                <h2><?php echo $dil["kazanc_garantisi"]; ?></h2>
                <p style="font-weight:normal">
                <?php echo $dil["kazanc_garantisi_desc"]; ?>
                </p>
            </div>
       </div>
        </div>
   </div>
    </div>
</div>
<hr />
<?php 
include("footer.php");
?>
</body>
</html>
