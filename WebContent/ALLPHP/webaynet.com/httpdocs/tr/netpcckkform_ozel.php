<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0044)https://www.webaynet.com/tr/npbankhform.html -->
<HTML><HEAD><TITLE><< KREDİ KARTI POS FORMU >></TITLE>
<META http-equiv=Page-Enter content=blendTrans(duration=.5)>
<META http-equiv=Content-Style-Type content=text/css>
<LINK href="style2.css" type=text/css rel=stylesheet>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1254">
<link href="https://www.webaynet.com/CSS/style2.css" rel="stylesheet" type="text/css" />
<link href="https://www.webaynet.com/CSS/layout.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://www.webaynet.com/highslide/highslide.js"></script>
<script type="text/javascript">    
    hs.graphicsDir = 'https://www.webaynet.com/highslide/graphics/';
    hs.outlineType = null;
</script>
<style type="text/css">
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

-->
</style>
<script>


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
</script>
<STYLE type=text/css>
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
.style31 {	color: #5F5F5F;
	font-weight: bold;
}
.style32 {color: #FF0000}
.style34 {font-family: Tahoma, Arial; font-size: 11px; color: #7B7067; }
.style35 {FONT-SIZE: 11px; COLOR: #7b7067; FONT-FAMILY: Tahoma, Arial; font-weight: bold; }
.style36 {
	font-size: 11px;
	font-weight: bold;
}
.style40 {	font-size: 20px;
	font-weight: bold;
	color: #FFFFFF;
}
.style41 {	color: #FFFFFF;
	font-size: 14px;
}
.style43 {color: #FFFF00}
.style44 {font-size: 18px}
</STYLE>
<SCRIPT language=JavaScript>
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

	if (FRM.cardisim.value == "") {
		alert("LÜTFEN KARTINIZIN ÜSTÜNDE YAZAN İSMİ GİRİNİZ.");
		FRM.cardisim.focus();
		return false;  
	}

	if (FRM.cardno.value == "") {
		alert("LÜTFEN KART NUMARANIZI GİRİNİZ.");
		FRM.cardno.focus();
		return false;  
	}

	if (FRM.ay.value == "") {
		alert("LÜTFEN KARTINIZIN SON KULLANMA TARİHİNDE Kİ AY HANESİNİ SEÇİNİZ.");
		FRM.ay.focus();
		return false;  

	}

	if (FRM.yil.value == "") {
		alert("LÜTFEN KARTINIZIN SON KULLANMA TARİHİNDE Kİ YIL HANESİNİ SEÇİNİZ.");
		FRM.yil.focus();
		return false;  
	}

	if (FRM.cv.value == "") {
		alert("LÜTFEN KARTINIZIN ARKASINDAKİ GÜVENLİK KODUNU YAZINIZ.(SON ÜÇ RAKAMDIR)");
		FRM.cv.focus();
		return false;  
	}
	
document.forms["FRM"].Submit.disabled = true;
return true;
}
</SCRIPT>
<SCRIPT language=JavaScript>

	   var BirimFiyat = 0.00;


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
		num = num.substring(0,num.length-(4*i+3))+','+
		num.substring(num.length-(4*i+3));
		return (((sign)?'':'-') + num + '.' + cents);
	  }

	   function DoToplam()
	   {
		  Adet     = FRM.ADET.value;
		  var _TP  = document.getElementById("GTOPLAM");
		  var _SRV = document.getElementById("SERVER");
		  var _GTOP  = document.getElementById("GENTOP");
		  var _ARA = document.getElementById("AT");
		  var _TOP = (BirimFiyat * Adet);
		  var _I   = 0;
		  if (Adet == 0) _I = 0;
		  if (Adet == 1) _I = 168.00;
		  if (Adet == 2) _I = 156.00;
		  if (Adet == 3) _I = 144.00;
		  if (Adet == 4) _I = 132.00;
		  if (Adet == 5) _I = 120.00;
  		  if (Adet == 6) _I = 108.00;
   		  if (Adet == 7) _I = 96.00;
		  if (Adet == 8) _I = 84.00;
		  if (Adet == 9) _I = 72.00;
		  if (Adet == 10) _I = 60.00;
		  if (Adet == 11) _I = 48.00;
		  if (Adet == 12) _I = 36.00;
		  if (Adet == 13) _I = 24.00;
		  if (Adet == 14) _I = 12.00;
		  if (Adet > 14 && Adet < 1000)  _I = 12.00;

//		  _I = Math.round((_TOP + _I) / 100);
		  _ARA.innerHTML = formatNumber(_TOP) + " YTL";
		  _SRV.innerHTML = formatNumber(_I) + " YTL";
		  _TP.innerHTML = formatNumber(_TOP + _I) + " YTL (KARGO VE KDV DAHİL)";
		  _GTOP.value = formatNumber(_TOP + _I);
	   }

	   function DoDD1Change()
	   {
		  var _BF = document.getElementById("BF");

		  if (_BF != null)
		  {
		  BirimFiyat = 12.00;
		  //if (FRM.DD1.value == "2") BirimFiyat = 15.00;
		  _BF.innerHTML = BirimFiyat + " YTL (KDV DAHİL)";
		  DoToplam();
		  }
	   }
	</SCRIPT>

<META content="MSHTML 6.00.2900.3086" name=GENERATOR></HEAD>
<BODY bottomMargin=0 bgColor=#ffffff leftMargin=0 topMargin=0 
onload=DoDD1Change() rightMargin=0 MARGINHEIGHT="0" MARGINWIDTH="0">
<CENTER>
<TABLE cellSpacing=0 cellPadding=0 width=649 border=0>
  <TBODY>
    <TR>
      <TD><div align="center"><img src="images/STEP1.jpg" width="413" height="105"></div></TD>
    </TR>
    <TR>
      <TD><div align="center"><span class="style35">BU SAYFADA, SATIN ALACAĞINIZ ADETİ BELİRLEYEREK <br>
        ÖDEMENİZİ GERÇEKLEŞTİRİNİZ. <br>
        LİSANS VE FATURANIZIN SİZE ULAŞTIRILABİLMESİ İÇİN GEREKEN E-POSTA, ADRES VE FATURA BİLGİLERİ GİBİ BİLGİLER ÖDEME ONAYLANDIKTAN SONRA<br>
        BİR SONRAKİ SAYFADA SİZDEN İSTENECEKTİR.</span></div></TD>
    </TR>
  
  <TR>
    <TD><div align="center"><FORM id=FRM name=FRM 
      action=posttib_ozel.asp method=post onSubmit="return form_control_ex();">
      <TABLE cellSpacing=2 cellPadding=2 width=100% border=0>
        <TBODY>
        
        
        <TR vAlign=top align=left>
          <TD width="186%" colSpan=2 vAlign=center bgColor=#e5e5e5 scope=row>
            <DIV align=center>
            <DIV id=Panel1 style="WIDTH: 100%">
              <table style="LEFT: 11px; TOP: 448px" bordercolor="#999999"
                    cellspacing="0" cellpadding="3"
                    width="100%" align="center"
                    bgcolor="#CCCCCC" border="1">
                <tbody>
                  <tr>
                    <td width="309" class="style9"><p align="right">&nbsp;</p>
                        <p align="right"><strong>SATIN ALINAN ÜRÜN</strong></p></td>
                    <td width="314" class="style32"><p><img src="images/netdadicclogo.png" width="232" height="51"></p></td>
                  </tr>
                  <tr>
                    <td class="style9"><p align="right"><strong> BİRİM FİYATI</strong></p></td>
                    <td><div id="BF"
                            style="FONT-WEIGHT: bold; FONT-SIZE: 12px; COLOR: blue">0.00 YTL </div></td>
                  </tr>
                  <tr>
                    <td valign="middle"><p align="right"><strong><span class="style32">SERVER HARİÇ PC SAYISI </span><br>
          (Her Pc için Ayrı Lisans Alınmalıdır. En Az 15 Client Alınabilir.) </strong></p></td>
                    <td><input name="ADET" id="ADET"  onKeyUp="DoToplam()"  type="text" value="14" size="3" maxlength="3" style="text-align:center; FONT-WEIGHT: bold; COLOR: black" autocomplete="off">
                        <span class="style31"><br>
        KONTROL ETMEK İSTEDİĞİNİZ PC SAYISI</span></td>
                  </tr>
                  <tr>
                    <td><p align="right" class="style9"><strong>ARA TOPLAM</strong></p></td>
                    <td><div id="AT"
                            style="FONT-WEIGHT: bold; FONT-SIZE: 16px; COLOR: green">0.00 YTL </div></td>
                  </tr>
                  <tr>
                    <td><p align="right" class="style9"><strong>NetPATRON SERVER ÜCRETİ</strong></p></td>
                    <td><div id="SERVER"
                            style="FONT-WEIGHT: bold; FONT-SIZE: 16px; COLOR: red">0.00 YTL </div></td>
                  </tr>
                  <tr>
                    <td style="COLOR: white" bgcolor="#990000"><p align="right" class="style36">KARTINIZDAN ÇEKİLECEK TUTAR</p></td>
                    <td bgcolor="#990000"><div id="GTOPLAM" name="Genel Toplam"
                            style="FONT-WEIGHT: bold; FONT-SIZE: 15px; COLOR: white">0.00 YTL </div>
                        <input name="fiyat" type="hidden" id="GENTOP"></td>
                  </tr>
                </tbody>
              </table>
            </DIV></DIV></TD></TR>
        
        <TR vAlign=top align=left>
          <TD colspan="2" scope=row>&nbsp;</TD>
        </TR>
        <TR vAlign=top align=left>
          <TD colspan="2" scope=row><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="30" colspan="3" bgcolor="#990000"><div align="center"><span class="style25"><br>
                    KREDİ KARTI BİLGİLERİ</span></div></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td width="46%"><div align="right" class="style35">KART ÜZERİNDEKİ İSİM </div></td>
                  <td width="4%"><div align="center"><strong>:</strong></div></td>
                  <td width="50%"><input name="cardisim" type="text" class="style34" id="cardisim" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" autocomplete="off"></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>

                  <td><div align="right" class="style9"><strong>KART NUMARASI </strong></div></td>
                  <td><div align="center"><strong>:</strong></div></td>
                  <td><input name="cardno" type="text" class="style34" id="cardno" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: center" maxlength="16" autocomplete="off"></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><div align="right" class="style35">SON KULLANMA TARİHİ </div></td>
                  <td><div align="center"><strong>:</strong></div></td>
                  <td><select name="ay" class="style35">
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
                    <strong>/</strong>
                    <select name="yil" class="style35">
                      <option value="07" >2007</option>
                      <option value="08" >2008</option>
                      <option value="09" >2009</option>
                      <option value="10" >2010</option>
                      <option value="11" >2011</option>
                      <option value="12">2012</option>
                      <option value="13">2013</option>
                      <option value="14">2014</option>
                    </select></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><div align="right" class="style35">(CVV2 veya CVC2) GÜVENLİK NO </div></td>
                  <td><div align="center"><strong>:</strong></div></td>
                  <td><input name="cv" type="text" class="style24" id="cv" size="2" maxlength="4" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: center" autocomplete="off"/><a id="thumb1" href="images/CVV2.png" class="highslide" onClick="return hs.expand(this)">
	<img src="images/16help.png" alt="CVV2 KODU NEDİR ?" width="16" height="16" border="0" align="absmiddle"
		title="BÜYÜK HALİ İÇİN TIKLAYINIZ" /></a></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td><input class=style35 id=Submit type=submit value="Ödemeyi Yap  >>"></td>
                </tr>
                <tr>
                  <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3"><ul>
                    <li></li>
                    </ul>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="2%">&nbsp;</td>
                        <td width="97%"><ul>
                          <li>(*) Güvenlik nedeni ile Kredi Kartı bilgileri hiç bir şekilde sistemimizde tutulmamaktadır. Direkt olarak banka pos sistemine bağlı olarak çalışmaktadır. </li>
                          <li>Şu an da yapmakta olduğunuz işlem 128 Bit SSL şifreleme yöntemi ile yapılmakta olup, Dünya'nın en güvenli ödeme sistemidir.</li>
                          <li>Güvenli bir şekilde kart bilgilerinizi girerek alışverişinizi tamamlayabilirsiniz.</li>
                        </ul>
                        </td>
                        <td width="1%">&nbsp;</td>
                      </tr>
                    </table></td>
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
