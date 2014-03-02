<?php

// This code demonstrates how to lookup the country by IP Address
include("geoip.inc");
$user_ip_adresi=$_SERVER['REMOTE_ADDR'];
$gi = geoip_open("GeoIP.dat",GEOIP_STANDARD);
$user_country_code=geoip_country_code_by_addr($gi, $user_ip_adresi);
geoip_close($gi);
 
switch ($user_country_code) {
case 'TR' : header("Location: http://www.webaynet.com/tr/"); break; //DE iþareti konduðu için www.netdadi.com adresine türkiyeden girmeye çalýþan herkez yönlendirilen diðer adrese gidecektir.
default   : header("Location: http://www.webaynet.com/tr/"); break; // burasýda default olarak giren diðer tüm ülkelerdeki ziyaretçilerin gireceði sayfa.
 
} 
 