<?php 
session_start();
if(!@$_SESSION["logindil"]){
	@$_SESSION["logindil"]="tr";
	require("dil/tr.php");
}else{
	require("dil/".$_SESSION["logindil"].".php");
}
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="restrictedwebsites">
        <div class="alert alert-info">
            <p><i class="icon-warning-empty"></i> <?php echo $dil["wsr_click"]; ?></p>
        </div>
        </div>
</div>
</div>