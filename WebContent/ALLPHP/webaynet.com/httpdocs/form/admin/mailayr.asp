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
<%

id = Request.QueryString("id")
Cevap = Request.Form("ileti")
Tarih = Request.Form("Tarih")
saat = Request.Form("saat")

Set Bag = Server.CreateObject("ADODB.Connection")
Bag.Open "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & Server.MapPath("../../data/destek.mdb")
Set Rs = Server.CreateObject("ADODB.Recordset")

nere = "Select * From cevap"
rs.Open nere, bag, 1, 3
rs.Addnew
rs("id") = id
rs("Cevap") = Cevap
rs("Tarih") = tarih
rs("saat") = saat
Rs.Update
hata = "..." 


%>
<%

ileti= Request.Form("ileti")
mails= Request.Form("mails")
ileti= replace(ileti, chr(13), "<br>")
ileti= Replace(ileti, "'", "`")


SenderIp=Request.ServerVariables("HTTP_X_FORWARDED_FOR")

'Mail Server Buraya
MailServer="mail.netdadi.com"

Set Mail = Server.CreateObject("Persits.MailSender")
'Set Msg = Server.CreateObject( "JMail.Message" )
	Msg.charset=windows-1254
	Msg.ISOEncodeHeaders = false
	Msg.AddRecipient  mails


'istenirse ba�ka ki�ilere ek maillerde gidebilir.
	'Msg.AddRecipientCC "mail1@xxxxxxx.com"
	Msg.AddRecipientBCC "bulent@netdadi.com" 

'mail kimden gidecek ?
	Msg.From = "destek@netdadi.com"

	Msg.Subject = "NetDADI Destek Merkezi" 
	Msg.htmlBody = ileti
	Msg.FromName = "Netgardiyan"
	Msg.Priority = "3"
	Msg.AddHeader "Originating-IP", SenderIp
	Msg.send(MailServer)
	Msg.close
%>

<html>
<title>G�nderildi...</title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1254">
<meta http-equiv="Content-Language" content="tr">
<meta name="GENERATOR" content="Microsoft FrontPage 5.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<link href="../sekil.css" rel="stylesheet" type="text/css">
</head>
<meta http-equiv="Content-Type" content="text/html; charset=">
</head>


 <center>&nbsp;</center>&nbsp;<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1" height="91">
  <tr>
    <td width="100%" height="75" valign="top">
      <p align="center"><img border="0" src="../resimler/YonetimBilgiEdinme004.jpg" width="194" height="53">
    </td>
  </tr>
  <tr>
    <td width="100%" height="16">
    <p align="center"><b><font size="2" face="Tahoma">Mesaj Sahibine cevabi mail 
    G�nderilmi�tir...</font></b>
    <b>
<br>
      &nbsp;<font size="2" face="Tahoma" color="#FFFFFF">
<form action="javascript:self.close()" method="post">
      <p align="center"><input type="submit" value="<< Pencereyi Kapat >>"></p>
    </form></font></b></td>
  </tr>
</table>
</body>
</html>