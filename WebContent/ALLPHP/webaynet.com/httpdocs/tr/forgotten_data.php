<?php
session_start();
$MaxtryC 	= 3;		// En fazla ka� defa denenebilece�inin ayar�.
$Expire		= 60*60*1;	// Ne kadar s�re boyunca engelleyece�inin ayar�. (saniye cinsinden)
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
<meta http-equiv="Content-Type" content="text/html; charset=windows-1254" />
<title>Unutulmu� Hesap Bilgileri</title>
<style type="text/css">
<!--
#form table tr td strong {
	color: #F00;
}
-->
</style>
</head>
<style>
body,table,td,tr,th {
	font-family: Trebuchet MS, Garamond, Geneva, Helvetica;
	font-size: 12px;
}
.input {
	background-image: url(gfx/input.gif);
	width: 247px;
	height: 18px;
	border: 1px solid #CFCFCF;
	font-family: Trebuchet MS, Garamond, Geneva, Helvetica;
	font-size: 12px;
	padding-top: 2px;
	padding-left: 3px;
}
strong, b  {
	color: #F00;	
}
#txtCode {
	font-weight: bold;
}
#form table tr td strong {
	color: #000;
}
.hede {
	color: #000;
}
.style1 {color: #FF0000}
</style>
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
			txtInput.innerHTML = "Yazd���n�z e-posta adresi ge�erli de�il.";
			inputEff(caller,color);
			return false;
		} else {
			inputEff(caller,'009933');
			txtInput.style.color = '#009933';
			txtInput.innerHTML = "Kay�tlar inceleniyor...";
		}
	}
</script>
<body>


<div align="center">
  <table width="200" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><div align="center"><form id="form" name="form" method="post" action="./?doAction" onSubmit="return inputChk(document.getElementById('email'),'FF0000');">
  <div align="center"><img src="gfx/logo.gif" width="259" height="93" /></div>
  <table width="450" border="0" align="center" cellpadding="3" cellspacing="3" style="border: 1px solid #EFEFEF;">
    <tr>
      <td colspan="3" bgcolor="#EFEFEF"><strong>:: Bilgi Hat�rlatma Formu</strong></td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#FFFFFF"><div align="justify">Bu sayfadan <strong>WEBAYNET</strong> yaz�l�ma ait �r�nleriniz i�in kulland���n�z kullan�c� bilgilerinizin e-posta adresine g�nderilmesini talep edebilirsiniz. Sistem otomatik olarak b�t�n tablolarda arama yapacak ve e-posta adresiniz ile e�le�en bilgileri verdi�iniz e posta adresine g�nderecektir. Bu sayfa &uuml;zerinden <strong><span style="text-decoration: underline">bir saat</span> </strong>i&ccedil;erisinde <strong><span style="text-decoration: underline">e-posta adresiniz do�ru olsa bile</span></strong>, <strong><span style="text-decoration: underline">en fazla 3 kere</span></strong> bilgilerinizin e-posta adresinize g&ouml;nderilmesini isteyebilirsiniz.</div></td>
    </tr>
    <? if((@$_SESSION['tryC'] >= $MaxtryC) == false) { ?>
    <tr>
      <td width="5000000"><strong> E-Posta adresiniz</strong></td>
      <!-- Geli�tirici notu; !-->
      <!-- Internet Explorer 7 buradaki de�er 5.000.000 olmadan bir sonraki inputu en k��eye ta��may� reddetti.! -->
      <td width="4"><strong>:</strong></td>
      <td width="249" align="right"><label>
        <input type="text" name="email" id="email" class="input" onMouseOver="inputEff(this,'AFAFAF')" onMouseOut="inputEff(this,'EFEFEF')" onfocus="inputEff(this,'009933')" onkeypress="inputEff(this,'009933')" value="<? echo @$_POST['email']; ?>" />
      </label></td>
    </tr>
    <? } ?>
    <tr>
      <td colspan="3" align="left"><?php echo $Left; ?> deneme kald�.</td>
      <!-- Geli�tirici notu; !-->
      <!-- Internet Explorer 7 buradaki de�er 5.000.000 olmadan bir sonraki inputu en k��eye ta��may� reddetti.! -->
      </tr>
    <tr>
      <td colspan="3" align="right">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="500000" align="left"><div id="txtCode"></div></td>
            <td width="50"><? if(@$Left > 0) { ?><input type="submit" name="button" id="button" value="G�nder" />    <? } ?></td>
          </tr>
      </table></td>
    </tr>

  </table>
  <table width="450" border="0" align="center" cellpadding="3" cellspacing="3" style="border: 1px solid #EFEFEF;">
    <tr>
      <td colspan="2" align="left" bgcolor="#EFEFEF"><strong>:: Sorgulama Sonucu</strong></td>
    </tr>
    <tr>
      <td colspan="2" align="left">
      <?
			if(@$Left <= 0) {
				$MT = true;
			 ?>
				<span class="style1">�zg�n�z, bir saat i�erisinde �ok fazla giri� denemesidne bulundu�unuz i�in adresiniz <strong>bir saat</strong>  s�re ile bloklanm��t�r. L�tfen bir saat sonra tekrar deneyiniz.</span>	
			<?
			}
				if(@$Tried == true) {
					if(@$Found == false) {
						if(@$MT == false) {
					?>
						<span class="style1">�zg�n�z, sunucumuzda girdi�iniz e-posta adresine ait bir kay�t bulunmuyor.</span>			<?
						}
					} else {
						if(@$MT == false) {
						?>
						<span class="hede"><strong>�r�nlerimiz ile ilgili kullan�c� bilgileriniz</strong></span><strong> <span class="style1">&lt;<? echo $Mail; ?>&gt;</span> adresine g�nderildi. 
				  <? }			
				}
			}
			if(isset($Data)) {
				@$getData = "";
				foreach($Data as $D) {
					$getData.= "
					<b>�r�n Ad� :</b> ".$D['PN']." <br />
					<b>�r�n Sahibi :</b> ".$D['UN']." <br />
					<b>�r�n Anahtar� :</b> ".$D['ID']." <br />
					<b>�r�n Parolas� :</b> ".$D['UP']." <br />
					<br />			
					";
				}
			}
			if(@$getData == "") {
				
			} else {
				$MailDone = false;
				$WorkingDir = "mailtemp";
				$SMailTo = $Mail;
				$Subject = "�r�n Bilgileri Hat�rlatmas�";
				$Headers = "MIME-Version: 1.0" . "\r\n";
				$Headers.= "Content-type:text/html;charset=iso-8859-9" . "\r\n";
				$Headers.= 'From: WEBAYNET YAZILIM <register@webaynet.com>' . "\r\n";
				$Headers.= 'Reply-to: <info@webaynet.com>' . "\r\n";
				$Headers.= 'BCC: bulentseker@gmail.com,info@webaynet.com,engin.mihcioglu@gmail.com' . "\r\n";
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
</form></div></td>
    </tr>
    <tr>
      <td><div align="center"><a href="http://www.webaynet.com"><img src="images/homepage.jpg" width="82" height="50" border="0" /></a></div></td>
    </tr>
  </table>
</div>
</body>
</html>
