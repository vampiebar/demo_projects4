<?php 
$screenport = $_GET["screenport"];
if($_GET){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$screenport.'&showerrorinxml=yes&link=screen_list?get_screen_settings';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
//echo $xml->screens->settings[0]->{'scd.screen_period'};
//$xml->get_screen_settings->settings[0]->scd.screen_period;
}else{
	header("location:home.php");
	}
?>
<script type="text/javascript">
$(".screenperiodday").change(function(){
	var port = $(".datetimehiddensrs").val();
	var screenperiodday = $(this).val();
	var screenperiodsecond = $(".screenperiodsecond").val();
	if(port!=""){
		$(".srsselect").fadeOut();
		$.ajax({
			type:"GET",
			url:"setscreenperiodday.php",
			data:"screenperiodday="+screenperiodday+"&port="+port,
			success:function(){
				$(".srswarning").hide();
				$(".settedday").text(screenperiodday);
				$(".settedsecond").text(screenperiodsecond);
				$(".srssuccess").fadeIn();
				}
			})	
		}else{
		$(".srsselect").fadeIn();	
			}
	});
$(".screenperiodsecond").change(function(){
	var port = $(".datetimehiddensrs").val();
	var screenperiodsecond = $(this).val();
	var screenperiodday = $(".screenperiodday").val();
	if(port!=""){
		$(".srsselect").fadeOut();
		$.ajax({
			type:"GET",
			url:"setscreenperiodsecond.php",
			data:"screenperiodsecond="+screenperiodsecond+"&port="+port,
			success:function(a){
				$(".settedday").text(screenperiodday);
				$(".settedsecond").text(screenperiodsecond);
				$(".srswarning").hide();
				$(".srssuccess").fadeIn();
				}
			})	
		}else{
		$(".srsselect").fadeIn();	
			}
	});
</script>
<div class="row">
<div class="alert alert-info srswarning">
	<p>Görüntüler şu anda <b><?php echo ($xml->get_screen_settings->settings[1]->{'scd.screen_record_period'})/86400;  ?></b> gün boyunca <b><?php echo $xml->get_screen_settings->settings[0]->{'scd.screen_period'}; ?></b> saniye aralıklarla kaydediliyor.</p>
</div>
<div class="alert alert-danger gizle srsselect"><p>Lütfen Bilgisayar Seçiniz.</p></div>
<div class="alert alert-success gizle srssuccess"><p>Görüntüler <b><span class="settedday"></span></b> gün boyunca <b><span class="settedsecond"></span></b> saniye aralıklarla kaydediliyor</p></div>
<div class="col-lg-12">
<input type="hidden" class="datetimehiddensrs" value="<?php echo $screenport; ?>" />
<form class="form-inline" role="form">
  <span>Görüntüler</span>
  <div class="form-group">
    <select class="form-control screenperiodday">
      <?php 
	  for($i=1;$i<101;$i++){
		  echo '<option value="'.$i.'">'.$i.'</option>';
		  }
	  ?>
    </select>
  </div>
  <span>gün boyunca</span>
  <div class="form-group">
    <select class="form-control screenperiodsecond">
      <?php 
	  for($i=1;$i<201;$i++){
		  echo '<option value="'.$i.'">'.$i.'</option>';
		  }
	  ?>
    </select>
  </div>
  <span>saniye aralıklarla kaydedilsin.</span>
</form>
<div class="onur"></div>
</div>
</div>