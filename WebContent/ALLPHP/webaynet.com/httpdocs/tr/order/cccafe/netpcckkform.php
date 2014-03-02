<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0044)https://www.webaynet.com/tr/npbankhform.html -->
<HTML><HEAD><TITLE><< KREDİ KARTI POS FORMU >></TITLE>
<META http-equiv=Page-Enter content=blendTrans(duration=.5)>
<META http-equiv=Content-Style-Type content=text/css>
<LINK href="style2.css" type=text/css rel=stylesheet>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1254">
<link href="https://www.webaynet.com/CSS/style2.css" rel="stylesheet" type="text/css" />
<link href="https://www.webaynet.com/CSS/layout.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://www.webaynet.com/highslide/highslide.js"></script>
<script type="text/javascript">    
    hs.graphicsDir = 'https://www.webaynet.com/highslide/graphics/';
    hs.outlineType = null;
	
function ilDegistir(o,ilKodu,from){

	if(o){
		if(from == 'iller') defOpt = '--Lütfen Seçiniz--';
		else  defOpt = '--Seçiniz--';
		if(ilKodu == ''){
			for(var i=o.options.length-1;i>-1;i--) o.options[i] = null;
			var option = new Option(defOpt,'');
			o.options[0] = option;			
		}
		else{
			var iller = "";
			if(ilKodu != 82){
			if(ilKodu == 81){iller = illerArr[0] + "," + illerArr[1];}
			else{iller = illerArr[ilKodu];}
			                   }
			var indOf;
			var i = 0;
			for(var j=o.options.length-1;j>-1;j--) o.options[i] = null;
			var option = new Option(defOpt,'');
			o.options[i++] = option;
			while(iller.indexOf(",") != -1){
				indOf = iller.indexOf(",");
				var option = new Option(iller.substring(0,indOf),iller.substring(0,indOf));
				o.options[i++] = option;
				iller = iller.substring(indOf+1,iller.length);
			}
			var option = new Option(iller,iller);
			o.options[i++] = option;
		}
	}
}


function changeCombo(form,val){
	var idx = 0;
	var o = form.menu1;
	oidx = val;
	for(var j=o.options.length-1;j>-1;j--){o.options[j] = null;}
	var option = new Option('--Hepsi--','');
	o.options[idx++] = option;	
	for(var i=0;i<MY_Idx;i++){
		if(MY_Class_Arr[i].oid == val){
			var oname = MY_Class_Arr[i].oname.toString();
			option = new Option(oname,MY_Class_Arr[i].cid);
			o.options[idx++] = option;
		}
	}
}

function initPage(form){
	var ind = 0;
	for(var i=0;i<MY_Idx;i++){
		if(MY_Class_Arr[i].oid == -1){
			var rootCat = MY_Class_Arr[i].cid;
			for(var j=0;j<MY_Idx;j++){
				if(MY_Class_Arr[j].oid == rootCat && form.menu0[ind]){
					form.menu0[ind].value = MY_Class_Arr[j].cid;
					ind++;
				}
			}
			break;
		}
	}
	form.menu0[0].checked = true;
	changeCombo(form,form.menu0[0].value);
	for(var j=0;j<form.menu1.length;j++){
		if(form.menu1[j].text == "--Hepsi--"){
			form.menu1[j].selected = true;
			break;
		}
	}
}

var illerArr = new Array();
illerArr[0] = "Avcılar,Bağcılar,Bakırköy,Bahçelievler,Bayrampaşa,Beşiktaş,Beyoğlu,Büyükçekmece,Çatalca,Eminönü,Eyüp,Esenler,Fatih,Gaziosmanpaşa,Güngören,Kağıthane,Küçükçekmece,Sarıyer,Silivri,Şişli,Zeytinburnu";
illerArr[1] = "Avcılar,Bağcılar,Bakırköy,Bahçelievler,Bayrampaşa,Beşiktaş,Beyoğlu,Büyükçekmece,Çatalca,Eminönü,Eyüp,Esenler,Fatih,Gaziosmanpaşa,Güngören,Kağıthane,Küçükçekmece,Sarıyer,Silivri,Şişli,Zeytinburnu";
illerArr[2] = "Akyurt,Altındağ,Ayaş,Bala,Beypazarı,Çamlıdere,Çankaya,Çubuk,Elmadağ,Etimesgut,Evren,Gölbaşı,Güdül,Haymana,Kalecik,Kazan,Keçiören,Kızılcahamam,Mamak,Nallihan,Polatlı,Sincan,Şereflikoçhisar,Yenimahalle,Merkez";
illerArr[3] = "Aliağa,Bayındır,Balçova,Bergama,Beydağ,Bornova,Buca,Çeşme,Çiğli,Dikili,Foça,Gaziemir,Güzelbahçe,Karaburun,Karşıyaka,Kemalpaşa,Kınık,Kiraz,Konak,Menderes,Menemen,Narlidere,Ödemiş,Seferihisar,Selçuk,Tire,Torbalı,Urla,Merkez";
illerArr[4] = "Aladağ,Ceyhan,Feke,İmamoğlu,Karaisalı,Karataş,Kozan,Pozantı,Saimbeyli,Seyhan,Tufanbeyli,Yumurtalık,Yüreğir,Merkez";
illerArr[5] = "Besni,Çelikhan,Gerger,Gölbaşı,Kahta,Samsat,Sincik,Tut,Merkez";
illerArr[6] = "Başmakçı,Bayat,Bolvadin,Çobanlar,Çay,Dazkırı,Dinar,Emirdağ,Evciler,Hocalar,İhsaniye,İscehisar,Kızılören,Sandıklı,Sincanlı,Sultandağı,Şuhut,Merkez";
illerArr[7] = "Diyadin,Doğubeyazit,Eleşkirt,Hamur,Patnos,Taşlıçay,Tutak,Merkez";
illerArr[8] = "Ağaçören,Eskil,Gülağaç,Güzelyurt,Ortaköy,Sarıyahşi,Merkez";
illerArr[9] = "Göynücek,Gümüşhaciköy,Hamamözü,Merzifon,Suluova,Taşova,Merkez";
illerArr[10] = "Akseki,Alanya,Demre,Elmalı,Finike,Gazipaşa,Gündoğmuş,İbradi,Kale,Kaş,Kemer,Korkuteli,Kumluca,Manavgat,Serik,Merkez";
illerArr[11] = "Çıldır,Damal,Göle,Hanak,Posof,Merkez";
illerArr[12] = "Ardanuç,Arhavi,Borçka,Hopa,Murgul,Şavşat,Yusufeli,Merkez";
illerArr[13] = "Bozdoğan,Buharkent,Çine,Germencik,İncirliova,Karacasu,Karpuzlu,Koçarlı,Köşk,Kuşadası,Kuyucak,Nazilli,Söke,Sultanhisar,Yenihisar,Yenipazar,Merkez"; 
illerArr[14] = "Ayvalık,Akçay,Balya,Bandırma,Bigadiç,Burhaniye,Dursunbey,Edremit,Erdek,Gönen,Gömeç,Havran,İvrindi,Kepsut,Manyas,Marmara,Savaştepe,Sindirgi,Susurluk,Merkez";
illerArr[15] = "Amasra,Kurucaşile,Ulus,Merkez";
illerArr[16] = "Gercüş,Hasankeyf,Beşiri,Kozluk,Sason,Merkez";
illerArr[17] = "Aydıntepe,Demirözü,Merkez";
illerArr[18] = "Bozöyük,Gölpazarı,İnhisar,Osmaneli,Pazaryeri,Söğüt,Yenipazar,Merkez";
illerArr[19] = "Adaklı,Genç,Karlıova,Kığı,Solhan,Yayladere,Yedisu,Merkez";
illerArr[20] = "Adilcevaz,Ahlat,Güroymak,Hizan,Mutki,Tatvan,Merkez";
illerArr[21] = "Dörtdivan,Gerede,Göynük,Kıbrıscık,Mengen,Mudurnu,Seben,Yeniçağa,Merkez";
illerArr[22] = "Altınyayla,Ağlasun,Bucak,Çavdır,Çeltikçi,Gölhisar,Karamanlı,Kemer,Tefenni,Yeşilova,Merkez";
illerArr[23] = "Büyükorhan,Gemlik,Gürsu,Harmancık,İnegöl,İznik,Karacabey,Keles,Kestel,Mudanya,Mustafakemal,Nilüfer,Orhaneli,Orhangazi,Osmangazi,Yenişehir,Yıldırım,Merkez";
illerArr[24] = "Ayvacık,Bayramiç,Bozcaada,Biga,Çan,Eceabat,Ezine,Gelibolu,Gökçeada,Lapseki,Yenice,Merkez";
illerArr[25] = "Atkaracalar,Bayramören,Çerkeş,Eldivan,Ilgaz,Kızılırmak,Korgun,Kurşunlu,Orta,Ovacık,Şabanözü,Yapraklı,Merkez";
illerArr[26] = "Alaca,Bayat,Boğazkale,Dodurga,İskilip,Kargı,Laçin,Mecitözü,Oğuzlar,Ortaköy,Osmancık,Sungurlu,Uğurludağ,Merkez";
illerArr[27] = "Acıpayam,Akköy,Babadağ,Baklan,Bekilli,Beyağaç,Buldan,Bozkurt,Çal,Çameli,Çardak,Çivril,Güney,Honaz,Kale,Sarayköy,Serinhisar,Tavas,Merkez";
illerArr[28] = "Bismil,Çermik,Çınar,Çüngüş,Dicle,Eğil,Ergani,Hani,Hazro,Kocaköy,Kulp,Lice,Silvan,Merkez";
illerArr[29] = "Enez,Havsa,İpsala,Keşan,Lalapaşa,Meriç,Süloğlu,Uzunköprü,Merkez";
illerArr[30] = "Ağın,Alacakaya,Arıcak,Baskil,Karakoçan,Keban,Kovancılar,Maden,Palu,Sivrice,Merkez";
illerArr[31] = "Çayırlı,Ilıç,Kemah,Kemaliye,Otlukbeli,Refahiye,Tercan,Üzümlü,Merkez";
illerArr[32] = "Aşkale,Çat,Hinis,Horasan,Ilıca,İspir,Karaçoban,Karayazı,Köprüköy,Narman,Oltu,Olur,Pasinler,Pazaryolu,Şenkaya,Tekman,Tortum,Uzundere,Merkez";
illerArr[33] = "Alpu,Beylikova,Çifteler,Günyüzü,Han,İnönü,Mahmudiye,Mihalgazi,Mihaliççik,Sarıcakaya,Seyitgazi,Sivrihisar,Merkez";
illerArr[34] = "Araban,İslahiye,Kargamış,Nizip,Nurdağı,Oğuzeli,Şahinbey,Şehitkamil,Yavuzeli,Merkez";
illerArr[35] = "Alucra,Bulancak,Çamoluk,Çanakçı,Dereli,Doğankent,Espiye,Eynesil,Görele,Güce,Keşap,Piraziz,Şebinkarahisar,Tirebolu,Yağlıdere,Merkez";
illerArr[36] = "Kelkit,Köse,Kürtün,Şiran,Torul,Merkez";
illerArr[37] = "Çukurca,Şemdinli,Yüksekova,Merkez";
illerArr[38] = "Altınözü,Belen,Dörtyol,Erzin,Hassa,İskenderun,Kırıkhan,Kumlu,Reyhanlı,Samandağı,Yayladağı,Merkez";
illerArr[39] = "Aralik,Karakoyunlu,Tuzluca,Merkez";
illerArr[40] = "Aksu,Atabey,Eğirdir,Gelendost,Gönen,Keçiborlu,Senirkent,Sütçüler,Şarkikaraağ,Uluborlu,Yenişarbade,Yalvaç,Merkez";
illerArr[41] = "Anamur,Aydıncık,Bozyazı,Çamlıyayla,Erdemli,Gülnar,Mut,Silifke,Tarsus,Merkez";
illerArr[42] = "Akyaka,Arpaçay,Digor,Kağızman,Sarıkamış,Selim,Susuz,Merkez";
illerArr[43] = "Abana,Ağlı,Araç,Azdavay,Bozkurt,Cide,Çatalzeytin,Daday,Devrekani,Doğanyurt,Hanönü,İhsangazi,İnebolu,Küre,Pınarbaşı,Seydiler,Şenpazar,Taşköprü,Tosya,Merkez";
illerArr[44] = "Akkışla,Bünyan,Develi,Felahiye,Hacılar,İncesu,Kocasinan,Melikgazi,Özvatan,Pınarbaşı,Sarıoğlan,Sarız,Talas,Tomarza,Yahyalı,Yeşilhisar,Merkez";
illerArr[45] = "Bahşili,Bağlışeyh,Çelebi,Delice,Karakeçili,Keskin,Sulakyurt,Yahşihan,Merkez";
illerArr[46] = "Babaeski,Demirköy,Kofçaz,Lüleburgaz,Pehlivanköy,Pınarhisar,Vize,Merkez";
illerArr[47] = "Akçakent,Akpınar,Boztepe,Çiçekdağı,Kaman,Mucur,Merkez";
illerArr[48] = "Darıca,Gebze,Gölcük,Kandıra,Karamürsel,Körfez,Merkez";
illerArr[49] = "Ahırlı,Akören,Akşehir,Altınekin,Beyşehir,Bozkır,Derebucak,Cihanbeyli,Çumra,Çeltik,Derbent,Doğanhisar,Emirgazi,Ereğli,Güneysınır,Halkapınar,Hadim,Hüyük,Ilgın,Kadınhanı,Karapınar,Karatay,Kulu,Meram,Sarayönü,Selçuklu,Seydişehir,Taşkent,Tuzlukçu,Yalıhöyük,Yunak,Merkez";
illerArr[50] = "Altıntaş,Aslanapa,Çavdarhisar,Domaniç,Dumlupınar,Emet,Gediz,Hisarcık,Pazarlar,Simav,Şaphane,Tavşanlı,Merkez";
illerArr[51] = "Akçadağ,Arapgir,Arguvan,Battalgazi,Darende,Doğanşehir,Doğanyol,Hekimhan,Kale,Kuluncak,Pötürge,Yazıhan,Yeşilyurt,Merkez";
illerArr[52] = "Ahmetli,Akhisar,Alaşehir,Demirci,Gölmarmara,Gördes,Kırkağaç,Köprübaı,Kula,Salihli,Sarıgöl,Saruhanlı,Selendi,Soma,Turgutlu,Merkez";
illerArr[53] = "Afşin,Andırın,Çağlayancer,Ekinözü,Elbistan,Göksun,Nurhak,Pazarcık,Türkoğlu,Merkez";
illerArr[54] = "Eflani,Eskipazar,Ovacık,Safranbolu,Yenice,Merkez";
illerArr[55] = "Ayrancı,Başyayla,Ermenek,Kazımkarabekir,Sarıveliler,Merkez";
illerArr[56] = "Elbeyli,Musabeyli,Polateli,Merkez";
illerArr[57] = "Dargeçit,Derik,Kızıltepe,Mazıdağı,Midyat,Nusaybin,Ömerli,Savur,Yeşilli,Merkez";
illerArr[58] = "Bodrum,Dalaman,Datça,Fethiye,Kavaklıdere,Köyceğiz,Marmaris,Milas,Ortaca,Ula,Yatağan,Merkez";
illerArr[59] = "Bulanık,Hasköy,Korkut,Malazgirt,Varto,Merkez";
illerArr[60] = "Acıgöl,Avanos,Derinkuyu,Gülşehir,Hacıbektaş,Kozaklı,Ürgüp,Merkez";
illerArr[61] = "Altunhisar,Bor,Çamardı,Çiftlik,Ulukışla,Merkez";
illerArr[62] = "Akkuş,Aybastı,Çamaş,Çatalpınar,Çaybaşı,Fatsa,Gölköy,Gölyalı,Gürgentepe,İkizce,Korgan,Kabadüz,Kabataş,Kumru,Mesudiye,Perşembe,Ulubey,Ünye,Merkez";
illerArr[63] = "Bahçe,Hasanbeyli,Düziçi,Kadirli,Sunbaş,Toprakkale,Merkez";
illerArr[64] = "Ardeşen,Çamlıhemşin,Çayeli,Derepazarı,Fındıklı,Güneysu,Hemşin,İkizdere,İyidere,Kalkandere,Pazar,Merkez";
illerArr[65] = "Akyazı,Ferizli,Geyve,Hendek,Karapürçek,Karasu,Kaynarca,Kocaali,Pamukova,Sapanca,Söğütlü,Taraklı,Merkez";
illerArr[66] = "Alaçam,Asarcık,Ayvacık,Bafra,Çarşamba,Havza,Kavak,Ladik,Salıpazarı,Tekkeköy,Terme,Vezirköprü,Yakakent,Merkez";
illerArr[67] = "Aydınlar,Baykan,Eruh,Kozluk,Kurtalan,Pervari,Şirvan,Merkez";
illerArr[68] = "Ayancık,Boyabat,Dikmen,Durağan,Erfelek,Gerze,Saraydüzü,Türkeli,Merkez";
illerArr[69] = "Akıncılar,Altınyayla,Divriği,Doğanşar,Gemerek,Gölova,Gürün,Hafik,İmranlı,Kangal,Koyulhisar,Suşehri,Şarkışla,Ulaş,Yıldızeli,Zara,Merkez";
illerArr[70] = "Çerkezköy,Çorlu,Hayrabolu,Malkara,Marmaraereğli,Muratlı,Saray,Şarköy,Merkez";
illerArr[71] = "Almus,Artova,Başçiftlik,Erbaa,Niksar,Pazar,Reşadiye,Sulusaray,Turhal,Yeşilyurt,Zile,Merkez";
illerArr[72] = "Akçaabat,Araklı,Arsin,Beşikdüzü,Çarşıbaşı,Çaykara,Dernekpazar,Düzköy,Hayrat,Köprübaşı,Maçka,Of,Sürmene,Şalpazarı,Tonya,Vakfikebir,Yomra,Merkez";
illerArr[73] = "Çemişgezek,Hozat,Mazgirt,Nazimiye,Ovacık,Pertek,Pülümür,Merkez";
illerArr[74] = "Akçakale,Birecik,Bozova,Ceylanpınar,Halfeti,Harran,Hilvan,Siverek,Suruç,Viranşehir,Merkez";
illerArr[75] = "Beytüşşeba,Uludere,Cizre,İdil,Silopi,Güçlükonak,Merkez";
illerArr[76] = "Banaz,Eşme,Karahallı,Sivaslı,Ulubey,Merkez";
illerArr[77] = "Bahçesaray,Başkale,Çaldıran,Çatak,Edremit,Erciş,Gevaş,Gürpınar,Muradiye,Özalp,Saray,Merkez";
illerArr[78] = "Altınova,Armutlu,Çınarcık,Çiftlikköy,Termal,Merkez";
illerArr[79] = "Akdağmadeni,Aydıncık,Boğazlıyan,Çandır,Çayıralan,Çekerek,Kadışehri,Sarıkaya,Saraykent,Sorgun,Şefaatli,Yenifakili,Yerköy,Merkez";
illerArr[80] = "Alaplı,Çamoluk,Çaycuma,Devrek,Eflani,Ereğli,Gökçebey,Merkez";
illerArr[81] = "Akçakoca,Cumayeri,Çilimli,Gölyaka,Gümüşova,Kaynaslı,Yığılca,Merkez";
</script>
<style type="text/css">
<style type="text/css">
<!--
body {
	background-color: #ffffff;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.highslide {	cursor: url(https://www.webaynet.com/highslide/graphics/zoomin.cur), pointer;
    outline: none;
}

.highslide {
	cursor: url(https://www.webaynet.com/highslide/graphics/zoomin.cur), pointer;
    outline: none;
}
.highslide img {
	border: 1px solid gray;
}
.highslide:hover img {
	border: 1px solid white;
}

.highslide-image {
	border: 0px solid black;
}
.highslide-image-blur {
}
.highslide-caption {
    display: none;
    border: 5px solid white;
    border-top: none;
    padding: 5px;
    background-color: white;
}
.highslide-loading {
    display: block;
	color: white;
	font-size: 9px;
	font-weight: bold;
	text-transform: uppercase;
    text-decoration: none;
	padding: 3px;
	border-top: 1px solid white;
	border-bottom: 1px solid white;
    background-color: black;
    padding-left: 22px;
    background-image: url(https://www.webaynet.com/highslide/graphics/loader.gif);
    background-repeat: no-repeat;
    background-position: 3px 1px;
    
}
a.highslide-credits,
a.highslide-credits i {
    padding: 2px;
    color: silver;
    text-decoration: none;
	font-size: 10px;
}
a.highslide-credits:hover,
a.highslide-credits:hover i {
    color: white;
    background-color: gray;
}

.highslide-display-block {
    display: block;
}
.highslide-display-none {
    display: none;
}

-->
</style>
<script>


function submitonce(theform){
//if IE 4+ or NS 6+
if (document.all||document.getElementById){
//screen thru every element in the form, and hunt down "submit" and "reset"
for (i=0;i<theform.length;i++){
var tempobj=theform.elements[i]
if(tempobj.type.toLowerCase()=="submit"||tempobj.type.toLowerCase()=="reset")
//disable em
tempobj.disabled=true
}
}
}
</script>
<STYLE type=text/css>
A:link {
	COLOR: #929292
}
BODY {
	BACKGROUND-IMAGE: none
}
.style9 {
	FONT-SIZE: 11px; COLOR: #7b7067; FONT-FAMILY: Tahoma, Arial
}
.style25 {
	color: #FFFFFF;
	font-size: 14px;
	font-weight: bold;
}
.style31 {	color: #5F5F5F;
	font-weight: bold;
}
.style32 {color: #FF0000}
.style34 {font-family: Tahoma, Arial; font-size: 11px; color: #7B7067; }
.style35 {FONT-SIZE: 11px; COLOR: #7b7067; FONT-FAMILY: Tahoma, Arial; font-weight: bold; }
.style36 {
	font-size: 11px;
	font-weight: bold;
}
.style16 {COLOR: #353535
}
.style19 {FONT-SIZE: 11px; COLOR: #353535; FONT-FAMILY: Tahoma, Arial
}
.style42 {font-size: 10px; color: #CCCCCC; }
</STYLE>
<SCRIPT language=JavaScript>
function MM_openBrWindow(theURL,winName,features) { //v2.0
window.open(theURL,winName,features);
}

function MM_openBrWindowEx(theURL,winName,features) { //v2.0 
	var nUrl;
//	nUrl = theURL + "?pr_qty=" + document.forms["FRM"].pr_qty.value;
	nUrl = nUrl + "&cardisim=" + document.forms["FRM"].cardisim.value;
	nUrl = nUrl + "&cardno=" + document.forms["FRM"].cardno.value;
	nUrl = nUrl + "&cv=" + document.forms["frmorder"].cv.value;
//	nUrl = nUrl + "&or_unvan=" + document.forms["frmorder"].or_unvan.value;
//	nUrl = nUrl + "&or_tel1=" + document.forms["frmorder"].or_tel1.value;
//	nUrl = nUrl + "&or_tel2=" + document.forms["frmorder"].or_tel2.value;
//	nUrl = nUrl + "&pr_donem=" + document.forms["frmorder"].pr_donem.value;
//	nUrl = nUrl + "&or_zip=" + document.forms["frmorder"].or_zip.value;
//	nUrl = nUrl + "&or_semt=" + document.forms["frmorder"].or_semt.value;
//	nUrl = nUrl + "&or_sehir=" + document.forms["frmorder"].or_sehir.value;
//	nUrl = nUrl + "&pr_kur=" + document.forms["frmorder"].pr_kur.value;
//	nUrl = nUrl + "&pr_tutar=" + document.forms["frmorder"].pr_tutar.value;
//	nUrl = nUrl + "&pr_toplam=" + document.forms["frmorder"].pr_toplam.value;
//	nUrl = nUrl + "&pr_ulke=" + document.forms["frmorder"].pr_ulke.options[document.forms["frmorder"].pr_ulke.selectedIndex].text;
	window.open(nUrl,winName,features); 
//	alert(nUrl);
} 

function form_control_ex() {

	if (FRM.Adi.value == '') {
	alert("Lütfen Adınızı ve Soy Adınızı Belirtiniz.");
	FRM.Adi.focus();
	return false;  
	}
	
	if (FRM.email.value == '') {
	alert("Lütfen mail bilgilerinizi doldurunuz.");
	FRM.email.focus();
	return false;  
	}
	
	var epostasi = FRM.email.value
	if ( (epostasi.indexOf ('@',0) == -1) || (epostasi.indexOf('.',0) == -1) || (epostasi.indexOf(' ',0) != -1) || (epostasi.length<6) || epostasi.indexOf ('@',0) != epostasi.lastIndexOf ('@') )
	{
	alert ("Yanlış bir mail formatı girdiniz , lütfen doğru formatlara sahip bir mail giriniz.");
	FRM.email.focus();
	return false;
	}
	
	if (FRM.telefon.value == '') {
	alert("Lütfen telefon numaranızı belirtiniz.");
	FRM.telefon.focus();
	return false;  
	}
	
	if (FRM.ip.value == '') {
	alert("Lütfen sabit ip adresinizi belirtiniz. Eğer henüz almadıysanız (0 sıfır) koyunuz.");
	FRM.ip.focus();
	return false;  
	}

	if (FRM.unvan.value == '') {
	alert("Lütfen Cafe nizin ismini belirtiniz.");
	FRM.unvan.focus();
	return false;  
	}

	if (FRM.il.value == '') {
	alert("Lütfen Bulunduğunuz Şehri seçiniz.");
	FRM.il.focus();
	return false;  
	}

	if (FRM.ilce.value == '') {
	alert("Lütfen Bulunduğunuz ilçeyi seçiniz.");
	FRM.ilce.focus();
	return false;  
	}

	if (FRM.vdaire.value == '') {
	alert("Lütfen bağlı olduğunuz vergi dairenizi belirtiniz.");
	FRM.vdaire.focus();
	return false;  
	}
	if (FRM.vno.value == '') {
	alert("Lütfen vergi numaranızı belirtiniz.");
	FRM.vno.focus();
	return false;  
	}


	if (FRM.adres.value == '') {
	alert("Lütfen Adresinizi Belirtiniz.");
	FRM.adres.focus();
	return false;  
	}

	if (FRM.cardisim.value == "") {
		alert("LÜTFEN KARTINIZIN ÜSTÜNDE YAZAN İSMİ GİRİNİZ.");
		FRM.cardisim.focus();
		return false;  
	}

	if (FRM.cardno.value == "") {
		alert("LÜTFEN KART NUMARANIZI GİRİNİZ.");
		FRM.cardno.focus();
		return false;  
	}

	if (FRM.ay.value == "") {
		alert("LÜTFEN KARTINIZIN SON KULLANMA TARİHİNDE Kİ AY HANESİNİ SEÇİNİZ.");
		FRM.ay.focus();
		return false;  

	}

	if (FRM.yil.value == "") {
		alert("LÜTFEN KARTINIZIN SON KULLANMA TARİHİNDE Kİ YIL HANESİNİ SEÇİNİZ.");
		FRM.yil.focus();
		return false;  
	}

	if (FRM.cv.value == "") {
		alert("LÜTFEN KARTINIZIN ARKASINDAKİ GÜVENLİK KODUNU YAZINIZ.(SON ÜÇ RAKAMDIR)");
		FRM.cv.focus();
		return false;  
	}
	
document.forms["FRM"].Submit.disabled = true;
return true;
}
</SCRIPT>

<META content="MSHTML 6.00.2900.3086" name=GENERATOR></HEAD>
<BODY bottomMargin=0 bgColor=#ffffff leftMargin=0 topMargin=0 
onload=DoDD1Change() rightMargin=0 MARGINHEIGHT="0" MARGINWIDTH="0">
<CENTER>
<TABLE cellSpacing=0 cellPadding=0 width=649 border=0>
  <TBODY>
    <TR>
      <TD><div align="center"><img src="images/step1.jpg" width="413" height="105"></div></TD>
    </TR>

  <TR>
    <TD><div align="center"><FORM id="FRM" name="FRM" action="sanal_pos.php" method="post" onSubmit="return form_control_ex();">
      <TABLE cellSpacing=2 cellPadding=2 width=100% border=0>
        <TBODY>
        
        
        <TR vAlign=top align=left>
          <TD width="186%" colSpan=2 align="center" vAlign=center scope=row><img src="../../images/90YTL.jpg" width="541" height="239">            <input name="fiyat" type="hidden" id="GENTOP" value="90"></TD></TR>
        
        <TR vAlign=top align=left>
          <TD colspan="2" scope=row><table width="500" border="0" align="center" cellpadding="2" cellspacing="2">
            <tbody>
              <tr valign="top" align="left">
                <td height="16" colspan="2" valign="middle" bgcolor="#FF0000" scope="row"><div align="left" class="style1 style25">TESLİMAT VE KİŞİSEL BİLGİLERİNİZ</div></td>
              </tr>
              <tr valign="top" align="left">
                <td scope="row">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr valign="top" align="left">
                <td scope="row"><strong class="style9">ADINIZ SOYADINIZ / UNVAN *<br>
                  <span class="style42">(CAFE SAHİBİNİN)</span> </strong></td>
                <td><strong class="style9">E-POSTA ADRESİNİZ *<br>
                    <span class="style42">(SÜREKLİ KULLANDIĞINIZ BİR E-POSTA)</span></strong></td>
              </tr>
              <tr valign="top" align="left">
                <td scope="row" width="49%"><span class="style16">
                  <input class="style9" id="Adi" name="Adi" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" />
                </span></td>
                <td width="51%"><span class="style16">
                  <input class="style9" id="email" 
            name="email" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left"/>
                </span></td>
              </tr>
              <tr valign="top" align="left">
                <td class="style9"><strong>TELEFON NUMARANIZ *</strong></td>
                <td class="style9"><strong>SABİT IP ADRESİNİZ *</strong></td>
              </tr>
              <tr valign="top" align="left">
                <td><span class="style16">
                  <input name="telefon" class="style9" id="telefon" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" maxlength="11" />
                  </span></td>
                <td><span class="style9"><span class="style16">
                  <input name="ip" class="style9" id="ip" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" maxlength="20" />
                  </span></span></td>
              </tr>
              <tr valign="top" align="left">
                <td class="style9" scope="row"><strong>GSM NUMARANIZ (isteğe bağlı)</strong></td>
                <td scope="row"><strong class="style9">CAFE ADI</strong> *</td>
              </tr>
              <tr valign="top" align="left">
                <td scope="row"><span class="style16">
                  <input name="GSM" class="style9" id="GSM" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" maxlength="11" />
                </span></td>
                <td scope="row"><span class="style16">
                  <input class="style9" id="unvan" 
            name="unvan" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" />
                </span></td>
              </tr>

              <tr valign="top" align="left">
                <td scope="row"><strong class="style9">İL *</strong></td>
                <td><strong class="style9">İLÇE *</strong></td>
              </tr>
              <tr valign="top" align="left">
                <td scope="row"><select name="il" onChange="ilDegistir(document.FRM.ilce,this.options[this.options.selectedIndex].value,&quot;FRM&quot;)">
<option value selected>--Lütfen Seçiniz--</option>

<option value="1">&nbsp;İstanbul</option>

<option value="2">&nbsp;Ankara</option>

<option value="3">&nbsp;İzmir</option>

<option value="4">&nbsp;Adana</option>

<option value="5">&nbsp;Adıyaman</option>

<option value="6">&nbsp;Afyon</option>

<option value="7">&nbsp;Ağrı</option>

<option value="8">&nbsp;Aksaray</option>

<option value="9">&nbsp;Amasya</option>

<option value="10">&nbsp;Antalya</option>

<option value="11">&nbsp;Ardahan</option>

<option value="12">&nbsp;Artvin</option>

<option value="13">&nbsp;Aydın</option>

<option value="14">&nbsp;Balıkesir</option>

<option value="15">&nbsp;Bartın</option>

<option value="16">&nbsp;Batman</option>

<option value="17">&nbsp;Bayburt</option>

<option value="18">&nbsp;Bilecik</option>

<option value="19">&nbsp;Bingöl</option>

<option value="20">&nbsp;Bitlis</option>

<option value="21">&nbsp;Bolu</option>

<option value="22">&nbsp;Burdur</option>

<option value="23">&nbsp;Bursa</option>

<option value="24">&nbsp;Çanakkale</option>

<option value="25">&nbsp;Çankırı</option>

<option value="26">&nbsp;Çorum</option>

<option value="27">&nbsp;Denizli</option>

<option value="28">&nbsp;Diyarbakır</option>

<option value="29">&nbsp;Edirne</option>

<option value="30">&nbsp;Elazığ</option>

<option value="31">&nbsp;Erzincan</option>

<option value="32">&nbsp;Erzurum</option>

<option value="33">&nbsp;Eskişehir</option>

<option value="34">&nbsp;Gaziantep</option>

<option value="35">&nbsp;Giresun</option>

<option value="36">&nbsp;Gümüşhane</option>

<option value="37">&nbsp;Hakkari</option>

<option value="38">&nbsp;Hatay</option>

<option value="39">&nbsp;Iğdır</option>

<option value="40">&nbsp;Isparta</option>

<option value="41">&nbsp;İçel</option>

<option value="42">&nbsp;Kars</option>

<option value="43">&nbsp;Kastamonu</option>

<option value="44">&nbsp;Kayseri</option>

<option value="45">&nbsp;Kırıkkale</option>

<option value="46">&nbsp;Kırklareli</option>

<option value="47">&nbsp;Kırşehir</option>

<option value="48">&nbsp;Kocaeli</option>

<option value="49">&nbsp;Konya</option>

<option value="50">&nbsp;Kütahya</option>

<option value="51">&nbsp;Malatya</option>

<option value="52">&nbsp;Manisa</option>

<option value="53">&nbsp;Kahramanmaraş</option>

<option value="54">&nbsp;Karabük</option>

<option value="55">&nbsp;Karaman</option>

<option value="56">&nbsp;Kilis</option>

<option value="57">&nbsp;Mardin</option>

<option value="58">&nbsp;Muğla</option>

<option value="59">&nbsp;Muş</option>

<option value="60">&nbsp;Nevşehir</option>

<option value="61">&nbsp;Niğde</option>

<option value="62">&nbsp;Ordu</option>

<option value="63">&nbsp;Osmaniye</option>

<option value="64">&nbsp;Rize</option>

<option value="65">&nbsp;Sakarya</option>

<option value="66">&nbsp;Samsun</option>

<option value="67">&nbsp;Siirt</option>

<option value="68">&nbsp;Sinop</option>

<option value="69">&nbsp;Sivas</option>

<option value="70">&nbsp;Tekirdağ</option>

<option value="71">&nbsp;Tokat</option>

<option value="72">&nbsp;Trabzon</option>

<option value="73">&nbsp;Tunceli</option>

<option value="74">&nbsp;Şanlıurfa</option>

<option value="75">&nbsp;Şırnak</option>

<option value="76">&nbsp;Uşak</option>

<option value="77">&nbsp;Van</option>

<option value="78">&nbsp;Yalova</option>

<option value="79">&nbsp;Yozgat</option>

<option value="80">&nbsp;Zonguldak</option>

<option value="81">&nbsp;Düzce</option>
</select></td>
                <td><span class="style16">
                  <input class="style9" id="ilce" 
            name="ilce" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" />
</span></td>
              </tr>
              <tr valign="top" align="left">
                <td class="style9" scope="row"><strong>VERGİ DAİRENİZ * </strong></td>
                <td class="style9"><strong>VERGİ NUMARANIZ *</strong></td>
              </tr>
              <tr valign="top" align="left">
                <td scope="row"><span class="style16">
                  <input class="style9" id="vdaire" 
            name="vdaire" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" />
                </span></td>
                <td><span class="style16">
                  <input 
            name="vno" class="style9" id="vno" maxlength="10" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" />
                </span></td>
              </tr>

              <tr valign="top" align="left">
                <td scope="row" colspan="2"><strong class="style9">ÜRÜN VE FATURA TESLİMAT ADRESİNİZ</strong><br />
                    <input name="adres" type="text" class="style19" id="adres" value="" size="50" maxlength="50">
                    <input name="adres_sec" type="text" class="style19" id="adres_sec" value="" size="50" maxlength="50">
                    <input name="adres_thi" type="text" class="style19" id="adres_thi" value="" size="50" maxlength="50">
                  *</td>
              </tr>
              <tr valign="top" align="left">
                <td scope="row" colspan="2"><strong class="style9">VARSA ÖZEL MESAJINIZ</strong><br />
                  <textarea class="style19" id="Mesaj" name="Mesaj" rows="5" cols="63"></textarea></td>
              </tr>
              </tbody>
          </table>
            </TD>
        </TR>
        <TR vAlign=top align=left>
          <TD colspan="2" scope=row><table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#999999">
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="30" colspan="3" bgcolor="#990000"><div align="center">
                    <p><span class="style25"><br>
                      KREDİ KARTI BİLGİLERİ</span><br>
                      <br>
                    </p>
</div></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td width="46%"><div align="right" class="style35">KART ÜZERİNDEKİ İSİM </div></td>
                  <td width="4%"><div align="center"><strong>:</strong></div></td>
                  <td width="50%"><input name="cardisim" type="text" class="style34" id="cardisim" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" autocomplete="off"></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>

                  <td><div align="right" class="style9"><strong>KART NUMARASI </strong></div></td>
                  <td><div align="center"><strong>:</strong></div></td>
                  <td><input name="cardno" type="text" class="style34" id="cardno" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: center" maxlength="16" autocomplete="off"></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><div align="right" class="style35">SON KULLANMA TARİHİ </div></td>
                  <td><div align="center"><strong>:</strong></div></td>
                  <td><select name="ay" class="style35">
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                  </select>
                    <strong>/</strong>
                    <select name="yil" class="style35">
                      <option value="07" >2007</option>
                      <option value="08" >2008</option>
                      <option value="09" >2009</option>
                      <option value="10" >2010</option>
                      <option value="11" >2011</option>
                      <option value="12">2012</option>
                      <option value="13">2013</option>
                      <option value="14">2014</option>
                    </select></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><div align="right" class="style35">(CVV2 veya CVC2) GÜVENLİK NO </div></td>
                  <td><div align="center"><strong>:</strong></div></td>
                  <td><input name="cv" type="text" class="style24" id="cv" size="2" maxlength="4" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: center" autocomplete="off"/><a id="thumb1" href="images/CVV2.png" class="highslide" onClick="return hs.expand(this)">
	<img src="images/16help.png" alt="CVV2 KODU NEDİR ?" width="16" height="16" border="0" align="absmiddle"
		title="BÜYÜK HALİ İÇİN TIKLAYINIZ" /></a></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td><input class=style35 id=Submit type=submit value="İşlemi Tamamla  &gt;&gt;"></td>
                </tr>
                <tr>
                  <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="2%">&nbsp;</td>
                        <td width="97%"><ul>
                          <li>(*) Güvenlik nedeni ile Kredi Kartı bilgileri hiç bir şekilde sistemimizde tutulmamaktadır. Direkt olarak banka pos sistemine bağlı olarak çalışmaktadır. </li>
                          <li>Şu an da yapmakta olduğunuz işlem 128 Bit SSL şifreleme yöntemi ile yapılmakta olup, Dünya'nın en güvenli ödeme sistemidir.</li>
                          <li>Güvenli bir şekilde kart bilgilerinizi girerek alışverişinizi tamamlayabilirsiniz.</li>
                        </ul>
                        </td>
                        <td width="1%">&nbsp;</td>
                      </tr>
                    </table></td>
                  </tr>
                
              </table></td>
            </tr>
          </table></TD>
        </TR>
        </TBODY></TABLE>
      </FORM></div></TD>
  </TR>
  </TBODY></TABLE>
</CENTER></BODY></HTML>
