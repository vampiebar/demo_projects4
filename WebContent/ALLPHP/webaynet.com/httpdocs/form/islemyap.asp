<%										   
'***********************************************'
' Script    : Bilgi Edinme Sistemi V.1.0  		'
' Tarih     : 05 Ocak 2005, Saat : 17.44  		'
' Oluşturma : Talha Çopur				  		'
' E-Mail    : copurellezi@hotmail.com     		'
' Web		: http://www.talha.org		  		'
' ---------------------------------------------	'
' Belki de kodların tamamına yakını		  		'
' AtaBerK Ileti Script v2.0 den editlenmiştir 	'
' Bu noktada bu scripti hazırlamama		  		'
' vesile olan, Mehmet Ayhan Taçyıldız'a   		'
' şükranlarımı sunuyorum.				  		'
' ---------------------------------------------	'
' Ayrıca ; www.aspindir.com ' a da bu vesile ile'
' en derin teşekkürlerimi iletiyorum. Emeği		'
' geçenleri kutluyor, tebrik ediyorum. 			'
'***********************************************'
%>
<title><> Bilgi Edinme | Mesaj Gönderme İşlemi <></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<meta http-equiv="Content-Language" content="tr">
<link href="sekil.css" rel="stylesheet" type="text/css">

<% Set BilgiEdinmeSistem=Server.CreateObject("Adodb.Connection")
BilgiEdinmeSistem.Open "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & Server.Mappath("../data/destek.mdb")

SeT Kayit=Server.CreateObject("ADODB.RecordSeT")
sql="select * from kayitlar"
Kayit.Open sql,BilgiEdinmeSistem,1,3

Dim isim
Dim tel
Dim email
Dim ceptel
Dim faks
Dim kultur
Dim geridon
Dim sehir
Dim ulke
Dim tarih
Dim saat
Dim adres
Dim ileti

isim=Request.Form("isim")
tel=Request.Form("tel")
email=Request.Form("email")
ceptel=Request.Form("ceptel")
faks=Request.Form("faks")
kultur=Request.Form("kultur")
geridon=Request.Form("geridon")
sehir=Request.Form("sehir")
ulke=Request.Form("ulke")
tarih=Request.Form("tarih")
saat=Request.Form("saat")
adres=Request.Form("adres")
ileti=Request.Form("ileti")

if kultur="" then
Response.Write "<center>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/BilgiEdinme001.jpg ></p>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/eksikbilgi.jpg ></p>"
Response.Write "<p align=center><font size=2 color=black face=Arial><b>Hata: <font size=2 color=red face=Arial>Kullanıcı Tipi "
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>:: LÜTFEN KULLANICI TİPİNİ BOŞ BIRAKMAYINIZ ... ::</p>"
Response.Write "<p align=center><embed src=Resimler/yonlen.swf width=170 height=20> <meta http-equiv=refresh content=5;url=javascript:history.back()></p>"
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>Lütfen Bekleyiniz...</p>"
Response.End
End if

if isim="" then
Response.Write "<center>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/BilgiEdinme001.jpg ></p>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/eksikbilgi.jpg ></p>"
Response.Write "<p align=center><font size=2 color=black face=Arial><b>Hata: <font size=2 color=red face=Arial>Adınız ve Soyadınız "
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>:: LÜTFEN ADINIZI VE SOYADINIZI BOŞ BIRAKMAYINIZ ... ::</p>"
Response.Write "<p align=center><embed src=Resimler/yonlen.swf width=170 height=20> <meta http-equiv=refresh content=5;url=javascript:history.back()></p>"
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>Lütfen Bekleyiniz...</p>"
Response.End
End if


if tel="" then
Response.Write "<center>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/BilgiEdinme001.jpg ></p>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/eksikbilgi.jpg ></p>"
Response.Write "<p align=center><font size=2 color=black face=Arial><b>Hata: <font size=2 color=red face=Arial>Telefon "
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>:: LÜTFEN TELEFON KISMINI BOŞ BIRAKMAYINIZ ... ::</p>"
Response.Write "<p align=center><embed src=Resimler/yonlen.swf width=170 height=20> <meta http-equiv=refresh content=5;url=javascript:history.back()></p>"
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>Lütfen Bekleyiniz...</p>"
Response.End
End if


if email="" then
Response.Write "<center>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/BilgiEdinme001.jpg ></p>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/eksikbilgi.jpg ></p>"
Response.Write "<p align=center><font size=2 color=black face=Arial><b>Hata: <font size=2 color=red face=Arial>E-Mail "
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>:: LÜTFEN E-MAIL ADRESİ KISMINI BOŞ BIRAKMAYINIZ ... ::</p>"
Response.Write "<p align=center><embed src=Resimler/yonlen.swf width=170 height=20> <meta http-equiv=refresh content=5;url=javascript:history.back()></p>"
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>Lütfen Bekleyiniz...</p>"
Response.End
End if

if sehir="" then
Response.Write "<center>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/BilgiEdinme001.jpg ></p>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/eksikbilgi.jpg ></p>"
Response.Write "<p align=center><font size=2 color=black face=Arial><b>Hata: <font size=2 color=red face=Arial>Şehir "
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>:: LÜTFEN BULUNDUĞUNUZ ŞEHRİ BOŞ BIRAKMAYINIZ ... ::</p>"
Response.Write "<p align=center><embed src=Resimler/yonlen.swf width=170 height=20> <meta http-equiv=refresh content=5;url=javascript:history.back()></p>"
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>Lütfen Bekleyiniz...</p>"
Response.End
End if

if ulke="" then
Response.Write "<center>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/BilgiEdinme001.jpg ></p>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/eksikbilgi.jpg ></p>"
Response.Write "<p align=center><font size=2 color=black face=Arial><b>Hata: <font size=2 color=red face=Arial>Ülke "
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>:: LÜTFEN ÜLKE KISMINI BOŞ BIRAKMAYINIZ ... ::</p>"
Response.Write "<p align=center><embed src=Resimler/yonlen.swf width=170 height=20> <meta http-equiv=refresh content=5;url=javascript:history.back()></p>"
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>Lütfen Bekleyiniz...</p>"
Response.End
End if




if ileti="" then
Response.Write "<center>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/BilgiEdinme001.jpg ></p>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/eksikbilgi.jpg ></p>"
Response.Write "<p align=center><font size=2 color=black face=Arial><b>Hata: <font size=2 color=red face=Arial>Mesajınız "
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>:: LÜTFEN MESAJ KISMINI BOŞ BIRAKMAYINIZ ... ::</p>"
Response.Write "<p align=center><embed src=Resimler/yonlen.swf width=170 height=20> <meta http-equiv=refresh content=5;url=javascript:history.back()></p>"
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>Lütfen Bekleyiniz...</p>"
Response.End
End if

if geridon="" then
Response.Write "<center>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/BilgiEdinme001.jpg ></p>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/eksikbilgi.jpg ></p>"
Response.Write "<p align=center><font size=2 color=black face=Arial><b>Hata: <font size=2 color=red face=Arial>Size Nasıl Bilgi Verelim ! "
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>:: LÜTFEN SİZE NASIL BİLGİ VERELİM KISMINI BOŞ BIRAKMAYINIZ ... ::</p>"
Response.Write "<p align=center><embed src=Resimler/yonlen.swf width=170 height=20> <meta http-equiv=refresh content=5;url=javascript:history.back()></p>"
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>Lütfen Bekleyiniz...</p>"
Response.End
End if

Kayit.AddNew
Kayit("isim")=isim
Kayit("tel")=tel
Kayit("email")=email
Kayit("ceptel")=ceptel
Kayit("faks")=faks
Kayit("kultur")=kultur
Kayit("geridon")=geridon
Kayit("sehir")=sehir
Kayit("ulke")=ulke
Kayit("tarih")=tarih
Kayit("saat")=saat
Kayit("adres")=adres
Kayit("ileti")=ileti
Kayit.UPDATE
%>

    
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style><table width="446" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center"><img src="resimler/BilgiEdinme001.jpg" width="429" height="73" /></div></td>
  </tr>
  <tr>
    <td><table width="446" height="373" border="0" cellpadding="0" cellspacing="0" background="resimler/formback2.jpg">
      <tr>
        <td valign="top"><table width="446" border="0" cellspacing="0" cellpadding="0">
          
          <tr>
            <td width="21">&nbsp;</td>
            <td width="403"><p align="center"><br />
              <img src="resimler/BilgiEdinme002.jpg" width="327" height="75" /><br />
                  <br />
                  <b>Sayın :</b>
                  <%

MuracaatEdenKisiyeMerhabaDe=Request.Form("isim")
Response.Write MuracaatEdenKisiyeMerhabaDe

%>
            </p>
              <p align="center">Mesajın Alınma Tarihi  :
                <%

MuracaatEdenKisiyeMerhabaDe=Request.Form("tarih")
Response.Write MuracaatEdenKisiyeMerhabaDe

%>
                Saati :
  <%

MuracaatEdenKisiyeMerhabaDe=Request.Form("saat")
Response.Write MuracaatEdenKisiyeMerhabaDe

%>
  <br />
  <br />
                NetDADI Destek Formunu kullanarak göndermiş olduğunuz mesaj ve <br />
                bununla ilgili olarak talep etmiş olduğunuz bilgi / formlar kayda alınmıştır.<br />
  <br />
                Kısa bir süre içerisinde mesajınız değerlendirmeye alınarak<br />
                sizinle
  <%

MuracaatEdenKisiyeMerhabaDe=Request.Form("geridon")
Response.Write MuracaatEdenKisiyeMerhabaDe

%>
                irtibata geçilecektir. <br />
  <br />
                İlginiz için teşekkür ederiz. <br />
                <br />
  <a href="../TR/index.html" target="_parent">Ana Sayfaya Dön</a></p></td>
            <td width="22">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
