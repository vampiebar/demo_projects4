<?php
$port = $_GET["port"];
$path = trim($_GET["path"]);
$path = str_replace(" ","+",$path);
$path = urlencode($path);
$suffix = $_GET["suffix"];
if($_GET){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=proc_list?find_files___path='.$path.'___suffix=.'.$suffix.'';
echo $url;
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
        	<th>Uygulama Adı:</th>
            <th>Uygulama Yolu:</th>
            <th>İşlem:</th>
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
    <td><button class="btn btn-danger blockbutton" data-toggle="modal" href="#newar" style="margin-right:4px;"><i class="icon-block"></i> Yasakla</button></td>
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
        <h4 class="modal-title text-left">Yeni Uygulama Ekle</h4>
      </div>
      <div class="modal-body">
      <div class="alert alert-info">
      <div style="display:none;">
      	<span class="fullpath"></span>
        <span class="filedesc"></span>
      </div>
      <p><span class="appname" style="font-weight:bold;"></span> uygulamasını engellemek üzeresiniz.</p>
      </div>
        <form class="form-horizontal" style="margin-top:10px;">
          <div class="form-group">
            <label class="col-lg-4 control-label">Başlangıç Saati:</label>
            <div class="col-lg-8">
            <div class="col-lg-6">
                  <select class="form-control starthour">
                  <option value="0">Saat:</option>
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
                <option value="0">Dakika:</option>
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
            <label class="col-lg-4 control-label">Bitiş Saati:</label>
            <div class="col-lg-8">
            <div class="col-lg-6">
                 <select class="form-control endhour">
                 <option value="0">Saat:</option>
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
                <option value="0">Dakika:</option>
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
             <label class="col-lg-4 control-label">Hangi Günler:</label>
             <div class="col-lg-8">
             <div class="col-lg-12">
             <select multiple  class="form-control days">
                <option value="1">Pazartesi</option>
                <option value="2">Salı</option> 
                <option value="3">Çarşamba</option> 
                <option value="4">Perşembe</option> 
                <option value="5">Cuma</option> 
                <option value="6">Cumartesi</option> 
                <option value="0">Pazar</option>
                <option value="8">Sürekli</option>  
             </select>
             </div>
             </div>
             </div>
        </form>
        <div class="row" style="margin-top:20px;">
        <div class="alert alert-danger gizle addresserror">Uygulama yasaklanıyor...</div>
        <div class="alert alert-info gizle addressinfo">Uygulama yasaklanıyor...</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info addwsr">Uygulama Ekle</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Vazgeç</button>
      </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
$(function(){
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
				url:"blockapplication.php",
				data:"port="+<?php echo $port; ?>+"&proc_limit="+proc_limit+"&proc_limit_start="+proc_limit_start+"&proc_limit_end="+proc_limit_end+"&proc_limit_weekday="+days+"&proc_limit_full_path="+proc_limit_full_path+"&proc_limit_file_desc="+proc_limit_file_desc,
				success:function(cevap){
					$("#newar").modal('hide');
					$(".modal-backdrop").hide();
					$(".restrictedapplications").html('<i style="font-size:50px; color:#0477bd; margin-top:30px; display:inline-block" class="icon-spin2 animate-spin"></i><p style="margin-top:10px;">Lütfen Bekleyiniz. Uygulama Kısıtlama Listesi Alınıyor...</p>');
									$(".restrictedapplicationscount").html('<i class="icon-spin2 animate-spin"></i>');
									$.ajax({
									method:"GET",
									url: "getarlist.php",
									data: "port="+<?php echo $port; ?>,
									async: true,
									cache:false,
									success: function(proclist){
									if(!proclist){
									$(".restrictedapplications").html('Şu anda liste alınamıyor...');	
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
										$(this).removeClass("btn-danger").addClass("btn-success").html('<i class="icon-check"></i> İzin Ver');
										},function(){
										$(this).removeClass("btn-success").addClass("btn-danger").html('<i class="icon-block"></i> Yasaklı');	
										})
									$(".allowbutton").hover(function(){
										$(this).removeClass("btn-success").addClass("btn-danger").html('<i class="icon-block"></i> Yasakla');
										},function(){
										$(this).removeClass("btn-danger").addClass("btn-success").html('<i class="icon-check"></i> İzin Verildi');	
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
