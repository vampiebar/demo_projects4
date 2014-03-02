<?php
sleep(2);
include("config.php");
function HTMLMail($gidecekMail,$gonderenAd,$gonderenMail,$konu,$mesaj) {
    $headers  = "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/html; charset=UTF-8\n";
    $headers .= "X-Mailer: PHP\n";
    $headers .= "X-Sender: PHP\n";
    $headers .= "From: $gonderenAd<$gonderenMail>\n";
    $headers .= "Reply-To: $gonderenAd<$gonderenMail>\n";
    $headers .= "Return-Path: $gonderenAd<$gonderenMail>\n";
    $gonder = mail($gidecekMail,$konu,$mesaj,$headers);
}
$username = mysql_real_escape_string($_POST["userfullname"]);
$email = mysql_real_escape_string($_POST["useremail"]);
$companyname = mysql_real_escape_string($_POST["usercompanyname"]);
$country = mysql_real_escape_string($_POST["usercountry"]);
$city = mysql_real_escape_string($_POST["usercity"]);
$phone = mysql_real_escape_string($_POST["usertelephone"]);
$taxoffice = mysql_real_escape_string($_POST["usertaxoffice"]);
$taxnumber = mysql_real_escape_string($_POST["usertaxnumber"]);
$billingaddress = nl2br(mysql_real_escape_string($_POST["useraddress"]));
$bankname = mysql_real_escape_string($_POST["billing_method_bank"]);
$fiyat =str_replace(",","",ltrim($_POST["billing_price"],"$"));
$yontem = mysql_real_escape_string($_POST["billing_method"]);
$paket = mysql_real_escape_string($_POST["billing_packet_name"]);
$pm = mysql_real_escape_string($_POST["userpm"]);
$billing_type = mysql_real_escape_string($_POST["optionsRadios"]);
$subject = mysql_real_escape_string($_POST["subject"]);
$order_code = mysql_real_escape_string($_POST["order_code"]);
$reference_code = mysql_real_escape_string($_POST["reference_code"]);
$licence_period = mysql_real_escape_string($_POST["expiry_date_input"]);
$bugun = date("Y-m-d H:i:s");
if($licence_period=="1"){
$yenitarih = strtotime('1 year',strtotime($bugun));
$yenitarih = date("Y-m-d H:i:s",$yenitarih);
}
if($licence_period=="2"){
$yenitarih = strtotime('2 year',strtotime($bugun));
$yenitarih = date("Y-m-d H:i:s",$yenitarih);
}
if($licence_period=="3"){
$yenitarih = strtotime('3 year',strtotime($bugun));
$yenitarih = date("Y-m-d H:i:s",$yenitarih);
}
if($billing_type==1){ $billing_type="Şahıs"; }
if($billing_type==2){ $billing_type="Şirket"; }
if($paket=="PC İzleme ve Kontrol Yazılımı"){ $fiyat="49,00 TL";}
if($bankname=="Garanti"){ $bankname="Garanti Bankası"; }
if($username!="" && $phone!="" && $email!=""){
	$sql=mysql_query("insert into secpa_buying (BuyBankName,BuyUsername,BuyCompanyName,BuyEmail,BuyCountry,BuyCity,BuyPhone,BuyTaxOffice,BuyTaxNumber,BuyBillingAddress,BuyPrice,BuyPacketName,BuyMethod,BuyBillingPm,BuyBillingType,BuyOrderCode,BuyReferenceCode,BuyDate,BuyLicencePeriod,BuyLicenceExpiryDate) values ('$bankname','$username','$companyname','$email','$country','$city','$phone','$taxoffice','$taxnumber','$billingaddress','$fiyat','$paket','$yontem','$pm','$billing_type','$order_code','$reference_code','$bugun','$licence_period','$yenitarih')");
	if($sql){
	if($yontem=="Banka Havalesi"){
	$banka=mysql_query("select * from secpa_banks where BankName like '%$bankname%'");
	$hesapadi=mysql_result($banka,0,"BankAccountOwner");
	$subekodu=mysql_result($banka,0,"BankBranchCode");
	$hesapno=mysql_result($banka,0,"BankAccountNumber");
	$hesaptipi=mysql_result($banka,0,"BankAccountType");
	$iban=mysql_result($banka,0,"BankIban");
	$fiyat=number_format($fiyat,2,",",".");
	$gonder_isim="Seçpa Yazılım";
	$gonder_mail= "info@secpayazilim.com";
	$alan_isim=$username;
	$alan_mail=$email;
	$baslik="Seçpa Yazılım Bilgilendirme";
	$mesaj='
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td style="padding: 0 0 30px 0;">
				<!-- Table1 -->
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="800" style="border: 1px solid #cccccc; border-collapse: collapse;">
					<tr>
						<td align="center" bgcolor="#70bbd9" style="padding: 40px 0 30px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
							<img src="http://www.secpayazilim.com/deneme/img/logo.png" alt="Seçpa Yazılım" width="138" height="64" style="display: block;" />
						</td>
					</tr>
					<tr>
						<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
										<b>Hello '.$alan_isim.'</b>
									</td>
								</tr>
								<tr>
									<td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
										You wanted to purchase our '.$paket.' software for $'.$fiyat.' fee. You have choosed bank transfer method by '.$bankname.'. Bank transfer information may be found below.
									</td>
								</tr>
								<tr>
									<td>
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
														<tr>
															<td>
																Account Name:
															</td>
															<td>'.$hesapadi.'</td>
														</tr>
														<tr>
															<td>
																Branch Code:
															</td>
															<td>'.$subekodu.'</td>
														</tr>
														<tr>
															<td>
																Acoount Number:
															</td>
															<td>'.$hesapno.'</td>
														</tr>
														<tr>
															<td>
																Acoount Type:
															</td>
															<td>'.$hesaptipi.'</td>
														</tr>
														<tr>
															<td>
																IBAN No:
															</td>
															<td>'.$iban.'</td>
														</tr>
													</table>
													<div>Transaction is currently pending for approval.</div>
													<div>Approval transaction will take place when you transfer amounting to '.$fiyat.' to our bank account.</div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#ee4c50" style="padding: 30px 30px 30px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;" width="75%">
										&reg; Seçpa Soft, İstanbul 2013<br/>
									</td>
									<td align="right" width="25%">
										<table border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
													<a href="https://www.facebook.com/pages/SE%C3%87PA-Yaz%C4%B1l%C4%B1m-ve-Internet-Teknolojileri/342695639180567?fref=ts" style="color: #ffffff;">
														<img src="http://www.nightjar.com.au/tests/magic/images/tw.gif" alt="Twitter" width="38" height="38" style="display: block;" border="0" />
													</a>
												</td>
												<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
												<td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
													<a href="https://www.facebook.com/pages/SE%C3%87PA-Yaz%C4%B1l%C4%B1m-ve-Internet-Teknolojileri/342695639180567?fref=ts" style="color: #ffffff;">
														<img src="http://www.nightjar.com.au/tests/magic/images/fb.gif" alt="Facebook" width="38" height="38" style="display: block;" border="0" />
													</a>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<!-- Table1 -->
			</td>
		</tr>
	</table>
	';
	$mesajtous='
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td style="padding: 0 0 30px 0;">
				<!-- Table1 -->
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="800" style="border: 1px solid #cccccc; border-collapse: collapse;">
					<tr>
						<td align="center" bgcolor="#70bbd9" style="padding: 40px 0 30px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
							<img src="http://www.secpayazilim.com/deneme/img/logo.png" alt="Seçpa Yazılım" width="138" height="64" style="display: block;" />
						</td>
					</tr>
					<tr>
						<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
										<b>Merhaba Seçpa Soft</b>
									</td>
								</tr>
								<tr>
									<td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
										'.$paket.' adlı yazılımımızı $'.$fiyat.' karşılığında satın almak isteyen '.$username.' ile ilgili bilgiler aşağıdadır.
									</td>
								</tr>
								<tr>
									<td>
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
														<tr>
															<td>
																Adı ve Soyadı:
															</td>
															<td>'.$username.'</td>
														</tr>
														<tr>
															<td>
																E-posta adresi:
															</td>
															<td>'.$email.'</td>
														</tr>
														<tr>
															<td>
																Telefon Numarası:
															</td>
															<td>'.$phone.'</td>
														</tr>
														<tr>
															<td>
																Fiyat:
															</td>
															<td>'.$fiyat.'</td>
														</tr>
														<tr>
															<td>
																Ödeme Yöntemi:
															</td>
															<td>'.$yontem.'</td>
														</tr>
													</table>
													<div>Şu anda onay işleminiz beklemededir.</div>
													<div>'.$fiyat.' TL tutarındaki ücreti onaylamak için <a href="http://www.secpayazilim.com/login">Seçpa Yazılım Admin Girişine</a>\'ne gidin.</div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#ee4c50" style="padding: 30px 30px 30px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;" width="75%">
										&reg; Seçpa Yazılım, İstanbul 2013<br/>
									</td>
									<td align="right" width="25%">
										<table border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
													<a href="https://www.facebook.com/pages/SE%C3%87PA-Yaz%C4%B1l%C4%B1m-ve-Internet-Teknolojileri/342695639180567?fref=ts" style="color: #ffffff;">
														<img src="http://www.nightjar.com.au/tests/magic/images/tw.gif" alt="Twitter" width="38" height="38" style="display: block;" border="0" />
													</a>
												</td>
												<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
												<td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
													<a href="https://www.facebook.com/pages/SE%C3%87PA-Yaz%C4%B1l%C4%B1m-ve-Internet-Teknolojileri/342695639180567?fref=ts" style="color: #ffffff;">
														<img src="http://www.nightjar.com.au/tests/magic/images/fb.gif" alt="Facebook" width="38" height="38" style="display: block;" border="0" />
													</a>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<!-- Table1 -->
			</td>
		</tr>
	</table>
	';
	$mailtanim = "MIME-Version: 1.0\r\n"; // bu kısım tanımlama kısmı
	$mailtanim .= "Content-type: text/html; charset=utf-8\r\n";
	$mailtanim .= "From: Seçpa Yazılım <$gonder_mail>\r\n";
	$mailtanim .= "Reply-To: Seçpa Yazılım <$gonder_mail>\r\n";
	$mailgonder = mail($alan_mail,$baslik,stripslashes($mesaj),$mailtanim);
	HTMLMail("info@secpayazilim.com", iconv("utf-8","iso-8859-9","Seçpa Soft"), "no-reply@secpayazilim.com", "Seçpa Soft Satış Bilgilendirme",$mesajtous);
	}
	if($mailgonder){
	echo "Aferin";
	}else{
		echo "Mail gönderilemedi";
		}
}else{
	echo "Sorguda bişey var";
}
}else{
	header("location:../anasayfa");
	}
?>