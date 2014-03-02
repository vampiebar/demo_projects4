<?php 
$siparisno=time();
$sifre = md5($siparisno);
preg_match_all("#[^A-Za-z]*#",$sifre,$eslesme);
$sifrelimetin = implode("",$eslesme[0]);
$sifrelimetin = substr($sifrelimetin,0,10);
include("config.php");
/*if(!$_SERVER['HTTPS']){
     $url = 'https://www.secpayazilim.com/satinal';
     header("Location: $url");
}
*/
session_start();
if(!$_SESSION["dil"]){
	require("dil/en.php");
}else{
	require("dil/".$_SESSION["dil"].".php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Seçpa, Secpa, Seçpa Soft, Secpa Soft, Seçpa Yazilim, Secpa Yazilim, WorkViewer, Work Viewer, Kids, Kids Viewer, KidsViewer,Work Viewer Buy,  Buy Work Viewer, WorkViewer Buy, Buy WorkViewer, Kids Viewer Buy, Buy Kids Viewer, KidsViewer Buy, Buy KidsViewer, ReadyCafe, Ready Cafe, Ready Cafe Satın Al, Ready Cafe Satin Al, ReadyCafe Buy, Ready Cafe Buy, Download Workviewer, Download Work viewer" />
<meta name="description" content="Work Viewer ve Kids Viewer Satın Alma Sayfası" />
<meta name="Robots" content="index,follow" />
<meta name="viewport" content="width=device-width;minimum-scale=0.5,maximum-scale=1.0; user-scalable=1;" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" type="text/css" href="css/da-slider.css" />
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="css/font-awesome-ie7.min.css" />
<!--<link rel="stylesheet" type="text/css" href="css/fractionslider.css">-->
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/prettify.js"></script>
<script type="text/javascript" src="js/modernizr.js"></script>
<script type="text/javascript" src="js/holder.js"></script>
<script type="text/javascript" src="js/currency.js"></script>
<script type="text/javascript" src="js/currencyformat.js"></script>
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css' />
<link href='https://fonts.googleapis.com/css?family=Economica:700,400italic' rel='stylesheet' type='text/css' />
<link href='https://fonts.googleapis.com/css?family=Noto+Sans:400,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css' />
<title>Seçpa Yazılım | <?php echo $dil["satin_al"]; ?></title>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".btn").tooltip();
				$(".price,.indirim,.toplam").formatCurrency({region: 'en-US'});
					prettyPrint();
					$("#buyworkviewer,#buykidsviewer").click(function(){
						var id = $(this).attr("id");
						$(".thumbnails").fadeOut(700,function(){
							$(".progressbar,#shopbox,#billing_information,.buttons").fadeIn(700);
							});
						if(id=="buyworkviewer"){
							$("#packet_name").html("Work Viewer");
							$("#billing_packet_name").val("Work Viewer");
							$("#packet_desc").html("<?php echo $dil["n_i_k_y"]; ?>");
							$("div.form-inline").show();
							$(".price").html("0").formatCurrency({ region:"en-US"});
							$(".server_text,.discount_text").parent().show();
							$(".toplam").html("0").formatCurrency({ region:"en-US"});
							$("#billing_price").val("");
							$("input[type=text],textarea").val("");
							$(".goon").attr("disabled","disabled").addClass("disabled");
							$("#summary_image").attr("src","img/w432x150.png").attr("alt","Work Viewer");
							$("#selected_product").html("Work Viewer");
							$("#choosefinansbank,#chooseakbank,#choosegaranti").html("<?php echo $dil["sec"] ?>").removeClass("btn-warning").addClass("btn-danger");
							}
						if(id=="buykidsviewer"){
							$("#packet_name").html("Kids Viewer");
							$("#billing_packet_name").val("Kids Viewer");
							$("#packet_desc").html("<?php echo $dil["pc_i_k_y"]; ?>");
							$("div.form-inline").hide();
							$(".price").html("41.525").formatCurrency({ region:"en-US"});
							$(".server_text,.discount_text").parent().hide();
							$(".toplam").html("49").formatCurrency({ region:"en-US"});
							$("#billing_price").val("49").formatCurrency({ region:"en-US"});
							$("input[type=text],textarea").val("");
							$(".goon").removeAttr("disabled").removeClass("disabled");
							$("#summary_image").attr("src","img/k432x150.png").attr("alt","Kids Viewer");
							$("#selected_product").html("Kids Viewer");
							$("#choosefinansbank,#chooseakbank,#choosegaranti").html("<?php echo $dil["sec"] ?>").removeClass("btn-warning").addClass("btn-danger");
							}
						});
			$(".gobackbaby").click(function(){
				$(".progressbar_inner").animate({
					width: "0%"
				}, {
					duration: 1000,
					step: function (current_number) {
						$(".text").html(Math.floor(current_number) + "% <?php echo $dil["tamamlandi"] ?>");
					}
				},1000);
				$(".progressbar,#shopbox,#billing_information,.buttons").fadeOut(700,function(){
							$(".thumbnails").fadeIn(700);
							});
				});
			var deger = 0;
    		$(".expiry_date_input").change(function () {
				$(this).find("option").filter(":selected").attr("selected", "selected").siblings().removeAttr("selected");
				var katsayi = $(this).val();
				var new_price = $("#hiddenprice").val().replace("$","");
				var new_total = $("#hiddentotal").val().replace("$","");
				var admin_module_changed = $(".adminmodul").val();
				var admin_katsayi=500;
				if (katsayi == 1) {
					var indirim = parseFloat(new_price.replace(",", "").replace(".", ",")) * (0) / (100) * katsayi;
					$(".indirim").html(indirim).formatCurrency({region: 'en-US'});
					$(".indirim").css("text-decoration", "line-through");
					$("#hiddenindirim").val(indirim).formatCurrency({region: 'en-US'});
				}
				if (katsayi == 2) {
					var indirim = parseFloat(new_price.replace(",", "").replace(".", ",")) * (20) / (100) * katsayi;
					$(".indirim").html(indirim).formatCurrency({
						region: 'en-US'
					});
					$(".indirim").css("text-decoration", "none");
					$("#hiddenindirim").val(indirim).formatCurrency({region: 'en-US'});
				}
				if (katsayi == 3) {
					var indirim = parseFloat(new_price.replace(",", "").replace(".", ",")) * (30) / (100) * katsayi;
					$(".indirim").html(indirim).formatCurrency({
						region: 'en-US'
					});
					$(".indirim").css("text-decoration", "none");
					$("#hiddenindirim").val(indirim).formatCurrency({region: 'en-US'});
				}
				$(".price").html(katsayi * parseFloat(new_price.replace(",", "").replace(".", ","))).formatCurrency({
					region: 'en-US'
				});
				$(".toplam").html(katsayi * parseFloat(new_total.replace(",", "").replace(".", ",")) - indirim).formatCurrency({
					region: 'en-US'
				});
				$("#billing_price").val(katsayi * parseFloat(new_total.replace(",", "").replace(".", ",")) - indirim).formatCurrency({
					region: 'en-US'
				});
				if(admin_module_changed>1){
				if(admin_module_changed=="2"){
				admin_price=parseFloat(admin_katsayi*1);
				$(".toplam").html(katsayi * parseFloat(new_total.replace(",", "").replace(".", ",")) - indirim+admin_price).formatCurrency({
					region: 'en-US'
				});
				$("#billing_price").val(katsayi * parseFloat(new_total.replace(",", "").replace(".", ",")) - indirim+admin_price).formatCurrency({
					region: 'en-US'
				});
				}else{
				admin_price=parseFloat(admin_katsayi*(admin_module_changed-1));
				$(".toplam").html(katsayi * parseFloat(new_total.replace(",", "").replace(".", ",")) - indirim+admin_price).formatCurrency({
					region: 'en-US'
				});
				$("#billing_price").val(katsayi * parseFloat(new_total.replace(",", "").replace(".", ",")) - indirim+admin_price).formatCurrency({
					region: 'en-US'
				});
				}
					}
			});
			$(".pc_count_input").keyup(function () {
			var admin_module_input = $(".adminmodul").val();
			var admin_katsayi=500;
        	var pc_num = $(this).val();
        	if (pc_num > 0) {
            //$(".client_information,.paying_information,#continue").slideDown(700);
			$(".expiry_date_input").removeAttr("disabled");
			$(".adminmodul").removeAttr("disabled");
			$(".goon").removeClass("disabled").removeAttr("disabled");
            $(".progressbar_inner").animate({
                width: "30%"
            }, {
                duration: 1000,
                step: function (current_number) {
                    $(".text").html(Math.floor(current_number) + "% <?php echo $dil["tamamlandi"] ?>");
                }
            },1000);
        }
        if (pc_num > 1 && pc_num <= 24) {
            deger = 160;
        }
        if (pc_num >= 25 && pc_num <= 49) {
            deger = 144;
        }
		if (pc_num > 49 && pc_num <= 99) {
            deger = 128;
        }
		if (pc_num > 99 && pc_num <= 249) {
            deger = 112;
        }
		if(pc_num>249){
			deger = 96;
			}
		var price = parseFloat(deger * pc_num);
		var total = price;
        if (pc_num == "" || pc_num == 0) {
            $(".progressbar_inner").animate({
                width: "0%"
            }, {
                duration: 1000,
                step: function (current_number) {
                    $(".text").html(Math.floor(current_number) + "% <?php echo $dil["tamamlandi"] ?>");
                }
            },1000);
            $(".price,.toplam,.indirim,#hiddentotal").html("0").formatCurrency({region: 'en-US'});
			$(".expiry_date_input").attr("disabled","disabled");
			$(".goon").addClass("disabled").attr("disabled","disabled");
        } else {
            $("#hiddenprice").val(price).formatCurrency({
                region: 'en-US'
            });
            $("#hiddentotal").val(total).formatCurrency({
                region: 'en-US'
            });
			$(".price").html(price).formatCurrency({region: 'en-US'});
            $(".toplam").html(total).formatCurrency({region: 'en-US'});
            var year = $(".expiry_date_input").find("option").filter(":selected").val();
            var new_price = $("#hiddenprice").val().replace("$","");
            var new_total = $("#hiddentotal").val().replace("$","");
            if (year == 1) {
                var indirim = parseFloat(new_price.replace(",", "").replace(".", ",")) * (0) / (100) * year;
                $(".indirim").html(indirim).formatCurrency({
                    region: 'en-US'
                });
                $(".indirim").css("text-decoration", "line-through");
                $(".price").html(year * parseFloat(new_price.replace(",", "").replace(".", ","))).formatCurrency({
                    region: 'en-US'
                });
                $(".toplam").html(year * parseFloat(new_total.replace(",", "").replace(".", ",")) - indirim).formatCurrency({
                    region: 'en-US'
                });
                $("#billing_price").val(year * parseFloat(new_total.replace(",", "").replace(".", ",")) - indirim).formatCurrency({
                    region: 'en-US'
                });
				$("#hiddenindirim").val(indirim).formatCurrency({region: 'en-US'});
				if(admin_module_input>1){
				if(admin_module_input=="2"){
				admin_price=parseFloat(admin_katsayi*1);
				$(".toplam").html(year * parseFloat(new_total.replace(",", "").replace(".", ",")) - indirim+admin_price).formatCurrency({
                    region: 'en-US'
                });
                $("#billing_price").val(year * parseFloat(new_total.replace(",", "").replace(".", ",")) - indirim+admin_price).formatCurrency({
                    region: 'en-US'
                });	
				}else{
				admin_price=parseFloat(admin_katsayi*(admin_module_input-1));
				$(".toplam").html(year * parseFloat(new_total.replace(",", "").replace(".", ",")) - indirim+admin_price).formatCurrency({
                    region: 'en-US'
                });
                $("#billing_price").val(year * parseFloat(new_total.replace(",", "").replace(".", ",")) - indirim+admin_price).formatCurrency({
                    region: 'en-US'
                });
				}
				}
            }
            if (year == 2) {
                var indirim = parseFloat(new_price.replace(",", "").replace(".", ",")) * (20) / (100) * year;
                $(".indirim").html(indirim).formatCurrency({
                    region: 'en-US'
                });
                $(".indirim").css("text-decoration", "none");
                $(".price").html(year * parseFloat(new_price.replace(",", "").replace(".", ","))).formatCurrency({
                    region: 'en-US'
                });
                $(".toplam").html(year * parseFloat(new_total.replace(",", "").replace(".", ",")) - indirim).formatCurrency({
                    region: 'en-US'
                });
                $("#billing_price").val(year * parseFloat(new_total.replace(",", "").replace(".", ",")) - indirim).formatCurrency({
                    region: 'en-US'
                });
				$("#hiddenindirim").val(indirim).formatCurrency({region: 'en-US'});
				if(admin_module_input>1){
				if(admin_module_input=="2"){
				admin_price=parseFloat(admin_katsayi*1);
				$(".toplam").html(year * parseFloat(new_total.replace(",", "").replace(".", ",")) - indirim+admin_price).formatCurrency({
                    region: 'en-US'
                });
                $("#billing_price").val(year * parseFloat(new_total.replace(",", "").replace(".", ",")) - indirim+admin_price).formatCurrency({
                    region: 'en-US'
                });	
				}else{
				admin_price=parseFloat(admin_katsayi*(admin_module_input-1));
				$(".toplam").html(year * parseFloat(new_total.replace(",", "").replace(".", ",")) - indirim+admin_price).formatCurrency({
                    region: 'en-US'
                });
                $("#billing_price").val(year * parseFloat(new_total.replace(",", "").replace(".", ",")) - indirim+admin_price).formatCurrency({
                    region: 'en-US'
                });
				}
		}
            }
            if (year == 3) {
                var indirim = parseFloat(new_price.replace(",", "").replace(".", ",")) * (30) / (100) * year;
                $(".indirim").html(indirim).formatCurrency({
                    region: 'en-US'
                });
                $(".indirim").css("text-decoration", "none");
                $(".price").html(year * parseFloat(new_price.replace(",", "").replace(".", ","))).formatCurrency({
                    region: 'en-US'
                });
                $(".toplam").html(year * parseFloat(new_total.replace(",", "").replace(".", ",")) - indirim).formatCurrency({
                    region: 'en-US'
                });
                $("#billing_price").val(year * parseFloat(new_total.replace(",", "").replace(".", ",")) - indirim).formatCurrency({
                    region: 'en-US'
                });
				$("#hiddenindirim").val(indirim).formatCurrency({region: 'en-US'});
				if(admin_module_input>1){
				if(admin_module_input=="2"){
				admin_price=parseFloat(admin_katsayi*1);
				$(".toplam").html(year * parseFloat(new_total.replace(",", "").replace(".", ",")) - indirim+admin_price).formatCurrency({
                    region: 'en-US'
                });
                $("#billing_price").val(year * parseFloat(new_total.replace(",", "").replace(".", ",")) - indirim+admin_price).formatCurrency({
                    region: 'en-US'
                });	
				}else{
				admin_price=parseFloat(admin_katsayi*(admin_module_input-1));
				$(".toplam").html(year * parseFloat(new_total.replace(",", "").replace(".", ",")) - indirim+admin_price).formatCurrency({
                    region: 'en-US'
                });
                $("#billing_price").val(year * parseFloat(new_total.replace(",", "").replace(".", ",")) - indirim+admin_price).formatCurrency({
                    region: 'en-US'
                });
				}
				}
            }
        }
    });
	$("#optionsRadios1").click(function(){
		$(".forcompany").removeClass("acik").find("input[type=text]").attr("disabled","disabled").addClass("disabled");
		});
	$("#optionsRadios2").click(function(){
		$(".forcompany").addClass("acik").find("input[type=text]").removeAttr("disabled").removeClass("disabled");
		});
	$("#chooseakbank").click(function(){
		$(this).html("<?php echo $dil["secildi"] ?>").removeClass("btn-danger").addClass("btn-info");
		$("#choosefinansbank,#choosegaranti").html("<?php echo $dil["sec"] ?>").removeClass("btn-info").addClass("btn-danger");
		$("#billing_method_bank").val("Akbank");
		$(".banklist").removeClass("alert-info").css("border","1px solid #fbeed5");
		$(this).parent().parent().addClass("alert-info").css("border","4px solid #2f96b4");
		});
	$("#choosefinansbank").click(function(){
		$(this).html("<?php echo $dil["secildi"] ?>").removeClass("btn-danger").addClass("btn-info");
		$("#chooseakbank,#choosegaranti").html("<?php echo $dil["sec"] ?>").removeClass("btn-info").addClass("btn-danger");
		$("#billing_method_bank").val("Finansbank");
		$(".banklist").removeClass("alert-info").css("border","1px solid #fbeed5");
		$(this).parent().parent().addClass("alert-info").css("border","4px solid #2f96b4");
		});
	$("#choosegaranti").click(function(){
		$(this).html("<?php echo $dil["secildi"] ?>").removeClass("btn-danger").addClass("btn-info");
		$("#chooseakbank,#choosefinansbank").html("<?php echo $dil["sec"] ?>").removeClass("btn-info").addClass("btn-danger");
		$("#billing_method_bank").val("Garanti");
		$(".banklist").removeClass("alert-info").css("border","1px solid #fbeed5");
		$(this).parent().parent().addClass("alert-info").css("border","4px solid #2f96b4");
		});
 var subjects = [
 <?php $query=mysql_query("select * from ulke"); 
 $sayi=mysql_num_rows($query);
	if($sayi>0){
	for($i=0;$i<$sayi;$i++){
		$ulke=mysql_result($query,$i,"ad");
		if($i<$sayi-1){
		echo "'$ulke',";
		}
		if($i==$sayi-1){
		echo "'$ulke'";	
			}
		}
	}
 ?>]; 
$('#usercountry').typeahead({source: subjects});
$("#kredikarti_link").click(function(){
	$("#billing_method").val("Kredi Kartı");
	$("#billing_method_bank").val("");
	$("#choosefinansbank,#chooseakbank,#choosegaranti").html("<?php echo $dil["sec"] ?>").removeClass("btn-warning").addClass("btn-danger");
});
$("#havale_link").click(function(){
	$("#billing_method").val("Banka Havalesi");
});
/* Form Kontrolleri */
$(".goon").click(function(){
			var userfullname 	= $("#userfullname");
			var useremail 		= $("#useremail");
			var usertelephone 	= $("#usertelephone");
			var usercountry 	= $("#usercountry");
			var useraddress 	= $("#useraddress");
			var usercity 		= $("#usercity");
			var usercompanyname = $("#usercompanyname");
			var usertaxoffice 	= $("#usertaxoffice");
			var usertaxnumber 	= $("#usertaxnumber");
			var card_number 	= $("#card_number");
			var expiry_date 	= $("#expiry_date");
			var cvv 			= $("#cvv");
			var name_on_card 	= $("#name_on_card");
			if(userfullname.val().length<1){
				$("#example").modal().find("h3.text-center").html("<?php echo $dil["lutfen_ad"]; ?>");
				$("#example").on("hidden",function(){
				userfullname.focus();
				});
				}else
			if(useremail.val().length<1){
				$("#example").modal().find("h3.text-center").html("<?php echo $dil["lutfen_eposta"]; ?>");
				$("#example").on("hidden",function(){
				useremail.focus();
				});
				}else{
					var filter = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					if(!filter.test(useremail.val())){
						$("#example").modal().find("h3.text-center").html("<?php echo $dil["lutfen_gecerli"]; ?>");
						$("#example").on("hidden",function(){
						useremail.focus();
						});
						}else{
							if(usertelephone.val().length<1){
								$("#example").modal().find("h3.text-center").html("<?php echo $dil["lutfen_telefon"]; ?>");
								$("#example").on("hidden",function(){
								usertelephone.focus();
								});
								}else
							if(usercountry.val().length<1){
								$("#example").modal().find("h3.text-center").html("<?php echo $dil["lutfen_ulke"]; ?>");
								$("#example").on("hidden",function(){
								usercountry.focus();
								});
								}else
							if(usercity.val().length<1){
								$("#example").modal().find("h3.text-center").html("<?php echo $dil["lutfen_il"]; ?>");
								$("#example").on("hidden",function(){
								usercity.focus();
								});
								}else
							if(useraddress.val().length<1){
								$("#example").modal().find("h3.text-center").html("<?php echo $dil["lutfen_adres"]; ?>");
								$("#example").on("hidden",function(){
								useraddress.focus();
								});
								}else
							if($(".forcompany").hasClass("acik") && usercompanyname.val().length<1){
								$("#example").modal().find("h3.text-center").html("<?php echo $dil["lutfen_sirketadi"]; ?>");
								$("#example").on("hidden",function(){
								usercompanyname.focus();
								});
								}else
							if($(".forcompany").hasClass("acik") && usertaxoffice.val().length<1){
								$("#example").modal().find("h3.text-center").html("<?php echo $dil["lutfen_vd"]; ?>");
								$("#example").on("hidden",function(){
								usertaxoffice.focus();
								});
								}else
							if($(".forcompany").hasClass("acik") && usertaxnumber.val().length<1){
								$("#example").modal().find("h3.text-center").html("<?php echo $dil["lutfen_vn"]; ?>");
								$("#example").on("hidden",function(){
								usertaxnumber.focus();
								});
								}else
							if($("#kredikarti").hasClass("active") && card_number.val().length<1){
								$("#example").modal().find("h3.text-center").html("<?php echo $dil["lutfen_kkn"]; ?>");
								$("#example").on("hidden",function(){
								card_number.focus();
								});
								}
								else
							if($("#kredikarti").hasClass("active") && expiry_date.val().length<1){
								$("#example").modal().find("h3.text-center").html("<?php echo $dil["lutfen_kkskt"]; ?>");
								$("#example").on("hidden",function(){
								expiry_date.focus();
								});
								}
								else
							if($("#kredikarti").hasClass("active") && cvv.val().length<1){
								$("#example").modal().find("h3.text-center").html("<?php echo $dil["lutfen_cvv"]; ?>");
								$("#example").on("hidden",function(){
								cvv.focus();
								});
								}
								else
							if($("#kredikarti").hasClass("active") && name_on_card.val().length<1){
								$("#example").modal().find("h3.text-center").html("<?php echo $dil["lutfen_kkisim"]; ?>");
								$("#example").on("hidden",function(){
								name_on_card.focus();
								});
								}
								else
							if($("#havale").hasClass("active") && ($("#chooseakbank").hasClass("btn-danger") && $("#choosefinansbank").hasClass("btn-danger") && $("#choosegaranti").hasClass("btn-danger"))){
								$("#example").modal().find("h3.text-center").html("<?php echo $dil["lutfen_hbanka"]; ?>");
								$("#example").on("hidden",function(){
								name_on_card.focus();
								});
								}
								else
								{
								$(".buttons").fadeOut(700);
								$(".progressbar_inner").animate({
									width: "70%"
								}, {
									duration: 1000,
									step: function (current_number) {
										$(".text").html(Math.floor(current_number) + "% <?php echo $dil["tamamlandi"] ?>");
									}
								},1000);
								$("#shopbox,#billing_information").fadeOut(700,function(){
									$("#selected_address").html($("#useraddress").val());
									$("#selected_name").html($("#userfullname").val());
									$("#selected_country").html($("#usercity").val()+"/"+$("#usercountry").val());
									$("#selected_pay_method").html($("#billing_method").val());
									$("#selected_email").html($("#useremail").val());
									$("#selected_product").html($("#billing_packet_name").val());
									$("#selected_total_price").html($("#billing_price").val());
									$(".finishbilling,.editbilling").removeClass("disabled").removeAttr("disabled");
									$("#summary").fadeIn(700);
									});
								}
							}
					}
});

/* Banka Bilgisi Getir*/
$("#card_number").keyup(function(){
	var uzunluk = $(this).val().length; 
	if(uzunluk ==6){
		$.ajax({
			type:"POST",
			url:"bank.php",
			data:"card="+$(this).val(),
			success:function(a){
				if(a!="Yok"){
					$(".banka").html("<b>"+a+"</b> <?php echo $dil["kkkul"]; ?>").slideDown(700);
					}
				}
			})
		}
	if(uzunluk < 6){
		$(".banka").slideUp(700);
		}
	});

/**/

/*Form Kontrolleri*/
				$(".loading_center").center();
				$(".editbilling").click(function(){
					$(".progressbar_inner").animate({
									width: "30%"
								}, {
									duration: 1000,
									step: function (current_number) {
										$(".text").html(Math.floor(current_number) + "% <?php echo $dil["tamamlandi"] ?>");
									}
					},1000);
					$("#summary").fadeOut(700,function(){
						$("#shopbox,#billing_information").fadeIn(700);
						$(".buttons").fadeIn(700);
						});
					});
				$(".finishbilling").click(function(){
					if($("#kredikarti").hasClass("active")){
					$.ajax({
					type:"POST",
					url:"pos.php",
					data:"card_number="+$("#card_number").val()+"&expiry_date="+$("#expiry_date").val()+"&cvv="+$("#cvv").val()+"&name_on_card="+$("#name_on_card").val()+"&price="+$("#billing_price").val(),
						success:function(a){
							if(a=="Declined"){
							$("#example").modal().find("h3.text-center").html("<?php echo $dil["kkhatabank"]; ?>");
							$('#example').on('hidden', function () {
								$(".editbilling").click();
							});
							}
							if(a=="Error"){
							$("#example").modal().find("h3.text-center").html("<?php echo $dil["kkhatabilgi"]; ?>");
							$('#example').on('hidden', function () {
								$(".editbilling").click();
							});
							}
							if(a=="Approved"){
							var expiry_date = $(".expiry_date_input").val();
							$(".perde").show();
							$(".loading_center").fadeIn(700);
							$.ajax({
								type:"POST",
								data:$(".form").serialize()+"&expiry_date_input="+expiry_date,
								url:"satis.php",
								success:function(a){
									if(a=="Aferin"){
										$(".loading_center").fadeOut(700,function(){
											$(".loading_center").fadeIn(700).html("<?php echo $dil["islem_tamam"]; ?>").delay(1500).fadeOut(700,function(){
												$(".perde").hide();
												$(".progressbar_inner").animate({
												width: "100%"
											}, {
												duration: 1000,
												step: function (current_number) {
													$(".text").html(Math.floor(current_number) + "% <?php echo $dil["tamamlandi"] ?>");
												}
											},1000);
												});
												$("#summary").fadeOut(700,function(){
													$("#siparis_mail").html($("#useremail").val());
													$("#siparis_packet_name").html($("#billing_packet_name").val());
													$("#siparis_no").html($("#order_code").val());
													$("#siparis_toplam").html($("#billing_price").val());
													$(".siparis_ok").fadeIn(700);
													});
											});
										}else{
											alert(a);
											}
									}
								})
									}
							}
						})
					}else{
					var expiry_date = $(".expiry_date_input").val();
							$(".perde").show();
							$(".loading_center").fadeIn(700);
							$.ajax({
								type:"POST",
								data:$(".form").serialize()+"&expiry_date_input="+expiry_date,
								url:"satis.php",
								success:function(a){
									if(a=="Aferin"){
										$(".loading_center").fadeOut(700,function(){
											$(".loading_center").fadeIn(700).html("<?php echo $dil["islem_tamam"]; ?>").delay(1500).fadeOut(700,function(){
												$(".perde").hide();
												$(".progressbar_inner").animate({
												width: "100%"
											}, {
												duration: 1000,
												step: function (current_number) {
													$(".text").html(Math.floor(current_number) + "% <?php echo $dil["tamamlandi"] ?>");
												}
											},1000);
												});
												$("#summary").fadeOut(700,function(){
													$("#siparis_mail").html($("#useremail").val());
													$("#siparis_packet_name").html($("#billing_packet_name").val());
													$("#siparis_no").html($("#order_code").val());
													$("#siparis_toplam").html($("#billing_price").val());
													$(".siparis_ok").fadeIn(700);
													});
											});
										}else{
											alert(a);
											}
									}
								})	
					}
					});
				$("#usertaxnumber,#usertelephone,#card_number,#cvv,.pc_count_input").keypress(function(key) {
				if((key.charCode < 48 || key.charCode > 57) && key.charCode != 0 && key.charCode != 8 && key.charCode != 9 && key.charCode != 46) return false;
				});
				$("#usercountry,#userfullname,#usertaxoffice,#name_on_card").keypress(function(key) {
				if((key.charCode<65 || key.charCode>90) && (key.charCode<97 || key.charCode>122) && (key.charCode<191 || key.charCode>122) && key.charCode<191 && key.charCode!=45 && key.charCode!=32 ){ 
				return false;
				}
				});
				$("#usercountry").blur(function(){
					if($(this).val().length>0){
					$("#usercity").parent().parent().show();
					$("#usercity").focus();
					}
					});
				$("#usercity").typeahead({
				source: function(query, process) {
				var country=$("#usercountry").val();
							$.ajax({
								url: 'choosecity.php',
								type: 'POST',
								data: 'query=' + query + '&country=' + country,
								dataType: 'JSON',
								async: true,
								success: function(data) {
								process(data);
								}
							});
						}
					});
					$(".adminmodul").on("keyup",function(){
					var discount = parseFloat($("#hiddenindirim").val().replace("$","").replace(",", "").replace(".", ","));
					var deger = $(this).val();
					var sabit = 500;
					var toplamfiyat = parseFloat(deger*sabit);
					if(deger>1 && deger!="2"){
					$(".managermodule").css("text-decoration","none").html(toplamfiyat-500).formatCurrency({ region:"en-US"});
					var fiyat_admin =parseFloat($(".price").html().replace("$","").replace(",", "").replace(".", ","));
					var adminmoduletoplamg =parseFloat(fiyat_admin)+parseFloat(toplamfiyat)-discount;
					$("span.toplam").html(adminmoduletoplamg-500).formatCurrency({ region:"en-US"});
					$("#billing_price").val(adminmoduletoplamg-500).formatCurrency({ region:"en-US"});
					}
					if(deger==2){
					toplamfiyat = parseFloat(1*sabit);
					$(".managermodule").css("text-decoration","none").html(toplamfiyat).formatCurrency({ region:"en-US"});
					var fiyat_admin =parseFloat($(".price").html().replace("$","").replace(",", "").replace(".", ","));
					var adminmoduletoplamg =parseFloat(fiyat_admin)+parseFloat(toplamfiyat)-discount;
					$("span.toplam").html(adminmoduletoplamg).formatCurrency({ region:"en-US"});
					$("#billing_price").val(adminmoduletoplamg).formatCurrency({ region:"en-US"});	
					}
					if(deger==1){
					toplamfiyat = 0;
					$(".managermodule").css("text-decoration","line-through").html(500).formatCurrency({ region:"en-US"});
					var fiyat_admin =parseFloat($(".price").html().replace("$","").replace(",", "").replace(".", ","));
					var adminmoduletoplamg =parseFloat(fiyat_admin+parseFloat(toplamfiyat))-discount;
					var bayi = parseFloat(fiyat_admin)-discount;
					var bayitoplam = parseFloat(bayi)-parseFloat(bayi*30/100)+toplamfiyat;
					$("span.bayi").html(bayitoplam).formatCurrency({ region:"en-US"});
					$("span.toplam").html(adminmoduletoplamg).formatCurrency({ region:"en-US"});
					$("#billing_price").val(bayitoplam).formatCurrency({ region:"en-US"});	
					}
					if(deger=="0" || deger==""){
						$(".managermodule").css("text-decoration","line-through").html(500).formatCurrency({ region:"en-US"});
						var fiyat_admin =parseFloat($(".price").html().replace("$","").replace(",", "").replace(".", ","));
						var adminmoduletoplams =parseFloat(fiyat_admin)-discount;
						$("span.toplam").html(adminmoduletoplams).formatCurrency({ region:"en-US"});
						$("#billing_price").val(adminmoduletoplamg).formatCurrency({ region:"en-US"});
						}
					/*var indirim_span = $(".indirim").text();
					console.log(indirim_span);
					*/
			});
				$(".adminmodul").on("blur",function(){
					var adminmodulval = $(this).val();
					if(adminmodulval=="0" || adminmodulval==""){
						$(this).val("1");
						$(".managermodule").css("text-decoration","line-through").html(500).formatCurrency({ region:"en-US"});
						}
					});
				$(".topbar_menu ul li").hover(function(){
						$(this).find("ul").slideDown();
						},function(){
						$(this).find("ul").hide();	
							});
				});
				$.fn.extend({
        		center: function () {
            	return this.each(function () {
                var top = ($(window).height() - $(this).outerHeight()) / 2;
                var left = ($(window).width() - $(this).outerWidth()) / 2;
                $(this).css({
                    position: 'absolute',
                    "z-index": '999999',
                    margin: 0,
                    top: (top > 0 ? top : 0) + 'px',
                    left: (left > 0 ? left : 0) + 'px'
                });
            });
        }
		
    });
	
		</script>
</head>

<body>
<?php 
include("topbarmenu.html");
?>
<div class="perde">
<div class="loading_center"><?php echo $dil["lutfen_bekleyin"]; ?></div>
</div>
<div class="row-fluid">
<div id="information" class="modal alert-danger hide fade in" style="display: none; ">    
<div class="modal-body">  
<h3 class="text-center"></h3>                 
</div>
</div>
<div id="example" class="modal alert-danger hide fade in" style="display: none; ">  
<div class="modal-header">  
<a class="close" data-dismiss="modal">×</a>  
<h3 class="uyari"><?php echo $dil["uyari"]; ?></h3>  
</div>  
<div class="modal-body">  
<h3 class="text-center"></h3>                 
</div>
</div>
<!-- CVV -->
<div id="cvv_box" class="modal hide fade in">  
<div class="modal-header">  
<a class="close" data-dismiss="modal">×</a>  
<h3 class="uyari">C<?php echo $dil["cvv_nedir"]; ?></h3>  
</div>  
<div class="modal-body">  
<p class="text-center"><?php echo $dil["cvv_nedir_text"]; ?></p>
<div class="row-fluid">
<div class="span6">
<p class="text-center"><?php echo $dil["visa_card_arka"]; ?></p>
<img src="../test/img/visa-backside.png">
</div>
<div class="span6">
<p class="text-center"><?php echo $dil["mastercard_card_arka"]; ?></p>
<img src="../test/img/visa-backside.png">
</div>
</div> 
</div>
</div>
<!-- CVV End -->
<!-- Hükümler -->
<div id="general" class="modal hide fade in">  
<div class="modal-header">  
<a class="close" data-dismiss="modal">×</a>  
<h3 class="uyari">Satın alma ile ilgili genel hükümler</h3>  
</div>  
<div class="modal-body">  
<h3>1. Önsöz</h3>
<p>Aşağıdaki hükümler ve koşullar tüm WorkViewer Software ürünleri için geçerlidir.<p>
<h3>2. Memnuniyet garantisi</h3>
<p>Tüm siparişler 7 günlük memnuniyet garantisi ile yapılmaktadır. Tüm ödemeler sipariş yapıldıktan sonra kontrol edilir, ama hesaba geçirilmez. 7 günlük süre dolduktan sonra ödeme tutarı kredi kartı hesabından çekilir.</p>
<p>Herhangi bir sebep belirtmeksizin sipariş yazılı olarak iptal edilebilir. Şüphelenilmesi durumunda müşteri iptal işlemini belirtilen süre içerisinde yaptığını kanıtlamak zorundadır - bu nedenle <p>e-posta ile iptal işlemlerinde tarafımızdan gönderilen onay e-postasını aldığınızdan emin olunuz.</p>
Bu nedenle, fatura ile ödeme durumu söz konusu ise faturanın ödenmemesi yeterli değildir çünkü faturanın ödeme süresi 14 gündür. Eğer 7 gün içerisinde iptal işlemi yapılmışsa faturanın ödeme zorunluluğu ortadan kalkar. Eğer sipariş 7 gün içinde iptal edilmemişse, faturayı ödemeniz gerekir.</p>
<h3>3. Ödeme ve mülkiyet muhafazası</h3>
<p>Alıcı, ürünleri kullanma hakkını sadece satıcıdan alınan tam ödeme makbuzundaki şartnameye göre kullanabilir.</p>
<p>Ödemenin gecikmesi durumunda WorkViewer ana sunucusuna erişim bloke edilebilir.</p>
<p>Kredi kartlarının kötüye kullanılması veya kart limitinin yetersiz olmasından dolayı ödemenin yapılamaması vb. nedeniyle ortaya çıkacak tüm masraflar alıcıya aittir</p>
<p>Kredi kartlarının veya hesap bilgilerinin kötüye kullanılması takip edilecektir.</p>
<p>Tüm faturalarda vergi ve stopaj vergisi dahil değildir. Herhangi bir ek vergi müşteri tarafından ödenmelidir. Banka ve kredi kartı giderleri müşteri tarafından ödenmelidir.</p>
<h3>4. Haklar ve lisanslar</h3>
<p>Alıcı, yazılımı satın aldığında sadece ürünün şartnameye uygun olarak kullanım hakkını elde eder. Tüm yazılım paketlerinin fikri mülkiyet hakları WorkViewer GmbH'de kalır.</p>
<p>Alıcı, gerekli önlemleri alarak ürünün şirket içerisinde lisans anlaşmalarına uygun olarak kullanılacağını sağlamakla yükümlüdür. Bu, özellikle yazılımın yasadışı kopyalanmasını engellemek için geçerlidir.</p>
<p>Lisanslar, lisans bilgilerinde belirtilen sayıdaki iş istasyonu için geçerlidir. Bir lisans bir bilgisayardan diğerine 9 defaya kadar taşınabilir. Bu taşımalar örn. işletim sisteminin yeniden yüklenmesi veya eski bir bilgisayarın yenisi ile değiştirilmesi sırasında kullanılabilir. Kurulumun bir terminal sunucusu üzerine yapılması durumunda lisans kullanıcı tabanlı olur ve her kullanıcı için bir lisans gereklidir. Premium ve Corporate lisansları sınırsız sayıda bilgisayara kurulabilir veya etkinleştirilebilir.
Alıcı, telif haklarının ihlal edilmesi veya yasal olmayan kullanım nedeniyle ortaya çıkabilecek olan tüm zararlardan sorumludur.</p>
<h3>5. Sunucu kullanılabilirliği</h3>
<p>WorkViewer yazılımının iş istasyonu sürümlerinin amacına uygun olarak kullanılması için WorkViewer ana sunucusunun kullanılması gerekli olabilir. Satıcı, sunucunun yüksek bir performans vermesi için gerekli teknik önlemleri alır. Ama kesintisiz bir çalışma garanti edilemez.</p>
<p>Satıcı, satın alma işleminden sonra sunucudan en az 10 yıllık bir süre için yararlanılabileceğini ve satılan sürümle birlikte kullanılabileceğini garanti eder. Eğer bu süre içerisinde aktarım protokolünde bir değişiklik olursa, cihazın sonraki kullanımı için zorunlu olarak gerekli olan güncellemeler müşteriye ücretsiz olarak sağlanır.</p>
<h3>6. Garanti ve sorumluluğun sınırlandırılması</h3>
<p>Garanti süresi, izin verildiği taktirde hizmetin kullanılmaya başlandığı andan itibaren 3 aylık bir süre olarak belirlenmiştir. Bu süre içerisinde müşteri, sözleşmenin muhatabından kaynaklanan eksikliklerin ortaya çıkması durumunda eksikliklerin giderilmesi veya değişiklik isteme hakkına sahiptir.
Garantinin ihlali, (i) yazılımın belirli bir amaca uygunluğu ve (ii) bedel ve ücretlerdeki değişiklikler ve de konferans araması numaralarının sınırlı olması hariç olmak üzere, garantisi verilen bir özelliğin mevcut olmaması ya da sorunlu çalışması durumu olarak tanımlanır. Satın alınan yazılımın yasal olarak ve diğer amaçlara uygun olup olmadığını belirlemek müşterinin sorumluluğundadır ve bu durum sözleşme imzalanmadan önce netliğe kavuşturulmalıdır.</p>
<p>Özellikle teknik nedenlerden dolayı WorkViewer ile istisnasız olarak tüm bilgisayarlara erişim kurulması garanti edilemez. Gelişmiş güvenlik duvarı teknolojileri veya özel ağ yapıları bazı durumlarda bağlantı kalitesini düşürebilir. Bu durum deneme safhasında müşteri tarafından kontrol edilmeli ve eksiklik olarak algılanmamalıdır.
Şayet WorkViewer GmbH eksikliği gideremezse/gidermek istemezse veya değişimi gerçekleştirmezse veya başka nedenlerden dolayı işlem gerçekleşemezse alıcı, satın alma sözleşmesini feshetme veya satış fiyatını uygun bir miktarda indirme hakkına sahiptir.</p>
<p>Müşteri bunun haricinde herhangi bir talepte, özellikle tazminat talebinde bulunamaz. WorkViewer GmbH ve çalışanları hiçbir koşulda doğrudan veya dolaylı olarak, kazancın azalması veya veri kaybı da dahil olmak üzere ortaya çıkan hasarlardan ve bunların sonuçlarından sorumlu tutulamaz. Bu durum, sözleşmenin muhatabı hasarın nedeniyle ilgili başka bir açıklama yapmışsa geçerli değildir. Alıcı özellikle bir yazılım çözümünün tüm veri tabanlarının düzenli olarak saklandığından ve arşivlendiğinden emin olmalıdır. 
Sorumluluk sınırının geçerli olmadığı durumlarda sorumluluk satış fiyatıyla sınırlandırılmıştır.</p>
<h3>7. Veri koruma</h3>
<p>Müşteri bilgileri ad ve ev veya iş adresi şeklinde dahili kullanım amacıyla saklanacaktır.</p>
<h3>8. Son hükümler</h3>
<p>İş adamı veya kamu hukukuna göre tüzel veya özel kişiler için bu sözleşme ilişkisi dolayısıyla doğabilecek bütün anlaşmazlıklar ile ilgili olarak Türkiye'de herhangi bir mahkeme yetkili kılınmamışsa İstanbul mahkemesi yetkilidir.</p>
<p>Sadece Türk hukuku geçerlidir.</p>
<p>Sözleşmede yapılacak değişiklikler yazılı olarak yapılmalıdır.</p>
</div>
</div>
<!-- Hükümler End -->
	<div class="container">
    	<div class="span3">
        	<a href="../homepage">
            	<img class="logo" src="img/logo.png" width="138" height="64" alt="Seçpa Yazılım Logo" />
            </a>
        </div>
        <div class="span9 marginforheader">
        	<ul class="nav nav-pills pull-right">
            	<li><a href="../homepage" title="Seçpa Yazılım"><?php echo $dil["menu1"]; ?></a></li>
                <li><a href="../about" title="Seçpa Yazılım About"><?php echo $dil["menu2"]; ?></a></li>
                <li><a href="../products" title="Seçpa Yazılım Products"><?php echo $dil["menu3"]; ?></a></li>
                <li><a href="../clients" title="Seçpa Yazılım Clients"><?php echo $dil["menu4"]; ?></a></li>
                <li><a href="../download" title="Seçpa Yazılım Download"><?php echo $dil["menu7"]; ?></a></li>
                <li class="active"><a href="../buy" title="Seçpa Yazılım Buy"><?php echo $dil["menu5"]; ?></a></li>
                <li><a href="../contact" title="Seçpa Yazılım Contact"><?php echo $dil["menu6"]; ?></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="row-fluid">
	<div class="container">
	<h1><?php echo $dil["satin_al"]; ?></h1>
    <hr />
    <div class="hide progressbar">
					<div class="text">%0 <?php echo $dil["tamamlandi"]; ?></div>
					<div class="progressbar_inner">
					</div>
				</div>
    <div class="alert alert-info hide" id="shopbox">
    <table class="table">
    	<thead class="text-center">
					<tr>
						<td><b><?php echo $dil["urun"]; ?></b></td>
						<td><b><?php echo $dil["teslimat"]; ?></b></td>
						<td><b><?php echo $dil["fiyat"]; ?></b></td>
					</tr>
		</thead>
        <tbody>
        	<tr>
            	<td style="text-align:left;">
                	<h1 id="packet_name"></h1>
                	<p id="packet_desc"></p>
                    <div class="form-inline">
                    <label class="control-label" for="pc_count_input"><b><?php echo $dil["pc_sayisi"]; ?></b></label>
                    <input type="text" class="input-mini pc_count_input" maxlength="3" />
                    <label class="control-label" for="pc_count"><b><?php echo $dil["lisans_suresi"]; ?></b></label>
                    <select disabled class="input-mini expiry_date_input" name="expiry_date_input">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                    </select>
                    </div>
                    <p class="text-error" style="margin-top:10px"><b>Information: One administrator module with the product which is<br /> priced $ 500.00 is being given for free.</b></p>
                </td>
                <td style="vertical-align:middle">
                	<b><p><?php echo $dil["aktivasyon_text"]; ?></p></b>
                </td>
                <td style="font-size:18px; text-align:right;">
                <b><p><span class="price_text" style="text-align:left; width:270px; display:inline-block"><?php echo $dil["table_fiyat"]; ?> </span><span>:</span><span style="width:150px; display:inline-block;" class="price">0</span></p></b>
                <b><p><span class="server_text" style="width:270px; display:inline-block; text-align:left;"><input style="display:inline-block; width:40px;" class="input-mini adminmodul"  maxlength="3" disabled="disabled" value="1"/> <?php echo $dil["table_admin_price"]; ?> </span><span>:</span><span style="text-decoration:line-through; text-align:right; display:inline-block; width:150px;" class="managermodule">$500,00</span></p></b>
                <b class="text-error"><p><span class="discount_text" style="width:270px; text-align:left; display:inline-block"><?php echo $dil["table_indirim"]; ?> </span><span>:</span><span style="text-align:right; width:150px; display:inline-block;"class="indirim">0</span></p></b>
                <b style="font-size:29px; color:#000;"><p><span class="total_text" style="width:270px; text-align:left; display:inline-block"><?php echo $dil["table_toplam"]; ?> </span><span>:</span><span style="text-align:right; width:150px; display:inline-block;" class="toplam">0</span></p></b>
                </td>
            </tr>
        </tbody>
    </table>
    </div>
    <!-- Sipariş Özeti Start-->
    <div class="row-fluid hide" id="summary">
    	<div class="well well-small">
        	<h2><?php echo $dil["siparis_incele"]; ?></h2>
            <hr />
            <div class="row-fluid">
            <div class="span7">
            	<h3><?php echo $dil["siparis_fatura_bilgileri"]; ?></h3>
                <hr />
                <div class="row-fluid">
                	<div class="span6">
                    	<h4 id="selected_name"></h4>
                        <h4 id="selected_address"></h4>
                        <h4 id="selected_country"></h4>
                        <h4><?php echo $dil["siparis_s_o_y"]; ?><b class="text-info" id="selected_pay_method"></b></h4>
                    </div>
                    <div class="span6">
                    	<p class="text-center"><?php echo $dil["siparis_a_k_g_e_p_a"]; ?></p>
                        <p class="text-center"><b id="selected_email"></b></p>
                    </div>
                </div>
                <hr />
                <h4><?php echo $dil["siparis_tamam_mi"]; ?></h4>
            </div>
            <div class="span5 alert alert-info alertbox2">
            	<h3 class="text-center"><?php echo $dil["alisveris_sepeti"]; ?></h3>
                <img data-src="js/holder.js/432x150/text:Ürün Resmi" id="summary_image"/>
                <h4 class="text-center" style="margin:10px 0px;"><?php echo $dil["siparis_a_i_u"]; ?><b class="text-info" id="selected_product"></b></h4>
                <h4 class="text-center"><?php echo $dil["siparis_o_t_t"]; ?></h4>
                <h1 class="text-center text-success" id="selected_total_price"></h1>
            </div>
            </div>
            <hr />
            <div class="row-fluid">
        	<button disabled="disabled" class="pull-right btn btn-info btn-large disabled finishbilling" style="margin-bottom:10px;"><?php echo $dil["siparisi_tamamla"]; ?></button>
        	<button disabled="disabled" class="pull-left btn btn-warning btn-large disabled editbilling" style="margin-bottom:10px;"><?php echo $dil["siparis_b_d"]; ?></button>  
    		</div>
        </div>
    </div>
    <!-- Sipariş Özeti End-->
    <!-- Sipariş Tamamlandı Start -->
    	<div class="row-fluid siparis_ok hide">
        	<div class="well well-small">
            	<h2><?php echo $dil["siparis_ok"]; ?></h2>
            	<hr />
                <h2><i class="icon-ok-sign text-success icon64"></i><?php echo $dil["siparis_ok_s_no"]; ?><span id="siparis_no"></span>)</h2>
                <h4><?php echo $dil["siparis_ok_s_a_u"]; ?></h4>
                <h2 class="text-info" id="siparis_packet_name"></h2>
                <h3 class="text-success"><?php echo $dil["siparis_ok_total"]; ?> <span id="siparis_toplam"></span></h3>
                <p><?php echo $dil["siparis_ok_kosul"]; ?></p>
				<p><?php echo $dil["siparis_ok_ref"]; ?></p>
				<p><?php echo $dil["siparis_ok_bank"]; ?></p>
                <hr />
                <h2><i class="icon-envelope sign text-info icon64"></i><?php echo $dil["siparis_ok_check_email"]; ?></h2>
                <p><?php echo $dil["siparis_ok_email_sent"]; ?> <b id="siparis_mail"></b></p>
				<p><?php echo $dil["siparis_ok_indirme_linki"]; ?></p>
            </div>
        </div>
    <!-- Sipariş Tamamlandı End -->
<div class="row-fluid hide" id="billing_information">
<div class="span12">
<div class="well well-small">
<h3><?php echo $dil["siparis_fatura_bilgileri"] ?></h3>
<div class="row-fluid">
    	<div class="span12">
        <form class="form">
        <input type="hidden" id="hiddentotal" name="hiddentotal" />
        <input type="hidden" id="hiddenprice" name="hiddenprice" />
        <input type="hidden" id="hiddenindirim" name="hiddenindirim" />
        <input type="hidden" class="hidden" value="Banka Havalesi" id="billing_method" name="billing_method"/>
        <input type="hidden" class="hidden" value="" id="billing_method_bank" name="billing_method_bank"/>
        <input type="hidden" class="hidden" value="" id="billing_price" name="billing_price"/>
        <input type="hidden" class="hidden" value="" id="billing_packet_name" name="billing_packet_name"/>
        <input type="hidden" class="hidden" value="Satış" id="subject" name="subject"/>
        <input type="hidden" class="hidden" value="<?php echo $siparisno; ?>" id="order_code" name="order_code" />
        <input type="hidden" class="hidden" value="<?php echo $sifrelimetin; ?>" id="reference_code" name="reference_code" />
        <div class="form-inline">
            <label class="control-label" style="text-align:left; float:left; font-weight:bold; width:100px; display:inline-block; margin-top:5px;" for="inputEmail"><?php echo $dil["fatura_tipi"] ?></label>
              <label class="radio inline">
              <input type="radio" name="optionsRadios" id="optionsRadios1" value="1" checked />
              <?php echo $dil["sahis"] ?>
            </label>
            <label class="radio inline">
              <input type="radio" name="optionsRadios" id="optionsRadios2" value="2" />
              <?php echo $dil["sirket"] ?>
            </label>
          </div>
		</div>
        </div>
<div class="row-fluid">
	<div class="span4">
    	<div class="control-group">
            <label class="control-label" style="text-align:left; font-weight:bold;" for="inputEmail"><?php echo $dil["tam_adiniz"] ?></label>
            <div class="controls">
              <input type="text" class="input-block-level" name="userfullname"  id="userfullname" placeholder="<?php echo $dil["tam_adiniz"] ?>" />
            </div>
          </div>
         <div class="control-group">
            <label class="control-label" style="text-align:left; font-weight:bold;" for="inputPassword"><?php echo $dil["e_posta_adresi"] ?></label>
            <div class="controls">
              <input type="text" class="input-block-level" name="useremail" id="useremail" placeholder="<?php echo $dil["e_posta_adresi"] ?>" />
            </div>
          </div> 
         <div class="control-group">
            <label class="control-label" style="text-align:left; font-weight:bold;" for="inputPassword"><?php echo $dil["telefon_no"] ?></label>
            <div class="controls">
              <input type="text" class="input-block-level" name="usertelephone" id="usertelephone" placeholder="<?php echo $dil["telefon_no"] ?>" />
            </div>
          </div>
    </div>
    <div class="span4 forcompany">
    	<div class="control-group">
            <label class="control-label" style="text-align:left; font-weight:bold;" for="inputEmail"><?php echo $dil["sirket_adi"] ?></label>
            <div class="controls">
              <input type="text" disabled="disabled" class="input-block-level disabled"  name="usercompanyname"  id="usercompanyname" placeholder="<?php echo $dil["sirket_adi"] ?>" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" style="text-align:left; font-weight:bold;" for="inputEmail"><?php echo $dil["vergi_dairesi"] ?></label>
            <div class="controls">
              <input type="text" disabled="disabled" class="input-block-level disabled" name="usertaxoffice"  id="usertaxoffice" placeholder="<?php echo $dil["vergi_dairesi"] ?>" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" style="text-align:left; font-weight:bold;" for="inputEmail"><?php echo $dil["vergi_numarasi"] ?></label>
            <div class="controls">
              <input type="text" disabled="disabled" class="input-block-level disabled" name="usertaxnumber"  id="usertaxnumber" placeholder="<?php echo $dil["vergi_numarasi"] ?>" />
            </div>
          </div>
    </div>
    <div class="span4">
    <div class="control-group">
            <label class="control-label" style="text-align:left; font-weight:bold;" for="inputPassword"><?php echo $dil["ulke"] ?></label>
            <div class="controls">
              <input type="text" class="input-block-level" name="usercountry" data-provide="typeahead" autocomplete="off" data-items="4" id="usercountry" placeholder="<?php echo $dil["ulke"] ?>" />
            </div>
          </div>
          <div class="control-group hide">
            <label class="control-label" style="text-align:left; font-weight:bold;" for="inputPassword"><?php echo $dil["il"] ?></label>
            <div class="controls">
              <input type="text" class="input-block-level" name="usercity" data-provide="typeahead" autocomplete="off" data-items="4" id="usercity" placeholder="<?php echo $dil["il"] ?>" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" style="text-align:left; font-weight:bold;" for="inputPassword"><?php echo $dil["adres"] ?></label>
            <div class="controls">
              <textarea style="height:90px;" class="input-block-level" name="useraddress" id="useraddress" placeholder="<?php echo $dil["adres"] ?>"></textarea>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" style="text-align:left; font-weight:bold;" for="inputPassword"><?php echo $dil["ozel_mesaj"] ?></label>
            <div class="controls">
              <textarea style="height:90px;" class="input-block-level" name="userpm" id="userpm" placeholder="<?php echo $dil["ozel_mesaj"] ?>"></textarea>
            </div>
          </div>
    </div>
</div>
</div>
</div>

    <div class="row-fluid">
<div class="well well-small">
<ul class="nav nav-tabs">
  <li class="active"><a href="#havale" id="havale_link" data-toggle="tab"><?php echo $dil["havale_ile_ode"] ?></a></li>
  <li><a href="#kredikarti" id="kredikarti_link" data-toggle="tab"><?php echo $dil["kredi_karti_ile_ode"] ?></a></li>
</ul>
<div class="tab-content">
<div class="tab-pane active" id="havale">
 <h3><?php echo $dil["havale_ile_ode"] ?></h3>
 <div class="row-fluid">
 <?php 
 $sql=mysql_query("select * from secpa_banks where BankAccountType like '%Dollar%' order by BankName");
 while($row=mysql_fetch_object($sql)){
	 $bankid=$row->BankId;
 ?>
 <div class="span4 banklist alert">
 <h3 style="color:#000;">
 <span class="bankimage" id="<?php if($bankid==1 || $bankid==4) echo "chooseakbankimage";if($bankid==2 || $bankid==5) echo "choosefinansbankimage";if($bankid==3) echo "choosegarantiimage"; ?>"></span>
 <span class="btn btn-danger pull-right" style="margin-top:15px;" id="<?php if($bankid==1 || $bankid==4) echo "chooseakbank";if($bankid==2) echo "choosefinansbank";if($bankid==3) echo "choosegaranti"; ?>"><?php echo $dil["sec"] ?>
 </span>
 </h3>
 <p class="text-info"><b style="min-width:100px; display:inline-block"><?php echo $dil["hesap_sahibi"] ?></b><span><?php echo $row->BankAccountOwner; ?></span></p>
 <p class="text-info"><b style="min-width:100px; display:inline-block"><?php echo $dil["sube_kodu"] ?></b><span><?php echo $row->BankBranchCode; ?></span></p>
 <p class="text-info"><b style="min-width:100px; display:inline-block"><?php echo $dil["hesap_no"] ?></b><span><?php echo $row->BankAccountNumber; ?></span></p>
 <p class="text-info"><b style="min-width:100px; display:inline-block"><?php echo $dil["hesap_cinsi"] ?></b><span><?php echo $row->BankAccountType; ?></span></p>
 <p class="text-info"><b style="min-width:100px; display:inline-block"><?php echo $dil["iban"] ?></b><span><?php echo $row->BankIban; ?></span></p> 
 </div>
 <?php 
 }
 ?>
 </div>
</div>
<div class="tab-pane" id="kredikarti">
          <h3><?php echo $dil["kredi_karti_ile_ode"] ?></h3>
          <hr />
          <div class="row-fluid">
                        <ul class="unstyled cards span5">
                        <div class="span10" style="margin-top:10px; margin-left:2.564102564102564%;">
                        <label for="card_number"><?php echo $dil["kart_no"] ?></label>
                        <input type="text" name="card_number" class="input-xlarge" placeholder="Kart Numarası" maxlength="16" id="card_number" />
                        </div>
                        <div class="span4">
                        <label for="expiry_date"><?php echo $dil["skt"] ?> <small>aa/yy</small></label>
                        <input type="text" name="expiry_date" class="input-mini" placeholder="01/01" id="expiry_date" maxlength="5" />
                        </div>
                        <div class="span4">
                        <label for="cvv"><?php echo $dil["cvv"] ?> <a data-toggle="modal" style="font-weight:bold;" href="#cvv_box">?</a></label>
                        <input type="text" name="cvv" class="input-mini" placeholder="CVV" id="cvv" maxlength="3" />
                        </div>
                        <div class="span10">
                        <label for="name_on_card"><?php echo $dil["kui"] ?></label>
                        <input type="text" class="input-xlarge" placeholder="Ad Soyad" name="name_on_card" id="name_on_card" />
                        </div>
                        <div class="span10">
                        <li class="visa">Visa</li>
                        <li class="visa_electron">Visa Electron</li>
                        <li class="mastercard">MasterCard</li>
                        <li class="maestro">Maestro</li>
                        <li class="discover">Discover</li>
                        </div>
                        </ul>
                        <div class="alert alert-info banka hide span7 text-center"></div>
           </div>
                        <p>
                        <i style="font-size:16px;" class="icon-lock"></i> <?php echo $dil["kk_text"] ?>
                        </p>
          </div>
</div>
</div>
</form>
</div>
</div>
    <div class="container buttons hide">
        <button disabled="disabled" class="pull-right btn btn-info btn-large disabled goon" style="margin-bottom:10px;"><?php echo $dil["devam_et"]; ?></button>
        <button class="pull-left btn btn-danger btn-large gobackbaby" style="margin-bottom:10px;"><?php echo $dil["geri_don"]; ?></button>  
    </div>
    <div class="row-fluid">
    <div class="container">
    <ul class="thumbnails">
  	<li class="span6">
    <div class="thumbnail">
      <img data-src="js/holder.js/560x300/text:Work Viewer" width="360" height="300" src="img/worklogo.png" alt="Work Viewer" />
      <h1 class="text-center">Work Viewer</h1>
      <p><?php echo $dil["urunler_wv_text"]; ?></p>
      <p class="text-center"><span class="btn btn-success btn-large" style="margin-right:10px;" id="buyworkviewer"><?php echo $dil["satin_al"]; ?></span><span class="btn btn-warning btn-large" id="renewworkviewer"><?php echo $dil["lisans_yenile"]; ?></span></p>
    </div>
  </li>
  <li class="span6">
    <div class="thumbnail">
      <img data-src="js/holder.js/560x300/text:Kids Viewer" width="360" height="300" src="img/kidslogo.png" alt="Kids Viewer" />
      <h1 class="text-center">Kids Viewer</h1>
      <p style="height:60px;"><?php echo $dil["urunler_kv_text"]; ?></p>
      <p class="text-center"><span class="btn btn-success btn-large" style="margin-right:10px;" id=""><?php echo $dil["satin_al"]; ?></span><span class="btn btn-warning btn-large" id="renewkidsviewer"><?php echo $dil["lisans_yenile"]; ?></span></p>
    </div>
  </li>
</ul>
    </div>
    </div>
</div>
</div>
</div>

<?php 
include("footer.php");
?>
</body>
</html>


