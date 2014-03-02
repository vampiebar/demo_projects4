<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--64fa7adcddfc4d3df7f1c289ecf73b1a-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Internet Filtresi, içerik filtreleme programı, Tib Onaylı Filtre programı, Network Kontrol Programı, Webaynet | Netdadı | Netpatron</title>
<link rel="icon" href="http://www.webaynet.com/favicon.gif" type="image/gif" >
<META NAME="description" content="TİB Onaylı filtre programı Netpatron cafe sürümü hakkında sık sorulan sorular sayfamız." >
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
.dhtmlgoodies_answer2 {	VISIBILITY: hidden;
	OVERFLOW: hidden;
	WIDTH: 550px;
	POSITION: relative;
	HEIGHT: 0px;
	BACKGROUND-COLOR: #e2ebed;
	border: 2px dotted #FF0000;
}
.highslide {cursor: url(http://www.webaynet.com/highslide/graphics/zoomin.cur), pointer;
    outline: none;
}
.highslide {cursor: url(http://www.webaynet.com/highslide/graphics/zoomin.cur), pointer;
    outline: none;
}
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
    <td align="center"><img src="images/netpatrontib_sss_baslik.jpg" width="962" height="40" /></td>
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
                <td align="center" valign="bottom" bordercolor="#999999">
                <div class="dhtmlgoodies_question">
                  <div align="left" style="padding-top:8px; padding-left:30px;"><strong>CLİENT PC YE KURULUM YAPTIM AMA TASKBAR DA KISAYOLU GÖREMİYORUM ?</strong></div>
                </div>
                  <div class="dhtmlgoodies_answer2">
                    <div>
                      <div align="left">
                        <p align="left">Client Pc lerde kurulumdan sonra Netpatron ikonu gizli konumda çalışır. Client pc lerde Netpatron'u Açmak için masa üstünde iken <br />
                          <span class="style55">CTRL + SHIFT + F4</span> tuşlarına aynı anda basmalısınız. Giriş ekranı gelecektir. </p>
                      </div>
                    </div>
                  </div>
                <div class="dhtmlgoodies_question">
                  <div align="left" style="padding-top:8px; padding-left:30px;"><strong>NETPATRON'U KURARKEN KAYIT SERVİSİNE ULAŞILAMADI MESAJI GELİYOR ?</strong></div>
                </div>
                  <div class="dhtmlgoodies_answer2">
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
                  <div class="dhtmlgoodies_answer2">
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
                  <div class="dhtmlgoodies_answer2">
                    <div>
                      <p align="left">Clientler çalışıyor olmasına rağmen server da terminalleri göremiyorsanız muhtemelen Bilgisayarlarda kurulu olan Virüs koruma veya Firewall uygulamaları <strong>NetPATRON</strong> uygulamasının haberleşmesini engelliyorlardır. </p>
                      <p align="left">Programımızın Networkünüzde problemsiz çalışabilmesi için güvenlik yazılımlarına tanımlanması gerekir. Yani istisna listelerine eklenmelidir.</p>
                    </div>
                  </div>
                  
                  <div class="dhtmlgoodies_question">
                    <div align="left" style="padding-top:8px; padding-left:30px;"><strong>SİTELER ENGELLENDİĞİNDE BİR KAÇ FARKLI UYARI MESAJI ÇIKIYOR, BUNUN ANLAMI NEDİR ?</strong></div>
                  </div>
                  <div class="dhtmlgoodies_answer2">
                    <div>
                      <div align="left">
                        <p>Bir site engellendiğinde aşağıdaki mesaj çıkıyor ise yasaklanan bu site <strong>NetPATRON</strong> Programının kendi kara listesinde olduğunu gösterir. Bu siteyi arzu ederseniz Yönetici tanımlı adresler bölümünden Serbest siteler kısmına ekleyerek kullanıcıların bu siteye girmemesini sağlayabilirsiniz.</p>
                        <p align="center"><a id="thumb1" href="http://www.webaynet.com/tr/images/stopbllmsg.png" class="highslide" onclick="return hs.expand(this)"> <img src="http://www.webaynet.com/tr/images/stopbllmsg_saml.png" alt="NETPATRON KARA LİSTESİ"
		title="BÜYÜK HALİ İÇİN TIKLAYINIZ" height="117" width="150" /></a></p>
                        <p>Bir site engellendiğinde aşağıdaki mesajı aldığınızda bu site içerik filtresinden yakalanmış demektir. Yani programa webaynet yazılım veya sizin tanımladığınız yasaklı kelimelerden engellenmiş demektir. Bu filtreleme sistemi Filtre ayarları kısmından içerik filtresi kapatılırsa dururulabilir.</p>
                        <p align="center"><a id="thumb1" href="../images/stopicerikmsg.png" class="highslide" onclick="return hs.expand(this)"> <img src="../images/stopicerikmsg_smal.png" alt="NETPATRON KARA LİSTESİ"
		title="BÜYÜK HALİ İÇİN TIKLAYINIZ" height="117" width="150" /></a></p>
                        <p>Bir site engellendiğinde aşağıdaki mesajı aldığınızda sizin tarafınızdan güvenli özel alan filtresi aktif edilmiş demektir. Yalnızca izinli sitelere giriş olduğundan dolayı diğer tüm siteler engellenmektedir.</p>
                        <p align="center"><a id="thumb1" href="../images/stopytamsg.png" class="highslide" onclick="return hs.expand(this)"> <img src="../images/stopytamsg_smal.png" alt="NETPATRON KARA LİSTESİ"
		title="BÜYÜK HALİ İÇİN TIKLAYINIZ" height="117" width="150" /></a></p>
                        <p>Bir site engellendiğinde Aşağıdaki mesajı alıyorsanız Bu site adresi Telekomünikasyon İletişim Başkanlı (T.İ.B.) Tarafından engellenmiş demektir. Bu siteyi hiç bir şekilde serbest bırakamaz ve sitenin görüntülenmesini sağlayamazsınız. Bir sitenin TİB tarafından yasaklanıp yasaklanmadığının anlaşılmasının bir başka yoluda, TİB engelinde hiç bir şekilde NETPATRON logosu bulunmaz.</p>
                        <p align="center"><a id="thumb1" href="../images/stoptibmsg.png" class="highslide" onclick="return hs.expand(this)"> <img src="../images/stoptibmsg_smal.png" alt="NETPATRON KARA LİSTESİ"
		title="BÜYÜK HALİ İÇİN TIKLAYINIZ" height="116" width="150" /></a><br />
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="dhtmlgoodies_question">
                    <div align="left" style="padding-top:8px; padding-left:30px;"><strong>TÜM KULLANICILARIN SADECE BENİM SEÇTİĞİM SİTELERDE KALMALARINI NASIL SAĞLARIM ?</strong></div>
                  </div>
                  <div class="dhtmlgoodies_answer2">
                    <div>
                      <div align="left">
                        <p>Tüm kullanıcılarınız veya sadece sizin seçeceğiniz kullanıcıları sizin arzuladığınız siteler içinde dolaşmalarını kolaylıkla yapabilirsiniz. </p>
                        <p>Bunu yapmak için <strong>NetPATRON</strong> server uygulamasını açınız, burada <strong>Yönetici Tanımlı Adresler</strong> isimli kısma giriniz. Buradan da <strong>Güvenli Özel Alan</strong> bölümüne geçiniz. Kullanıcıların hangi sitelerde kalmalarını istiyorsanız o siteleri buradaki listeye ekleyiniz ve sonrada uygula Butonuna basınız. Butona bastığınızda karşınıza hangi Pc ve kullanıcılar için uygulanmasını istediğinizi soracaktır. Sizde arzunuza göre ister tüm Bilgisayarlara isterseniz de sadece sizin seçtiğiniz Pc lere bu kuralın gönderilmesini sağlayabilirsiniz. Hatta her bir kullanıcı için farklı güvenli özel alanlar oluşturabilirsiniz.</p>
                      </div>
                    </div>
                  </div>
                  <div class="dhtmlgoodies_question">
                    <div align="left" style="padding-top:8px; padding-left:30px;"><strong>FİLTREYE TAKILAN BİR SİTEYİ NASIL SERBEST BIRAKABİLİRİM ?</strong></div>
                  </div>
                  <div class="dhtmlgoodies_answer2">
                    <div>
                      <div align="left">Filtreye takılan bir siteyi <strong>Yönetici Tanımlı Adresler</strong> bölümündeki <strong>serbest siteler</strong> kısmına ekleyerek açılmasını sağlayabilirsiniz. Eğer bu site <strong>T.İ.B.</strong> Kurumu tarafından engellenmişse hiç bir şekilde serbest bırakılamaz.</div>
                    </div>
                  </div>
                  <div class="dhtmlgoodies_question">
                    <div align="left" style="padding-top:8px; padding-left:30px;"><strong>İÇERİK FİLTRESİNE BENDE BAZI KELİMELER EKLEMEK İSTİYORUM, BUNU NASIL YAPARIM</strong> ?</div>
                  </div>
                  <div class="dhtmlgoodies_answer2">
                    <div>
                      <div align="left">
                        <p>Programın İçerik Filtresi için tanımlanan yasaklı kelimeler <strong>webaynet</strong> tarafından yapılmaktadır. Buna ek olarak sizinde kelime ekleyebilmeniz için <strong>Filtre Ayarları</strong> kısmında <strong>Yönetici Tanımlı Kelimeler</strong> bölümünü sizin kullanımınıza aşmıştır. Buraya yasaklamak istediğiniz kelimeleri karışalarına puan atayarak ekleyebilirsiniz. Tavan Puan <strong>200</strong> Dür. Yani eklediğiniz keliemeler bir site içinde geçiyorsa ve sizin verdiğiniz puan toplamı <strong>200</strong> oluyorsa o site içerik filtresi tarafından engellenir. Bundan dolayı puanları verirken dikkatli olmak gerekir. Puanlama çok yüksek yapılır ise normal sitelerde engellenebilir.</p>
                      </div>
                    </div>
                  </div>
                  <div class="dhtmlgoodies_question">
                    <div align="left" style="padding-top:8px; padding-left:30px;"><strong>T.İ.B. ONAYLI NETPATRON PROGRAMINI NASIL KALDIRABİLİRİM ?</strong></div>
                  </div>
                  <div class="dhtmlgoodies_answer2">
                    <div>
                      <div align="left"><strong>TİB Onaylı NetPATRON</strong> Programını kapatamaz ve kaldırmazsınız. Kurulduktan sonra sürekli çalışacak şekilde yapılmıştır. Bu durumun olmasının sebebi TİB Kriterlerinin bu şekilde istemesinden dolayıdır.<br />
                        <br />
                        Buna rağmen programı geçici bir süreliğine kaldırmak istediğiniz de Bilgisayarınızı <strong>güvenli modda</strong> açınız ve <strong>Program Files</strong> içindeki <strong>NetpatronTIB</strong> klasörünü siliniz. Program tamamen kalkmış olacaktır. </div>
                    </div>
                  </div>
                  <div class="dhtmlgoodies_question">
                    <div align="left" style="padding-top:8px; padding-left:30px;"><strong>PROGRAMDA GÜNCELLEMELER NE SIKLIKLA YAPILIYOR ?</strong></div>
                  </div>
                  <div class="dhtmlgoodies_answer2">
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
                <td align="center"><img src="images/npcc.png" alt="" width="208" height="248" border="0" /></td>
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
                        <td width="85%" class="newtext51"><a href="netpatron-tib-ozellikleri.php">TİB Onaylı  Filtre Özellikleri</a></td>
                        <td width="4%">&nbsp;</td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="26" align="center" background="images/minibuton.png"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="11%">&nbsp;</td>
                        <td width="85%" class="newtext51"><a href="netpatrontib-hakkinda.php#npccekran" title="Netpatron Ekran görüntüleri">Ekran Görüntüleri</a></td>
                        <td width="4%">&nbsp;</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td height="26" align="center" background="images/minibuton.png"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="11%">&nbsp;</td>
                        <td width="85%" class="newtext51"><a href="http://www.webaynet.com/tr/cafelist/">Ürünümüzü Kullanan Cafeler</a></td>
                        <td width="4%">&nbsp;</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td height="26" align="center" background="images/minibuton.png"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="11%">&nbsp;</td>
                        <td width="85%" class="newtext51"><a href="http://www.tib.gov.tr/tr/tr-menu-55-ip_log_imzalayici_programi.html" target="_blank">İç IP Log İmzalayıcı</a></td>
                        <td width="4%">&nbsp;</td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="26" align="center" background="images/minibuton.png"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="11%">&nbsp;</td>
                        <td width="85%" class="newtext51"><a href="http://www.webaynet.com/download/NetPatronCC.exe">Kurulum Dosyasını İndir</a></td>
                        <td width="4%">&nbsp;</td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="26" align="center" background="images/minibuton.png"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="11%">&nbsp;</td>
                        <td width="85%" class="newtext51"><a href="netpatron-tib-siparis.php">Ürünü Sipariş Ver</a></td>
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
