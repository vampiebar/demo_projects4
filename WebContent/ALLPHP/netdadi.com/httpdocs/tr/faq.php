<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NETDADI Internet filter Sık Sorulan Sorular</title>
<meta http-equiv="Page-Enter" content="blendTrans(duration=.5)">
<meta http-equiv="Content-Style-Type" content="text/css">
<LINK HREF="style.css" TYPE="text/css" REL="stylesheet"> 
<link rel="shortcut icon" href="http://www.webaynet.com/favicon.ico" type="image/x-icon" />
<META NAME="description" content="WEBAYNET YAZILIM ®: Gençlerimizi ve çocuklarımızı Internetin olumsuzlukların koruyan dünyanın en iyi ve en kapsamlı Programı. ŞİRKETİNİZİ VE NETWORKÜNÜZÜ GÜVEMLE KONTROL EDEBİLİRSİNİZ." >
<META NAME="keywords" content="web filtresi, internet filtresi, onaylı filtre programı, onaylı filtre programları, onaylı filitre programı, onaylı filitre programları,porno engelleyici, antiporn, anti-porn, yasak site filtresi, web filter, ınternet filter, computer controls, content filter, parentenal control, kiosk makine, kiosk, netdadi, NETPATRON, netpatron, network manager, NETDADI, internet cafe yönetim yazılımı, internet cafe, cafe yazılımı, cyber cafe, internet cafe management software, internet cafe timer, cafe software, client, server, internet cafe program, onaylı filtre programları, onaylı filtre programı, onaylı filitre programları, onaylı filitre programı">
<meta NAME="copyright" CONTENT="WEBAYNET ® 2006 - 2009">
<meta NAME="language" CONTENT="TR">
<meta NAME="rating" CONTENT="General">
<meta NAME="robots" CONTENT="index,follow">
<meta NAME="revisit-after" CONTENT="1 days">
<meta NAME="distribution" CONTENT="global">
<meta NAME="author" CONTENT="WEBAYNET® Software">
<meta name="page-topic" content="Birinci Sınıf Yazılımlar">
<meta name="CATEGORY" content="Software" >
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
</STYLE>

</head>

<body background="images/backroundicsayfa.jpg">
<table width="820" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><a name="enust" id="enust"></a><? include "ustmenu.php" ?></td>
  </tr>
  <tr>
    <td align="center"><img src="images/sssbaslik.jpg" width="822" height="36" /></td>
  </tr>
  <tr>
    <td align="center" valign="top" background="images/buyuktablo_orta.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="2%">&nbsp;</td>
        <td width="95%" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="style19 style54"><div align="center">SORULARIN YANITLARINI GÖRMEK İÇİN LÜTFEN SORULARIN ÜSTÜNE TIKLAYINIZ</div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="center" valign="bottom" bordercolor="#999999"><div class="dhtmlgoodies_question">
              <div align="left" style="padding-top:5px; padding-left:30px;"><strong>NETDADI'YI KURARKEN KAYIT SERVİSİNE ULAŞILAMADI MESAJI GELİYOR ?</strong></div>
            </div>
              <div class="dhtmlgoodies_answer">
                <div>
                  <p align="left">Bu durumu oluşturan birden fazla sebep vardır. Öncelikle internet bağlantınız yoksa bu mesajı almanız normaldir, çünkü <strong>NETDADI</strong> Internet olan Pc lerde kurulabilir. Kurulum bittikten sonra tabiki Interneti kapatabilirsiniz. </p>
                  <p align="left">Bir başka sebebide Virüs Koruma veya Firewall programınız <strong>NETDADI</strong> nın Internete bağlanmasını engelliyor olabilir. Bu durumda Virüs Koruma veya Firewall programının kontrol paneline girip <strong>NETDADI</strong> yazılımını istisna yazılımlar listesine eklemelisiniz.</p>
                </div>
              </div>
              <div class="dhtmlgoodies_question">
                <div align="left" style="padding-top:8px; padding-left:30px;"><strong>KURULUMU BİTİRDİM, NETDADI UYGULAMASINI NASIL AÇACAĞIM ?</strong></div>
              </div>
              <div class="dhtmlgoodies_answer">
                <div>
                  <div align="left">Kurulum bittikten sonra program otomatik olarak zaten çalışacaktır. Bilgisayarınızın saat sekmesinin yanına ikonu yerleşir. Bu ikona tıkladığınızda programın giriş menüsü gelecektir. Buraya kurulumda belirlediğiniz parolayı yazarak <strong>NETDADI</strong> nın kontrol paneline girebilirsiniz.</div>
                </div>
              </div>
              <div class="dhtmlgoodies_question">
                <div align="left" style="padding-top:8px; padding-left:30px;"><strong>NETDADI İKONUNU GİZLEMİŞTİM, GERİ GETİREMİYORUM, NE YAPMALIYIM </strong>?</div>
              </div>
              <div class="dhtmlgoodies_answer">
                <div>
                  <p align="left"><strong>NetDADI</strong> ikonunu gizlemişseniz ve çağırmak için kısayolunu unutmuşsanız öncelikle varsayılan kısayolu bir denemelisiniz. Eğer değiştirmediyseniz programın ikonunu yeniden çağırmak için <strong>CTRL + SHIFT + F4</strong> tuşlarına aynı anda basmalısınız. Eğer bunu yaptığınızda da gelmiyor ise <strong>CTRL + SHIFT + F5-F6-F7.....F12</strong> gibi diğer <strong>F</strong> tuşlarını da denemelisiniz. </p>
                  <p align="left">Buna Rağmen hala programın giriş menüsü gelmiyor ise Bilgisayarınızı Güvenli Modda Açmalısınız, daha sonra Program Files içindeki <span class="style55">Netdadi</span> klasörünü silmelisiniz. Daha sonra Bilgisayarı normal bir şekilde açıp <strong>NETDADI</strong>'yı yeniden kurmalısınız.</p>
                </div>
              </div>
              <div class="dhtmlgoodies_question">
                <div align="left" style="padding-top:8px; padding-left:30px;"><strong>NETDADI'YA GİRİŞ PAROLAMIZI UNUTTUM, NE YAPABİLİRİM ?</strong></div>
              </div>
              <div class="dhtmlgoodies_answer">
                <div>
                  <div align="left">
                    <p><strong>NetDADI V1.0</strong> Kullanıyorsanız; Parolanızı unuttuğunuzda Bilgisayarınızı <strong>Güvenli Modda</strong> açınız. Daha sonra Programı kurduğunuz klasörü siliniz. Eğer kurulumda değiştirmediyseniz Program kendisini otomatik olarak <strong>Program Files</strong> içinde <span class="style55">Netdadi</span> isminde kurar. <strong>Güvenli Modda</strong> bu klasörü siliniz. Daha sonra Bilgisayarınızı normal olarak açınız ve <strong>NetDADI</strong> Programını yeniden kurunuz. Kurulum parolasını da unutmuşsanız <span class="style55">destek@netdadi.com</span> adresine Aktivasyon kodunuzu da belirterek parolanızı isteyiniz. </p>
                    <p><strong>NetDADI V2.0</strong> Kullanıyorsanız; programın parola giriş menüsün de Parolamı Unuttum linkini tıklayınız. Açılan pencere de kayıtta kullandığınız e-posta adresi çıkacaktır. Parolamı iste Butonuna bastığınızda program giriş parolanız e-posta adresinize otomatik olarak gönderilecektir. Burda unutulmaması gereken parolanın yalnızca burada yazan e-posta adresine gönderilebilir. Parola isteme işlemini yapmanıza rağmen hala e-posta adresinize parola hatırlatma maili gelmiyorsa, mail hesabınızın <strong>süzgeç,junkmail,spam</strong> gibi bölümlerine bakmayı unutmayınız.</p>
                  </div>
                </div>
              </div>
              <div class="dhtmlgoodies_question">
                <div align="left" style="padding-top:8px; padding-left:30px;"><strong>BAZI WEB SİTELERİNİN ENGELLENMESİNİ İSTEMİYORUM, NE YAPMALIYIM ?</strong></div>
              </div>
              <div class="dhtmlgoodies_answer">
                <div>
                  <div align="left"><strong>NetDADI</strong> Programı biz insanlar tarafından geliştirilmiştir. Bundan dolayı programın kriterlerinide bir insan yapmıştır. Bazı sitelerin müstehcenlik derecesi kişilere göre değişmektedir. Bundan dolayı program tarafından yasaklanmış, ancak sizin tarafınızda bir sakınca bulunmadığını düşündüğünüz siteleri programın <strong>Yönetici Tanımlı Adresler</strong> bölümünde bulunan <strong>Serbest sitelere</strong> ekleyerek bu sitelerin filtreye takılmamasını sağlayabilirsiniz. Aynı şekilde program tarafından tespit edilememiş kötü içerikli bir siteyi de <strong>Yasak Siteler</strong> bölümünden yasaklayabilirsiniz.</div>
                </div>
              </div>
              <div class="dhtmlgoodies_question">
                <div align="left" style="padding-top:8px; padding-left:30px;"><strong>PROGRAM BAZEN İÇERİĞİNDE KÖTÜ KELİMELER OLMAYAN SİTELERİ DE ENGELLİYOR ?</strong></div>
              </div>
              <div class="dhtmlgoodies_answer">
                <div>
                  <div align="left">
                    <p><strong>NetDADI</strong> Programı içeriğinde kötü kelimeler olmayan bir siteyi asla yasaklamaz. Çünkü <strong>NetDADI</strong> programına tanımlı yasak kelimeler çok edep dışı kelimelerden oluşur. Yani program sex kelimesini gördü diye bir siteyi engellemez. Çok daha kötü kelime ve cümleleri tarayarak karar verir bir sitenin engellenmesine. Bu sebeple eğer bir site engellenmişse ve siz o sitenin içeriğinde bir şey olmadığını düşünüyorsanız, siteyi güvenli siteler listesine ekleyebilrisiniz. </p>
                    <p>Internette bir çok site arama motorlarında üst sıralarda çıkmak için sitelerinin meta tag dediğimiz ve sizin tarafınızdan asla görünmeyen bölümlerine bir çok kötü ve yasak kelime dediğimiz cümlecikleri yazarlar. İşte sizin içeriğini iyi sandığınız bir sitenin Filtre programımıza takılmasının sebebi budur. Aksi durumda <strong>NetDADI</strong> içeriği genel toplumca aşırı edep dışı kelimeler barındırmadıkça yasaklamaz.</p>
                  </div>
                </div>
              </div>
              <div class="dhtmlgoodies_question">
                <div align="left" style="padding-top:8px; padding-left:30px;"><strong>BAZEN KULLANICININ EKRAN KAYDINI İZLEMEK İSTEDİĞİMDE GÖRÜNTÜ OLMUYOR ?</strong></div>
              </div>
              <div class="dhtmlgoodies_answer">
                <div>
                  <div align="left">Programda ekran kaydını açtığınız halde ve kullanıcının görüntülerinin olması gerektiği hallerde <strong>NetDADI</strong> programında ekran kaydı izlemede beyaz bir ekran görüyorsanız bunun sebebi DB(Veri tabanı) bozulmasıdır. Veritabanı bozulması ani elektrik kesintilerinde ve Bilgisayarın resetlenmesi sebebi ile oluşur. Çünkü görüntü veritabanına kayıt edilirken sabit disk yazmakta olduğu için veriler karışır ve artık doğru bir şekilde kayıt etmez. Bu durumda programı kaldırıp yeniden kurmanız faydalı olacaktır.</div>
                </div>
              </div>
              <div class="dhtmlgoodies_question">
                <div align="left" style="padding-top:8px; padding-left:30px;"><strong>PROGRAMI AKTİF ETTİĞİM HALDE BAZI KULLANICILAR PROGRAMI KAPATABİLİYORLAR ?</strong></div>
              </div>
              <div class="dhtmlgoodies_answer">
                <div>
                  <div align="left">
                    <p><strong>NetDADI</strong> Programı kullanıcı tarafından kapatılamayacak şekilde dizayn edilmiştir. Ayrıca programın hiç bir dosyası silinemez. </p>
                    <p>Ancak <strong>Güvenli Mod</strong> dediğimiz bölümde ise program her türlü kapatılabilir ve silinebilir. Kullanıcı eğer <strong>Güvenli Moda</strong> girebiliyor ise zaten Bilgisayar yöneticisi demektir. Bilgisayar yöneticisi de istediği herşeyi yapabilir demektir. Bundan dolayı kullanıcıların <strong>Windows</strong> hesabını Sınırlı Kullanıcı yapmalısınız. <strong>Administrator</strong> bölümüne ise sadece sizin bileceğiniz bir parola vermelisiniz. Bu şekilde kullanıcılar <strong>Güvenli Moda</strong> giremez ve programı asla kapatamaz.</p>
                  </div>
                </div>
              </div>
              <div class="dhtmlgoodies_question">
                <div align="left" style="padding-top:8px; padding-left:30px;"><strong>NETDADI PROGRAMINI NASIL KALDIRABİLİRİM ?</strong></div>
              </div>
              <div class="dhtmlgoodies_answer">
                <div>
                  <div align="left"><strong>NetDADI</strong> Programını yalnızca kendi içinden kaldırabilirsiniz. Programı kaldırmak için yönetici parolanız ile giriş yapmalısınız. Daha sonra programı kapat veya kaldır bölümünden ister kapatabilir, isterseniz de tamamen kaldırabilirsiniz. Tüm bu işlemler sadece <strong>Yönetici parolası</strong> ile yapılabilir.</div>
                </div>
              </div>
              <div class="dhtmlgoodies_question">
                <div align="left" style="padding-top:8px; padding-left:30px;"><strong>PROGRAMDA GÜNCELLEMELER NE SIKLIKLA YAPILIYOR ?</strong></div>
              </div>
              <div class="dhtmlgoodies_answer">
                <div>
                  <div align="left">NetDADI Programında güncelleme gün içinde sürekli yapılabilir. Sürekli kötü içerikli siteler açıldığından dolayı güncelleme işlemleri belirli peryodlarda olmaz. Günün herhangi bir saatin de veritabanı güncellemesi yapılabilir. Bu işlemlerin tamamı otomatik olarak kullanıcıdan habersiz yapılır.</div>
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
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><? include "altmenu.php" ?></td>
  </tr>
</table>
</body>
</html>
