<?php
$screenport = $_GET["screenport"];
$baslangic = $_GET["baslangic"];
$bitis = $_GET["bitis"];
$baslangic = strtotime($baslangic);
$bitis = strtotime($bitis);
include("functions.php");
session_start();
if(!@$_SESSION["logindil"]){
	@$_SESSION["logindil"]="tr";
	require("dil/tr.php");
}else{
	require("dil/".$_SESSION["logindil"].".php");
}
if($_GET){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$screenport.'&showerrorinxml=yes&link=screen_list?fetch_data___table=window_text_log___table_field_id=window_text_log_id___value1=0___value2=z';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
$sayi = count($xml->fetch_data->table_to_xml->window_text_log->row);
$xml = json_decode(json_encode((array) simplexml_load_string($data)), 1);
$sum = 0;
$newarray = array();
$arraypathpathcount = array();
$arraypathtextcount = array();
for($i=0;$i<count($xml["fetch_data"]["table_to_xml"]["window_text_log"]["row"]);$i++){
	$date = $xml["fetch_data"]["table_to_xml"]["window_text_log"]["row"][$i]["data_datetime"];
	$timestamp = strtotime($date);
	$newarray["paths"][] = $xml["fetch_data"]["table_to_xml"]["window_text_log"]["row"][$i]["window_prg_path"];
	$newarray["seconds"][] = $xml["fetch_data"]["table_to_xml"]["window_text_log"]["row"][$i]["window_text_count"];
	$newarray["texts"][] = $xml["fetch_data"]["table_to_xml"]["window_text_log"]["row"][$i]["window_text"];
	if($timestamp>=$baslangic && $timestamp<=$bitis ){	
	$arraypathpathcount[$newarray["paths"][$i]] = $newarray["seconds"][$i] + $arraypathpathcount[$newarray["paths"][$i]];
	$arraypathtextcount[$newarray["texts"][$i]] = $newarray["seconds"][$i] + $arraypathtextcount[$newarray["texts"][$i]];
	}
}
arsort($arraypathpathcount);
arsort($arraypathtextcount);
$arraysize = count($arraypathpathcount);
?>
<script type="text/javascript">
$(function() {
	var username = $(".computernamehere").text();
    var chart;
	var chart2;
    $(document).ready(function() {
        var colors = Highcharts.getOptions().colors,
            categories = [<?php
						$count = 0;
						foreach(array_keys($arraypathpathcount) as $key){
							$slashcount = substr_count($key,"\\");
							$appname = explode("\\",$key);
							if($count<4){
							echo "'".$appname[$slashcount]."'".",";
							}else
							if($count==4){
							echo "'".$appname[$slashcount]."'";	
							}else
							{
								break;
								}
							
							$count++;
							}
						?>],
            name = 'Programlar',
            level = 0,
            data = [
			<?php $count2 = 0; foreach($arraypathpathcount as $key=>$value){?>
			{
                y: <?php if($count2<5){ echo $arraypathpathcount[$key]; } ?>,
                color: colors[<?php if($count2<5){ echo $count2; } ?>],
			}
				<?php 
				if($count2<4){
				echo ",";
				}else{
					break;	
					}
				?>
				<?php 
				$count2++;
				} ?>
				];
		var colors2 = Highcharts.getOptions().colors,
            categories2 = [<?php
						$count = 0;
						foreach(array_keys($arraypathtextcount) as $key){
							if($count<5){
							$appname = explode(" ",$key);
							$appnamesize = count($appname);
							echo "'";
							for($j=0; $j<=$appnamesize; $j++){
							echo $appname[$j]." ";	
							}
							echo "'".",";
							}else
							if($count==5){
							echo "'".$appname[$slashcount]."'";	
							}else
							{
								break;
								}
							$count++;
							}
						?>],
            name2 = 'Programlar',
            level2 = 0,
            data2 = [
			<?php $count2 = 0; foreach($arraypathtextcount as $key=>$value){?>
			{
                y: <?php if($count2<5){ echo $arraypathtextcount[$key]; } ?>,
                color: colors[<?php if($count2<5){ echo $count2; } ?>],
			}
				<?php 
				if($count2<4){
				echo ",";
				}else{
					break;	
					}
				?>
				<?php 
				$count2++;
				} ?>
				];
        function setChart(name, categories, data, color, level, type) {
            chart.xAxis[0].setCategories(categories);
            for(x = 0; x < chart.series.length; x++)
            {
                chart.series[x].remove();
            }        
            for(x = 0; x < chart.series.length; x++)
            {
                chart.series[x].remove();
            }            

            chart.addSeries({
                color: color || 'white',
                name: name,
                level: level,
                data: data,
                type: type
            });
        }
        function setChart(name2, categories2, data2, color2, level2, type2) {
            chart2.xAxis[0].setCategories(categories2);
            for(x = 0; x < chart2.series2.length; x++)
            {
                chart2.series2[x].remove();
            }        
            for(x = 0; x < chart2.series2.length; x++)
            {
                chart2.series2[x].remove();
            }            

            chart.addSeries({
                color: color || 'white',
                name: name2,
                level: level2,
                data: data2,
                type: type2
            });
        }
        function setChartMultiSeries(name, categories, series, color, level, type) {
            chart.xAxis[0].setCategories(categories);
            for(x = 0; x < chart.series.length; x++)
            {
                chart.series[x].remove();
            }
            for(x = 0; x < chart.series.length; x++)
            {
                chart.series[x].remove();
            }      

            for(x = 0; x < series.length; x++)
            {
                chart.addSeries({
                    color: series[x].color,
                    name: series[x].name,
                    level: level,
                    data: series[x].data,
                    type: type
                });
            }

        }        
function setChartMultiSeries(name2, categories2, series2, color2, level2, type2) {
            chart2.xAxis[0].setCategories(categories2);
            for(x = 0; x < chart2.series2.length; x++)
            {
                chart2.series2[x].remove();
            }
            for(x = 0; x < chart2.series2.length; x++)
            {
                chart2.series2[x].remove();
            }      

            for(x = 0; x < series2.length; x++)
            {
                chart.addSeries({
                    color: series2[x].color,
                    name: series2[x].name,
                    level: level2,
                    data: series2[x].data,
                    type: type2
                });
            }

        }
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container3',
                type: 'column',
                backgroundColor: "#F7F7F7"
            },
            title: {
                text: username+"En Çok Kullanılan İlk 5 Program"
            },
            subtitle: {
                text: null
            },
            xAxis: {
                categories: categories,
				labels: {
				    formatter: function () {
					    var text = this.value,
						    formatted = text.length > 10 ? text.substring(0, 10) + '...' : text;

                        return '<div class="js-ellipse" style="width:150px; overflow:hidden" title="' + text + '">' + formatted + '</div>';
				    },
				    style: {
					    width: '150px'
				    },
				    useHTML: true
			}
            },
            yAxis: {
                title: {
                    text: 'Saniye Cinsinden'
                },
                min: 0
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                column: {
                    dataLabels: {
                        enabled: true,
                        color: colors[0],
                        style: {
                            fontWeight: 'bold'
                        },
                        formatter: function() {
                            if(this.y>3559){
							var saat = Math.round((this.y)/3600);	
							return saat+" saat";
							}
							if(this.y>59){
							var dakika = Math.round((this.y)/60);	
							return dakika+" dakika";
							}
							if(this.y<59){
							return this.y+" saniye";
							}
                        }
                    }
                }
            },
            tooltip: {
                formatter: function() {
                    var point = this.point,s;
						if(this.y>3559){ 
						var saat = Math.round((this.y)/3600); 
						return s = this.x +':<b>'+ saat +' saat</b><br/>';
						}
						if(this.y>59){ 
						var dakika = Math.round((this.y)/60); 
						return s = this.x +':<b>'+ dakika +' dakika</b><br/>';
						}
						if(this.y<59){ 
						var saniye = Math.round((this.y)); 
						return s = this.x +':<b>'+ saniye +' saniye</b><br/>';
						}
                    return s;
                }
            },
            series: [{
                name: name,
                level: level,
                data: data,
                color: 'white'}],
            	exporting: {
                enabled: true
            }
        });
		chart2 = new Highcharts.Chart({
            chart: {
                renderTo: 'container4',
                type: 'column',
                backgroundColor: "#F7F7F7"
            },
            title: {
                text: username+"En Çok Kullanılan İlk 5 Uygulama"
            },
            subtitle: {
                text: null
            },
            xAxis: {
                categories: categories2,
				labels: {
				    formatter: function () {
					    var text = this.value,
						    formatted = text.length > 10 ? text.substring(0, 10) + '...' : text;

                        return '<div class="js-ellipse" style="width:150px; overflow:hidden" title="' + text + '">' + formatted + '</div>';
				    },
				    style: {
					    width: '150px'
				    },
				    useHTML: true
			}
            },
            yAxis: {
                title: {
                    text: 'Saniye Cinsinden'
                },
                min: 0
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                column: {
                    dataLabels: {
                        enabled: true,
                        color: colors2[0],
                        style: {
                            fontWeight: 'bold'
                        },
                        formatter: function() {
                            if(this.y>3559){
							var saat = Math.round((this.y)/3600);	
							return saat+" saat";
							}
							if(this.y>59){
							var dakika = Math.round((this.y)/60);	
							return dakika+" dakika";
							}
							if(this.y<59){
							return this.y+" saniye";
							}
                        }
                    }
                }
            },
            tooltip: {
                formatter: function() {
                    var point = this.point,s;
                    if (point.drilldown) {
						if(this.y>3559){ 
						var saat = Math.round((this.y)/3600); 
						return s = this.x +':<b>'+ saat +' saat</b><br/>'+point.category +' detaylarını görmek için tıklayın';
						}
						if(this.y>59){ 
						var dakika = Math.round((this.y)/60); 
						return s = this.x +':<b>'+ dakika +' dakika</b><br/>'+point.category +' detaylarını görmek için tıklayın';
						}
						if(this.y<59){ 
						var saniye = Math.round((this.y)); 
						return s = this.x +':<b>'+ saniye +' saniye</b><br/>'+point.category +' detaylarını görmek için tıklayın';
						}
                    } else {
						if(this.y>3559){ 
						var saat = Math.round((this.y)/3600); 
						return s = this.x +':<b>'+ saat +' saat</b><br/>';
						}
						if(this.y>59){ 
						var dakika = Math.round((this.y)/60); 
						return s = this.x +':<b>'+ dakika +' dakika</b><br/>';
						}
						if(this.y<59){ 
						var saniye = Math.round((this.y)); 
						return s = this.x +':<b>'+ saniye +' saniye</b><br/>';
						}
                    }
                    return s;
                }
            },
            series: [{
                name: name2,
                level: level2,
                data: data2,
                color: 'white'}],
            	exporting: {
                enabled: true
            }
        });
    });
 });

</script>
<div class="row">
<div class="col-lg-6">
<div id="container3" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
</div>
<div class="col-lg-6">
<div id="container4" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
</div>
</div>
<?php 
}
?>
