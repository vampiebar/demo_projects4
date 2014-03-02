<? @session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>POS</title>
<style>
table, td, tr, th {
	font-family: Trebuchet MS;
	font-size: 11px;
}
.style3 {font-size: 14px;
	font-weight: bold;
}
.style21 {
	font-size: 12px;
	font-weight: bold;
	color: #AFAFAF;
}
.style6 {color: #AFAFAF}
.style8 {color: #FF0000; font-weight: bold; font-family: Verdana; }
.style22 {
	color: #006600;
	font-weight: bold;
}
</style>

<?php

// Security
if(!isset($_POST['Adi'],$_POST['email'])) {
	die("Lütfen geri tuşuna basıp formdaki bütün alanları doldurunuz.");
}
if(!isset($_POST['cardno'])) { die("Unauthorized Access"); }

// Preconfiguration
// Don't edit these lines. 
// bugrakaan@gmail.com
$name		= "webapi";      	 			
$password	= "WWeb7300";    			
$clientid	= "602387300";    			
$lip		= GetHostByName($REMOTE_ADDR); 
$oid		= uniqid("NPCC");	
$type		= "Auth"; 
$ccname		= $_POST['Adi'];				
$ccno		= $_POST['cardno'];            
$ccay		= $_POST['ay'];          
$ccyil		= $_POST['yil'];          
$tutar		= $_POST['fiyat'];  			
$cv2		= $_POST['cv'];                 
$mail		= $_POST['email'];
$SMailTo	= $_POST['email'];
$phone		= $_POST['telefon'];
$gsm		= $_POST['GSM'];
$country	= "TR";
$company	= $_POST['unvan'];
$city		= $_POST['il'];
$postalcode	= $_POST['zip'];
$address	= $_POST['adres'];
$addresssec	= $_POST['adres_sec'];
$addressthi = $_POST['adres_thi'];
$itotal		= $_POST['ADET'];

// Mail icin extra bilgiler
$Mail['UN'] = $_POST['unvan'];
$Mail['VD'] = $_POST['vdaire'];
$Mail['VN'] = $_POST['vno'];

if(@$Mail['UN'] == "") { $Mail['UN'] = "(belirtilmemiş)"; }
if(@$Mail['VD'] == "") { $Mail['VD'] = "(belirtilmemiş)"; }
if(@$Mail['VN'] == "") { $Mail['VN'] = "(belirtilmemiş)"; }

// Must be empty
$taksit="";
// XML request sablonu
$request= "DATA=<?xml version=\"1.0\" encoding=\"ISO-8859-9\"?>
<CC5Request>
<Name>{NAME}</Name>
<Password>{PASSWORD}</Password>
<ClientId>{CLIENTID}</ClientId>
<IPAddress>{IP}</IPAddress>
<Email>{EMAIL}</Email>
<Mode>P</Mode>
<OrderId>{OID}</OrderId>
<GroupId></GroupId>
<TransId></TransId>
<UserId></UserId>
<Type>{TYPE}</Type>
<Number>{CCNO}</Number>
<Expires>{CCTAR}</Expires>
<Cvv2Val>{CV2}</Cvv2Val>
<Total>{TUTAR}</Total>
<Currency>949</Currency>
<Taksit>{TAKSIT}</Taksit>
<BillTo>
<Name>{CNAME}</Name>
<Street1>{ADDRESS}</Street1>
<Street2>{ADDRESS2}</Street2>
<Street3>{ADDRESS3}</Street3>
<City>{CITY} - [{COUNTRY}]</City>
<StateProv>-</StateProv>
<PostalCode>{POSTAL}</PostalCode>
<Country>{COUNTRY}</Country>
<Company>{COMPANY}</Company>
<TelVoice>{PHONE}</TelVoice>
</BillTo>
<ShipTo>
<Name>{CNAME}</Name>
<Street1>{ADDRESS}</Street1>
<Street2>{ADDRESS2}</Street2>
<Street3>{ADDRESS3}</Street3>
<City>{CITY} - [{COUNTRY}]</City>
<StateProv></StateProv>
<PostalCode>{POSTAL}</PostalCode>
<Country>{COUNTRY}</Country>
<Company>{COMPANY}</Company>
<TelVoice>{GSM}</TelVoice>
</ShipTo>
<Extra>{EXTRA}</Extra>
</CC5Request>
";
$request=str_replace("{NAME}",$name,$request);
$request=str_replace("{PASSWORD}",$password,$request);
$request=str_replace("{CLIENTID}",$clientid,$request);
$request=str_replace("{IP}",$lip,$request);
$request=str_replace("{OID}",$oid,$request);
$request=str_replace("{TYPE}",$type,$request);
$request=str_replace("{CCNO}",$ccno,$request);
$request=str_replace("{CCTAR}","$ccay/$ccyil",$request);
$request=str_replace("{CV2}","$cv2",$request);
$request=str_replace("{TUTAR}",$tutar,$request);
$request=str_replace("{TAKSIT}",$taksit,$request);
$request=str_replace("{CNAME}",$ccname,$request);
$request=str_replace("{EMAIL}",$mail,$request);
$request=str_replace("{PHONE}",$phone,$request);
$request=str_replace("{COMPANY}",$company,$request);
$request=str_replace("{GSM}",$gsm,$request);
$request=str_replace("{CITY} - [{COUNTRY}]",substr($city." / ".$country,0,25),$request);
$request=str_replace("{ADDRESS}",$address,$request);
$request=str_replace("{ADDRESS2}",$addresssec,$request);
$request=str_replace("{ADDRESS3}",$addressthi,$request);
$request=str_replace("{POSTAL}",$postalcode,$request);
$request=str_replace("{EXTRA}",$extra,$request);

$url = "https://www.fbwebpos.com/servlet/cc5ApiServer"; 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
curl_setopt($ch, CURLOPT_TIMEOUT, 90); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $request); 
$result = curl_exec($ch);
if (curl_errno($ch)) {
   print curl_error($ch);
} else {
   curl_close($ch);
}
$Response = $OrderId = $AuthCode = $ProcReturnCode = $ErrMsg = $HOSTMSG = "";
$response_tag="Response";
$posf = strpos (  $result, ("<" . $response_tag . ">") );
$posl = strpos (  $result, ("</" . $response_tag . ">") ) ;
$posf = $posf+ strlen($response_tag) +2 ;
$Response = substr (  $result, $posf, $posl - $posf) ;

$response_tag="OrderId";
$posf = strpos (  $result, ("<" . $response_tag . ">") );
$posl = strpos (  $result, ("</" . $response_tag . ">") ) ;
$posf = $posf+ strlen($response_tag) +2 ;
$OrderId = substr (  $result, $posf , $posl - $posf   ) ;

$response_tag="AuthCode";
$posf = strpos (  $result, "<" . $response_tag . ">" );
$posl = strpos (  $result, "</" . $response_tag . ">" ) ;
$posf = $posf+ strlen($response_tag) +2 ;
$AuthCode = substr (  $result, $posf , $posl - $posf   ) ;

$response_tag="ProcReturnCode";
$posf = strpos (  $result, "<" . $response_tag . ">" );
$posl = strpos (  $result, "</" . $response_tag . ">" ) ;
$posf = $posf+ strlen($response_tag) +2 ;
$ProcReturnCode = substr (  $result, $posf , $posl - $posf   ) ;

$response_tag="ErrMsg";
$posf = strpos (  $result, "<" . $response_tag . ">" );
$posl = strpos (  $result, "</" . $response_tag . ">" ) ;
$posf = $posf+ strlen($response_tag) +2 ;
$ErrMsg = substr (  $result, $posf , $posl - $posf   ) ;
if($Response != "Approved") {
if($_GET['ptype'] == "NP") { $L = "netpkkform.php"; }
if($_GET['ptype'] == "ND") { $L = "netdkkform.php"; }
?>
<table width="400" border="0" align="center" cellpadding="2" cellspacing="3" style="border: 1px solid #CFCFCF;">
  <tr>
    <td colspan="3" bgcolor="#EFEFEF"><span class="style8">:: Hata </span></td>
  </tr>
  <tr>
    <td width="100" height="3"><strong>Response</strong></td>
    <td width="1"><strong>:</strong></td>
    <td width="224"><? echo $Response; ?></td>
  </tr>
  <tr>
    <td width="100" height="3"><strong>Hata Kodu</strong></td>
    <td width="1" height="3"><strong>:</strong></td>
    <td><? echo $ProcReturnCode; ?></td>
  </tr>
  <tr>
    <td width="100" height="3"><strong>Hata Mesajı</strong></td>
    <td width="1" height="3"><strong>:</strong></td>
    <td><? echo $ErrMsg; ?></td>
  </tr>
  <tr>
    <td height="3" colspan="3">Lütfen <a href="<? echo $L; ?>">Buraya</a> tıklayınız veya tarayıcınızın &quot; Geri &quot; butonuna tıklayarak bir önceki sayfaya dönünüz. Bilgilerinizi kontrol ederek yeniden deneyiniz.</td>
  </tr>
</table> 
<?
} else if($Response == "Approved") { 
	include_once("sanal_pos_db.php");
	include_once("sanal_pos_mail.php");
	$CFile = fopen("log/".date("dmYHis")."_".$oid.".txt","w+");
	$PHPText = "Order ID : ".$oid."
Order Type : WACC
Customer Name : ".$ccname."
TIB SQL Actions : ".$TibSQL."
SQL Actions : ".$SQLActions."
Payment Date : ".date("d-m-Y H:i:s")."
Error Codes : ".$ErrorType;
	fwrite($CFile, $PHPText);
	fclose($CFile);
?>
<table width="400" border="0" align="center" cellpadding="3" cellspacing="3" style="border: 1px solid #CFCFCF;">
  <tr>
    <td colspan="2" bgcolor="#EFEFEF" class="style8">:: Sipariş Başarılı</td>
  </tr>
  <tr>
    <td width="1"><img src="images/Disapprove.png" alt="" width="72" height="72" align="middle" /></td>
    <td width="387"><p align="center"> Siparişiniz <span class="style22">başarılı</span> bir şekilde sonuçlanmıştır. Aktivasyon kodunuz ve siparişiniz ile ilgili detaylı bilgiler <b> <? echo @$_POST['email']; ?> </b> bu mail adresine gönderilmiştir. Bir problem yada sorun ile karşılaşırsanız Lütfen <a href="mailto:support@webaynet.com">destek@webaynet.com</a> adresine Bilgi veriniz.</p></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><span class="style3"><a href="http://www.webaynet.com"><img src="images/webaynetlogo.png" alt="" width="224" height="62" border="0" /></a><br />
      ANA SAYFAYA GİTMEK İÇİN <a href="http://www.webaynet.com">BURAYI</a> TIKLAYINIZ </span></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><span class="style21">&copy;</span><span class="style6">Webaynet 2006-2008</span></td>
  </tr>
</table>
<? 
}
?>
</body>
</html>



