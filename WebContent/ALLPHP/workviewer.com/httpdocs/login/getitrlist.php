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
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=net_list?list_net_run_limit';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
$count = 0;
?>
<button data-toggle="modal" href="#newwsr" class="text-left btn btn-info newwsr"><i class="icon-plus"></i> <?php echo $dil["new_itr"] ?></button>
<table class="table table-striped">
	<thead>
    	<tr>
        	<th><?php echo $dil["pctime_rule_desc"] ?></th>
            <th><?php echo $dil["limit_start"] ?></th>
            <th><?php echo $dil["limit_end"] ?></th>
            <th><?php echo $dil["limit_time"] ?></th>
            <th><?php echo $dil["limit_status"] ?></th>
        </tr>
    </thead>
    <tbody>
<?php
for($i=0;$i<count($xml->net_run_limited_list);$i++){
	//echo strlen($xml->net_run_limited_list[11]->net_run_limit_desc)." ve ".strlen($xml->net_run_limited_list[12]->net_run_limit_desc);
?>
<?php if(trim($xml->net_run_limited_list[$i]->net_run_limit_desc)==trim($xml->net_run_limited_list[($i+1)]->net_run_limit_desc)){ $count++; ?>
<tr class="hiddentr gizli" id="tr<?php echo $xml->net_run_limited_list[$i]->id;?>">
	<td style="display:none"><?php echo $xml->net_run_limited_list[$i]->id;?></td>
    <?php if($count>0){ ?>
	<td>
	<?php echo $xml->net_run_limited_list[$i]->net_run_limit_desc; ?>
    </td>
    <?php } ?>
    <?php }else{?>
    <tr class="nothiddentr" id="tr<?php echo $xml->net_run_limited_list[$i]->id;?>">
	<td style="display:none"><?php echo $xml->net_run_limited_list[$i]->id;?></td>
    <td><?php if($xml->net_run_limited_list[$i]->limit_weekday!=8){ echo $xml->net_run_limited_list[$i]->net_run_limit_desc."<span style=\"font-size:12px; cursor:pointer;\" class=\"label label-info pull-right gizlitr\">".($count+1)." gün</span>"; }else{ echo $xml->net_run_limited_list[$i]->net_run_limit_desc;} ?></td>
    <?php $count=0;} ?>
    <td><?php echo $xml->net_run_limited_list[$i]->limit_start_time; ?></td>
    <td><?php echo $xml->net_run_limited_list[$i]->limit_stop_time; ?></td>
    <td><?php if($xml->net_run_limited_list[$i]->limit_weekday==1){ echo "Pazartesi"; }if($xml->net_run_limited_list[$i]->limit_weekday==2){ echo "Salı"; }if($xml->net_run_limited_list[$i]->limit_weekday==3){ echo "Çarşamba"; }if($xml->net_run_limited_list[$i]->limit_weekday==4){ echo "Perşembe"; }if($xml->net_run_limited_list[$i]->limit_weekday==5){ echo "Cuma"; }if($xml->net_run_limited_list[$i]->limit_weekday==6){ echo "Cumartesi"; }if($xml->net_run_limited_list[$i]->limit_weekday==0){ echo "Pazar"; }if($xml->net_run_limited_list[$i]->limit_weekday==8){ echo "Her Zaman"; } ?></td>
    <td style="width:160px;"><?php if($xml->net_run_limited_list[$i]->proc_to_limit_status=="true"){?><button class="btn btn-danger blockbutton" data-toggle="modal" href="#informallow"><i class="icon-block"></i> Yasaklı</button><?php }else{?><button class="btn btn-success allowbutton" data-toggle="modal" href="#informblock"><i class="icon-check"></i> İzin Verildi</button><?php } ?></td>
</tr>
<?php
//}
	}
//echo $count;
//echo $xml->getdata;
?>
</tbody>
</table>
<div class="modal fade" id="newwsr">
  <div class="modal-dialog" style="width:30%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-left"><?php echo $dil["new_itr"] ?></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" style="margin-top:10px;">
        <div class="form-group">
            <label class="col-lg-4 control-label"><?php echo $dil["pctime_rule_desc"] ?></label>
            <div class="col-lg-8">
            <div class="col-lg-12">
                  <input type="text" class="form-control desc" placeholder="<?php echo $dil["pctime_rule_desc"] ?>">
            </div>
            </div>
        </div>
          <div class="form-group">
            <label class="col-lg-4 control-label"><?php echo $dil["startTime"] ?></label>
            <div class="col-lg-8">
            <div class="col-lg-6">
                  <select class="form-control starthour">
                  <option value="saat"><?php echo $dil["hour"] ?></option>
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
                <option value="dakika"><?php echo $dil["minute"] ?></option>
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
            <label class="col-lg-4 control-label"><?php echo $dil["endTime"] ?></label>
            <div class="col-lg-8">
            <div class="col-lg-6">
                 <select class="form-control endhour">
                 <option value="saat2"><?php echo $dil["hour"] ?></option>
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
                <option value="dakika2"><?php echo $dil["minute"] ?></option>
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
             <label class="col-lg-4 control-label"><?php echo $dil["days"] ?></label>
             <div class="col-lg-8">
             <div class="col-lg-12">
             <select multiple  class="form-control days" style="min-height:150px;">
             	<option value="8"><?php if($_SESSION["logindil"]=="en"){ echo "Always"; } else { echo "Her Zaman"; }?></option>
                <option value="1"><?php if($_SESSION["logindil"]=="en"){ echo "Monday"; } else { echo "Pazartesi"; } ?></option>
                <option value="2"><?php if($_SESSION["logindil"]=="en"){ echo "Tuesday"; } else { echo "Salı"; }?></option> 
                <option value="3"><?php if($_SESSION["logindil"]=="en"){ echo "Wednesday"; } else { echo "Çarşamba"; }?></option> 
                <option value="4"><?php if($_SESSION["logindil"]=="en"){ echo "Thursday"; } else { echo "Perşembe"; }?></option> 
                <option value="5"><?php if($_SESSION["logindil"]=="en"){ echo "Friday"; } else { echo "Cuma"; }?></option> 
                <option value="6"><?php if($_SESSION["logindil"]=="en"){ echo "Saturday"; } else { echo "Cumartesi"; }?></option> 
                <option value="0"><?php if($_SESSION["logindil"]=="en"){ echo "Sunday"; } else { echo "Pazar"; }?></option>  
             </select>
             </div>
             </div>
             </div>
        </form>
        <div class="row" style="margin-top:20px;">
        <div class="alert alert-danger gizle addresserror"><?php echo $dil["pls_enter_rule_desc"] ?></div>
        <div class="alert alert-info gizle addressinfo"><?php echo $dil["rule_is_being_applied"] ?></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default addwsr"><?php echo $dil["addRule"] ?></button>
        <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $dil["ignore"] ?></button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="informallow">
  <div class="modal-dialog" style="width:30%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-left"><?php echo $dil["ignoreRule"] ?></h4>
      </div>
      <div class="modal-body">
        <h4><?php echo $dil["areyousureremoverule"] ?></h4>
        <input type="hidden" class="siteid" />
        <input type="hidden" class="sitedesc" />
        <div class="alert alert-info gizle allowingurl"><?php echo $dil["rule_is_being_removed"] ?></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success allowsite"><?php echo $dil["allow"] ?></button>
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
        <h4 class="modal-title text-left">Siteyi Yasakla</h4>
      </div>
      <div class="modal-body">
        <h4>Bu siteyi yasaklamak istediğinizden emin misiniz?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success">İzin Ver</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Vazgeç</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
$(".addwsr").removeClass("disabled").removeAttr("disabled");
$(".addwsr").click(function(a){
	var val = $(".desc").val();
	var starthour = $(".starthour").val();
	var startminute = $(".startminute").val();
	var endhour = $(".endhour").val();
	var endminute = $(".endminute").val();
	var days = $(".days").val();
	var url_limit_start = starthour+":"+startminute;
	var url_limit_end = endhour+":"+endminute;
	var gun;
	if(val.length<1){
		$(".addresserror").html("<?php echo $dil["pls_enter_rule_desc"] ?>").fadeIn(700);
		return false;
	}else
	if(starthour=="saat"){
		$(".addresserror").html("<?php echo $dil["pls_choose_s_t_h"] ?>").fadeIn(700);
		}else
	if(startminute=="dakika"){
		$(".addresserror").html("<?php echo $dil["pls_choose_s_t_m"] ?>").fadeIn(700);
		}else
	if(endhour=="saat2"){
		$(".addresserror").html("<?php echo $dil["pls_choose_e_t_h"] ?>").fadeIn(700);
		}else
	if(endminute=="dakika2"){
		$(".addresserror").html("<?php echo $dil["pls_choose_e_t_m"] ?>").fadeIn(700);
		}else
	if(days==null || days ==9){
		$(".addresserror").html("<?php echo $dil["pls_choose_days"] ?>").fadeIn(700);
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
				url:"blockinternettime.php",
				data:"port="+<?php echo $port; ?>+"&desc="+val+"&url_limit_start="+url_limit_start+"&url_limit_end="+url_limit_end+"&url_limit_weekday="+days,
				success:function(){
					$("#newwsr").modal('hide');
					$(".modal-backdrop").hide();
					$(".restrictedtimes").html('<i style="font-size:50px; color:#0477bd; margin-top:30px; display:inline-block" class="icon-spin2 animate-spin"></i><p style="margin-top:10px;"><?php echo $dil["pls_wait_while_itr_list"] ?></p>');
									$(".restrictedwebsitescount").html('<i class="icon-spin2 animate-spin"></i>');
									$.ajax({
									method:"GET",
									url: "getitrlist.php",
									data: "port="+<?php echo $port; ?>,
									async: true,
									cache:false,
									success: function(proclist){
									if(!proclist){
									$(".restrictedtimes").html('<?php echo $dil["list_error"] ?>');	
									}else{
									if(proclist=="-2"){
									/* Portu Resetle*/
									/*$.get("resetctrlport.php",{key:keydisk},function(image){
										console.log("Port Resetlendi.");	
									});
									*/
									$(".restrictedtimes").html("Port Canlı Değil");
									}else{
									$(".restrictedtimes").html(proclist);
									$(".blockbutton").hover(function(){
										$(this).removeClass("btn-danger").addClass("btn-success").html('<i class="icon-check"></i> <?php echo $dil["allow"] ?>');
										},function(){
										$(this).removeClass("btn-success").addClass("btn-danger").html('<i class="icon-block"></i> <?php echo $dil["blocked"] ?>');	
										})
									$(".allowbutton").hover(function(){
										$(this).removeClass("btn-success").addClass("btn-danger").html('<i class="icon-block"></i> <?php echo $dil["blockit"] ?>');
										},function(){
										$(this).removeClass("btn-danger").addClass("btn-success").html('<i class="icon-check"></i> <?php echo $dil["allowed"] ?>');	
										})
									}
									var size = $("restrictedtimes table tbody tr").size();
									$(".restrictedtimescount").text(size);
									}
									}
									});
					/*$(".restrictedwebsites table tbody").prepend('<tr><td>'+val+'</td><td>'+url_limit_start+'</td><td>'+url_limit_end+'</td><td>'+gun+'</td><td style="width:160px;"><button class="btn btn-danger blockbutton"><i class="icon-block"></i> Yasaklı</button></td>');
					*/
					}
				})
			}
	});
	$(".gizlitr").click(function(){
			$(this).parent().parent().prevUntil(".nothiddentr").toggleClass("gizli");
	});
	$(".blockbutton").click(function(){
		var id = $(this).parent().parent().find("td:eq(0)").text();
		$(".siteid").val(id);
	})
	$(".allowsite").click(function(){
		var siteid = $(".siteid").val();
		$(this).addClass("disabled").attr("disabled","disabled");
		$(".allowingurl").show();
		$.ajax({
		type:"GET",
		url:"allowinternettime.php",
		data:"port="+<?php echo $port; ?>+"&siteid="+siteid,
		success:function(){
			$("#tr"+siteid).fadeOut();
			$(".allowingurl").hide();
			$("#informallow").modal('hide');
			$(".allowsite").removeClass("disabled").removeAttr("disabled");
			}
		})
	})
</script>
<?php }else{
	header("location:home.php");
	}
?>
