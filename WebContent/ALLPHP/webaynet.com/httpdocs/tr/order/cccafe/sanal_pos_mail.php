<?
if(@$_POST['cardno'] == "") { die("Unauthorized Access"); }
$MailDone = false;
$WorkingDir = "tr/order/cccafe";
$Subject = "TIB CAFESÜRÜMÜ KREDI KARTI ILE SIPARIS FORMU";
$Headers = "MIME-Version: 1.0" . "\r\n";
$Headers.= "Content-type:text/html;charset=iso-8859-9" . "\r\n";
$Headers.= 'From: WEBAYNET Software <register@webaynet.com>' . "\r\n";
$Headers.= 'Reply-to: <info@webaynet.com>' . "\r\n";
$Headers.= 'BCC: bulentseker@gmail.com,info@webaynet.com,engin.mihcioglu@gmail.com' . "\r\n";

$Mail['UN'] = $_POST['unvan'];
$Mail['VD'] = $_POST['vdaire'];
$Mail['VN'] = $_POST['vno'];
$Mail['NM'] = $_POST['Adi'];
$Mail['CO'] = $_POST['pr_ulke'];
$Mail['CI'] = $_POST['sehir'];
$Mail['CC'] = $_POST['ilce'];
$Mail['A1'] = $_POST['adres'];
$Mail['A2'] = $_POST['adres_sec'];
$Mail['A3'] = $_POST['adres_thi'];
$Mail['PK'] = $_POST['zip'];
$Mail['TL'] = $_POST['telefon'];
$Mail['EP'] = $_POST['email'];
$Mail['GS'] = $_POST['GSM'];
$Mail['IP'] = $_POST['ip'];

$Content = file_get_contents("mailtemplate/sp_ccnetkafe.html");
$Content = str_replace("src=\"","src=\"http://www.webaynet.com/".$WorkingDir."/mailtemplate/",$Content);
$Content = str_replace("background=\"","background=\"http://www.webaynet.com/".$WorkingDir."/mailtemplate/",$Content);
$Content = str_replace("{CCNAME}",$ccname,$Content);
$Content = str_replace("{SOFTNAME}",$softname,$Content);
$Content = str_replace("{ACODE}",$authcode,$Content);
$Content = str_replace("{ORDER}",$oid,$Content);
$Content = str_replace("{FA}",$Mail['UN'],$Content);
$Content = str_replace("{VD}",$Mail['VD'],$Content);
$Content = str_replace("{VN}",$Mail['VN'],$Content);
$Content = str_replace("{A1}",$Mail['A1'],$Content);
$Content = str_replace("{A2}",$Mail['A2'],$Content);
$Content = str_replace("{A3}",$Mail['A3'],$Content);
$Content = str_replace("{TL}",$Mail['TL'],$Content);
$Content = str_replace("{PK}",$Mail['PK'],$Content);
$Content = str_replace("{NM}",$Mail['NM'],$Content);
$Content = str_replace("{CO}",$Mail['CO'],$Content);
$Content = str_replace("{CI}",$Mail['CI'],$Content);
$Content = str_replace("{CC}",$Mail['CC'],$Content);
$Content = str_replace("{EP}",$Mail['EP'],$Content);
$Content = str_replace("{GS}",$Mail['GS'],$Content);
$Content = str_replace("{IP}",$Mail['IP'],$Content);
$Content = str_replace("{LOCALIP}",$HTTP_SERVER_VARS["REMOTE_ADDR"],$Content);
$Content = str_replace("{ITEMTOTAL}","(for ".$itotal." PC)",$Content);

if(@mail($SMailTo,$Subject,$Content,$Headers)) {
	$MailDone = true;
} else {
	$MailDone = false;
}
?>