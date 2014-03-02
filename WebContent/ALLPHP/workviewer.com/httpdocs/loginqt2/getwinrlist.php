<?php
$port =$_GET["port"]; 
$array=array("NoSetTaskbar","NoPropertiesMyComputer","NoFolderOptions","NoControlPanel","DisableTaskMgr","NoRun","NoClose","StartMenuLogOff","NoViewOnDrive");
for($i=0;$i<count($array);$i++){
$url[$i]='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=proc_list?get_windows_limit=zzz'.$array[$i].'';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url[$i]);
$data = curl_exec($ch);
curl_close($ch);
$xml[$i] = simplexml_load_string($data);
if($array[$i]=="NoSetTaskbar"){
?>
<div class="row" style="margin-bottom:10px;">
<div class="col-lg-6">
<div class="input-group <?php if(substr(trim($xml[$i]->value),-1)==1){echo "has-success";}else{ echo "has-error";} ?>">
  <span class="input-group-addon">
    <input type="checkbox" class="rule" data-toggle="modal" href="<?php if(substr(trim($xml[$i]->value),-1)==1){echo "#cancelrule";}else{ echo "#sorbakalim";}  ?>" value="NoSetTaskbar" <?php if(substr(trim($xml[$i]->value),-1)==1){echo "checked";}  ?>>
  </span>
  <input type="text" class="form-control disabled" disabled="disabled" value="Taskbar'ın özelliklerini değiştirmeyi engelle">
</div><!-- /input-group -->
</div><!-- /.col-lg-6 -->
<?php
	}
?>
<?php
if($array[$i]=="NoPropertiesMyComputer"){
?>
<div class="col-lg-6">
<div class="input-group <?php if(substr(trim($xml[$i]->value),-1)==1){echo "has-success";}else{ echo "has-error";} ?>">
  <span class="input-group-addon">
  <input type="checkbox" class="rule" data-toggle="modal" href="<?php if(substr(trim($xml[$i]->value),-1)==1){echo "#cancelrule";}else{ echo "#sorbakalim";}  ?>" value="NoPropertiesMyComputer" <?php if(substr(trim($xml[$i]->value),-1)==1){echo "checked";}  ?>>
  </span>
  <input type="text" class="form-control disabled" disabled="disabled" value="Bilgisayarım özelliklerine girmeyi engelle">
</div><!-- /input-group -->
</div><!-- /.col-lg-6 -->
</div>
<?php
	}
?>
<?php
if($array[$i]=="NoFolderOptions"){
?>
<div class="row" style="margin-bottom:10px;">
<div class="col-lg-6">
    <div class="input-group <?php if(substr(trim($xml[$i]->value),-1)==1){echo "has-success";}else{ echo "has-error";} ?>">
    <span class="input-group-addon">
    <input type="checkbox" class="rule" data-toggle="modal" href="<?php if(substr(trim($xml[$i]->value),-1)==1){echo "#cancelrule";}else{ echo "#sorbakalim";}  ?>" value="NoFolderOptions" <?php if(substr(trim($xml[$i]->value),-1)==1){echo "checked";}  ?>>
    </span>
    <input type="text" class="form-control disabled" disabled="disabled" value="Klasör özelliklerine erişimi engelle">
    </div><!-- /input-group -->
</div><!-- /.col-lg-6 -->
<?php
	}
?>
<?php
if($array[$i]=="NoControlPanel"){
?>
<div class="col-lg-6">
<div class="input-group <?php if(substr(trim($xml[$i]->value),-1)==1){echo "has-success";}else{ echo "has-error";} ?>">
  <span class="input-group-addon">
    <input type="checkbox" class="rule" data-toggle="modal" href="<?php if(substr(trim($xml[$i]->value),-1)==1){echo "#cancelrule";}else{ echo "#sorbakalim";}  ?>" value="NoControlPanel" <?php if(substr(trim($xml[$i]->value),-1)==1){echo "checked";}  ?>>
  </span>
  <input type="text" class="form-control disabled" disabled="disabled" value="Denetim Masası'na erişimi engelle">
</div><!-- /input-group -->
</div><!-- /.col-lg-6 -->
</div>
<?php
	}
?>
<?php
if($array[$i]=="DisableTaskMgr"){
?>
<div class="row" style="margin-bottom:10px;">
<div class="col-lg-6">
<div class="input-group <?php if(substr(trim($xml[$i]->value),-1)==1){echo "has-success";}else{ echo "has-error";} ?>">
  <span class="input-group-addon">
  <input type="checkbox" class="rule" data-toggle="modal" href="<?php if(substr(trim($xml[$i]->value),-1)==1){echo "#cancelrule";}else{ echo "#sorbakalim";}  ?>" value="DisableTaskMgr" <?php if(substr(trim($xml[$i]->value),-1)==1){echo "checked";} ?>>
  </span>
  <input type="text" class="form-control disabled" disabled="disabled" value="Görev Yöneticisi'ne erişimi engelle">
</div><!-- /input-group -->
</div><!-- /.col-lg-6 -->
<?php
	}
?>
<?php
if($array[$i]=="NoRun"){
?>
<div class="col-lg-6">
<div class="input-group <?php if(substr(trim($xml[$i]->value),-1)==1){echo "has-success";}else{ echo "has-error";} ?>">
  <span class="input-group-addon">
   <input type="checkbox" class="rule" data-toggle="modal" href="<?php if(substr(trim($xml[$i]->value),-1)==1){echo "#cancelrule";}else{ echo "#sorbakalim";}  ?>" value="NoRun" <?php if(substr(trim($xml[$i]->value),-1)==1){echo "checked";}  ?>>
  </span>
  <input type="text" class="form-control disabled" disabled="disabled" value="Çalıştır Komutunu engelle">
</div><!-- /input-group -->
</div><!-- /.col-lg-6 -->
</div>
<?php
	}
?>
<?php
if($array[$i]=="NoClose"){
?>
<div class="row" style="margin-bottom:10px;">
<div class="col-lg-6">
<div class="input-group <?php if(substr(trim($xml[$i]->value),-1)==1){echo "has-success";}else{ echo "has-error";} ?>">
  <span class="input-group-addon">
    <input type="checkbox" class="rule" data-toggle="modal" href="<?php if(substr(trim($xml[$i]->value),-1)==1){echo "#cancelrule";}else{ echo "#sorbakalim";}  ?>" value="NoClose" <?php if(substr(trim($xml[$i]->value),-1)==1){echo "checked";}  ?>>
  </span>
  <input type="text" class="form-control disabled" disabled="disabled" value="Bilgisayarı Kapat-Yeniden Başlat-Uyku Moduna Al Komutlarını engelle">
</div><!-- /input-group -->
</div><!-- /.col-lg-6 -->
<?php
	}
?>
<?php
if($array[$i]=="StartMenuLogOff"){
?>
<div class="col-lg-6">
<div class="input-group <?php if(substr(trim($xml[$i]->value),-1)==1){echo "has-success";}else{ echo "has-error";} ?>">
  <span class="input-group-addon">
    <input type="checkbox" class="rule" data-toggle="modal" href="<?php if(substr(trim($xml[$i]->value),-1)==1){echo "#cancelrule";}else{ echo "#sorbakalim";}  ?>" value="StartMenuLogOff" <?php if(substr(trim($xml[$i]->value),-1)==1){echo "checked";}  ?>>
  </span>
  <input type="text" class="form-control disabled" disabled="disabled" value="Oturumu Kapat komutunu engelle">
</div><!-- /input-group -->
</div><!-- /.col-lg-6 -->
</div>
<?php
	}
?>
<?php
if($array[$i]=="NoViewOnDrive"){
$parcala = explode("0x",$xml[$i]->value);
?>
<div class="row" style="margin-bottom:10px;">
<div class="col-lg-6">
<div class="input-group <?php if($parcala[1]!=0){echo "has-success";}else{ echo "has-error";} ?>">
  <span class="input-group-addon">
    <input type="checkbox" class="rule" data-toggle="modal" href="<?php if($parcala[1]!=0){echo "#cancelrule";}else{ echo "#suruculer";}  ?>" value="NoViewOnDrive" <?php if($parcala[1]!=0){echo "checked";} ?>>
  </span>
  <input type="text" class="form-control disabled" disabled="disabled" value="Sürücüleri engelle">
</div><!-- /input-group -->
</div><!-- /.col-lg-6 -->
<?php
	}
?>
<?php
}
?>
<!-- Modal -->
  <div class="modal fade" id="suruculer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:30%;  text-align:left;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Kural Uygula</h4>
        </div>
        <div class="modal-body">
        <input type="hidden" class="hiddenrulename" />
        <input type="hidden" class="hiddenrulevalue"  value="0"/>
        <div class="row">
        <p>Yasaklamak istediğiniz sürücüye tıklayın.</p>
        	<?php 
			$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=proc_list?get_proc_drives';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            $data = curl_exec($ch);
            curl_close($ch);
            $xml = simplexml_load_string($data);
			for($i=0;$i<count($xml->get_proc_drives->drives);$i++){
			?>
            <div class="col-lg-4" style="margin-bottom:5px;">
            <div class="input-group">
              <span class="input-group-addon">
                <input type="checkbox" class="drivervalue" value="<?php
				$deger=1; 
				if(substr(trim($xml->get_proc_drives->drives[$i]),0,1)=="A"){ echo "1";} 
				if(substr(trim($xml->get_proc_drives->drives[$i]),0,1)=="B"){ echo "2";}
				if(substr(trim($xml->get_proc_drives->drives[$i]),0,1)=="C"){ echo "4";}
				if(substr(trim($xml->get_proc_drives->drives[$i]),0,1)=="D"){ echo "8";}
				if(substr(trim($xml->get_proc_drives->drives[$i]),0,1)=="E"){ echo "16";}
				if(substr(trim($xml->get_proc_drives->drives[$i]),0,1)=="F"){ echo "32";}
				if(substr(trim($xml->get_proc_drives->drives[$i]),0,1)=="G"){ echo "64";}
				if(substr(trim($xml->get_proc_drives->drives[$i]),0,1)=="H"){ echo "128";}
				if(substr(trim($xml->get_proc_drives->drives[$i]),0,1)=="I"){ echo "256";}
				if(substr(trim($xml->get_proc_drives->drives[$i]),0,1)=="J"){ echo "512";}
				if(substr(trim($xml->get_proc_drives->drives[$i]),0,1)=="K"){ echo "1024";}
				if(substr(trim($xml->get_proc_drives->drives[$i]),0,1)=="L"){ echo "2048";}
				if(substr(trim($xml->get_proc_drives->drives[$i]),0,1)=="M"){ echo "4096";}
				if(substr(trim($xml->get_proc_drives->drives[$i]),0,1)=="N"){ echo "8192";}
				if(substr(trim($xml->get_proc_drives->drives[$i]),0,1)=="O"){ echo "16384";}
				if(substr(trim($xml->get_proc_drives->drives[$i]),0,1)=="P"){ echo "32768";}
				if(substr(trim($xml->get_proc_drives->drives[$i]),0,1)=="Q"){ echo "65536";}
				if(substr(trim($xml->get_proc_drives->drives[$i]),0,1)=="R"){ echo "131072";}
				if(substr(trim($xml->get_proc_drives->drives[$i]),0,1)=="S"){ echo "262144";}
				if(substr(trim($xml->get_proc_drives->drives[$i]),0,1)=="T"){ echo "524288";}
				if(substr(trim($xml->get_proc_drives->drives[$i]),0,1)=="U"){ echo "1048576";}
				if(substr(trim($xml->get_proc_drives->drives[$i]),0,1)=="V"){ echo "2097152";}
				if(substr(trim($xml->get_proc_drives->drives[$i]),0,1)=="W"){ echo "4194304";}
				if(substr(trim($xml->get_proc_drives->drives[$i]),0,1)=="X"){ echo "8388608";}
				if(substr(trim($xml->get_proc_drives->drives[$i]),0,1)=="Y"){ echo "16777216";}
				if(substr(trim($xml->get_proc_drives->drives[$i]),0,1)=="Z"){ echo "33554432";}
				?>" />
              </span>
              <input type="text" class="form-control disabled" disabled="disabled" style="font-size:12px;" value="<?php echo $xml->get_proc_drives->drives[$i]; ?> Sürücüsü">
            </div><!-- /input-group -->
            </div><!-- /.col-lg-2 -->
            <?php
			}
			?>
        </div>
        <div class="alert alert-info gizle">
            <p>Lütfen kural uygulanırken bekleyin...</p>
        </div>
        <div class="alert alert-danger gizli error">
            <p>Lütfen kuralı uygulamak için en az 1 adet sürücü seçin.</p>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary applyrule" id="driverrule">Kuralı Uygula</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<!-- Modal -->
  <div class="modal fade" id="sorbakalim" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:30%;  text-align:left;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Kural Uygula</h4>
        </div>
        <div class="modal-body">
        	<input type="hidden" class="hiddenrulename" />
         	<p><span class="rulename" style="font-weight:bold;"></span> kuralını uygulamak istediğinizden emin misiniz?</p>
            <div class="alert alert-info gizle">
            	<p>Lütfen kural uygulanırken bekleyin...</p>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary applyrule">Kuralı Uygula</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<!-- Modal -->
  <div class="modal fade" id="cancelrule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:30%; text-align:left;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Kural Uygula</h4>
        </div>
        <div class="modal-body">
        	<input type="hidden" class="hiddenrulename" />
         	<p><span class="rulename" style="font-weight:bold;"></span> kuralını iptal etmek istediğinizden emin misiniz?</p>
            <div class="alert alert-info gizle">
            	<p>Lütfen kural iptal edilirken bekleyin...</p>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger cancelrulebutton">Kuralı İptal Et</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<script type="text/javascript">
$(function(){
	$(".rule").click(function(){
		var rulename =$(this).parent().parent().find("input[type=text]").val();
		var hiddenrulename = $(this).val();
		$(".rulename").text(rulename);
		$(".hiddenrulename").val(hiddenrulename);
	});
	$(".applyrule").click(function(){
		var id = $(this).attr("id");
		var rule = $(this).parent().parent().find(".hiddenrulename").val();
		if(id!="driverrule"){
		$(this).parent().parent().find(".gizle").fadeIn();
		$(".error").hide();
		$.ajax({
			type:"GET",
			url:"applywinrule.php",
			data:"rule="+rule+"&port="+<?php echo $port; ?>,
			success:function(){
				$(".gizle").hide();
				$("#sorbakalim").modal("hide");
				$(".modal-backdrop").hide();
				$(".restrictedwindows").html('<i style="font-size:50px; color:#0477bd; margin-top:30px; display:inline-block" class="icon-spin2 animate-spin"></i><p style="margin-top:10px;">Lütfen Bekleyiniz. Windows Kısıtlama Listesi Alınıyor...</p>');
									$(".restrictedwindowscount").html('<i class="icon-spin2 animate-spin"></i>');
									$.ajax({
									method:"GET",
									url: "getwinrlist.php",
									data: "port="+<?php echo $port; ?>,
									async: true,
									cache:false,
									success: function(proclist){
									if(!proclist){
									$(".restrictedwindows").html('Şu anda liste alınamıyor...');	
									}else{
									if(proclist=="-2"){
									/* Portu Resetle*/
									/*$.get("resetctrlport.php",{key:keydisk},function(image){
										console.log("Port Resetlendi.");	
									});
									*/
									$(".restrictedwindows").html("Port Canlı Değil");
									}else{
									$(".restrictedwindows").html(proclist);
									}
									}
									}
									});
				}
		});
		}else{
		var hiddenrulevaluesend = $(".hiddenrulevalue").val();
		if(hiddenrulevaluesend!="0"){
		$(this).parent().parent().find(".gizle").fadeIn();
		$(".error").hide();
		$.ajax({
			type:"GET",
			url:"applywindriverrule.php",
			data:"rule="+rule+"&port="+<?php echo $port; ?>+"&drivernumber="+hiddenrulevaluesend,
			success:function(){
				$(".gizle").hide();
				$("#sorbakalim").modal("hide");
				$(".modal-backdrop").hide();
				$(".restrictedwindows").html('<i style="font-size:50px; color:#0477bd; margin-top:30px; display:inline-block" class="icon-spin2 animate-spin"></i><p style="margin-top:10px;">Lütfen Bekleyiniz. Windows Kısıtlama Listesi Alınıyor...</p>');
									$(".restrictedwindowscount").html('<i class="icon-spin2 animate-spin"></i>');
									$.ajax({
									method:"GET",
									url: "getwinrlist.php",
									data: "port="+<?php echo $port; ?>,
									async: true,
									cache:false,
									success: function(proclist){
									if(!proclist){
									$(".restrictedwindows").html('Şu anda liste alınamıyor...');	
									}else{
									if(proclist=="-2"){
									/* Portu Resetle*/
									/*$.get("resetctrlport.php",{key:keydisk},function(image){
										console.log("Port Resetlendi.");	
									});
									*/
									$(".restrictedwindows").html("Port Canlı Değil");
									}else{
									$(".restrictedwindows").html(proclist);
									}
									}
									}
									});
				}
		});
		}else{
			$(".error").fadeIn();
			}
			}
		});	
	$(".cancelrulebutton").click(function(){
		var rule = $(this).parent().parent().find(".hiddenrulename").val();
		$(this).parent().parent().find(".gizle").fadeIn();
		$.ajax({
			type:"GET",
			url:"cancelwinrule.php",
			data:"rule="+rule+"&port="+<?php echo $port; ?>,
			success:function(){
				$(".gizle").hide();
				$("#sorbakalim").modal("hide");
				$(".modal-backdrop").hide();
				$(".restrictedwindows").html('<i style="font-size:50px; color:#0477bd; margin-top:30px; display:inline-block" class="icon-spin2 animate-spin"></i><p style="margin-top:10px;">Lütfen Bekleyiniz. Windows Kısıtlama Listesi Alınıyor...</p>');
									$(".restrictedwindowscount").html('<i class="icon-spin2 animate-spin"></i>');
									$.ajax({
									method:"GET",
									url: "getwinrlist.php",
									data: "port="+<?php echo $port; ?>,
									async: true,
									cache:false,
									success: function(proclist){
									if(!proclist){
									$(".restrictedwindows").html('Şu anda liste alınamıyor...');	
									}else{
									if(proclist=="-2"){
									/* Portu Resetle*/
									/*$.get("resetctrlport.php",{key:keydisk},function(image){
										console.log("Port Resetlendi.");	
									});
									*/
									$(".restrictedwindows").html("Port Canlı Değil");
									}else{
									$(".restrictedwindows").html(proclist);
									}
									}
									}
									});
				}
		})
		});	
		$(".drivervalue").click(function(){
			var value = parseInt($(this).val());	
			var oldvalue = parseInt($(".hiddenrulevalue").val());
			$(this).toggleClass("checked");
			if($(this).hasClass("checked")){
			$(".hiddenrulevalue").val(value+oldvalue);
			}else{
			$(".hiddenrulevalue").val(oldvalue-value);
				}
		});
})
</script>