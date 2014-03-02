<?php 
session_start();
include("../login/config.php");
include("../login/functions.php");
$id=$_SESSION["workviewer"];
if(!$id){
	header("location:index.php");	
}
$sorgu=pg_query("select * from registered_users where id = '$id'");
while($rows=pg_fetch_object($sorgu)){
	$key = $rows->reg_id;
	$id = $rows->id;
	$user_name = $rows->user_name;
	$userName = $rows->company_person_name;
	$user_pass = $rows->user_pass;
	$city = $rows->city;
	$district = $rows->district;
	$homephone = $rows->phone1;
	$mobilephone = $rows->phone2;
	$address = $rows->address1;
	$clientCount = $rows->license_client_count;
	$install_date=$rows->install_date;
	$sure=time()-strtotime($install_date);
	$days=$rows->license_client_days;
	$kalansure=$days*86400-$sure;
}
//echo $key;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Workviewer Mobile</title>
<link type="text/css" rel="stylesheet" href="css/jquery.mobile-1.3.2.min.css" />
<link type="text/css" rel="stylesheet" href="css/styles.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
function ajaxcall(port,id){
	$.ajax({
	type:"GET",
	url:"windows.php",
	data:"port="+port,
	success:function(a){
		$("#windowsrestrictions"+id).find(".windowscontent").html(a);
		$(".windowscontent").find("form").trigger("create");
		}
	})
	}
$( document ).bind( 'mobileinit', function(){
  $.mobile.loader.prototype.options.text = "Lütfen Bekleyin";
  $.mobile.loader.prototype.options.textVisible = true;
  $.mobile.loader.prototype.options.theme = "a";
  $.mobile.loader.prototype.options.html = "";
});
</script>
<script type="text/javascript" src="js/jquery.mobile-1.3.2.min.js"></script>
<script type="text/javascript">
$(function(){
	$(window).trigger('orientationchange');
	var key = "<?php echo $key; ?>";
	var clientCount = <?php echo $clientCount; ?>;
	clientCount = parseInt(clientCount);
	var kalansure = <?php echo $kalansure; ?>;
	var newimage_xhr = [];
	setInterval(function(){
	$.ajax({
            method:'get',
            url:'../login/getclients.php',
			data:"key="+key,
			cache:false,
            success:function(data){
			if(data!=''){
			var data2 = data.split(",");
			var yeni_gelen = data2.length;
			yeni_gelen = parseInt(yeni_gelen);
			var active_clients = $(".active_clients").text();
			}
			if(yeni_gelen>active_clients){
			$(".new_user_count").text((yeni_gelen-active_clients));
			$(".newUserAlert").slideDown(700);
			}else{
				$(".newUserAlert").slideUp(700);
				}
			}
			});
		},10000);
	$.ajax({
            method:'get',
            url:'../login/getclients.php',
			data:"key="+key,
			cache:false,
            success:function(data){
			if(data!=''){
			var data2 = data.split(",");
			$(".active_clients").text(data2.length);
			for(var i=0;i<data2.length;i++){
			$("#page"+(i+1)).find(".keydisk").val(data2[i]);
			}
			}else{
				$("#page"+(i+1)).find(".message").text("Şu anda geçici olarak görüntüler yüklenemiyor...");
				}
			},
			error:function(){
				$('.message').html("Şu anda geçici olarak görüntüler yüklenemiyor...");
				}
          }).done(function(){
		  $(".keydisk").each(function(i,obj){
			  	var diskkey = $(this).val();
				if(diskkey){
				$("#page"+(i+1)).find(".message").html('<i style="font-size:50px; color:#0477bd; margin-top:30px; display:inline-block" class="icon-spin2 animate-spin"></i> <p style="margin-top:10px;">Bağlantı Kuruluyor Lütfen Bekleyin...</p><button data-toggle="tooltip" title="Bağlantıyı Yenile" id="resetport2'+(i+1)+'" class="btn btn-warning resetport2"><i class="icon-arrows-cw-outline" style="font-size:16px;"></i></button>');
				$.ajax({
					method:"GET",
			 	  	url: "../login/getfilterport.php",
			   		data: "key="+diskkey,
			   		async: true,
					cache:false,
			   		success: function(port){
				  		$("#filterport"+(i+1)).val(port);
						$.get("../login/getuserinfo.php",{port:port},function(alias){
							/*$("#page"+(i+1)).find(".alias span").html(alias+'<i class="rename icon-edit-alt" id="renameit'+(i+1)+'" data-placement="bottom" data-toggle="tooltip" title="Yeniden Adlandır"></i>');
							$("#page"+(i+1)).find(".alias").append('<div class="gizle" id="rename'+(i+1)+'"><div class="input-group"><input type="text" id="renameinput'+(i+1)+'" class="form-control" value="'+alias+'" /><span class="input-group-btn"><button class="btn btn-primary changealias" id="changealias'+(i+1)+'" type="button">Değiştir</button></span></div></div>');
							*/
							$("#alias"+(i+1)).text(alias);
							$("#shutdownalias"+(i+1)).text(alias);
							$("#restartalias"+(i+1)).text(alias);
							$("#resetportalias"+(i+1)).text(alias);
							/*$("#clientname"+(i+1)).html("Bilgisayar Adı: "+alias);
							$(".rename").tooltip();
							*/
						});
					}
					});	
				 $.ajax({
					method:"GET",
			 	  	url: "../login/getportnumber.php",
			   		data: "key="+diskkey,
			   		async: true,
					cache:false,
			   		success: function(port){
				  		$("#port"+(i+1)).val(port);
					}
				}).done(function(){
		  $(".port").each(function(i,obj){
			var port = $(this).val();
			var portid = $(this).attr("id");
			portid = portid.split("port");
			portid = portid[1];
			var diskkkey = $("#keydisk"+portid).val();
			if(port){
			var newimage = function() {
						newimage_xhr = $.ajax({
						method:"GET",
						url: "../login/getclientscreen.php",
						data: "port="+port,
						async: true,
						success: function(image){
						if(image){
						if(kalansure<0){
					  	$("#page"+(i+1)).find(".screen").html('<div class="blurit"><span>Kullanım Süresi Doldu<span></div><img class="img-responsive" src="data:image/jpeg;base64,'+image+'" alt="Ekran Görüntüsü" />');
						}else{
						$("#page"+(i+1)).find(".screen").html('<img style="width:100%;" src="data:image/jpeg;base64,'+image+'" alt="Ekran Görüntüsü" />');
						//$("#page"+(i+1)).find(".buttons").fadeIn();
						}
						}else{
						$("#page"+(i+1)).find(".screen").html('Şu anda görüntü alınamıyor...');
						}
						if(image=="-2"){
						$("#page"+(i+1)).find(".screen").html('Portun değişmesi gerekiyor...');
						/* Portu Resetle*/
						$.get("../login/resetport.php",{key:diskkkey},function(image){
							location.reload();
						});
						}
						newimage();
						}
						});
			}
		  }
		  newimage();
		  });	  
		  })
		}
		  })
		  })
});
$(document).on("click",".nextimage",function() {
	var page2 = $(this).parent().parent().parent().parent().parent().attr("id");
	var pagenumber2 = page2.split("page");
	pagenumber2 = parseInt(pagenumber2[1]);
	$.mobile.changePage( "#page"+(pagenumber2+1),{ transition: "flip"});
	});
$(document).on("click",".previmage",function() {
	var page2 = $(this).parent().parent().parent().parent().parent().attr("id");
	var pagenumber2 = page2.split("page");
	pagenumber2 = parseInt(pagenumber2[1]);
	$.mobile.changePage( "#page"+(pagenumber2-1),{ transition: "flip"});
	});
$(document).on("click",".shutdownok",function() {
	$.mobile.showPageLoadingMsg();
	var id = $(this).attr("id");
	id = id.split("shutdownbutton");
	id=id[1];
	var filterport = $("#filterport"+id).val();
	$.ajax({
		type:"GET",
		url:"../login/shutdown.php",
		data:"port="+filterport,
		success:function(){
		$(".shutdowndialog").dialog().dialog("close");
		$.mobile.hidePageLoadingMsg();	
		}
		});
	});
$(document).on("click",".restartok",function() {
	$.mobile.showPageLoadingMsg();
	var id = $(this).attr("id");
	id = id.split("restartbutton");
	id=id[1];
	var filterport = $("#filterport"+id).val();
	$.ajax({
		type:"GET",
		url:"../login/reboot.php",
		data:"port="+filterport,
		success:function(){
		$(".restartdialog").dialog().dialog("close");
		$.mobile.hidePageLoadingMsg();	
		}
		});
	});
$(document).on("click",".closedialogwindow",function() {
	$('div[data-role="dialog"]').dialog().dialog("close");
	});
$(document).on("click",".addwsr",function(){
	var id = $(this).attr("id");
	id = id.split("addwsr");
	id=id[1];
	var url = $("#url"+id).val();
	var baslangic = $("#baslangic"+id).val();
	var bitis = $("#bitis"+id).val();
	var gunler = $("#days"+id).val();
	var port = $("#filterport"+id).val();
	if(url.length<1){
		$("<div class='ui-loader ui-overlay-shadow ui-body-e ui-corner-all'><h5 style='text-align:center;'>Lütfen adresi giriniz.</h5></div>").css({ "width":"100%","display": "block", "left":"0", "opacity": 0.96, "top": $(window).scrollTop() + 100 })
  .appendTo( $.mobile.pageContainer )
  .delay( 1500 )
  .fadeOut( 400, function(){
    $(this).remove();
  });
		}else
	if(baslangic.length<1){
		$("<div class='ui-loader ui-overlay-shadow ui-body-e ui-corner-all'><h5 style='text-align:center;'>Lütfen başlangıç saatini giriniz.</h5></div>").css({ "width":"100%","display": "block", "left":"0", "opacity": 0.96, "top": $(window).scrollTop() + 100 })
  .appendTo( $.mobile.pageContainer )
  .delay( 1500 )
  .fadeOut( 400, function(){
    $(this).remove();
  });
		}else
	if(bitis.length<1){
		$("<div class='ui-loader ui-overlay-shadow ui-body-e ui-corner-all'><h5 style='text-align:center;'>Lütfen bitiş saatini giriniz.</h5></div>").css({ "width":"100%","display": "block", "left":"0", "opacity": 0.96, "top": $(window).scrollTop() + 100 })
  .appendTo( $.mobile.pageContainer )
  .delay( 1500 )
  .fadeOut( 400, function(){
    $(this).remove();
  });
		}else
	if(gunler==null){
		$("<div class='ui-loader ui-overlay-shadow ui-body-e ui-corner-all'><h5 style='text-align:center;'>Lütfen günleri seçiniz.</h5></div>").css({ "width":"100%","display": "block", "left":"0", "opacity": 0.96, "top": $(window).scrollTop() + 100 })
  .appendTo( $.mobile.pageContainer )
  .delay( 1500 )
  .fadeOut( 400, function(){
    $(this).remove();
  });
		}
	else{
	$.mobile.showPageLoadingMsg();
	$.ajax({
		type:"GET",
		url:"../login/blockurl.php",
		data:"port="+port+"&urladres="+url+"&url_limit_start="+baslangic+"&url_limit_end="+bitis+"&url_limit_weekday="+gunler,
		success:function(){
			$(".websiterestrictions").dialog().dialog("close");
			$.mobile.hidePageLoadingMsg();
			}
		})
	}
	})
$(document).on("click",".additr",function(){
	var id = $(this).attr("id");
	id = id.split("additr");
	id=id[1];
	var desc = $("#itdesc"+id).val();
	var baslangic = $("#itbaslangic"+id).val();
	var bitis = $("#itbitis"+id).val();
	var gunler = $("#itdays"+id).val();
	var port = $("#filterport"+id).val();
	if(desc.length<1){
		$("<div class='ui-loader ui-overlay-shadow ui-body-e ui-corner-all'><h5 style='text-align:center;'>Lütfen kural adını giriniz.</h5></div>").css({ "width":"100%","display": "block", "left":"0", "opacity": 0.96, "top": $(window).scrollTop() + 100 })
  .appendTo( $.mobile.pageContainer )
  .delay( 1500 )
  .fadeOut( 400, function(){
    $(this).remove();
  });
		}else
	if(baslangic.length<1){
		$("<div class='ui-loader ui-overlay-shadow ui-body-e ui-corner-all'><h5 style='text-align:center;'>Lütfen başlangıç saatini giriniz.</h5></div>").css({ "width":"100%","display": "block", "left":"0", "opacity": 0.96, "top": $(window).scrollTop() + 100 })
  .appendTo( $.mobile.pageContainer )
  .delay( 1500 )
  .fadeOut( 400, function(){
    $(this).remove();
  });
		}else
	if(bitis.length<1){
		$("<div class='ui-loader ui-overlay-shadow ui-body-e ui-corner-all'><h5 style='text-align:center;'>Lütfen bitiş saatini giriniz.</h5></div>").css({ "width":"100%","display": "block", "left":"0", "opacity": 0.96, "top": $(window).scrollTop() + 100 })
  .appendTo( $.mobile.pageContainer )
  .delay( 1500 )
  .fadeOut( 400, function(){
    $(this).remove();
  });
		}else
	if(gunler==null){
		$("<div class='ui-loader ui-overlay-shadow ui-body-e ui-corner-all'><h5 style='text-align:center;'>Lütfen günleri seçiniz.</h5></div>").css({ "width":"100%","display": "block", "left":"0", "opacity": 0.96, "top": $(window).scrollTop() + 100 })
  .appendTo( $.mobile.pageContainer )
  .delay( 1500 )
  .fadeOut( 400, function(){
    $(this).remove();
  });
		}
	else{
	$.mobile.showPageLoadingMsg();
	$.ajax({
		type:"GET",
		url:"../login/blockinternettime.php",
		data:"port="+port+"&desc="+desc+"&url_limit_start="+baslangic+"&url_limit_end="+bitis+"&url_limit_weekday="+gunler,
		success:function(){
			$(".internettimerestrictions").dialog().dialog("close");
			$.mobile.hidePageLoadingMsg();
			}
		})
	}
	})
$(document).on("click",".addpctr",function(){
	var id = $(this).attr("id");
	id = id.split("addpctr");
	id=id[1];
	var desc = $("#pctdesc"+id).val();
	var baslangic = $("#pctbaslangic"+id).val();
	var bitis = $("#pctbitis"+id).val();
	var gunler = $("#pctdays"+id).val();
	var port = $("#filterport"+id).val();
	if(desc.length<1){
		$("<div class='ui-loader ui-overlay-shadow ui-body-e ui-corner-all'><h5 style='text-align:center;'>Lütfen kural adını giriniz.</h5></div>").css({ "width":"100%","display": "block", "left":"0", "opacity": 0.96, "top": $(window).scrollTop() + 100 })
  .appendTo( $.mobile.pageContainer )
  .delay( 1500 )
  .fadeOut( 400, function(){
    $(this).remove();
  });
		}else
	if(baslangic.length<1){
		$("<div class='ui-loader ui-overlay-shadow ui-body-e ui-corner-all'><h5 style='text-align:center;'>Lütfen başlangıç saatini giriniz.</h5></div>").css({ "width":"100%","display": "block", "left":"0", "opacity": 0.96, "top": $(window).scrollTop() + 100 })
  .appendTo( $.mobile.pageContainer )
  .delay( 1500 )
  .fadeOut( 400, function(){
    $(this).remove();
  });
		}else
	if(bitis.length<1){
		$("<div class='ui-loader ui-overlay-shadow ui-body-e ui-corner-all'><h5 style='text-align:center;'>Lütfen bitiş saatini giriniz.</h5></div>").css({ "width":"100%","display": "block", "left":"0", "opacity": 0.96, "top": $(window).scrollTop() + 100 })
  .appendTo( $.mobile.pageContainer )
  .delay( 1500 )
  .fadeOut( 400, function(){
    $(this).remove();
  });
		}else
	if(gunler==null){
		$("<div class='ui-loader ui-overlay-shadow ui-body-e ui-corner-all'><h5 style='text-align:center;'>Lütfen günleri seçiniz.</h5></div>").css({ "width":"100%","display": "block", "left":"0", "opacity": 0.96, "top": $(window).scrollTop() + 100 })
  .appendTo( $.mobile.pageContainer )
  .delay( 1500 )
  .fadeOut( 400, function(){
    $(this).remove();
  });
		}
	else{
	$.mobile.showPageLoadingMsg();
	$.ajax({
		type:"GET",
		url:"../login/blockpctime.php",
		data:"port="+port+"&desc="+desc+"&url_limit_start="+baslangic+"&url_limit_end="+bitis+"&url_limit_weekday="+gunler,
		success:function(){
			$(".pctimerestrictions").dialog().dialog("close");
			$.mobile.hidePageLoadingMsg();
			}
		})
	}
	})
$(document).on("change",".winrest",function(){
		$.mobile.showPageLoadingMsg();
		var checked = $(this).attr("checked");
		var rulename = $(this).parent().find(".winrest").val();
		var id = $(this).parent().parent().parent().parent().parent().parent().parent().attr("id");
		id = id.split("windowsrestrictions");
		id = id[1];
		var filterport = $("#filterport"+id).val();
		if(checked!="checked"){
		$.ajax({
			type:"GET",
			url:"../login/applywinrule.php",
			data:"port="+filterport+"&rule="+rulename,
			success:function(){
				ajaxcall(filterport,id);
				$.mobile.hidePageLoadingMsg();
				}
			})
		}else{
		$.ajax({
			type:"GET",
			url:"../login/cancelwinrule.php",
			data:"port="+filterport+"&rule="+rulename,
			success:function(){
				ajaxcall(filterport,id);
				$.mobile.hidePageLoadingMsg();
				}
			})	
			}
		});
$(document).on("click",".windows",function(){ 
var id = $(this).attr("href");
id= id.split("#windowsrestrictions");
id=id[1];
var port = $("#filterport"+id).val();
ajaxcall(port,id);
});
$(document).on("click",".seedrives",function(){ 
var id = $(this).attr("href");
id= id.split("#drives");
id=id[1];
var port = $("#filterport"+id).val();
$.ajax({
	type:"GET",
	url:"drives.php",
	data:"port="+port,
	success:function(a){
		$(".driverlist").find("select").html(a);
		//$(".driverlist select").trigger("create");
		}
	})
});
$(document).on("click",".resetportbutton",function() {
	$.mobile.showPageLoadingMsg();
	var id = $(this).attr("id");
	id = id.split("resetportbutton");
	id = id[1];
	var keydisk = $("#keydisk"+id).val();
	$.get("../login/resetctrlport.php",{key:keydisk},function(resp){
	$.mobile.hidePageLoadingMsg();
	$(".resetports").dialog().dialog("close");
	});
	$.get("../login/resetport.php",{key:keydisk},function(resp){
	$.mobile.hidePageLoadingMsg();
	$(".resetports").dialog().dialog("close");
	});
});
$(document).on("change",".driversonpc",function() {
	var val = $(this).val();
	var id = $(this).parent().parent().parent().parent().parent().parent().attr("id");
	id = id.split("drives");
	id = id[1];
	var port = $("#filterport"+id).val();
	$.ajax({
		type:"GET",
		url:"subdir.php",
		data:"port="+port+"&maindir="+val,
		success:function(b){
			$(".subdirsonpc").html(b);
			}
		});
	});
$(document).on("change",".subdirsonpc",function(){
	$(".searchdiv").show();
	});
$(document).on("click",".searchfile",function(){
	$.mobile.showPageLoadingMsg();
	var id = $(this).parent().parent().parent().parent().attr("id");
	id = id.split("drives");
	id = id[1];
	var port = $("#filterport"+id).val();
	var suffix = $("#searchinput"+id).val();
	var path = $("#subdirsonpc"+id).val();
	$.ajax({
		type:"GET",
		url:"search.php",
		data:"port="+port+"&path="+path+"&suffix="+suffix,
		success:function(x){
			$.mobile.hidePageLoadingMsg();
			$("#response"+id).find(".responsecontent").html(x);
			$.mobile.changePage( "#response"+id, { role: "dialog" } );
			}
		})
	});
$(document).on("click",".blockapplication",function(){
	var id = $(this).attr("id");
	id = id.split("button");
	id = id[1];
	var filename = $(this).parent().parent().find("#filename"+id).text();
	var filenameexe = $(this).parent().parent().find("#filenameexe"+id).text();
	$("#filenameshow"+id).val(filename);
	$("#filenameshowexe"+id).val(filenameexe);
	//alert(filename);
	$.mobile.changePage( "#apprestrictions"+id, { role: "dialog" } );
	});
$(document).on("click",".addappr",function(){
	$.mobile.showPageLoadingMsg();
	var id = $(this).attr("id");
	id = id.split("addappr");
	id = id[1];
	var filenamesend = $("#filenameshowexe"+id).val();
	var filenamedesc = $("#filenameshow"+id).val();
	var appbaslangic = $("#apprbaslangic"+id).val();
	var appbitis = $("#apprbitis"+id).val();
	var appgunler = $("#apprdays"+id).val();
	var port = $("#filterport"+id).val();
	$.ajax({
		type:"GET",
		url:"../login/blockapplication.php",
		data:"port="+port+"&proc_limit="+filenamesend+"&proc_limit_file_desc="+filenamedesc+"&proc_limit_start="+appbaslangic+"&proc_limit_end="+appbitis+"&proc_limit_weekday="+appgunler,
		success:function(){
			$.mobile.hidePageLoadingMsg();
			$("<div class='ui-loader ui-overlay-shadow ui-body-e ui-corner-all'><h5 style='text-align:center;'>Kural başarıyla eklendi.</h5></div>").css({ "width":"100%","display": "block", "left":"0", "opacity": 0.96, "top": $(window).scrollTop() + 100 })
  .appendTo( $.mobile.pageContainer )
  .delay( 1500 )
  .fadeOut( 400, function(){
    $(this).remove();
			});
		}
		})
	})
$(document).on("click",".seewsr",function(){
	var id = $(this).attr("href");
	id = id.split("#websiterestrictionslist");
	id = id[1];
	var filterport = $("#filterport"+id).val();
	$.ajax({
		type:"GET",
		url:"getwsr.php",
		data:"port="+filterport,
		success:function(a){
			$("#websiterestrictionslist"+id).find(".websiterestrictionslistcontent").html(a);
			$(".websiterestrictionslistcontent").find("table").trigger("create");
			}
		})
	})
$(document).on("click",".removewsrbutton",function(){
	$.mobile.showPageLoadingMsg();
	var id = $(this).attr("id");
	var filterportid = $(this).parent().parent().parent().parent().parent().parent().parent().attr("id");
	id = id.split("removewsrbutton");
	id = id[1];
	filterportid = filterportid.split("websiterestrictionslist");
	filterportid = filterportid[1];
	var urlid = $(this).parent().parent().find("td:eq(0)").text();
	var filterport = $("#filterport"+filterportid).val();
	$.ajax({
		type:"GET",
		url:"../login/allowurl.php",
		data:"port="+filterport+"&siteid="+urlid,
		success:function(){
			$.mobile.hidePageLoadingMsg();
			$("#wsrtr"+id).fadeOut();
			}
		})
	});
	$(document).on("click",".seeitr",function(){
	var id = $(this).attr("href");
	id = id.split("#internettimerestrictionslist");
	id = id[1];
	var filterport = $("#filterport"+id).val();
	$.ajax({
		type:"GET",
		url:"getitr.php",
		data:"port="+filterport,
		success:function(a){
			$("#internettimerestrictionslist"+id).find(".internettimerestrictionslistcontent").html(a);
			$(".internettimerestrictionslistcontent").find("table").trigger("create");
			}
		})
	});
	$(document).on("click",".removeitrbutton",function(){
	$.mobile.showPageLoadingMsg();
	var id = $(this).attr("id");
	var filterportid = $(this).parent().parent().parent().parent().parent().parent().parent().attr("id");
	id = id.split("removeitrbutton");
	id = id[1];
	filterportid = filterportid.split("internettimerestrictionslist");
	filterportid = filterportid[1];
	var urlid = $(this).parent().parent().find("td:eq(1)").text();
	var filterport = $("#filterport"+filterportid).val();
	$.ajax({
		type:"GET",
		url:"../login/allowinternettime.php",
		data:"port="+filterport+"&desc="+urlid,
		success:function(){
			$.mobile.hidePageLoadingMsg();
			$("#itrtr"+id).fadeOut();
			}
		})
	});
	$(document).on("click",".seepctr",function(){
	var id = $(this).attr("href");
	id = id.split("#pctimerestrictionslist");
	id = id[1];
	var filterport = $("#filterport"+id).val();
	$.ajax({
		type:"GET",
		url:"getpctr.php",
		data:"port="+filterport,
		success:function(a){
			$("#pctimerestrictionslist"+id).find(".pctimerestrictionslistcontent").html(a);
			$(".pctimerestrictionslistcontent").find("table").trigger("create");
			}
		})
	});
	$(document).on("click",".removepctrbutton",function(){
	$.mobile.showPageLoadingMsg();
	var id = $(this).attr("id");
	var filterportid = $(this).parent().parent().parent().parent().parent().parent().parent().attr("id");
	id = id.split("removepctrbutton");
	id = id[1];
	filterportid = filterportid.split("pctimerestrictionslist");
	filterportid = filterportid[1];
	var urlid = $(this).parent().parent().find("td:eq(1)").text();
	var filterport = $("#filterport"+filterportid).val();
	$.ajax({
		type:"GET",
		url:"../login/allowpctime.php",
		data:"port="+filterport+"&desc="+urlid,
		success:function(){
			$.mobile.hidePageLoadingMsg();
			$("#pctrtr"+id).fadeOut();
			}
		})
	});
</script>
</head>

<body>
<p class="active_clients" style="display:none;"></p>
<?php for($i=0;$i<$clientCount;$i++){ ?>
<div data-role="page" class="screens" id="page<?php echo $i+1; ?>">
<input type="hidden" id="keydisk<?php echo ($i+1); ?>" class="keydisk"  />
<input type="hidden" id="port<?php echo ($i+1); ?>" class="port" />
<input type="hidden" id="filterport<?php echo ($i+1); ?>" class="filterport" />
	<div class="header" data-theme="b" data-role="header">
    <div class="ui-btn-left" data-role="controlgroup" data-type="horizontal">
        <a href="#panel-01" data-role="button" data-iconpos="notext" data-inline="true" data-icon="gear"></a>
        <a href="#panel-02" data-role="button" data-iconpos="notext" data-inline="true" data-icon="bars"></a>
    </div>
        <h1 class="alias" id="alias<?php echo ($i+1); ?>"><?php echo $i+1; ?>. Görüntü</h1>
        <div class="ui-btn-right" data-role="controlgroup" data-type="horizontal">
        <?php 
		if($i>0){
		?>
        <a href="#" class="previmage" data-icon="arrow-l" data-theme="d" data-role="button" data-iconpos="notext"></a>
        <?php 
		}
		?>
        <?php 
		if(($i+1)!=$clientCount){
		?>
        <a href="#" class="nextimage" data-icon="arrow-r" data-theme="d" data-iconpos="notext" data-role="button"></a>
        <?php 
		}
		?>
        </div>
    </div>
   <div class="panel left" data-role="panel" data-position="left" data-display="push" data-theme="a" id="panel-01">
        <ul>
            <li><a href="#websiterestrictionslist<?php echo ($i+1); ?>" data-role="button" data-mini="true" data-icon="delete" data-theme="b" data-corners="false" class="seewsr">Web Site Kısıtlamaları</a></li>
            <li><a href="#drives<?php echo ($i+1); ?>" data-role="button" data-mini="true" data-icon="delete" data-theme="b" data-corners="false" class="seedrives">Uygulama Kısıtlamaları</a></li>
            <li><a href="#internettimerestrictionslist<?php echo ($i+1); ?>" data-role="button" data-mini="true" data-icon="delete" data-theme="b" data-corners="false" class="seeitr">İnternet Süre Kısıtlamaları</a></li>
            <li><a href="#pctimerestrictionslist<?php echo ($i+1); ?>" data-role="button" data-mini="true" data-icon="delete" data-theme="b" data-corners="false" class="seepctr">Bilgisayar Süre Kısıtlamaları</a></li>
            <li><a href="#windowsrestrictions<?php echo ($i+1); ?>" data-role="button" data-mini="true" data-icon="delete" data-theme="b" data-corners="false" class="windows">Windows Kısıtlamaları</a></li>
        </ul>
    </div>
    <div class="panel left" data-role="panel" data-position="left" data-display="push" data-theme="a" id="panel-02">
        <ul>
            <li><a href="#shutdown<?php echo ($i+1); ?>" class="shutdown" data-role="button" data-mini="true" data-icon="delete" data-theme="b" data-corners="false">Bilgisayarı Kapat</a></li>
            <li><a href="#restart<?php echo ($i+1); ?>"  class="restart" data-role="button" data-mini="true" data-icon="delete" data-theme="b" data-corners="false">Bilgisayarı Yeniden Başlat</a></li>
            <li><a href="#resetports<?php echo ($i+1); ?>" class="resetport" data-role="button" data-mini="true" data-icon="delete" data-theme="b" data-corners="false">Bağlantıyı Yenile</a></li>
            <li><a href="cikis.php" data-role="button" data-mini="true" data-ajax="false" data-icon="delete" data-theme="e" data-corners="false">Çıkış Yap</a></li>
        </ul>
    </div>
    <div data-role="content">
            <div class="screen" id="screen<?php echo ($i+1); ?>">
            <div class="message">Şu anda bağlantı kurulamıyor...</div>
            </div>
    </div>
    </div>
    
    <div data-role="dialog" class="websiterestrictionslist" id="websiterestrictionslist<?php echo ($i+1); ?>" data-close-btn="none">
	<div data-role="header">
		<h1>Web Site Kısıtlama Listesi</h1>
	</div><!-- /header -->
	<div data-role="content" class="websiterestrictionslistcontent">	
				
	</div><!-- /content -->
	<div data-role="footer">
		<p>
        <a href="#websiterestrictions<?php echo ($i+1); ?>" class="addwsrbtn" id="websiterestrictions<?php echo ($i+1); ?>" data-role="button" data-mini="true" data-inline="true" data-icon="check" data-theme="b">Yeni Site Ekle</a>
        <a href="#" class="closedialogwindow" data-role="button" data-mini="true" data-inline="true">Vazgeç</a>
        </p>
	</div><!-- /footer -->
	</div><!-- /page -->
    
    <div data-role="dialog" class="internettimerestrictionslist" id="internettimerestrictionslist<?php echo ($i+1); ?>" data-close-btn="none">
	<div data-role="header">
		<h1>İnternet Süre Kısıtlamaları</h1>
	</div><!-- /header -->
	<div data-role="content" class="internettimerestrictionslistcontent">	
				
	</div><!-- /content -->
	<div data-role="footer">
		<p>
        <a href="#internettimerestrictions<?php echo ($i+1); ?>" class="additrbtn" id="internettimerestrictions<?php echo ($i+1); ?>" data-role="button" data-mini="true" data-inline="true" data-icon="check" data-theme="b">Yeni Kural Ekle</a>
        <a href="#" class="closedialogwindow" data-role="button" data-mini="true" data-inline="true">Vazgeç</a>
        </p>
	</div><!-- /footer -->
	</div><!-- /page -->
    
    <div data-role="dialog" class="pctimerestrictionslist" id="pctimerestrictionslist<?php echo ($i+1); ?>" data-close-btn="none">
	<div data-role="header">
		<h1>Bilgisayar Süre Kısıtlamaları</h1>
	</div><!-- /header -->
	<div data-role="content" class="pctimerestrictionslistcontent">	
				
	</div><!-- /content -->
	<div data-role="footer">
		<p>
        <a href="#pctimerestrictions<?php echo ($i+1); ?>" class="addpctrbtn" id="pctimerestrictions<?php echo ($i+1); ?>" data-role="button" data-mini="true" data-inline="true" data-icon="check" data-theme="b">Yeni Kural Ekle</a>
        <a href="#" class="closedialogwindow" data-role="button" data-mini="true" data-inline="true">Vazgeç</a>
        </p>
	</div><!-- /footer -->
	</div><!-- /page -->
    
    <div data-role="dialog" class="shutdowndialog" id="shutdown<?php echo ($i+1); ?>" data-close-btn="none">
	<div data-role="header">
		<h1>Bilgisayarı Kapat</h1>
	</div><!-- /header -->
	<div data-role="content">	
		<p><span id="shutdownalias<?php echo ($i+1); ?>"></span> adlı bilgisayarı kapatmak istediğinizden emin misiniz?</p>		
	</div><!-- /content -->
	<div data-role="footer">
		<p>
        <a href="#" class="shutdownok" data-role="button" id="shutdownbutton<?php echo ($i+1); ?>" data-mini="true" data-inline="true" data-icon="check" data-theme="b">Evet</a>
        <a href="#" class="closedialogwindow" data-role="button" data-mini="true" data-inline="true">Hayır</a>
        </p>
	</div><!-- /footer -->
	</div><!-- /page -->
    
    <div data-role="dialog" class="restartdialog" id="restart<?php echo ($i+1); ?>" data-close-btn="none">
	<div data-role="header">
		<h1>Bilgisayarı Yeniden Başlat</h1>
	</div><!-- /header -->
	<div data-role="content">	
		<p><span id="restartalias<?php echo ($i+1); ?>"></span> adlı bilgisayarı yeniden başlatmak istediğinizden emin misiniz?</p>		
	</div><!-- /content -->
	<div data-role="footer">
		<p>
        <a href="#" class="restartok" id="restartbutton<?php echo ($i+1); ?>" data-role="button" data-mini="true" data-inline="true" data-icon="check" data-theme="b">Evet</a>
        <a href="#" class="closedialogwindow" data-role="button" data-mini="true" data-inline="true">Hayır</a>
        </p>
	</div><!-- /footer -->
	</div><!-- /page -->
    
    <div data-role="dialog" class="resetports" id="resetports<?php echo ($i+1); ?>" data-close-btn="none">
	<div data-role="header">
		<h1>Bağlantıyı Yenile</h1>
	</div><!-- /header -->
	<div data-role="content">	
		<p><span id="resetportalias<?php echo ($i+1); ?>"></span> adlı bilgisayarın bağlantısını yenilemek istediğinizden emin misiniz?</p>		
	</div><!-- /content -->
	<div data-role="footer">
		<p>
        <a href="#" class="resetportbutton" id="resetportbutton<?php echo ($i+1); ?>" data-role="button" data-mini="true" data-inline="true" data-icon="check" data-theme="b">Evet</a>
        <a href="#" class="closedialogwindow" data-role="button" data-mini="true" data-inline="true">Hayır</a>
        </p>
	</div><!-- /footer -->
	</div><!-- /page -->
    
    <div data-role="dialog" class="websiterestrictions" id="websiterestrictions<?php echo ($i+1); ?>" data-close-btn="none">
	<div data-role="header">
		<h1>Web Site Kısıtlamaları</h1>
	</div><!-- /header -->
	<div data-role="content">	
		<p>
        <form>
        	<label for="time-1">Adres:</label>
            <input type="text" name="url" id="url<?php echo ($i+1); ?>">
            <label for="time-1">Başlangıç Saati</label>
            <input type="time" data-clear-btn="false" name="time-1" id="baslangic<?php echo ($i+1); ?>" value="">
            <label for="time-2">Bitiş Saati</label>
            <input type="time" data-clear-btn="false" name="time-2" id="bitis<?php echo ($i+1); ?>" value="">
            <label for="select-native-1">Gün Seçin:</label>
            <select name="select-native-1" id="days<?php echo ($i+1); ?>" data-native-menu="false" data-mini="true" multiple="multiple" size="7">
                <option value="1">Pazartesi</option>
                <option value="2">Salı</option>
                <option value="3">Çarşamba</option>
                <option value="4">Perşembe</option>
                <option value="5">Cuma</option>
                <option value="6">Cumartesi</option>
                <option value="0">Pazar</option>
            </select>
        </form>
        </p>		
	</div><!-- /content -->
	<div data-role="footer">
		<p>
        <a href="#" class="addwsr" id="addwsr<?php echo ($i+1); ?>" data-role="button" data-mini="true" data-inline="true" data-icon="check" data-theme="b">Siteyi Ekle</a>
        <a href="#" class="closedialogwindow" data-role="button" data-mini="true" data-inline="true">Vazgeç</a>
        </p>
	</div><!-- /footer -->
	</div><!-- /page -->
    
    <div data-role="dialog" class="internettimerestrictions" id="internettimerestrictions<?php echo ($i+1); ?>" data-close-btn="none">
	<div data-role="header">
		<h1>İnternet Süre Kısıtlamaları</h1>
	</div><!-- /header -->
	<div data-role="content">	
		<p>
        <form>
        	<label for="time-1">Kural Adı:</label>
            <input type="text" name="url" id="itdesc<?php echo ($i+1); ?>">
            <label for="time-1">Başlangıç Saati</label>
            <input type="time" data-clear-btn="false" name="time-1" id="itbaslangic<?php echo ($i+1); ?>" value="">
            <label for="time-2">Bitiş Saati</label>
            <input type="time" data-clear-btn="false" name="time-2" id="itbitis<?php echo ($i+1); ?>" value="">
            <label for="select-native-1">Gün Seçin:</label>
            <select name="select-native-1" id="itdays<?php echo ($i+1); ?>" data-native-menu="false" data-mini="true" multiple="multiple" size="7">
                <option value="1">Pazartesi</option>
                <option value="2">Salı</option>
                <option value="3">Çarşamba</option>
                <option value="4">Perşembe</option>
                <option value="5">Cuma</option>
                <option value="6">Cumartesi</option>
                <option value="0">Pazar</option>
            </select>
        </form>
        </p>		
	</div><!-- /content -->
	<div data-role="footer">
		<p>
        <a href="#" class="additr" id="additr<?php echo ($i+1); ?>" data-role="button" data-mini="true" data-inline="true" data-icon="check" data-theme="b">Kuralı Ekle</a>
        <a href="#" class="closedialogwindow" data-role="button" data-mini="true" data-inline="true">Vazgeç</a>
        </p>
	</div><!-- /footer -->
	</div><!-- /page -->
    
    <div data-role="dialog" class="pctimerestrictions" id="pctimerestrictions<?php echo ($i+1); ?>" data-close-btn="none">
	<div data-role="header">
		<h1>Bilgisayar Süre Kısıtlamaları</h1>
	</div><!-- /header -->
	<div data-role="content">	
		<p>
        <form>
        	<label for="time-1">Kural Adı:</label>
            <input type="text" name="url" id="pctdesc<?php echo ($i+1); ?>">
            <label for="time-1">Başlangıç Saati</label>
            <input type="time" data-clear-btn="false" name="time-1" id="pctbaslangic<?php echo ($i+1); ?>" value="">
            <label for="time-2">Bitiş Saati</label>
            <input type="time" data-clear-btn="false" name="time-2" id="pctbitis<?php echo ($i+1); ?>" value="">
            <label for="select-native-1">Gün Seçin:</label>
            <select name="select-native-1" id="pctdays<?php echo ($i+1); ?>" data-native-menu="false" data-mini="true" multiple="multiple" size="7">
                <option value="1">Pazartesi</option>
                <option value="2">Salı</option>
                <option value="3">Çarşamba</option>
                <option value="4">Perşembe</option>
                <option value="5">Cuma</option>
                <option value="6">Cumartesi</option>
                <option value="0">Pazar</option>
            </select>
        </form>
        </p>		
	</div><!-- /content -->
	<div data-role="footer">
		<p>
        <a href="#" class="addpctr" id="addpctr<?php echo ($i+1); ?>" data-role="button" data-mini="true" data-inline="true" data-icon="check" data-theme="b">Kuralı Ekle</a>
        <a href="#" class="closedialogwindow" data-role="button" data-mini="true" data-inline="true">Vazgeç</a>
        </p>
	</div><!-- /footer -->
	</div><!-- /page -->
    
    <div data-role="dialog" class="windowsrestrictions" id="windowsrestrictions<?php echo ($i+1); ?>" data-close-btn="none">
	<div data-role="header">
		<h1>Windows Kısıtlamaları</h1>
	</div><!-- /header -->
	<div class="windowscontent" data-role="content">	
		<p>
        
        </p>		
	</div><!-- /content -->
	<div data-role="footer">
		<p>
        <a href="#" class="closedialogwindow" data-role="button" data-mini="true" data-inline="true">Vazgeç</a>
        </p>
	</div><!-- /footer -->
	</div><!-- /page -->
    
    <div data-role="dialog" class="drives" id="drives<?php echo ($i+1); ?>" data-close-btn="none">
	<div data-role="header">
		<h1>Sürücüler</h1>
	</div><!-- /header -->
	<div class="driverlist" data-role="content">	
		<div data-role="fieldcontain">
        <label for="textinput-fc">Sürücüyü Seçiniz:</label>
        <select name="driversonpc" class="driversonpc">
                
        </select>
        </div>
        <div data-role="fieldcontain">
        <label for="textinput-fc">Alt Klasör Seçiniz:</label>
        <select name="subdirsonpc" class="subdirsonpc" id="subdirsonpc<?php echo ($i+1); ?>">
                
        </select>
        </div>
        <div data-role="fieldcontain" style="display:none" class="searchdiv">
        <label for="searchinput">Dosya Adı:</label>
        <input type="text" id="searchinput<?php echo ($i+1); ?>" class="searchinput" />
        </div>
	</div><!-- /content -->
	<div data-role="footer">
		<p>
        <a href="#" class="searchfile" data-role="button" data-mini="true" data-inline="true" data-icon="check" data-theme="b">Ara</a>
        <a href="#" class="closedialogwindow" data-role="button" data-mini="true" data-inline="true">Vazgeç</a>
        </p>
	</div><!-- /footer -->
	</div><!-- /page -->
    
    <div data-role="dialog" class="response" id="response<?php echo ($i+1); ?>" data-close-btn="none">
	<div data-role="header">
		<h1>Windows Kısıtlamaları</h1>
	</div><!-- /header -->
	<div class="responsecontent" data-role="content">	
		<p>
        
        </p>		
	</div><!-- /content -->
	<div data-role="footer">
		<p>
        <a href="#" class="closedialogwindow" data-role="button" data-mini="true" data-inline="true">Vazgeç</a>
        </p>
	</div><!-- /footer -->
	</div><!-- /page -->
    
    <div data-role="dialog" class="apprestrictions" id="apprestrictions<?php echo ($i+1); ?>" data-close-btn="none">
	<div data-role="header">
		<h1>Uygulama Kısıtlamaları</h1>
	</div><!-- /header -->
	<div data-role="content">	
		<p>
        <form>
        	<input type="hidden" name="url" id="filenameshowexe<?php echo ($i+1); ?>">
        	<label for="time-1">Kural Adı:</label>
            <input type="text" name="url" id="filenameshow<?php echo ($i+1); ?>" disabled="disabled">
            <label for="time-1">Başlangıç Saati</label>
            <input type="time" data-clear-btn="false" name="time-1" id="apprbaslangic<?php echo ($i+1); ?>" value="">
            <label for="time-2">Bitiş Saati</label>
            <input type="time" data-clear-btn="false" name="time-2" id="apprbitis<?php echo ($i+1); ?>" value="">
            <label for="select-native-1">Gün Seçin:</label>
            <select name="select-native-1" id="apprdays<?php echo ($i+1); ?>" data-native-menu="false" data-mini="true" multiple="multiple" size="7">
                <option value="1">Pazartesi</option>
                <option value="2">Salı</option>
                <option value="3">Çarşamba</option>
                <option value="4">Perşembe</option>
                <option value="5">Cuma</option>
                <option value="6">Cumartesi</option>
                <option value="0">Pazar</option>
            </select>
        </form>
        </p>		
	</div><!-- /content -->
	<div data-role="footer">
		<p>
        <a href="#" class="addappr" id="addappr<?php echo ($i+1); ?>" data-role="button" data-mini="true" data-inline="true" data-icon="check" data-theme="b">Kuralı Ekle</a>
        <a href="#" class="closedialogwindow" data-role="button" data-mini="true" data-inline="true">Vazgeç</a>
        </p>
	</div><!-- /footer -->
	</div><!-- /page -->
<?php 
}
?>
<div class="newUserAlert">
	<p><span class="new_user_count"></span> adet yeni kullanıcı sisteme bağlandı.</p>
</div>
</body>
</html>
