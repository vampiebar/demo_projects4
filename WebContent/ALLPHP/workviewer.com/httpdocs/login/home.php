<?php
session_start();
include("config.php");
include("functions.php");
$id=$_SESSION["workviewer"];
if(!$id){
	header("location:index.php");	
}
if(!$_SESSION["logindil"]){
	$_SESSION["logindil"]="tr";
	require("dil/tr.php");
}else{
	require("dil/".$_SESSION["logindil"].".php");
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
	$surum=$rows->install_type;
}
//echo $key;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/userstyle.css" />
<link rel="stylesheet" href="css/animation.css" />
<link rel="stylesheet" href="css/fontello.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/holder.js"></script>
<script type="text/javascript" src="js/highcharts.js"></script>
<script type="text/javascript" src="js/exporting.js"></script>
<script type="text/javascript" src="js/datatable.js"></script>
<script type="text/javascript" src="js/datatablebshome.js"></script>
<script type="text/javascript" src="https://rawgithub.com/scottjehl/Respond/master/dest/respond.src.js"></script>
<script type="application/javascript">
var ajaxTimer;
var ajaxTimer2;
var ajaxTimer3;
var ajaxTimer4;
$(function(){
	var key = $(".licence_key").val();
	var clientCount = <?php echo $clientCount; ?>;
	clientCount = parseInt(clientCount);
	var kalansure = <?php echo $kalansure; ?>;
	var newimage_xhr = [];
	setInterval(function(){
	$.ajax({
            method:'get',
            url:'getclients.php',
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
	setInterval(function(){
	$.ajax({
            method:'get',
            url:'getinactiveclients.php',
			data:"key="+key,
			cache:false,
            success:function(data){
			if(data!=''){
			var data2 = data.split(",");
			var inactive = data2.length;
			inactive = parseInt(inactive);
			for(var i = 0;i<inactive;i++){
			$.get("resetctrlport.php",{key:data2[i]},function(resp){
			console.log("Inactive Filtre Portu Resetlendi");	
			});
			$.get("resetport.php",{key:data2[i]},function(resp){
			console.log("Inactive Görüntü Portu Resetlendi");	
			});	
			}
			}
			}
			});
		},40000);
	$.ajax({
            method:'get',
            url:'getclients.php',
			data:"key="+key,
			cache:false,
            success:function(data){
			if(data!=''){
			var data2 = data.split(",");
			$(".active_clients").text(data2.length);
			for(var i=0;i<data2.length;i++){
			$("#panel"+(i+1)).find(".keydisk").val(data2[i]);
			}
			}else{
				$("#panel"+(i+1)).find(".message").text("<?php echo $dil["screen_error"]; ?>");
				}
			},
			error:function(){
				$('.message').html("<?php echo $dil["screen_error"]; ?>");
				}
          }).done(function(){
		  $(".keydisk").each(function(i,obj){
			  	var diskkey = $(this).val();
				if(diskkey){
				$("#panel"+(i+1)).find(".message").html('<i style="font-size:50px; color:#0477bd; margin-top:30px; display:inline-block" class="icon-spin2 animate-spin"></i> <p style="margin-top:10px;"><?php echo $dil["connection"]; ?></p>');
				$.ajax({
					method:"GET",
			 	  	url: "getfilterport.php",
			   		data: "key="+diskkey,
			   		async: true,
					cache:false,
			   		success: function(port){
				  		$("#filterport"+(i+1)).val(port);
						$.get("getuserinfo.php",{port:port},function(alias){
							if(alias=="-2"){
								var saniye = 60;
										var timer;
										function countdownctrl() {
										saniye--;
										if(saniye == 59) {
										$.get("resetctrlport.php",{key:diskkey},function(resp){	
										});
										}
										if(saniye == 20) {
										$.get("getfilterport.php",{key:diskkey},function(filterport){
												$("#filterport"+(i+1)).val(filterport);	
											});	
										}
										if(saniye >= 1) {
											$("#panel"+(i+1)).find(".alias span").html("İsim alınamadı."+"("+saniye+")");
										}else{
										port = $("#filterport"+(i+1)).val();
										clearInterval(timer);
										$.get("getuserinfo.php",{port:port},function(alias){
											$("#panel"+(i+1)).find(".alias span").html(alias+'<i class="rename icon-edit-alt" id="renameit'+(i+1)+'" data-placement="bottom" data-toggle="tooltip" title="<?php echo $dil["rename"]; ?>"></i>');
							$("#panel"+(i+1)).find(".alias").append('<div class="gizle" id="rename'+(i+1)+'"><div class="input-group"><input type="text" id="renameinput'+(i+1)+'" class="form-control" value="'+alias+'" /><span class="input-group-btn"><button class="btn btn-primary changealias" id="changealias'+(i+1)+'" type="button"><?php echo $dil["change"]; ?></button></span></div></div>');
							$("#panel"+(i+1)).attr("title",alias);
							$("#clientname"+(i+1)).html("<?php echo $dil["pc_name"]; ?> "+alias);
							$(".rename").tooltip();
											});
											}
										}
										timer = setInterval(countdownctrl, 1000);	
							}else{
							$("#panel"+(i+1)).find(".alias span").html(alias+'<i class="rename icon-edit-alt" id="renameit'+(i+1)+'" data-placement="bottom" data-toggle="tooltip" title="<?php echo $dil["rename"]; ?>"></i>');
							$("#panel"+(i+1)).find(".alias").append('<div class="gizle" id="rename'+(i+1)+'"><div class="input-group"><input type="text" id="renameinput'+(i+1)+'" class="form-control" value="'+alias+'" /><span class="input-group-btn"><button class="btn btn-primary changealias" id="changealias'+(i+1)+'" type="button"><?php echo $dil["change"]; ?></button></span></div></div>');
							$("#panel"+(i+1)).attr("title",alias);
							$("#clientname"+(i+1)).html("<?php echo $dil["pc_name"]; ?> "+alias);
							$(".rename").tooltip();
							}
						});
					}
					});	
				 $.ajax({
					method:"GET",
			 	  	url: "getportnumber.php",
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
		  });	  
		  })
		}
		  })
		  })
	$("body").on("click",".message img",function(){
						 	if(kalansure<0){
							 return false;
							 }
							var id = $(this).parent().attr("id");
							var bsport = $("#port"+id).val();
							var filterport = $("#filterport"+id).val();
							var screenport = $("#port"+id).val();
							var keydisk = $("#keydisk"+id).val();
							var alias = $(this).parent().parent().parent().find(".gizle input[type='text']").val();
							if($(".mainwindow").hasClass("closed")){
								$(".mainwindow").addClass("opened").removeClass("closed").find(".panel-body").fadeIn("normal",function(){
								$(".showpanel").hide();
								$(".closepanel").show();
								$(".screens").animate({"max-height":"350px"});
								});
								}
							$(".screens").find(".panel").removeClass("panel-primary activepanel").addClass("panel-info");
							$(this).parent().parent().parent().removeClass("panel-info").addClass("panel-primary activepanel");
							$(".computernamehere").text(alias+" - ");
							if($(".windowtitle").hasClass("runningapplicationsnow"))
							{
									$(".proc_list").html('<i style="font-size:50px; color:#0477bd; margin-top:30px; display:inline-block" class="icon-spin2 animate-spin"></i><p style="margin-top:10px;"><?php echo $dil["pc_performance"]; ?></p>');
									$(".proc_count").html('<i class="icon-spin2 animate-spin"></i>');
									$.ajax({
									method:"GET",
									url: "getperformancelist.php",
									data: "port="+filterport+"&screenport="+screenport,
									async: true,
									cache:false,
									success: function(proclist){
									if(!proclist){
									$(".proc_list").html('<?php echo $dil["list_error"]; ?>');	
									}else{
									if(proclist=="-2"){
									/* Portu Resetle*/
									/*$.get("resetctrlport.php",{key:keydisk},function(image){
										console.log("Port Resetlendi.");	
									});
									*/

									$(".proc_list").html("Port Canlı Değil");
									}else{
									$(".proc_list").html(proclist);
									
									}
									var size = $(".proc_list table tbody tr").size();
									//$(".proc_count").text(size);
									}
									}
									});
									var pc_name = $(this).parent().parent().parent().find(".alias span").eq(0).text();
									$(".runningapplications").text(pc_name+" bilgisayarının ");
							}
							if($(".windowtitle").hasClass("pctimerestrictions"))
							{
							var pc_name = $(this).parent().parent().parent().find(".alias span").eq(0).text();
							bringit("restrictedpctimes","getpctrlist.php",filterport,pc_name,"Bilgisayar Süre");		
							}
							if($(".windowtitle").hasClass("windowsrestrictions"))
							{
							var pc_name = $(this).parent().parent().parent().find(".alias span").eq(0).text();
							bringit("restrictedwindows","getwinrlist.php",filterport,pc_name,"Windows");		
							}
							if($(".windowtitle").hasClass("internettimerestrictions"))
							{
							var pc_name = $(this).parent().parent().parent().find(".alias span").eq(0).text();
							bringit("restrictedtimes","getitrlist.php",filterport,pc_name,"İnternet Süre");		
							}
							if($(".windowtitle").hasClass("websiterestrictions"))
							{
							var pc_name = $(this).parent().parent().parent().find(".alias span").eq(0).text();
							bringit("restrictedwebsites","getwsrlist.php",filterport,pc_name,"Web Sitesi");		
							}
							if($(".windowtitle").hasClass("programusagereport"))
							{
							var pc_name = $(this).parent().parent().parent().find(".alias span").eq(0).text();
							$(".useractivityreports").html('<i style="font-size:50px; color:#0477bd; margin-top:30px; display:inline-block" class="icon-spin2 animate-spin"></i><p style="margin-top:10px;"><?php echo $dil["please_wait"]; ?>..</p>');
							$.ajax({
									method:"GET",
									url: "getprogramusagereport.php",
									data: "screenport="+bsport,
									async: true,
									cache:false,
									success: function(activity){
									$(".useractivityreports").html(activity);
									}
									});
							}
							if($(".windowtitle").hasClass("useractivityreport"))
							{
							var pc_name = $(this).parent().parent().parent().find(".alias span").eq(0).text();
							$(".useractivityreports2").html('<i style="font-size:50px; color:#0477bd; margin-top:30px; display:inline-block" class="icon-spin2 animate-spin"></i><p style="margin-top:10px;"><?php echo $dil["please_wait"]; ?>..</p>');
							$.ajax({
									method:"GET",
									url: "getuseractivityreport.php",
									data: "screenport="+bsport,
									async: true,
									cache:false,
									success: function(activity){
									$(".useractivityreports2").html(activity);
									}
									});
							}
							if($(".windowtitle").hasClass("userstatistics"))
							{
							var pc_name = $(this).parent().parent().parent().find(".alias span").eq(0).text();
							$(".userstatisticshere").html('<i style="font-size:50px; color:#0477bd; margin-top:30px; display:inline-block" class="icon-spin2 animate-spin"></i><p style="margin-top:10px;"><?php echo $dil["please_wait"]; ?>..</p>');
							$.ajax({
									method:"GET",
									url: "getuserstatistics.php",
									data: "screenport="+bsport,
									async: true,
									cache:false,
									success: function(activity){
									$(".userstatisticshere").html(activity);
									}
									});
							}
							if($(".windowtitle").hasClass("datetime")){
								$(".datetimehidden").val(bsport);
								}
							if($(".windowtitle").hasClass("srs")){
								$(".srswindow").html('<i style="font-size:50px; color:#0477bd; margin-top:30px; display:inline-block" class="icon-spin2 animate-spin"></i><p style="margin-top:10px;"><?php echo $dil["please_wait"]; ?></p>');
							$.ajax({
									method:"GET",
									url: "srsprocess.php",
									data: "screenport="+bsport,
									async: true,
									cache:false,
									success: function(srsprocess){
									$(".srswindow").html(srsprocess);
									}
									});
								}
							if($(".windowtitle").hasClass("apprestrictions"))
							{
							var pc_name = $(this).parent().parent().parent().find(".alias span").eq(0).text();
							bringit("restrictedapplications","getarlist.php",filterport,pc_name,"Uygulama");
							$(".pcdrives").html('<i style="font-size:50px; color:#0477bd; margin-top:30px; display:inline-block" class="icon-spin2 animate-spin"></i><p style="margin-top:10px;"><?php echo $dil["driver_list"]; ?></p>');
									$(".pcdrivescount").html('<i class="icon-spin2 animate-spin"></i>');
									$.ajax({
									method:"GET",
									url: "getdrives.php",
									data: "port="+filterport,
									async: true,
									cache:false,
									success: function(drives){
									if(!drives){
									$(".pcdrives").html('<?php echo $dil["list_error"]; ?>');	
									}else{
									if(drives=="-2"){
									/* Portu Resetle*/
									/*$.get("resetctrlport.php",{key:keydisk},function(image){
										console.log("Port Resetlendi.");	
									});
									*/
									$(".pcdrives").html("Port Canlı Değil");
									}else{
									$(".pcdrives").html(drives);
									}
									var drivesize = $(".panel-group").find(".panel-default").size();
									$(".pcdrivescount").html(drivesize-3);
									}
									}
									});	
							}
							});
		  $(".restrictions").click(function(){
			  if($(".mainwindow").hasClass("closed")){
				$(".mainwindow").addClass("opened").removeClass("closed").find(".panel-body").fadeIn("normal",function(){
				$(".showpanel").hide();
				$(".closepanel").show();
				$(".screens").animate({"max-height":"350px"});
				});
				}
			  $(".list-group-item").removeClass("active");
			  $(".list-group-item").find("i").removeClass("icon-ok-circled-1").addClass("icon-block");
			  $(this).addClass("active");
			  $(this).find("i").removeClass("icon-block").addClass("icon-ok-circled-1");
			  var id = $(this).attr("id");
			  $(".loadpages").load(id+".php",function(){
				  $(".screens").find(".activepanel").find(".message").find("img").click();
				  });
			  var text = $(this).text();
			  $(".windowtitle").removeClass().addClass("panel-title windowtitle "+id).html('<span class="computernamehere"></span>'+text+'<span class="label label-success pull-right closepanel">Paneli Gizle</span><span class="label label-success pull-right showpanel">Paneli Göster</span>');
			  });
			  $('#PageRefresh').click(function() {
    	      location.reload();
			});
			var screensize=3;
			$("#taller").click(function(){
				screensize++;
				$(".screen").removeClass().toggleClass("col-sm-12 col-xs-12 col-md-"+(screensize+1)+" screen col-lg-"+screensize);
				if(screensize==12){
					$(this).addClass("disabled").attr("disabled","disabled");
					}
				if(screensize>2){
					$("#smaller").removeClass("disabled").removeAttr("disabled");
					}
				})
			$("#smaller").click(function(){
				screensize--;
				$(".screen").removeClass().toggleClass("col-sm-12 col-xs-12 col-md-"+(screensize+1)+" screen col-lg-"+screensize);
				if(screensize==2){
					$(this).addClass("disabled").attr("disabled","disabled");
					}
				if(screensize<12){
					$("#taller").removeClass("disabled").removeAttr("disabled");
					}
				})
			$(".shutdownyes").click(function(){
				$(this).parent().parent().find(".gizle").show();
				var filterportstring = $(this).attr("id");
				var filterport = filterportstring.split("shutdownyes");
				filterport = filterport[1];
				var filterportown = $("#filterport"+filterport).val();
				$.get("shutdown.php",{port:filterportown},function(resp){
					$('#inform'+filterport).modal('hide');
					$(".gizle").hide();
				});
				});
			$(".rebootyes").click(function(){
				$(this).parent().parent().find(".gizle").show();
				var filterportstring = $(this).attr("id");
				var filterport = filterportstring.split("rebootyes");
				filterport = filterport[1];
				var filterportown = $("#filterport"+filterport).val();
				$.get("reboot.php",{port:filterportown},function(resp){
					$('#informreboot'+filterport).modal('hide');
					$(".gizle").hide();	
				});
				});
				$("body").on("click",".rename",function(){
					var renameid = $(this).attr("id");
					renameid = renameid.split("renameit");
					renameid = renameid[1];
					$(this).parent().hide();
					$("#rename"+renameid).fadeIn();
					});
				$("body").on("click",".changealias",function(){
					$(this).text("Bekleyiniz...").addClass("disabled").attr("disabled","disabled");
					var aliasid = $(this).attr("id");
					aliasid = aliasid.split("changealias");
					aliasid = aliasid[1];
					var alias2 = $("#renameinput"+aliasid).val();
					var filterport2 = $("#filterport"+aliasid).val();
					$.get("changealias.php",{port:filterport2,alias:alias2},function(resp){
					$(this).removeClass("disabled").removeAttr("disabled");
					$("#alias"+aliasid).html('<span>'+alias2+'<i class="rename icon-edit-alt" id="renameit'+aliasid+'" data-placement="bottom" data-toggle="tooltip" title="<?php echo $dil["rename"]; ?>"></i></span>');
					$("#renameinput"+aliasid).hide();	
					$("#rename"+aliasid).hide();
					$("#alias"+aliasid).append('<div class="gizle" id="rename'+aliasid+'"><div class="input-group"><input type="text" id="renameinput'+aliasid+'" class="form-control" value="'+alias2+'" /><span class="input-group-btn"><button class="btn btn-primary changealias" id="changealias'+aliasid+'" type="button"><?php echo $dil["change"]; ?></button></span></div></div>');
					$(".rename").tooltip();
					$("#clientname"+aliasid).html("<?php echo $dil["pc_name"]; ?>"+alias2);
					});
					});
			function bringit(divname,url,port,pc_name,textstatus) { 
			$("."+divname).html('<i style="font-size:50px; color:#0477bd; margin-top:30px; display:inline-block" class="icon-spin2 animate-spin"></i><p style="margin-top:10px;"><?php echo $dil["please_wait"]; ?> '+textstatus+' <?php echo $dil["list_retrieving"]; ?></p>');
									$(".restrictedwebsitescount").html('<i class="icon-spin2 animate-spin"></i>');
									$.ajax({
									method:"GET",
									url: url,
									data: "port="+port,
									async: true,
									cache:false,
									success: function(proclist){
									if(!proclist){
									$("."+divname).html('<?php echo $dil["list_error"]; ?>');	

									}else{
									if(proclist=="-2"){
									/* Portu Resetle*/
									/*$.get("resetctrlport.php",{key:keydisk},function(image){
										console.log("Port Resetlendi.");	
									});
									*/
									$("."+divname).html("Port Canlı Değil");
									}else{
									$("."+divname).html(proclist);
									$(".blockbutton").hover(function(){
										$(this).removeClass("btn-danger").addClass("btn-success").html('<i class="icon-check"></i> İzin Ver');
										},function(){
										$(this).removeClass("btn-success").addClass("btn-danger").html('<i class="icon-block"></i> Yasaklı');	
										})
									$(".allowbutton").hover(function(){
										$(this).removeClass("btn-success").addClass("btn-danger").html('<i class="icon-block"></i> <?php echo $dil["blockit"]; ?>');
										},function(){
										$(this).removeClass("btn-danger").addClass("btn-success").html('<i class="icon-check"></i> <?php echo $dil["allowed"]; ?>');	
										})
									}
									var size = $("."+divname+" table tbody tr").size();
									$("."+divname+"count").text(size);
									}
									}
									});
									$("."+divname+"list").text(pc_name+" <?php echo $dil["named_pc"]; ?> ");
			}
			$("body").on("keyup",".findpc",function(){
				var text = $(this).val().trim();
				$(".screen").show();
				var keywords = text.toLowerCase().split(' ');
				// loop over the keywords and if it's not in a LI, hide it
				for(var i=0; i<keywords.length; i++) {
					$('.screen').each(function (index, element) {
						if ($(element).find(".alias span").text().toLowerCase().indexOf(keywords) != -1) {
							$(element).show();
						} else {
							$(element).hide();
						}
					});
				}
				});
			ajax_timer = setTimeout("noclickinformation()",5000);
				$(window).blur(function(){
					/*$.ajaxQ.abortAll();
					$(".modal").click(function(){
						return false;
						})
					*/
					});
				$(window).focus(function(){
					//location.reload();
					})
				$(".showpassword").click(function(){
					$("#hidepassword").hide();
					$("#showpassword").show();
					});
				$(".hidepassword").click(function(){
					$("#showpassword").hide();
					$("#hidepassword").show();
					});
				$(".updateinformation").click(function(){
					var companytitle = $("#companytitle").val();
					var password = $("#inputPassword").val();
					var city = $("#formcity").val();
					var district = $("#formdistrict").val();
					var address = $("#formaddress").val();
					var homephone = $("#formhomephone").val();
					var mobilephone = $("#formmobilephone").val();
					var clientCount = $("#formclientCount").val();
					if(companytitle.length<1){
						$(".updateinformationerror").find("p").text("<?php echo $dil["pls_fill_firm"]; ?>").parent().show();
						}else
					if(password.length<1){
						$(".updateinformationerror").find("p").text("<?php echo $dil["pls_fill_password"]; ?>").parent().show();
						}else
					if(city.length<1){
						$(".updateinformationerror").find("p").text("<?php echo $dil["pls_fill_country"]; ?>").parent().show();
						}else
					if(district.length<1){
						$(".updateinformationerror").find("p").text("<?php echo $dil["pls_fill_state"]; ?>").parent().show();
						}else
					if(address.length<1){
						$(".updateinformationerror").find("p").text("<?php echo $dil["pls_fill_address"]; ?>").parent().show();
						}else
					if(homephone.length<1){
						$(".updateinformationerror").find("p").text("<?php echo $dil["pls_fill_workphone"]; ?>").parent().show();
						}else
					if(mobilephone.length<1){
						$(".updateinformationerror").find("p").text("<?php echo $dil["pls_fill_mobilephone"]; ?>").parent().show();
						}else
					if(clientCount.length<1){
						$(".updateinformationerror").find("p").text("<?php echo $dil["pls_fill_clientcount"]; ?>").parent().show();
						}else{
						$(".updateinformationerror").fadeOut();
						$(".updateinformationsuccess").fadeOut();
						$(".updateinformationloading").fadeIn();
							$.ajax({
								type:"POST",
								url:"updateinformation.php",
								data:$(".updateinformationform").serialize(),
								success:function(){
									$(".updateinformationerror,.updateinformationloading").fadeOut(null,function(){
										$(".updateinformationsuccess").fadeIn().delay(2000).fadeOut();
										});
									}
								})
							}
					});
		$(document).on("click","#tabbednav li a",function(a){
		a.preventDefault();
		//$(this).tab("show");
		})
		//setTimeout("adaptit()",10000);
		$("body").on("click",".closepanel",function(){
			$(this).parent().parent().parent().addClass("closed").removeClass("opened").find(".panel-body").fadeOut("normal",function(){
				$(".closepanel").hide();
				$(".showpanel").show();
				$(".screens").animate({"max-height":"700px"});
				});
			});
		$("body").on("click",".showpanel",function(){
			$(this).parent().parent().parent().addClass("opened").removeClass("closed").find(".panel-body").fadeIn("normal",function(){
				$(".showpanel").hide();
				$(".closepanel").show();
				$(".screens").animate({"max-height":"350px"});
				});
			});
		$("body").on("click",".fullscreenintable",function(){
		var xhrid = $(this).attr("href");
			xhrid = xhrid.split("#myModal");
			xhrid = xhrid[1];
			$("#playvideo"+xhrid).trigger("click");
		});
		$("body").on("click",".fullscreen",function(){
		var xhrid = $(this).attr("href");
			xhrid = xhrid.split("#myModal");
			xhrid = xhrid[1];
			$("#playvideo"+xhrid).trigger("click");
		});
		$('body').on('hidden.bs.modal',".modalfullscreen", function () {
    		var fullscreenintableid = $(this).attr("id");
			fullscreenintableid = fullscreenintableid.split("myModal");
			fullscreenintableid = fullscreenintableid[1];
			$("#stopvideo"+fullscreenintableid).trigger("click");
		})
})
function noclickinformation(){
	var oldcpustat = 0;
	var oldmemstat = 0;
$(".screen").each(function(k,obj){
	var computername = $(this).attr("title");
	var screenport = $(this).find(".port").val();
	var filterport = $(this).find(".filterport").val();
	if(computername!=undefined){
	var screenid = $(this).find(".port").attr("id");
	screenid = screenid.split("port");
	screenid = screenid[1];	
	$("#noclickinformation").find("tbody").append('<tr id="computer'+screenport+'"><td class="text-center">'+computername+'</td><td class="text-center"><input type="hidden" value="'+filterport+'"></td><td class="text-center"><button data-toggle="modal" href="#myModal'+screenid+'" title="" class="btn btn-primary fullscreenintable" data-original-title="Tam Ekran İzle"><i class="icon-resize-full-3" style="font-size:20px;"></i></button></td><td class="text-center"><input type="hidden" value="'+screenport+'"></td><td class="text-center"><input type="hidden" value="'+filterport+'"></td><td class="text-center"><input type="hidden" value="'+filterport+'"><span class="livememory'+filterport+'"></span><span class="livemem'+filterport+'"></span></td><td class="text-center"><input type="hidden" value="'+filterport+'"></td></tr>');
	}
	})
	$("#noclickinformation tbody tr").each(function(m,obj){
		var screenport2 = $(this).find("td:eq(3)").find('input[type="hidden"]').val();
		var filterport2 = $(this).find("td:eq(4)").find('input[type="hidden"]').val();
		var ajax_request = function(){
		$.ajax({
		type:"GET",
		data:"screenport="+screenport2,
		url:"liveactivescreen.php",
		success:function(response){
			$("#computer"+screenport2).find("td:eq(3)").text(response);
			}
		})
		}
		var ajax_request2 = function(){
		$.ajax({
		type:"GET",
		dataType:"JSON",
		data:"port="+filterport2,
		url:"livecpustats.php",
		success:function(response){
			var oldcpustat2 = response.point;
			oldcpustat = $("#computer"+screenport2).find(".deger"+filterport2).text();
			if(parseFloat(oldcpustat)>parseFloat(oldcpustat2)){
			$("#computer"+screenport2).find("td:eq(4)").html('<span>% </span><span class="deger'+filterport2+'">'+response.point+'</span><i style="font-size:20px; color:#67a54b;" class="icon-down-circle"></i>');	
				}else{
				$("#computer"+screenport2).find("td:eq(4)").html('<span>% </span><span class="deger'+filterport2+'">'+response.point+'</span><i style="font-size:20px; color:#f00;" class="icon-up-circle"></i>');	
					}
			}
		})
		}
		var ajax_request3 = function(){
		var oldmemstat2 = oldmemstat;
		$.ajax({
		type:"GET",
		dataType:"JSON",
		data:"port="+filterport2,
		url:"livememstats.php",
		success:function(response){
			var oldmemstat2 = response.point;
			oldmemstat = $("#computer"+screenport2).find(".memdeger"+filterport2).text();
			if(parseFloat(oldmemstat)>parseFloat(oldmemstat2)){
			$("#computer"+screenport2).find("td:eq(5)").html('<span>% </span><span class="memdeger'+filterport2+'">'+response.point+'</span><i style="font-size:20px; color:#67a54b;" class="icon-down-circle"></i>');	
			$("#computer"+screenport2).find("td:eq(1)").html('<div class="progress"><div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:'+Math.round(oldmemstat2*2)+'%"><i style="font-size:20px; color:#f00" class="icon-thumbs-down-alt"></i><span style="color:#000">% '+Math.round(oldmemstat2*2)+'</span></div></div>');
				}else{
				$("#computer"+screenport2).find("td:eq(5)").html('<span>% </span><span class="memdeger'+filterport2+'">'+response.point+'</span><i style="font-size:20px; color:#f00;" class="icon-up-circle"></i>');
				$("#computer"+screenport2).find("td:eq(1)").html('<div class="progress"><div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:'+Math.round(oldmemstat2*2)+'%"><i style="font-size:20px; color:#000;" class="icon-thumbs-up-alt"></i><span style="color:#000">% '+Math.round(oldmemstat2*2)+'</span></div></div>');	
					}
			
			}
		})
		}
		var ajax_request4 = function(){
		$.ajax({
		type:"GET",
		data:"port="+filterport2,
		url:"uptime.php",
		success:function(response){
			$("#computer"+screenport2).find("td:eq(6)").text(response);
			}
		})
		}
		ajax_request4();
		ajax_request3();
		ajax_request2();
		ajax_request();
		ajaxTimer = setInterval(ajax_request4,30000);
		ajaxTimer2 = setInterval(ajax_request3,5000);
		ajaxTimer3 = setInterval(ajax_request2,5000);
		ajaxTimer4 = setInterval(ajax_request,5000);
		adaptit();
		})
}
function adaptit(){	
	$('.datatable').dataTable();
	$(function(){
    $('.datatable').each(function(){
        var datatable = $(this);
        // SEARCH - Add the placeholder for Search and Turn this into in-line formcontrol
        var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
        search_input.attr('placeholder', 'Arama Yapın')
        search_input.addClass('form-control input-small')
        search_input.css('width', '350px')
 
        // SEARCH CLEAR - Use an Icon
        var clear_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] a');
        clear_input.html('<i class="icon-remove-circle icon-large"></i>')
        clear_input.css('margin-left', '5px')
 
        // LENGTH - Inline-Form control
        var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
        length_sel.addClass('form-control input-small')
        length_sel.css('width', '75px')
 
        // LENGTH - Info adjust location
        var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_info]');
        length_sel.css('margin-top', '18px')
    });
});
	}
</script>
<style>
.tooltip-inner{max-width:400px;}
/*.navbar-nav>li>a {
line-height: 58px;
}
*/
.lisans>li>a {
line-height: 14px;
font-size: 14px;
padding-top: 23px;
padding-bottom: 0px;
}
.first{ width:125px; display:inline-block}
.modal-dialog { width:75%;}
.shutdownit,.rebootit,.newwsrmodal{ width:30%;}
.gizli{ display:none;}
.newUserAlert{ width:100%; height:90px; line-height:48px; color:#fff; display:block; font-weight:bold; font-size:18px; position:absolute; z-index:999999; top:0; left:0; text-align:center; background-color:#39F; padding:20px 0px; display:none;}
</style>
<title>Workviewer - <?php echo $userName; ?></title>
</head>

<body>
<div class="newUserAlert">
	<p><?php echo $dil["new_user"]; ?></p>
</div>
<input type="hidden" class="licence_key" value="<?php echo $key; ?>" /> 
<nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-menu"></span>
    </button>
    <a class="navbar-brand" href="#"><img src="../img/logo.png" /></a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
      <li class="active"><a href="home.php"><?php echo $dil["homepage"]; ?></a></li>
      <?php if($surum=="1"){ ?>
      <li><a href="#"><i class="icon-back-in-time" style="font-size:24px"></i> <?php echo $dil["demo"]; ?></a></li>
      <?php }if($surum=="3"){ ?>
      <li><a href="#"><i class="icon-check" style="font-size:24px"></i> <?php echo $dil["licenced"]; ?></a></li>
      <?php } ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $userName; ?> <b class="caret"></b></a>
        <ul class="dropdown-menu">
        	<!-- <li><a href="#"><?php echo $dil["account_settings"]; ?></a></li> -->
          	<li><a data-toggle="modal" href="#editinformation"><?php echo $dil["update_information"]; ?></a></li>
        </ul>
      </li>
    </ul>
      <p><span class="first"><?php echo $dil["licence_owner"]; ?> </span><span> : </span><span><b><?php echo $userName; ?></b></span><span class="first" style="margin-left:40px;"><?php echo $dil["licence_expiry_date"]; ?></span><span> : </span><span><b><?php if($kalansure>0){ echo nekadar($kalansure);}else{ echo $dil["licence_expired"]; } ?></b></span></p>
      <p><span class="first"><?php echo $dil["licence_scope"]; ?></span><span> : </span><span><b><?php echo $clientCount; ?> Client PC</b></span><span style="margin-left:90px;"><a href="cikis.php" style="margin-top:-10px;" class="btn btn-danger btn-sm"><?php echo $dil["logout"]; ?></a>
    <?php
	if($_SESSION["logindil"]=="tr"){
	?>
    <a href="http://www.workviewer.com/login/dil.php?dil=en&sayfa=<?php echo $_SERVER['REQUEST_URI']; ?>" style="margin-top:-10px;" class="btn btn-danger btn-sm">English</a>
    <?php
	}
	?>
    <?php
	if($_SESSION["logindil"]=="en"){
	?>
    <a href="http://www.workviewer.com/login/dil.php?dil=tr&sayfa=<?php echo $_SERVER['REQUEST_URI']; ?>" style="margin-top:-10px;" class="btn btn-danger btn-sm">Türkçe</a>
    <?php
	}
	?></span></p>
  </div><!-- /.navbar-collapse -->
</nav>
<div class="row">
	<div class="col-lg-3 col-md-4">
    <div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          <?php echo $dil["restictions"]; ?>
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
        <div class="list-group">
          <a href="#" id="websiterestrictions" class="list-group-item restrictions"><i class="icon-block"></i> <?php echo $dil["wsr"]; ?></a>
          <a href="#" id="apprestrictions" class="list-group-item restrictions"><i class="icon-block"></i> <?php echo $dil["appr"]; ?></a>
          <a href="#" id="internettimerestrictions" class="list-group-item restrictions"><i class="icon-block"></i> <?php echo $dil["itr"]; ?></a>
          <a href="#" id="pctimerestrictions" class="list-group-item restrictions"><i class="icon-block"></i> <?php echo $dil["pctimer"]; ?></a>
          <a href="#" id="windowsrestrictions" class="list-group-item restrictions"><i class="icon-block"></i> <?php echo $dil["windowsr"]; ?></a>
        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          <?php echo $dil["screen_recordings"]; ?>
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
        <div class="list-group">
          <a href="#" id="srs" class="list-group-item restrictions"><i class="icon-block"></i> <?php echo $dil["image_record_setting"]; ?></a>
          <a href="#" id="datetime" class="list-group-item restrictions"><i class="icon-block"></i> <?php echo $dil["registered_screen_monitoring"]; ?></a>
        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
          RAPORLAR
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        <div class="list-group">
          <a href="#" id="programusagereport" class="list-group-item restrictions"><i class="icon-block"></i> Program Kullanım Raporu</a>
          <a href="#" id="useractivityreport" class="list-group-item restrictions"><i class="icon-block"></i> Kullanıcı Aktivite Raporu</a>
          <a href="#" id="userstatistics" class="list-group-item restrictions"><i class="icon-block"></i> Kullanıcı İstatistikleri</a>
        </div>
      </div>
    </div>
  </div>
</div>
    </div>
    <div class="col-lg-9 col-md-8">
    <div class="row">
    <div class="col-lg-3 col-md-2 col-sm-12 col-xs-12">
    <form class="form-horizontal" role="form">
      <div class="form-group">
        <label for="inputPassword" style="text-align:left;" class="col-lg-4 col-md-3 col-sm-12 col-xs-12 control-label"> <?php echo $dil["search_pc"]; ?></label>
        <div class="col-lg-8 col-md-9 col-sm-12 col-xs-12">
          <input type="text" class="form-control findpc" id="findpc" placeholder="<?php echo $dil["search_pc"]; ?>">
        </div>
      </div>
    </form>
    </div>
    <div class="col-lg-9 col-md-10 col-sm-12 col-xs-12">
    <p class="active_clients_text"><i class="icon-desktop-3"></i><b><span class="active_clients">0</span></b> <?php echo $dil["showing_active_users"]; ?><span class="btn btn-success btn-sm" id="PageRefresh"><i class="icon-spin3"></i> <?php echo $dil["refresh_page"]; ?></span><span class="btn btn-info btn-sm" id="smaller"><i class="icon-minus-2"></i> <?php echo $dil["decrase_screen"]; ?></span><span class="btn btn-primary btn-sm" id="taller"><i class="icon-plus-2"></i> <?php echo $dil["incrase_screen"]; ?></span></p>
    </div>
    </div>
    <div class="row">
    <div class="screens">
    <div class="alert alert-danger gizle nocomputer">
    	<p><?php echo $dil["no_result_pc"]; ?></p>
    </div>
 <?php
 	for($i=1; $i<=$clientCount; $i++){
?>
		<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 screen" id="panel<?php echo $i; ?>">
            <div class="panel panel-info">
            	<div class="panel-heading alias" id="alias<?php echo $i; ?>">
				<span><?php echo $i; ?>. <?php echo $dil["screen"]; ?></span>
                </div>
            	<div class="panel-body text-center">
                <div class="message" id="<?php echo $i; ?>">
                <i style="font-size:50px; color:#C30; margin-top:30px; display:inline-block;" class="icon-off-1"></i>
                <p style="margin-top:10px; font-weight:bold;"><?php echo $dil["no_connection"]; ?></p>
                </div>
                <div class="buttons"></div>
                </div>
                <input type="hidden" id="keydisk<?php echo $i; ?>" class="form-control keydisk"  />
                <input type="hidden" id="port<?php echo $i; ?>" class="form-control port" />
                <input type="hidden" id="filterport<?php echo $i; ?>" class="form-control filterport" />
            </div>
        </div>
        <div class="modal fade modalfullscreen" id="myModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Kapat</button>
                  <h4 class="modal-title" id="clientname<?php echo $i; ?>">Modal title</h4>
                </div>
                <div class="modal-body modalscreen" id="modalscreen<?php echo $i; ?>">
             
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
      <div class="modal fade" id="inform<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog shutdownit">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><?php echo $dil["close"]; ?></button>
                  <h4 class="modal-title" id="clientname<?php echo $i; ?>"><?php echo $dil["shutdown_pc"]; ?></h4>
                </div>
                <div class="modal-body modalscreen" id="shutdownmessage<?php echo $i; ?>">
             		<p><?php echo $dil["sure_shutdown"]; ?></p>
                    <div class="alert alert-info gizle">
                    	<p><?php echo $dil["pc_shutting"]; ?></p>
                    </div>
                </div>
                <div class="modal-footer">
                	<button class="btn btn-primary shutdownyes" id="shutdownyes<?php echo $i; ?>"><?php echo $dil["yes"]; ?></button>
                    <button class="btn btn-danger shutdownno" data-dismiss="modal" id="no<?php echo $i; ?>"><?php echo $dil["no"]; ?></button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
          <div class="modal fade" id="informreboot<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog rebootit">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><?php echo $dil["close"]; ?></button>
                  <h4 class="modal-title" id="clientname<?php echo $i; ?>"><?php echo $dil["restart_pc"]; ?></h4>
                </div>
                <div class="modal-body modalscreen" id="rebootmessage<?php echo $i; ?>">
             		<p><?php echo $dil["sure_restart"]; ?></p>
                    <div class="alert alert-info gizle">
                    	<p><?php echo $dil["pc_restarting"]; ?></p>
                    </div>
                </div>
                <div class="modal-footer">
                	<button class="btn btn-primary rebootyes" id="rebootyes<?php echo $i; ?>"><?php echo $dil["yes"]; ?></button>
                    <button class="btn btn-danger rebootno" data-dismiss="modal" id="no<?php echo $i; ?>"><?php echo $dil["no"]; ?></button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
          <script type="text/javascript">
		  	var baksayi<?php echo $i; ?> =0;
			var clicked = false;
			function bak<?php echo $i; ?>(){
			var newimage_xhr<?php echo $i; ?> = null;
			var kalansure = <?php echo $kalansure; ?>;
			var port<?php echo $i; ?> = $("#port<?php echo $i; ?>").val();
			var diskkey<?php echo $i; ?> = $("#keydisk<?php echo $i; ?>").val();
						var newimage<?php echo $i; ?> = function() {
									newimage_xhr<?php echo $i; ?> = $.ajax({
									method:"GET",
									url: "getclientscreen.php",
									data: "port="+port<?php echo $i; ?>,
									async: true,
									cache:false,
									success: function(image){
									if(image){
									if(kalansure<0){
									$("#panel<?php echo $i; ?>").find(".message").html('<div class="blurit"><span>Kullanım Süresi Doldu<span></div><img class="img-responsive" src="data:image/jpeg;base64,'+image+'" alt="Ekran Görüntüsü" />');
									}else{
									$("#panel<?php echo $i; ?>").find(".message").html('<img class="img-responsive img-thumbnail" src="data:image/jpeg;base64,'+image+'" alt="Ekran Görüntüsü" />');
									$("#panel<?php echo $i; ?>").find(".buttons").fadeIn();
									$("#modalscreen<?php echo $i; ?>").html('<img class="img-responsive" src="data:image/jpeg;base64,'+image+'" alt="Ekran Görüntüsü" />');
									$("button").tooltip();
									}
									}else{
									$("#panel<?php echo $i; ?>").find(".message").html('Şu anda görüntü alınamıyor...');
									}
									if(image=="-2"){
									newimage_xhr<?php echo $i ?>.abort();
									var saniye<?php echo $i; ?> = 60;
										var timer<?php echo $i; ?>;
										function countdownmanager<?php echo $i; ?>() {
										saniye<?php echo $i; ?>--;
										if(saniye<?php echo $i; ?> == 59) {
										$.get("resetport.php",{key:diskkey<?php echo $i; ?>},function(resp){	
										});
										}
										if(saniye<?php echo $i; ?> == 20) {
										$.get("getfilterport.php",{key:diskkey<?php echo $i; ?>},function(filterport){
												$("#filterport<?php echo $i ?>").val(filterport);	
											});
											$.get("getportnumber.php",{key:diskkey<?php echo $i; ?>},function(screenport){
												$("#port<?php echo $i ?>").val(screenport);	
											});		
										}
										if(saniye<?php echo $i; ?> >= 1) {
											$("#panel<?php echo $i; ?>").find(".message").html("Bağlantı "+saniye<?php echo $i; ?>+" saniye içinde yenilecek.");
											$("#modalscreen<?php echo $i; ?>").html("Bağlantı "+saniye<?php echo $i; ?>+" saniye içinde yenilecek.");
										}else{
										port<?php echo $i; ?> = $("#port<?php echo $i; ?>").val();
										newimage<?php echo $i; ?>();
										clearInterval(timer<?php echo $i; ?>);
											}
										}
										timer<?php echo $i; ?> = setInterval(countdownmanager<?php echo $i; ?>, 1000);
									}
									if(image!="-2"){if(baksayi<?php echo $i; ?><2){newimage<?php echo $i; ?>(); $("#stopvideo<?php  echo $i; ?>").hide();$("#playvideo<?php  echo $i; ?>").show();}}
									if(clicked){ $("#stopvideo<?php  echo $i; ?>").show(); $("#playvideo<?php  echo $i; ?>").hide();}
									$("body").on("click","#stopvideo<?php echo $i; ?>",function(){
										baksayi<?php echo $i; ?> = 0;
										clicked = false;
										newimage_xhr<?php echo $i; ?>.abort();
										$(this).hide();
										$("#playvideo<?php  echo $i; ?>").show();
									})
									$("body").on("click","#playvideo<?php echo $i; ?>",function(){
										baksayi<?php echo $i; ?> = -9999999;
										clicked = true;
										newimage<?php echo $i; ?>();
										$(this).hide();
										$("#stopvideo<?php  echo $i; ?>").show();
									})
									},
									statusCode: {
									  500: function() {
									  $("#panel<?php echo $i; ?>").find(".message").html('<i style="font-size:50px; color:#C30; margin-top:30px; display:inline-block;" class="icon-off-1"></i><p style="margin-top:10px; font-weight:bold;"><?php echo $dil["no_connection"]; ?></p>');
									  $(".buttons").hide();
									   }
									},
									});
									baksayi<?php echo $i; ?>++;
						}
									$("#panel<?php echo $i; ?>").find(".buttons").html('<button data-toggle="modal" href="#inform<?php echo $i; ?>" data-toggle="tooltip" title="<?php echo $dil["shutdown_pc"]; ?>" class="btn btn-sm btn-danger shutdown"><i class="icon-off"></i></button><button data-toggle="modal" href="#informreboot<?php echo $i; ?>" data-toggle="tooltip" title="<?php echo $dil["restart_pc"]; ?>" class="btn btn-sm btn-info"><i class="icon-cw-1"></i></button><button data-toggle="modal" href="#myModal<?php echo $i; ?>" data-toggle="tooltip" title="<?php echo $dil["full_screen"]; ?>" class="btn btn-sm btn-primary fullscreen"><i class="icon-resize-full-3"></i></button><button class="btn btn-sm btn-primary stopvideo" id="stopvideo<?php echo $i; ?>" data-toggle="tooltip" title="<?php echo $dil["stop_retr_screen"]; ?>"><i class="icon-stop-1"></i></button><button class="btn btn-sm btn-primary playvideo" id="playvideo<?php echo $i; ?>" data-toggle="tooltip" title="<?php echo $dil["start_retr_screen"]; ?>"><i class="icon-play"></i></button>');
									if(port<?php echo $i; ?>!=""){ newimage<?php echo $i; ?>(); if(baksayi<?php echo $i; ?>>1){newimage_xhr<?php echo $i ?>.abort(); } }
			}
					setTimeout("bak<?php echo $i; ?>()",3000);
</script>
<?php
		}
?>
 </div>
 </div>
 	<div class="panel panel-danger mainwindow">
        <div class="panel-heading">
        <h3 class="panel-title windowtitle runningapplicationsnow"><span class="computernamehere"></span>Anlık Özet Bilgiler<span class="label label-success pull-right closepanel">Paneli Gizle</span><span class="label label-success pull-right showpanel">Paneli Göster</span></h3>
      </div>
      <div class="panel-body loadpages">
                <div class="proc_list">
                	<!-- <p><i class="icon-warning-empty"></i> <?php echo $dil["performance_click"]; ?></p> -->
                    <table class="table table-striped datatable" id="noclickinformation">
                    <thead>
                        <th class="text-center" style="width:10%;">Bilgisayar Adı</th>
                        <th class="text-center" style="width:22%;">Verimlilik</th>
                        <th class="text-center" style="width:8%;">Tam Ekran İzle</th>
                        <th class="text-center" style="width:34%;">Aktif Pencere</th>
                        <th class="text-center" style="width:8%;">CPU Kullanımı</th>
                        <th class="text-center" style="width:8%;">RAM Kullanımı</th>
                        <th class="text-center" style="width:10%;">Çalışma Süresi</th>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                </div>
              </div>
    </div>
</div>
<div class="modal fade" id="editinformation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width:40%;">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><?php echo $dil["close"]; ?></button>
                  <h4 class="modal-title"><?php echo $dil["account_information"]; ?></h4>
                </div>
                <div class="modal-body modalscreen">
             		<form class="form-horizontal updateinformationform" role="form">
                      <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo $dil["username"]; ?></label>
                        <div class="col-lg-9">
                          <p class="form-control-static"><?php echo $user_name; ?></p>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="companytitle" class="col-lg-3 control-label"><?php echo $dil["firm"]; ?></label>
                        <div class="col-lg-9">
                          <input type="text" value="<?php echo $userName; ?>" name="userName" id="companytitle" class="form-control">
                        </div>
                      </div>
                      <div class="form-group" id="hidepassword">
                        <label for="inputPassword" class="col-lg-3 control-label"><?php echo $dil["password"]; ?></label>
                        <div class="col-lg-9">
                        	<div class="input-group">
                               		<input type="password" value="<?php echo $user_pass; ?>" name="user_pass" class="form-control" id="inputPassword">
                                    <span class="input-group-btn">
                                		<button class="btn btn-default showpassword" type="button"><?php echo $dil["showpassword"]; ?></button>
                              		</span>
                            </div>
                        </div>
                      </div>
                      <div class="form-group" id="showpassword" style="display:none;">
                        <label for="inputPassword2" class="col-lg-3 control-label"><?php echo $dil["password"]; ?></label>
                        <div class="col-lg-9">
                        	<div class="input-group">
                               		<input type="text" value="<?php echo $user_pass; ?>" class="form-control" id="inputPassword2" readonly="readonly">
                                    <span class="input-group-btn">
                                		<button class="btn btn-default hidepassword" type="button"><?php echo $dil["hidepassword"]; ?></button>
                              		</span>
                            </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="formcity" class="col-lg-3 control-label"><?php echo $dil["state"]; ?></label>
                        <div class="col-lg-9">
                          <input type="text" value="<?php echo $city; ?>" name="city" id="formcity" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="formaddress" class="col-lg-3 control-label"><?php echo $dil["province"]; ?></label>
                        <div class="col-lg-9">
                          <input type="text" value="<?php echo $district; ?>" name="district" id="formdistrict" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="formaddress" class="col-lg-3 control-label"><?php echo $dil["address"]; ?></label>
                        <div class="col-lg-9">
                          <input type="text" value="<?php echo $address; ?>" name="address" id="formaddress" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="formhomephone" class="col-lg-3 control-label"><?php echo $dil["work_phone"]; ?></label>
                        <div class="col-lg-9">
                          <input type="text" value="<?php echo $homephone; ?>" name="homephone" id="formhomephone" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="formmobilephone" class="col-lg-3 control-label"><?php echo $dil["mobile_phone"]; ?></label>
                        <div class="col-lg-9">
                          <input type="text" value="<?php echo $mobilephone; ?>" name="mobilephone" id="formmobilephone" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="formclientCount" class="col-lg-3 control-label"><?php echo $dil["client_count"]; ?></label>
                        <div class="col-lg-9">
                          <input type="text" value="<?php echo $clientCount; ?>" name="clientCount" id="formclientCount" class="form-control">
                        </div>
                      </div>
                      <input type="hidden" value="<?php echo $id; ?>" name="user_id" />
                    </form>
                    <div class="alert alert-danger gizle updateinformationerror">
                    	<p></p>
                    </div>
                    <div class="alert alert-success gizle updateinformationsuccess">
                    	<p><?php echo $dil["success"]; ?></p>
                    </div>
                    <div class="alert alert-info gizle updateinformationloading">
                    	<p><?php echo $dil["pls_wait_update"]; ?></p>
                    </div>
                </div>
                <div class="modal-footer">
                	<button class="btn btn-primary updateinformation"><?php echo $dil["update_information"]; ?></button>
                    <button class="btn btn-danger" data-dismiss="modal"><?php echo $dil["ignore"]; ?></button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
</body>
</html>