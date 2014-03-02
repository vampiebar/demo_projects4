<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1254">
<title>Untitled Document</title>
<SCRIPT language=JavaScript>
function MM_openBrWindow(theURL,winName,features) { //v2.0
window.open(theURL,winName,features);
}

function MM_openBrWindowEx(theURL,winName,features) { //v2.0 
	var nUrl;
	//nUrl = theURL + "?pr_qty=" + document.forms["frmorder"].pr_qty.value;
	nUrl = nUrl + "&Adi=" + document.forms["FRM"].Adi.value;
	nUrl = nUrl + "&email=" + document.forms["FRM"].email.value;
	nUrl = nUrl + "&sehir=" + document.forms["FRM"].sehir.value;
	nUrl = nUrl + "&vno=" + document.forms["FRM"].vno.value;
	nUrl = nUrl + "&ip=" + document.forms["FRM"].ip.value;
	nUrl = nUrl + "&pccount=" + document.forms["FRM"].pccount.value;
	nUrl = nUrl + "&unvan=" + document.forms["FRM"].unvan.value;
	nUrl = nUrl + "&vdaire=" + document.forms["FRM"].vdaire.value;
	nUrl = nUrl + "&telefon=" + document.forms["FRM"].telefon.value;
	nUrl = nUrl + "&adres=" + document.forms["FRM"].adres.value;
//	nUrl = nUrl + "&pr_ulke=" + document.forms["FRM"].pr_ulke.options[document.forms["FRM"].pr_ulke.selectedIndex].text;
	window.open(nUrl,winName,features); 
//	alert(nUrl);
} 

function form_control_ex() {

if (FRM.Adi.value == '') {
alert("LÜTFEN ADINIZI VEYA UNVANINIZI YAZINIZ");
FRM.Adi.focus();
return false;  
}

if (FRM.email.value == '') {
alert("LÜTFEN E-MAİL ADRESİNİZİ YAZINIZ. ÜRÜN AKTİVASYON KODU BU MAİL ADRESİNE GÖNDERİLECEKTİR.");
FRM.email.focus();
return false;  
}

var epostasi = FRM.email.value
if ( (epostasi.indexOf ('@',0) == -1) || (epostasi.indexOf('.',0) == -1) || (epostasi.indexOf(' ',0) != -1) || (epostasi.length<6) || epostasi.indexOf ('@',0) != epostasi.lastIndexOf ('@') )
{
alert ("E-MAİL ADRESİNİZDE BİR YANLIŞLIK VAR, LÜTFEN KONTROL EDİNİZ VE YENİDEN GİRİNİZ.");
FRM.email.focus();
return false;
}

if (FRM.sehir.value == '') {
alert("LÜTFEN BULUNDUĞUNUZ ŞEHRİ YAZINIZ.");
FRM.sehir.focus();
return false;  
}

if (FRM.telefon.value == '') {
alert("LÜTFEN TELEFONUNUZU YAZINIZ, SİZİNLE İRTİBATA GEÇEBİLMEMİZ İÇİN BU GEREKLİ");
FRM.telefon.focus();
return false;  
}

if (FRM.ip.value == '') {
alert("LÜTFEN SABİT İP ADRESİNİZİ YAZINIZ, BU ALAN GEREKLİDİR.");
FRM.ip.focus();
return false;  
}

if (FRM.pccount.value == '') {
alert("LÜTFEN BİLGİSAYAR SAYINIZI BELİRTİNİZ, BU ALAN GEREKLİDİR.");
FRM.pccount.focus();
return false;  
}

//if (FRM.unvan.value == '') {
//alert("Please enter your lastname");
//FRM.unvan.focus();
//return false;  
//}

//if (FRM.gsm.value == '') {
//alert("Please enter your ZIP code");
//FRM.gsm.focus();
//return false;  
//}
//if (FRM.pr_ulke.value == '00') {
//alert("Please select your Country");
//FRM.pr_ulke.focus();
//return false;  
//}

if (FRM.unvan.value == '') {
alert("LÜTFEN CAFE İSMİNİ GİRİNİZ.");
FRM.unvan.focus();
return false;  
}

if (FRM.vdaire.value == '') {
alert("LÜTFEN VERGİ DAİRENİZİ");
FRM.vdaire.focus();
return false;  
}

if (FRM.vno.value == '') {
alert("LÜTFEN VERGİ NUMARANIZI YAZINIZ. ");
FRM.vno.focus();
return false;  
}

if (FRM.adres.value == '') {
alert("LÜTFEN ADRESİNİZİ YAZINIZ, FATURANIZIN VE ÜRÜNÜNÜZÜN GÖNDERİLEBİLMESİ İÇİN GEREKLİDİR.");
FRM.adres.focus();
return false;  
}

document.forms["FRM"].Submit.disabled = true;
return true;
}

</SCRIPT>
<style type="text/css">
<!--
.style1 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: x-small;
}
.style12 {font-size: small}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style13 {
	color: #FF0000;
	font-weight: bold;
}
.style16 {	COLOR: #353535
}
.style19 {	FONT-SIZE: 11px; COLOR: #353535; FONT-FAMILY: Tahoma, Arial
}
.style25 {	color: #FFFFFF;
	font-size: 14px;
	font-weight: bold;
}
.style9 {	FONT-SIZE: 11px; COLOR: #7b7067; FONT-FAMILY: Tahoma, Arial
}
.style31 {color: #333333}
.style33 {
	font-size: medium;
	color: #0000FF;
}
-->
</style>
</head>

<body>
<div align="center">
  <table width="449" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td valign="top"><form id="FRM" name="FRM" method="post" action="nvform.php" onSubmit="return form_control_ex();">
        <table width="100%" border="1" cellpadding="2" cellspacing="4" bordercolor="#DFE4E7">
      <tr bgcolor="#FFFFFF">
        <td height="59" bgcolor="#FFFFFF" class="style1"><div align="center"><img src="images/STEP2.jpg" width="413" height="105"></div></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td height="59" bgcolor="#FFFFFF" class="style1"><div align="center" class="style12"><br />
            <span class="style13"><span class="style33">ÖDEMENİZ BAŞARI İLE ALINMIŞTIR;</span><br>
            LÜTFEN AŞAĞIDAKİ FORMU EKSİKSİZ BİR ŞEKİLDE DOLDURUNUZ... </span><br />
            <span class="style16">
            <input name="Formun Geldiği Alan" type="hidden" id="Formun Geldiği Alan" value="KK SATIŞI FORMU">
            <input type="hidden" name="subject" value="webaynet.com Kredi Kartı ile Satış Formu">
            </span><br />
            <table cellspacing="2" cellpadding="2" width="100%" border="0">
              <tbody>
                
                <tr valign="top" align="left">
                  <td height="16" colspan="2" valign="middle" bgcolor="#FF0000" scope="row"><div align="left" class="style1 style25">TESLİMAT VE KİŞİSEL BİLGİLERİNİZ</div></td>
                </tr>
                <tr valign="top" align="left">
                  <td scope="row"><strong class="style9">ADINIZ SOYADINIZ / UNVAN</strong></td>
                  <td><strong class="style9">E-POSTA ADRESİNİZ</strong></td>
                </tr>
                <tr valign="top" align="left">
                  <td scope="row" width="49%"><span class="style16">
                    <input class="style9" id="Adi" name="Adi" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" autocomplete="off"/>
                    *</span></td>
                  <td width="51%"><span class="style16">
                    <input class="style9" id="email" 
            name="email" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" autocomplete="off"/>
                    *</span></td>
                </tr>
                <tr valign="top" align="left">
                  <td class="style9" scope="row"><strong>ŞEHİR</strong></td>
                  <td class="style9"><strong>TELEFON NUMARANIZ</strong></td>
                </tr>
                <tr valign="top" align="left">
                  <td scope="row"><span class="style16">
                    <input class="style9" id="sehir" 
            name="sehir" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" autocomplete="off"/>
                    * </span></td>
                  <td><span class="style16">
                    <input name="telefon" class="style9" id="telefon" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" maxlength="11" autocomplete="off"/>
                    * </span></td>
                </tr>
                <tr valign="top" align="left">
                  <td class="style9" scope="row"><strong>SABİT IP ADRESİNİZ</strong></td>
                  <td class="style9"><strong>PC SAYINIZ</strong></td>
                </tr>
                <tr valign="top" align="left">
                  <td class="style9" scope="row"><span class="style16">
                    <input name="ip" class="style9" id="ip" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" maxlength="20" autocomplete="off"/>
                  *</span></td>
                  <td class="style9"><span class="style16">
                    <input name="pccount" class="style9" id="pccount" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" size="4" maxlength="3" autocomplete="off"/>
                  *</span></td>
                </tr>
                <tr valign="top" align="left">
                  <td class="style9" scope="row"><strong>GSM NUMARANIZ</strong></td>
                  <td class="style9"><strong>ÜLKE</strong></td>
                </tr>
                <tr valign="top" align="left">
                  <td scope="row"><span class="style16">
                    <input name="GSM" class="style9" id="GSM" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" maxlength="11" autocomplete="off"/>
                  </span></td>
                  <td><span class="style16">
                    <select name="pr_ulke" class="style9" id="select">
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
                  <td scope="row"><div align="right"><strong class="style9"><span class="style31">T.C. KiMLiK NO</span><br>
                    (Yeni Yasa gereği vergi numarası 
                    olarakta kullanılmaktadır. Fatura kesilebilmesi i&ccedil;in gereklidir.) </strong></div></td>
                  <td valign="baseline" align="left"><span class="style16"><br />
                        <input name="tcno" 
            class="style9" id="tcno" maxlength="12" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" autocomplete="off"/>
                  </span></td>
                </tr>
                <tr valign="top" align="left">
                  <td scope="row"><div align="right"><strong class="style9">CAFE ADI </strong></div></td>
                  <td><span class="style16">
                    <input class="style9" id="unvan" 
            name="unvan" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" autocomplete="off"/>
                  *</span></td>
                </tr>
                <tr valign="top" align="left">
                  <td class="style9" scope="row"><strong>VERGİ DAİRENİZ</strong></td>
                  <td class="style9"><strong>VERGİ NUMARANIZ</strong></td>
                </tr>
                <tr valign="top" align="left">
                  <td scope="row"><span class="style16">
                    <input class="style9" id="vdaire" 
            name="vdaire" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" autocomplete="off"/>
                    * </span></td>
                  <td><span class="style16">
                    <input 
            name="vno" class="style9" id="vno" maxlength="10" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" autocomplete="off"/>
                    * </span></td>
                </tr>
                <tr valign="top" align="left">
                  <td scope="row" colspan="2">&nbsp;</td>
                </tr>
                <tr valign="top" align="left">
                  <td scope="row" colspan="2"><strong class="style9">ÜRÜN VE FATURA TESLİMAT ADRESİNİZ</strong><br />
                      <textarea class="style19" id="adres" name="adres" rows="5" cols="63"></textarea>
                    *</td>
                </tr>
                <tr valign="top" align="left">
                  <td scope="row" colspan="2"><strong class="style9">VARSA ÖZEL MESAJINIZ</strong><br />
                    <textarea class="style19" id="Mesaj" name="Mesaj" rows="5" cols="63"></textarea></td>
                </tr>
                
                <tr valign="top" align="left">
                  <td scope="row">&nbsp;</td>
                  <td><input name="submit" type="submit" class="style9" id="Submit" value="İŞLEMİ TAMAMLA  &gt;&gt;" /></td>
                </tr>
                <tr valign="top" align="left">
                  <td scope="row" colspan="2"><ul>
                      <li class="style9">(*) Lütfen bu işaretin olduğu alanları mutlaka doldurunuz. 
                        Sizinle kolay bir Şekilde irtibat kurabilmemiz için bu gereklidir. </li>
                  </ul></td>
                </tr>
              </tbody>
            </table>
            </div></td>
      </tr>
    </table>
  </form></td>
    </tr>
  </table>
</div>
</body>
</html>
