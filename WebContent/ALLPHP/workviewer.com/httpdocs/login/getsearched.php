<?php
session_start();
if(!@$_SESSION["logindil"]){
	@$_SESSION["logindil"]="tr";
	require("dil/tr.php");
}else{
	require("dil/".$_SESSION["logindil"].".php");
}
$port = $_GET["port"];
$path = $_GET["path"];
$karakter = array("ü","Ü","ö","Ö","ı","ğ","Ğ","ş","Ş","ç","Ç"," ","/",":");
$degistir = array("%FC","%DC","%F6","%D6","%FD","%F0","%D0","%FE","%DE","%E7","%C7","+","%2F","%3A");
$path = str_replace($karakter,$degistir,$path);
//$path = str_replace(" ","+",$path);
$path = urlencode($path);
$suffix = $_GET["suffix"];
if($_GET){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=proc_list?find_files___path='.$path.'___suffix='.$suffix.'';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
?>
<table class="table table-striped">
	<thead>
    	<tr>
        	<th style="display:none;"></th>
        	<th><?php echo $dil["appName"] ?></th>
            <th><?php echo $dil["appPath"] ?></th>
            <th><?php echo $dil["process"] ?></th>
        </tr>
    </thead>
    <tbody>
<?php
foreach($xml->find_files as $client){
$slashcount = substr_count($client->file_path,"/");
$appname = explode("/",$client->file_path);
?>
<tr>
	<td style="display:none;"><?php echo $appname[$slashcount];?></td>
	<td><?php if (strlen($client->file_desc)<2){ echo "<span style=\"color:#f00\">Uygulama Adı Bulunmuyor</span>"; }else{ echo $client->file_desc;} ?></td>
    <td style="max-width:500px;word-wrap:break-word;"><?php echo $client->file_path; ?></td>
    <td><button class="btn btn-danger blockbutton" data-toggle="modal" href="#newar" style="margin-right:4px;"><i class="icon-block"></i> <?php echo $dil["blockit"] ?></button></td>
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
        <h4 class="modal-title text-left"><?php echo $dil["addNewApplication"] ?></h4>
      </div>
      <div class="modal-body">
      <div class="alert alert-info">
      <div style="display:none;">
      	<span class="fullpath"></span>
        <span class="filedesc"></span>
      </div>
      <p><?php echo $dil["avoidToAddApplication"] ?></p>
      </div>
        <form class="form-horizontal" style="margin-top:10px;">
          <div class="form-group">
            <label class="col-lg-4 control-label"><?php echo $dil["startTime"] ?></label>
            <div class="col-lg-8">
            <div class="col-lg-6">
                  <select class="form-control starthour">
                  <option value="0"><?php echo $dil["hour"] ?></option>
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
                <option value="0"><?php echo $dil["minute"] ?></option>
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
                 <option value="0"><?php echo $dil["hour"] ?></option>
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
                <option value="0"><?php echo $dil["minute"] ?></option>
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
             <select multiple  class="form-control days">
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
        </form>
        <div class="row" style="margin-top:20px;">
        <div class="alert alert-danger gizle addresserror"><?php echo $dil["appBlocking"] ?></div>
        <div class="alert alert-info gizle addressinfo"><?php echo $dil["appBlocking"] ?></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info addwsr"><?php echo $dil["addApp"] ?></button>
        <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $dil["ignore"] ?></button>
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
	$(".addresserror").html("<?php echo $dil["pls_choose_s_t_h"]; ?>").fadeIn(700);
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
				url:"blockapplication.php",
				data:"port="+<?php echo $port; ?>+"&proc_limit="+proc_limit+"&proc_limit_start="+proc_limit_start+"&proc_limit_end="+proc_limit_end+"&proc_limit_weekday="+days+"&proc_limit_full_path="+proc_limit_full_path+"&proc_limit_file_desc="+proc_limit_file_desc,
				success:function(cevap){
					$("#newar").modal('hide');
					$(".modal-backdrop").hide();
					$(".restrictedapplications").html('<i style="font-size:50px; color:#0477bd; margin-top:30px; display:inline-block" class="icon-spin2 animate-spin"></i><p style="margin-top:10px;"><?php echo $dil["plsWaitWhileApplicationList"]; ?></p>');
									$(".restrictedapplicationscount").html('<i class="icon-spin2 animate-spin"></i>');
									$.ajax({
									method:"GET",
									url: "getarlist.php",
									data: "port="+<?php echo $port; ?>,
									async: true,
									cache:false,
									success: function(proclist){
									if(!proclist){
									$(".restrictedapplications").html('<?php echo $dil["list_error"]; ?>');	
									}else{
									if(proclist=="-2"){
									/* Portu Resetle*/
									/*$.get("resetctrlport.php",{key:keydisk},function(image){
										console.log("Port Resetlendi.");	
									});
									*/
									$(".restrictedapplications").html("Port Canlı Değil");
									}else{
									$(".restrictedapplications").html(proclist);
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
									var size = $("restrictedapplications table tbody tr").size();
									$(".restrictedapplicationscount").text(size);
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

