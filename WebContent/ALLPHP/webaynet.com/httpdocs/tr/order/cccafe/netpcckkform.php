<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0044)https://www.webaynet.com/tr/npbankhform.html -->
<HTML><HEAD><TITLE><< KRED� KARTI POS FORMU >></TITLE>
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
		if(from == 'iller') defOpt = '--L�tfen Se�iniz--';
		else  defOpt = '--Se�iniz--';
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
illerArr[0] = "Avc�lar,Ba�c�lar,Bak�rk�y,Bah�elievler,Bayrampa�a,Be�ikta�,Beyo�lu,B�y�k�ekmece,�atalca,Emin�n�,Ey�p,Esenler,Fatih,Gaziosmanpa�a,G�ng�ren,Ka��thane,K���k�ekmece,Sar�yer,Silivri,�i�li,Zeytinburnu";
illerArr[1] = "Avc�lar,Ba�c�lar,Bak�rk�y,Bah�elievler,Bayrampa�a,Be�ikta�,Beyo�lu,B�y�k�ekmece,�atalca,Emin�n�,Ey�p,Esenler,Fatih,Gaziosmanpa�a,G�ng�ren,Ka��thane,K���k�ekmece,Sar�yer,Silivri,�i�li,Zeytinburnu";
illerArr[2] = "Akyurt,Alt�nda�,Aya�,Bala,Beypazar�,�aml�dere,�ankaya,�ubuk,Elmada�,Etimesgut,Evren,G�lba��,G�d�l,Haymana,Kalecik,Kazan,Ke�i�ren,K�z�lcahamam,Mamak,Nallihan,Polatl�,Sincan,�erefliko�hisar,Yenimahalle,Merkez";
illerArr[3] = "Alia�a,Bay�nd�r,Bal�ova,Bergama,Beyda�,Bornova,Buca,�e�me,�i�li,Dikili,Fo�a,Gaziemir,G�zelbah�e,Karaburun,Kar��yaka,Kemalpa�a,K�n�k,Kiraz,Konak,Menderes,Menemen,Narlidere,�demi�,Seferihisar,Sel�uk,Tire,Torbal�,Urla,Merkez";
illerArr[4] = "Alada�,Ceyhan,Feke,�mamo�lu,Karaisal�,Karata�,Kozan,Pozant�,Saimbeyli,Seyhan,Tufanbeyli,Yumurtal�k,Y�re�ir,Merkez";
illerArr[5] = "Besni,�elikhan,Gerger,G�lba��,Kahta,Samsat,Sincik,Tut,Merkez";
illerArr[6] = "Ba�mak��,Bayat,Bolvadin,�obanlar,�ay,Dazk�r�,Dinar,Emirda�,Evciler,Hocalar,�hsaniye,�scehisar,K�z�l�ren,Sand�kl�,Sincanl�,Sultanda��,�uhut,Merkez";
illerArr[7] = "Diyadin,Do�ubeyazit,Ele�kirt,Hamur,Patnos,Ta�l��ay,Tutak,Merkez";
illerArr[8] = "A�a��ren,Eskil,G�la�a�,G�zelyurt,Ortak�y,Sar�yah�i,Merkez";
illerArr[9] = "G�yn�cek,G�m��hacik�y,Hamam�z�,Merzifon,Suluova,Ta�ova,Merkez";
illerArr[10] = "Akseki,Alanya,Demre,Elmal�,Finike,Gazipa�a,G�ndo�mu�,�bradi,Kale,Ka�,Kemer,Korkuteli,Kumluca,Manavgat,Serik,Merkez";
illerArr[11] = "��ld�r,Damal,G�le,Hanak,Posof,Merkez";
illerArr[12] = "Ardanu�,Arhavi,Bor�ka,Hopa,Murgul,�av�at,Yusufeli,Merkez";
illerArr[13] = "Bozdo�an,Buharkent,�ine,Germencik,�ncirliova,Karacasu,Karpuzlu,Ko�arl�,K��k,Ku�adas�,Kuyucak,Nazilli,S�ke,Sultanhisar,Yenihisar,Yenipazar,Merkez"; 
illerArr[14] = "Ayval�k,Ak�ay,Balya,Band�rma,Bigadi�,Burhaniye,Dursunbey,Edremit,Erdek,G�nen,G�me�,Havran,�vrindi,Kepsut,Manyas,Marmara,Sava�tepe,Sindirgi,Susurluk,Merkez";
illerArr[15] = "Amasra,Kuruca�ile,Ulus,Merkez";
illerArr[16] = "Gerc��,Hasankeyf,Be�iri,Kozluk,Sason,Merkez";
illerArr[17] = "Ayd�ntepe,Demir�z�,Merkez";
illerArr[18] = "Boz�y�k,G�lpazar�,�nhisar,Osmaneli,Pazaryeri,S���t,Yenipazar,Merkez";
illerArr[19] = "Adakl�,Gen�,Karl�ova,K���,Solhan,Yayladere,Yedisu,Merkez";
illerArr[20] = "Adilcevaz,Ahlat,G�roymak,Hizan,Mutki,Tatvan,Merkez";
illerArr[21] = "D�rtdivan,Gerede,G�yn�k,K�br�sc�k,Mengen,Mudurnu,Seben,Yeni�a�a,Merkez";
illerArr[22] = "Alt�nyayla,A�lasun,Bucak,�avd�r,�eltik�i,G�lhisar,Karamanl�,Kemer,Tefenni,Ye�ilova,Merkez";
illerArr[23] = "B�y�korhan,Gemlik,G�rsu,Harmanc�k,�neg�l,�znik,Karacabey,Keles,Kestel,Mudanya,Mustafakemal,Nil�fer,Orhaneli,Orhangazi,Osmangazi,Yeni�ehir,Y�ld�r�m,Merkez";
illerArr[24] = "Ayvac�k,Bayrami�,Bozcaada,Biga,�an,Eceabat,Ezine,Gelibolu,G�k�eada,Lapseki,Yenice,Merkez";
illerArr[25] = "Atkaracalar,Bayram�ren,�erke�,Eldivan,Ilgaz,K�z�l�rmak,Korgun,Kur�unlu,Orta,Ovac�k,�aban�z�,Yaprakl�,Merkez";
illerArr[26] = "Alaca,Bayat,Bo�azkale,Dodurga,�skilip,Karg�,La�in,Mecit�z�,O�uzlar,Ortak�y,Osmanc�k,Sungurlu,U�urluda�,Merkez";
illerArr[27] = "Ac�payam,Akk�y,Babada�,Baklan,Bekilli,Beya�a�,Buldan,Bozkurt,�al,�ameli,�ardak,�ivril,G�ney,Honaz,Kale,Sarayk�y,Serinhisar,Tavas,Merkez";
illerArr[28] = "Bismil,�ermik,��nar,��ng��,Dicle,E�il,Ergani,Hani,Hazro,Kocak�y,Kulp,Lice,Silvan,Merkez";
illerArr[29] = "Enez,Havsa,�psala,Ke�an,Lalapa�a,Meri�,S�lo�lu,Uzunk�pr�,Merkez";
illerArr[30] = "A��n,Alacakaya,Ar�cak,Baskil,Karako�an,Keban,Kovanc�lar,Maden,Palu,Sivrice,Merkez";
illerArr[31] = "�ay�rl�,Il��,Kemah,Kemaliye,Otlukbeli,Refahiye,Tercan,�z�ml�,Merkez";
illerArr[32] = "A�kale,�at,Hinis,Horasan,Il�ca,�spir,Kara�oban,Karayaz�,K�pr�k�y,Narman,Oltu,Olur,Pasinler,Pazaryolu,�enkaya,Tekman,Tortum,Uzundere,Merkez";
illerArr[33] = "Alpu,Beylikova,�ifteler,G�ny�z�,Han,�n�n�,Mahmudiye,Mihalgazi,Mihali��ik,Sar�cakaya,Seyitgazi,Sivrihisar,Merkez";
illerArr[34] = "Araban,�slahiye,Kargam��,Nizip,Nurda��,O�uzeli,�ahinbey,�ehitkamil,Yavuzeli,Merkez";
illerArr[35] = "Alucra,Bulancak,�amoluk,�anak��,Dereli,Do�ankent,Espiye,Eynesil,G�rele,G�ce,Ke�ap,Piraziz,�ebinkarahisar,Tirebolu,Ya�l�dere,Merkez";
illerArr[36] = "Kelkit,K�se,K�rt�n,�iran,Torul,Merkez";
illerArr[37] = "�ukurca,�emdinli,Y�ksekova,Merkez";
illerArr[38] = "Alt�n�z�,Belen,D�rtyol,Erzin,Hassa,�skenderun,K�r�khan,Kumlu,Reyhanl�,Samanda��,Yaylada��,Merkez";
illerArr[39] = "Aralik,Karakoyunlu,Tuzluca,Merkez";
illerArr[40] = "Aksu,Atabey,E�irdir,Gelendost,G�nen,Ke�iborlu,Senirkent,S�t��ler,�arkikaraa�,Uluborlu,Yeni�arbade,Yalva�,Merkez";
illerArr[41] = "Anamur,Ayd�nc�k,Bozyaz�,�aml�yayla,Erdemli,G�lnar,Mut,Silifke,Tarsus,Merkez";
illerArr[42] = "Akyaka,Arpa�ay,Digor,Ka��zman,Sar�kam��,Selim,Susuz,Merkez";
illerArr[43] = "Abana,A�l�,Ara�,Azdavay,Bozkurt,Cide,�atalzeytin,Daday,Devrekani,Do�anyurt,Han�n�,�hsangazi,�nebolu,K�re,P�narba��,Seydiler,�enpazar,Ta�k�pr�,Tosya,Merkez";
illerArr[44] = "Akk��la,B�nyan,Develi,Felahiye,Hac�lar,�ncesu,Kocasinan,Melikgazi,�zvatan,P�narba��,Sar�o�lan,Sar�z,Talas,Tomarza,Yahyal�,Ye�ilhisar,Merkez";
illerArr[45] = "Bah�ili,Ba�l��eyh,�elebi,Delice,Karake�ili,Keskin,Sulakyurt,Yah�ihan,Merkez";
illerArr[46] = "Babaeski,Demirk�y,Kof�az,L�leburgaz,Pehlivank�y,P�narhisar,Vize,Merkez";
illerArr[47] = "Ak�akent,Akp�nar,Boztepe,�i�ekda��,Kaman,Mucur,Merkez";
illerArr[48] = "Dar�ca,Gebze,G�lc�k,Kand�ra,Karam�rsel,K�rfez,Merkez";
illerArr[49] = "Ah�rl�,Ak�ren,Ak�ehir,Alt�nekin,Bey�ehir,Bozk�r,Derebucak,Cihanbeyli,�umra,�eltik,Derbent,Do�anhisar,Emirgazi,Ere�li,G�neys�n�r,Halkap�nar,Hadim,H�y�k,Ilg�n,Kad�nhan�,Karap�nar,Karatay,Kulu,Meram,Saray�n�,Sel�uklu,Seydi�ehir,Ta�kent,Tuzluk�u,Yal�h�y�k,Yunak,Merkez";
illerArr[50] = "Alt�nta�,Aslanapa,�avdarhisar,Domani�,Dumlup�nar,Emet,Gediz,Hisarc�k,Pazarlar,Simav,�aphane,Tav�anl�,Merkez";
illerArr[51] = "Ak�ada�,Arapgir,Arguvan,Battalgazi,Darende,Do�an�ehir,Do�anyol,Hekimhan,Kale,Kuluncak,P�t�rge,Yaz�han,Ye�ilyurt,Merkez";
illerArr[52] = "Ahmetli,Akhisar,Ala�ehir,Demirci,G�lmarmara,G�rdes,K�rka�a�,K�pr�ba�,Kula,Salihli,Sar�g�l,Saruhanl�,Selendi,Soma,Turgutlu,Merkez";
illerArr[53] = "Af�in,And�r�n,�a�layancer,Ekin�z�,Elbistan,G�ksun,Nurhak,Pazarc�k,T�rko�lu,Merkez";
illerArr[54] = "Eflani,Eskipazar,Ovac�k,Safranbolu,Yenice,Merkez";
illerArr[55] = "Ayranc�,Ba�yayla,Ermenek,Kaz�mkarabekir,Sar�veliler,Merkez";
illerArr[56] = "Elbeyli,Musabeyli,Polateli,Merkez";
illerArr[57] = "Darge�it,Derik,K�z�ltepe,Maz�da��,Midyat,Nusaybin,�merli,Savur,Ye�illi,Merkez";
illerArr[58] = "Bodrum,Dalaman,Dat�a,Fethiye,Kavakl�dere,K�yce�iz,Marmaris,Milas,Ortaca,Ula,Yata�an,Merkez";
illerArr[59] = "Bulan�k,Hask�y,Korkut,Malazgirt,Varto,Merkez";
illerArr[60] = "Ac�g�l,Avanos,Derinkuyu,G�l�ehir,Hac�bekta�,Kozakl�,�rg�p,Merkez";
illerArr[61] = "Altunhisar,Bor,�amard�,�iftlik,Uluk��la,Merkez";
illerArr[62] = "Akku�,Aybast�,�ama�,�atalp�nar,�ayba��,Fatsa,G�lk�y,G�lyal�,G�rgentepe,�kizce,Korgan,Kabad�z,Kabata�,Kumru,Mesudiye,Per�embe,Ulubey,�nye,Merkez";
illerArr[63] = "Bah�e,Hasanbeyli,D�zi�i,Kadirli,Sunba�,Toprakkale,Merkez";
illerArr[64] = "Arde�en,�aml�hem�in,�ayeli,Derepazar�,F�nd�kl�,G�neysu,Hem�in,�kizdere,�yidere,Kalkandere,Pazar,Merkez";
illerArr[65] = "Akyaz�,Ferizli,Geyve,Hendek,Karap�r�ek,Karasu,Kaynarca,Kocaali,Pamukova,Sapanca,S���tl�,Tarakl�,Merkez";
illerArr[66] = "Ala�am,Asarc�k,Ayvac�k,Bafra,�ar�amba,Havza,Kavak,Ladik,Sal�pazar�,Tekkek�y,Terme,Vezirk�pr�,Yakakent,Merkez";
illerArr[67] = "Ayd�nlar,Baykan,Eruh,Kozluk,Kurtalan,Pervari,�irvan,Merkez";
illerArr[68] = "Ayanc�k,Boyabat,Dikmen,Dura�an,Erfelek,Gerze,Sarayd�z�,T�rkeli,Merkez";
illerArr[69] = "Ak�nc�lar,Alt�nyayla,Divri�i,Do�an�ar,Gemerek,G�lova,G�r�n,Hafik,�mranl�,Kangal,Koyulhisar,Su�ehri,�ark��la,Ula�,Y�ld�zeli,Zara,Merkez";
illerArr[70] = "�erkezk�y,�orlu,Hayrabolu,Malkara,Marmaraere�li,Muratl�,Saray,�ark�y,Merkez";
illerArr[71] = "Almus,Artova,Ba��iftlik,Erbaa,Niksar,Pazar,Re�adiye,Sulusaray,Turhal,Ye�ilyurt,Zile,Merkez";
illerArr[72] = "Ak�aabat,Arakl�,Arsin,Be�ikd�z�,�ar��ba��,�aykara,Dernekpazar,D�zk�y,Hayrat,K�pr�ba��,Ma�ka,Of,S�rmene,�alpazar�,Tonya,Vakfikebir,Yomra,Merkez";
illerArr[73] = "�emi�gezek,Hozat,Mazgirt,Nazimiye,Ovac�k,Pertek,P�l�m�r,Merkez";
illerArr[74] = "Ak�akale,Birecik,Bozova,Ceylanp�nar,Halfeti,Harran,Hilvan,Siverek,Suru�,Viran�ehir,Merkez";
illerArr[75] = "Beyt���eba,Uludere,Cizre,�dil,Silopi,G��l�konak,Merkez";
illerArr[76] = "Banaz,E�me,Karahall�,Sivasl�,Ulubey,Merkez";
illerArr[77] = "Bah�esaray,Ba�kale,�ald�ran,�atak,Edremit,Erci�,Geva�,G�rp�nar,Muradiye,�zalp,Saray,Merkez";
illerArr[78] = "Alt�nova,Armutlu,��narc�k,�iftlikk�y,Termal,Merkez";
illerArr[79] = "Akda�madeni,Ayd�nc�k,Bo�azl�yan,�and�r,�ay�ralan,�ekerek,Kad��ehri,Sar�kaya,Saraykent,Sorgun,�efaatli,Yenifakili,Yerk�y,Merkez";
illerArr[80] = "Alapl�,�amoluk,�aycuma,Devrek,Eflani,Ere�li,G�k�ebey,Merkez";
illerArr[81] = "Ak�akoca,Cumayeri,�ilimli,G�lyaka,G�m��ova,Kaynasl�,Y���lca,Merkez";
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
	alert("L�tfen Ad�n�z� ve Soy Ad�n�z� Belirtiniz.");
	FRM.Adi.focus();
	return false;  
	}
	
	if (FRM.email.value == '') {
	alert("L�tfen mail bilgilerinizi doldurunuz.");
	FRM.email.focus();
	return false;  
	}
	
	var epostasi = FRM.email.value
	if ( (epostasi.indexOf ('@',0) == -1) || (epostasi.indexOf('.',0) == -1) || (epostasi.indexOf(' ',0) != -1) || (epostasi.length<6) || epostasi.indexOf ('@',0) != epostasi.lastIndexOf ('@') )
	{
	alert ("Yanl�� bir mail format� girdiniz , l�tfen do�ru formatlara sahip bir mail giriniz.");
	FRM.email.focus();
	return false;
	}
	
	if (FRM.telefon.value == '') {
	alert("L�tfen telefon numaran�z� belirtiniz.");
	FRM.telefon.focus();
	return false;  
	}
	
	if (FRM.ip.value == '') {
	alert("L�tfen sabit ip adresinizi belirtiniz. E�er hen�z almad�ysan�z (0 s�f�r) koyunuz.");
	FRM.ip.focus();
	return false;  
	}

	if (FRM.unvan.value == '') {
	alert("L�tfen Cafe nizin ismini belirtiniz.");
	FRM.unvan.focus();
	return false;  
	}

	if (FRM.il.value == '') {
	alert("L�tfen Bulundu�unuz �ehri se�iniz.");
	FRM.il.focus();
	return false;  
	}

	if (FRM.ilce.value == '') {
	alert("L�tfen Bulundu�unuz il�eyi se�iniz.");
	FRM.ilce.focus();
	return false;  
	}

	if (FRM.vdaire.value == '') {
	alert("L�tfen ba�l� oldu�unuz vergi dairenizi belirtiniz.");
	FRM.vdaire.focus();
	return false;  
	}
	if (FRM.vno.value == '') {
	alert("L�tfen vergi numaran�z� belirtiniz.");
	FRM.vno.focus();
	return false;  
	}


	if (FRM.adres.value == '') {
	alert("L�tfen Adresinizi Belirtiniz.");
	FRM.adres.focus();
	return false;  
	}

	if (FRM.cardisim.value == "") {
		alert("L�TFEN KARTINIZIN �ST�NDE YAZAN �SM� G�R�N�Z.");
		FRM.cardisim.focus();
		return false;  
	}

	if (FRM.cardno.value == "") {
		alert("L�TFEN KART NUMARANIZI G�R�N�Z.");
		FRM.cardno.focus();
		return false;  
	}

	if (FRM.ay.value == "") {
		alert("L�TFEN KARTINIZIN SON KULLANMA TAR�H�NDE K� AY HANES�N� SE��N�Z.");
		FRM.ay.focus();
		return false;  

	}

	if (FRM.yil.value == "") {
		alert("L�TFEN KARTINIZIN SON KULLANMA TAR�H�NDE K� YIL HANES�N� SE��N�Z.");
		FRM.yil.focus();
		return false;  
	}

	if (FRM.cv.value == "") {
		alert("L�TFEN KARTINIZIN ARKASINDAK� G�VENL�K KODUNU YAZINIZ.(SON �� RAKAMDIR)");
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
                <td height="16" colspan="2" valign="middle" bgcolor="#FF0000" scope="row"><div align="left" class="style1 style25">TESL�MAT VE K���SEL B�LG�LER�N�Z</div></td>
              </tr>
              <tr valign="top" align="left">
                <td scope="row">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr valign="top" align="left">
                <td scope="row"><strong class="style9">ADINIZ SOYADINIZ / UNVAN *<br>
                  <span class="style42">(CAFE SAH�B�N�N)</span> </strong></td>
                <td><strong class="style9">E-POSTA ADRES�N�Z *<br>
                    <span class="style42">(S�REKL� KULLANDI�INIZ B�R E-POSTA)</span></strong></td>
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
                <td class="style9"><strong>SAB�T IP ADRES�N�Z *</strong></td>
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
                <td class="style9" scope="row"><strong>GSM NUMARANIZ (iste�e ba�l�)</strong></td>
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
                <td scope="row"><strong class="style9">�L *</strong></td>
                <td><strong class="style9">�L�E *</strong></td>
              </tr>
              <tr valign="top" align="left">
                <td scope="row"><select name="il" onChange="ilDegistir(document.FRM.ilce,this.options[this.options.selectedIndex].value,&quot;FRM&quot;)">
<option value selected>--L�tfen Se�iniz--</option>

<option value="1">&nbsp;�stanbul</option>

<option value="2">&nbsp;Ankara</option>

<option value="3">&nbsp;�zmir</option>

<option value="4">&nbsp;Adana</option>

<option value="5">&nbsp;Ad�yaman</option>

<option value="6">&nbsp;Afyon</option>

<option value="7">&nbsp;A�r�</option>

<option value="8">&nbsp;Aksaray</option>

<option value="9">&nbsp;Amasya</option>

<option value="10">&nbsp;Antalya</option>

<option value="11">&nbsp;Ardahan</option>

<option value="12">&nbsp;Artvin</option>

<option value="13">&nbsp;Ayd�n</option>

<option value="14">&nbsp;Bal�kesir</option>

<option value="15">&nbsp;Bart�n</option>

<option value="16">&nbsp;Batman</option>

<option value="17">&nbsp;Bayburt</option>

<option value="18">&nbsp;Bilecik</option>

<option value="19">&nbsp;Bing�l</option>

<option value="20">&nbsp;Bitlis</option>

<option value="21">&nbsp;Bolu</option>

<option value="22">&nbsp;Burdur</option>

<option value="23">&nbsp;Bursa</option>

<option value="24">&nbsp;�anakkale</option>

<option value="25">&nbsp;�ank�r�</option>

<option value="26">&nbsp;�orum</option>

<option value="27">&nbsp;Denizli</option>

<option value="28">&nbsp;Diyarbak�r</option>

<option value="29">&nbsp;Edirne</option>

<option value="30">&nbsp;Elaz��</option>

<option value="31">&nbsp;Erzincan</option>

<option value="32">&nbsp;Erzurum</option>

<option value="33">&nbsp;Eski�ehir</option>

<option value="34">&nbsp;Gaziantep</option>

<option value="35">&nbsp;Giresun</option>

<option value="36">&nbsp;G�m��hane</option>

<option value="37">&nbsp;Hakkari</option>

<option value="38">&nbsp;Hatay</option>

<option value="39">&nbsp;I�d�r</option>

<option value="40">&nbsp;Isparta</option>

<option value="41">&nbsp;��el</option>

<option value="42">&nbsp;Kars</option>

<option value="43">&nbsp;Kastamonu</option>

<option value="44">&nbsp;Kayseri</option>

<option value="45">&nbsp;K�r�kkale</option>

<option value="46">&nbsp;K�rklareli</option>

<option value="47">&nbsp;K�r�ehir</option>

<option value="48">&nbsp;Kocaeli</option>

<option value="49">&nbsp;Konya</option>

<option value="50">&nbsp;K�tahya</option>

<option value="51">&nbsp;Malatya</option>

<option value="52">&nbsp;Manisa</option>

<option value="53">&nbsp;Kahramanmara�</option>

<option value="54">&nbsp;Karab�k</option>

<option value="55">&nbsp;Karaman</option>

<option value="56">&nbsp;Kilis</option>

<option value="57">&nbsp;Mardin</option>

<option value="58">&nbsp;Mu�la</option>

<option value="59">&nbsp;Mu�</option>

<option value="60">&nbsp;Nev�ehir</option>

<option value="61">&nbsp;Ni�de</option>

<option value="62">&nbsp;Ordu</option>

<option value="63">&nbsp;Osmaniye</option>

<option value="64">&nbsp;Rize</option>

<option value="65">&nbsp;Sakarya</option>

<option value="66">&nbsp;Samsun</option>

<option value="67">&nbsp;Siirt</option>

<option value="68">&nbsp;Sinop</option>

<option value="69">&nbsp;Sivas</option>

<option value="70">&nbsp;Tekirda�</option>

<option value="71">&nbsp;Tokat</option>

<option value="72">&nbsp;Trabzon</option>

<option value="73">&nbsp;Tunceli</option>

<option value="74">&nbsp;�anl�urfa</option>

<option value="75">&nbsp;��rnak</option>

<option value="76">&nbsp;U�ak</option>

<option value="77">&nbsp;Van</option>

<option value="78">&nbsp;Yalova</option>

<option value="79">&nbsp;Yozgat</option>

<option value="80">&nbsp;Zonguldak</option>

<option value="81">&nbsp;D�zce</option>
</select></td>
                <td><span class="style16">
                  <input class="style9" id="ilce" 
            name="ilce" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: left" />
</span></td>
              </tr>
              <tr valign="top" align="left">
                <td class="style9" scope="row"><strong>VERG� DA�REN�Z * </strong></td>
                <td class="style9"><strong>VERG� NUMARANIZ *</strong></td>
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
                <td scope="row" colspan="2"><strong class="style9">�R�N VE FATURA TESL�MAT ADRES�N�Z</strong><br />
                    <input name="adres" type="text" class="style19" id="adres" value="" size="50" maxlength="50">
                    <input name="adres_sec" type="text" class="style19" id="adres_sec" value="" size="50" maxlength="50">
                    <input name="adres_thi" type="text" class="style19" id="adres_thi" value="" size="50" maxlength="50">
                  *</td>
              </tr>
              <tr valign="top" align="left">
                <td scope="row" colspan="2"><strong class="style9">VARSA �ZEL MESAJINIZ</strong><br />
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
                      KRED� KARTI B�LG�LER�</span><br>
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
                  <td width="46%"><div align="right" class="style35">KART �ZER�NDEK� �S�M </div></td>
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
                  <td><div align="right" class="style35">SON KULLANMA TAR�H� </div></td>
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
                  <td><div align="right" class="style35">(CVV2 veya CVC2) G�VENL�K NO </div></td>
                  <td><div align="center"><strong>:</strong></div></td>
                  <td><input name="cv" type="text" class="style24" id="cv" size="2" maxlength="4" style="FONT-WEIGHT: bold; COLOR: black; TEXT-ALIGN: center" autocomplete="off"/><a id="thumb1" href="images/CVV2.png" class="highslide" onClick="return hs.expand(this)">
	<img src="images/16help.png" alt="CVV2 KODU NED�R ?" width="16" height="16" border="0" align="absmiddle"
		title="B�Y�K HAL� ���N TIKLAYINIZ" /></a></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td><input class=style35 id=Submit type=submit value="��lemi Tamamla  &gt;&gt;"></td>
                </tr>
                <tr>
                  <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="2%">&nbsp;</td>
                        <td width="97%"><ul>
                          <li>(*) G�venlik nedeni ile Kredi Kart� bilgileri hi� bir �ekilde sistemimizde tutulmamaktad�r. Direkt olarak banka pos sistemine ba�l� olarak �al��maktad�r. </li>
                          <li>�u an da yapmakta oldu�unuz i�lem 128 Bit SSL �ifreleme y�ntemi ile yap�lmakta olup, D�nya'n�n en g�venli �deme sistemidir.</li>
                          <li>G�venli bir �ekilde kart bilgilerinizi girerek al��veri�inizi tamamlayabilirsiniz.</li>
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
