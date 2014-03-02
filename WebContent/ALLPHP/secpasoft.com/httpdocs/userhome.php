<?php 
if($_SERVER['HTTPS']){
     $url = 'http://www.secpayazilim.com/hakkimizda';
     header("Location: $url");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Seçpa, Secpa, Seçpa Yazılım, Secpa Yazılım, Seçpa Yazilim, Secpa Yazilim, WorkViewer, Work Viewer, Kids, Kids Viewer, KidsViewer,Work Viewer Satın Al, Work Viewer Satin Al, WorkViewer Satın Al, WorkViewer Satin Al, Kids Viewer Satın Al, Kids Viewer Satin Al, KidsViewer Satın Al, KidsViewer Satin Al, ReadyCafe, Ready Cafe, Ready Cafe Satın Al, Ready Cafe Satin Al, ReadyCafe Satın Al, ReadyCafe Satin Al" />
<meta name="description" content="Seçpa Yazılım ve İnternet Teknolojileri Hakkımızda Sayfası" />
<meta name="Robots" content="index,follow" />
<link rel="stylesheet" type="text/css" href="../deneme/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="../deneme/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" type="text/css" href="../deneme/css/da-slider.css" />
<link rel="stylesheet" type="text/css" href="../deneme/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="../deneme/css/font-awesome-ie7.min.css" />
<!--<link rel="stylesheet" type="text/css" href="../deneme/css/fractionslider.css">-->
<link rel="stylesheet" type="text/css" href="../deneme/css/userhome.css" />
<script type="text/javascript" src="../deneme/js/jquery.js"></script>
<script type="text/javascript" src="../deneme/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../deneme/js/prettify.js"></script>
<script type="text/javascript" src="../deneme/js/modernizr.js"></script>
<script type="text/javascript" src="../deneme/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="../deneme/js/slider.js"></script>
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css' />
<link href='https://fonts.googleapis.com/css?family=Economica:700,400italic' rel='stylesheet' type='text/css' />
<link href='https://fonts.googleapis.com/css?family=Noto+Sans:400,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css' />
<title>Seçpa Yazılım | Hakkımızda</title>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#datetimepicker1').datetimepicker();
				$('#datetimepicker2').datetimepicker();
					prettyPrint();
					 $('.accordion').collapse();
				$(".accordion-toggle").click(function(){
					if ($(this).hasClass("opened")) {
						//User clicked active item, so remove the classes
						$(this).removeClass("opened");
					} else {
						//User clicked inactive item, remove from everything then add to this one
						$(".accordion-toggle").removeClass("opened");
						$(this).addClass("opened");              
					}
				
				});
			var getphoto = function(){
          	$.ajax({
            method:'post',
            url:'bunela.php',
            success:function(data){
			if(data!=''){
              $('.resim').html('<img src="data:image/jpeg;base64,'+data+'" alt="Ekran Görüntüsü" />');
			}else{
				$('.resim').html("Şu anda geçici olarak görüntüler yüklenemiyor...");
				}
            },
			error:function(){
				$('.resim').html("Şu anda geçici olarak görüntüler yüklenemiyor...");
				setInterval(getphoto,1000);
				}
          });
        }
        setInterval(getphoto,1000);
		var seconds = 1;
		var timer;
		function countdown() {
		seconds--;
		if(seconds >= 0) {
			$(".resim").html('Lütfen <b>'+seconds+'</b> saniye bekleyiniz...');
		} else {
			clearInterval(timer);
		}
		}
		timer = setInterval(countdown, 1000);
		
		$("#dateform").submit(function(a){
			var startdate = $("#datetimestart").val();
			var enddate = $("#datetimeend").val();
			$.ajax({
				type:"POST",
				url:"proc.php",
				data:"t1="+startdate+"&t2="+enddate,
				success:function(a){
					var id = a.split("<br>");
					console.log(id);
					var ilk = id[0];
					var sayi = id.length;
					var son = id[id.length-2];
					if(id!=""){
					$(".imagehere").removeClass("alert alert-danger");
					$(".slider-sample1").slider({
						range: "min",
						value:parseFloat(ilk),
						min: parseFloat(ilk),
						max: parseFloat(son),
						animate: true,
						step:5, 
						change: function(event, ui) { 
        				$.ajax({
							type:"POST",
							url:"getimage.php",
							data:"id="+parseFloat(ui.value),
							success:function(b){
								$(".imagehere").html(b);
								$(".konum").html("Şu andaki resmin Id'si: "+parseFloat(ui.value));
								var tooltip = '<div class="tooltipslider"><div class="tooltipslider-inner">' + ui.value + '</div><div class="tooltipslider-arrow"></div></div>';
								$('.ui-slider-handle').html(tooltip); 
								}
							}) 
    					}
           	 		}).show().find('.ui-slider-handle').html(tooltip).show();
					}else{
						$(".imagehere").html("Belirtilen tarihlere ait görüntü bulunamadı.").addClass("alert alert-danger");
						$(".slider-sample1").hide();
						}
					},
				error:function(){
					$(".imagehere").html("Ajax metodu ile ilgili bir hata var. Proc.php dosyasına gitmiyor...").addClass("alert alert-danger");
					}
				});
			a.preventDefault();
			});
			$(".play").click(function(){
				$('#slider-sample1').trigger('change');
				});
				});
		</script>
</head>

<body>
<div class="row-fluid">
	<div class="container-fluid" style="margin-top:10px;">
    <div class="row-fluid">
    <div class="span2">
    <img src="img/work_login.png"/>
    </div>
    <div class="span10">
    <a href="#" class="btn btn-info"><i class="icon-signal icon-3x"></i><br />Hızlı Raporlar</a>
    <a href="#" class="btn btn-info"><i class="icon-book icon-3x"></i><br />Raporlar</a>
    <a href="#" class="btn btn-info"><i class="icon-desktop icon-3x"></i><br />Ekran Görüntüle</a>
    <a href="#" class="btn btn-info"><i class="icon-comment icon-3x"></i><br />Sohbet</a>
    <a href="#" class="btn btn-info"><i class="icon-envelope icon-3x"></i><br />Mesaj Gönder</a>
    <a href="#" class="btn btn-info"><i class="icon-folder-open icon-3x"></i><br />Dosya Yöneticisi</a>
    <a href="#" class="btn btn-info"><i class="icon-folder-close icon-3x"></i><br />Program Listesi</a>
    <a href="#" class="btn btn-info"><i class="icon-cogs icon-3x"></i><br />Servis Listesi</a>
    <a href="#" class="btn btn-info"><i class="icon-question-sign icon-3x"></i><br />Özellikler</a>
    <a href="#" class="btn btn-info"><i class="icon-tasks icon-3x"></i><br />Görünüm</a>
    </div>
    </div>
    	<div class="row-fluid" style="margin-top:10px;">
        	<div class="span2">
               <div class="accordion" id="accordion2">
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle opened" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">Kısıtlamalar</a>
                </div>
                <div id="collapseOne" class="accordion-body collapse in">
                  <div class="accordion-inner">
                  	<a href="#"  class="btn btn-danger btn-block" style="text-align:left;"><i style="margin-left:5px;" class="icon-exclamation-sign"></i> Filtre Ayarları</a>
                    <a href="#"  class="btn btn-danger btn-block" style="text-align:left;"><i style="margin-left:5px;" class="icon-exclamation-sign"></i> Web Site Kısıtlamaları</a>
                    <a href="#"  class="btn btn-danger btn-block" style="text-align:left;"><i style="margin-left:5px;" class="icon-exclamation-sign"></i> Uygulama Kısıtlamaları</a>
                    <a href="#"  class="btn btn-danger btn-block" style="text-align:left;"><i style="margin-left:5px;" class="icon-exclamation-sign"></i> Dosya İndirme Kısıtlamaları</a>
                    <a href="#"  class="btn btn-danger btn-block" style="text-align:left;"><i style="margin-left:5px;" class="icon-exclamation-sign"></i> İnternet Süre Sınırlaması</a>
                    <a href="#"  class="btn btn-danger btn-block" style="text-align:left;"><i style="margin-left:5px;" class="icon-exclamation-sign"></i> İnternet Kota Sınırlaması</a>
                    <a href="#"  class="btn btn-danger btn-block" style="text-align:left;"><i style="margin-left:5px;" class="icon-exclamation-sign"></i> Bilgisayar Süre Sınırlaması</a>
                    <a href="#"  class="btn btn-danger btn-block" style="text-align:left;"><i style="margin-left:5px;" class="icon-exclamation-sign"></i> Windows Kısıtlamaları</a>
                  </div>
                </div>
              </div>
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">Ekran Kayıtları</a>
                </div>
                <div id="collapseTwo" class="accordion-body collapse">
                  <div class="accordion-inner">
                    <a href="#"  class="btn btn-danger btn-block" style="text-align:left;"><i style="margin-left:5px;" class="icon-exclamation-sign"></i> Ekran Kayıt Ayarları</a>
                    <a href="#"  class="btn btn-danger btn-block kei" style="text-align:left;"><i style="margin-left:5px;" class="icon-exclamation-sign"></i> Kayıtlı Ekranları İzleme</a>
                  </div>
                </div>
              </div>
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">Performans Ayarları</a>
                </div>
                <div id="collapseThree" class="accordion-body collapse">
                  <div class="accordion-inner">
                  	<a href="#"  class="btn btn-danger btn-block"><i style="margin-left:5px;" class="icon-exclamation-sign"></i> Filtre Ayarları</a>
                  </div>
                </div>
              </div>
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">Raporlar</a>
                </div>
                <div id="collapseFour" class="accordion-body collapse">
                  <div class="accordion-inner">
                  	<a href="#"  class="btn btn-danger btn-block"><i style="margin-left:5px;" class="icon-exclamation-sign"></i> Web Geçmişi</a>
                    <a href="#"  class="btn btn-danger btn-block"><i style="margin-left:5px;" class="icon-exclamation-sign"></i> Program Kullanım Raporu</a>
                    <a href="#"  class="btn btn-danger btn-block"><i style="margin-left:5px;" class="icon-exclamation-sign"></i> İnternet Kullanım Raporu</a>
                    <a href="#"  class="btn btn-danger btn-block"><i style="margin-left:5px;" class="icon-exclamation-sign"></i> Kullanıcı Performans Raporu</a>
                    <a href="#"  class="btn btn-danger btn-block"><i style="margin-left:5px;" class="icon-exclamation-sign"></i> Donanım Envanteri</a>
                    <a href="#"  class="btn btn-danger btn-block"><i style="margin-left:5px;" class="icon-exclamation-sign"></i> Yazılım Envanteri</a>
                    <a href="#"  class="btn btn-danger btn-block"><i style="margin-left:5px;" class="icon-exclamation-sign"></i> İç IP Logları</a>
                  </div>
                </div>
              </div>
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFive">Program Ayarları</a>
                </div>
                <div id="collapseFive" class="accordion-body collapse">
                  <div class="accordion-inner">
                  	<a href="#"  class="btn btn-danger btn-block"><i style="margin-left:5px;" class="icon-exclamation-sign"></i> Filtre Ayarları</a>
                  </div>
                </div>
              </div>
            </div>
            </div>
            <div class="span10">
            	<div class="row-fluid">
                	<div class="span3 thumbnail resim" style="height:205px; line-height:195px; text-align:center;"></div>
                    <div class="span3 thumbnail resim" style="height:205px; line-height:195px; text-align:center;"></div>
                    <div class="span3 thumbnail resim" style="height:205px; line-height:195px; text-align:center;"></div>
                    <div class="span3 thumbnail resim" style="height:205px; line-height:195px; text-align:center;"></div>
                </div>
                <div class="row-fluid" style="margin-top:10px;">
                	<div class="span3 thumbnail" style="height:205px; line-height:195px; text-align:center;">Bağlantı Yok</div>
                    <div class="span3 thumbnail" style="height:205px; line-height:195px; text-align:center;">Bağlantı Yok</div>
                    <div class="span3 thumbnail" style="height:205px; line-height:195px; text-align:center;">Bağlantı Yok</div>
                    <div class="span3 thumbnail" style="height:205px; line-height:195px; text-align:center;">Bağlantı Yok</div>
                </div>
                <div class="row-fluid" id="kei" style="margin-top:10px;">
                <div class="span5">
     			<div class="imagehere">Onur Gültekin</div>
                <div class="inputhere well">
                <div class="play">Tümünü Oynat!</div><div class="slider slider-sample1 vertical-handler"></div>
                </div>
                </div>
                <div class="span3">
                	<div class="well">
                    <form class="form" id="dateform">
                      <div id="datetimepicker1" class="input-append date">
                      <label>Başlangıç Tarihi ve Saati:</label>
                        <input data-format="yyyy-MM-dd hh:mm:ss" id="datetimestart" type="text" value="2013-06-14 16:40:10"/>
                        <span class="add-on">
                          <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                          </i>
                        </span>
                      </div>
                      <div id="datetimepicker2" class="input-append date">
                      <label>Bitiş Tarihi ve Saati:</label>
                        <input data-format="yyyy-MM-dd hh:mm:ss" id="datetimeend" type="text" value="2013-06-14 16:55:10" />
                        <span class="add-on">
                          <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                          </i>
                        </span>
                      </div>
                      <div class="row-fluid">
                      <button type="submit" class="btn btn-danger">Getir</button>
                      <div class="konum"></div>
                      </div>
                      </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

