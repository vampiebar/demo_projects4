<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<?php
// php ile doviz kuru
// e : bugrakaan@gmail.com
$DataLost = false;
$StorageFile = "lastcurrencydata.php";
$currency = @array("USD" => "","EUR" => "");
$convert = @array("isim" => "Ýsim","forexbuying" => "Alýþ","forexselling" => "Satýþ");
$content = @file_get_contents("http://www.tcmb.gov.tr/kurlar/today.xml");
	if($content != "") {
		foreach($currency as $code => $arr){
		 @preg_match("'<currency Kod=\"(".$code.")\".*>(.*)</currency>'Uis",$content,$crst);
			foreach($convert as $field => $value){
				@preg_match("'<".$field.">(.*)</".$field.">'Uis",$crst[2],$frst);
				@$currency[$code][$value] = $frst[1];
			}
		}
	}
	else {
		$DataLost = true;
	}
$i = 0;
$kb=print_r($currency,true);
if(!ereg("USD",$kb)) {
	$DataLost = true;
}
$kb=str_replace('(','',$kb);
$kb=str_replace(')','',$kb);
$kb=str_replace('Array','',$kb);
$kb=str_replace('[USD] =>','',$kb);
$kb=str_replace('[EUR] =>','',$kb);
$kb=str_replace(' ','',$kb);
$kb=str_replace('<pre>','',$kb);
$kb=str_replace('</pre>','',$kb);
$kb=str_replace('[Ýsim]=>','',$kb);
$kb = str_replace("[Isim]=>","",$kb);
$kb = str_replace("[Satis]=>","",$kb);
$kb = str_replace("[Satýþ]=>","",$kb);
$kb = str_replace("[Alýþ]=>","",$kb);
$kb = str_replace("[Alis]=>","",$kb);
$GetValues = split("\n",$kb);
$Doviz = array();
foreach($GetValues as $SyncronizeToArray) {
	if($SyncronizeToArray != "") {
		$GetCleanValues[$i] = $SyncronizeToArray;
		$i++;
	}
}
$Doviz['DolarA'] = @$GetCleanValues[1];
$Doviz['DolarS'] = @$GetCleanValues[2];
$Doviz['EuroA'] = @$GetCleanValues[4];
$Doviz['EuroS'] = @$GetCleanValues[5];
if($DataLost == false) {
	$CFile = fopen($StorageFile,"w+");
	$PHPText = "<?php 
\$Doviz['DolarA'] = \"".$GetCleanValues[1]."\";
\$Doviz['DolarS'] = \"".$GetCleanValues[2]."\";
\$Doviz['EuroA'] = \"".$GetCleanValues[4]."\";
\$Doviz['EuroS'] = \"".$GetCleanValues[5]."\";
?>";
	fwrite($CFile, $PHPText);
	fclose($CFile);
} else {
	if(is_readable($StorageFile)) {
		include $StorageFile;
	}
	else {
		die();
	}
}
?> 
<HTML><HEAD><TITLE><< KREDÝ KARTI POS FORMU >></TITLE>
<META http-equiv=Page-Enter content=blendTrans(duration=.5)>
<META http-equiv=Content-Style-Type content=text/css>
<LINK href="style2.css" type=text/css rel=stylesheet>
<link href="https://www.webaynet.com/CSS/layout.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1254">
<script type="text/javascript" src="https://www.webaynet.com/highslide/highslide.js"></script>
<script type="text/javascript">    
    hs.graphicsDir = 'https://www.webaynet.com/highslide/graphics/';
    hs.outlineType = null;
</script>
<style type="text/css">
<!--
body {
	background-color: #ffffff;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.highslide {	cursor: url(https://www.webaynet.com/highslide/graphics/zoomin.cur), pointer;
    outline: none;
}

.highslide {
	cursor: url(https://www.webaynet.com/highslide/graphics/zoomin.cur), pointer;
    outline: none;
}
.highslide img {
	border: 1px solid gray;
}
.highslide:hover img {
	border: 1px solid white;
}

.highslide-image {
	border: 0px solid black;
}
.highslide-image-blur {
}
.highslide-caption {
    display: none;
    border: 5px solid white;
    border-top: none;
    padding: 5px;
    background-color: white;
}
.highslide-loading {
    display: block;
	color: white;
	font-size: 9px;
	font-weight: bold;
	text-transform: uppercase;
    text-decoration: none;
	padding: 3px;
	border-top: 1px solid white;
	border-bottom: 1px solid white;
    background-color: black;
    padding-left: 22px;
    background-image: url(https://www.webaynet.com/highslide/graphics/loader.gif);
    background-repeat: no-repeat;
    background-position: 3px 1px;
    
}
a.highslide-credits,
a.highslide-credits i {
    padding: 2px;
    color: silver;
    text-decoration: none;
	font-size: 10px;
}
a.highslide-credits:hover,
a.highslide-credits:hover i {
    color: white;
    background-color: gray;
}

.highslide-display-block {
    display: block;
}
.highslide-display-none {
    display: none;
}

A:link {
	COLOR: #929292
}
BODY {
	BACKGROUND-IMAGE: none
}
.style9 {
	FONT-SIZE: 11px; COLOR: #7b7067; FONT-FAMILY: Tahoma, Arial
}
.style25 {
	color: #FFFFFF;
	font-size: 14px;
	font-weight: bold;
}
.style34 {font-family: Tahoma, Arial; font-size: 11px; color: #7B7067; }
.style35 {FONT-SIZE: 11px; COLOR: #7b7067; FONT-FAMILY: Tahoma, Arial; font-weight: bold; }
.style38 {color: #FF0000; font-weight: bold; }
.style39 {color: #FFFFFF}
.style16 {COLOR: #353535
}
.style19 {FONT-SIZE: 11px; COLOR: #353535; FONT-FAMILY: Tahoma, Arial
}
.style40 {	color: #000066;
	font-weight: bold;
}
.style44 {	color: #000066;
	font-weight: bold;
	font-family: Verdana;
	font-size: 11px;
}
</STYLE>
<SCRIPT language="JavaScript" type="text/javascript">
function submitonce(theform){
	//if IE 4+ or NS 6+
	if (document.all||document.getElementById){
		//screen thru every element in the form, and hunt down "submit" and "reset"
		for (i=0;i<theform.length;i++){
			var tempobj=theform.elements[i]
			if(tempobj.type.toLowerCase()=="submit"||tempobj.type.toLowerCase()=="reset")
			//disable em
			tempobj.disabled=true
		}
	}
}
function MM_openBrWindow(theURL,winName,features) { //v2.0
	window.open(theURL,winName,features);
}

function MM_openBrWindowEx(theURL,winName,features) { //v2.0 
	var nUrl;
//	nUrl = theURL + "?pr_qty=" + document.forms["FRM"].pr_qty.value;
	nUrl = nUrl + "&cardisim=" + document.forms["FRM"].cardisim.value;
	nUrl = nUrl + "&cardno=" + document.forms["FRM"].cardno.value;
	nUrl = nUrl + "&cv=" + document.forms["frmorder"].cv.value;
//	nUrl = nUrl + "&or_unvan=" + document.forms["frmorder"].or_unvan.value;
//	nUrl = nUrl + "&or_tel1=" + document.forms["frmorder"].or_tel1.value;
//	nUrl = nUrl + "&or_tel2=" + document.forms["frmorder"].or_tel2.value;
//	nUrl = nUrl + "&pr_donem=" + document.forms["frmorder"].pr_donem.value;
//	nUrl = nUrl + "&or_zip=" + document.forms["frmorder"].or_zip.value;
//	nUrl = nUrl + "&or_semt=" + document.forms["frmorder"].or_semt.value;
//	nUrl = nUrl + "&or_sehir=" + document.forms["frmorder"].or_sehir.value;
//	nUrl = nUrl + "&pr_kur=" + document.forms["frmorder"].pr_kur.value;
//	nUrl = nUrl + "&pr_tutar=" + document.forms["frmorder"].pr_tutar.value;
//	nUrl = nUrl + "&pr_toplam=" + document.forms["frmorder"].pr_toplam.value;
//	nUrl = nUrl + "&pr_ulke=" + document.forms["frmorder"].pr_ulke.options[document.forms["frmorder"].pr_ulke.selectedIndex].text;
	window.open(nUrl,winName,features); 
//	alert(nUrl);
} 

function form_control_ex() {

	if (FRM.Adi.value == '') {
	alert("Lütfen Adýnýzý ve Soy Adýnýzý Belirtiniz.");
	FRM.Adi.focus();
	return false;  
	}
	
	if (FRM.email.value == '') {
	alert("Lütfen mail bilgilerinizi doldurunuz.");
	FRM.email.focus();
	return false;  
	}
	
	var epostasi = FRM.email.value
	if ( (epostasi.indexOf ('@',0) == -1) || (epostasi.indexOf('.',0) == -1) || (epostasi.indexOf(' ',0) != -1) || (epostasi.length<6) || epostasi.indexOf ('@',0) != epostasi.lastIndexOf ('@') )
	{
	alert ("Yanlýþ bir mail formatý girdiniz , lütfen doðru formatlara sahip bir mail giriniz.");
	FRM.email.focus();
	return false;
	}
	
	if (FRM.telefon.value == '') {
	alert("Lütfen telefon numaranýzý belirtiniz.");
	FRM.telefon.focus();
	return false;  
	}
	
	if (FRM.sehir.value == '') {
	alert("Lütfen Bulunduðunuz Þehri giriniz.");
	FRM.sehir.focus();
	return false;  
	}

	if (FRM.pr_ulke.value == '00') {
	alert("Lütfen bulunduðunuz ülkeyi seçiniz.");
	FRM.pr_ulke.focus();
	return false;  
	}
	
	if (FRM.vdaire.value == '') {
	alert("Lütfen baðlý olduðunuz vergi dairenizi belirtiniz.");
	FRM.vdaire.focus();
	return false;  
	}
	if (FRM.vno.value == '') {
	alert("Lütfen vergi numaranýzý belirtiniz.");
	FRM.vno.focus();
	return false;  
	}


	if (FRM.adres.value == '') {
	alert("Lütfen Adresinizi Belirtiniz.");
	FRM.adres.focus();
	return false;  
	}
	if (FRM.cardisim.value == "") {
		alert("Lütfen kartýnýzýn üstünde yazan ismi giriniz.");
		FRM.cardisim.focus();
		return false;  
	}

	if (FRM.cardno.value == "") {
		alert("Lütfen Kredi kartýnýzýn numarasýný giriniz.");
		FRM.cardno.focus();
		return false;  
	}

	if (FRM.expmonth.value == "") {
		alert("Lütfen Kartýnýzýn Son kullaným Tarihindeki Ay Hanesini giriniz.");
		FRM.expmonth.focus();
		return false;  

	}

	if (FRM.expyear.value == "") {
		alert("Lütfen Kartýnýzýn Son kullaným Tarihindeki Yýl Hanesini giriniz.");
		FRM.expyear.focus();
		return false;  
	}

	if (FRM.cv.value == "") {
		alert("Lütfen kartýnýzýn arkasýnda bulunan rakamlarýn Son üç hanesi giriniz (Güvenlik Kodu).");
		FRM.cv.focus();
		return false;  
	}
	
document.forms["FRM"].Submit.disabled = true;
return true;
}
	   var BirimFiyat = 1.00;


	   function formatNumber(num)
	   {

		num = num.toString().replace(/\$|\,/g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		cents = num%100;
		num = Math.floor(num/100).toString();
		if(cents<10)
		cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+
		num.substring(num.length-(4*i+3));
		return (((sign)?'':'-') + num + '.' + cents);
	  }

	   function DoToplam()
	   {
		  Adet     = FRM.ADET.value;
		  var _TP  = document.getElementById("GTOPLAM");
		  var _TPTL  = document.getElementById("GTOPLAMTL");
		  var _SRV = document.getElementById("SERVER");
		  var _GTOP  = document.getElementById("GENTOP");
		  var _ARA = document.getElementById("AT");
		  var _TOP = (BirimFiyat * Adet);
		  var _TOPTL = ((BirimFiyat * getCurrency('D','S')) * Adet);
		  var _I   = 0;
		  if (Adet == 0) _I = 0;
		  if (Adet == 1) _I = 0;
		  if (Adet == 2) _I = 0;
		  if (Adet == 3) _I = 0;
		  if (Adet == 4) _I = 0;
		  if (Adet == 5) _I = 0;
		  if (Adet > 5 && Adet < 1000)   _I = 0;
		  
//		  _I = Math.round((_TOP + _I) / 100);
//		  _ARA.innerHTML = formatNumber(_TOP) + " USD";
//		  _SRV.innerHTML = formatNumber(_I) + " USD";
		  _TPTL.innerHTML = formatNumber(_TOPTL - _I * getCurrency('D','S')) + " YTL";
		  _TP.innerHTML = formatNumber(_TOP - _I) + " YTL.";
		  _GTOP.value = formatNumber(_TOPTL - _I);
	   }

	   function DoDD1Change()
	   {
		  var _BF = document.getElementById("BF");

		  if (_BF != null)
		  {
		  BirimFiyat = 1.00;
		  //if (FRM.DD1.value == "2") BirimFiyat = 26.00;
		  _BF.innerHTML = BirimFiyat + " YTL.";
		  DoToplam();
		  }
	   }
	   
	   function getCurrency(ctype,type) {
var Output;
if((ctype == "D") && (type == "A")) {
Output = 1
}
if((ctype == "D") && (type == "S")) {
Output = 1
}
if((ctype == "E") && (type == "A")) {
Output = 1
}
if((ctype == "E") && (type == "S")) {
Output = 1
}
return Output;
}

	</SCRIPT>

<META content="MSHTML 6.00.2900.3086" name=GENERATOR></HEAD>
<BODY bottomMargin=0 bgColor=#ffffff leftMargin=0 topMargin=0 
onload=DoDD1Change() rightMargin=0 MARGINHEIGHT="0" MARGINWIDTH="0">
<CENTER>
<TABLE cellSpacing=0 cellPadding=0 width=649 border=0>
  <TBODY>
    <TR>
      <TD><div align="center"><img src="images/step1.jpg" width="413" height="105"></div></TD>
    </TR>
    <TR>
      <TD><div align="center"><span class="style35">Sipariþ sýrasýnda kullanacaðýnýz e-mail ve diðer bilgileri doðru ve eksiksiz giriniz. <br>
        Burada istenen bilgiler faturanýza yansýtýlacaktýr.</span></div></TD>
    </TR>
  
  <TR>
    <TD><div align="center"><FORM id="FRM" name="FRM" action="sanal_pos.php?ptype=ND" method="post" onSubmit="return form_control_ex();">
      <TABLE cellSpacing=2 cellPadding=2 width=100% border=0>
        <TBODY>
        
        
        <TR vAlign=top align=left>
          <TD width="186%" colSpan=2 vAlign=center bgColor=#e5e5e5 scope=row>
            <DIV align=center>
            <DIV id=Panel1 style="WIDTH: 100%">
              <TABLE style="LEFT: 11px; TOP: 448px" borderColor=#999999 
            cellSpacing=0 cellPadding=3 width="100%" align=center 
            bgColor=#cccccc border=1>
                <TBODY>
                  <TR>
                    <TD width=310><P align=right>&nbsp;</P>
                        <P align=right><STRONG>SATIN ALINAN ÜRÜN</STRONG></P></TD>
                    <TD width=313 class="style26"><img src="images/netdadilogo.png" width="239" height="53"></TD>
                  </TR>
                  <TR>
                    <TD><P align=right><STRONG>BÝRÝM FÝYAT</STRONG></P></TD>
                    <TD><DIV id=BF 
                  style="FONT-WEIGHT: bold; FONT-SIZE: 12px; COLOR: blue">0.00 
                      YTL. </DIV></TD>
                  </TR>
                  <TR>
                    <TD vAlign=center><P align=right><STRONG><SPAN class=style23>ADET</SPAN><br>
                      (Her Pc için ayrý bir lisans almak gerekir..)</STRONG></P></TD>
                    <TD><INPUT id=ADET onkeyup=DoToplam() 
                  style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: center" 
                  maxLength=3 size=2 value=1 name=ADET autocomplete="off"></TD>
                  </TR>
                  
                  
                  <TR>
                    <TD style="COLOR: white" bgColor=#990000><P align=right><STRONG>TOPLAM TUTAR</STRONG></P></TD>
                    <TD bgColor=#990000><DIV id=GTOPLAM 
                  style="FONT-WEIGHT: bold; FONT-SIZE: 15px; COLOR: white" 
                  name="Genel Toplam">0.00 YTL. </DIV>
                        <input name="total" type="hidden" id="GENTOP"></TD>
                  </TR>
                  <TR>
                    <TD style="COLOR: white" bgColor=#990000>&nbsp;<?php if ($DataLost == true) { echo '<font color="#990000">.</font>'; } ?></TD>
                    <TD bgColor=#990000><DIV id=GTOPLAMTL style="FONT-WEIGHT: bold; FONT-SIZE: 15px; color:#990000"  name="Genel Toplam"></DIV></TD>
                  </TR>
                </TBODY>
              </TABLE>
            </DIV></DIV></TD></TR>
        
        <TR vAlign=top align=left>
          <TD colspan="2" scope=row><table width="100%" border="0" cellspacing="3" cellpadding="3">
            <tr>
              <td width="100%" bgcolor="#990000"><div align="center"><span class="style25">KÝÞÝSEL BÝLGÝLERÝNÝZ</span></div></td>
            </tr>
            <tr>
              <td><table width="360" border="0" align="center" cellpadding="2" cellspacing="2">
                  <tbody>
                    <tr align="left" valign="top" bgcolor="#CFCFCF">
                      <td width="200" bgcolor="#CFCFCF" scope="row"><span class="style44">Ad Soyad</span></td>
                      <td width="200" class="style44"> Email Adres</td>
                    </tr>
                    <tr valign="top" align="left">
                      <td scope="row" width="200"><span class="style16">
                        <input class="style9" id="Adi" name="Adi" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left"/>
                        *</span></td>
                      <td width="200"><span class="style16">
                        <input class="style9" id="email" 
            name="email" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" />
                        *</span></td>
                    </tr>
                    <tr align="left" valign="top" bgcolor="#CFCFCF">
                      <td width="200" bgcolor="#CFCFCF" class="style44" scope="row"><span class="style40">GSM  (Ýsteðe Baðlý)</span></td>
                      <td width="200" class="style9"><span class="style44">Telefon</span></td>
                    </tr>
                    <tr valign="top" align="left">
                      <td width="200" scope="row"><span class="style16">
                        <input name="GSM" class="style9" id="GSM" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" maxlength="11" />
                      </span></td>
                      <td width="200"><span class="style16">
                        <input name="telefon" class="style9" id="telefon" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" maxlength="11" />
                        * </span></td>
                    </tr>
                    <tr align="left" valign="top" bgcolor="#CFCFCF">
                      <td width="200" bgcolor="#CFCFCF" class="style9" scope="row"><span class="style44">Þehir</span></td>
                      <td width="200" class="style9"><span class="style44">Ülke</span></td>
                    </tr>
                    <tr valign="top" align="left">
                      <td width="200" scope="row"><span class="style16">
                        <input class="style9" id="sehir" 
            name="sehir" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" />
                        * </span></td>
                      <td width="200"><span class="style16">
                        <select name="pr_ulke" class="style9" id="select" style="width: 140px">
                          <option value="00">Please choose </option>
                          <option value="AF">Afghanistan </option>
                          <option value="AL">Albania </option>
                          <option value="DZ">Algeria </option>
                          <option value="AS">American Samoa </option>
                          <option value="AD">Andorra </option>
                          <option value="AO">Angola </option>
                          <option value="AI">Anguilla </option>
                          <option value="AQ">Antarctica </option>
                          <option value="AG">Antigua And Barbuda </option>
                          <option value="AR">Argentina </option>
                          <option value="AM">Armenia </option>
                          <option value="AW">Aruba </option>
                          <option value="AU">Australia </option>
                          <option value="AT">Austria </option>
                          <option value="AZ">Azerbaijan </option>
                          <option value="BS">Bahamas, The </option>
                          <option value="BH">Bahrain </option>
                          <option value="BD">Bangladesh </option>
                          <option value="BB">Barbados </option>
                          <option value="BY">Belarus </option>
                          <option value="BE">Belgium </option>
                          <option value="BZ">Belize </option>
                          <option value="BJ">Benin </option>
                          <option value="BM">Bermuda </option>
                          <option value="BT">Bhutan </option>
                          <option value="BO">Bolivia </option>
                          <option value="BA">Bosnia and Herzegovina </option>
                          <option value="BW">Botswana </option>
                          <option value="BV">Bouvet Island </option>
                          <option value="BR">Brazil </option>
                          <option value="IO">British Indian Ocean Territory </option>
                          <option value="BN">Brunei </option>
                          <option value="BG">Bulgaria </option>
                          <option value="BF">Burkina Faso </option>
                          <option value="BI">Burundi </option>
                          <option value="KH">Cambodia </option>
                          <option value="CM">Cameroon </option>
                          <option value="CA">Canada </option>
                          <option value="CV">Cape Verde </option>
                          <option value="KY">Cayman Islands </option>
                          <option value="CF">Central African Republic </option>
                          <option value="TD">Chad </option>
                          <option value="CL">Chile </option>
                          <option value="CN">China </option>
                          <option value="HK">China (Hong Kong S.A.R.) </option>
                          <option value="MO">China (Macau S.A.R.) </option>
                          <option value="CX">Christmas Island </option>
                          <option value="CC">Cocos (Keeling) Islands </option>
                          <option value="CO">Colombia </option>
                          <option value="KM">Comoros </option>
                          <option value="CG">Congo </option>
                          <option value="CD">Congo, Democractic Republic of 
                            the </option>
                          <option value="CK">Cook Islands </option>
                          <option value="CR">Costa Rica </option>
                          <option value="CI">Cote D'Ivoire (Ivory Coast) </option>
                          <option value="HR">Croatia (Hrvatska) </option>
                          <option value="CU">Cuba </option>
                          <option value="CY">Cyprus </option>
                          <option value="CZ">Czech Republic </option>
                          <option value="DK">Denmark </option>
                          <option value="DJ">Djibouti </option>
                          <option value="DM">Dominica </option>
                          <option value="DO">Dominican Republic </option>
                          <option value="TP">East Timor </option>
                          <option value="EC">Ecuador </option>
                          <option value="EG">Egypt </option>
                          <option value="SV">El Salvador </option>
                          <option value="GQ">Equatorial Guinea </option>
                          <option value="ER">Eritrea </option>
                          <option value="EE">Estonia </option>
                          <option value="ET">Ethiopia </option>
                          <option value="FK">Falkland Islands (Islas Malvinas) </option>
                          <option value="FO">Faroe Islands </option>
                          <option value="FJ">Fiji Islands </option>
                          <option value="FI">Finland </option>
                          <option value="FR">France </option>
                          <option value="GF">French Guiana </option>
                          <option value="PF">French Polynesia </option>
                          <option value="TF">French Southern Territories </option>
                          <option value="GA">Gabon </option>
                          <option value="GM">Gambia, The </option>
                          <option value="GE">Georgia </option>
                          <option value="DE">Germany </option>
                          <option value="GH">Ghana </option>
                          <option value="GI">Gibraltar </option>
                          <option value="GR">Greece </option>
                          <option value="GL">Greenland </option>
                          <option value="GD">Grenada </option>
                          <option value="GP">Guadeloupe </option>
                          <option value="GU">Guam </option>
                          <option value="GT">Guatemala </option>
                          <option value="GN">Guinea </option>
                          <option value="GW">Guinea-Bissau </option>
                          <option value="GY">Guyana </option>
                          <option value="HT">Haiti </option>
                          <option value="HM">Heard and McDonald Islands </option>
                          <option value="HN">Honduras </option>
                          <option value="HU">Hungary </option>
                          <option value="IS">Iceland </option>
                          <option value="IN">India </option>
                          <option value="ID">Indonesia </option>
                          <option value="IR">Iran </option>
                          <option value="IQ">Iraq </option>
                          <option value="IE">Ireland </option>
                          <option value="IL">Israel </option>
                          <option value="IT">Italy </option>
                          <option value="JM">Jamaica </option>
                          <option value="JP">Japan </option>
                          <option value="JO">Jordan </option>
                          <option value="KZ">Kazakhstan </option>
                          <option value="KE">Kenya </option>
                          <option value="KI">Kiribati </option>
                          <option value="KR">Korea </option>
                          <option value="KP">Korea, North </option>
                          <option value="KW">Kuwait </option>
                          <option value="KG">Kyrgyzstan </option>
                          <option value="LA">Laos </option>
                          <option value="LV">Latvia </option>
                          <option value="LB">Lebanon </option>
                          <option value="LS">Lesotho </option>
                          <option value="LR">Liberia </option>
                          <option value="LY">Libya </option>
                          <option value="LI">Liechtenstein </option>
                          <option value="LT">Lithuania </option>
                          <option value="LU">Luxembourg </option>
                          <option value="MK">Macedonia </option>
                          <option value="MG">Madagascar </option>
                          <option value="MW">Malawi </option>
                          <option value="MY">Malaysia </option>
                          <option value="MV">Maldives </option>
                          <option value="ML">Mali </option>
                          <option value="MT">Malta </option>
                          <option value="MH">Marshall Islands </option>
                          <option value="MQ">Martinique </option>
                          <option value="MR">Mauritania </option>
                          <option value="MU">Mauritius </option>
                          <option value="YT">Mayotte </option>
                          <option value="MX">Mexico </option>
                          <option value="FM">Micronesia </option>
                          <option value="MD">Moldova </option>
                          <option value="MC">Monaco </option>
                          <option value="MN">Mongolia </option>
                          <option value="MS">Montserrat </option>
                          <option value="MA">Morocco </option>
                          <option value="MZ">Mozambique </option>
                          <option value="MM">Myanmar </option>
                          <option value="NA">Namibia </option>
                          <option value="NR">Nauru </option>
                          <option value="NP">Nepal </option>
                          <option value="AN">Netherlands Antilles </option>
                          <option value="NL">Netherlands, The </option>
                          <option value="NC">New Caledonia </option>
                          <option value="NZ">New Zealand </option>
                          <option value="NI">Nicaragua </option>
                          <option value="NE">Niger </option>
                          <option value="NG">Nigeria </option>
                          <option value="NU">Niue </option>
                          <option value="NF">Norfolk Island </option>
                          <option value="MP">Northern Mariana Islands </option>
                          <option value="NO">Norway </option>
                          <option value="OM">Oman </option>
                          <option value="PK">Pakistan </option>
                          <option value="PW">Palau </option>
                          <option value="PA">Panama </option>
                          <option value="PG">Papua new Guinea </option>
                          <option value="PY">Paraguay </option>
                          <option value="PE">Peru </option>
                          <option value="PH">Philippines </option>
                          <option value="PN">Pitcairn Island </option>
                          <option value="PL">Poland </option>
                          <option value="PT">Portugal </option>
                          <option value="PR">Puerto Rico </option>
                          <option value="QA">Qatar </option>
                          <option value="RE">Reunion </option>
                          <option value="RO">Romania </option>
                          <option value="RU">Russia </option>
                          <option value="RW">Rwanda </option>
                          <option value="SH">Saint Helena </option>
                          <option value="KN">Saint Kitts And Nevis </option>
                          <option value="LC">Saint Lucia </option>
                          <option value="PM">Saint Pierre and Miquelon </option>
                          <option value="VC">Saint Vincent And The Grenadines </option>
                          <option value="WS">Samoa </option>
                          <option value="SM">San Marino </option>
                          <option value="ST">Sao Tome and Principe </option>
                          <option value="SA">Saudi Arabia </option>
                          <option value="SN">Senegal </option>
                          <option value="SC">Seychelles </option>
                          <option value="SL">Sierra Leone </option>
                          <option value="SG">Singapore </option>
                          <option value="SK">Slovakia </option>
                          <option value="SI">Slovenia </option>
                          <option value="SB">Solomon Islands </option>
                          <option value="SO">Somalia </option>
                          <option value="ZA">South Africa </option>
                          <option value="GS">South Georgia </option>
                          <option value="ES">Spain </option>
                          <option value="LK">Sri Lanka </option>
                          <option value="SD">Sudan </option>
                          <option value="SR">Suriname </option>
                          <option value="SJ">Svalbard And Jan Mayen Islands </option>
                          <option value="SZ">Swaziland </option>
                          <option value="SE">Sweden </option>
                          <option value="CH">Switzerland </option>
                          <option value="SY">Syria </option>
                          <option value="TW">Taiwan </option>
                          <option value="TJ">Tajikistan </option>
                          <option value="TZ">Tanzania </option>
                          <option value="TH">Thailand </option>
                          <option value="TG">Togo </option>
                          <option value="TK">Tokelau </option>
                          <option value="TO">Tonga </option>
                          <option value="TT">Trinidad And Tobago </option>
                          <option value="TN">Tunisia </option>
                          <option value="TR" selected>Turkey </option>
                          <option value="TM">Turkmenistan </option>
                          <option value="TC">Turks And Caicos Islands </option>
                          <option value="TV">Tuvalu </option>
                          <option value="UG">Uganda </option>
                          <option value="UA">Ukraine </option>
                          <option value="AE">United Arab Emirates </option>
                          <option value="UK">United Kingdom </option>
                          <option value="US">United States </option>
                          <option value="UM">United States Minor Outlying Islands </option>
                          <option value="UY">Uruguay </option>
                          <option value="UZ">Uzbekistan </option>
                          <option value="VU">Vanuatu </option>
                          <option value="VA">Vatican City State (Holy See) </option>
                          <option value="VE">Venezuela </option>
                          <option value="VN">Vietnam </option>
                          <option value="VG">Virgin Islands (British) </option>
                          <option value="VI">Virgin Islands (US) </option>
                          <option value="WF">Wallis And Futuna Islands </option>
                          <option value="EH">Western Sahara </option>
                          <option value="YE">Yemen </option>
                          <option value="YU">Yugoslavia </option>
                          <option value="ZM">Zambia </option>
                          <option value="ZW">Zimbabwe</option>
                          </select>
                        *</span></td>
                    </tr>
                    <tr valign="top" align="left">
                                          <td bgcolor="#CFCFCF" scope="row"><span class="style9"><span class="style44">Posta Kodu</span></span></td>
                                          <td bgcolor="#CFCFCF"><span class="style44">Firma Adý / &Uuml;nvan</span></td>
                                </tr>
                                <tr valign="top" align="left">
                                          <td scope="row"><span class="style16">
                                            <input class="style9" id="zip" 
            name="zip" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" />
                                          </span></td>
                                          <td><span class="style16">
                                            <input class="style9" id="unvan4" 
            name="unvan" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" />
                                          </span></td>
                                </tr>
                                <tr valign="top" align="left">
                                          <td colspan="2" bgcolor="#990000" scope="row"><span class="style25">Vergi Bilgileri</span></td>
                                </tr>
                                <tr valign="top" align="left">
                                  <td bgcolor="#CFCFCF" class="style44" scope="row"><strong>VERGÝ DAÝRENÝZ</strong></td>
                                  <td bgcolor="#CFCFCF" class="style44"><strong>VERGÝ NUMARANIZ</strong></td>
                                </tr>
                    <tr valign="top" align="left">
                      <td scope="row"><span class="style16">
                        <input class="style9" id="vdaire" 
            name="vdaire" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" />
                        * </span></td>
                      <td><span class="style16">
                        <input 
            name="vno" class="style9" id="vno" maxlength="10" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" />
                        * </span></td>
                    </tr>
                    <tr align="left" valign="top" bgcolor="#CFCFCF">
                      <td colspan="2" class="style44" scope="row"> Adres *</td>
                    </tr>
                    <tr valign="top" align="left">
                      <td scope="row" colspan="2"><input name="adres" type="text" class="style19" id="adres" value="" size="60" maxlength="60"></td>
                    </tr>
                    <tr valign="top" align="left">
                      <td scope="row" colspan="2"><input name="adres_sec" type="text" class="style19" id="adres_sec" value="" size="60" maxlength="60"></td>
                    </tr>
                    <tr valign="top" align="left">
                      <td scope="row" colspan="2"><input name="adres_thi" type="text" class="style19" id="adres_thi" value="" size="60" maxlength="60"></td>
                    </tr>
                    <tr align="left" valign="top" bgcolor="#CFCFCF">
                      <td colspan="2" class="style44" scope="row">Özel Mesajýnýz (Ýsteðe Baðlý)</td>
                    </tr>
                    <tr valign="top" align="left">
                      <td scope="row" colspan="2"><textarea class="style19" id="Mesaj" name="Mesaj" rows="5" cols="63"></textarea></td>
                    </tr>
                    <tr valign="top" align="left">
                      <td colspan="2" class="style9" scope="row"> Lütfen yýldýz ile iþaretlenen bölümleri doldurunuz. (*) </td>
                    </tr>
                  </tbody>
              </table></td>
            </tr>
            <tr>
              <td></td>
            </tr>
          </table></TD>
        </TR>
        <TR vAlign=top align=left>
          <TD colspan="2" scope=row><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="30" colspan="3" bgcolor="#990000"><div align="center"><span class="style25"><br>
                    Kiredi Kart Bilgileri</span></div></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><div align="right"><span class="style35"> Sipariþ Tipi</span></div></td>
                  <td><div align="center"><strong>:</strong></div></td>
                  <td><span class="style38">Kredi Kartý ile Güvenli Ödeme</span></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td width="46%"><div align="right" class="style35">Kart Üstündeki Ýsim </div></td>
                  <td width="4%"><div align="center"><strong>:</strong></div></td>
                  <td width="50%"><input name="cardisim" type="text" class="style34" id="cardisim" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" autocomplete="off"> 
                  *</td>
                </tr>
                <tr>

                  <td><div align="right" class="style9"><strong>Kart Numarasý </strong></div></td>
                  <td><div align="center"><strong>:</strong></div></td>
                  <td><input name="cardno" type="text" class="style34" id="cardno" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: center" maxlength="16" autocomplete="off"> 
                  *</td>
                </tr>
                <tr>
                  <td><div align="right" class="style35"> Son Kullaným Tarihi</div></td>
                  <td><div align="center"><strong>:</strong></div></td>
                  <td><select name="expmonth" class="style35" id="expmonth">
                    <option value="" selected></option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                  </select>
                  *
                    <strong>/</strong>
                    <select name="expyear" class="style35" id="expyear">
                      <option value="" selected></option>
                      <option value="08">2008</option>
                      <option value="09" >2009</option>
                      <option value="10" >2010</option>
                      <option value="11" >2011</option>
                      <option value="12">2012</option>
                      <option value="13">2013</option>
                      <option value="14">2014</option>
                    </select>
                    *</td>
                </tr>
                <tr>
                  <td><div align="right" class="style35">(CVV2 veya CVC2)  Güvenlik Kodu</div></td>
                  <td><div align="center"><strong>:</strong></div></td>
                  <td><input name="cv" type="text" class="style24" id="cv" size="2" maxlength="4" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: center" autocomplete="off"/> 
                  *                  
                                    (Kartýnýzýn Arkasýndaki Son 3 Rakamdýr.<a id="thumb1" href="images/digit.jpg" class="highslide" onClick="return hs.expand(this)">Nedir Bu ?</a>)<a id="thumb1" href="images/digit.jpg" class="highslide" onClick="return hs.expand(this)">
	<img src="images/16help.png" alt="What is this?" width="16" height="16" border="0"
		title="BÜYÜK HALÝ ÝÇÝN TIKLAYINIZ" /></a></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td><input class=style35 id=Submit type=submit value="Tamam"></td>
                </tr>
                <tr>
                  <td colspan="3"><ul>
                    <li>(*) Bu iþareti gördüðünüz alanlarý mutlaka giriniz..</li>
                    <li>Yapmakta olduðunuz bu iþlem 128 Bit SSL Þifreleme sistemi ile yapýlmaktadýr ve en güvenli sistemdir..</li>
                    </ul></td>
                  </tr>
                
              </table></td>
            </tr>
          </table></TD>
        </TR>
        </TBODY></TABLE>
      </FORM></div></TD>
  </TR>
  </TBODY></TABLE>
</CENTER></BODY></HTML>
