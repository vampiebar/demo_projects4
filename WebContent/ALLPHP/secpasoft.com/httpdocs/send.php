<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$ad=$_POST["inputname"];
$email=$_POST["inputemail"];
$mesaj=$_POST["contactmessage"];
if($_POST){
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
HTMLMail("info@secpayazilim.com", iconv("utf-8","iso-8859-9","Seçpa Yazılım"), "no-reply@secpayazilim.com", "Seçpa Yazılım İletişim Formu", '<table border="0" cellpadding="0" cellspacing="0" width="100%">
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
										<b>Merhaba Seçpa Yazılım</b>
									</td>
								</tr>
								<tr>
									<td>
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
														<tr>
															<td>
																Adı:
															</td>
															<td>'.$ad.'</td>
														</tr>
														<tr>
															<td>
																E-posta adresi:
															</td>
															<td>'.$email.'</td>
														</tr>
														<tr>
															<td>
																Mesaj:
															</td>
															<td>'.$mesaj.'</td>
														</tr>
													</table>
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
		');
if(HTMLMail){
	echo "ok";
	}
}else{
	header("location:../anasayfa");
	}
?>