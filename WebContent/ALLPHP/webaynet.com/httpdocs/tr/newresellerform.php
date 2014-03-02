<HTML>
<HEAD>
<TITLE>NETDADI &lt;&lt;  &gt;&gt;</TITLE>
<meta http-equiv="Page-Enter" content="blendTrans(duration=.5)">
<meta http-equiv="Content-Style-Type" content="text/css">
<LINK HREF="style2.css" TYPE="text/css" REL="stylesheet"> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1254">
<style type="text/css">
<!--
a:link {
	color: #929292;
}
body {
	background-image: newresellerform.php;
}
.style16 {color: #353535}
.style19 {font-family: Tahoma, Arial; font-size: 11px; color: #353535; }
.style9 {font-family: Tahoma, Arial; font-size: 11px; color: #7B7067; }
.style20 {
	color: #5F5F5F;
	font-weight: bold;
}
.style22 {color: #353535; font-weight: bold; }
.style23 {color: #FF0000}
-->
</style>
<SCRIPT language=JavaScript>
function MM_openBrWindow(theURL,winName,features) { //v2.0
window.open(theURL,winName,features);
}

function MM_openBrWindowEx(theURL,winName,features) { //v2.0 
	var nUrl;
	//nUrl = theURL + "?pr_qty=" + document.forms["frmorder"].pr_qty.value;
	nUrl = nUrl + "&Adi=" + document.forms["FRM"].Adi.value;
	nUrl = nUrl + "&email=" + document.forms["FRM"].email.value;
	nUrl = nUrl + "&sehir=" + document.forms["FRM"].sehir.value;
	nUrl = nUrl + "&unvan=" + document.forms["FRM"].unvan.value;
	nUrl = nUrl + "&faaliyet=" + document.forms["FRM"].faaliyet.value;
	nUrl = nUrl + "&vno=" + document.forms["FRM"].vno.value;
	nUrl = nUrl + "&vdaire=" + document.forms["FRM"].vdaire.value;
	nUrl = nUrl + "&telefon=" + document.forms["FRM"].telefon.value;
	nUrl = nUrl + "&adres=" + document.forms["FRM"].adres.value;
//	nUrl = nUrl + "&gsm=" + document.forms["FRM"].gsm.value;
	nUrl = nUrl + "&tcno=" + document.forms["FRM"].tcno.value;
	nUrl = nUrl + "&pr_ulke=" + document.forms["FRM"].pr_ulke.options[document.forms["FRM"].pr_ulke.selectedIndex].text;
	window.open(nUrl,winName,features); 
//	alert(nUrl);
} 

function form_control_ex() {


if (FRM.unvan.value == '') {
alert("LÜTFEN FİRMA ÜNVANINI GİRİNİZ.");
FRM.unvan.focus();
return false;  
}


if (FRM.faaliyet.value == '') {
alert("LÜTFEN FAALİYET ALANINIZI YAZINIZ.");
FRM.faaliyet.focus();
return false;  
}

if (FRM.Adi.value == '') {
alert("LÜTFEN ADINIZI VEYA UNVANINIZI YAZINIZ");
FRM.Adi.focus();
return false;  
}

if (FRM.email.value == '') {
alert("LÜTFEN E-MAİL ADRESİNİZİ YAZINIZ. ÜRÜN AKTİVASYON KODU BU MAİL ADRESİNE GÖNDERİLECEKTİR.");
FRM.email.focus();
return false;  
}

var epostasi = FRM.email.value
if ( (epostasi.indexOf ('@',0) == -1) || (epostasi.indexOf('.',0) == -1) || (epostasi.indexOf(' ',0) != -1) || (epostasi.length<6) || epostasi.indexOf ('@',0) != epostasi.lastIndexOf ('@') )
{
alert ("E-MAİL ADRESİNİZDE BİR YANLIŞLIK VAR, LÜTFEN KONTROL EDİNİZ VE YENİDEN GİRİNİZ.");
FRM.email.focus();
return false;
}

if (FRM.telefon.value == '') {
alert("LÜTFEN TELEFONUNUZU YAZINIZ, SİZİNLE İRTİBATA GEÇEBİLMEMİZ İÇİN BU GEREKLİ");
FRM.telefon.focus();
return false;  
}

if (FRM.faks.value == '') {
alert("LÜTFEN FAKS NUMARANIZI YAZINIZ");
FRM.faks.focus();
return false;  
}

if (FRM.sehir.value == '') {
alert("LÜTFEN BULUNDUĞUNUZ ŞEHRİ YAZINIZ.");
FRM.sehir.focus();
return false;  
}


//if (FRM.gsm.value == '') {
//alert("Please enter your ZIP code");
//FRM.gsm.focus();
//return false;  
//}
if (FRM.pr_ulke.value == '00') {
alert("LÜTFEN BULUNDUĞUNUZ ÜLKEYİ SEÇİNİZ.");
FRM.pr_ulke.focus();
return false;  
}

if (FRM.tcno.value == '') {
alert("LÜTFEN TİCARİ SİCİL NO VEYA T.C. NUMARANIZI GİRİNİZ, FATURA BİLGİLERİ İÇİN GEREKLİDİR.");
FRM.tcno.focus();
return false;  
}

if (FRM.vdaire.value == '') {
alert("LÜTFEN VERGİ DAİRENİZİ");
FRM.vdaire.focus();
return false;  
}

if (FRM.vno.value == '') {
alert("LÜTFEN VERGİ NUMARANIZI YAZINIZ. ");
FRM.vno.focus();
return false;  
}

if (FRM.adres.value == '') {
alert("LÜTFEN ADRESİNİZİ YAZINIZ, FATURANIZIN VE ÜRÜNÜNÜZÜN GÖNDERİLEBİLMESİ İÇİN GEREKLİDİR.");
FRM.adres.focus();
return false;  
}

document.forms["FRM"].Submit.disabled = true;
return true;
}

</SCRIPT>
</HEAD>
<BODY BGCOLOR=#FFFFFF LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0 rightmargin="0" bottommargin="0">
<center>
  <table width="495" border="0" cellpadding="0" cellspacing="0">
    
    <tr>
      <td><div align="center">
        <div align="center">
          <form name="FRM" method="post" action="http://www.webaynet.com/scripts/formmail/nvform.php" onSubmit="return form_control_ex();">
            <table width="100%"  border="0" cellspacing="2" cellpadding="2">
              <tr align="left" valign="bottom">
                <td colspan="2" scope="row"><span class="style16">
                  <input name="Formun Geldiği Alan" type="hidden" id="Formun Geldiği Alan" value="WEB SİTESİ WWW.WEBAYNET.COM">
                  <input type="hidden" name="subject" value="WEBAYNET BAYİİ BAŞVURU FORMU">
                </span></td>
              </tr>
              <tr align="left" valign="top">
                <td colspan="2" scope="row"><div align="center" class="style20">LÜTFEN AŞAĞIDAKİ BİLGİLERİ DOĞRU VE EKSİKSİZ GİRİNİZ, BURADA VERDİĞİNİZ BİLGİLER DOĞRULTUSUNDA DEĞERLENDİRME YAPILACAK VE SİZİNLE İRTİBATA GEÇİLECEKTİR ! </div></td>
              </tr>
              <tr align="left" valign="top">
                <td scope="row">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr align="left" valign="top">
                <td scope="row"><strong>FİRMA UNVAN </strong></td>
                <td><span class="style16">
                  <input name="Firma Unvan" type="text" class="style9" id="unvan" autocomplete="off">
                  *</span></td>
              </tr>
              <tr align="left" valign="top">
                <td scope="row"><strong>Şirket iseniz Ticari Sicil No / Şahıs iseniz T.C. Kimlik No</strong></td>
                <td><span class="style16">
                  <input name="Ticari Sicil No" type="text" class="style9" id="tcno" autocomplete="off">
                </span></td>
              </tr>
              <tr align="left" valign="top">
                <td scope="row"><strong>FİRMADAKİ GÖREVİNİZ </strong></td>
                <td><strong>FAALİYET ALANINIZ </strong></td>
              </tr>
              <tr align="left" valign="top">
                <td scope="row"><span class="style16">
                  <input name="Firmadaki Görevi" type="text" class="style9" id="Gorev" autocomplete="off">
                </span></td>
                <td><span class="style16">
                  <input name="Firmanın Faaliyeti" type="text" class="style9" id="faaliyet" autocomplete="off">
                  * </span></td>
              </tr>
              <tr align="left" valign="top">
                <td scope="row"><strong>ADINIZ SOYADINIZ </strong></td>
                <td><strong>E-MAİL ADRESİNİZ </strong></td>
              </tr>
              <tr align="left" valign="top">
                <td width="52%" scope="row"><span class="style16">
                  <input name="adi" type="text" class="style9" id="Adi" autocomplete="off">
                  *</span></td>
                <td width="48%"><span class="style16">
                  <input name="email" type="text" class="style9" id="email" autocomplete="off">
                  *</span></td>
              </tr>
              <tr align="left" valign="top">
                <td scope="row"><strong>TELEFON</strong></td>
                <td><strong>FAKS</strong></td>
              </tr>
              <tr align="left" valign="top">
                <td scope="row"><span class="style16">
                  <input name="Telefon" type="text" class="style9" id="telefon" autocomplete="off">
                  * </span></td>
                <td><span class="style16">
                  <input name="Faks" type="text" class="style9" id="faks" autocomplete="off">
                  * </span></td>
              </tr>
              <tr align="left" valign="top">
                <td scope="row"><strong>ŞEHİR</strong></td>
                <td><strong>ÜLKE</strong></td>
              </tr>
              <tr align="left" valign="top">
                <td scope="row"><span class="style16">
                  <input name="Şehir" type="text" class="style9" id="sehir" autocomplete="off">
                  * </span></td>
                <td><span class="style16">
                  <input name="Ülke" type="text" class="style9" id="pr_ulke" value="TURKİYE">
                  * </span></td>
              </tr>
              <tr align="left" valign="top">
                <td scope="row"><strong>VERGİ DAİRENİZ</strong></td>
                <td><strong>VERGİ NUMARANIZ</strong></td>
              </tr>
              <tr align="left" valign="top">
                <td scope="row"><span class="style16">
                  <input name="Vergi Dairesi" type="text" class="style9" id="vdaire" autocomplete="off">
                  * </span></td>
                <td><span class="style16">
                  <input name="Vergi Numarası" type="text" class="style9" id="vno" autocomplete="off">
                  * </span></td>
              </tr>
              <tr align="left" valign="top">
                <td colspan="2" scope="row"><strong> ADRESİNİZ</strong><br>
                  <textarea name="Teslimat Adresi" cols="63" rows="5" class="style19" id="adres"></textarea>                  
                  *</td>
              </tr>
              <tr align="left" valign="top">
                <td colspan="2" scope="row"><strong>ÖZEL MESAJ BIRAKMAK İSTERSENİZ</strong><br>
                    <textarea name="Özel Mesaj" cols="63" rows="5" class="style19" id="Özel Mesaj"></textarea></td>
              </tr>
              <tr align="left" valign="top">
                <td scope="row"><div align="right">
                    <input type="submit" class="style9" id="Submit" value="Formu Gönder  >>">
                </div></td>
                <td>&nbsp;</td>
              </tr>
              <tr align="left" valign="top">
                <td colspan="2" scope="row"><ul>
                    <li>(*) Lütfen bu işaretin olduğu alanları mutlaka doldurunuz. Sizinle kolay bir şekilde irtibat kurabilmemiz için bu gereklidir. </li>
                </ul></td>
              </tr>
            </table>
          </form>
        </div>
      </div></td>
    </tr>
  </table>
</center>
</BODY>
</HTML>