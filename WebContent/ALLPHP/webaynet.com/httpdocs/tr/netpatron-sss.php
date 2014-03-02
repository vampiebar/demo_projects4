<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--64fa7adcddfc4d3df7f1c289ecf73b1a-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Internet Filtresi, içerik filtreleme programı, Tib Onaylı Filtre programı, Network Kontrol Programı, Webaynet | Netdadı | Netpatron</title>
<link rel="icon" href="http://www.webaynet.com/favicon.gif" type="image/gif" >
<META NAME="description" content="Şirketinizdeki Bilgisayar ağını izleyebileceğiniz, kontrol edebileceğiniz, filtreleme gibi işlemler yapabileceğiniz network kontrol yazılımının resmi web sitesidir." >
<META NAME="keywords" content="Bilgisayar izleme, facebook engelleme, facebook engelle, twitter engelle, network izle, pc izle, takip programı, izleme programı, filtre programı, tib onaylı filtre">
<meta NAME="language" CONTENT="TR">
<meta NAME="rating" CONTENT="General">
<meta NAME="robots" CONTENT="index,follow">
<meta NAME="revisit-after" CONTENT="1 days">
<meta NAME="distribution" CONTENT="global">
<meta name="page-topic" content="içerik filtreleme yazılımı, web filtre yazılımı ve programı, netdadi antiporn programı, tib onaylı filtre programı">
<meta name="CATEGORY" content="Software" >
<style type="text/css">
<!--
body {
	background-color: #a6a6a6;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	text-align: center;
	font-family: Arial, Tahoma, Verdana, Helvetica, sans-serif;
}
a:link {
	text-decoration: none;
	color: a6a6a6;
}
a:visited {
	text-decoration: none;
	color: a6a6a6;
}
a:hover {
	text-decoration: underline;
	color: #39F;
}
a:active {
	text-decoration: none;
	text-align: left;
	color: a6a6a6;
	font-family: Arial, Tahoma, Verdana, Helvetica, sans-serif;
}
.newtext5 {
	font-family: Arial, Tahoma, Verdana, Helvetica, sans-serif;
	font-size: 13px;
	font-weight: bold;
}
.main {
}
-->
</style>
<STYLE type=text/css>
BODY {
	MARGIN: 0px; FONT-FAMILY: Trebuchet MS, Lucida Sans Unicode, Arial, sans-serif
}
.ad {
	RIGHT: 10px; POSITION: absolute; TOP: 10px
}
.dhtmlgoodies_question {
	BACKGROUND-POSITION: right top;
	MARGIN-TOP: 2px;
	PADDING-LEFT: 2px;
	FONT-SIZE: 0.9em;
	BACKGROUND-IMAGE: url(images/backround.png);
	MARGIN-BOTTOM: 2px;
	OVERFLOW: auto;
	WIDTH: 630px;
	CURSOR: pointer;
	COLOR: #000000;
	BACKGROUND-REPEAT: no-repeat;
	HEIGHT: 30px;
	BACKGROUND-COLOR: #FFFFFF
}
.dhtmlgoodies_answer {
	VISIBILITY: hidden;
	OVERFLOW: hidden;
  	MARGIN-LEFT: 33px;
    WIDTH: 550px;
	POSITION: relative;
	HEIGHT: 0px;
	BACKGROUND-COLOR: #e2ebed;
	border: 2px dotted #FF0000;
}
.dhtmlgoodies_answer_content {
	PADDING-RIGHT: 1px; PADDING-LEFT: 1px; FONT-SIZE: 0.9em; PADDING-BOTTOM: 1px; PADDING-TOP: 1px; POSITION: relative
}
.style54 {
	font-size: 13px;
	color: #FF0000;
}
.style55 {
	color: #FF0000;
	font-weight: bold;
}
.newtext51 {font-family: Arial, Tahoma, Verdana, Helvetica, sans-serif;
	font-size: 13px;
	font-weight: bold;
}
.dhtmlgoodies_answer1 {	VISIBILITY: hidden;
	OVERFLOW: hidden;
	WIDTH: 550px;
	POSITION: relative;
	HEIGHT: 0px;
	BACKGROUND-COLOR: #e2ebed;
	border: 2px dotted #FF0000;
}
.style57 {color: #FF0000; font-weight: bold; }
</STYLE>
<SCRIPT type=text/javascript>
/************************************************************************************************************
(C) www.dhtmlgoodies.com, November 2005

This is a script from www.dhtmlgoodies.com. You will find this and a lot of other scripts at our website.	

Terms of use:
You are free to use this script as long as the copyright message is kept intact. However, you may not
redistribute, sell or repost it without our permission.

Thank you!

www.dhtmlgoodies.com
Alf Magne Kalleland

************************************************************************************************************/

var dhtmlgoodies_slideSpeed = 6;	// Higher value = faster
var dhtmlgoodies_timer = 10;	// Lower value = faster

var objectIdToSlideDown = false;
var dhtmlgoodies_activeId = false;
var dhtmlgoodies_slideInProgress = false;
function showHideContent(e,inputId)
{
	if(dhtmlgoodies_slideInProgress)return;
	dhtmlgoodies_slideInProgress = true;
	if(!inputId)inputId = this.id;
	inputId = inputId + '';
	var numericId = inputId.replace(/[^0-9]/g,'');
	var answerDiv = document.getElementById('dhtmlgoodies_a' + numericId);

	objectIdToSlideDown = false;
	
	if(!answerDiv.style.display || answerDiv.style.display=='none'){		
		if(dhtmlgoodies_activeId &&  dhtmlgoodies_activeId!=numericId){			
			objectIdToSlideDown = numericId;
			slideContent(dhtmlgoodies_activeId,(dhtmlgoodies_slideSpeed*-1));
		}else{
			
			answerDiv.style.display='block';
			answerDiv.style.visibility = 'visible';
			
			slideContent(numericId,dhtmlgoodies_slideSpeed);
		}
	}else{
		slideContent(numericId,(dhtmlgoodies_slideSpeed*-1));
		dhtmlgoodies_activeId = false;
	}	
}

function slideContent(inputId,direction)
{
	
	var obj =document.getElementById('dhtmlgoodies_a' + inputId);
	var contentObj = document.getElementById('dhtmlgoodies_ac' + inputId);
	height = obj.clientHeight;
	if(height==0)height = obj.offsetHeight;
	height = height + direction;
	rerunFunction = true;
	if(height>contentObj.offsetHeight){
		height = contentObj.offsetHeight;
		rerunFunction = false;
	}
	if(height<=1){
		height = 1;
		rerunFunction = false;
	}

	obj.style.height = height + 'px';
	var topPos = height - contentObj.offsetHeight;
	if(topPos>0)topPos=0;
	contentObj.style.top = topPos + 'px';
	if(rerunFunction){
		setTimeout('slideContent(' + inputId + ',' + direction + ')',dhtmlgoodies_timer);
	}else{
		if(height<=1){
			obj.style.display='none'; 
			if(objectIdToSlideDown && objectIdToSlideDown!=inputId){
				document.getElementById('dhtmlgoodies_a' + objectIdToSlideDown).style.display='block';
				document.getElementById('dhtmlgoodies_a' + objectIdToSlideDown).style.visibility='visible';
				slideContent(objectIdToSlideDown,dhtmlgoodies_slideSpeed);				
			}else{
				dhtmlgoodies_slideInProgress = false;
			}
		}else{
			dhtmlgoodies_activeId = inputId;
			dhtmlgoodies_slideInProgress = false;
		}
	}
}



function initShowHideDivs()
{
	var divs = document.getElementsByTagName('DIV');
	var divCounter = 1;
	for(var no=0;no<divs.length;no++){
		if(divs[no].className=='dhtmlgoodies_question'){
			divs[no].onclick = showHideContent;
			divs[no].id = 'dhtmlgoodies_q'+divCounter;
			var answer = divs[no].nextSibling;
			while(answer && answer.tagName!='DIV'){
				answer = answer.nextSibling;
			}
			answer.id = 'dhtmlgoodies_a'+divCounter;	
			contentDiv = answer.getElementsByTagName('DIV')[0];
			contentDiv.style.top = 0 - contentDiv.offsetHeight + 'px'; 	
			contentDiv.className='dhtmlgoodies_answer_content';
			contentDiv.id = 'dhtmlgoodies_ac' + divCounter;
			answer.style.display='none';
			answer.style.height='1px';
			divCounter++;
		}		
	}	
}
</SCRIPT>
</head>

<body>
<table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><? include "menubar.php" ?></td>
  </tr>
  <tr>
    <td align="center"><? include "nivoslider.php" ?></td>
  </tr>
  <tr>
    <td align="center"><img src="images/netpatron_sss_baslik.jpg" width="962" height="40" /></td>
  </tr>
  <tr>
    <td align="center" background="images/bigtablebacround.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="2%">&nbsp;</td>
        <td width="96%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="68%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td class="newtext5">SORULARIN YANITLARINI GÖRMEK İÇİN LÜTFEN SORULARIN ÜSTÜNE TIKLAYINIZ</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="center" valign="bottom" bordercolor="#999999"><div class="dhtmlgoodies_question">
                  <div align="left" style="padding-top:8px; padding-left:30px;"><strong>NETPATRON'U KURARKEN KAYIT SERVİSİNE ULAŞILAMADI MESAJI GELİYOR ?</strong></div>
                </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <div align="left">
                        <p align="left">Bu durumu oluşturan birden fazla sebep vardır. Öncelikle internet bağlantınız yoksa bu mesajı almanız normaldir, çünkü <strong>NETPATRON</strong> Internet olan Pc lerde kurulabilir. Kurulum bittikten sonra tabiki Interneti kapatabilirsiniz. </p>
                        <p align="left">Bir başka sebebide Virüs Koruma veya Firewall programınız <strong>NETPATRON</strong> nın Internete bağlanmasını engelliyor olabilir. Bu durumda Virüs Koruma veya Firewall programının kontrol paneline girip <strong>NETPATRON</strong> yazılımını istisna yazılımlar listesine eklemelisiniz.</p>
                      </div>
                    </div>
                  </div>
                  <div class="dhtmlgoodies_question">
                    <div align="left" style="padding-top:8px; padding-left:30px;"><strong>CLIENT (TERMİNAL) PC YE KURMAYA ÇALIŞIYORUM AKTİVASYON KODU İSTİYOR ?</strong></div>
                  </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <div align="left">
                        <p>Öncelikle server uygulamasını kurmalısınız. Server uygulamasını kurduktan sonra, server uygulaması açıkken <strong>client</strong>(terminal) Pc ye client uygulamasını rahatlıkla kurabilirsiniz. Bütün işlemleri otomatik yapar. </p>
                        <p>Tabiki Server olmadan da kurabilirsiniz, ancak programı ilk kez kurarken her zaman server önce kurulmalıdır. Server uygulamasını bir kez kurduktan sonra server kapalı bile olsa, server için verilen <strong>Aktivasyon Kodunu</strong> girerek clienti de kurabilirsiniz.</p>
                      </div>
                    </div>
                  </div>
                  <div class="dhtmlgoodies_question">
                    <div align="left" style="padding-top:8px; padding-left:30px;"><strong>CLİENT'LERİ KURDUM AMA SERVER DA GÖREMİYORUM ?</strong></div>
                  </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <p align="left">Clientler çalışıyor olmasına rağmen server da terminalleri göremiyorsanız muhtemelen Bilgisayarlarda kurulu olan Virüs koruma veya Firewall uygulamaları <strong>NetPATRON</strong> uygulamasının haberleşmesini engelliyorlardır. </p>
                      <p align="left">Programımızın Networkünüzde problemsiz çalışabilmesi için güvenlik yazılımlarına tanımlanması gerekir. Yani istisna listelerine eklenmelidir.</p>
                    </div>
                  </div>
                  <div class="dhtmlgoodies_question">
                    <div align="left" style="padding-top:8px; padding-left:30px;"><strong>BENİM BAŞKA ŞEHİRDE 5 CLIENT PC DAHA VAR, BUNLARI SERVERDA NASIL GÖREBİLİRİM ?</strong></div>
                  </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <div align="left">
                        <p>Diyelim ki 15 lisanslık ürünümüzü aldınız, bunlardan 10 tanesi mevcut merkez binanızda ise, 5 tanesi de bir başka şehirde yada semtte ise onlarıda merkezde bulunan server uygulamasından görebilirsiniz ve kontrol edebilirsiniz. </p>
                        <p>Local Network'ünüz de ki Pc leri nasıl kontrol edebiliyorsanız Wan da bulunan Pc leride aynı şekilde işlem yapabilirsiniz.</p>
                        <p>Bu işlemin sağlıklı olabilmesi için <strong>NetPATRON</strong> server uygulamasının bulunduğu <strong>Network</strong>'te ki Modem de iki adet portun server uygulamasının yüklendiği Pc ye yönlerndirilmiş olması gerekir. Bunun <span class="style57">4868</span> ve <span class="style57">4867</span> nolu ve <span class="style57">TCP/UDP</span> portlar olmak üzere server uygulamasının bulunduğu Pc nin ip adresine yölendiriliyor olması gerekir. Aksi takdirde dış Netwrok te bulunan clientlerinizi izleyemez ve kontrol edemezsiniz.</p>
                        <p align="center"><img src="images/MODEM.png" width="500" height="257" /></p>
                        <p>Bu ayarlamayı sadece <strong>Server</strong> uygulamasının olduğu Networkte yapmak gerekir. <strong>Client</strong>lerin olduğu Networkte bu tip bir işleme gerek bulunmamaktadır.</p>
                        <p>Bu özellik Dünya da sadece <strong>NetPATRON</strong> programında mevcuttur.</p>
                      </div>
                    </div>
                  </div>
                  <div class="dhtmlgoodies_question">
                    <div align="left" style="padding-top:8px; padding-left:30px;"><strong>ŞİRKETİMİZDEKİ TÜM KULLANICILARA FARKLI KISITLAMALAR UYGULAYABİLİYİZ ?</strong></div>
                  </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <div align="left">Tabiki uygulayabilirsiniz. Her bir kullanıcının çalıştırabileceği programları ayrı ayrı tanımlayabilirsiniz. Her bir kullanıcının girebilecekleri siteleri hepsine ayrı şekilde tanımlayabilirsiniz. Tüm kullanıcılara farklı saatlerde Bilgisayar veya internet kullanımını kısıtlayabilirsiniz. Tüm raporlama işlemleride her bir kullanıcının ayrı şekilde düzenlenir ve bilginize sunulur.</div>
                    </div>
                  </div>
                  <div class="dhtmlgoodies_question">
                    <div align="left" style="padding-top:8px; padding-left:30px;"><strong>TÜM KULLANICILARIN SADECE BENİM SEÇTİĞİM SİTELERDE KALMALARINI NASIL SAĞLARIM ?</strong></div>
                  </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <div align="left">
                        <p>Tüm kullanıcılarınız veya sadece sizin seçeceğiniz kullanıcıları sizin arzuladığınız siteler içinde dolaşmalarını kolaylıkla yapabilirsiniz. </p>
                        <p>Bunu yapmak için <strong>NetPATRON</strong> server uygulamasını açınız, burada <strong>Yönetici Tanımlı Adresler</strong> isimli kısma giriniz. Buradan da <strong>Güvenli Özel Alan</strong> bölümüne geçiniz. Kullanıcıların hangi sitelerde kalmalarını istiyorsanız o siteleri buradaki listeye ekleyiniz ve sonrada uygula Butonuna basınız. Butona bastığınızda karşınıza hangi Pc ve kullanıcılar için uygulanmasını istediğinizi soracaktır. Sizde arzunuza göre ister tüm Bilgisayarlara isterseniz de sadece sizin seçtiğiniz Pc lere bu kuralın gönderilmesini sağlayabilirsiniz. Hatta her bir kullanıcı için farklı güvenli özel alanlar oluşturabilirsiniz.</p>
                      </div>
                    </div>
                  </div>
                  <div class="dhtmlgoodies_question">
                    <div align="left" style="padding-top:8px; padding-left:30px;"><strong>KULLANICILARIN PAYDOS DIŞINDA INTERNETE ÇIKMALARINI NASIL ENGELLERİM ?</strong></div>
                  </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <div align="left">Şirket çalışanlarınızın mesayi saati içinde internete girmelerini istemiyorsanız bunu rahatlıkla yapabilirsiniz. Bunun için <strong>NetPATRON</strong> server uygulamasına giriniz, daha sonra süre kısıtlamaları bölümüne giriniz. Burada internet <strong>süre sınırlaması </strong>kısmı gelecektir. Hangi saatlerde internetin yasak olmasını istiyorsanız bu tablodaki kutucukları yasaklayarak kullanıcıların sizin belirlediğiniz saatler arasında neti kullanmalarını sağlayabilirsiniz.</div>
                    </div>
                  </div>
                  <div class="dhtmlgoodies_question">
                    <div align="left" style="padding-top:8px; padding-left:30px;"><strong>KULLANICILARIN MSN VEYA SOHBET PROGRAMI KULLANMALARINI NASIL ENGELLERİM</strong> ?</div>
                  </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <div align="left">
                        <p>Kullanıcılarınızın msn veya sohbet programlarını kullanmalarını engelleyebilirsiniz. Bu işlemi yapabilmek için <strong>NetPATRON</strong> server programında Program yasaklamaları bölümüne girerek yasaklanmasını istediğiniz programı seçebilirsiniz veya kurulu olduğu yerden direkt yasaklayabilirsiniz. Bu yasağı dilediğiniz kullanıcıya veya tüm kullanıcılara tek bir tıklama ile uygulayabilirsiniz.</p>
                      </div>
                    </div>
                  </div>
                  <div class="dhtmlgoodies_question">
                    <div align="left" style="padding-top:8px; padding-left:30px;"><strong>NETPATRON PROGRAMINI NASIL KALDIRABİLİRİM ?</strong></div>
                  </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <div align="left"><strong>NetPATRON</strong> Programını yalnızca kendi içinden kaldırabilirsiniz. Programı kaldırmak için yönetici parolanız ile giriş yapmalısınız. Daha sonra programı kapat veya kaldır bölümünden ister kapatabilir, isterseniz de tamamen kaldırabilirsiniz. Tüm bu işlemler sadece <strong>Yönetici parolası</strong> ile yapılabilir.</div>
                    </div>
                  </div>
                  <div class="dhtmlgoodies_question">
                    <div align="left" style="padding-top:8px; padding-left:30px;"><strong>PROGRAMDA GÜNCELLEMELER NE SIKLIKLA YAPILIYOR ?</strong></div>
                  </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <div align="left"><strong>NetPATRON</strong> Programında güncelleme gün içinde sürekli yapılabilir. Sürekli kötü içerikli siteler açıldığından dolayı güncelleme işlemleri belirli peryodlarda olmaz. Günün herhangi bir saatin de veritabanı güncellemesi yapılabilir. Bu işlemlerin tamamı otomatik olarak kullanıcıdan habersiz yapılır.</div>
                    </div>
                  </div>
                  <script type="text/javascript">
initShowHideDivs();
showHideContent(false,1);	// Automatically expand first item
                                                                                   </script></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
            <td width="3%">&nbsp;</td>
            <td width="29%" valign="top"><table width="241" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" >&nbsp;</td>
                </tr>
              <tr>
                <td align="center"><img src="images/npmini.png" alt="" width="200" height="180" border="0" /></td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><table width="241" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="26" align="center" background="images/minibuton.png"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="11%">&nbsp;</td>
                        <td width="85%" align="left" class="newtext51"><a href="netpatron-ozellikler.php">NetPATRON Genel Özellikler</a></td>
                        <td width="4%">&nbsp;</td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="26" align="center" background="images/minibuton.png"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="11%">&nbsp;</td>
                        <td width="85%" align="left" class="newtext51"><a href="netpatron-hakkinda.php#npekran" title="Netpatron Ekran görüntüleri">Ekran Görüntüleri</a></td>
                        <td width="4%">&nbsp;</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td height="26" align="center" background="images/minibuton.png"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="11%">&nbsp;</td>
                        <td width="85%" align="left" class="newtext51"><a href="referanslar.php">Referanslarımız</a></td>
                        <td width="4%">&nbsp;</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td height="26" align="center" background="images/minibuton.png"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="11%">&nbsp;</td>
                        <td width="85%" align="left" class="newtext51"><a href="netpatron-siparis.php">Ürünü Sipariş Ver</a></td>
                        <td width="4%">&nbsp;</td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="26" align="center" background="images/minibuton.png"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="11%">&nbsp;</td>
                        <td width="85%" align="left" class="newtext51"><a href="http://www.webaynet.com/download/NetPKur.exe">Kurulum Dosyasını İndir</a></td>
                        <td width="4%">&nbsp;</td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
              </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
        <td width="2%">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><img src="images/incebar.jpg" width="962" height="17" /></td>
  </tr>
  <tr>
    <td align="center"><img src="images/bigtable_alt.jpg" width="962" height="29" /></td>
  </tr>
  <tr>
    <td align="center"><? include "altmenu.php" ?></td>
  </tr>
</table>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try{ 
var pageTracker = _gat._getTracker("UA-557668-2");
pageTracker._trackPageview();
} catch(err) {} 
</script>
</body>
</html>
