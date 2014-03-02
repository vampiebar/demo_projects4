<?php
session_start();
$MaxtryC 	= 3;		// En fazla kaç defa denenebileceğinin ayarı.
$Expire		= 60*60*1;	// Ne kadar süre boyunca engelleyeceğinin ayarı. (saniye cinsinden)
if(!isset($_SESSION['tryC'])) {
	$_SESSION['tryC'] = 0;	
}
if(@$_COOKIE['FTry'] == "dogru") { $Total = 1; }
if(@$_COOKIE['STry'] == "dogru") { $Total = 2; }
if(@$_COOKIE['TTry'] == "dogru") { $Total = 3; }

if(@$Total > $_SESSION['tryC']) {
	$_SESSION['tryC'] = $Total; 
} 

if(@$_POST['email'] != "") {
	$Load = true;
	$Mail = $_POST['email'];
  	include_once("forgotten_db.php");
	if($_SESSION['tryC'] < $MaxtryC) {
		@$_SESSION['tryC']+=1;
	}
	$Tried = true;
}
if($_SESSION['tryC'] == 1) { setcookie("FTry", "dogru", time()+$Expire); }
if($_SESSION['tryC'] == 2) { setcookie("STry", "dogru", time()+$Expire); }
if($_SESSION['tryC'] == 3) { setcookie("TTry", "dogru", time()+$Expire); }


@$Left = $MaxtryC - $_SESSION['tryC'];
if( @$Left < 0 ) {
	$Left = 0;	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Unutulmuş Hesap Bilgileri</title>
<meta http-equiv="Page-Enter" content="blendTrans(Duration=0.10)">
<meta http-equiv="Page-Exit" content="blendTrans(Duration=0.5)">
<link rel="icon" href="http://www.webaynet.com/favicon.gif" type="image/gif" >
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<META NAME="description" content="WEBAYNET YAZILIM ®: Şirketinizdeki Bilgisayar ağını izleyebileceğiniz, kontrol edebileceğiniz, filtreleme gibi işlemler yapabileceğiniz network kontrol yazılımının resmi web sitesidir." >
<META NAME="keywords" content="web filtresi, internet filtresi, tib onaylı filtre programı, onaylı filtre programı, onaylı filtre programları, antiporn uygulaması, porno engelleyici, antiporn, anti-porn, yasak site filtresi, web filter, netdadi, NETPATRON, netpatron, network yönetimi, network izleme programı, 5651 nolu yasa gereği filtreleme, 5651 yasası açıklamalı, 5651 yasası kapsamı, NETDADI, internet cafe yönetim yazılımı, internet cafe, cafe yazılımı, client, server, internet cafe program, iç ip log tutma programı, netdadı programı ana sayfası">
<meta NAME="copyright" CONTENT="WEBAYNET ® 2006 - 2011">
<meta NAME="language" CONTENT="TR">
<meta NAME="rating" CONTENT="General">
<meta NAME="robots" CONTENT="index,follow">
<meta NAME="revisit-after" CONTENT="1 days">
<meta NAME="distribution" CONTENT="global">
<meta NAME="author" CONTENT="WEBAYNET® Software">
<meta name="page-topic" content="içerik filtreleme yazılımı, web filtre yazılımı ve programı, netdadi antiporn programı, tib onaylı filtre programı">
<meta name="CATEGORY" content="Software" >
<style type="text/css">
<!--
body {
	background-color: #a6a6a6;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	text-align: center;
	font-family: Arial, Tahoma, Verdana, Helvetica, sans-serif;
}
a:link {
	text-decoration: none;
	color: a6a6a6;
}
a:visited {
	text-decoration: none;
	color: a6a6a6;
}
a:hover {
	text-decoration: underline;
	color: #39F;
}
a:active {
	text-decoration: none;
	text-align: left;
	color: a6a6a6;
	font-family: Arial, Tahoma, Verdana, Helvetica, sans-serif;
}
.newtext5 {
	font-family: Arial, Tahoma, Verdana, Helvetica, sans-serif;
	font-size: 13px;
	font-weight: bold;
}
.main {
}
.hede {	color: #000;
}
.input {	background-image: url(gfx/input.gif);
	width: 247px;
	height: 18px;
	border: 1px solid #CFCFCF;
	font-family: Trebuchet MS, Garamond, Geneva, Helvetica;
	font-size: 12px;
	padding-top: 2px;
	padding-left: 3px;
}
.style1 {color: #FF0000}
#txtCode {	font-weight: bold;
}
-->
</style></head>
<script language="javascript" type="text/javascript">
	function inputEff(caller,color) {
		caller.style.borderColor = "#"+color;
	}
	
	function inputChk(caller,color) {
		var epostasi = caller.value;
		var txtInput = document.getElementById('txtCode');
		if ( (epostasi.indexOf ('@',0) == -1) || (epostasi.indexOf('.',0) == -1) || (epostasi.indexOf(' ',0) != -1) || (epostasi.length<6) || epostasi.indexOf ('@',0) != epostasi.lastIndexOf ('@'))
	{
			txtInput.style.color = '#FF0000';
			txtInput.innerHTML = "Yazdığınız e-posta adresi geçerli değil.";
			inputEff(caller,color);
			return false;
		} else {
			inputEff(caller,'009933');
			txtInput.style.color = '#009933';
			txtInput.innerHTML = "Kayıtlar inceleniyor...";
			//return false;
		}
	}
</script>
<body>
<table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><? include "menubar.php" ?></td>
  </tr>
  <tr>
    <td align="center"><? include "nivoslider.php" ?></td>
  </tr>
  <tr>
    <td align="center"><img src="images/forgatbaslik.jpg" width="962" height="40" /></td>
  </tr>
  <tr>
    <td align="center" background="images/bigtablebacround.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="2%">&nbsp;</td>
        <td width="22%" align="center"><img src="images/forgat.png" width="118" height="283" /></td>
        <td width="74%"><div align="center">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><div align="center">
                <form id="form" name="form" method="post" action="" onsubmit="return inputChk(document.getElementById('email'),'FF0000');">
                  <div align="center"></div>
                  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="3" style="border: 1px solid #EFEFEF;">
                    <tr>
                      <td colspan="3" bgcolor="#EFEFEF"><strong>:: Bilgi Hatırlatma Formu</strong></td>
                    </tr>
                    <tr>
                      <td colspan="3" bgcolor="#FFFFFF"><div align="justify">Bu sayfadan <strong>WEBAYNET</strong> yazılıma ait ürünleriniz için kullandığınız kullanıcı bilgilerinizin e-posta adresine gönderilmesini talep edebilirsiniz. Sistem otomatik olarak bütün tablolarda arama yapacak ve e-posta adresiniz ile eşleşen bilgileri verdiğiniz e posta adresine gönderecektir. Bu sayfa üzerinden <strong><span style="text-decoration: underline">bir saat</span></strong>içerisinde <strong><span style="text-decoration: underline">e-posta adresiniz doğru olsa bile</span>, <span style="text-decoration: underline">en fazla 3 kere</span></strong> bilgilerinizin e-posta adresinize gönderilmesini isteyebilirsiniz. Gönderdiğimiz mailler posta hesabınızın <strong>spam</strong>, <strong>süzgeç</strong>, <strong>gereksiz mailler</strong> gibi bölümlere gidebilirler. </div></td>
                    </tr>
                    <? if((@$_SESSION['tryC'] >= $MaxtryC) == false) { ?>
                    <tr>
                      <td width="171" align="right"><strong> E-Posta adresiniz</strong></td>
                      <!-- Geliştirici notu; !-->
                      <!-- Internet Explorer 7 buradaki değer 5.000.000 olmadan bir sonraki inputu en köşeye taşımayı reddetti.! -->
                      <td width="10"><strong>:</strong></td>
                      <td width="499" align="left"><label>
                        <input type="text" name="email" id="email" class="input" onmouseover="inputEff(this,'AFAFAF')" onmouseout="inputEff(this,'EFEFEF')" onfocus="inputEff(this,'009933')" onkeypress="inputEff(this,'009933')" value="<? echo @$_POST['email']; ?>" />
                        <? if(@$Left > 0) { ?>
                        <input type="submit" name="button" id="button" value="Gönder" />
                        <? } ?>
                      </label></td>
                    </tr>
                    <? } ?>
                    <tr>
                      <td colspan="3" align="center"><?php echo $Left; ?> deneme kaldı.</td>
                      <!-- Geliştirici notu; !-->
                      <!-- Internet Explorer 7 buradaki değer 5.000.000 olmadan bir sonraki inputu en köşeye taşımayı reddetti.! -->
                    </tr>
                    <tr>
                      <td colspan="3" align="right"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="369" align="left"><div id="txtCode"></div></td>
                          <td width="329">&nbsp;</td>
                        </tr>
                      </table></td>
                    </tr>
                  </table>
                  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="3" style="border: 1px solid #EFEFEF;">
                    <tr>
                      <td colspan="2" align="left" bgcolor="#EFEFEF"><strong>:: Sorgulama Sonucu</strong></td>
                    </tr>
                    <tr>
                      <td colspan="2" align="left"><?
			if(@$Left <= 0) {
				$MT = true;
			 ?>
                        <span class="style1">Üzgünüz, bir saat içerisinde çok fazla giriş denemesidne bulunduğunuz için adresiniz <strong>bir saat</strong> süre ile bloklanmıştır. Lütfen bir saat sonra tekrar deneyiniz.</span>
                        <?
			}
				if(@$Tried == true) {
					if(@$Found == false) {
						if(@$MT == false) {
					?>
                        <span class="style1">Üzgünüz, sunucumuzda girdiğiniz e-posta adresine ait bir kayıt bulunmuyor.</span>
                        <?
						}
					} else {
						if(@$MT == false) {
						?>
                        <span class="hede"><strong>Ürünlerimiz ile ilgili kullanıcı bilgileriniz</strong></span><strong> <span class="style1">&lt;<? echo $Mail; ?>&gt;</span> adresine gönderildi.
                          <? }			
				}
			}
			if(isset($Data)) {
				@$getData = "";
				foreach($Data as $D) {
					$getData.= "
					<b>Ürün Adı :</b> ".$D['PN']." <br />
					<b>Ürün Sahibi :</b> ".$D['UN']." <br />
					<b>Ürün Anahtarı :</b> ".$D['ID']." <br />
					<b>Ürün Parolası :</b> ".$D['UP']." <br />
					<br />			
					";
				}
			}
			if(@$getData == "") {
				
			} else {
				$MailDone = false;
				$WorkingDir = "../mailtemp";
				$SMailTo = $Mail;
				$Subject = "Ürün Bilgileri Hatırlatması";
				$Headers = "MIME-Version: 1.0" . "\r\n";
				$Headers.= "Content-type:text/html;charset=utf-8" . "\r\n";
				$Headers.= 'From: WEBAYNET YAZILIM <register@webaynet.com>' . "\r\n";
				$Headers.= 'Reply-to: <info@webaynet.com>' . "\r\n";
				$Headers.= 'BCC: bulentseker@gmail.com,info@webaynet.com' . "\r\n";
				$Content = file_get_contents("http://www.webaynet.com/mailtemp/mailtemp.html");
				$Content = str_replace("src=\"","src=\"http://www.webaynet.com/".$WorkingDir."/",$Content);
				$Content = str_replace("background=\"","background=\"http://www.webaynet.com/".$WorkingDir."/",$Content);
				$Content = str_replace("{TEXT}",$getData,$Content);
				if((@$_SESSION['tryC'] >= $MaxtryC) == false) {
					if(@mail($SMailTo,$Subject,$Content,$Headers)) {
							$MailDone = true;
	
					} else {
						$MailDone = false;
					}	
				} 
				else {
						// Do Nothing
				}
			}	
?>
                        </strong></td>
                    </tr>
                  </table>
                </form>
              </div></td>
            </tr>
            <tr>
              <td><div align="center"><a href="http://www.webaynet.com"><img src="images/homepage.jpg" width="82" height="50" border="0" /></a></div></td>
            </tr>
          </table>
        </div></td>
        <td width="2%">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><img src="images/incebar.jpg" width="962" height="17" /></td>
  </tr>
  <tr>
    <td align="center"><img src="images/bigtable_alt.jpg" width="962" height="29" /></td>
  </tr>
  <tr>
    <td align="center"><? include "altmenu.php" ?></td>
  </tr>
</table>
</body>
</html>
