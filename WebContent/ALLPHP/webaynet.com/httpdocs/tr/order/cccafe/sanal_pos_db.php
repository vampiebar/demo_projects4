<?
if(!isset($_POST['cardno'])) { die("Unauthorized Access"); }
@session_start();
// Import MySQL Class
include_once("mysql_connection.php");

$DBServ['TIB'] = "localhost";
$DBUser['TIB'] = "tibcafe";
$DBPass['TIB'] = "11012007";
$DBName['TIB'] = "tib";

$DBServ['WEB'] = "register.webaynet.com";
$DBUser['WEB'] = "filteruser";
$DBPass['WEB'] = "!dadi!2006";
$DBName['WEB'] = "wfilter";

$Sehir['1'] = "Istanbul";		$Sehir['2'] = "Ankara"; 		$Sehir['3'] = "Izmir";		$Sehir['4'] = "Adana";
$Sehir['5'] = "Adiyaman"; 		$Sehir['6'] = "Afyon";			$Sehir['7'] = "Agri"; 		$Sehir['8'] = "Aksaray";
$Sehir['9'] = "Amasya";			$Sehir['10'] = "Antalya";		$Sehir['11'] = "Ardahan";	$Sehir['12'] = "Artvin";	
$Sehir['13'] = "Aydin";			$Sehir['14'] = "Balikesir";		$Sehir['15'] = "Bartin";	$Sehir['16'] = "Batman";
$Sehir['17'] = "Bayburt";		$Sehir['18'] = "Bilecik";		$Sehir['19'] = "Bingöl";	$Sehir['20'] = "Bitlis";
$Sehir['21'] = "Bolu";			$Sehir['22'] = "Burdur";		$Sehir['23'] = "Bursa";		$Sehir['24'] = "Çanakkale";
$Sehir['25'] = "Çankiri";		$Sehir['26'] = "Çorum";			$Sehir['27'] = "Denizli";	$Sehir['28'] = "Diyarbakir";
$Sehir['29'] = "Edirne";		$Sehir['30'] = "Elazig";		$Sehir['31'] = "Erzincan";	$Sehir['32'] = "Erzurum";
$Sehir['33'] = "Eskisehir";		$Sehir['34'] = "Gaziantep"; 	$Sehir['35'] = "Giresun"; 	$Sehir['36'] = "Gümüshane";
$Sehir['37'] = "Hakkari"; 		$Sehir['38'] = "Hatay"; 		$Sehir['39'] = "Igdir";		$Sehir['40'] = "Isparta";
$Sehir['41'] = "Içel";			$Sehir['42'] = "Kars";			$Sehir['43'] = "Kastamonu";	$Sehir['44'] = "Kayseri";
$Sehir['45'] = "Kirikkale";		$Sehir['46'] = "Kirklareli";	$Sehir['47'] = "Kirsehir";	$Sehir['48'] = "Kocaeli";
$Sehir['49'] = "Konya";			$Sehir['50'] = "Kütahya";		$Sehir['51'] = "Malatya";	$Sehir['52'] = "Manisa";
$Sehir['53'] = "Kahramanmaras"; $Sehir['54'] = "Karabük";		$Sehir['55'] = "Karaman";	$Sehir['56'] = "Kilis";
$Sehir['57'] = "Mardin";		$Sehir['58'] = "Mugla";			$Sehir['59'] = "Mus";		$Sehir['60'] = "Nevsehir";
$Sehir['61'] = "Nigde";			$Sehir['62'] = "Ordu";			$Sehir['63'] = "Osmaniye";	$Sehir['64'] = "Rize";
$Sehir['65'] = "Sakarya";		$Sehir['66'] = "Samsun";		$Sehir['67'] = "Siirt";		$Sehir['68'] = "Sinop";
$Sehir['69'] = "Sivas";			$Sehir['70'] = "Tekirdag";		$Sehir['71'] = "Tokat";		$Sehir['72'] = "Trabzon";
$Sehir['73'] = "Tunceli";		$Sehir['74'] = "Sanliurfa";		$Sehir['75'] = "Sirnak";	$Sehir['76'] = "Usak";
$Sehir['77'] = "Van";			$Sehir['78'] = "Yalova";		$Sehir['79'] = "Yozgat";	$Sehir['80'] = "Zonguldak";
$Sehir['81'] = "Düzce";

$ErrorType = "none";
$SQLActions = $TibSQL = "failed";
$Cafe['KA'] = $_POST['Adi'];
$Cafe['CA'] = $_POST['unvan'];
$Cafe['EP'] = $_POST['eposta'];
$Cafe['TN'] = $_POST['telefon'];
$Cafe['IP'] = $_POST['ip'];
$Cafe['PC'] = $_POST['ADET'];
$Cafe['GN'] = $_POST['GSM'];
$Cafe['IL'] = $Sehir[$_POST['il']];
$Cafe['IE'] = $_POST['ilce'];
$Cafe['VD'] = $_POST['vdaire'];
$Cafe['VN'] = $_POST['vno'];
$Cafe['A1'] = $_POST['adres'];
$Cafe['A2'] = $_POST['adres_sec'];
$Cafe['A3'] = $_POST['adres_thi'];
$Cafe['AD'] = $Cafe['A1']." ".$Cafe['A2']." ".$Cafe['A3'];
$Cafe['MS'] = $_POST['mesaj'];
$itotal		= $_POST['ADET'];

foreach($Cafe as $UnitID => $K) {
	$Kafe[$UnitID] = strtoupper($K);
}

if($rr_vt = new bf_vt($DBServ['TIB'],$DBUser['TIB'],$DBPass['TIB'],$DBName['TIB'])) {
		$query = "INSERT INTO `kullanicibilgileri` (`kullaniciId` ,`isletmeAd` ,`IP` ,`adres` ,`telefon` ,`faks` ,`ilce` ,`il`) VALUES ( NULL , '".$Kafe['CA']."', '".$Kafe['IP']."', '".$Kafe['AD']."', '".$Kafe['TN']."', '".$Kafe['GN']."', '".$Kafe['IE']."', '".$Kafe['IL']."' );";
		$rr_vt->bf_vt_sqlsorgu($query);
		$query = "SELECT * FROM `kullanicibilgileri`";
		$sorgu = $rr_vt->bf_vt_sqlsorgu($query);
		if($rr_vt->bf_vt_numrows($sorgu)){
			$P = $rr_vt->bf_vt_sqldongu();
			$T = count($P);	$T--;
			$UserID = $P[$T]['kullaniciId'];
			$SQLActions = $TibSQL = "success";
			$TD = true;
		}
	} else {
	$SQLActions = "failed";
	$ErrorType = "tib_sql_connection_failed";
}
if($TibSQL == "success") { 
	$DBTable = "ccserverusers";
	$ErrorType = "none";
	$SQLActions = "failed";
	$NewSet = 2;
	$IT = 6;
	$TD = false;
	if($rr_vt = new bf_vt($DBServ['WEB'],$DBUser['WEB'],$DBPass['WEB'],$DBName['WEB'])) {
		$sorgu = $rr_vt->bf_vt_sqlsorgu("SELECT *  FROM `".$DBTable."` WHERE `dbinstalltype` = '".$IT."'");
		if($rr_vt->bf_vt_numrows($sorgu)){
			$P = $rr_vt->bf_vt_sqldongu();
			$T = count($P);
			for($i=0;$i<$T;$i++) {
				if(($P[$i]['dbKKStatus'] == "") && ($TD == false)) {
					$query = "UPDATE `".$DBTable."` SET `dbKKStatus` = '".$NewSet."', `dbLicenceCount` = '".$itotal."', `dbUserId4TIB` = '".$UserID."', `dbLicenceDays` = '365' WHERE dbGuid = '".$P[$i][0]."' LIMIT 1 ;"; 
					$rr_vt->bf_vt_sqlsorgu($query);
					$authcode = $P[$i][0];
					$SQLActions = "success";
					$TD = true;
				} else {
					$SQLActions = "failed";
					$ErrorType = "no_empty_key_data";
				}
			}
		} else {
			$SQLActions = "failed";
			$ErrorType = "empty_query_data";
		}
	} else {
		$SQLActions = "failed";
		$ErrorType = "sql_connection_failed";
	}
} 
?>