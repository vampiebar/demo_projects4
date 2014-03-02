<?php 
$name="secpaweb";       			//Sanal pos api kullanic adi
$password="Onur1234*";    			//Sanal pos api kullanicisi sifresi
$clientid="100911422";    			//Sanal pos magaza numarasi
$lip=$_SERVER['REMOTE_ADDR'];	//Son kullanici IP adresi
$email="";  						//Email
$oid= "";				//Siparis numarasy her islem icin farkli olmalidir ,                                 //bo? gonderilirse sistem bir siparis numarasi üretir.
$type="Auth";   					//Auth: Saty? PreAuth Ön Otorizasyon
$ccno=$_POST["card_number"];             //Kart Numarasy
$tarih=explode("/",$_POST["expiry_date"]);
$ccay=$tarih[0];          //Kart son kullanma ay
$ccyil=$tarih[1];          //Kart son kullanma yil
$tutar="1.05";/*str_replace(",",".",str_replace(".","",substr($_POST["price"],0,-3)));	*/		//Kurus ayyraci olarak "." kullanylmalydyr.
$cv2=$_POST["cvv"];                 //Kart guvenlik kodu
$taksit="";           //Taksit sayisi Pe?in saty?larda bo? gonderilmelidir, "0" gecerli sayilmaz.
                                    //Provizyon alinamadigi durumda taksit sayisi degistirilirse sipari numarasininda
                                    //degistirilmesi gerekir.
// XML request sablonu
if(isset($ccno)){
$request= "DATA=<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<CC5Request>
<Name>{NAME}</Name>
<Password>{PASSWORD}</Password>
<ClientId>{CLIENTID}</ClientId>
<IPAddress>{IP}</IPAddress>
<Email>{EMAIL}</Email>
<Mode>P</Mode>
<OrderId>{OID}</OrderId>
<GroupId></GroupId>
<TransId></TransId>
<UserId></UserId>
<Type>{TYPE}</Type>
<Number>{CCNO}</Number>
<Expires>{CCTAR}</Expires>
<Cvv2Val>{CV2}</Cvv2Val>
<Total>{TUTAR}</Total>
<Currency>949</Currency>
<Taksit>{TAKSIT}</Taksit>
<BillTo>
<Name></Name>
<Street1></Street1>
<Street2></Street2>
<Street3></Street3>
<City></City>
<StateProv></StateProv>
<PostalCode></PostalCode>
<Country></Country>
<Company></Company>
<TelVoice></TelVoice>
</BillTo>
<ShipTo>
<Name></Name>
<Street1></Street1>
<Street2></Street2>
<Street3></Street3>
<City></City>
<StateProv></StateProv>
<PostalCode></PostalCode>
<Country></Country>
</ShipTo>
<Extra></Extra>
</CC5Request>
";



//De?i?ken parametrelerin XML sablona yazilmasi

      $request=str_replace("{NAME}",$name,$request);
      $request=str_replace("{PASSWORD}",$password,$request);
      $request=str_replace("{CLIENTID}",$clientid,$request);
      $request=str_replace("{IP}",$lip,$request);
      $request=str_replace("{OID}",$oid,$request);
      $request=str_replace("{TYPE}",$type,$request);
      $request=str_replace("{CCNO}",$ccno,$request);
      $request=str_replace("{CCTAR}","$ccay/$ccyil",$request);
      $request=str_replace("{CV2}","$cv2",$request);
      $request=str_replace("{TUTAR}",$tutar,$request);
      $request=str_replace("{TAKSIT}",$taksit,$request);


		// Sanal pos adresine baglanti kurulmasi
        // Test icin $url = "https://testsanalpos.com.tr/servlet/cc5ApiServer"
        // Üretim ortami için $url = "https://www.fbwebpos.com/servlet/cc5ApiServer"

        $url = "https://www.sanalakpos.com/servlet/cc5ApiServer";  //TEST

		$ch = curl_init();    // initialize curl handle
		
		curl_setopt($ch, CURLOPT_URL,$url); // set url to post to
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,1);
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable
		curl_setopt($ch, CURLOPT_TIMEOUT, 90); // times out after 90s
		curl_setopt($ch, CURLOPT_POSTFIELDS, $request); // add POST fields

		$result = curl_exec($ch); // run the whole process


       if (curl_errno($ch)) {
           print curl_error($ch);
       } else {
           curl_close($ch);
       }


 $Response ="";
 $OrderId ="";
 $AuthCode  ="";
 $ProcReturnCode    ="";
 $ErrMsg  ="";
 $HOSTMSG  ="";

$response_tag="Response";
$posf = strpos (  $result, ("<" . $response_tag . ">") );
$posl = strpos (  $result, ("</" . $response_tag . ">") ) ;
$posf = $posf+ strlen($response_tag) +2 ;
$Response = substr (  $result, $posf, $posl - $posf) ;

$response_tag="OrderId";
$posf = strpos (  $result, ("<" . $response_tag . ">") );
$posl = strpos (  $result, ("</" . $response_tag . ">") ) ;
$posf = $posf+ strlen($response_tag) +2 ;
$OrderId = substr (  $result, $posf , $posl - $posf   ) ;

$response_tag="AuthCode";
$posf = strpos (  $result, "<" . $response_tag . ">" );
$posl = strpos (  $result, "</" . $response_tag . ">" ) ;
$posf = $posf+ strlen($response_tag) +2 ;
$AuthCode = substr (  $result, $posf , $posl - $posf   ) ;

$response_tag="ProcReturnCode";
$posf = strpos (  $result, "<" . $response_tag . ">" );
$posl = strpos (  $result, "</" . $response_tag . ">" ) ;
$posf = $posf+ strlen($response_tag) +2 ;
$ProcReturnCode = substr (  $result, $posf , $posl - $posf   ) ;

$response_tag="ErrMsg";
$posf = strpos (  $result, "<" . $response_tag . ">" );
$posl = strpos (  $result, "</" . $response_tag . ">" ) ;
$posf = $posf+ strlen($response_tag) +2 ;
$ErrMsg = substr (  $result, $posf , $posl - $posf   ) ;
/*echo "Response:".$Response."<br>";
echo "ProcReturnCode:".$ProcReturnCode."<br>";*/
echo $Response;
}else{
	echo iconv("utf-8","iso-8859-9","Bunu yapmamalısın dostum");
	}
?>