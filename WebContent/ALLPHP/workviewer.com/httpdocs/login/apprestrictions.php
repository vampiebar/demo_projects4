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
	 <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <div class="panel panel-warning">
      <div class="panel-heading">
      <h3 class="panel-title"><span class="pcdriveslist"></span><?php echo $dil["drivers"] ?><span class="label label-success pull-right pcdrivescount">0</span></h3>
      </div>
      <div class="panel-body" style="font-size:12px;">
        <div class="pcdrives">
        <div class="alert alert-info">
            <p><i class="icon-warning-empty"></i> <?php echo $dil["see_drivers"] ?></p>
        </div>
        </div>
      </div>
    </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 suffixedapplications">
    <div class="panel panel-warning">
      <div class="panel-heading">
      <h3 class="panel-title"><span class="restrictedapplicationslist"></span><?php echo $dil["appr"] ?> <span class="label label-success pull-right restrictedapplicationscount">0</span></h3>
      </div>
      <div class="panel-body">
        <div class="restrictedapplications">
        <div class="alert alert-info">
            <p><i class="icon-warning-empty"></i> <?php echo $dil["see_appr"] ?></p>
        </div>
        </div>
      </div>
    </div>
    </div>
</div>
</div>
