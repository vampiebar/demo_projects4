<?php 
session_start();
include("config.php");
include("functions.php");
$id=$_SESSION["workviewer"];
if(!$id){
	header("location:index.php");	
}
$sorgu=pg_query("select * from registered_users where id = '$id'");
while($rows=pg_fetch_object($sorgu)){
	$key = $rows->reg_id;
	$userName = $rows->company_person_name;
	$clientCount = $rows->license_client_count;
	$install_date=$rows->install_date;
	$sure=time()-strtotime($install_date);
	$days=$rows->license_client_days;
	$kalansure=$days*86400-$sure;
}
echo $key;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/userstyle.css" />
<link rel="stylesheet" href="css/animation.css" />
<link rel="stylesheet" href="css/fontello.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/holder.js"></script>
<script type="application/javascript">
$(function(){
	var key = $(".licence_key").val();
	var clientCount = <?php echo $clientCount; ?>;
	var kalansure = <?php echo $kalansure; ?>;
	var getclients = function(){
	$.ajax({
            method:'get',
			cache:false,
            url:'getclients.php',
			data:"key="+key,
            success:function(data){
			if(data!=''){
			var data2 = data.split(",");
			$(".active_clients").text(data2.length);
			for(var i=0;i<data2.length;i++){
			$("#panel"+(i+1)).find(".keydisk").val(data2[i]);
			}
			}else{
				$("#panel"+(i+1)).find(".message").text("Şu anda geçici olarak görüntüler yüklenemiyor...");
				}
			},
			error:function(){
				$('.message').html("Şu anda geçici olarak görüntüler yüklenemiyor...");
				}
          })
		  .done(function(){
			 $(".keydisk").each(function(i,obj){
			  	var diskkey = $(this).val();
				if(diskkey){
				$("#panel"+(i+1)).find(".message").html('<i style="font-size:50px; color:#0477bd; margin-top:30px; display:inline-block" class="icon-spin2 animate-spin"></i> <p style="margin-top:10px;">Bağlantı Kuruluyor Lütfen Bekleyin...</p><button data-toggle="tooltip" title="Bağlantıyı Yenile" id="resetport2'+(i+1)+'" class="btn btn-warning resetport2"><i class="icon-arrows-cw-outline" style="font-size:16px;"></i></button>');	
				$.ajax({
					method:"GET",
			 	  	url: "getportnumber.php",
			   		data: "key="+diskkey,
			   		async: true,
			   		success: function(port){
				  		$("#port"+(i+1)).val(port);
						timer = setInterval(function(){
						$.get("getclientscreen.php",{port:port},function(image){
						if(image){
						if(kalansure<0){
					  	$("#panel"+(i+1)).find(".message").html('<div class="blurit"><span>Kullanım Süresi Doldu<span></div><img class="img-responsive" src="data:image/jpeg;base64,'+image+'" alt="Ekran Görüntüsü" />');
						}else{
						$("#panel"+(i+1)).find(".message").html('<img class="img-responsive img-thumbnail" src="data:image/jpeg;base64,'+image+'" alt="Ekran Görüntüsü" />');
						$("#panel"+(i+1)).find(".buttons").fadeIn();
						$("#modalscreen"+(i+1)).html('<img class="img-responsive" src="data:image/jpeg;base64,'+image+'" alt="Ekran Görüntüsü" />');
						$("button").tooltip();
						}
						}else{
						$("#panel"+(i+1)).find(".message").html('Şu anda görüntü alınamıyor...');
						}
						if(image=="-2"){
						$("#panel"+(i+1)).find(".message").html('Portun değişmesi gerekiyor...');
						/* Portu Resetle*/
						$.get("resetport.php",{key:diskkey},function(image){
							console.log("Port Resetlendi.");	
							location.reload();
						});
						}
						});
						},2000);
						$("#panel"+(i+1)).find(".buttons").html('<button data-toggle="modal" href="#inform'+(i+1)+'" data-toggle="tooltip" title="Bilgisayarı Kapat" class="btn btn-danger shutdown"><i class="icon-off" style="font-size:20px;"></i></button><button data-toggle="modal" href="#informreboot'+(i+1)+'" data-toggle="tooltip" title="Bilgisayarı Yeniden Başlat" class="btn btn-info"><i class="icon-cw-1" style="font-size:20px;"></i></button><button data-toggle="tooltip" title="Bağlantıyı Yenile" id="resetports'+(i+1)+'" class="btn btn-warning resetports"><i class="icon-arrows-cw-outline" style="font-size:20px;"></i></button><button data-toggle="modal" href="#myModal'+(i+1)+'" data-toggle="tooltip" title="Tam Ekran İzle" class="btn btn-primary fullscreen"><i class="icon-resize-full-3" style="font-size:20px;"></i></button>');
			   		},
					statusCode: {
					200: function() {
					  console.log('200 status code! Herşey yolunda');
					},
					400: function() {
					  console.log('400 status code! user error');
					},
					500: function() {
					  console.log('500 status code! server error');
					}
				  }
				}).done(function(){
					$.ajax({
					method:"GET",
			 	  	url: "getfilterport.php",
			   		data: "key="+diskkey,
			   		async: true,
			   		success: function(port){
				  		$("#filterport"+(i+1)).val(port);
						$.post("getuserinfo.php",{port:port},function(alias){
							$("#panel"+(i+1)).find(".alias span").html(alias+'<i class="rename icon-edit-alt" id="renameit'+(i+1)+'" data-placement="bottom" data-toggle="tooltip" title="Yeniden Adlandır"></i>');
							$("#panel"+(i+1)).find(".alias").append('<div class="gizle" id="rename'+(i+1)+'"><div class="input-group"><input type="text" id="renameinput'+(i+1)+'" class="form-control" value="'+alias+'" /><span class="input-group-btn"><button class="btn btn-primary changealias" id="changealias'+(i+1)+'" type="button">Değiştir</button></span></div></div>');
							$("#clientname"+(i+1)).html("Bilgisayar Adı: "+alias);
							$(".rename").tooltip();
						});
					}
					});
					})
				}
			}); 
			  });
	}
	getclients();
	$("body").on("click",".message img",function(){
						 	if(kalansure<0){
							 return false;
							 }
							var id = $(this).parent().attr("id");
							console.log(id);
							var bsport = $("#port"+id).val();
							var filterport = $("#filterport"+id).val();
							var keydisk = $("#keydisk"+id).val();
							if($(".windowtitle").hasClass("runningapplicationsnow"))
							{
									$(".proc_list").html('<i style="font-size:50px; color:#0477bd; margin-top:30px; display:inline-block" class="icon-spin2 animate-spin"></i><p style="margin-top:10px;">Lütfen Bekleyiniz. Çalışan Uygulamalar Listesi Alınıyor...</p>');
									$(".proc_count").html('<i class="icon-spin2 animate-spin"></i>');
									$.ajax({
									method:"GET",
									url: "getproclist.php",
									data: "port="+filterport,
									async: true,
									success: function(proclist){
									if(!proclist){
									$(".proc_list").html('Şu anda liste alınamıyor...');	
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
									$(".proc_count").text(size);
									}
									}
									});
									$(".screens").find(".panel").removeClass("panel-primary").addClass("panel-info");
									$(this).parent().parent().parent().removeClass("panel-info").addClass("panel-primary");
									var pc_name = $(this).parent().parent().parent().find(".alias span").eq(0).text();
									$(".runningapplications").text(pc_name+" Adlı Bilgisayarda ");
							}
							if($(".windowtitle").hasClass("websiterestrictions"))
							{
									$(".restrictedwebsites").html('<i style="font-size:50px; color:#0477bd; margin-top:30px; display:inline-block" class="icon-spin2 animate-spin"></i><p style="margin-top:10px;">Lütfen Bekleyiniz. Web Sitesi Kısıtlama Listesi Alınıyor...</p>');
									$(".restrictedwebsitescount").html('<i class="icon-spin2 animate-spin"></i>');
									$.ajax({
									method:"GET",
									url: "getwsrlist.php",
									data: "port="+filterport,
									async: true,
									success: function(proclist){
									if(!proclist){
									$(".restrictedwebsites").html('Şu anda liste alınamıyor...');	
									}else{
									if(proclist=="-2"){
									/* Portu Resetle*/
									/*$.get("resetctrlport.php",{key:keydisk},function(image){
										console.log("Port Resetlendi.");	
									});
									*/
									$(".restrictedwebsites").html("Port Canlı Değil");
									}else{
									$(".restrictedwebsites").html(proclist);
									$(".blockbutton").hover(function(){
										$(this).removeClass("btn-danger").addClass("btn-success").html('<i class="icon-check"></i> İzin Ver');
										},function(){
										$(this).removeClass("btn-success").addClass("btn-danger").html('<i class="icon-block"></i> Yasaklı');	
										})
									$(".allowbutton").hover(function(){
										$(this).removeClass("btn-success").addClass("btn-danger").html('<i class="icon-block"></i> Yasakla');
										},function(){
										$(this).removeClass("btn-danger").addClass("btn-success").html('<i class="icon-check"></i> İzin Verildi');	
										})
									}
									var size = $(".restrictedwebsites table tbody tr").size();
									$(".restrictedwebsitescount").text(size);
									}
									}
									});
									$(".screens").find(".panel").removeClass("panel-primary").addClass("panel-info");
									$(this).parent().parent().parent().removeClass("panel-info").addClass("panel-primary");
									var pc_name = $(this).parent().parent().parent().find(".alias span").eq(0).text();
									$(".restrictedwebsiteslist").text(pc_name+" Adlı Bilgisayarda ");
							}
							});
		  $(".restrictions").click(function(){
			  $(".list-group-item").removeClass("active");
			  $(".list-group-item").find("i").removeClass("icon-ok-circled-1").addClass("icon-block");
			  $(this).addClass("active");
			  $(this).find("i").removeClass("icon-block").addClass("icon-ok-circled-1");
			  var id = $(this).attr("id");
			  $(".loadpages").load(id+".html");
			  var text = $(this).text();
			  $(".windowtitle").removeClass().addClass("panel-title windowtitle "+id).text(text);
			  });
			  $('#PageRefresh').click(function() {
    	      location.reload();
			});
			var screensize=3;
			$("#taller").click(function(){
				screensize++;
				$(".screen").removeClass().toggleClass("col-sm-12 col-xs-12 col-md-"+(screensize+1)+" screen col-lg-"+screensize);
				console.log(screensize);
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
				console.log(screensize);
				if(screensize==2){
					$(this).addClass("disabled").attr("disabled","disabled");
					}
				if(screensize<12){
					$("#taller").removeClass("disabled").removeAttr("disabled");
					}
				})
			$(".shutdownyes").click(function(){
				var filterportstring = $(this).attr("id");
				var filterport = filterportstring.split("shutdownyes");
				filterport = filterport[1];
				var filterportown = $("#filterport"+filterport).val();
				$.get("shutdown.php",{port:filterportown},function(resp){
					$('#inform'+filterport).modal('hide');
				});
				});
			$(".rebootyes").click(function(){
				var filterportstring = $(this).attr("id");
				var filterport = filterportstring.split("rebootyes");
				filterport = filterport[1];
				var filterportown = $("#filterport"+filterport).val();
				$.get("reboot.php",{port:filterportown},function(resp){
					$('#informreboot'+filterport).modal('hide');	
				});
				});
				$("body").on("click",".resetports",function(){
					var resetport = $(this).attr("id");
					resetport = resetport.split("resetports");
					resetport = resetport[1];
					var keydisk = $("#keydisk"+resetport).val();
					$.get("resetctrlport.php",{key:keydisk},function(resp){
					console.log("Filtre Portu Resetlendi");	
					});
					$.get("resetport.php",{key:keydisk},function(resp){
					console.log("Görüntü Portu Resetlendi");	
					});
				});
				$("body").on("click",".resetport2",function(){
					var resetport = $(this).attr("id");
					resetport = resetport.split("resetport2");
					resetport = resetport[1];
					var keydisk = $("#keydisk"+resetport).val();
					$.get("resetctrlport.php",{key:keydisk},function(resp){
					console.log("Filtre Portu Resetlendi");	
					});
					$.get("resetport.php",{key:keydisk},function(resp){
					console.log("Görüntü Portu Resetlendi");	
					});
				});
				$("body").on("click",".rename",function(){
					var renameid = $(this).attr("id");
					renameid = renameid.split("renameit");
					renameid = renameid[1];
					console.log(renameid);
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
					console.log(alias2);
					console.log(filterport2);
					$.get("changealias.php",{port:filterport2,alias:alias2},function(resp){
					$(this).removeClass("disabled").removeAttr("disabled");
					$("#alias"+aliasid).html('<span>'+alias2+'<i class="rename icon-edit-alt" id="renameit'+aliasid+'" data-placement="bottom" data-toggle="tooltip" title="Yeniden Adlandır"></i></span>');
					$("#renameinput"+aliasid).hide();	
					$("#rename"+aliasid).hide();
					$("#alias"+aliasid).append('<div class="gizle" id="rename'+aliasid+'"><div class="input-group"><input type="text" id="renameinput'+aliasid+'" class="form-control" value="'+alias2+'" /><span class="input-group-btn"><button class="btn btn-primary changealias" id="changealias'+aliasid+'" type="button">Değiştir</button></span></div></div>');
					$(".rename").tooltip();
					$("#clientname"+aliasid).html("Bilgisayar Adı: "+alias2);
					});
					});
				
})
</script>
<style>
.tooltip-inner{max-width:400px;}
.navbar-nav>li>a {
line-height: 58px;
}
.lisans>li>a {
line-height: 14px;
font-size: 14px;
padding-top: 10px;
padding-bottom: 0px;
}
.first{ width:150px; display:inline-block}
.modal-dialog { width:75%;}
.shutdownit,.rebootit,.newwsrmodal{ width:30%;}
.gizli{ display:none;}
</style>
<title>Workviewer - <?php echo $userName; ?></title>
</head>

<body>
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
      <li class="active"><a href="home.php">Anasayfa</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ayarlar <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Hesap Ayarları</a></li>
          <li><a href="#">Bilgilerini Düzenle</a></li>
        </ul>
      </li>
      <?php if($kalansure<0){ ?>
      <li><a href="#"><i class="icon-back-in-time" style="font-size:24px"></i> Demo Sürüm</a></li>
      <?php }else{ ?>
      <li><a href="#"><i class="icon-check" style="font-size:24px"></i> Kayıtlı Sürüm</a></li>
      <?php } ?>
    </ul>
    <ul class="nav navbar-nav lisans">
    <li><a href="#">
      <p><span class="first">Lisans Sahibi </span><span> : </span><span><?php echo $userName; ?></span></p>
      <p><span class="first">Lisans Kapsamı </span><span> : </span><span><?php echo $clientCount; ?> Client PC</span></p>
      <p><span class="first">Kalan Lisans Süresi</span><span> : </span><span><?php if($kalansure>0){ echo nekadar($kalansure);}else{ echo "Süre doldu";} ?></span></p>
    </a>
    </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $userName; ?> <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="cikis.php">Çıkış Yap</a></li>
        </ul>
      </li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>
<div class="row">
	<div class="col-lg-3 col-md-4">
    <div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          KISITLAMALAR
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
        <div class="list-group">
          <a href="#" id="websiterestrictions" class="list-group-item restrictions"><i class="icon-block"></i> Web Site Kısıtlamaları</a>
          <a href="#" id="apprestrictions" class="list-group-item restrictions"><i class="icon-block"></i> Uygulama Kısıtlamaları</a>
          <a href="#" id="internettimerestrictions" class="list-group-item restrictions"><i class="icon-block"></i> İnternet Süre Kısıtlamaları</a>
          <a href="#" id="pctimerestrictions" class="list-group-item restrictions"><i class="icon-block"></i> Bilgisayar Süre Kısıtlamaları</a>
        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          EKRAN KAYITLARI
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
        <div class="list-group">
          <a href="#" class="list-group-item restrictions"><i class="icon-block"></i> Görüntü Kayıt Ayarları</a>
          <a href="#" id="datetime" class="list-group-item restrictions"><i class="icon-block"></i> Kayıtlı Ekranları İzleme</a>
        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
          PROGRAM AYARLARI
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        <div class="list-group">
          <a href="#" class="list-group-item restrictions"><i class="icon-block"></i> Lisans Bilgileri</a>
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
        <label for="inputPassword" style="text-align:left;" class="col-lg-4 col-md-3 col-sm-12 col-xs-12 control-label">PC Ara</label>
        <div class="col-lg-8 col-md-9 col-sm-12 col-xs-12">
          <input type="text" class="form-control" id="inputPassword" placeholder="PC ARA">
        </div>
      </div>
    </form>
    </div>
    <div class="col-lg-9 col-md-10 col-sm-12 col-xs-12">
    <p class="active_clients_text"><i class="icon-desktop-3"></i><b><span class="active_clients">0</span></b> aktif kullanıcı gösteriliyor.<span class="btn btn-success" id="PageRefresh"><i class="icon-spin3"></i> Sayfayı Yenile</span><span class="btn btn-info" id="smaller"><i class="icon-minus-2"></i> Ekranları Küçült</span><span class="btn btn-primary" id="taller"><i class="icon-plus-2"></i> Ekranları Büyüt</span></p>
    </div>
    </div>
    <div class="row">
    <div class="screens">
 <?php
 	for($i=1; $i<=$clientCount; $i++){
?>
		<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 screen" id="panel<?php echo $i; ?>">
            <div class="panel panel-info">
            	<div class="panel-heading alias" id="alias<?php echo $i; ?>">
				<span><?php echo $i; ?>. Görüntü</span>
                </div>
            	<div class="panel-body text-center">
                <div class="message" id="<?php echo $i; ?>">
                <i style="font-size:50px; color:#C30; margin-top:30px; display:inline-block;" class="icon-off-1"></i>
                <p style="margin-top:10px; font-weight:bold;">Şu anda bağlantı kurulamıyor...</p>
                </div>
                <div class="buttons"></div>
                </div>
                <input type="text" id="keydisk<?php echo $i; ?>" class="form-control keydisk"  />
                <input type="text" id="port<?php echo $i; ?>" class="form-control port" />
                <input type="text" id="filterport<?php echo $i; ?>" class="form-control filterport" />
            </div>
        </div>
        <div class="modal fade" id="myModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Kapat</button>
                  <h4 class="modal-title" id="clientname<?php echo $i; ?>">Bilgisayarı Kapat</h4>
                </div>
                <div class="modal-body modalscreen" id="shutdownmessage<?php echo $i; ?>">
             		<p>Bilgisayarı Kapatmak İstediğinizden Emin Misiniz?</p>
                </div>
                <div class="modal-footer">
                	<button class="btn btn-primary shutdownyes" id="shutdownyes<?php echo $i; ?>">Evet</button>
                    <button class="btn btn-danger shutdownno" data-dismiss="modal" id="no<?php echo $i; ?>">Hayır</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
          <div class="modal fade" id="informreboot<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog rebootit">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Kapat</button>
                  <h4 class="modal-title" id="clientname<?php echo $i; ?>">Bilgisayarı Kapat</h4>
                </div>
                <div class="modal-body modalscreen" id="rebootmessage<?php echo $i; ?>">
             		<p>Bilgisayarı Yeniden Başlatmak İstediğinizden Emin Misiniz?</p>
                </div>
                <div class="modal-footer">
                	<button class="btn btn-primary rebootyes" id="rebootyes<?php echo $i; ?>">Evet</button>
                    <button class="btn btn-danger rebootno" data-dismiss="modal" id="no<?php echo $i; ?>">Hayır</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
<?php
		}
?>
 </div>
 </div>
 	<div class="panel panel-danger mainwindow">
        <div class="panel-heading">
        <h3 class="panel-title windowtitle runningapplicationsnow">Ana Pencere</h3>
      </div>
      <div class="panel-body loadpages">
        <div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-warning">
              <div class="panel-heading">
              <h3 class="panel-title"><span class="runningapplications"></span>Çalışan Uygulamalar <span class="label label-success pull-right proc_count">0</span></h3>
              </div>
              <div class="panel-body">
                <div class="proc_list">
                <div class="alert alert-info">
                	<p><i class="icon-warning-empty"></i> Çalışan Uygulamalar Listesi'ni görmek için herhangi bir PC Görüntüsüne tıklayınız.</p>
                </div>
                </div>
              </div>
            </div>
            </div>
        </div>
      </div>
    </div>
    </div>
</div>
</body>
</html>