<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $baslik; ?></title>
</head>
<body>

<div id="container">
	<h1><?php echo $icerik; ?></h1>
    <p><?php echo $icerik_aciklama; ?></p>
    <a href="<?php echo site_url('uyekayit');?>">Git</a>
    <p>Kullandığınız Browser:<?php echo $agent; ?></p>
    <p>Kullandığınız Platform:<?php echo $platform; ?></p><?php echo $ip; ?>
</div>

</body>
</html>