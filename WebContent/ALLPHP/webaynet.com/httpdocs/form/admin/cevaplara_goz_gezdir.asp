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
<title>Bilgi Edinme | Verilen Cevaplar</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1254">
<meta http-equiv="Content-Language" content="tr">
<link href="../Sekil.css" rel="stylesheet" type="text/css">
<%
Set Talha=Server.CreateObject("Adodb.Connection")
Talha.Open "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & Server.Mappath("../../data/destek.mdb")
%>
<% id = request.querystring("id") %>
<%
set kayit = Server.CreateObject("ADODB.RecordSet")
nere = "Select * From cevap where id = " & id & ""

kayit.open nere,Talha,1,3
%>

<%
set kayit1 = Server.CreateObject("ADODB.RecordSet")
nere1 = "Select * From kayitlar where id = " & id & ""

kayit1.open nere1,Talha,1,3
%>
 
<div align="center"><b><img src="../resimler/YonetimBilgiEdinme002.jpg" width="194" height="89"><br>
  </b> </div>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr bgcolor="#FFFFFF"> 
    <td align="right" width="125"><b>Ba�vuru Tarihi :</b></td>
    <td> <%=Kayit1("tarih")%></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="right"><b>Ba�vuru Saati :</b></td>
    <td><%=Kayit1("saat")%></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td align="right"><b>Ba�vuru T�r� :</b></td>
    <td><%=Kayit1("kultur")%></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td align="right"><b>Ad� Soyad� :</b></td>
    <td><%=Kayit1("isim")%></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td align="right"><b>Faks : </b></td>
    <td><%=Kayit1("ceptel")%></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td align="right"><b>Telefonu : </b></td>
    <td><%=Kayit1("tel")%></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td align="right"><b>�ehir: </b></td>
    <td><%=Kayit1("sehir")%></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td align="right"><b>E-Posta :</b></td>
    <td><%=Kayit1("email")%></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="right"><b>�lke : </b></td>
    <td><%=Kayit1("ulke")%></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td align="right"><b>�rtibat Adresi: </b></td>
    <td><%=Kayit1("adres")%></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td align="right"><b>Cevap �ekli: </b></td>
    <td><u><%=Kayit1("geridon")%></u></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="right"><b>Mesaj� : </b></td>
    <td><u><%=Kayit1("ileti")%></u></td>
  </tr>
</table>
<h1>
Mesaj Numaras� : <%=kayit("id")%></h1><br>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr bgcolor="#CCCCCC"> 
    <td> 
      <table cellspacing="1" border="0" cellpadding="0" width="100%">
        <tr bgcolor="#FF3300"> 
          <td width="11%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><b><font color="#FFFFFF">Cevap 
            No</font></b></font></td>
          <td width="54%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><b><font color="#FFFFFF">Cevap 
            ��eri�i</font></b></font></td>
          <td width="35%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><b><font color="#FFFFFF">Cevap 
            Tarihi</font></b></font></td>
        </tr>
        <% do while not kayit.eof %> 
        <tr bgcolor="#FFFFFF"> 
          <td width="11%"><%=kayit("cevapno")%></td>
          <td width="54%"><%=kayit("cevap")%></td>
          <td width="35%"><%=kayit("tarih")%> <%=kayit("saat")%></td>
        </tr>
        <% 
kayit.movenext %> <%Loop%> 
      </table>
    </td>  
  </tr>
</table>



