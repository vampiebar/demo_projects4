<?php
$screenport = $_GET["screenport"];
session_start();
if(!@$_SESSION["logindil"]){
	@$_SESSION["logindil"]="tr";
	require("dil/tr.php");
}else{
	require("dil/".$_SESSION["logindil"].".php");
}
?> 
<script type="text/javascript" src="js/datepicker.js"></script>
<script type="text/javascript">
$(function() {
	$('#reportstartdate,#reportenddate').datetimepicker({
                   format:"yyyy-MM-dd hh:mm:ss"
    });
	$(".createreport").click(function(){
		var port = <?php echo $screenport; ?>;
		var baslangic = $("#baslangicreport").val();
		var bitis = $("#bitisreport").val();
		baslangic2 = baslangic.split(' ').join('T');
		bitis2 = bitis.split(' ').join('T');
		baslangic3 = new Date(baslangic2);
		bitis3 = new Date(bitis2);
		baslangic4 = baslangic3.getTime()/1000; 
		bitis4 = bitis3.getTime()/1000;
		if(baslangic4>bitis4){
			$(".reportresponse").fadeOut();
			$(".tarihuyarireport").html('<p>Başlangıç Tarihi Bitiş Tarihinden Küçük Olmalıdır.</p>').fadeIn();
			}else{
				$(".tarihuyarireport").fadeOut();
				$(".reportresponse").html('<i style="font-size:50px; color:#0477bd; margin-top:30px; display:inline-block" class="icon-spin2 animate-spin"></i> <p style="margin-top:10px;">Rapor Oluşturuluyor. Lütfen bekleyin...</p>').fadeIn();
				$.ajax({
					type:"GET",
					url:"createprgusagereport.php",
					data:"screenport="+port+"&baslangic="+baslangic+"&bitis="+bitis,
					success:function(response){
						$(".reportresponse").html(response).fadeIn();
						}
					})
				}
		});
 });

</script>
<div class="row">
<div class="form-group col-lg-3">
<p>Başlangıç Tarihi ve Saati</p>
<div class='input-group date' id='reportstartdate'>
    <input type='text' id="baslangicreport" class="form-control" value="<?php echo date("Y-m-d H:i:s",time()-86400); ?>" data-format="yyyy-MM-dd hh:mm:ss" />
    <span class="input-group-addon"><span class="icon-calendar"></span>
    </span>
</div>
</div>
<div class="form-group col-lg-3">
<p>Bitiş Tarihi ve Saati</p>
<div class='input-group date' id='reportenddate'>
    <input type='text' id="bitisreport" class="form-control" value="<?php echo date("Y-m-d H:i:s",time()); ?>" data-format="yyyy-MM-dd hh:mm:ss" />
    <span class="input-group-addon"><span class="icon-calendar"></span>
    </span>
</div>
</div>
<div class="form-group col-lg-2">
	<p>&nbsp;</p>
	<button class="btn btn-primary pull-left createreport">Raporu Oluştur</button>
</div>
</div>
<div class="row">
<div class="alert alert-danger gizle tarihuyarireport"></div>
<div class="reportresponse"></div>
</div>