<?php 
/*if($_SERVER['HTTPS']){
     $url = 'http://www.secpayazilim.com/hakkimizda';
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
<meta name="description" content="Seçpa Yazılım ve İnternet Teknolojileri Hakkımızda Sayfası" />
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
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css' />
<link href='https://fonts.googleapis.com/css?family=Economica:700,400italic' rel='stylesheet' type='text/css' />
<link href='https://fonts.googleapis.com/css?family=Noto+Sans:400,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css' />
<title>Seçpa Yazılım | <?php echo $dil["hakkimizda"]; ?></title>
		<script type="text/javascript">
			$(document).ready(function(){
					prettyPrint();
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
                <li class="active"><a href="../about" title="Seçpa Yazılım About"><?php echo $dil["menu2"]; ?></a></li>
                <li><a href="../products" title="Seçpa Yazılım Products"><?php echo $dil["menu3"]; ?></a></li>
                <li><a href="../clients" title="Seçpa Yazılım Clients"><?php echo $dil["menu4"]; ?></a></li>
                <li><a href="../download" title="Seçpa Yazılım Download"><?php echo $dil["menu7"]; ?></a></li>
                <li><a href="../buy" title="Seçpa Yazılım Buy"><?php echo $dil["menu5"]; ?></a></li>
                <li><a href="../contact" title="Seçpa Yazılım Contact"><?php echo $dil["menu6"]; ?></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="row-fluid">
	<div class="container">
	<h1><?php echo $dil["hakkimizda"]; ?></h1>
    <hr />
    <p style="line-height:28px;">
    <?php echo $dil["hakkimizda_ilk_paragraf"]; ?>
    </p>
    <p style="line-height:28px;"><?php echo $dil["hakkimizda_ikinci_paragraf"]; ?></p>
<p style="line-height:28px;"><?php echo $dil["hakkimizda_son_paragraf"]; ?></p>
    </div>
</div>
<?php 
include("footer.php");
?>
</body>
</html>

