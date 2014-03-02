<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--64fa7adcddfc4d3df7f1c289ecf73b1a-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Güncel gelişmeler ve haberler | NetDadı | Netpatron</title>
<link rel="icon" href="http://www.webaynet.com/favicon.gif" type="image/gif" >
<META NAME="description" content="Webaynet Yazılım, Güncel sektör haberleri ile kullanıcılarını bilgilendirmeye devam edecek." >
<META NAME="keywords" content="Bilgisayar izleme, facebook engelleme, network izle, pc izle, takip programı, izleme programı, filtre programı, tib onaylı filtre">
<meta NAME="language" CONTENT="TR">
<meta NAME="rating" CONTENT="General">
<meta NAME="robots" CONTENT="index,follow">
<meta NAME="revisit-after" CONTENT="1 days">
<meta NAME="distribution" CONTENT="global">
<meta name="page-topic" content="içerik filtreleme yazılımı, web filtre yazılımı ve programı, netdadi antiporn programı, tib onaylı filtre programı, facebook engelleme programı">
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
	BACKGROUND-IMAGE: url(images/haberbuton.png);
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
	PADDING-RIGHT: 1px; PADDING-LEFT: 2px; FONT-SIZE: 0.9em; PADDING-BOTTOM: 1px; PADDING-TOP: 1px; POSITION: relative
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
.dhtmlgoodies_answer1 {
	VISIBILITY: hidden;
	OVERFLOW: hidden;
  	MARGIN-LEFT: 33px;
	WIDTH: 550px;
	POSITION: relative;
	HEIGHT: 0px;
	BACKGROUND-COLOR: #e2ebed;
	border: 2px dotted #FF0000;
	font-family: Georgia, "Times New Roman", Times, serif;
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
    <td align="center"><img src="images/haberduyuru_baslik.jpg" width="962" height="40" /></td>
  </tr>
  <tr>
    <td align="center" background="images/bigtablebacround.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="2%">&nbsp;</td>
        <td width="70%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><p align="left"><span class="txt_2"><strong><img src="images/haberveduyuru.jpg" width="660" height="185" /><br />
            </strong></span></p></td>
            </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" class="newtext5">BAŞLIKLARIN DETAYLARINI GÖRMEK İÇİN LÜTFEN ÜSTÜNE TIKLAYINIZ</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="bottom" bordercolor="#999999">
                <div class="dhtmlgoodies_question">
                  <div align="left" style="padding-top:6px; padding-left:30px; font-family: Georgia, 'Times New Roman', Times, serif;"><strong>Hasta sırada, bakın memur ne yapıyor? </strong></div>
                  </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <div align="left">
                        <p align="left">19 Eylül 2012</p>
                        <p> Batman Bölge Devlet Hastanesi’nde çalışan personeller, hastaları sırada bekletip bilgisayarlarda oyun oynuyorlar....<br />
                          <br />
                        </p>
                        <p>2008 yılında kurulan 350 yataklı Batman Bölge Devlet Hastanesi&rsquo;nde skandalların ardı arkası kesilmiyor. Yeni bir skandal otomasyon elemanlarından geldi.</p>
                        <p>Hastanede sıra almaya giden vatandaşları sırada bekleten otomasyon elemanları bilgisayarlara yükledikleri tavla ve okey oyunlarını oynamayı ihmal etmiyorlar.</p>
                        <p><strong>HASTANE OYUN YERİ DEĞİL</strong></p>
                        <p><a href="http://haber.stargazete.com/guncel/devlet-hastanesinde-gorevli-memurun-skandali-goruntuleri/haber-690164" target="_blank">Star Gazetesi'nden Yusuf Uyanık'ın haberine göre;</a> hastanenin ciddi bir müessese olduğunu belirten hasta yakınları, &ldquo;<strong>Acil hastalarımıza sıra almak için kuyrukta beklerken personel ise bilgisayar başında oyun oynamalarına hiçbir anlam veremiyoruz. Oyun oynamak istiyorlarsa gidip kahvehanelerde oynasınlar. Hastane oyun yeri değildir.</strong>&rdquo; diyerek olaya tepki gösterdiler.</p>
                        <p><strong>YETKİLİLER UYUYOR, PERSONEL OYUN OYNUYOR</strong></p>
                        <p>Batman Bölge Devlet Hastanesi&rsquo;nde yaşanan oyun skandalına yetkililerin duyarsız olduğunu ifade eden vatandaşlar, &ldquo;<strong>Yetkililer uyuyor, personel oyun oynuyor. Bu gibi durumları defalarca hastane idaresine iletmemize rağmen hiçbir çözüm alamadık. Milyonların harcandığı hastanede bu gibi olayların yaşanması yetkililerin duyarsız olduğunu gösteriyor.</strong>&rdquo; dediler.</p>
                        <p><strong>HASTANE BÖLGEYE HİTAP EDİYOR</strong></p>
                        <p>Batman&rsquo;da kurulan Bölge Devlet Hastanesi&rsquo;nin sadece Batman&rsquo;a hitap etmediğini vurgulayan hasta yakınları tepkilerini şöyle dile getirdiler: &ldquo;B<strong>ölge Devlet Hastanesi, bölge illerine de hitap ediyor. İl dışından gelen hastalar sıra almak için kuyrukta beklerken personelin bilgisayarlarda oyun oynaması olumsuz karşılanıyor. Yetkililerin konuyla ilgili olarak bir an önce soruşturma başlatması ve bilgisayarlara yüklenen oyunların silinmesi gerekiyor</strong>.&rdquo;</p>
                        <br />
                        <br />
                        Kaynak : <a href="http://www.internethaber.com/batman-hastanede-skandal-bilgisayar-oyunu-hastane-kuyrugu--462038h.htm" target="_blank">http://www.internethaber.com/batman-hastanede-skandal-bilgisayar-oyunu-hastane-kuyrugu--462038h.htm</a></div>
                      </div>
                    </div>
                <div class="dhtmlgoodies_question">
                  <div align="left" style="padding-top:6px; padding-left:30px; font-family: Georgia, 'Times New Roman', Times, serif;"><strong>İnternet'te Bunu(Mp3 indiren, müzik veya film paylaşan) yapan yandı ! </strong></div>
                  </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <div align="left">
                        <p align="left">17 Eylül 2012</p>
                        <p> 5846 sayılı Fikir ve Sanat Eserleri Kanun Tasarısı’nda değişiklik yapılıyor. </p>
                        <p><strong>Kanun tasarısında yapılacak olan yeni değişiklik sonrası sosyal medyada yapılan paylaşımlara ağır yaptırımlar geliyor.</strong></p>
                        <p>Kültür ve Turizm Bakanlığı tarafından yenilenen &ldquo;Fikir ve Sanat Eserleri Kanun Tasarısı&rdquo; yürürlüğe girdiğinde, facebook, twitter gibi sosyal paylaşım sitelerinden müzik, film, e-kitap ve makale paylaşmanın cezası artacak. Kültür ve Turizm Bakanı Ertuğrul Günay, 5846 sayılı Fikir ve Sanat Eserleri Kanun Tasarısı&rsquo;nda değişiklik yapılmasını öngören taslağın 20 Eylül&rsquo;de AB temsilcilerinin görüşüne sunulacağını sunulacağını ve ekimde TBMM gündemine getirilmesinin hedeflendiğini kaydetti. Günay, &ldquo;İzinsiz müzik, film, e-kitap indirmenin ve paylaşmanın tabii ki karşılığı olacak&rdquo; dedi.</p>
                        <p><strong>En az bin lira ceza kesilecek</strong><br />
                          Kültür Bakanlığı Telif Hakları Genel Müdürü Doç. Dr. Abdurrahman Çelik yeni düzenlemenin Fransa ve ABD&rsquo;de iyi sonuçlar verdiğini söyledi. Düzenlemenin Adalet Bakanlığı, Telif Hakları Genel Müdürlüğü. Telekomünikasyon İletişim Başkanlığı, meslek birlikleri tarafından oluşturulduğunu anlatan Çelik, şunları söyledi:<br />
                          &ldquo;En son 2004&rsquo;te değişen kanunda önemli değişikliklere gidirildi. Facebook, twitter gibi sosyal paylaşım ağlarıyla film, e- kitap, makale, müzik paylaşımında bulanan ya da bir kişinin paylaşımını alıp tekrar paylaşan kişiler ilk önce uyarılacak. Kişi üç kez uyarıldıktan sonra paylaşıma devam ediyorsa bin ile 50 bin TL arasında ceza ödeyecek. Türkiye&rsquo;de en çok 18-24 yaşlarındaki kişiler internetten film, müzik paylaşımında bulunuyor. Veliler çocuklarının ne yaptıklarını bilmedikleri için uyarıda bulunamıyor. Bu nedenle amacımız insanları cezalandırmak değil bilinçlendirmek. Fransa&rsquo;da sistem uygulandığında uyarılanların yüzde 95&rsquo;i bir daha eser paylaşmamış.&rdquo;</p>
                        <p><strong>Korsana karşı robot yazılım</strong><br />
                          &ldquo;Tasarı için yeni bir sistem de oluşturuldu. Meslek birliklerinin oluşturduğu veri tabanlarının bulunacağı sistemde, her bir eser içinde de özel bir kod olacak. Robot yazılım, bu kodlara sahip herhangi bir eserin başka bir bilgisayara gönderilmesi veya paylaşılmasını anında tespit edecek. Sistem internetten indirdiğiniz e-kitap ve filmi mail yolu ile paylaşımınız dahilinde devreye girecek ve paylaşan kişi ceza ödeyecek.&rdquo;<br />
                        </p>
                        <p><strong>Savcılara tam yetki geliyor</strong><br />
                          Çelik tasarıdaki bir diğer değişikliği de şöyle anlattı: &ldquo;Filminiz vizyona girmeden, çalındı ve internette paylaşılmaya başladı. Hemen mahkemeye başvurabiliyorsunuz. Bu işlem önceden de vardı fakat süreç uzundu. Yeni tasarı ile savcılara anında müdahale yetkisi verildi. Artık savcı eserin paylaşımını anında durdurabiliyor&rdquo; dedi.</p>
                        <p><strong>Emeklilere  özel ödenek</strong><br />
                          Tasarısı kapsamında emekli sanatçıların da unutulmadığını dile getiren Çelik, &ldquo;Yeni tasarı ile emekli sanatçılarımıza özel bir ödenek açılacak. Telif Haklarına Yıl boyunca gelen gelirin yüzde 10&rsquo;u emekli sanatçılarımız için harcanacak. Sanatçının nelere ihtiyacı olduğu saptanacak, ihtiyaç doğrultusunda ev kirası, gibi bir çok gider karşılanacak&rdquo; dedi.</p>
                        <p><strong>Otomobildeki korsana ceza</strong><br />
                          Kişilerin araçlarında internetten indirilen müziklerden oluşturulan albüm bulundurmasının da suç sayılabileceğini dile getiren Çelik, &ldquo;Siz bedelini ödeyerek parça indirebilirsiniz. Fakat internetten indirdiğiniz parçalarla yaptığınız albümü bir arkadaşınıza veremezsiniz. Bir trafik çevirmesinde aracınızda doldurma albüm bulunuyorsa albümü<br />
                          size veren kişi ceza ödeyecek&rdquo; diye konuştu.</p>
                        <p>GİZEM KARAKIŞ / MİLLİYET</p>
                        Kaynak :   <a href="http://www.habervitrini.com/haber/internette-bunu-yapan-yandi-632383/" target="_blank">http://www.habervitrini.com/haber/internette-bunu-yapan-yandi-632383/</a></div>
                      </div>
                    </div>
                <div class="dhtmlgoodies_question">
                  <div align="left" style="padding-top:6px; padding-left:30px; font-family: Georgia, 'Times New Roman', Times, serif;"><strong>İnternet bağımlılığı geni de bulundu!</strong></div>
                  </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <div align="left">
                        <p align="left">30 Ağustos 2012</p>
                        <p>Avrupa&rsquo;da yapılan bir araştırma, milyonlarca insanın neden bilgisayar başından kalkamadığını daha iyi anlamamızı sağlayabilir. Journal of Addiction Medicine dergisinde yayımlanan araştırmaya göre, internet bağımlılığı genetik bir durum.</p>
                        <p>Almanya&rsquo;nın Bonn Üniversitesi&rsquo;nde araştırmacı olan Christian Montag, <strong>&ldquo;Genlerin internet bağımlılığına neden olduğuna işaret eden bulgular elde ettik... Eğer bu bağlantıları daha iyi anlayabilirsek, daha iyi tedavilerin geliştirilmesi için imkan doğacak&rdquo;</strong> dedi.</p>
                        <p>Montag ve meslektaşları, araştırmalarında <strong>&ldquo;hastalık derecesinde internet kullanan&rdquo;</strong> 132 insanı içeren bir denek grubu kullandı. Bilim insanları, araştırmanın sonuçlarını bir basın açıklamasıyla duyurdu:<br />
                          <strong>&ldquo;Deneyde yer alan kadın ve erkekler, internet ortamındaki verileri kullanma aşamasında sorunlu davranışlar sergiliyordu. Tüm düşünceleri, 7/24 internet kullanımı üzerine kurulu. İnternetten uzak kalmaları halinde, bundan çok ciddi olarak olumsuz etkileneceklerine inanıyorlar&rdquo;</strong> ifadesi kullanıldı.</p>
                        <p><strong>İNTERNET GENİ: CHRNA4</strong><br />
                          <br />
                          Bilim insanları, internet bağımlılarını, kendileriyle aynı yaş ve cinsiyette olan internet bağımlılığı bulunmayan 132 kişiyle eşleştirdi. Deneye katılanlar, DNA örneklerinin alınmasına izin verdi ve internet bağımlılığıyla ilgili bir ankete katıldı. DNA analizleri gerçekleştiren araştırmacılar, internet bağımlısı grupla eşleştikleri grup arasında karşılaştırma yaptı.</p>
                        <p>Analiz sonucunda, kontrol grubuna kıyasla, internet bağımlısı grupta CHRNA4 geninin daha baskın olduğu belirlendi. Dahası, bu genin en çok internet bağımlısı kadınlarda baskın olduğu tespit edildi.</p>
                        <p>Montag, <strong>&ldquo;Araştırmalarımız, internet bağımlılığının hayal ürünü olmadığını gösterdi... Araştıtrmacılar ve terapistler artık bu bağımlılığa daha farklı bir açıdan bakıyor&rdquo;</strong> dedi.</p>
                        <p><strong>ÖDÜLLENDİRMEDEN SORUMLU</strong><br />
                          <br />
                          Aktif beyin hücrelerinde reseptör olan CHRNA4 geni, beyin hücreleri arasında bağlantı ve iletişim sağlayan bir kanal görevi görüyor. Beynin <strong>&lsquo;ödüllendirme sistemini&rsquo;</strong> harekete geçirmekte rol oynayan CHRNA4, yemek yeme, uyuma veya seks gibi üreme ve gelişme sağlayan eylemlerin ardından kendimizi iyi hissetmemizi sağlayan kimyasalların da salınmasından sorumlu. Aynı gen, geçmişte sara hastalığı ve nikotin bağımlılığıyla da ilişkilendirilmişti.</p>
                        <p>Montag, <strong>&ldquo;İnternet kullanımında sorunlu davranışlar sergileyen insanlarda, özellikle de kadınlarda bu gen daha fazla kendisini gösteriyor... Bu genin cinsellikle ilgili yönü, internet bağımlısı grupların kendi içinde oluşturduğu belli alt gruplarla bağlantılı olabilir. Sosyal medyayı çok fazla kullananlara bunu örnek verebiliriz&rdquo;</strong> dedi.</p>
                        Kaynak :   <a href="http://www.internethaber.com/internet-bagimlilik-gen-bilgisayar--456453h.htm" target="_blank">http://www.internethaber.com/internet-bagimlilik-gen-bilgisayar--456453h.htm</a> </div>
                      </div>
                    </div>
                <div class="dhtmlgoodies_question">
                  <div align="left" style="padding-top:6px; padding-left:30px; font-family: Georgia, 'Times New Roman', Times, serif;"><strong>Polis, internet kafeleri güvenlik kamerası ile takip edecek</strong></div>
                  </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <div align="left">
                        <p align="left">26 Mayıs 2012</p>
                        <p align="left">Emniyet Genel Müdürlüğü, internet kafeleri denetim altına almak için yeni bir proje başlatıyor. Özellikle kaçak çalışan mekanları takibe alan emniyet, güvenliği sağlamak için internet kafelere 24 saat güvenlik kamerası ile kayıt alma zorunluluğu getiriyor. Gün sonunda elde edilen görüntülerin bir kopyası da en yakın polis merkezine teslim edilecek.</p>
                        <p align="left">Emniyet Genel Müdürlüğü (EGM) Asayiş Daire Başkanlığı, merdivenaltı şekilde faaliyet gösteren internet kafeleri yakın takibe aldı. İnceleme ve araştırmalar sonrasında birçok işletmede güvenli internetin olmadığını belirleyen polis, çocukların da her türlü siteye kolaylıkla giriş yapabildiğini tespit etti. İncelemelerini rapor haline getiren uzmanlar, sorunun çözümü için de bir dizi tedbir paketi hazırladı. <br />
                          <br />
                          Kaynak :  <a href="http://www.zaman.com.tr/haber.do?haberno=1297125&amp;title=polis-internet-kafeleri-guvenlik-kamerasi-ile-takip-edecek">http://www.zaman.com.tr/haber.do?haberno=1297125&amp;title=polis-internet-kafeleri-guvenlik-kamerasi-ile-takip-edecek</a></p>
                        </div>
                      </div>
                    </div>
                    
                <div class="dhtmlgoodies_question">
                  <div align="left" style="padding-top:6px; padding-left:30px; font-family: Georgia, 'Times New Roman', Times, serif;"><strong>Facebook 14 Yaşındaki Kızın Canını Aldı</strong></div>
                  </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <div align="left">
                        <p align="left">26 Mayıs 2012</p>
                        <p align="left">Diyarbakır'da, Yenişehir İlköğretim Okulu 8. sınıf öğrencisi Rengin Şimşek (14), 9 Haziran'da yapılacak Seviye Belirleme Sınavı'na (SBS) hazırlanıyordu.
                          Habertürk'ten Ahmet Yukuş'un haberine göre; okulunda başarılı olan, ancak sınav öncesi kaygısı yaşayan Şimşek, son günlerde ailesi ile ders çalışma nedeniyle tartışmaya başladı. </p>
                        <p align="left">İddiaya göre Rengin Şimşek, ders zamanları dışında sık sık sosyal paylaşımsitesi Facebook'a giriyordu. 3 gün önce de gece saat 01.00 sıralarında bilgisayar başında oturan Rengin'i ailesi "Bu saate kadar neden bilgisayar başındasın? Facebook'a girme, ders çalış. Çalışmayacaksan uyu, dinlen" diye uyardı. </p>
                        <p align="left">Bilgisayarın kapatılmasına sinirlenen Rengin, anne ve babasının odadan çıkmasından 15 dakika sonra 10. kattaki evlerinden kendini boşluğa bıraktı.
                          Olay yerinde hayatını kaybeden Rengin'in ölümü ailesi ve arkadaşlarını yasa boğdu. Şimşek Ailesi, olay öncesinde kızlarının kardeşleri ile tartıştıktan sonra odasına kapandığını söyledi. Küçük kızın öğretmenleri SBS dönemi öncesi öğrencilerin büyük stres yaşadığını, Rengin'in de yaşadığı sınav stresiyle canına kıymış olabileceğini kaydetti.
                          
                          
                          <br />
                          <br />
                          Kaynak : <a href="http://www.internethaber.com/facebook-intihar-sbs--429137h.htm">http://www.internethaber.com/facebook-intihar-sbs--429137h.htm</a></p>
                        </div>
                      </div>
                    </div>
                <div class="dhtmlgoodies_question">
                  <div align="left" style="padding-top:6px; padding-left:30px; font-family: Georgia, 'Times New Roman', Times, serif;"><strong>Facebook Çocuklara Kapatılıyor</strong></div>
                  </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <div align="left">
                        <p align="left">Tarih : 17 Kasım 2011<br />
                          <br />
&lsquo;internette filtre&rsquo; uygulamasındaki çocuk profilinde Facebook ve diğer sosyal paylaşım sitelerinin yer almayacak </p>
                        <p align="left"> <a href="http://ekonomi.haberturk.com/etiket/bilgi_teknolojileri_ve_ileti%C5%9Fim_kurumu">Bilgi Teknolojileri ve İletişim Kurumu</a> (BTK), sanal ortamda büyük fırtınalar koparan filtre ile ilgili çalışmalarını tamamladı. BTK Başkanı <a href="http://ekonomi.haberturk.com/etiket/tayfun_acarer">Tayfun Acarer</a>, yeni bir ertelemenin söz konusu olmadığını ve 22 Kasım Salı günü filtre uygulamasının resmen başlayacağını açıkladı. Acarer, aile ve çocuk profiline geçmek isteyenlerin 22 Kasım&rsquo;dan itibaren hizmet aldıkları internet servis sağlayıcılarına başvurmaları gerektiğini belirterek, &ldquo;Mevcut uygulamada kalmak isteyenlerin herhangi bir işlem yapmasına gerek yok&rdquo; dedi. </p>
                        <p align="left"><a href="http://ekonomi.haberturk.com/teknoloji/haber/688711-facebook-cocuklara-kapatiliyor" target="_blank">Haberin Devamı &gt;&gt;</a></p>
                        </div>
                      </div>
                    </div>
                    <div class="dhtmlgoodies_question">
                  <div align="left" style="padding-top:6px; padding-left:30px; font-family: Georgia, 'Times New Roman', Times, serif;"><strong>İnternet Bağımlılığı polikliniği açıldı !</strong></div>
                  </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <div align="left">
                        <p align="left">Tarih : 01 Aralık 2011<br />
                          <br />
                          <strong>Son yıllarda herkesin hayatını kolaylaştıran bilgisayar ve internet, doğru kullanılmadığı zaman hiç beklenmedik tehlikeli sonuçlara neden oluyor. </strong>
                                                <p align="left">Bilgiye ulaşmanın en kolay yolu olarak nitelendirilen internetin aşırı kullanımı; kullanıcıların aile ilişkilerinde ve sosyal ilişkilerde bozulma, öğrencilerde derslere katılımının azalması, okuldan uzaklaşma, işyerlerinde iş veriminin düşmesi, işten ayrılma, yeme - içme gibi günlük yaşam aktivitelerin ihmal edilmesi, obezite, yorgunluk, yaygın beden ağrıları gibi yıkıcı sonuçlara yol açıyor.
                          
                                                <p align="left"><strong>Bu soruna çare arıyorlar.</strong>                                                
                                                <p align="left"> Teknoloji sitesi ShiftDelete.Net'in haberine göre sorunlu internet kullanımı, psikiyatrinin en yeni ilgi alanlarından biri haline gelirken, ülkemizde genç nüfusun yüksekliği ve internet kafelerin kontrolsüzce yaygınlaşmış olması, henüz yeni tanımlanmakta olan hastalık için oldukça uygun bir zemin oluşturuyor.
                                                  
                              <p align="left"><strong>Nasıl tedavi ediliyor?
                                                    
                              </strong>
                              <p align="left">Bakırköy Prof. Dr. Mazhar Osman Ruh Sağlığı ve Sinir Hastalıkları E.A. Hastanesi (BRSHH) bünyesinde açılan İnternet Bağımlığı Polikliniği hizmet vermeye başladı.
                                                      
                                                      Poliklinik, uyguladığı tedavi yöntemleriyle internet kullanımını tekrar kişinin kontrolü altına alabilmesini hedefliyor ve bağımlılıkla ilgili bilgilendirme yapıyor.
                                                      
                              <p align="left">Poliklinikte, mesajlaşma ve sosyal medya bağımlılarından, online alışveriş meraklılarına, cinsel içerikli site tutkunlarından, saatlerce bilgisayar oyunu oynayanlara, kadar yetişkin, kadın/erkek, ergen, çocuk birçok kişi tedavi görüyor.
                                                        
                                                        (ShiftDelete.Net)
                            </div>
                      </div>
                    </div>
                <div class="dhtmlgoodies_question">
                  <div align="left" style="padding-top:6px; padding-left:30px; font-family: Georgia, 'Times New Roman', Times, serif;"><strong>İnternette tüm ''tık''lar fişlenecek</strong></div>
                  </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <div align="left">
                        <p align="left">Tarih : 23 Eylül 2011<br />
                          <br />
                          Ulaştırma Bakanı Binali Yıldırım, Türkiye'nin bilgi toplumu alanında hızla gelişme kaydederek 2 milyar olan dünyadaki internet kullanıcı sayısının yüzde 76'sını oluşturan 20 ülke içinde 12. sırada olduğunu belirtti.</p>
                        <p align="left">Bakan Yıldırım, şöyle konuştu: ''Türkiye'nin potansiyeli bundan daha yüksek. Hızla internet kullanımı yaygınlaşıyor. Sosyal paylaşım sitelerinde dünyada ya birinci, ya ikinciyiz. Facebook, MSN'de iki numarayız. Biraz daha faydalı işlere bunların yanında ağırlık versek daha da iyi olacak tabii. Yani 'laklak' da lazım, ama biraz daha üretime yönelik gelişmeye yönelik, yenilikçilikle ilgili çalışmalara yönelik, araştırma geliştirmeye yönelik ağırlıklı kullanmamızda fayda var. Buna paralel gitmemiz lazım. </p>
                        <p align="left"><a href="http://www.haber3.com/internette-tum-tiklar-fislenecek-1025016h.htm" target="_blank">Haberin Devamı &gt;&gt;</a></p>
                        </div>
                      </div>
                    </div>
                <div class="dhtmlgoodies_question">
                  <div align="left" style="padding-top:6px; padding-left:30px; font-family: Georgia, 'Times New Roman', Times, serif;"><strong>TİB Başkanı Fethi Şimşek, önemli açıklamalarda bulundu.</strong></div>
                  </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <div align="left">
                        <p align="left">Tarih : 06-12-2010<br />
                          Telekomünikasyon İletişim Başkanı <strong>Fethi Şimşek</strong>, Wikileaks belgelerini örnek göstererek, 'İnternet, sanal ortam; dünyadaki tüm ülkelerde deprem ve sel etkisi yapacak şekilde geliyor. Belki şu anda ayaklarımız ıslanıyor ama yarın iyi önlemler almazsak, boyumuzu aşacak seviyeye gelebilir' dedi.</p>
<p align="left">İçişleri Bakanlığı ile Telekomünikasyon İletişim Başkanlığının (TİB) internet kafelere ilişkin düzenlediği eğitim semineri, Antalya Kundu'daki Kremlin Palace Otel'de başladı. <a href="http://haber.gazetevatan.com/internet-kafe-patlamasi-yasanan-3-il/344911/7/Yasam" target="_blank">Haberin Devamı &gt;&gt;</a></p>
                        </div>
                      </div>
                    </div>
                  <div class="dhtmlgoodies_question">
                    <div align="left" style="padding-top:6px; padding-left:30px; font-family: Georgia, 'Times New Roman', Times, serif;"><strong>Türkiye, çocukların cinsel sömürüye karşı korunması sözleşmesini onayladı</strong>.</div>
                    </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <div align="left">
                        <p>10 Eylül 2011 CUMARTESİ<strong><br />
                          Resmî Gazete</strong>Sayı : 28050<br />
                          <strong>MİLLETLERARASI SÖZLEŞME<br />
                          </strong><strong>Karar Sayısı : 2011/2060</strong></p>
<p>Türkiye Cumhuriyeti Hükümeti adına 25/10/2007 tarihinde Lanzarote’de imzalanan ve 25/11/2010 tarihli ve 6084 sayılı Kanunla onaylanması uygun bulunan ekli “Avrupa Konseyi Çocukların Cinsel Sömürü ve İstismara Karşı Korunması Sözleşmesi”nin onaylanması; Dışişleri Bakanlığının teklifi üzerine, 31/5/1963 tarihli ve 244 sayılı Kanunun 3 üncü maddesine göre, Bakanlar Kurulu’nca 18/7/2011 tarihinde kararlaştırılmıştır.</p>
                        <p><strong>Abdullah GÜL</strong></p>
                        <p>CUMHURBAŞKANI</p>
                        <p><strong><a href="http://www.memurlar.net/common/documents/3652/20110910-4-1.pdf" target="_blank">Sözleşmenin eklerini görmek için tıklayınız</a></strong> (memurlar.net)</p>
                      </div>
                      </div>
                    </div>
                  <div class="dhtmlgoodies_question">
                    <div align="left" style="padding-top:6px; padding-left:30px; font-family: Georgia, 'Times New Roman', Times, serif;"><strong>Onaylı İçerik Filtreleme Yazılımları Duyurusu</strong></div>
                    </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <p>TİB Başkanlığının 20-08-2008 Tarihli Duyurusu</p>
                      <p>Bilindiği üzere, 5651 sayılı Kanuna dayanılarak hazırlanan “İnternet Toplu Kullanım Sağlayıcılar Hakkında Yönetmelik” 1 Kasım 2007 tarihinde Resmi Gazetede yayımlanarak yürürlüğe girmiştir.</p>
                      <p>Söz konusu Yönetmeliğin 5. maddesinin birinci fıkrasının c bendinde, ticari amaçla internet toplu kullanım sağlayıcıların Başkanlık tarafından onaylanan içerik filtreleme yazılımı kullanmaları gerektiği belirtilmektedir.</p>
                      <p>Bu kapsamda, Başkanlığımızca onaylanan içerik filtreleme ürünleri<a href="http://www.tib.gov.tr/onayli_filtreleme_yazilimlari.html" target="_blank"> http://www.tib.gov.tr/onayli_filtreleme_yazilimlari.html</a> adresinde yayımlanmıştır.</p>
                      <p>İlgililere duyurulur.</p>
<p align="left">&nbsp;</p>
                      </div>
                    </div>
                  <div class="dhtmlgoodies_question">
                    <div align="left" style="padding-top:6px; padding-left:30px; font-family: Georgia, 'Times New Roman', Times, serif;"><strong>Facebook, Twiter gibi sosyal siteler Tehlike saçıyor</strong></div>
                    </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <div align="left">
                        <p> 11-09-2011 Tarihli Haber<br />
                          Adana'dageçen ay evden kaçan 16 yaşındaki A.E., 16 gün boyunca 23 kişinin tecavüze uğradı. A.E.'nin ifadesi üzerine 3'ü çocuk toplam 15 kişi operasyonla yakalandı, 8 kişi de aranıyor. </p>
                        <p>Anne ve babası ayrı olan ve annesinin yanında kalan A.E. geçen ay evden kaçtı. Sosyal paylaşım sitesi Facebook'ta tanıştığı M.E. ile görüşen genç kız, evden kaçtığını söyledi. Bunun üzerine M.E., A.E.'yi kaldığı eve götürdü. A.E., burada erkek arkadaşının tecavüzüne uğradı. Genç kıza daha sonra M.E.'nin arkadaşları da tecavüz etti. </p>
                        <p>Tecavüz eden kişilerin A.E.'yi uyuşturucu satmaya zorladıkları, bazılarının ise para karşılığında fuhuş tacirlerine satmak istediği öne sürüldü. Ailenin kayıp başvurusu üzerine polis harekete geçerken, 3 gün önce bir yolunu bulup kaçan A.E., babasının yanına giderek başından geçen olayları anlattı. Baba, bunun üzerine polise gitti. A.E.'nin, kendisine 23 kişinin tecavüz ettiğini söylemesi üzerine polis, önce kızın erkek arkadaşı M.E.'yi yakaladı.  <br />
                          <a href="http://www.sabah.com.tr/Yasam/2011/09/11/facebookta-tanistigi-genc-ve-22-arkadasi-tecavuz-etti" target="_blank">Haberin tamamı için &gt;&gt;</a></p>
                      </div>
                      </div>
                    </div>
                  <div class="dhtmlgoodies_question">
                    <div align="left" style="padding-top:6px; padding-left:30px; font-family: Georgia, 'Times New Roman', Times, serif;"><strong>Çinli internet bağımlısı PC başında öldü</strong></div>
                    </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <div align="left"> 
                        <p>28 Şubat 2002</p>
                        <p>Çin'de yayınlanan günlük gazetelerin haberine göre 26 yaşındaki Çinli internet kullanıcısı bilgisayar başında geçen oyun saatlerinin sonunda bitkin düşerek vefat etti. Jinzhou'da yaşayan bilgisayar ve internet bağımlısının ekran karşısında çok fazla vakit geçirmekten 150 kiloya ulaştığı ve son zamanlardaki sosyal hayatının da azaldığı ifade ediliyor.<br />
                          <br />
                          Ailesinin açıklamalarına da yer veren gazete, 7 gün süresince temel ihtiyaçlar dışında neredeyse tüm vaktini online oyunlar oynayarak geçiren kullanıcının geçtiğimiz Cumartesi günü bitkin düştüğünü ve odasında ölü olarak bulunduğunu yazdı. </p>
                        <p><a href="http://www.chip.com.tr/konu/Cinli-internet-bagimlisi-PC-basinda-oldu_3321.html" target="_blank">Haberin Tamamı için &gt;&gt;</a></p>
                      </div>
                      </div>
                    </div>
                  <div class="dhtmlgoodies_question">
                    <div align="left" style="padding-top:6px; padding-left:30px; font-family: Georgia, 'Times New Roman', Times, serif;"><strong>Musa Kang Cinayeti Internet Cafecilerin üstüne yıkılmak istendi</strong></div>
                    </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <div align="left">
                        <p>Kasım 2009</p>
                        <p>Erzurum musa cinayeti 2009 yılında haftalarca medyada geniş yer bulmuştu. Çocuğun bir internet cafeden çıktıktan sonra öldürülmüş olması bütün gözleri internet cafelerin üzerine çekmişti. Oysa Musa nın katili amcaoğluydu ve internet cafeler ile hiç bir ilgisi yoktu. </p>
                        <p>Bu olaydan sonra internet cafelere haksız suçlamalar ile bir çok saçma yaptırımlar uygulanmıştı. Medyanın yalan yanlış haberleri bir çok internet cafeciyi sıkıntıya sokmuş ve lekelemişti. Aynı medya olay açığa kavuştuğunda nedense olayı bir daha duyurmamıştı. Bu çocuk okuldan çıktıktan sonra öldürülseydi okula gitmek mi yasaklanacaktı acaba diye insanın sorası geliyor.</p>
                        <p><a href="http://www.stargazete.com/guncel/validen-hacker-musa-cinayeti-aciklamasi-haber-224958.htm" target="_blank">Olayla ilgili haberi okumak için &gt;&gt;</a></p>
                        </div>
                      </div>
                    </div>
                  <div class="dhtmlgoodies_question">
                    <div align="left" style="padding-top:6px; padding-left:30px; font-family: Georgia, 'Times New Roman', Times, serif;"><strong>Boşanmaların en popüler sebebi Facebook</strong></div>
                    </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <div align="left">
                        <p><strong>Bağımlılık haline gelen internet kullanımı gençlerde asosyalliğe, evli çiftlerde ise boşanmaya neden olabiliyor.</strong><br />
                          <br />
                          Teknolojik gelişmelerle birlikte son yıllarda artan bilgisayar ve internet kullanımının bazı kişilerde zamanla bağımlılığa dönüştüğü, bu durumun gençlerde asosyalliğe, evli çiftlerde ise boşanmaya neden olabildiği bildirildi.<br />
                          <br />
                          Yeşilay Rize temsilcisi Bayram Ali Kavalcı, Yeşilay olarak madde bağımlılığı ve sigaranın yanı sıra televizyon ve internet bağımlılığı ile de mücadelelerini sürdürdüklerini belirtti. </p>
                        <p><a href="http://askevlilik.blogspot.com/2011/01/bosanmalarn-en-populer-sebebi-facebook.html" target="_blank">Haberin Devamı için &gt;&gt;</a></p>
                      </div>
                      </div>
                    </div>
                  <div class="dhtmlgoodies_question">
                    <div align="left" style="padding-top:6px; padding-left:30px; font-family: Georgia, 'Times New Roman', Times, serif;"><strong>Facebook oyunları Firmalara zarar  ettiriyor</strong> ?</div>
                    </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <div align="left">
                        <p>Facebook'ta kullanıcıları eğlendirici, basit de olsa vakit geçirici -eğlendirirken öğretici desek yalan olur- pek çok oyun var. Ancak bu oyunlar sizde birer bağımlılık haline gelmişse yavaş yavaş patronunuzun tepkisine maruz kalmanız an meselesi.</p>
                        <p>Özellikle araştırmacılar kriz ortamında kalkınmaya çalışan şirketlerin bir numaralı düşmanının Facebook oyunları olduğunu söylüyor. Zira Facebook oyunları çalışanların performansını %12.5 oranında baltalıyor.</p>
                        <p><a href="http://www.technotoday.com.tr/Detay/1366/Facebook-oyunlari-zarar-ettiriyor" target="_blank">Haberin Tamamı için &gt;&gt;</a></p>
                        </div>
                      </div>
                    </div>
                  <div class="dhtmlgoodies_question">
                    <div align="left" style="padding-top:6px; padding-left:30px; font-family: Georgia, 'Times New Roman', Times, serif;"><strong>16 Yaşındaki kız Facebook'ta tanıştığı erkek için evden kaçtı</strong></div>
                    </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <div align="left">
                        <p>Adana'da facebook'ta tanıştığı erkek için evden kaçan 16 yaşındaki kız, 16 günde 23 kişinin tecavüzüne uğradıktan sonra babasına teslim edildiği ileri sürüldü.</p>
                        <p>Olayla ilgili 15 kişi gözaltına alınırken 8 kişi aranıyor. Edinilen bilgiye göre, olay, merkez Seyhan ilçesinde meydana geldi. İddiaya göre, annesi ve babası ayrı yaşayan A.E. isimli 16 yaşındaki kız çocuğu 3 ay önce sosyal paylaşım sitesi olan facebook'tan M.E. isimli bir kişiyle tanıştı.</p>
                        <p><a href="http://www.internethaber.com/16-yasindaki-kiza-23-kisi-tecavuz-etti-370730h.htm" target="_blank">Haberin Devamı için &gt;&gt;</a></p>
                      </div>
                      </div>
                    </div>
                  <div class="dhtmlgoodies_question">
                    <div align="left" style="padding-top:6px; padding-left:30px; font-family: Georgia, 'Times New Roman', Times, serif;"><strong>Çocukları internette nasıl koruyabiliriz?</strong></div>
                    </div>
                  <div class="dhtmlgoodies_answer1">
                    <div>
                      <div align="left">
                        <p>Günümüzde internetin birçok faydası bulunmasının yanında özellikle interneti tam olarak tanımayan çocuklar için ise zararları var.</p>
                        <p>Özellikle sosyal paylaşım sitelerinde çocuklarınsayfalarına yazdıkları notlardan dolayı birçok sapkın kişilik bu çocuklara internet ortamında yaklaşabiliyor.</p>
                        <p>Reader's Digest dergisinde yer alan habere göre, internet delikanlılığı (internet, cep telefonugibi iletişim araçlarını kullanarak, yazılı mesaj ya da resim paylaşmak yolu ile diğer insanları aşağılamak. 13-19 yaş grubu gençler içinde bu tur şeylere oldukça sık rastlanıyor) bugünün gençleri arasında büyüyen bir problem olurken,anne-baba olarak çocuklarınızı internetteki zararlı şeylerden korumak için yapabileceğiniz bazı şeyler var.</p>
                        <p><a href="http://www.haber7.com/haber/20110427/Cocuklari-internette-nasil-koruyabiliriz.php" target="_blank">Haberin Devamı için &gt;&gt;</a></p>
                      </div>
                      </div>
                    </div>
                  <script type="text/javascript">
initShowHideDivs();
showHideContent(false,1);	// Automatically expand first item
                                                                                   </script></td>
              </tr>
              </table></td>
          </tr>
        </table></td>
        <td width="1%" align="center" valign="top" bgcolor="#eeeeee"><img src="images/dikeybar.png" width="7" height="450" /></td>
        <td width="25%" valign="top" bgcolor="#eeeeee"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="16">&nbsp;</td>
          </tr>
          <tr>
            <td height="16"><table width="241" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="26" align="center" background="images/minibuton.png"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="11%">&nbsp;</td>
                    <td width="85%" class="newtext51"><a href="basindabiz.php">Basında Biz</a></td>
                    <td width="4%">&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="26" align="center" background="images/minibuton.png"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="11%">&nbsp;</td>
                    <td width="85%" class="newtext51"><a href="referanslar.php">Referanslarımız</a></td>
                    <td width="4%">&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
              </table></td>
          </tr>
          <tr>
            
          </tr>
          <tr>
            
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
