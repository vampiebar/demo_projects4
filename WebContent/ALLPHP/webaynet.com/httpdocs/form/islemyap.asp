<%										   
'***********************************************'
' Script    : Bilgi Edinme Sistemi V.1.0  		'
' Tarih     : 05 Ocak 2005, Saat : 17.44  		'
' Olu�turma : Talha �opur				  		'
' E-Mail    : copurellezi@hotmail.com     		'
' Web		: http://www.talha.org		  		'
' ---------------------------------------------	'
' Belki de kodlar�n tamam�na yak�n�		  		'
' AtaBerK Ileti Script v2.0 den editlenmi�tir 	'
' Bu noktada bu scripti haz�rlamama		  		'
' vesile olan, Mehmet Ayhan Ta�y�ld�z'a   		'
' ��kranlar�m� sunuyorum.				  		'
' ---------------------------------------------	'
' Ayr�ca ; www.aspindir.com ' a da bu vesile ile'
' en derin te�ekk�rlerimi iletiyorum. Eme�i		'
' ge�enleri kutluyor, tebrik ediyorum. 			'
'***********************************************'
%>
<title><> Bilgi Edinme | Mesaj G�nderme ��lemi <></title>
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
Response.Write "<p align=center><font size=2 color=black face=Arial><b>Hata: <font size=2 color=red face=Arial>Kullan�c� Tipi "
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>:: L�TFEN KULLANICI T�P�N� BO� BIRAKMAYINIZ ... ::</p>"
Response.Write "<p align=center><embed src=Resimler/yonlen.swf width=170 height=20> <meta http-equiv=refresh content=5;url=javascript:history.back()></p>"
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>L�tfen Bekleyiniz...</p>"
Response.End
End if

if isim="" then
Response.Write "<center>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/BilgiEdinme001.jpg ></p>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/eksikbilgi.jpg ></p>"
Response.Write "<p align=center><font size=2 color=black face=Arial><b>Hata: <font size=2 color=red face=Arial>Ad�n�z ve Soyad�n�z "
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>:: L�TFEN ADINIZI VE SOYADINIZI BO� BIRAKMAYINIZ ... ::</p>"
Response.Write "<p align=center><embed src=Resimler/yonlen.swf width=170 height=20> <meta http-equiv=refresh content=5;url=javascript:history.back()></p>"
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>L�tfen Bekleyiniz...</p>"
Response.End
End if


if tel="" then
Response.Write "<center>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/BilgiEdinme001.jpg ></p>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/eksikbilgi.jpg ></p>"
Response.Write "<p align=center><font size=2 color=black face=Arial><b>Hata: <font size=2 color=red face=Arial>Telefon "
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>:: L�TFEN TELEFON KISMINI BO� BIRAKMAYINIZ ... ::</p>"
Response.Write "<p align=center><embed src=Resimler/yonlen.swf width=170 height=20> <meta http-equiv=refresh content=5;url=javascript:history.back()></p>"
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>L�tfen Bekleyiniz...</p>"
Response.End
End if


if email="" then
Response.Write "<center>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/BilgiEdinme001.jpg ></p>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/eksikbilgi.jpg ></p>"
Response.Write "<p align=center><font size=2 color=black face=Arial><b>Hata: <font size=2 color=red face=Arial>E-Mail "
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>:: L�TFEN E-MAIL ADRES� KISMINI BO� BIRAKMAYINIZ ... ::</p>"
Response.Write "<p align=center><embed src=Resimler/yonlen.swf width=170 height=20> <meta http-equiv=refresh content=5;url=javascript:history.back()></p>"
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>L�tfen Bekleyiniz...</p>"
Response.End
End if

if sehir="" then
Response.Write "<center>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/BilgiEdinme001.jpg ></p>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/eksikbilgi.jpg ></p>"
Response.Write "<p align=center><font size=2 color=black face=Arial><b>Hata: <font size=2 color=red face=Arial>�ehir "
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>:: L�TFEN BULUNDU�UNUZ �EHR� BO� BIRAKMAYINIZ ... ::</p>"
Response.Write "<p align=center><embed src=Resimler/yonlen.swf width=170 height=20> <meta http-equiv=refresh content=5;url=javascript:history.back()></p>"
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>L�tfen Bekleyiniz...</p>"
Response.End
End if

if ulke="" then
Response.Write "<center>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/BilgiEdinme001.jpg ></p>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/eksikbilgi.jpg ></p>"
Response.Write "<p align=center><font size=2 color=black face=Arial><b>Hata: <font size=2 color=red face=Arial>�lke "
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>:: L�TFEN �LKE KISMINI BO� BIRAKMAYINIZ ... ::</p>"
Response.Write "<p align=center><embed src=Resimler/yonlen.swf width=170 height=20> <meta http-equiv=refresh content=5;url=javascript:history.back()></p>"
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>L�tfen Bekleyiniz...</p>"
Response.End
End if




if ileti="" then
Response.Write "<center>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/BilgiEdinme001.jpg ></p>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/eksikbilgi.jpg ></p>"
Response.Write "<p align=center><font size=2 color=black face=Arial><b>Hata: <font size=2 color=red face=Arial>Mesaj�n�z "
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>:: L�TFEN MESAJ KISMINI BO� BIRAKMAYINIZ ... ::</p>"
Response.Write "<p align=center><embed src=Resimler/yonlen.swf width=170 height=20> <meta http-equiv=refresh content=5;url=javascript:history.back()></p>"
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>L�tfen Bekleyiniz...</p>"
Response.End
End if

if geridon="" then
Response.Write "<center>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/BilgiEdinme001.jpg ></p>"
Response.Write "<p align=center>&nbsp;<img src=Resimler/eksikbilgi.jpg ></p>"
Response.Write "<p align=center><font size=2 color=black face=Arial><b>Hata: <font size=2 color=red face=Arial>Size Nas�l Bilgi Verelim ! "
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>:: L�TFEN S�ZE NASIL B�LG� VEREL�M KISMINI BO� BIRAKMAYINIZ ... ::</p>"
Response.Write "<p align=center><embed src=Resimler/yonlen.swf width=170 height=20> <meta http-equiv=refresh content=5;url=javascript:history.back()></p>"
Response.Write "<p align=center><font size=2 color=#000000 face=Arial>L�tfen Bekleyiniz...</p>"
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
                  <b>Say�n :</b>
                  <%

MuracaatEdenKisiyeMerhabaDe=Request.Form("isim")
Response.Write MuracaatEdenKisiyeMerhabaDe

%>
            </p>
              <p align="center">Mesaj�n Al�nma Tarihi  :
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
                NetDADI Destek Formunu kullanarak g�ndermi� oldu�unuz mesaj ve <br />
                bununla ilgili olarak talep etmi� oldu�unuz bilgi / formlar kayda al�nm��t�r.<br />
  <br />
                K�sa bir s�re i�erisinde mesaj�n�z de�erlendirmeye al�narak<br />
                sizinle
  <%

MuracaatEdenKisiyeMerhabaDe=Request.Form("geridon")
Response.Write MuracaatEdenKisiyeMerhabaDe

%>
                irtibata ge�ilecektir. <br />
  <br />
                �lginiz i�in te�ekk�r ederiz. <br />
                <br />
  <a href="../TR/index.html" target="_parent">Ana Sayfaya D�n</a></p></td>
            <td width="22">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
