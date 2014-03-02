<?php
$port = $_GET["port"];
if($_GET){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=proc_list?list_limited';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
$count = 0;
?>

<table class="table table-striped">
	<thead>
    	<tr>
        	<th>Uygulama Adı:</th>
            <th>Limit Başlangıç:</th>
            <th>Limit Bitiş:</th>
            <th>Limit Süresi:</th>
            <th>Durum:</th>
        </tr>
    </thead>
    <tbody>
<?php
for($i=0;$i<count($xml->proc_limited_list);$i++){
?>
<?php if(trim($xml->proc_limited_list[$i]->proc_to_limit)==trim($xml->proc_limited_list[($i+1)]->proc_to_limit)){ $count++; ?>
<tr class="hiddentr gizli" id="tr<?php echo $xml->proc_limited_list[$i]->id;?>">
	<td style="display:none"><?php echo $xml->proc_limited_list[$i]->id;?></td>
    <?php if($count>0){ ?>
	<td>
	<?php echo $xml->proc_limited_list[$i]->proc_to_limit; ?>
    </td>
    <?php } ?>
    <?php }else{?>
    <tr class="nothiddentr" id="tr<?php echo $xml->proc_limited_list[$i]->id;?>">
	<td style="display:none"><?php echo $xml->proc_limited_list[$i]->id;?></td>
    <td><?php echo $xml->proc_limited_list[$i]->proc_to_limit."<span style=\"font-size:12px; cursor:pointer;\" class=\"label label-info pull-right gizlitr\">".($count+1)." gün</span>"; ?></td>
    <?php $count=0;} ?>
    <td><?php echo $xml->proc_limited_list[$i]->limit_start_time; ?></td>
    <td><?php echo $xml->proc_limited_list[$i]->limit_stop_time; ?></td>
    <td><?php if($xml->proc_limited_list[$i]->limit_weekday==1){ echo "Pazartesi"; }if($xml->proc_limited_list[$i]->limit_weekday==2){ echo "Salı"; }if($xml->proc_limited_list[$i]->limit_weekday==3){ echo "Çarşamba"; }if($xml->proc_limited_list[$i]->limit_weekday==4){ echo "Perşembe"; }if($xml->proc_limited_list[$i]->limit_weekday==5){ echo "Cuma"; }if($xml->proc_limited_list[$i]->limit_weekday==6){ echo "Cumartesi"; }if($xml->proc_limited_list[$i]->limit_weekday==0){ echo "Pazar"; } ?></td>
    <td style="width:160px;"><?php if($xml->proc_limited_list[$i]->proc_to_limit_status=="true"){?><button class="btn btn-danger blockbutton" data-toggle="modal" href="#informallow"><i class="icon-block"></i> Yasaklı</button><?php }else{?><button class="btn btn-success allowbutton" data-toggle="modal" href="#informblock"><i class="icon-check"></i> İzin Verildi</button><?php } ?></td>
</tr>
<?php
//}
	}
//echo $count;
//echo $xml->getdata;
?>
</tbody>
</table>
<div class="modal fade" id="informallow">
  <div class="modal-dialog" style="width:30%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-left">Uygulamaya İzin Ver</h4>
      </div>
      <div class="modal-body">
        <h4>Bu uygulamanın yasağını kaldırmak istediğinizden emin misiniz?</h4>
        <input type="hidden" class="appid" />
        <div class="alert alert-info gizle allowingurl">Uygulama yasağı kaldırılıyor...</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success allowapp">İzin Ver</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Vazgeç</button>
      </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="informblock">
  <div class="modal-dialog" style="width:30%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-left">Siteye İzin Ver</h4>
      </div>
      <div class="modal-body">
        <h4>Bu uygulamayı yasaklamak istediğinizden emin misiniz?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger">Yasakla</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Vazgeç</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
$(".addwsr").click(function(a){
	var val = $(".websiteadress").val();
	var starthour = $(".starthour").val();
	var startminute = $(".startminute").val();
	var endhour = $(".endhour").val();
	var endminute = $(".endminute").val();
	var days = $(".days").val();
	var url_limit_start = starthour+":"+startminute;
	var url_limit_end = endhour+":"+endminute;
	var gun;
	console.log(val+" "+days+" "+url_limit_start+" "+url_limit_end);
	if(val.length<1){
		$(".addresserror").fadeIn(700);
		return false;
	}else
	if(starthour==0){
		$(".addresserror").html("Lütfen Başlangıç Saatini Seçin.").fadeIn(700);
		}else
	if(startminute==0){
		$(".addresserror").html("Lütfen Başlangıç Dakikasını Seçin.").fadeIn(700);
		}else
	if(endhour==0){
		$(".addresserror").html("Lütfen Bitiş Saatini Seçin.").fadeIn(700);
		}else
	if(endminute==0){
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
			$.ajax({
				type:"GET",
				url:"blockurl.php",
				data:"port="+<?php echo $port; ?>+"&urladres="+val+"&url_limit_start="+url_limit_start+"&url_limit_end="+url_limit_end+"&url_limit_weekday="+days,
				success:function(){
					$(".restrictedwebsites table tbody").prepend('<tr><td>'+val+'</td><td>'+url_limit_start+'</td><td>'+url_limit_end+'</td><td>'+gun+'</td><td style="width:160px;"><button class="btn btn-danger blockbutton"><i class="icon-block"></i> Yasaklı</button></td>');
					$("#newwsr").modal('hide');
					}
				})
			}
	});
	$(".gizlitr").click(function(){
			$(this).parent().parent().prevUntil(".nothiddentr").toggleClass("gizli");
	});
	$(".blockbutton").click(function(){
		var id = $(this).parent().parent().find("td:eq(0)").text();
		$(".appid").val(id);
	})
	$(".allowapp").click(function(){
		var appid = $(".appid").val();
		$(this).addClass("disabled").attr("disabled","disabled");
		$(".allowingurl").show();
		$.ajax({
		type:"GET",
		url:"allowapp.php",
		data:"port="+<?php echo $port; ?>+"&appid="+appid,
		success:function(){
			$("#tr"+appid).fadeOut();
			$(".allowingurl").hide();
			$("#informallow").modal('hide');
			$(".allowapp").removeClass("disabled").removeAttr("disabled");
			}
		})
	})
</script> 
<?php }else{
	header("location:home.php");
	}
?>