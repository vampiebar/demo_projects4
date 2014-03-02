<!-- #include file="guvenlik.asp" --> <%
Set Sur = Server.CreateObject("ADODB.Connection")
Sur.Open "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & Server.MapPath("../../data/destek.mdb")
%> <%
Set talha = Server.CreateObject("ADODB.Recordset")
SQL = "Select * from kayitlar"
talha.Open SQL,Sur,1,3


Set talha = Server.CreateObject("ADODB.Recordset")
sor = "Select * from kayitlar"
talha.Open sor,Sur,1,3
toplam=talha.recordcount
%> <%
id=Request.QueryString("id")
Set talha = Server.CreateObject("ADODB.Recordset")
SQL = "Select * from kayitlar"
talha.Open SQL,Sur,1,3
toplam=talha.recordcount
%> <%
islem=Request.QueryString("islem")
if islem="goster" then
call goster
end if
%> <% sub goster
id=Request.QueryString("id")
Set talha = Server.CreateObject("ADODB.Recordset")
sor = "Select * from kayitlar where id="&id
talha.Open sor,Sur,1,3
end sub
%> 
<title>Bilgi Edinme Mesaj Gidecek...</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1254">
<meta http-equiv="Content-Language" content="tr">
<link href="../Taha.css" rel="stylesheet" type="text/css">
<form action="mailayr.asp?id=<%=talha("id")%>" method="post"><tr>
    <table border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td> 
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr bgcolor="DCDCDC"> 
              <td> <font color="#FFFFFF" size="1"><b><font color="#000000">&nbsp;İsim 
                : <%=talha("isim")%> | Tel : <%=talha("tel")%> | Fax :<%=talha("faks")%> 
                | Cevap Şekli : <%=talha("geridon")%>| Tarih : </font><font color="#FFFFFF" size="1"><b><font color="#000000"><%=talha("tarih")%> </font><font color="#FFFFFF" size="1"><b><font color="#000000"><%=talha("saat")%></font></b></font></b></font></b></font></td>
            </tr>
          </table>
          <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1">
           <tr>           
              <td width="100%"><u> 
                <textarea  cols=55 name=talha001 wrap=virtual rows=3 STYLE="border=0  font-style: normal;  color: #FFFFCC; BORDER-BOTTOM: #DCDCDC 2px solid; BORDER-LEFT: #DCDCDC 2px solid; BORDER-RIGHT: #DCDCDC 1px solid; BORDER-TOP: #DCDCDC 1px solid;" disabled><%=talha("ileti")%></textarea>
           </u></td>
            </tr>
            <tr>
              
              <td width="100%"> 
                <br>
                  
                <h1>Cevap Yaz :</h1>
                <b>Mesaj Gönderme Tar :</b> 
                <input type="hidden" name="tarih" value="<% Response.Write Date %>"/>
                <input type="hidden" name="saat" value="<% Response.Write Time %>"/>
                <% Response.Write Date %>
                <b>
                <% Response.Write Time %>
                <br>
                Mesaj şuraya gidiyor :</b> 
                  <input type="text" name="mails" size="30" style="border: 0px solid #707070" value="<%=talha("email")%>">
                  <br>
                  <textarea cols=55 name=ileti wrap=virtual rows=8 STYLE="border=0  font-style: normal;  color: #DA6713; BORDER-BOTTOM: #FAA500 2px solid; BORDER-LEFT: #FAA500 2px solid; BORDER-RIGHT: #FAA500 2px solid; BORDER-TOP: #FAA500 2px solid;"></textarea>
                
              </td>
            </tr>
          </table>
<tr>
        <td width="100%" height="21"> 
          <p><b> </b> <u> </u>
        </td>
    </tr>
    <tr>
  
    <p align="center" height="19">
    
    </tr>
    <tr>
<td>
    <p align="center" height="25">
            <input type="submit" value="Mesajı Gönder !">
          </td>
    </tr></table>
</form>
</body>