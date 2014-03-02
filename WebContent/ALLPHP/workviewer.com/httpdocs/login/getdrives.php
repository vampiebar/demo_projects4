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
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=proc_list?get_proc_drives';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
}
?>
<div class="panel-group" id="surucu">
<div class="input-group" style="margin-bottom:10px;">
	<span class="input-group-addon driver_addon"><?php echo $dil["drive"] ?></span>
  		<input type="text" class="form-control filename" placeholder="Örn:.exe,notepad.exe">
  	<span class="input-group-btn">
    	<button class="btn btn-primary searchit" type="button"><?php echo $dil["search"] ?></button>
  	</span>
</div>
<?php
for($i=0;$i<count($xml->get_proc_drives->drives);$i++){
?>
<div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title" style="font-size:12px;">
        <a class="accordion-toggle drivername" data-toggle="collapse" data-parent="#surucu" href="#surucu<?php echo $i; ?>">
          <i class="icon-database-1"></i> <span class="drivername_text"><?php echo $xml->get_proc_drives->drives[$i]; ?></span> <?php echo $dil["driveri"] ?>
        </a>
      </h4>
    </div>
    <div id="surucu<?php echo $i; ?>" class="panel-collapse collapse">
      <div class="panel-body">
      <div class="list-group">
		<?php 
        $url2='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=proc_list?get_proc_subdirs___parent='.$xml->get_proc_drives->drives[$i].'';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url2);
        $data = curl_exec($ch);
        curl_close($ch);
        $xml2 = simplexml_load_string($data);
        for($j=0;$j<count($xml2->get_proc_subdirs->subdirs);$j++){
        ?>
        <a class="list-group-item subdirectory" data-toggle="collapse" data-parent="#altklasor" href="#altklasor<?php echo substr($xml2->get_proc_subdirs->subdirs[$j],0,1).$j; ?>"><i class="icon-folder-2"></i> <?php echo $xml2->get_proc_subdirs->subdirs[$j]; ?><input type="hidden" value="<?php echo $xml2->get_proc_subdirs->subdirs[$j]; ?>" /></a>
        <div id="altklasor<?php echo substr($xml2->get_proc_subdirs->subdirs[$j],0,1).$j; ?>" class="collapse">
        <ul class="list-unstyled subdirectory">
        </ul>
        </div>
        <?php 
        }
        ?>
        </div>
      </div>
    </div>
  </div>
<?php 
}
?>
</div>
<div class="modal fade" id="suffix" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:30%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><?php echo $dil["warning"] ?></h4>
        </div>
        <div class="modal-body">
         <div class="alert alert-danger text-center" style="margin-bottom:0px;">
         	<p><?php echo $dil["warning_desc"] ?></p>
         </div>
        </div>
        <div class="modal-footer" style="margin-top:0px;">
          <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $dil["ok"] ?></button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<script type="text/javascript">
$(function(){
	function ara(){
		var deger = $(".filename").val();
		if(deger.length<1){
			 $("#suffix").modal("show");
			}else{
			var directory2 = $(".driver_addon").text();
			$(".restrictedapplications").html('<i style="font-size:50px; color:#0477bd; margin-top:30px; display:inline-block" class="icon-spin2 animate-spin"></i><p style="margin-top:10px;"><?php echo $dil["list_retrieving"] ?></p>');
			$(".restrictedapplicationscount").html('<i class="icon-spin2 animate-spin"></i>');
			$.get("getsearched.php",{port:<?php echo $port; ?>,path:directory2,suffix:deger},function(proclist){
					if(!proclist){
					$(".restrictedapplications").html('<?php echo $dil["list_error"] ?>');	
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
					var size = $(".restrictedapplications table tbody tr").size();
					$(".restrictedapplicationscount").text(size);
					//console.log(proclist);
					}
					}
					});	
				}	
	}
	$(".filename").keypress(function(ev){
		var keycode = (ev.keyCode ? ev.keyCode : ev.which);
		if (keycode == '13') {
		ara();
        }
		});
	$(".searchit").click(function(){
		ara();
		});
	$(".drivername").click(function(){
		var drivername = $(this).find(".drivername_text").text();
		$(".driver_addon").text(drivername);
		});
	$(".subdirectory").click(function(){
		var directory = $(this).find("input").val();
		var suffixcontrol = $(".suffixcontrol").val();
		console.log(directory);
		$(".driver_addon").text(directory+"/");
		/*if(suffixcontrol==0){
			$("#suffix").modal("show");
			}else{
				$(".subdirectory").removeClass("active");
				$(".subdirectory").find("i").removeClass("icon-folder-open").addClass("icon-folder-2");
				$(this).addClass("active");
				$(this).find("i").removeClass("icon-folder-2").addClass("icon-folder-open");
				$(".restrictedapplications").html('<i style="font-size:50px; color:#0477bd; margin-top:30px; display:inline-block" class="icon-spin2 animate-spin"></i><p style="margin-top:10px;">Lütfen Bekleyiniz. Liste Alınıyor...</p>');
				$.get("getsuffixed.php",{port:<?php echo $port; ?>,path:directory,suffix:suffixcontrol},function(proclist){
					if(!proclist){
					$(".restrictedapplications").html('Şu anda liste alınamıyor...');	
					}else{
					if(proclist=="-2"){
					/* Portu Resetle*/
					/*$.get("resetctrlport.php",{key:keydisk},function(image){
						console.log("Port Resetlendi.");	
					});
					*/
					/*$(".restrictedapplications").html("Port Canlı Değil");
					}else{
					$(".restrictedapplications").html(proclist);
					//console.log(proclist);
					}
					}
					});
				}
		*/});
	})
</script>