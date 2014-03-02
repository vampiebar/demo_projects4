<?php
session_start();
if(!@$_SESSION["logindil"]){
	@$_SESSION["logindil"]="tr";
	require("dil/tr.php");
}else{
	require("dil/".$_SESSION["logindil"].".php");
}
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
        	<th><?php echo $dil["appName"] ?></th>
            <th><?php echo $dil["limit_start"] ?></th>
            <th><?php echo $dil["limit_end"] ?></th>
            <th><?php echo $dil["limit_time"] ?></th>
            <th><?php echo $dil["limit_status"] ?></th>
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
    <td><?php if($xml->proc_limited_list[$i]->limit_weekday!=8){echo $xml->proc_limited_list[$i]->proc_to_limit."<span style=\"font-size:12px; cursor:pointer;\" class=\"label label-info pull-right gizlitr\">".($count+1)." gün</span>"; }else{ echo $xml->proc_limited_list[$i]->proc_to_limit;} ?></td>
    <?php $count=0;} ?>
    <td><?php echo $xml->proc_limited_list[$i]->limit_start_time; ?></td>
    <td><?php echo $xml->proc_limited_list[$i]->limit_stop_time; ?></td>
    <td><?php if($xml->proc_limited_list[$i]->limit_weekday==0){ echo "Pazar"; } if($xml->proc_limited_list[$i]->limit_weekday==1){ echo "Pazartesi"; }if($xml->proc_limited_list[$i]->limit_weekday==2){ echo "Salı"; }if($xml->proc_limited_list[$i]->limit_weekday==3){ echo "Çarşamba"; }if($xml->proc_limited_list[$i]->limit_weekday==4){ echo "Perşembe"; }if($xml->proc_limited_list[$i]->limit_weekday==5){ echo "Cuma"; }if($xml->proc_limited_list[$i]->limit_weekday==6){ echo "Cumartesi"; }if($xml->proc_limited_list[$i]->limit_weekday==8){ echo "Her zaman"; } ?></td>
    <td style="width:160px;"><?php if($xml->proc_limited_list[$i]->proc_to_limit_status=="true"){?><button class="btn btn-danger blockbutton" data-toggle="modal" href="#informallow"><i class="icon-block"></i> <?php echo $dil["blocked"] ?></button><?php }else{?><button class="btn btn-success allowbutton" data-toggle="modal" href="#informblock"><i class="icon-check"></i> <?php echo $dil["allowed"] ?></button><?php } ?></td>
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
        <h4 class="modal-title text-left"><?php echo $dil["allowapp"] ?></h4>
      </div>
      <div class="modal-body">
        <h4><?php echo $dil["areyousureremoveapprest"] ?></h4>
        <input type="hidden" class="appid" />
        <div class="alert alert-info gizle allowingurl"><?php echo $dil["removingapprest"] ?></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success allowapp"><?php echo $dil["allow"] ?></button>
        <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $dil["ignore"] ?></button>
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
		$(".addresserror").html("<?php echo $dil["pls_choose_s_t_h"]; ?>").fadeIn(700);
		}else
	if(startminute=="dakika"){
		$(".addresserror").html("<?php echo $dil["pls_choose_s_t_m"]; ?>").fadeIn(700);
		}else
	if(endhour=="saat2"){
		$(".addresserror").html("<?php echo $dil["pls_choose_e_t_h"]; ?>").fadeIn(700);
		}else
	if(endminute=="dakika2"){
		$(".addresserror").html("<?php echo $dil["pls_choose_e_t_m"]; ?>").fadeIn(700);
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
			$.ajax({
				type:"GET",
				url:"blockurl.php",
				data:"port="+<?php echo $port; ?>+"&urladres="+val+"&url_limit_start="+url_limit_start+"&url_limit_end="+url_limit_end+"&url_limit_weekday="+days,
				success:function(){
					$(".restrictedwebsites table tbody").prepend('<tr><td>'+val+'</td><td>'+url_limit_start+'</td><td>'+url_limit_end+'</td><td>'+gun+'</td><td style="width:160px;"><button class="btn btn-danger blockbutton"><i class="icon-block"></i> <?php echo $dil["blocked"]; ?></button></td>');
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