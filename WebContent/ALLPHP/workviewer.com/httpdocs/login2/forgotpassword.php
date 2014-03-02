<?php 
ob_start();
session_start();
sleep(3);
include("config.php"); 
$username=$_POST["email"];
$sql=pg_query("select * from registered_users where user_name='$username'");
$num=pg_num_rows($sql);
while($rows=pg_fetch_object($sql)){
	$dbpassword = $rows->user_pass;
	$company_person_name = $rows->company_person_name;
}
if($num==0){
	echo "yok";
}else{
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
HTMLMail("$username", iconv("utf-8","iso-8859-9","Workviewer"), "no-reply@secpayazilim.com", "Workviewer Şifreniz", '<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td style="padding: 0 0 30px 0;">
				<!-- Table1 -->
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="800" style="border: 1px solid #cccccc; border-collapse: collapse;">
					<tr>
						<td align="center" bgcolor="#70bbd9" style="padding: 10px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
							<img src="http://workviewer.com/login/images/work_login.png" alt="Workviewer" width="200" height="64" style="display: block;" />
							<h5>Workviewer Yönetici Giriş Bilgileri</h5>
						</td>
					</tr>
					<tr>
						<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
										<b>Merhaba '.$company_person_name.'</b>
									</td>
								</tr>
								<tr>
									<td>Kullanıcı bilgileriniz aşağıdadır.
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
														<tr>
															<td>
																Kullanıcı Adınız:
															</td>
															<td>'.$username.'</td>
														</tr>
														<tr>
															<td>
																Şifreniz:
															</td>
															<td>'.$dbpassword.'</td>
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
	}
?>
