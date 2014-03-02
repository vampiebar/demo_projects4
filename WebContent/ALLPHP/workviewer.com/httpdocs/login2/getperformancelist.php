<?php
$port = $_GET["port"];
session_start();
if(!@$_SESSION["logindil"]){
	@$_SESSION["logindil"]="tr";
	require("dil/tr.php");
}else{
	require("dil/".$_SESSION["logindil"].".php");
} 
?>
<script type="text/javascript" src="js/datatablebs.js"></script>
<ul class="nav nav-tabs" id="tabbednav">
  <li class="active"><a href="#performance" data-toggle="tab"><?php echo $dil["performance_information"]; ?></a></li>
  <li><a href="#services" data-toggle="tab"><?php echo $dil["services_list"]; ?></a></li>
  <li><a href="#applications" data-toggle="tab"><?php echo $dil["installed_applications"]; ?></a></li>
  <li><a href="#os" data-toggle="tab"><?php echo $dil["os_information"]; ?></a></li>
  <li><a href="#activewindow" data-toggle="tab"><?php echo $dil["running_applications"]; ?></a></li>
  <li><a href="#network" data-toggle="tab"><?php echo $dil["network_adapters"]; ?></a></li>
</ul>
<div class="tab-content">
<div class="tab-pane fade in active" id="performance">
<script type="text/javascript">
var chart<?php echo $port; ?>; // global
		
		/**
		 * Request data from the server, add it to the graph and set a timeout to request again
		 */
		 function handleAjaxError(jqXHR, textStatus, errorThrown) {
			if (jqXHR.status == 500) {
			 console.log("Server 500 Hatası verdi.")
			}
		}
		function livememory<?php echo $port; ?>(){
			currentRequest<?php echo $port; ?> = $.ajax({
				type:"GET",
				url: 'livememstats.php',
				data:"port="+<?php echo $port; ?>,
				dataType:"json", 
				success: function(point) {
					var series = chart<?php echo $port; ?>.series[0],
						shift = series.data.length > 20; // shift if the series is longer than 20
		
					chart<?php echo $port; ?>.series[0].addPoint([point.time,eval(point.point)], true, shift);
				},
				cache: false,
				error:handleAjaxError
			});
		}
		setInterval(livememory<?php echo $port; ?>, 5000);	
		$(document).ready(function() {
			chart<?php echo $port; ?> = new Highcharts.Chart({
				chart: {
					renderTo: 'container<?php echo $port; ?>',
					defaultSeriesType: 'area',
					events: {
						load: livememory<?php echo $port; ?>
					}
				},
				title: {
					text: '<?php echo $dil["liveRamUsage"]; ?>'
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
						text: '<?php echo $dil["inPercent"]; ?>',
						margin: 20
					}
				},
				credits: {
				enabled: false
			   },
				series: [{
					name: '<?php echo $dil["liveRamUsage"]; ?>',
					data: []
				}]
			});		
		});
</script>
<div id="container<?php echo $port; ?>" class="col-lg-6 col-md-6 col-sm-12 col-xs-12"></div>
<script type="text/javascript">
        var chart2<?php echo $port; ?>; // global
		
		/**
		 * Request data from the server, add it to the graph and set a timeout to request again
		 */
		 function handleAjaxError2(jqXHR, textStatus, errorThrown) {
			if (jqXHR.status == 500) {
			 console.log("Server 500 Hatası verdi.")
			}
		}
		function livecpu() {
			$.ajax({
				type:"GET",
				url: 'livecpustats.php',
				dataType:"json",
				data:"port="+<?php echo $port; ?>, 
				success: function(point) {
					var series = chart2<?php echo $port; ?>.series[0],
						shift = series.data.length > 20; // shift if the series is longer than 20
		
					// add the point
					chart2<?php echo $port; ?>.series[0].addPoint([point.time,eval(point.point)], true, shift);
				},
				cache: false,
				error:handleAjaxError2
			});
		}
		setInterval(livecpu, 5000);		
		$(document).ready(function() {
			chart2<?php echo $port; ?> = new Highcharts.Chart({
				chart: {
					renderTo: 'container2<?php echo $port; ?>',
					defaultSeriesType: 'areaspline',
					events: {
						load: livecpu
					}
				},
				title: {
					text: '<?php echo $dil["liveCpuUsage"]; ?>'
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
						text: '<?php echo $dil["inPercent"]; ?>',
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
					name: '<?php echo $dil["liveCpuUsage"]; ?>',
					data: []
				}]
			});		
		});
</script>
<div id="container2<?php echo $port; ?>" class="col-lg-6 col-md-6 col-sm-12 col-xs-12"></div>
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
                text: '<?php echo $dil["diskUsage"]; ?>'
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
                    text: '<?php echo $dil["diskquota"]; ?>'
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
				name: '<?php echo $dil["totalSpace"]; ?>',
                data: [
				<?php for($a=0;$a<$sayi;$a++){
						echo number_format((($disktotal[$a])/(1024)/1024),2);
						if($a==($sayi-1)){
							
							}else{
								echo ",";
								}
						} ?>]
                
    
            },{
                name: '<?php echo $dil["usedSpace"]; ?>',
                data: [<?php for($k=0;$k<$sayi;$k++){
						echo number_format((($diskused[$k])/(1024)/1024),2);
						if($k==($sayi-1)){
							
							}else{
								echo ",";
								}
						} ?>]
    
            },
			 {
                name: '<?php echo $dil["freeSpace"]; ?>',
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
			$(".activescreentag<?php echo $port; ?>").html(a);
			}
		})
	}
</script>
<div class="alert alert-warning">
<p>Kullanıcı Şu anda <b class="activescreentag<?php echo $port; ?>"></b> ekranında.</p>
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
        	<th><?php echo $dil["serviceName"]; ?></th>
            <th><?php echo $dil["serviceBriefName"]; ?></th>
            <th><?php echo $dil["serviceStatus"]; ?></th>
        </thead>
        <tbody>
<?php
for($b=0;$b<count($xml->services->service);$b++){
?>
        <tr class="<?php if($xml->services->service[$b]->service_status==4){ echo "success";}else{ echo "danger";} ?>">
            <td><?php echo $xml->services->service[$b]->display_name; ?></td>
            <td><?php echo $xml->services->service[$b]->service_name; ?></td>
            <td><?php if ($xml->services->service[$b]->service_status==4) {echo '<p class="label label-success" style="font-size:100%;">'.$dil["running"].'</p>';} else{ echo '<p class="label label-danger" style="font-size:100%;">'.$dil["stopped"].'</p>';}  ?></td>
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
        	<th><?php echo $dil["programName"]; ?></th>
            <th><?php echo $dil["installDate"]; ?></th>
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

if($ay=="01" && $_SESSION["logindil"]=="en"){ $ay="January";}
if($ay=="02" && $_SESSION["logindil"]=="en"){ $ay="February";}
if($ay=="03" && $_SESSION["logindil"]=="en"){ $ay="March";}
if($ay=="04" && $_SESSION["logindil"]=="en"){ $ay="April";}
if($ay=="05" && $_SESSION["logindil"]=="en"){ $ay="May";}
if($ay=="06" && $_SESSION["logindil"]=="en"){ $ay="June";}
if($ay=="07" && $_SESSION["logindil"]=="en"){ $ay="July";}
if($ay=="08" && $_SESSION["logindil"]=="en"){ $ay="August";}
if($ay=="09" && $_SESSION["logindil"]=="en"){ $ay="September";}
if($ay=="10" && $_SESSION["logindil"]=="en"){ $ay="October";}
if($ay=="11" && $_SESSION["logindil"]=="en"){ $ay="November";}
if($ay=="12" && $_SESSION["logindil"]=="en"){ $ay="December";}
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
        	<th><?php echo $dil["appName"]; ?></th>
            <th><?php echo $dil["appPath"]; ?></th>
            <th><?php echo $dil["process"]; ?></th>
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
    <td><button class="btn btn-danger blockbutton" data-toggle="modal" href="#newar" style="margin-right:4px;"><i class="icon-block"></i> <?php echo $dil["blockit"]; ?></button></td>
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
        <h4 class="modal-title text-left"><?php echo $dil["addNewApplication"]; ?></h4>
      </div>
      <div class="modal-body">
      <div class="alert alert-info">
      <div style="display:none;">
      	<span class="fullpath"></span>
        <span class="filedesc"></span>
      </div>
      <p><?php echo $dil["avoidToAddApplication"]; ?></p>
      </div>
        <form class="form-horizontal" style="margin-top:10px;">
          <div class="form-group">
            <label class="col-lg-4 control-label"><?php echo $dil["startTime"]; ?></label>
            <div class="col-lg-8">
            <div class="col-lg-6">
                  <select class="form-control starthour">
                  <option value="saat"><?php echo $dil["hour"]; ?></option>
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
                <option value="dakika"><?php echo $dil["minute"]; ?></option>
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
            <label class="col-lg-4 control-label"><?php echo $dil["endTime"]; ?></label>
            <div class="col-lg-8">
            <div class="col-lg-6">
                 <select class="form-control endhour">
                 <option value="saat2"><?php echo $dil["hour"]; ?></option>
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
                <option value="dakika2"><?php echo $dil["minute"]; ?></option>
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
             <label class="col-lg-4 control-label"><?php echo $dil["days"]; ?></label>
             <div class="col-lg-8">
             <div class="col-lg-12">
             <select multiple  class="form-control days" style="min-height:150px;">
                <option value="1"><?php if($_SESSION["logindil"]=="en"){ echo "Monday"; } else { echo "Pazartesi"; } ?></option>
                <option value="2"><?php if($_SESSION["logindil"]=="en"){ echo "Tuesday"; } else { echo "Salı"; }?></option> 
                <option value="3"><?php if($_SESSION["logindil"]=="en"){ echo "Wednesday"; } else { echo "Çarşamba"; }?></option> 
                <option value="4"><?php if($_SESSION["logindil"]=="en"){ echo "Thursday"; } else { echo "Perşembe"; }?></option> 
                <option value="5"><?php if($_SESSION["logindil"]=="en"){ echo "Friday"; } else { echo "Cuma"; }?></option> 
                <option value="6"><?php if($_SESSION["logindil"]=="en"){ echo "Saturday"; } else { echo "Cumartesi"; }?></option> 
                <option value="0"><?php if($_SESSION["logindil"]=="en"){ echo "Sunday"; } else { echo "Pazar"; }?></option>
                <option value="8"><?php if($_SESSION["logindil"]=="en"){ echo "Always"; } else { echo "Sürekli"; }?></option>  
             </select>
             </div>
             </div>
             </div>
        </form>
        <div class="row" style="margin-top:20px;">
        <div class="alert alert-danger gizle addresserror"><?php echo $dil["appBlocking"]; ?></div>
        <div class="alert alert-info gizle addressinfo"><?php echo $dil["appBlocking"]; ?></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info addwsr"><?php echo $dil["addApp"]; ?></button>
        <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $dil["ignore"]; ?></button>
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
		$(".addresserror").html("<?php echo $dil["pls_choose_s_t_h"]; ?>").fadeIn(700);
		}else
	if(startminute=="dakika"){
		$(".addresserror").html("<?php echo $dil["pls_choose_s_t_m"]; ?>").fadeIn(700);
		}else
	if(endhour=="saat2"){
		$(".addresserror").html("<?php echo $dil["pls_choose_e_t_h"]; ?>").fadeIn(700);
		}else
	if(endminute=="dakika2"){
		$(".addresserror").html("<?php echo $dil["pls_choose_e_t_d"]; ?>").fadeIn(700);
		}else
	if(days==null || days ==9){
		$(".addresserror").html("<?php echo $dil["pls_choose_days"]; ?>").fadeIn(700);
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
					$("#activewindow").html('<i style="font-size:50px; color:#0477bd; margin-top:30px; display:inline-block" class="icon-spin2 animate-spin"></i><p style="margin-top:10px;"><?php echo $dil["plsWaitWhileApplicationList"]; ?></p>');
									$(".proc_count").html('<i class="icon-spin2 animate-spin"></i>');
									$.ajax({
									method:"GET",
									url: "getproclist.php",
									data: "port="+<?php echo $port; ?>,
									async: true,
									cache:false,
									success: function(proclist){
									if(!proclist){
									$("#activewindow").html('<?php echo $dil["list_error"]; ?>');	
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
        	<th><?php echo $dil["default_gateway"]; ?></th>
            <th><?php echo $dil["domain_name"]; ?></th>
            <th><?php echo $dil["computer_name"]; ?></th>
            <th><?php echo $dil["preferred_dns_server"]; ?></th>
            <th><?php echo $dil["other_dns_server"]; ?></th>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $xml->system_net_info->default_gateway; ?></td>
            <td><?php if($xml->system_net_info->domain_name==""){ echo '<p class="label label-danger" style="font-size:105%;">Bu bilgisayar etki alanında değil</p>';}else{ echo $xml->system_net_info->domain_name; } ?></td>
            <td><?php echo $xml->system_net_info->host_name; ?></td>
            <td><?php echo $xml->system_net_info->primary_dns; ?></td>
            <td><?php if($xml->system_net_info->secondary_dns!=""){ echo $xml->system_net_info->secondary_dns;}else{ echo '<p class="label label-danger" style="font-size:105%;"> '.$dil["dns_undefined"].'</p>';} ?></td>
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
	if($_SESSION["logindil"]!="en"){
	$sure = round($saniye/60)." dakika önce";
	}else{
	$sure = round($saniye/60)." minutes ago";	
	}
	}
if($saniye>3600){
		if($_SESSION["logindil"]!="en"){
		$sure = round($saniye/3600)." saat önce";
		}else{
		$sure = round($saniye/3600)." hours ago";	
		}
		}
if($saniye>216000){
		if($_SESSION["logindil"]!="en"){
		$sure = round($saniye/216000)." saat önce";
		}else{
		$sure = round($saniye/216000)." hours ago";	
		}
		}
if($saniye>5184000){
		if($_SESSION["logindil"]!="en"){
		$sure = round($saniye/5184000)." gün önce";
		}else{
		$sure = round($saniye/5184000)." days ago";	
		}
		}
?>
<table class="table table-bordered">
    	<thead>
        	<th><?php echo $dil["operating_system"]; ?></th>
            <th><?php echo $dil["service_pack"]; ?></th>
            <th><?php echo $dil["version"]; ?></th>
            <th><?php echo $dil["time"]; ?></th>
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