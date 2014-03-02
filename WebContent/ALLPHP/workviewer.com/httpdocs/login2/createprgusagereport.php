<?php
$screenport = $_GET["screenport"];
$baslangic = $_GET["baslangic"];
$bitis = $_GET["bitis"];
$baslangic = strtotime($baslangic);
$bitis = strtotime($bitis);
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
for($i=0;$i<count($xml["fetch_data"]["table_to_xml"]["window_text_log"]["row"]);$i++){
	$date = $xml["fetch_data"]["table_to_xml"]["window_text_log"]["row"][$i]["data_datetime"];
	$timestamp = strtotime($date);
	//echo $timestamp."<br>";
	$newarray["paths"][] = $xml["fetch_data"]["table_to_xml"]["window_text_log"]["row"][$i]["window_prg_path"];
	$newarray["seconds"][] = $xml["fetch_data"]["table_to_xml"]["window_text_log"]["row"][$i]["window_text_count"];
	if($timestamp>=$baslangic && $timestamp<=$bitis){
	$toplam = $newarray["seconds"][$i] + $arraypathpathcount[$newarray["paths"][$i]];
	$arraypathpathcount[$newarray["paths"][$i]] = $toplam;
	}
}
arsort($arraypathpathcount);
$arraysize = count($arraypathpathcount);
?>
<script type="text/javascript">
$(function() {
	var username = $(".computernamehere").text();
    var chart;
    $(document).ready(function() {
        var colors = Highcharts.getOptions().colors,
            categories = [<?php 
						$count = 0;
						foreach(array_keys($arraypathpathcount) as $key){
							$slashcount = substr_count($key,"\\");
							$appname = explode("\\",$key);
							if($arraypathpathcount>60){
							if($count==($arraysize-1)){
							echo "'".$appname[$slashcount]."'";
							}else{
								echo "'".$appname[$slashcount]."'".",";	
								}
							}
							$count++;
							} 
						?>],
            name = 'Programlar',
            level = 0,
            data = [
			<?php $count2 = 0; foreach($arraypathpathcount as $key=>$value){
			if($arraypathpathcount[$key]>60){
			?>
			{
                y: <?php echo $arraypathpathcount[$key]; ?>,
                color: colors[<?php echo $count2; ?>],
			}
				<?php 
				if($count2==($arraysize-1)){
				}else{
					echo ",";	
					}
				?>
				<?php 
				$count2++;
			}
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

        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container3',
                type: 'column',
                backgroundColor: "#F7F7F7"
            },
            title: {
                text: username+"Program Kullanım Raporu"
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
						return s = this.x +':<b>'+ saat +' saat</b>';
						}
						if(this.y>59){ 
						var dakika = Math.round((this.y)/60); 
						return s = this.x +':<b>'+ dakika +' dakika</b>';
						}
						if(this.y<59){ 
						var saniye = Math.round((this.y)); 
						return s = this.x +':<b>'+ saniye +' saniye</b>';
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
                enabled: false
            }
        });
    });
 });

</script>
<div id="container3" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
<?php 
}
?>