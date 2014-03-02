<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0044)https://www.webaynet.com/tr/npbankhform.html -->
<HTML><HEAD><TITLE><< KREDİ KARTI POS FORMU >></TITLE>
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
.style16 {
	COLOR: #353535
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
.style33 {color: #000000; font-size: x-small; font-weight: bold; }
.style34 {font-family: Tahoma, Arial; font-size: 11px; color: #7B7067; }
.style35 {FONT-SIZE: 11px; COLOR: #7b7067; FONT-FAMILY: Tahoma, Arial; font-weight: bold; }
.style36 {
	font-size: 11px;
	font-weight: bold;
}
.style26 {FONT-SIZE: x-small; COLOR: #000000; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
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
		num = num.substring(0,num.length-(4*i+3))+
		num.substring(num.length-(4*i+3));
		return (((sign)?'':'-') + num + '.' + cents);
	  }

	   function DoToplam()
	   {
		  Adet     = FRM.ADET.value;
		  var _TP  = document.getElementById("GTOPLAM");
		  var _SRV = document.getElementById("SERVER");
		  var _GTOP  = document.getElementById("GENTOP");
		  var _TOP = (BirimFiyat * Adet);
		  var _I   = 0;
		  if (Adet == 0) _I = 0;
		  if (Adet == 1) _I = 0;
		  if (Adet == 2) _I = 8;
		  if (Adet == 3) _I = 12;
		  if (Adet == 4) _I = 15;
		  if (Adet == 5) _I = 22;
		  if (Adet > 5 && Adet < 1000)   _I = 40;

//		  _I = Math.round((_TOP + _I) / 100);
//		  _ARA.innerHTML = formatNumber(_TOP) + " USD";
//		  _SRV.innerHTML = formatNumber(_I) + " USD";
		  _TP.innerHTML = formatNumber(_TOP - _I) + " USD";
		  _GTOP.value = formatNumber(_TOP - _I);
	   }

	   function DoDD1Change()
	   {
		  var _BF = document.getElementById("BF");

		  if (_BF != null)
		  {
		  BirimFiyat = 49;
		  //if (FRM.DD1.value == "2") BirimFiyat = 26.00;
		  _BF.innerHTML = BirimFiyat + " USD";
		  DoToplam();
		  }
	   }
	</SCRIPT>

<META content="MSHTML 6.00.2900.3086" name=GENERATOR></HEAD>
<BODY bottomMargin=0 bgColor=#ffffff leftMargin=0 topMargin=0 onload=DoDD1Change() rightMargin=0 MARGINHEIGHT="0" MARGINWIDTH="0">
<CENTER>
<TABLE cellSpacing=0 cellPadding=0 width=649 border=0>
  <TBODY>
    

  <TR>
    <TD><div align="center"><FORM id=FRM name=FRM action="https://www.moneybookers.com/app/payment.pl" method="post" onSubmit="return form_control_ex();" target="_self">
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
                    <td width="314" class="style32"><p><span class="style26"><img src="images/netdadilogo.png" alt="" width="239" height="53"></span></p>                      </td>
                  </tr>
                  <tr>
                    <td class="style9"><p align="right"><strong> BİRİM FİYATI</strong></p></td>
                    <td><div id="BF"
                            style="FONT-WEIGHT: bold; FONT-SIZE: 12px; COLOR: blue">0.00 USD </div></td>
                  </tr>
                  <tr>
                    <td valign="middle"><p align="right"><strong><span class="style32">Satın Almak İstediğiniz Adet</span></strong></p></td>
                    <td><input name="ADET" id="ADET"  onKeyUp="DoToplam()"  type="text" value="1" size="3" maxlength="3" style="text-align:center; FONT-WEIGHT: bold; COLOR: black" autocomplete="off"></td>
                  </tr>
                  
                  <tr>
                    <td style="COLOR: white" bgcolor="#990000"><p align="right" class="style36">ÖDEME YAPACAĞINIZ NET  TUTAR</p></td>
                    <td bgcolor="#990000"><div id="GTOPLAM" name="Genel Toplam"
                            style="FONT-WEIGHT: bold; FONT-SIZE: 15px; COLOR: white">0.00 YTL </div>
                      <input name="amount" type="hidden" id="GENTOP"></td>
                  </tr>
                </tbody>
              </table>
            </DIV></DIV></TD></TR>
        
        <TR vAlign=top align=left>
          <TD colspan="2" scope=row><input type="hidden" name="pay_to_email" value="bulent@webaynet.com">
            <input type="hidden" name="status_url" value="bulent@webaynet.com">
            <input type="hidden" name="language" value="EN">
            <input type="hidden" name="amount" value="GENTOP">
            <input type="hidden" name="currency" value="USD">
            <input type="hidden" name="detail1_description" value="WEBAYNET SOFTWARE">
            <input type="hidden" name="detail1_text" value="NETDADI PC CONTROL AND CONTENT FILTER SOFTWARE"></TD>
        </TR>
        <TR vAlign=top align=left>
          <TD colspan="2" scope=row><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                
                <tr>
                  <td width="46%">&nbsp;</td>
                  <td width="4%">&nbsp;</td>
                  <td width="50%"><input class=style35 id=Submit type=submit value="Submit"></td>
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
