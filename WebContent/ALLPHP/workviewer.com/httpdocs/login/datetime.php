<?php 
$date = time();
$date2 = date("Y-m-d",$date);
$now = date("Y-m-d H:i:s",$date);
?>
<script type="text/javascript" src="js/datepicker.js"></script>
<script type="text/javascript" src="http://secpayazilim.com/deneme/js/slider.js"></script>
<script type="text/javascript">
var autoslide = 0;
var timer;
$(function(){
	$("#baslangic2").keyup(function(){
		var val = $(this).val();
		$("#baslangic").val(val);
		})
	$("#bitis2").keyup(function(){
		var val2 = $(this).val();
		$("#bitis").val(val2);
		});
	$("#baslangic").keyup(function(){
		var val = $(this).val();
		$("#baslangic2").val(val);
		})
	$("#bitis").keyup(function(){
		var val2 = $(this).val();
		$("#bitis2").val(val2);
		})
	var datearray = [];
	$(".watcholdscreens").click(function(){
		$(this).hide();
		$(".watcholdscreens2").hide();
		$(".stopwatcholdscreens2").show();
		$(".stopwatcholdscreens").show();
		timer = setInterval("slideit()",1000);
		});
	$("body").on("click",".stopwatcholdscreens",function(){
		clearInterval(timer);
		$(this).hide();
		$(".stopwatcholdscreens2").hide();
		$(".watcholdscreens2").show();
		$(".watcholdscreens").show();
		});
	$(".watcholdscreens2").click(function(){
		$(this).hide();
		$(".watcholdscreens").hide();
		$(".stopwatcholdscreens2").show();
		$(".stopwatcholdscreens").show();
		timer = setInterval("slideit()",1000);
		});
	$("body").on("click",".stopwatcholdscreens2",function(){
		clearInterval(timer);
		$(this).hide();
		$(".stopwatcholdscreens").hide();
		$(".watcholdscreens2").show();
		$(".watcholdscreens").show();
		});
	$('#datetimepicker1,#datetimepicker2,#datetimepicker3,#datetimepicker4').datetimepicker({
                   format:"yyyy-MM-dd hh:mm:ss"
                });
	$(document).on("click",".bringthemall",function(){
		$(".tarihuyari,.basariliistek,.lutfenbekleyin").fadeOut();
		var port = $(".datetimehidden").val();
		var baslangic = $("#baslangic").val();
		var bitis = $("#bitis").val();
		baslangic2 = baslangic.split(' ').join('T');
		bitis2 = bitis.split(' ').join('T');
		baslangic3 = new Date(baslangic2);
		bitis3 = new Date(bitis2);
		baslangic4 = baslangic3.getTime()/1000; 
		bitis4 = bitis3.getTime()/1000;
		//console.log(baslangic+" "+bitis);
		if(port==""){
			$(".tarihuyari").html('<p>Lütfen Bilgisayar Seçiniz.</p>').fadeIn();
			}else
		if(baslangic4>bitis4){
			$(".tarihuyari").html('<p>Başlangıç Tarihi Bitiş Tarihinden Küçük Olmalıdır.</p>').fadeIn();
			}else{
				$(".tarihuyari,.basariliistek").fadeOut(700,function(){
					$(".lutfenbekleyin").fadeIn(200,function(){
						$(".deleteimages,.bringthemall").addClass("disabled").attr("disabled","disabled");
						});
					});
				$.ajax({
					type:"GET",
					data:"t1="+baslangic+"&t2="+bitis+"&port="+port,
					url:"getdates.php",
					success:function(b){
					var date = b.split(";;");
					datearray = date;
					}
					}).done(function(){
						$.ajax({
					type:"GET",
					data:"t1="+baslangic+"&t2="+bitis+"&port="+port,
					url:"getoldscreenid.php",
					success:function(a){
						if(a!=""){
						var id = a.split(";;");
						var idarray = id;
						$(".lutfenbekleyin").fadeOut(700,function(){
						$(".basariliistek").html(id.length+" adet görüntü bulundu.").fadeIn(700,function(){
							$(".deleteimages,.bringthemall").removeClass("disabled").removeAttr("disabled");
							});	
						});
						$(".slider").slider({
						range:"min",
						min: 0,
						max: id.length-1,
						animate: true,
						slide:function(event,ui){
								var tooltip = '<div class="tooltipslider"><div class="tooltipslider-inner">'+datearray[ui.value]+'</div><div class="tooltipslider-arrow"></div></div>';
								autoslide = ui.value;
								$('.ui-slider-handle').html(tooltip);
							},
						change: function(event, ui) {
							$.ajax({
								type:"GET",
								url:"getoldscreen.php",
								data:"id="+idarray[ui.value]+"&port="+port,
								success:function(b){
									$(".oldscreen").html('<img class="img-responsive img-thumbnail" src="data:image/jpeg;base64,'+b+'" />');
									$(".oldscreen2").html('<img class="img-responsive img-thumbnail" src="data:image/jpeg;base64,'+b+'" />');
									$(".watcholdscreens,.fullscreenoldscreen").fadeIn();
									}
								})
								var tooltip = '<div class="tooltipslider"><div class="tooltipslider-inner">'+datearray[ui.value]+'</div><div class="tooltipslider-arrow"></div></div>';
								autoslide = ui.value;
								$('.ui-slider-handle').html(tooltip);
								if(autoslide == (idarray.length-1)){
									clearInterval(timer);
									$(".stopwatcholdscreens").hide();
									$(".watcholdscreens").show();
									}
						}
						});
					}else{
						$(".watcholdscreens,.fullscreenoldscreen").fadeOut();
						$(".lutfenbekleyin").fadeOut(200,function(){
							$(".tarihuyari").html("Belirtilen tarihler arasında kayıt bulunmamaktadır").fadeIn(700,function(){
								$(".deleteimages,.bringthemall").removeClass("disabled").removeAttr("disabled");
							});
							});		
					}
					}
					}).done(function(){
						$(".slider").slider({value:0});
						})
						});
				}
		});
	$("body").on("click",".fullscreenoldscreen",function(){
		var computername = $(".computernamehere").text();
		$(".computernamemodal2").text(computername);
		});		
	$("body").on("click",".deleteimages",function(){
		var port = $(".datetimehidden").val();
		var baslangic = $("#baslangic").val();
		var bitis = $("#bitis").val();
		baslangic2 = baslangic.split(' ').join('T');
		bitis2 = bitis.split(' ').join('T');
		baslangic3 = new Date(baslangic2);
		bitis3 = new Date(bitis2);
		baslangic4 = baslangic3.getTime()/1000; 
		bitis4 = bitis3.getTime()/1000;
		var computername = $(".computernamehere").text();
		computername = computername.split(" - ");
		computername = computername[0];
		if(port==""){
			$(".tarihuyari").html('<p>Lütfen Bilgisayar Seçiniz.</p>').fadeIn();
			}else
		if(baslangic4>bitis4){
			$(".tarihuyari").html('<p>Başlangıç Tarihi Bitiş Tarihinden Küçük Olmalıdır.</p>').fadeIn();
			}else{
				/*$.ajax({
					type:"GET",
					data:"t1="+baslangic+"&t2="+bitis+"&port="+port,
					url:"deleteoldimages.php",
					success:function(b){
						console.log(b);
					}
				});
				*/
				$("#deleterecords").modal("show");
				$(".computernamemodal").text(computername);
				$(".date1").text(baslangic);
				$(".date2").text(bitis);
				}
		})
		$("body").on("click",".deleteimagesbutton",function(){
		var port = $(".datetimehidden").val();
		var baslangic = $("#baslangic").val();
		var bitis = $("#bitis").val();
		baslangic2 = baslangic.split(' ').join('T');
		bitis2 = bitis.split(' ').join('T');
		baslangic3 = new Date(baslangic2);
		bitis3 = new Date(bitis2);
		baslangic4 = baslangic3.getTime()/1000; 
		bitis4 = bitis3.getTime()/1000;
		var computername = $(".computernamehere").text();
		computername = computername.split(" - ");
		computername = computername[0];
		$(".lutfenbekleyinmodal").fadeIn();
				$.ajax({
					type:"GET",
					data:"t1="+baslangic+"&t2="+bitis+"&port="+port,
					url:"deleteoldimages.php",
					success:function(b){
						if(b=="DELETED"){
						$(".lutfenbekleyinmodal").fadeOut(700,function(){
							$(".basariliistekmodal").fadeIn(700).delay(1500).fadeOut(700,function(){
								$("#deleterecords").modal("hide");
								});
							});	
							}
					}
				});
		})
	})
	function slideit(){
			$(".slider").slider({value:autoslide})
			autoslide++;
			console.log(autoslide);
			}
</script>
<div class="row">
<input type="hidden" class="datetimehidden" />
        	<div class="col-lg-8">
            <div class="panel panel-warning">
              <div class="panel-heading">
              <h3 class="panel-title">Ekran Görüntüsü</h3>
              </div>
              <div class="panel-body">
              <div class="oldscreen"></div>
              <div class="slider slider-sample1 vertical-handler"></div>
              <button class="btn btn-sm btn-primary watcholdscreens"  data-toggle="tooltip" title="" data-original-title="İzlemeye Başla"><i class="icon-play"></i></button><button class="btn btn-sm btn-primary stopwatcholdscreens"  data-toggle="tooltip" title="" data-original-title="Durdur"><i class="icon-stop-1"></i></button><button data-toggle="modal" href="#fullscreenoldscreen" title="" class="btn btn-sm btn-primary fullscreenoldscreen" data-original-title="Tam Ekran İzle"><i class="icon-resize-full-3"></i></button>
              </div>
            </div>
            </div>
            <div class="col-lg-4">
            <div class="panel panel-warning">
              <div class="panel-heading">
              <h3 class="panel-title">Geçmişe Dönük Kayıtları İzleme</h3>
              </div>
              <div class="panel-body">
              <div class="alert alert-danger gizle tarihuyari">
              	
              </div>
              <div class="alert alert-info gizle lutfenbekleyin">
              	<p>Lütfen Bekleyiniz...</p>
              </div>
              <div class="alert alert-success gizle basariliistek">
              	<p>Lütfen Bekleyiniz...</p>
              </div>
                <div class="form-group">
                <p>Başlangıç Tarihi ve Saati</p>
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' id="baslangic" class="form-control" value="<?php echo $date2; ?> 09:00:00" data-format="yyyy-MM-dd hh:mm:ss" />
                    <span class="input-group-addon"><span class="icon-calendar"></span>
                    </span>
                </div>
            	</div>
                <div class="form-group">
                <p>Bitiş Tarihi ve Saati</p>
                <div class='input-group date' id='datetimepicker2'>
                    <input type='text' id="bitis" class="form-control" value="<?php echo $now; ?>" data-format="yyyy-MM-dd hh:mm:ss" />
                    <span class="input-group-addon"><span class="icon-calendar"></span>
                    </span>
                </div>
            	</div>
                <button class="btn btn-success bringthemall">Görüntüleri Getir</button>
                <button class="btn btn-danger deleteimages">Görüntüleri Sil</button>
              </div>
            </div>
            </div>
        </div>
      </div>
      <div class="modal fade" id="deleterecords" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" style="width:30%;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Görüntüleri Sil</h4>
              </div>
              <div class="modal-body">
               	<b class="computernamemodal"></b> bilgisayarına ait <b class="date1"></b> ile <b class="date2"></b> tarihleri arasındaki görüntüleri silmek istediğinizden emin misiniz?
                <div class="alert alert-info gizle lutfenbekleyinmodal">
              	<p>Lütfen Bekleyiniz...</p>
              	</div>
                <div class="alert alert-success gizle basariliistekmodal">
              	<p>Görüntüler başarıyla silindi.</p>
              	</div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary deleteimagesbutton">Görüntüleri Sil</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="modal fade" id="fullscreenoldscreen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" style="width:80%;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><span class="computernamemodal2"></span>Geçmiş Görüntüleri Tam Ekran İzle</h4>
              </div>
              <div class="modal-body">
              <div class="row">
              <form class="form-inline col-lg-12" role="form">
                  <div class="form-group col-lg-3">
                    <div class='input-group date' id='datetimepicker3'>
                        <input type='text' id="baslangic2" class="form-control" value="<?php echo $date2; ?> 09:00:00" data-format="yyyy-MM-dd hh:mm:ss" />
                        <span class="input-group-addon"><span class="icon-calendar"></span>
                        </span>
                    </div>
                  </div>
                  <div class="form-group col-lg-3">
                    <div class='input-group date' id='datetimepicker4'>
                        <input type='text' id="bitis2" class="form-control" value="<?php echo $now; ?>" data-format="yyyy-MM-dd hh:mm:ss" />
                        <span class="input-group-addon"><span class="icon-calendar"></span>
                        </span>
                    </div>
                  </div>
                  <div class="form-group col-lg-6">
                  <button class="btn btn-success bringthemall">Görüntüleri Getir</button>
                  <button class="btn btn-danger deleteimages">Görüntüleri Sil</button>
                  <button class="btn  btn-primary watcholdscreens2"  data-toggle="tooltip" title="" data-original-title="İzlemeye Başla"><i class="icon-play"></i></button>
                  <button class="btn  btn-primary stopwatcholdscreens2"  data-toggle="tooltip" title="" data-original-title="Durdur"><i class="icon-stop-1"></i></button> 
                  </div>
                </form> 
                </div>
               <!-- Fullscreen Buradan Başlıyor -->
                           <div class="row">
                        	<div class="col-lg-12">
                          	<div class="oldscreen2"></div>
                          	<div class="slider slider-sample1 vertical-handler"></div>
                        </div>
                    </div>
               <!-- Fullscreen Burada Bitiyor -->	
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->