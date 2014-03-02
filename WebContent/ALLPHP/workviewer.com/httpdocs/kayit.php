<?php 
$connection = pg_connect("host='register.workviewer.com' port='6432' dbname='icaosctrl' user='postgres' password='secpa!74!'") or die ("Bağlanamadı");
$time = date("Y-m-d h:m:s");
$time = str_replace(" ","%20",$time);
$name = urlencode($_POST["name"]);
$username = urlencode($_POST["username"]);
$password = $_POST["password"];
$city = $_POST["city"];
$pc = $_POST["pc"];
$cityname = urlencode($_POST["cityname"]);
$diskserial=substr(md5($username),0,10);
//echo "Name: $name Username $username Password $password Time $time";
if($_POST){
$url='http://register.workviewer.com/ICAOsCtrlWS/jaxrs/register/addwithurl?user_name='.$username.'&user_pass='.$password.'&company_person_name='.$name.'&phone1=web&phone2=web&district=&city='.$cityname.'&state=&state_number_code=000'.$city.'&country=TR&address1=&address2=&zipcode='.$city.'000&mac_id=&wan_ip=&lan_ip=&sold_date='.$time.'&install_date='.$time.'&bill_no=&license_client_count='.$pc.'&license_gui_count=2&disk_serial_id='.$diskserial.'&license_client_days=15&license_gui_days=15';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
echo $data;
}
?>
