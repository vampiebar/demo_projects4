<%										   
'***********************************************'
' Script    : Bilgi Edinme Sistemi V.1.0  		'
' Tarih     : 05 Ocak 2005, Saat : 17.44  		'
' Oluþturma : Talha Çopur				  		'
' E-Mail    : copurellezi@hotmail.com     		'
' Web		: http://www.talha.org		  		'
' ---------------------------------------------	'
' Belki de kodlarýn tamamýna yakýný		  		'
' AtaBerK Ileti Script v2.0 den editlenmiþtir 	'
' Bu noktada bu scripti hazýrlamama		  		'
' vesile olan, Mehmet Ayhan Taçyýldýz'a   		'
' þükranlarýmý sunuyorum.				  		'
' ---------------------------------------------	'
' Ayrýca ; www.aspindir.com ' a da bu vesile ile'
' en derin teþekkürlerimi iletiyorum. Emeði		'
' geçenleri kutluyor, tebrik ediyorum. 			'
'***********************************************'
%>

<%
dim parola
parola = "12345"
if session("administrator") <> parola then
if request.form("administrator") <> parola then
call parolaform
else
session("administrator") = parola
end if
end if
%>

<%'-----------------------------------------------------------------------------------------------------------'%>
<%
sub parolaform
AdresBelli = "http://" & Request.ServerVariables("HTTP_HOST") & Request.ServerVariables("URL")
%>
<title>Bilgi Edinme | Þifre Bölgesi</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<meta http-equiv="Content-Language" content="tr">
<link href="../Sekil.css" rel="stylesheet" type="text/css">



<style type="text/css">
<!--
.style1 {
	color: #0000FF;
	font-weight: bold;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<div align="center"> 
  <h1><img src="../resimler/YonetimBilgiEdinme001.jpg" width="429" height="75" /></h1>
  <table width="446" height="157" border="0" cellpadding="0" cellspacing="0" background="../resimler/formback3.jpg">
    <tr>
      <td><table width="446" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="22">&nbsp;</td>
          <td width="403"><div align="center">
            <p class="style1">LÜTFEN YÖNETÝCÝ ÞÝFRENÝZÝ GÝRÝNÝZ ! </p>
            <form method=post action="<%=AdresBelli%>">
              <div align="center">
    <input type="password" name="administrator" value="" size="20" style="background-color: #FBFBFB; font-family: Verdana; font-size: 8pt; border: 1 ridge #525454">
    <input name="submit" type="submit" style="background-color: #F7F7F7; font-family: Verdana; font-size: 8pt; border: 1 outset #525454" value=": Sisteme Giriþ :" />
  </div>
</form>
<div align="center"><%
response.end
end sub
%></div>
          </div></td>
          <td width="21">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
  </table>
  <br>
</div>

