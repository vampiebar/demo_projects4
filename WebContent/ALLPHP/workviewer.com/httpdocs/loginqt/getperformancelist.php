<?php 
$port = $_GET["port"];
?>
<script type="text/javascript" src="js/datatablebs.js"></script>
<ul class="nav nav-tabs" id="tabbednav">
  <li class="active"><a href="#performance" data-toggle="tab">Performans Bilgileri</a></li>
  <li><a href="#services" data-toggle="tab">Hizmetler Listesi</a></li>
  <li><a href="#applications" data-toggle="tab">Kurulu Programlar</a></li>
  <li><a href="#os" data-toggle="tab">İşletim Sistemi Bilgileri</a></li>
  <li><a href="#activewindow" data-toggle="tab">Çalışan Programlar</a></li>
  <li><a href="#network" data-toggle="tab">Ağ Adaptörleri</a></li>
</ul>
<div class="tab-content">
<div class="tab-pane fade in active" id="performance">
<script type="text/javascript">
var chart2; // global
var currentRequest = null;
		
		/**
		 * Request data from the server, add it to the graph and set a timeout to request again
		 */
		function livememory<?php echo $port; ?>(){
			currentRequest = $.ajax({
				type:"GET",
				url: 'livememstats.php',
				data:"port="+<?php echo $port; ?>,
				dataType:"json", 
				success: function(point) {
					var series = chart2.series[0],
						shift = series.data.length > 20; // shift if the series is longer than 20
		
					chart2.series[0].addPoint([point.time,eval(point.point)], true, shift);
				},
				cache: false
			});
		}
		setInterval(livememory<?php echo $port; ?>, 5000);	
		$(document).ready(function() {
			chart2 = new Highcharts.Chart({
				chart: {
					renderTo: 'container',
					defaultSeriesType: 'area',
					events: {
						load: livememory<?php echo $port; ?>
					}
				},
				title: {
					text: 'Anlık RAM Kullanımı'
				},
				global: {
                	useUTC: false
            	},
				xAxis: {
					type: 'datetime',
					tickPixelInterval: 150,
					maxZoom: 20 * 1000
				},
				yAxis: {
					minPadding: 0.2,
					maxPadding: 0.2,
					max:100,
					labels: {
					formatter: function() {
						return '% '+this.value;
					}
				},
					title: {
						text: 'Yüzde cinsinden',
						margin: 20
					}
				},
				credits: {
				enabled: false
			   },
				series: [{
					name: 'Anlık RAM Kullanımı',
					data: []
				}]
			});		
		});
</script>
<div id="container" class="col-lg-6 col-md-6 col-sm-12 col-xs-12"></div>
<script type="text/javascript">
        var chart; // global
		
		/**
		 * Request data from the server, add it to the graph and set a timeout to request again
		 */
		function livecpu() {
			$.ajax({
				type:"GET",
				url: 'livecpustats.php',
				dataType:"json",
				data:"port="+<?php echo $port; ?>, 
				success: function(point) {
					var series = chart.series[0],
						shift = series.data.length > 20; // shift if the series is longer than 20
		
					// add the point
					chart.series[0].addPoint([point.time,eval(point.point)], true, shift);
				},
				cache: false
			});
		}
		setInterval(livecpu, 5000);		
		$(document).ready(function() {
			chart = new Highcharts.Chart({
				chart: {
					renderTo: 'container2',
					defaultSeriesType: 'areaspline',
					events: {
						load: livecpu
					}
				},
				title: {
					text: 'Anlık CPU Kullanımı'
				},
				xAxis: {
					type: 'datetime',
					tickPixelInterval: 150,
					maxZoom: 20 * 1000
				},
				yAxis: {
					minPadding: 0.2,
					maxPadding: 0.2,
					max:100,
					labels: {
						formatter: function() {
						return '% '+this.value;
						}
					},
					title: {
						text: 'Yüzde cinsinden',
						margin: 20
					}
				},
				global: {
                	useUTC: false
            	},
				credits: {
				enabled: false
			   },
				series: [{
					name: 'Anlık CPU Kullanımı',
					data: []
				}]
			});		
		});
</script>
<div id="container2" class="col-lg-6 col-md-6 col-sm-12 col-xs-12"></div>
<?php
$port = $_GET["port"];
if($_GET){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=wmi_list?get_system_fs_stat';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
$sayi = count($xml->system_fs_stat->fs_stat);
$diskname = array();
$diskused = array();
$diskfree = array();
$disktotal = array();
for($i=0;$i<$sayi;$i++){
	array_push($diskname,$xml->system_fs_stat->fs_stat[$i]->dir_name);	
	array_push($diskused,$xml->system_fs_stat->fs_stat[$i]->used);
	array_push($diskfree,$xml->system_fs_stat->fs_stat[$i]->free);
	array_push($disktotal,$xml->system_fs_stat->fs_stat[$i]->total);
}
?>
<script type="text/javascript">
$(function () {
        $('#container3').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Disk Kullanımı'
            },
            xAxis: {
                categories: [
                    <?php for($j=0;$j<$sayi;$j++){
						echo "'".substr($diskname[$j],0,2)."'";
						if($j==($sayi-1)){
							
							}else{
								echo ",";	
								}
						} ?>
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Disk Boyutu(GB)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0;font-size:12px">{series.name}: </td>' +
                    '<td style="padding:0;font-size:12px"><b>{point.y:.1f} GB</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
			credits: {
				enabled: false
			   },
            series: [{
				name: 'Toplam Alan',
                data: [
				<?php for($a=0;$a<$sayi;$a++){
						echo number_format((($disktotal[$a])/(1024)/1024),2);
						if($a==($sayi-1)){
							
							}else{
								echo ",";
								}
						} ?>]
                
    
            },{
                name: 'Kullanılan Alan',
                data: [<?php for($k=0;$k<$sayi;$k++){
						echo number_format((($diskused[$k])/(1024)/1024),2);
						if($k==($sayi-1)){
							
							}else{
								echo ",";
								}
						} ?>]
    
            },
			 {
                name: 'Boş Alan',
                data: [<?php for($m=0;$m<$sayi;$m++){
						echo number_format((($diskfree[$m])/(1024)/1024),2).",";
						if($m==($sayi-1)){
							
							}else{
								echo ",";
								}
						} ?>]
    
            }]
        });
    });
</script>
<div id="container3" class="col-lg-6 col-md-6 col-sm-12 col-xs-12"></div>
<?php 
}
?>
<div id="container4" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
<script type="text/javascript">
$(function(){
	getactivescreen();
	setInterval(getactivescreen,2000);
	})
function getactivescreen(){
		$.ajax({
		type:"GET",
		data:"screenport="+<?php echo $_GET["screenport"]; ?>,
		url:"liveactivescreen.php",
		success: function(a){
			$(".activescreentag").html(a);
			}
		})
	}
</script>
<div class="alert alert-warning">
<p>Kullanıcı Şu anda <b class="activescreentag"><?php echo $xml; ?></b> ekranında.</p>
</div>
</div>
</div>
<div class="tab-pane fade fade" id="services">
<?php
$port = $_GET["port"];
if($_GET){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=wmi_list?get_windows_services';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
?>
<table class="table table-bordered datatable" id="example">
    	<thead>
        	<th>İşlem Adı</th>
            <th>Servis Adı</th>
            <th>Servis Durumu</th>
        </thead>
        <tbody>
<?php
for($b=0;$b<count($xml->services->service);$b++){
?>
        <tr class="<?php if($xml->services->service[$b]->service_status==4){ echo "success";}else{ echo "danger";} ?>">
            <td><?php echo $xml->services->service[$b]->display_name; ?></td>
            <td><?php echo $xml->services->service[$b]->service_name; ?></td>
            <td><?php if ($xml->services->service[$b]->service_status==4) {echo '<p class="label label-success" style="font-size:100%;">Çalışıyor</p>';} else{ echo '<p class="label label-danger" style="font-size:100%;">Durduruldu</p>';}  ?></td>
        </tr>
<?php
}
?>
</tbody>
</table>
<?php
}
?>
</div>
<div class="tab-pane fade fade" id="applications">
<?php
$port = $_GET["port"];
if($_GET){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=wmi_list?get_installed_programs';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
?>
<table class="table table-striped datatable">
    	<thead>
        	<th>Program Adı</th>
            <th>Yüklenme Tarihi</th>
        </thead>
        <tbody>
<?php
for($b=0;$b<count($xml->installed_programs->program);$b++){
$yil = substr($xml->installed_programs->program[$b]->install_date,0,4);
$ay = substr($xml->installed_programs->program[$b]->install_date,4,2);
$gun = substr($xml->installed_programs->program[$b]->install_date,6,2);
if($ay=="01"){ $ay="Ocak";}
if($ay=="02"){ $ay="Şubat";}
if($ay=="03"){ $ay="Mart";}
if($ay=="04"){ $ay="Nisan";}
if($ay=="05"){ $ay="Mayıs";}
if($ay=="06"){ $ay="Haziran";}
if($ay=="07"){ $ay="Temmuz";}
if($ay=="08"){ $ay="Ağustos";}
if($ay=="09"){ $ay="Eylül";}
if($ay=="10"){ $ay="Ekim";}
if($ay=="11"){ $ay="Kasım";}
if($ay=="12"){ $ay="Aralık";}
?>
        <tr>
            <td><?php echo $xml->installed_programs->program[$b]->prg_name; ?></td>
            <td><?php echo $gun." ".$ay." ".$yil; ?></td>
        </tr>
<?php
}
?>
</tbody>
</table>
<?php
}
?>
</div>
<div class="tab-pane fade fade" id="activewindow">
<?php
$port = $_GET["port"];
if($_GET){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=proc_list?proc_list';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
$sayi=0;
?>
<table class="table  table-striped table-condensed datatable">
	<thead>
    	<tr>
        	<th style="display:none">Kısa Ad:</th>
        	<th>Uygulama Adı:</th>
            <th>Uygulama Yolu:</th>
            <th>İşlem:</th>
        </tr>
    </thead>
    <tbody>
<?php
foreach($xml->proc as $client){
$slashcount = substr_count($client->file_path,"\\");
$appname = explode("\\",$client->file_path);
natsort($appname); 
?>
<tr>
	<td style="display:none;"><?php echo $appname[$slashcount];?></td>
	<td><?php if (strlen($client->file_desc)<2){ echo "<span style=\"color:#f00\">Uygulama Adı Bulunmuyor</span>"; }else{ echo $client->file_desc;} ?></td>
    <td style="max-width:500px;word-wrap:break-word;"><?php echo $client->file_path; ?></td>
    <td><button class="btn btn-danger blockbutton" data-toggle="modal" href="#newar" style="margin-right:4px;"><i class="icon-block"></i> Yasakla</button></td>
</tr>
<?php
	$sayi++;
	}
echo $xml->getdata;
?>
</tbody>
</table>
<div class="modal fade" id="newar">
  <div class="modal-dialog" style="width:30%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-left">Yeni Uygulama Ekle</h4>
      </div>
      <div class="modal-body">
      <div class="alert alert-info">
      <div style="display:none;">
      	<span class="fullpath"></span>
        <span class="filedesc"></span>
      </div>
      <p><span class="appname" style="font-weight:bold;"></span> uygulamasını engellemek üzeresiniz.</p>
      </div>
        <form class="form-horizontal" style="margin-top:10px;">
          <div class="form-group">
            <label class="col-lg-4 control-label">Başlangıç Saati:</label>
            <div class="col-lg-8">
            <div class="col-lg-6">
                  <select class="form-control starthour">
                  <option value="saat">Saat:</option>
                  <?php 
                  for($i=0;$i<24;$i++){
					  if($i<10){
						echo '<option value="0'.$i.'">0'.$i.'</option>';  
						  }else{
                      echo '<option value="'.$i.'">'.$i.'</option>';
						  }
                      }
                  ?>
                </select>
            </div>
           <div class="col-lg-6">
                <select class="form-control startminute">
                <option value="dakika">Dakika:</option>
                  <?php 
                  for($i=0;$i<60;$i++){
					  if($i<10){
						echo '<option value="0'.$i.'">0'.$i.'</option>';  
						  }else{
                      echo '<option value="'.$i.'">'.$i.'</option>';
						  }
                      }
                  ?>
                </select>
            </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-4 control-label">Bitiş Saati:</label>
            <div class="col-lg-8">
            <div class="col-lg-6">
                 <select class="form-control endhour">
                 <option value="saat2">Saat:</option>
                  <?php 
                  for($i=0;$i<24;$i++){
					  if($i<10){
						echo '<option value="0'.$i.'">0'.$i.'</option>';  
						  }else{
                      echo '<option value="'.$i.'">'.$i.'</option>';
						  }
                      }
                  ?>
                </select>
           </div>
           <div class="col-lg-6">
                <select class="form-control endminute">
                <option value="dakika2">Dakika:</option>
                  <?php 
                  for($i=0;$i<60;$i++){
					  if($i<10){
						echo '<option value="0'.$i.'">0'.$i.'</option>';  
						  }else{
                      echo '<option value="'.$i.'">'.$i.'</option>';
						  }
                      }
                  ?>
                </select>
			</div>
            </div>
            </div>
             <div class="form-group">
             <label class="col-lg-4 control-label">Hangi Günler:</label>
             <div class="col-lg-8">
             <div class="col-lg-12">
             <select multiple  class="form-control days" style="min-height:150px;">
                <option value="1">Pazartesi</option>
                <option value="2">Salı</option> 
                <option value="3">Çarşamba</option> 
                <option value="4">Perşembe</option> 
                <option value="5">Cuma</option> 
                <option value="6">Cumartesi</option> 
                <option value="0">Pazar</option>
                <option value="8">Sürekli</option>  
             </select>
             </div>
             </div>
             </div>
        </form>
        <div class="row" style="margin-top:20px;">
        <div class="alert alert-danger gizle addresserror">Uygulama yasaklanıyor...</div>
        <div class="alert alert-info gizle addressinfo">Uygulama yasaklanıyor...</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info addwsr">Uygulama Ekle</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Vazgeç</button>
      </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
$(function(){
	$(".addwsr").removeClass("disabled").removeAttr("disabled");
	$(".addwsr").click(function(a){
	var proc_limit = $(".appname").text();
	var proc_limit_full_path = $(".fullpath").text();
	var proc_limit_file_desc = $(".filedesc").text();
	var starthour = $(".starthour").val();
	var startminute = $(".startminute").val();
	var endhour = $(".endhour").val();
	var endminute = $(".endminute").val();
	var days = $(".days").val();
	var proc_limit_start = starthour+":"+startminute;
	var proc_limit_end = endhour+":"+endminute;
	var gun;
	if(starthour=="saat"){
		$(".addresserror").html("Lütfen Başlangıç Saatini Seçin.").fadeIn(700);
		}else
	if(startminute=="dakika"){
		$(".addresserror").html("Lütfen Başlangıç Dakikasını Seçin.").fadeIn(700);
		}else
	if(endhour=="saat2"){
		$(".addresserror").html("Lütfen Bitiş Saatini Seçin.").fadeIn(700);
		}else
	if(endminute=="dakika2"){
		$(".addresserror").html("Lütfen Bitiş Dakikasını Seçin.").fadeIn(700);
		}else
	if(days==null || days ==9){
		$(".addresserror").html("Lütfen Gün Seçin.").fadeIn(700);
		}else{
		if(days==1){ gun="Pazartesi";}
		if(days==2){ gun="Salı";}
		if(days==3){ gun="Çarşamba";}
		if(days==4){ gun="Perşembe";}
		if(days==5){ gun="Cuma";}
		if(days==6){ gun="Cumartesi";}
		if(days==0){ gun="Pazar";}
		if(days==8){ gun="Sürekli";}
		$(".addressinfo").show();
		$(".addwsr").addClass("disabled").attr("disabled","disabled");
			$.ajax({
				type:"GET",
				url:"blockapplication.php",
				data:"port="+<?php echo $port; ?>+"&proc_limit="+proc_limit+"&proc_limit_start="+proc_limit_start+"&proc_limit_end="+proc_limit_end+"&proc_limit_weekday="+days+"&proc_limit_full_path="+proc_limit_full_path+"&proc_limit_file_desc="+proc_limit_file_desc,
				success:function(cevap){
					$("#newar").modal('hide');
					$(".modal-backdrop").hide();
					$("#activewindow").html('<i style="font-size:50px; color:#0477bd; margin-top:30px; display:inline-block" class="icon-spin2 animate-spin"></i><p style="margin-top:10px;">Lütfen Bekleyiniz. Uygulama Kısıtlama Listesi Alınıyor...</p>');
									$(".proc_count").html('<i class="icon-spin2 animate-spin"></i>');
									$.ajax({
									method:"GET",
									url: "getproclist.php",
									data: "port="+<?php echo $port; ?>,
									async: true,
									cache:false,
									success: function(proclist){
									if(!proclist){
									$("#activewindow").html('Şu anda liste alınamıyor...');	
									}else{
									if(proclist=="-2"){
									/* Portu Resetle*/
									/*$.get("resetctrlport.php",{key:keydisk},function(image){
										console.log("Port Resetlendi.");	
									});
									*/
									$("#activewindow").html("Port Canlı Değil");
									}else{
									$("#activewindow").html(proclist);
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
									var size = $("#activewindow table tbody tr").size();
									$(".proc_count").text(size);
									}
									}
									});
					}
				})
			}
	});
	$(".blockbutton").click(function(){
		var appname = $(this).parent().parent().find("td:eq(0)").text();
		$(".appname").text(appname);
		var fullpath = $(this).parent().parent().find("td:eq(2)").text();
		$(".fullpath").text(fullpath);
		var filedesc = $(this).parent().parent().find("td:eq(1)").text();
		$(".filedesc").text(filedesc);
	})
	})
</script>
<?php }else{
	header("location:home.php");
	}
?>
</div>
<div class="tab-pane fade fade" id="network">
<?php
$port = $_GET["port"];
if($_GET){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=wmi_list?get_system_net_info';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
?>
<table class="table table-bordered">
    	<thead>
        	<th>Varsayılan Ağ Geçidi</th>
            <th>Etki Alanı Adı</th>
            <th>Bilgisayar Adı</th>
            <th>Tercih Edilen DNS Sunucusu</th>
            <th>Diğer DNS Sunucusu</th>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $xml->system_net_info->default_gateway; ?></td>
            <td><?php if($xml->system_net_info->domain_name==""){ echo '<p class="label label-danger" style="font-size:105%;">Bu bilgisayar etki alanında değil</p>';}else{ echo $xml->system_net_info->domain_name; } ?></td>
            <td><?php echo $xml->system_net_info->host_name; ?></td>
            <td><?php echo $xml->system_net_info->primary_dns; ?></td>
            <td><?php if($xml->system_net_info->secondary_dns!=""){ echo $xml->system_net_info->secondary_dns;}else{ echo '<p class="label label-danger" style="font-size:105%;">Diğer DNS Sunucusu tanımlı değil.</p>';} ?></td>
        </tr>
</tbody>
</table>
<?php
}
?>
</div>
<div class="tab-pane fade fade" id="os">
<?php
$port = $_GET["port"];
if($_GET){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=wmi_list?get_system_info';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
$url2='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=wmi_list?get_system_uptime';
$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch2, CURLOPT_URL, $url2);
$data2 = curl_exec($ch2);
curl_close($ch2);
$xml2 = simplexml_load_string($data2);
$saniye = $xml2->system_uptime;
if($saniye>60){
	$sure = round($saniye/60)." dakika önce";
	}
if($saniye>3600){
		$sure = round($saniye/3600)." saat önce";
		}
if($saniye>216000){
		$sure = round($saniye/216000)." saat önce";
		}
if($saniye>5184000){
		$sure = round($saniye/5184000)." gün önce";

		}
?>
<table class="table table-bordered">
    	<thead>
        	<th>İşletim Sistemi</th>
            <th>Servis Paketi</th>
            <th>Versiyon</th>
            <th>Süre</th>
        </thead>
        <tbody>
        	<tr>
            	<td><?php echo $xml->system_info->description; ?></td>
                <td><?php echo $xml->system_info->patch_level; ?></td>
                <td><?php echo $xml->system_info->version; ?></td>
                <td><?php echo $sure; ?></td>
            </tr>
        </tbody>
    </table>
<?php
}
?>
</div>
</div>