<HTML>
<HEAD>
<TITLE>&lt;&lt; BANKA HAVALE FORMU &gt;&gt;</TITLE>
<meta http-equiv="Page-Enter" content="blendTrans(duration=.5)">
<meta http-equiv="Content-Style-Type" content="text/css">
<LINK HREF="style2.css" TYPE="text/css" REL="stylesheet"> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1254">
<link rel="stylesheet" href="http://www.webaynet.com/css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" href="http://www.webaynet.com/css/template.css" type="text/css"/>
<script src="http://www.webaynet.com/js/jquery-1.6.min.js" type="text/javascript"> </script>
<script src="http://www.webaynet.com/js/languages/jquery.validationEngine-tr.js" type="text/javascript" charset="utf-8">    </script>
<script src="http://www.webaynet.com/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">     </script>
<script>
            jQuery(document).ready(function(){
                // binds form submission and fields to the validation engine
                jQuery("#formID").validationEngine();
            });
            
            /**
             *
             * @param {jqObject} the field where the validation applies
             * @param {Array[String]} validation rules for this field
             * @param {int} rule index
             * @param {Map} form options
             * @return an error string if validation failed
             */
            function checkHELLO(field, rules, i, options){
                if (field.val() != "HELLO") {
                    // this allows to use i18 for the error msgs
                    return options.allrules.validate2fields.alertText;
                }
            }
        </script>
<style type="text/css">
<!--
a:link {
	color: #929292;
}
body {
	background-image: netpatronbankhavform.php;
	text-align: right;
}
.style16 {color: #353535}
.style19 {font-family: Tahoma, Arial; font-size: 11px; color: #353535; }
.style9 {font-family: Tahoma, Arial; font-size: 11px; color: #7B7067; }
.style20 {
	color: #5F5F5F;
	font-weight: bold;
}
.style23 {color: #FF0000}
.style36 {
	font-size: 10px;
	font-weight: bold;
}
.style37 {	FONT-SIZE: 11px; COLOR: #7b7067; FONT-FAMILY: Tahoma, Arial
}
.style39 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: x-small;
}
.style25 {color: #FFFFFF;
	font-size: 14px;
	font-weight: bold;
}
.style31 {color: #333333}
new {
	font-size: 8px;
}
new {
	font-size: 7px;
}
.style91 {	font-family: Tahoma, Arial;
	font-size: 10px;
	color: #7B7067;
}
.new12 {	font-family: Georgia, "Times New Roman", Times, serif;
}
.new12 {	font-size: 9px;
}
.new12 {	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>

</HEAD>
<BODY BGCOLOR=#FFFFFF LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0 rightmargin="0" bottommargin="0">
<center>
  <table width="649" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><div align="center">
        <div align="center">
          <form name="FRM"  method="post" action="http://www.webaynet.com/scripts/formmail/nvform.php" id="formID" class="formular">
            <table width="600"  border="0" cellspacing="2" cellpadding="2">
              <tr align="left" valign="bottom">
                <td colspan="2" scope="row"><span class="style16">
                  <input name="Formun Geldiği Alan" type="hidden" id="Formun Geldiği Alan" value="HAVALE FORMU">
                  <input name="Sipariş Tipi" type="hidden" id="Sipariş Tipi" value="NETWROK SÜRÜMÜ">
                  <input type="hidden" name="subject" value="NETPATRON BANKA HAVALE BİLDİRİM FORMU">
                </span></td>
              </tr>
              <tr align="left" valign="top">
                <td colspan="2" scope="row"><div align="center" class="style20">LÜTFEN HAVALE YAPTIĞINIZ YADA YAPACAĞINIZ BANKAMIZI SEÇİNİZ ! </div></td>
                </tr>
              <tr align="left" valign="top">
                <td colspan="2" scope="row"><table width="640" height="344" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="12" align="center"><input class="validate[required] radio" id="group0" name="Banka" type="radio" value="FinansBank"></td>
                    <td align="center"><input class="validate[required] radio" id="group0" name="Banka" type="radio" value="Garanti"></td>
                  </tr>
                  <tr>
                    <td height="160" colspan="2" align="center" background="images/bankalar1.png"><p>&nbsp;</p>
                      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="2%">&nbsp;</td>
                        <td width="13%" class="new12">Hesap Sahibi</td>
                        <td width="2%" align="center" class="new12" style="font-weight: bold"><strong>:</strong></td>
                        <td width="29%" class="new12">B&uuml;lent Şeker</td>
                        <td width="8%">&nbsp;</td>
                        <td width="12%" class="new12">Hesap Sahibi</td>
                        <td width="2%" align="center" class="new12"><strong>:</strong></td>
                        <td width="30%" class="new12">B&uuml;lent Şeker</td>
                        <td width="2%">&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td class="new12">Şube Kodu</td>
                        <td align="center" class="new12" style="font-weight: bold">:</td>
                        <td class="new12">854</td>
                        <td>&nbsp;</td>
                        <td class="new12">Şube Kodu</td>
                        <td align="center" class="new12">:</td>
                        <td class="new12">425</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td class="new12">Hesap No</td>
                        <td align="center" class="new12" style="font-weight: bold">:</td>
                        <td class="new12">32-56976</td>
                        <td>&nbsp;</td>
                        <td class="new12">Hesap No</td>
                        <td align="center" class="new12">:</td>
                        <td class="new12">6679620</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td class="new12">IBAN</td>
                        <td align="center" class="new12" style="font-weight: bold">:</td>
                        <td class="new12">TR44001110000000003256976</td>
                        <td>&nbsp;</td>
                        <td class="new12">IBAN</td>
                        <td align="center" class="new12">:</td>
                        <td class="new12">TR510006200042500006679620</td>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                    </tr>
                  <tr>
                    <td width="320" height="12" align="center"><input class="validate[required] radio" id="group0" name="Banka" type="radio" value="Akbank"></td>
                    <td width="320" align="center"><input class="validate[required] radio" id="group0" name="Banka" type="radio" value="Denizbank"></td>
                  </tr>
                  <tr>
                    <td height="160" colspan="2" background="images/bankalar2.png"><p>&nbsp;</p>
                      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="2%">&nbsp;</td>
                          <td width="13%" class="new12">Hesap Sahibi</td>
                          <td width="2%" align="center" class="new12" style="font-weight: bold"><strong>:</strong></td>
                          <td width="29%" class="new12">B&uuml;lent Şeker</td>
                          <td width="8%">&nbsp;</td>
                          <td width="12%" class="new12">Hesap Sahibi</td>
                          <td width="2%" align="center" class="new12"><strong>:</strong></td>
                          <td width="30%" class="new12">B&uuml;lent Şeker</td>
                          <td width="2%">&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td class="new12">Şube Kodu</td>
                          <td align="center" class="new12" style="font-weight: bold">:</td>
                          <td class="new12">426</td>
                          <td>&nbsp;</td>
                          <td class="new12">Şube Kodu</td>
                          <td align="center" class="new12">:</td>
                          <td class="new12">3760</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td class="new12">Hesap No</td>
                          <td align="center" class="new12" style="font-weight: bold">:</td>
                          <td class="new12">87054</td>
                          <td>&nbsp;</td>
                          <td class="new12">Hesap No</td>
                          <td align="center" class="new12">:</td>
                          <td class="new12">4498270-351</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td class="new12">IBAN</td>
                          <td align="center" class="new12" style="font-weight: bold">:</td>
                          <td class="new12">TR560004600426888000087054</td>
                          <td>&nbsp;</td>
                          <td class="new12">IBAN</td>
                          <td align="center" class="new12">:</td>
                          <td class="new12">TR950013400000449827000002</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr align="left" valign="top">
                <td colspan="2" scope="row"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="7" align="left" bgcolor="#CCCCCC" class="style20">* L&Uuml;TFEN SİPARİŞ VERMEK İSTEDİĞİNİZ PAKETİ AŞAĞIDAKİ TABLODAN SE&Ccedil;İNİZ</td>
                    </tr>
                  <tr>
                    <td align="center"><input class="validate[required] radio" id="Paket" name="Paket" type="radio" value="5PC"></td>
                    <td align="center">&nbsp;</td>
                    <td align="center"><input class="validate[required] radio" id="Paket" name="Paket" type="radio" value="5-10PC"></td>
                    <td align="center">&nbsp;</td>
                    <td align="center"><input class="validate[required] radio" id="Paket" name="Paket" type="radio" value="10-20PC"></td>
                    <td align="center">&nbsp;</td>
                    <td align="center"><input class="validate[required] radio" id="Paket" name="Paket" type="radio" value="20-40PC"></td>
                    </tr>
                  <tr>
                    <td align="center"><img src="images/1-5pc.png" width="93" height="99"></td>
                    <td align="center">&nbsp;</td>
                    <td align="center"><img src="images/5-10pc.png" width="95" height="97"></td>
                    <td align="center">&nbsp;</td>
                    <td align="center"><img src="images/10-20pc.png" width="99" height="97"></td>
                    <td align="center">&nbsp;</td>
                    <td align="center"><img src="images/20-40pc.png" width="95" height="96"></td>
                  </tr>
                  <tr>
                    <td align="center"><input class="validate[required] radio" id="Paket" name="Paket" type="radio" value="40-60PC"></td>
                    <td align="center">&nbsp;</td>
                    <td align="center"><input class="validate[required] radio" id="Paket" name="Paket" type="radio" value="60-80PC"></td>
                    <td align="center">&nbsp;</td>
                    <td align="center"><input class="validate[required] radio" id="Paket" name="Paket" type="radio" value="80-100PC"></td>
                    <td align="center">&nbsp;</td>
                    <td align="center"><input class="validate[required] radio" id="Paket" name="Paket" type="radio" value="100SONRA"></td>
                  </tr>
                  <tr>
                    <td align="center"><img src="images/40-60pc.png" width="100" height="97"></td>
                    <td align="center">&nbsp;</td>
                    <td align="center"><img src="images/60-80pc.png" width="101" height="97"></td>
                    <td align="center">&nbsp;</td>
                    <td align="center"><img src="images/80-100pc.png" width="106" height="97"></td>
                    <td align="center">&nbsp;</td>
                    <td align="center"><img src="images/100pcdensonra.png" width="100" height="98"></td>
                  </tr>
                  <tr>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="7" align="left"><p class="style37">* LİSANSLARIMIZ 1 YILLIK KULLANIM LİSANSIDIR.<br>
                      * BİR SONRAKİ YIL G&Uuml;NCELLEME &Uuml;CRETLERİ %35 İNDİRİMLİDİR.
                      <br>
                      * 1112 $ OLAN 100 PC VE SONRASI PAKET SE&Ccedil;ENEĞİMİZDE T&Uuml;M PC LERİN AYNI NETWORK TE OLMASI GEREKMEKTEDİR. DIŞ NETWORK OLASILIKLARI İ&Ccedil;İN L&Uuml;TFEN BİZİMLE İRTİBATA GE&Ccedil;İNİZ.
                      </p></td>
                    </tr>
                  </table></td>
              </tr>
              <tr align="left" valign="top">
                <td width="54%" align="right" bgcolor="#E1E1E1" scope="row"><strong class="style37"><span class="style31">LİSANS YENİLEMESİ YAPIYORSANIZ AKTİVASYON KODUNUZ</span><br>
                  (&Uuml;r&uuml;n&uuml;m&uuml;z&uuml; ilk kez alıyorsanız boş bırakınız)</strong></td>
                <td width="46%" bgcolor="#E1E1E1"><span class="style16">
                  <input name="gui" 
            class="style37" id="gui" maxlength="16" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" autocomplete="off"/>
                  </span><br>
                  <strong class="style37">(&Ouml;rneğin: NP00123456789456)</strong></td>
              </tr>
              <tr align="left" valign="top">
                <td colspan="2" scope="row"><table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#999999">
                  <tr>
                    <td><table cellspacing="2" cellpadding="2" width="100%" border="0">
                      <tbody>
                        <tr valign="top" align="left">
                          <td height="16" colspan="2" valign="middle" bgcolor="#FF0000" scope="row"><div align="left" class="style1 style25">FATURA VE TESLİMAT BİLGİLERİNİZ</div></td>
                          </tr>
                        <tr valign="top" align="left">
                          <td scope="row"><strong class="style37">ADINIZ SOYADINIZ / UNVAN</strong></td>
                          <td><strong class="style37">E-POSTA ADRESİNİZ</strong></td>
                          </tr>
                        <tr valign="top" align="left">
                          <td scope="row" width="49%"><span class="style16">
                            <input class="validate[required] text-input" id="Adi" name="Adi" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" autocomplete="off"/>
                            *</span></td>
                          <td width="51%"><span class="style16">
                            <input value="" class="validate[required,custom[email]] text-input" id="email" 
            name="email" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" autocomplete="off"/>
                            *</span></td>
                          </tr>
                        <tr valign="top" align="left">
                          <td class="style37" scope="row"><strong>ŞEHİR</strong></td>
                          <td class="style37"><strong>TELEFON NUMARANIZ</strong></td>
                          </tr>
                        <tr valign="top" align="left">
                          <td scope="row"><span class="style16">
                            <input class="validate[required] text-input" id="sehir" 
            name="sehir" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" autocomplete="off"/>
                            * </span></td>
                          <td><span class="style16">
                            <input name="telefon" class="validate[required] text-input" id="telefon" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" maxlength="11" autocomplete="off"/>
                            * </span></td>
                          </tr>
                        <tr valign="top" align="left">
                          <td class="style37" scope="row">GSM NUMARANIZ</td>
                          <td class="style37"><strong>ÜLKE</strong></td>
                          </tr>
                        <tr valign="top" align="left">
                          <td scope="row"><span class="style16">
                            <input name="GSM" class="style37" id="GSM" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" maxlength="11" autocomplete="off"/>
                            </span></td>
                          <td><span class="style16">
                            <select name="pr_ulke" class="style37" id="select">
                              <option value="00">Please choose 
                                <option value="AF">Afghanistan 
                                  <option value="AL">Albania 
                                    <option value="DZ">Algeria 
                                    <option value="AS">American Samoa 
                                    <option value="AD">Andorra 
                                    <option value="AO">Angola 
                                    <option value="AI">Anguilla 
                                    <option value="AQ">Antarctica 
                                    <option value="AG">Antigua And Barbuda 
                                    <option value="AR">Argentina 
                                    <option value="AM">Armenia 
                                    <option value="AW">Aruba 
                                    <option value="AU">Australia 
                                    <option value="AT">Austria 
                                    <option value="AZ">Azerbaijan 
                                    <option value="BS">Bahamas, The 
                                    <option value="BH">Bahrain 
                                    <option value="BD">Bangladesh 
                                    <option value="BB">Barbados 
                                    <option value="BY">Belarus 
                                    <option value="BE">Belgium 
                                    <option value="BZ">Belize 
                                    <option value="BJ">Benin 
                                    <option value="BM">Bermuda 
                                    <option value="BT">Bhutan 
                                    <option value="BO">Bolivia 
                                    <option value="BA">Bosnia and Herzegovina 
                                    <option value="BW">Botswana 
                                    <option value="BV">Bouvet Island 
                                    <option value="BR">Brazil 
                                    <option value="IO">British Indian Ocean Territory 
                                    <option value="BN">Brunei 
                                    <option value="BG">Bulgaria 
                                    <option value="BF">Burkina Faso 
                                    <option value="BI">Burundi 
                                    <option value="KH">Cambodia 
                                    <option value="CM">Cameroon 
                                    <option value="CA">Canada 
                                    <option value="CV">Cape Verde 
                                    <option value="KY">Cayman Islands 
                                    <option value="CF">Central African Republic 
                                    <option value="TD">Chad 
                                    <option value="CL">Chile 
                                    <option value="CN">China 
                                    <option value="HK">China (Hong Kong S.A.R.) 
                                    <option value="MO">China (Macau S.A.R.) 
                                    <option value="CX">Christmas Island 
                                    <option value="CC">Cocos (Keeling) Islands 
                                    <option value="CO">Colombia 
                                    <option value="KM">Comoros 
                                    <option value="CG">Congo 
                                    <option value="CD">Congo, Democractic Republic of 
                                                                                                                                        the 
                                    <option value="CK">Cook Islands 
                                    <option value="CR">Costa Rica 
                                    <option value="CI">Cote D'Ivoire (Ivory Coast) 
                                    <option value="HR">Croatia (Hrvatska) 
                                    <option value="CU">Cuba 
                                    <option value="CY">Cyprus 
                                    <option value="CZ">Czech Republic 
                                    <option value="DK">Denmark 
                                    <option value="DJ">Djibouti 
                                    <option value="DM">Dominica 
                                    <option value="DO">Dominican Republic 
                                    <option value="TP">East Timor 
                                    <option value="EC">Ecuador 
                                    <option value="EG">Egypt 
                                    <option value="SV">El Salvador 
                                    <option value="GQ">Equatorial Guinea 
                                    <option value="ER">Eritrea 
                                    <option value="EE">Estonia 
                                    <option value="ET">Ethiopia 
                                    <option value="FK">Falkland Islands (Islas Malvinas) 
                                    <option value="FO">Faroe Islands 
                                    <option value="FJ">Fiji Islands 
                                    <option value="FI">Finland 
                                    <option value="FR">France 
                                    <option value="GF">French Guiana 
                                    <option value="PF">French Polynesia 
                                    <option value="TF">French Southern Territories 
                                    <option value="GA">Gabon 
                                    <option value="GM">Gambia, The 
                                    <option value="GE">Georgia 
                                    <option value="DE">Germany 
                                    <option value="GH">Ghana 
                                    <option value="GI">Gibraltar 
                                    <option value="GR">Greece 
                                    <option value="GL">Greenland 
                                    <option value="GD">Grenada 
                                    <option value="GP">Guadeloupe 
                                    <option value="GU">Guam 
                                    <option value="GT">Guatemala 
                                    <option value="GN">Guinea 
                                    <option value="GW">Guinea-Bissau 
                                    <option value="GY">Guyana 
                                    <option value="HT">Haiti 
                                    <option value="HM">Heard and McDonald Islands 
                                    <option value="HN">Honduras 
                                    <option value="HU">Hungary 
                                    <option value="IS">Iceland 
                                    <option value="IN">India 
                                    <option value="ID">Indonesia 
                                    <option value="IR">Iran 
                                    <option value="IQ">Iraq 
                                    <option value="IE">Ireland 
                                    <option value="IL">Israel 
                                    <option value="IT">Italy 
                                    <option value="JM">Jamaica 
                                    <option value="JP">Japan 
                                    <option value="JO">Jordan 
                                    <option value="KZ">Kazakhstan 
                                    <option value="KE">Kenya 
                                    <option value="KI">Kiribati 
                                    <option value="KR">Korea 
                                    <option value="KP">Korea, North 
                                    <option value="KW">Kuwait 
                                    <option value="KG">Kyrgyzstan 
                                    <option value="LA">Laos 
                                    <option value="LV">Latvia 
                                    <option value="LB">Lebanon 
                                    <option value="LS">Lesotho 
                                    <option value="LR">Liberia 
                                    <option value="LY">Libya 
                                    <option value="LI">Liechtenstein 
                                    <option value="LT">Lithuania 
                                    <option value="LU">Luxembourg 
                                    <option value="MK">Macedonia 
                                    <option value="MG">Madagascar 
                                    <option value="MW">Malawi 
                                    <option value="MY">Malaysia 
                                    <option value="MV">Maldives 
                                    <option value="ML">Mali 
                                    <option value="MT">Malta 
                                    <option value="MH">Marshall Islands 
                                    <option value="MQ">Martinique 
                                    <option value="MR">Mauritania 
                                    <option value="MU">Mauritius 
                                    <option value="YT">Mayotte 
                                    <option value="MX">Mexico 
                                    <option value="FM">Micronesia 
                                    <option value="MD">Moldova 
                                    <option value="MC">Monaco 
                                    <option value="MN">Mongolia 
                                    <option value="MS">Montserrat 
                                    <option value="MA">Morocco 
                                    <option value="MZ">Mozambique 
                                    <option value="MM">Myanmar 
                                    <option value="NA">Namibia 
                                    <option value="NR">Nauru 
                                    <option value="NP">Nepal 
                                    <option value="AN">Netherlands Antilles 
                                    <option value="NL">Netherlands, The 
                                    <option value="NC">New Caledonia 
                                    <option value="NZ">New Zealand 
                                    <option value="NI">Nicaragua 
                                    <option value="NE">Niger 
                                    <option value="NG">Nigeria 
                                    <option value="NU">Niue 
                                    <option value="NF">Norfolk Island 
                                    <option value="MP">Northern Mariana Islands 
                                    <option value="NO">Norway 
                                    <option value="OM">Oman 
                                    <option value="PK">Pakistan 
                                    <option value="PW">Palau 
                                    <option value="PA">Panama 
                                    <option value="PG">Papua new Guinea 
                                    <option value="PY">Paraguay 
                                    <option value="PE">Peru 
                                    <option value="PH">Philippines 
                                    <option value="PN">Pitcairn Island 
                                    <option value="PL">Poland 
                                    <option value="PT">Portugal 
                                    <option value="PR">Puerto Rico 
                                    <option value="QA">Qatar 
                                    <option value="RE">Reunion 
                                    <option value="RO">Romania 
                                    <option value="RU">Russia 
                                    <option value="RW">Rwanda 
                                    <option value="SH">Saint Helena 
                                    <option value="KN">Saint Kitts And Nevis 
                                    <option value="LC">Saint Lucia 
                                    <option value="PM">Saint Pierre and Miquelon 
                                    <option value="VC">Saint Vincent And The Grenadines 
                                    <option value="WS">Samoa 
                                    <option value="SM">San Marino 
                                    <option value="ST">Sao Tome and Principe 
                                    <option value="SA">Saudi Arabia 
                                    <option value="SN">Senegal 
                                    <option value="SC">Seychelles 
                                    <option value="SL">Sierra Leone 
                                    <option value="SG">Singapore 
                                    <option value="SK">Slovakia 
                                    <option value="SI">Slovenia 
                                    <option value="SB">Solomon Islands 
                                    <option value="SO">Somalia 
                                    <option value="ZA">South Africa 
                                    <option value="GS">South Georgia 
                                    <option value="ES">Spain 
                                    <option value="LK">Sri Lanka 
                                    <option value="SD">Sudan 
                                    <option value="SR">Suriname 
                                    <option value="SJ">Svalbard And Jan Mayen Islands 
                                    <option value="SZ">Swaziland 
                                    <option value="SE">Sweden 
                                    <option value="CH">Switzerland 
                                    <option value="SY">Syria 
                                    <option value="TW">Taiwan 
                                    <option value="TJ">Tajikistan 
                                    <option value="TZ">Tanzania 
                                    <option value="TH">Thailand 
                                    <option value="TG">Togo 
                                    <option value="TK">Tokelau 
                                    <option value="TO">Tonga 
                                    <option value="TT">Trinidad And Tobago 
                                    <option value="TN">Tunisia 
                                    <option value="TR" selected>Turkey 
                                    <option value="TM">Turkmenistan 
                                    <option value="TC">Turks And Caicos Islands 
                                    <option value="TV">Tuvalu 
                                    <option value="UG">Uganda 
                                    <option value="UA">Ukraine 
                                    <option value="AE">United Arab Emirates 
                                    <option value="UK">United Kingdom 
                                    <option value="US">United States 
                                    <option value="UM">United States Minor Outlying Islands 
                                    <option value="UY">Uruguay 
                                    <option value="UZ">Uzbekistan 
                                    <option value="VU">Vanuatu 
                                    <option value="VA">Vatican City State (Holy See) 
                                    <option value="VE">Venezuela 
                                    <option value="VN">Vietnam 
                                    <option value="VG">Virgin Islands (British) 
                                    <option value="VI">Virgin Islands (US) 
                                    <option value="WF">Wallis And Futuna Islands 
                                    <option value="EH">Western Sahara 
                                    <option value="YE">Yemen 
                                    <option value="YU">Yugoslavia 
                                    <option value="ZM">Zambia 
                                    <option value="ZW">Zimbabwe</option>
                              </select>
                            </span></td>
                          </tr>
                        <tr valign="top" align="left">
                          <td bgcolor="#E1E1E1" scope="row"><div align="right"></div></td>
                          <td align="left" valign="baseline" bgcolor="#E1E1E1"><span class="style16"><br />
                          </span></td>
                          </tr>
                        <tr valign="top" align="left">
                          <td scope="row"><div align="right"><strong class="style37">ŞİRKET İSENİZ FİRMA YA DA KURUM ADI</strong></div></td>
                          <td><span class="style16">
                            <input class="style37" id="unvan" 
            name="unvan" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" autocomplete="off"/>
                            </span></td>
                          </tr>
                        <tr valign="top" align="left">
                          <td class="style37" scope="row"><strong>VERGİ DAİRENİZ</strong></td>
                          <td class="style37"><strong>VERGİ NUMARANIZ</strong></td>
                        </tr>
                        <tr valign="top" align="left">
                          <td scope="row"><span class="style16">
                            <input class="validate[required] text-input" id="vdaire" 
            name="vdaire" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" autocomplete="off"/>
                            * </span></td>
                          <td><span class="style16">
                            <input 
            name="vno2" class="validate[required] text-input" id="vno2" maxlength="11" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" autocomplete="off"/>
                            * </span></td>
                        </tr>
                        <tr valign="top" align="left">
                          <td scope="row" colspan="2">&nbsp;</td>
                        </tr>
                        <tr valign="top" align="left">
                          <td scope="row"><strong class="style37">FATURA TESLİMAT ADRESİNİZ</strong><br />
                            <textarea class="validate[required] text-input" id="adres" name="adres" rows="5" cols="30"></textarea></td>
                          <td class="style37"><strong class="style37">                            VARSA &Ouml;ZEL MESAJINIZ</strong><br />
                            <textarea  id="Mesaj" name="Mesaj" rows="5" cols="30"></textarea></td>
                        </tr>
                        <tr valign="top" align="left">
                          <td scope="row">&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr valign="top" align="left">
                          <td scope="row">&nbsp;</td>
                          <td><input name="submit" type="submit" class="style37" id="Submit" value="İŞLEMİ TAMAMLA  &gt;&gt;" /></td>
                          </tr>
                        <tr valign="top" align="left">
                          <td scope="row" colspan="2"><ul>
                            <li class="style37">(*) Lütfen bu işaretin olduğu alanları mutlaka doldurunuz. 
                              Sizinle kolay bir şekilde irtibat kurabilmemiz için bu gereklidir. </li>
                            </ul></td>
                          </tr>
                        </tbody>
                      </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
          </form>
        </div>
      </div></td>
    </tr>
  </table>
</center>
</BODY>
</HTML>