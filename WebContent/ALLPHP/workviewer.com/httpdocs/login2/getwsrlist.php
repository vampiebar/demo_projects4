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
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=url_list?list_limited';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
$count = 0;
?>
<script type="text/javascript">
$(function(){
	var active_users = [];
	$(".screen").each(function(i,obj){
		var keydisk = $(this).find(".keydisk").val();
		var alias = $(this).find(".alias").attr("id");
		var screenport = $(this).find(".port").val();
		var filterport = $(this).find(".filterport").val();
		alias = alias.split("alias");
		alias = alias[1];
		alias = $("#renameinput"+alias).val();
		if(keydisk!=""){
			active_users.push({
			diskkey : keydisk, 
			useralias :alias,
			userscreenport:screenport,
			userfilterport:filterport 
		});
		}
		});
		var active_users_length = active_users.length;
		for(var i = 0;i<active_users_length;i++ ){
			$(".activecomputers").append('<div class="checkbox"><label><input type="checkbox" class="activecomputercheckbox" name="activeusers[]" value="'+active_users[i]["userfilterport"]+'">'+active_users[i]["useralias"]+'</label></div>');	
		}
		$(".chooseall").click(function(){
			var is_checked = $(this).attr("checked");
			if(is_checked=="checked"){
			$('.activecomputercheckbox').removeAttr('checked');
			$('.activecomputercheckbox').prop('checked', false);
			$(this).removeAttr("checked");
			}else{
			$('.activecomputercheckbox').attr('checked', "checked");
			$('.activecomputercheckbox').prop('checked', true);
			$(this).attr("checked","checked");
			}
			});
		$("body").on("click",".activecomputercheckbox",function(){
			var size = $(".activecomputercheckbox").size();
			var checkedsize = $("input[type=checkbox]:checked").not(".chooseall").size();
			if(size==checkedsize){
			$(".chooseall").attr('checked', "checked");
			$('.chooseall').prop('checked', true);	
			}else{
			$(".chooseall").removeAttr('checked');
			$('.chooseall').prop('checked', false);	
			}
			});
})
</script>
<button data-toggle="modal" href="#newwsr" class="text-left btn btn-info newwsr"><i class="icon-plus"></i> <?php echo $dil["addNewSite"] ?></button>
<!-- <button data-toggle="modal" href="#newwsr" class="text-left btn btn-danger blockall"><i class="icon-block"></i> Tümünü Yasakla</button>
<button data-toggle="modal" href="#newwsr" class="text-left btn btn-success allowall"><i class="icon-check"></i> Tümüne İzin Ver</button>-->
<table class="table table-striped">
	<thead>
    	<tr>
        	<th><?php echo $dil["webSiteName"]; ?></th>
            <th><?php echo $dil["limit_start"]; ?></th>
            <th><?php echo $dil["limit_end"]; ?></th>
            <th><?php echo $dil["limit_time"]; ?></th>
            <th><?php echo $dil["limit_status"]; ?></th>
        </tr>
    </thead>
    <tbody>
<?php
for($i=0;$i<count($xml->url_limited_list);$i++){
	//echo strlen($xml->url_limited_list[11]->url_to_limit)." ve ".strlen($xml->url_limited_list[12]->url_to_limit);
?>
<?php if(trim($xml->url_limited_list[$i]->url_to_limit)==trim($xml->url_limited_list[($i+1)]->url_to_limit)){ $count++; ?>
<tr class="hiddentr gizli" id="tr<?php echo $xml->url_limited_list[$i]->id;?>">
	<td style="display:none"><?php echo $xml->url_limited_list[$i]->id;?></td>
    <?php if($count>0){ ?>
	<td>
	<?php echo $xml->url_limited_list[$i]->url_to_limit; ?>
    </td>
    <?php } ?>
    <?php }else{?>
    <tr class="nothiddentr" id="tr<?php echo $xml->url_limited_list[$i]->id;?>">
	<td style="display:none"><?php echo $xml->url_limited_list[$i]->id;?></td>
    <td><?php if($xml->url_limited_list[$i]->limit_weekday!=8){echo $xml->url_limited_list[$i]->url_to_limit."<span style=\"font-size:12px; cursor:pointer;\" class=\"label label-info pull-right gizlitr\">".($count+1)." gün</span>"; } else{ echo $xml->url_limited_list[$i]->url_to_limit;} ?></td>
    <?php $count=0;} ?>
    <td><?php echo $xml->url_limited_list[$i]->limit_start_time; ?></td>
    <td><?php echo $xml->url_limited_list[$i]->limit_stop_time; ?></td>
    <td><?php if($xml->url_limited_list[$i]->limit_weekday==0){ echo "Pazar"; }if($xml->url_limited_list[$i]->limit_weekday==1){ echo "Pazartesi"; }if($xml->url_limited_list[$i]->limit_weekday==2){ echo "Salı"; }if($xml->url_limited_list[$i]->limit_weekday==3){ echo "Çarşamba"; }if($xml->url_limited_list[$i]->limit_weekday==4){ echo "Perşembe"; }if($xml->url_limited_list[$i]->limit_weekday==5){ echo "Cuma"; } if($xml->url_limited_list[$i]->limit_weekday==5){ echo "Cumartesi"; }if($xml->url_limited_list[$i]->limit_weekday==8){ echo "Her zaman"; } ?></td>
    <td style="width:160px;"><?php if($xml->url_limited_list[$i]->url_to_limit_status=="true"){?><button class="btn btn-danger blockbutton" data-toggle="modal" href="#informallow"><i class="icon-block"></i> <?php echo $dil["blocked"] ?></button><?php }else{?><button class="btn btn-success allowbutton" data-toggle="modal" href="#informblock"><i class="icon-check"></i> <?php echo $dil["allowed"] ?></button><?php } ?></td>
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
        <h4 class="modal-title text-left"><?php echo $dil["addNewSite"]; ?></h4>
      </div>
      <div class="modal-body">
       <div class="input-group">
          <span class="input-group-addon">http://www.</span>
          <input type="text" class="form-control websiteadress" placeholder="<?php echo $dil["web_address_format"]; ?>">
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
             	<option value="8"><?php if($_SESSION["logindil"]=="en"){ echo "Always"; } else { echo "Her zaman"; }?></option>
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
             <div class="form-group">
             <label class="col-lg-4 control-label">Uygulanacak Bilgisayarlar</label>
             <div class="col-lg-8">
             <div class="col-lg-12">
             <div class="activecomputers">
             <div class="checkbox">
              <label>
                <input type="checkbox" class="chooseall" value="">
                Tümünü Seç
              </label>
            </div>
             </div>
             </div>
             </div>
             </div>
        </form>
        <div class="row" style="margin-top:20px;">
        <div class="alert alert-danger gizle addresserror"><?php echo $dil["please_enter_site_address"]; ?></div>
        <div class="alert alert-info gizle addressinfo"><?php echo $dil["site_blocking"]; ?></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default addwsr"><?php echo $dil["addSite"]; ?></button>
        <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $dil["ignore"]; ?></button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="informallow">
  <div class="modal-dialog" style="width:30%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-left"><?php echo $dil["allow_site"]; ?></h4>
      </div>
      <div class="modal-body">
        <h4><?php echo $dil["areyousureallowsite"]; ?></h4>
        <input type="hidden" class="siteid" />
        <div class="alert alert-info gizle allowingurl"><?php echo $dil["site_block_removing"]; ?></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success allowsite"><?php echo $dil["allow"]; ?></button>
        <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $dil["ignore"]; ?></button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="informblock">
  <div class="modal-dialog" style="width:30%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-left"><?php echo $dil["block_site"]; ?></h4>
      </div>
      <div class="modal-body">
        <h4><?php echo $dil["areyousureblocksite"]; ?></h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success"><?php echo $dil["blockit"]; ?></button>
        <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $dil["ignore"]; ?></button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
$(".addwsr").removeClass("disabled").removeAttr("disabled");
$(".addwsr").click(function(a){
	var filterports = new Array();
	var val = $(".websiteadress").val();
	var starthour = $(".starthour").val();
	var startminute = $(".startminute").val();
	var endhour = $(".endhour").val();
	var endminute = $(".endminute").val();
	var days = $(".days").val();
	var url_limit_start = starthour+":"+startminute;
	var url_limit_end = endhour+":"+endminute;
	var gun;
	$('.activecomputercheckbox:checked').each(function(i) {
		var filterportvalue = $(this).val();
		filterports.push(filterportvalue);
	});
	if(val.length<1){
		$(".addresserror").fadeIn(700);
		return false;
	}else
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
		$(".addwsr").addClass("disabled").attr("disabled","disabled");
			$.ajax({
				type:"GET",
				url:"blockurl.php",
				data:"port="+filterports+"&urladres="+val+"&url_limit_start="+url_limit_start+"&url_limit_end="+url_limit_end+"&url_limit_weekday="+days,
				success:function(b){
					console.log(b);
					$("#newwsr").modal('hide');
					$(".modal-backdrop").hide();
					$(".restrictedwebsites").html('<i style="font-size:50px; color:#0477bd; margin-top:30px; display:inline-block" class="icon-spin2 animate-spin"></i><p style="margin-top:10px;"><?php echo $dil["web_site_list_retrieving"]; ?></p>');
									$(".restrictedwebsitescount").html('<i class="icon-spin2 animate-spin"></i>');
									$.ajax({
									method:"GET",
									url: "getwsrlist.php",
									data: "port="+<?php echo $port; ?>,
									async: true,
									cache:false,
									success: function(proclist){
									if(!proclist){
									$(".restrictedwebsites").html('<?php echo $dil["list_error"]; ?>');	
									}else{
									if(proclist=="-2"){
									/* Portu Resetle*/
									/*$.get("resetctrlport.php",{key:keydisk},function(image){
										console.log("Port Resetlendi.");	
									});
									*/
									$(".restrictedwebsites").html("Port Canlı Değil");
									}else{
									$(".restrictedwebsites").html(proclist);
									$(".blockbutton").hover(function(){
										$(this).removeClass("btn-danger").addClass("btn-success").html('<i class="icon-check"></i> <?php echo $dil["allow"]; ?>');
										},function(){
										$(this).removeClass("btn-success").addClass("btn-danger").html('<i class="icon-block"></i> <?php echo $dil["blocked"]; ?>');	
										})
									$(".allowbutton").hover(function(){
										$(this).removeClass("btn-success").addClass("btn-danger").html('<i class="icon-block"></i> <?php echo $dil["blockit"]; ?>');
										},function(){
										$(this).removeClass("btn-danger").addClass("btn-success").html('<i class="icon-check"></i> <?php echo $dil["allowed"]; ?>');	
										})
									}
									var size = $("restrictedwebsites table tbody tr").size();
									$(".restrictedwebsitescount").text(size);
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
		url:"allowurl.php",
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