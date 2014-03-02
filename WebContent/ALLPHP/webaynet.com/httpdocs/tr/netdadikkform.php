<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE><< BANKA HAVALE FORMU >></TITLE>
<META http-equiv=Page-Enter content=blendTrans(duration=.5)>
<META http-equiv=Content-Style-Type content=text/css>
<LINK href="style2.css" type=text/css rel=stylesheet>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1254">
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
.style23 {
	COLOR: #ff0000
}
.style25 {	color: #FFFFFF;
	font-size: 14px;
	font-weight: bold;
}
.style26 {FONT-SIZE: x-small; COLOR: #000000; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.style34 {font-family: Tahoma, Arial; font-size: 11px; color: #7B7067; }
.style27 {FONT-SIZE: 11px; COLOR: #7b7067; FONT-FAMILY: Tahoma, Arial; font-weight: bold; }
.style38 {
	font-weight: bold;
	font-size: 11px;
}
.style39 {color: #000000}
</STYLE>
<SCRIPT language=JavaScript>
function MM_openBrWindow(theURL,winName,features) { //v2.0
window.open(theURL,winName,features);
}

function MM_openBrWindowEx(theURL,winName,features) { //v2.0 
	var nUrl;
	nUrl = nUrl + "&cardisim=" + document.forms["FRM"].cardisim.value;
	nUrl = nUrl + "&cardno=" + document.forms["FRM"].cardno.value;
	window.open(nUrl,winName,features); 

} 

function form_control_ex() {

	if (FRM.cardisim.value == "") {
		alert("Ltfen Kartnzn stnde Yazan smi giriniz.");
		FRM.cardisim.focus();
		return false;  
	}

	if (FRM.cardno.value == "") {
		alert("Ltfen Kart Numaranz Yaznz.");
		FRM.cardno.focus();
		return false;  
	}

	if (FRM.ay.value == "") {
		alert("Ltfen Kartnzn son kullanma Tarihi Blmndeki Ay Hanesini yaznz.");
		FRM.ay.focus();
		return false;  

	}

	if (FRM.yil.value == "") {
		alert("Ltfen Kartnzn son kullanma Tarihi Blmndeki Yl Hanesini yaznz.");
		FRM.yil.focus();
		return false;  
	}

	if (FRM.cv.value == "") {
		alert("Ltfen Kartnzn arkasndaki Gvenlik Kodunu Yaznz. (Son  Rakamdr)");
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
		  var _KRG = document.getElementById("KARGO");
		  var _GTOP  = document.getElementById("GENTOP");
		  var _ARA = document.getElementById("AT");
		  var _TOP = (BirimFiyat * Adet);
		  var _I   = 0;
		  if (Adet == 0) _I = 0;
		  if (Adet == 1) _I = 0;
		  if (Adet == 2) _I = 0;
		  if (Adet == 3) _I = 0;
		  if (Adet == 4) _I = 0;
		  if (Adet == 5) _I = 0;
		  if (Adet > 5 && Adet < 11)   _I = 0;
		  if (Adet > 10 && Adet < 21)  _I = 0;
		  if (Adet > 20 && Adet < 51)  _I = 0;
		  if (Adet > 50 && Adet < 101) _I = 0;
		  if (Adet > 100 && Adet < 201) _I = 0;
		  if (Adet > 200 && Adet < 501) _I = 0;
//		  _I = Math.round((_TOP + _I) / 100);
		  _ARA.innerHTML = formatNumber(_TOP) + " YTL";
		  _KRG.innerHTML = formatNumber(_I) + " YTL";
		  _TP.innerHTML = formatNumber(_TOP + _I) + " YTL (KDV DAHL)";
		  _GTOP.value = formatNumber(_TOP + _I);
	   }

	   function DoDD1Change()
	   {
		  var _BF = document.getElementById("BF");

		  if (_BF != null)
		  {
		  BirimFiyat = 49.00;
		 // if (FRM.DD1.value == "2") BirimFiyat = 49.00;
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
    <TD><div align="center"><img src="images/STEP1.jpg" width="413" height="105"></div></TD></TR>
  <TR>
    <TD><div align="center"><span class="style27">BU SAYFADA, SATIN ALACAĞINIZ ADETİ BELİRLEYEREK <br>
ÖDEMENİZİ GERÇEKLEŞTİRİNİZ. <br>
LİSANS VE FATURANIZIN SİZE ULAŞTIRILABİLMESİ İÇİN GEREKEN E-POSTA, ADRES VE FATURA BİLGİLERİ GİBİ BİLGİLER ÖDEME ONAYLANDIKTAN SONRA<br>
BİR SONRAKİ SAYFADA SİZDEN İSTENECEKTİR.</span></div></TD>
  </TR>
  <TR>
    <TD><DIV align=center>
      <DIV align=center>
        <FORM id=FRM name=FRM 
      action=post.asp method=post onSubmit="return form_control_ex();">
          <TABLE cellSpacing=2 cellPadding=2 width=100% border=0>
            <TBODY>
              <TR vAlign=top align=left>
                <TD width="186%" colSpan=2 vAlign=center bgColor=#e5e5e5 scope=row><DIV align=center>
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
                            <TD><P align=right><STRONG>BİRİM FİYATI</STRONG></P></TD>
                            <TD><DIV id=BF 
                  style="FONT-WEIGHT: bold; FONT-SIZE: 12px; COLOR: blue">0.00 
                              YTL </DIV></TD>
                          </TR>
                          <TR>
                            <TD vAlign=center><P align=right><STRONG><SPAN class=style23>Satn Almak 
                              İstediğiniz Adet</SPAN> <br>
                              (Her Pc için Ayrı Lisans Alınmalıdır.) </STRONG></P></TD>
                            <TD><INPUT id=ADET onkeyup=DoToplam() 
                  style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: center" 
                  maxLength=3 size=2 value=1 name=ADET autocomplete="off"></TD>
                          </TR>
                          <TR>
                            <TD><P align=right><STRONG>ARA TOPLAM</STRONG></P></TD>
                            <TD><DIV id=AT 
                  style="FONT-WEIGHT: bold; FONT-SIZE: 16px; COLOR: green">0.00 
                              YTL </DIV></TD>
                          </TR>
                          <TR>
                            <TD><P align=right><STRONG>KARGO ÜCRETİ</STRONG></P></TD>
                            <TD><DIV id=KARGO 
                  style="FONT-WEIGHT: bold; FONT-SIZE: 9px; COLOR: red"><span class="style39">0.00 
                              YTL</span></DIV></TD>
                          </TR>
                          <TR>
                            <TD colspan="2" bgColor=#CCCCCC style="COLOR: white"><div align="center"><span style="FONT-WEIGHT: bold; FONT-SIZE: 9px; COLOR: red">(KUTULU ÜRÜN SATIŞLARIMIZ KALDIRILMIŞTIR. ÜRÜN AKTİVASYON KODU SİZE E-MAİL İLE GÖNDERİLECEKTİR. PROGRAMI İSE BU SİTEDEN İNDİREBİLİRSİNİZ. FATURANIZ  POSTA İLE ADRESİNİZE GÖNDERİLECEKTİR.)</span></div></TD>
                            </TR>
                          <TR>
                            <TD style="COLOR: white" bgColor=#990000><P align=right><STRONG>KARTINIZDAN ÇEKİLECEK TUTAR</STRONG></P></TD>
                            <TD bgColor=#990000><DIV id=GTOPLAM 
                  style="FONT-WEIGHT: bold; FONT-SIZE: 15px; COLOR: white" 
                  name="Genel Toplam">0.00 YTL </DIV>
                                <input name="fiyat" type="hidden" id="GENTOP"></TD>
                          </TR>
                        </TBODY>
                      </TABLE>
                    </DIV>
                </DIV></TD>
              </TR>
              <TR vAlign=top align=left>
                <TD colspan="2" scope=row>&nbsp;</TD>
              </TR>
              <TR vAlign=top align=left>
                <TD colspan="2" align="left" valign="middle" scope=row><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="30" colspan="3" bgcolor="#990000"><div align="center"><span class="style25"><br>
                              KREDİ KARTI BİLGİLERİNİZ</span></div></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td width="46%"><div align="right" class="style27">KART ÜZERİNDEKİ İSİM </div></td>
                            <td width="4%"><div align="center"><strong>:</strong></div></td>
                            <td width="50%"><input name="cardisim" type="text" class="style34" id="cardisim" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" autocomplete="off"></td>
                          </tr>
                          <tr>
                            <td><div align="right" class="style9"><strong>KART NUMARASI </strong></div></td>
                            <td><div align="center"><strong>:</strong></div></td>
                            <td><input name="cardno" type="text" class="style34" id="cardno" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: center" maxlength="16" autocomplete="off"></td>
                          </tr>
                          <tr>
                            <td><div align="right" class="style27">SON KULLANMA TARİHİ </div></td>
                            <td><div align="center"><strong>:</strong></div></td>
                            <td><select name="ay" class="style27">
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
                                <select name="yil" class="style27">
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
                            <td><div align="right" class="style27">(CVV2 veya CVC2) GÜVENLİK NO<br>
                              (Kartınızın Arkasındaki Son üç Hanedir)
</div></td>
                            <td><div align="center"><strong>:</strong></div></td>
                            <td><input name="cv" type="text" class="style34" id="cv" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: center" size="3" maxlength="4" autocomplete="off"></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><input class=style27 id=Submit type=submit value="Ödemeyi Yap  &gt;&gt;"></td>
                          </tr>
                          <tr>
                            <td colspan="3"><ul>
                                <li>(*) Güvenlik nedeni ile Kredi Kart bilgileri hçi bir şekilde sistemimizde tutulmamaktadır. Direkt olarak banka pos sistemine bağlı olarak çalmaktadr. </li>
                              <li>Şu an da yapmakta olduğunuz işlem 128 Bit SSL şifreleme yöntemi ile yapılmakta olup, Dünya'nn en güvenli ödeme sistemidir.</li>
                              <li>Güvenli bir ekilde kart bilgilerinizi girerek alışverişinizi tamamlayabilirsiniz.</li>
                            </ul></td>
                          </tr>
                          
                      </table></td>
                    </tr>
                </table></TD>
              </TR>
            </TBODY>
          </TABLE>
        </FORM>
      </DIV>
    </DIV></TD>
  </TR>
  </TBODY></TABLE>
</CENTER></BODY></HTML>
