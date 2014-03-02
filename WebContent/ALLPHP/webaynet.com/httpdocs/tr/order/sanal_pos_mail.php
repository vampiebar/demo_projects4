<?
if(!isset($VT)) { die("Unauthorized access. #3"); } else { echo "<!-- Access Granted #P3 !-->"; }
if(@$authcode == "") { $authcode = "Anahtar alinamadi, lutfen info@webaynet.com ile iletisime gecin."; }
$MailDone = false;
$WorkingDir = "a_test";
$SMailTo = $mail;
$Subject = "Kurulum Bilgileri";
$Headers = "MIME-Version: 1.0" . "\r\n";
$Headers.= "Content-type:text/html;charset=iso-8859-9" . "\r\n";
$Headers.= 'From: WEBAYNET Software <register@webaynet.com>' . "\r\n";
$Headers.= 'Reply-to: <info@webaynet.com>' . "\r\n";
$Headers.= 'BCC: bulentseker@gmail.com,info@webaynet.com,engin.mihcioglu@gmail.com' . "\r\n";
$Content = file_get_contents("mailtemplate/sp_".strtolower($softname).".html");
$Content = str_replace("src=\"","src=\"http://www.webaynet.com/".$WorkingDir."/mailtemplate/",$Content);
$Content = str_replace("background=\"","background=\"http://www.webaynet.com/".$WorkingDir."/mailtemplate/",$Content);
$Content = str_replace("{CCNAME}",$ccname,$Content);
$Content = str_replace("{SOFTNAME}",$softname,$Content);
$Content = str_replace("{ACODE}",$authcode,$Content);
$Content = str_replace("{ORDER}",$oid,$Content);
$Content = str_replace("{FA}",$Mail['UN'],$Content);
$Content = str_replace("{VD}",$Mail['VD'],$Content);
$Content = str_replace("{VN}",$Mail['VN'],$Content);
$Content = str_replace("{NM}",$Mail['NM'],$Content);
$Content = str_replace("{CO}",$Mail['CO'],$Content);
$Content = str_replace("{CI}",$Mail['CI'],$Content);
$Content = str_replace("{TL}",$Mail['TL'],$Content);
$Content = str_replace("{PK}",$Mail['PK'],$Content);
$Content = str_replace("{A1}",$Mail['A1'],$Content);
$Content = str_replace("{A2}",$Mail['A2'],$Content);
$Content = str_replace("{A3}",$Mail['A3'],$Content);
$Content = str_replace("{LOCALIP}",$HTTP_SERVER_VARS["REMOTE_ADDR"],$Content);
$Content = str_replace("{ITEMTOTAL}","(for ".$itotal." PC)",$Content);

if(@mail($SMailTo,$Subject,$Content,$Headers)) {
	$MailDone = true;
} else {
	$MailDone = false;
}
?>