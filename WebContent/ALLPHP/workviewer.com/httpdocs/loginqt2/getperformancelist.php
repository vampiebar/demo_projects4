<?php
$port = $_GET["port"];
if($_GET){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=wmi_list?get_system_mem_stat';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
$bosalan = number_format((($xml->system_mem_stat->actual_free)/(1024)/1024)/1024,2);
$kullanilanalan = number_format((($xml->system_mem_stat->actual_used)/(1024)/1024)/1024,2);
?>
<script type="text/javascript">
var chart2; // global
		
		/**
		 * Request data from the server, add it to the graph and set a timeout to request again
		 */
		function livememory() {
			$.ajax({
				type:"GET",
				url: 'livememstats.php',
				data:"port="+<?php echo $port; ?>, 
				success: function(point) {
					var series = chart2.series[0],
						shift = series.data.length > 20; // shift if the series is longer than 20
		
					// add the point
					chart2.series[0].addPoint(eval(point), true, shift);
					
					// call it again after one second
					setTimeout(livememory, 5000);	
				},
				cache: false
			});
		}
			
		$(document).ready(function() {
			chart2 = new Highcharts.Chart({
				chart: {
					renderTo: 'container',
					defaultSeriesType: 'area',
					events: {
						load: livememory
					}
				},
				title: {
					text: 'Anlık RAM Kullanımı'
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
<?php 
}
?>
<?php
$port = $_GET["port"];
if($_GET){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=wmi_list?get_system_cpu_stat';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
$kullanilancpu = $xml->system_cpu_stat->cpu_percent;
?>
<script type="text/javascript">
        var chart; // global
		
		/**
		 * Request data from the server, add it to the graph and set a timeout to request again
		 */
		function livecpu() {
			$.ajax({
				type:"GET",
				url: 'livecpustats.php',
				data:"port="+<?php echo $port; ?>, 
				success: function(point) {
					var series = chart.series[0],
						shift = series.data.length > 20; // shift if the series is longer than 20
		
					// add the point
					chart.series[0].addPoint(eval(point), true, shift);
					
					// call it again after one second
					setTimeout(livecpu, 5000);	
				},
				cache: false
			});
		}
			
		$(document).ready(function() {
			chart = new Highcharts.Chart({
				chart: {
					renderTo: 'container2',
					defaultSeriesType: 'area',
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
}
?>
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

<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	<h4>İşletim Sistemi Bilgileri</h4>
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
</div>
<?php 
}
?>