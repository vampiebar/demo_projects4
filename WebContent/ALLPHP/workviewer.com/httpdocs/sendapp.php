<?php
include("config.php"); 
session_start();
$firma_unvan = strip_tags($_POST['firma_unvan']);
$tckimlik = strip_tags($_POST['tckimlik']);
$adsoyad = strip_tags($_POST['adsoyad']);
$eposta = strip_tags($_POST['eposta']);
$gorev = strip_tags($_POST['gorev']);
$faaliyet = strip_tags($_POST['faaliyet']);
$telefon = strip_tags($_POST['telefon']);
$faks = strip_tags($_POST['faks']);
$sehir = strip_tags($_POST['sehir']);
$ceptel = strip_tags($_POST['ceptel']);
$vergi_dairesi = strip_tags($_POST['vergi_dairesi']);
$vergi_numarasi = strip_tags($_POST['vergi_numarasi']);
$adres = strip_tags($_POST['adres']);
$pm = strip_tags($_POST['pm']);
$captcha=strip_tags($_POST['captcha']);
$activationcode=md5($eposta);
if($_POST)
{
  if($_SESSION['encoded_captcha'] == md5($captcha))
  {
 	$q= mysql_query("insert into secpa_branch_app (
	AppCompanyName,
	AppTcNo,
	AppFullName,
	AppEmail,
	AppDuty,
	AppActivityArea,
	AppPhone,
	AppFax,
	AppCountry,
	AppMobilePhone,
	AppTaxOffice,
	AppTaxNumber,
	AppAddress,
	AppPm,
	AppSecurityCode,
	AppDate,
	AppActivationCode) values (
	'$firma_unvan',
	'$tckimlik',
	'$adsoyad',
	'$eposta',
	'$gorev',
	'$faaliyet',
	'$telefon',
	'$faks',
	'$sehir',
	'$ceptel',
	'$vergi_dairesi',
	'$vergi_numarasi',
	'$adres',
	'$pm',
	'$captcha',
	NOW(),
	'$activationcode'
	)");
	if($q){
		echo "ok";
		}
  }
  else
  {
  echo "kodyanlis";
  }
}else{
	echo iconv("utf-8","iso-8859-9","Böyle hareketler yapma sakın");
	}
?>