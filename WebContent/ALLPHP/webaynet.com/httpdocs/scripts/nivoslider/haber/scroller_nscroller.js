var titlea = new Array();var texta = new Array();var linka = new Array();var trgfrma = new Array();var heightarr = new Array();var cyposarr = new Array();
cyposarr[0]=0;cyposarr[1]=1;cyposarr[2]=2;cyposarr[3]=3;
titlea[0] = "Telekomünikasyon Kurumunca Yasaklanan Web Siteleri";texta[0] = "Bazı web siteleri yeni yasalar gereği yasaklanmıştır. Herhangi bir sitenin T.İ.B. (Telekomünikasyon İletişim Başkanlığı) Tarafından yasaklanıp yasaklanmadığını öğrenmek için lütfen buraya tıklayınız.";linka[0] = "http://www.webaynet.com/tr/blacklist/index.php";trgfrma[0] = "_parent";titlea[1] = "Fethi Şimşek'ten Çok Önemli Açıklama";texta[1] = "Telekomünikasyon İletişim Başkanı Fethi Şimşek Basın Toplantısı ile Internet cafelerdeki denetimlerde nelere dikkat edilmesi konusunda bilgi verdi. Internet cafeler için çok önemli olan bir çok bilgilerin paylaşıldığı bu haberi mutlaka takip ediniz.";linka[1] = "http://haber.gazetevatan.com/internet-kafe-patlamasi-yasanan-3-il/344911/7/Yasam";trgfrma[1] = "_blank";titlea[2] = "T.İ.B. Kurumunca Hazırlanan Video";texta[2] = "Internet Cafelerin resmi kişilerce nasıl denetlenmesi gerektiği konusunda çok net bir şekilde anlatılan bu animasyon video çok önemli bilgiler içermektedir. Cafelerin denetlenmesinde en büyük sorun olan denetime gelenin memurun bilinçsiz bir şekilde denetleme yapmasını engellemek amacı ile böyle bir video hazırlanması düşünülmüştür.";linka[2] = "http://www.guvenliweb.org.tr/e_ogrenme/";trgfrma[2] = "_blank";titlea[3] = "İç IP Logu Nasıl Tutulmalı ?";texta[3] = "Başta Internet cafeler olmak üzere bir ağa sahip her türlü kurum ve işyerini ilgilendiren İç IP Logunun nasıl tutulacağı konusundaki tüm bilgilere buradan ulaşabilirsiniz. Bu logların yanlış bilinmesinden ötürü bir çok kişi ve kurum haksız cezalar almaktadırlar.";linka[3] = "http://www.webaynet.com/ic_ip_log_imzalayici.php";trgfrma[3] = "_parent";
var mc=4;

uagent = window.navigator.userAgent.toLowerCase();IEB=(uagent.indexOf('msie') != -1)?true:false;var scompat = document.compatMode;var inoout=false;var tmpv;tmpv=375-4-4-2*parseInt(0);var cvar=0,say=0,tpos=0,enson=0,hidsay=0,hidson=0;var psy = new Array();var lllllllllll = new Array();var llllll=null;var llllll2=null;var lllllll=0;var llllllll=0;divtextb ="<div id=\"d";divtev1=" onmouseover=\"ll(";divtev2=")\" onmouseout =\"lll(";divtev3=")\" onclick=\"butclick(";divtev4=")\"";divtexts = " style=\"position:absolute;visibility:hidden;width:"+tmpv+"px; COLOR:"+"#000000"+"; left:0px; top:0px; FONT-FAMILY:"+"MS Sans Serif,arial,helvetica"+"; FONT-SIZE:"+8+"pt; FONT-STYLE:"+"normal"+"; FONT-WEIGHT:"+"normal"+"; margin:0px; LINE-HEIGHT:"+12+"pt; text-align:"+"left"+";overflow-x:hidden;padding:0px; cursor:default;\">";ie6span= " style=\"position:relative; COLOR:"+"#FF0000"+"; width:"+tmpv+"px; FONT-FAMILY:"+"verdana,arial,helvetica"+"; FONT-SIZE:"+9+"pt; FONT-STYLE:"+"normal"+"; FONT-WEIGHT:"+"bold"+"; TEXT-DECORATION:"+"none"+"; LINE-HEIGHT:"+14+"pt; text-align:"+"left"+";padding:0px;\"";uzun="<div id=\"enuzun\" style=\"position:absolute;left:0px;top:0px;\">";uzun2="<div id=\"enuzun2\" style=\"position:absolute;left:0px;top:0px;\">";divtextb2 ="<div id=\"dz";function ll(gnum,gnum5){inoout=true;if((linka[gnum].length)>2){var objd=null;var objd2=null;var objd3=null;if(gnum5==1){objd=document.getElementById("dz"+gnum);objd2=document.getElementById("hgdz"+gnum);objd3=document.getElementById("tzid"+gnum);}else{objd=document.getElementById("d"+gnum);objd2=document.getElementById("hgd"+gnum);objd3=document.getElementById("tid"+gnum);}objd.style.color="#09AFFF";objd2.style.color="#06AEFF";objd.style.cursor='pointer';objd2.style.cursor='pointer';objd3.style.textDecoration="none";objd2.style.textDecoration="none";window.status=""+linka[gnum];}else{window.status="";}}function lll(gnum2,gnum5){inoout=false;var objd=null;var objd2=null;var objd3=null;if(gnum5==1){objd=document.getElementById("dz"+gnum2);objd2=document.getElementById("hgdz"+gnum2);objd3=document.getElementById("tzid"+gnum2);}else{objd=document.getElementById("d"+gnum2);objd2=document.getElementById("hgd"+gnum2);objd3=document.getElementById("tid"+gnum2);}objd.style.color="#000000";objd2.style.color="#FF0000";objd3.style.textDecoration="none";objd2.style.textDecoration="none";window.status="";}function butclick(gnum3){if(linka[gnum3].substring(0,11)=="javascript:"){eval(""+linka[gnum3]);}else{if((linka[gnum3].length)>3){
if((trgfrma[gnum3].indexOf("_parent")>-1)){eval("parent.window.location='"+linka[gnum3]+"'");}else if((trgfrma[gnum3].indexOf("_top")>-1)){eval("top.window.location='"+linka[gnum3]+"'");}else{window.open(''+linka[gnum3],''+trgfrma[gnum3]);}}}}function lllll(){if(1==0){if(inoout==false){lllllll--;if(lllllll<(-1*llllllll)){lllllll=139;}llllll.style.top=""+lllllll+"px";}if(psy[(lllllll*(-1))+2]==3){setTimeout('lllll()',3000+0);}else{setTimeout('lllll()',0);}}else if(1==1){if(inoout==false){dahayok=false;lllllll--;for(i=0;i<mc;i++){lllllllllll[i].style.top=""+(lllllll+(i*139))+"px";if((lllllll+(i*139))==2){dahayok=true;}}if(lllllll<(-1*(mc-1)*139)){lllllllllll[0].style.top=""+(lllllll+(mc*139))+"px";if((lllllll+(i*139))==2){dahayok=true;}}if(lllllll<(-1*(mc)*139)){lllllll=0;}}if(dahayok==true){setTimeout('lllll()',4000);}else{setTimeout('lllll()',0);}}else if(1==2){if(inoout==false){lllllll--;if(lllllll<(-1*llllllll)){lllllll=0;llllll2.style.top=""+139+"px"; }llllll.style.top=""+lllllll+"px";    if((lllllll+llllllll)<139){llllll2.style.top=""+(lllllll+llllllll)+"px";}    }if(psy[(lllllll*(-1))+2]==3){setTimeout('lllll()',3000+0);}else{setTimeout('lllll()',0);}}}function lllllllll2(){for(i=0;i<mc;i++){lllllllllll[i]=document.getElementById("d"+i);if(!lllllllllll[i]){setTimeout('lllllllll2()',200);return;}}if(1==0){i=0;for(i=0;i<mc;i++){heightarr[i]=parseInt(lllllllllll[i].offsetHeight);}llllllll=2;for(i=0;i<mc;i++){lllllllllll[i].style.visibility="visible";lllllllllll[i].style.top=""+llllllll+"px";psy[llllllll]=3;llllllll=llllllll+heightarr[i]+10;}llllll=document.getElementById('enuzun');llllll.style.left=4+"px";llllll.style.height=llllllll+"px";llllll.style.width=tmpv+"px";}else if(1==1){llllllll=2;for(i=0;i<mc;i++){lllllllllll[i].style.visibility="visible";lllllllllll[i].style.top=""+(llllllll+(139*i))+"px";lllllllllll[i].style.left=""+4+"px";}}else if(1==2){i=0;for(i=0;i<mc;i++){heightarr[i]=parseInt(lllllllllll[i].offsetHeight);}llllllll=2;for(i=0;i<mc;i++){objd2=document.getElementById("dz"+i);lllllllllll[i].style.visibility="visible";objd2.style.visibility="visible";lllllllllll[i].style.top=""+llllllll+"px";objd2.style.top=""+llllllll+"px";psy[llllllll]=3;llllllll=llllllll+heightarr[i]+10;}llllll=document.getElementById('enuzun');llllll.style.left=4+"px";llllll.style.height=llllllll+"px";llllll.style.width=tmpv+"px";llllll.style.top=139+"px";llllll2=document.getElementById('enuzun2');llllll2.style.left=4+"px";llllll2.style.height=llllllll+"px";llllll2.style.width=tmpv+"px";llllll2.style.top=139+"px";}lllllll=139;lllll();}function lllllllll(){i=0;if(1==1){innertxt="";}else{innertxt=""+uzun;}for(i=0;i<mc;i++){innertxt=innertxt+""+divtextb+""+i+"\""+divtev1+i+",0"+divtev2+i+",0"+divtev3+i+divtev4+divtexts+"<span id=\"hgd"+i+"\""+ie6span+">"+titlea[i]+"</span><br>"+"<span id=\"tid"+i+"\" style=\"TEXT-DECORATION:"+"none"+";\">"+texta[i]+"</span>"+"</div>";}if(1==1){}else{innertxt=innertxt+"</div>";}if(1==2){innertxt=""+innertxt+uzun2;for(i=0;i<mc;i++){innertxt=innertxt+""+divtextb2+""+i+"\""+divtev1+i+",1"+divtev2+i+",1"+divtev3+i+divtev4+divtexts+"<span id=\"hgdz"+i+"\""+ie6span+">"+titlea[i]+"</span><br>"+"<span id=\"tzid"+i+"\" style=\"TEXT-DECORATION:"+"none"+";\">"+texta[i]+"</span>"+"</div>";}innertxt=innertxt+"</div>";}if(IEB==true){spage=document.getElementById('spageie');}else{spage=document.getElementById("spagens");}spage.innerHTML=""+innertxt;setTimeout('lllllllll2()',100);}function BuildHtmlCont(){PlcHoldDiv=document.getElementById("plcholddiv");if(!PlcHoldDiv){setTimeout('BuildHtmlCont()',100);return;}var intext="";intext="<div id=\"disspageie\" style=\"position:absolute;width:"+375+"px; height:"+139+"px;left:0px; top:0px;margin:0px;overflow:hidden;padding:0px;border-style:"+"solid"+"; border-width:"+0+"px; border-color:"+"#666666"+";background-image: url("+"scrolbacround.png"+"); background-repeat :no-repeat;background-position:"+"0"+"px "+"0"+"px;\"><div id=\"spageie\" style=\"position:absolute;width:"+375+"px; height:"+139+"px; left:0px; top:0px; border-style:solid; border-width:0px; border-color:"+"#666666"+";overflow:hidden;clip:rect("+"2 375 137 0"+");\"></div></div>";if(IEB!=true){intext=intext+"<div id=\"spagensbrd\" style=\"position:absolute; width:"+(375-2*0)+"px; height:"+(139-2*0)+"px; left:0px; top:0px; border-style:"+"solid"+"; border-width:"+0+"px; border-color:"+"#666666"+";overflow:hidden;\"><div id=\"spagens\" style=\"position:absolute; width:"+(375-2*0)+"; height:"+(139-2*0)+"; left:0; top:0; border-width:0px; overflow:hidden;clip:rect("+"2 375 137 0"+");\"></div></div>";}PlcHoldDiv.innerHTML=""+intext;setTimeout('lllllllll()',100);}setTimeout('BuildHtmlCont()',100);