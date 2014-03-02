<!-- #include file="guvenlik.asp" -->

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

<title>Bilgi Edinme | Mesaj Oku</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1254">
<meta http-equiv="Content-Language" content="tr">
<meta name="GENERATOR" content="Microsoft FrontPage 5.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<link href="../sekil.css" rel="stylesheet" type="text/css">
<%
Set Copur1 = Server.CreateObject("ADODB.Connection")
Copur1.Open "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & Server.MapPath("../../data/destek.mdb")
%> <%
Set BilgiEdinme = Server.CreateObject("ADODB.Recordset")
SQL = "Select * from kayitlar"
BilgiEdinme.Open SQL,Copur1,1,3


Set BilgiEdinme = Server.CreateObject("ADODB.Recordset")
Copur2 = "Select * from kayitlar"
BilgiEdinme.Open Copur2,Copur1,1,3
toplam=BilgiEdinme.recordcount
%> <%
shf = Request.QueryString("shf")
if shf="" then 
shf=1
end if

ToplamSayi=BilgiEdinme.recordcount
%> <%
id=Request.QueryString("id")
Set BilgiEdinme = Server.CreateObject("ADODB.Recordset")
SQL = "Select * from kayitlar"
BilgiEdinme.Open SQL,Copur1,1,3
toplam=BilgiEdinme.recordcount
%> <%
If BilgiEdinme.eof then
Response.Write "<font face=verdana size=2>"
Response.Write "<center>"
Response.Write "Diger Bilgileri Yok !!!"
Reponse.End
Response.Write "</center>"
Response.Write "</font>"
End If

shf = Request.QueryString("shf")
if shf="" then 
shf=1
end if

ToplamSayi=BilgiEdinme.recordcount
%> <%
islem=Request.QueryString("islem")
if islem="goster" then
call goster
end if
%> <% sub goster
id=Request.QueryString("id")
Set BilgiEdinme = Server.CreateObject("ADODB.Recordset")
Copur2 = "Select * from kayitlar where id="&id
BilgiEdinme.Open Copur2,Copur1,1,3


end sub
%> <% BilgiEdinme.pagesize = 1
BilgiEdinme.absolutepage = shf
sayfa = BilgiEdinme.pagecount
for i=1 to BilgiEdinme.pagesize
if BilgiEdinme.eof then exit for
%> 
<p align="center"> <img border="0" src="../resimler/YonetimBilgiEdinme003.jpg" width="194" height="89"><br>
  <b>Bilgi Edinme<br>
  <u>Mesaj No : <%=BilgiEdinme("id")%></u></b></p>
<table align="center" width="95%">
  <tr>
      
    <td bgcolor="#FFFFFF" width="640"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr bgcolor="#CCFFCC"> 
          <td> 
            <table width="100%" border="0" cellspacing="1" cellpadding="2">
              <tr bgcolor="#FFFFFF"> 
                <td align="right" width="125"><b>Başvuru Tarihi :</b></td>
                <td> <%=BilgiEdinme("tarih")%> Saat : <%=BilgiEdinme("saat")%></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td align="right"><b>Başvuru Türü :</b></td>
                <td><%=BilgiEdinme("kultur")%></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td align="right"><b>Adı Soyadı :</b></td>
                <td><%=BilgiEdinme("isim")%></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td align="right"><b>Cep Telefonu : </b></td>
                <td><%=BilgiEdinme("ceptel")%></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td align="right"><b>Telefonu : </b></td>
                <td><%=BilgiEdinme("tel")%></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td align="right"><b>Fax Telefonu : </b></td>
                <td><%=BilgiEdinme("faks")%></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td align="right"><b>E-Posta :</b></td>
                <td><%=BilgiEdinme("email")%></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td align="right"><b>İrtibat Adresi: </b></td>
                <td><%=BilgiEdinme("adres")%><br />
                <%=BilgiEdinme("sehir")%><br />
                <%=BilgiEdinme("ulke")%></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td align="right"><b>Cevap Şekli: </b></td>
                <td><u><%=BilgiEdinme("geridon")%></u></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td colspan="2"> 
                  <hr>
                </td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td align="right" valign="top"><b>Mesajı : </b></td>
                <td valign="top"><%=BilgiEdinme("ileti")%></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      
    </td>
  <tr></table>
<%BilgiEdinme.movenext%><% next %>