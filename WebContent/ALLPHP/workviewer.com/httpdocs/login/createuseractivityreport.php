<script type="text/javascript" src="js/datatablebs.js"></script>
<table class="table table-striped table-bordered datatable2" id="example">
    	<thead>
        	<th class="text-center" width="30%">Program Yolu:</th>
            <th class="text-center" width="44%">Pencere Adı:</th>
            <th class="text-center" width="13%">Tarih:</th>
            <th class="text-center" width="13%">Zaman:</th>
        </thead>
        <tbody>
<?php
$screenport = $_GET["screenport"];
$baslangic = $_GET["baslangic"];
$bitis = $_GET["bitis"];
$baslangic = strtotime($baslangic);
$bitis = strtotime($bitis);
session_start();
include("functions.php");
if(!@$_SESSION["logindil"]){
	@$_SESSION["logindil"]="tr";
	require("dil/tr.php");
}else{
	require("dil/".$_SESSION["logindil"].".php");
}
if($_GET){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$screenport.'&showerrorinxml=yes&link=screen_list?fetch_data___table=window_text_log___table_field_id=window_text_log_id___value1=0___value2=z';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
$sayi = count($xml->fetch_data->table_to_xml->window_text_log->row);
$xml = json_decode(json_encode((array) simplexml_load_string($data)), 1);
$sum = 0;
$newarray = array();
$arraypathpathcount = array();
for($i=0;$i<count($xml["fetch_data"]["table_to_xml"]["window_text_log"]["row"]);$i++){
	$date = $xml["fetch_data"]["table_to_xml"]["window_text_log"]["row"][$i]["data_datetime"];
	$timestamp = strtotime($date);
	//echo $timestamp."<br>";
	$newarray["paths"][] = $xml["fetch_data"]["table_to_xml"]["window_text_log"]["row"][$i]["window_prg_path"];
	$newarray["seconds"][] = $xml["fetch_data"]["table_to_xml"]["window_text_log"]["row"][$i]["window_text_count"];
	$newarray["texts"][] = $xml["fetch_data"]["table_to_xml"]["window_text_log"]["row"][$i]["window_text"];
	$newarray["dates"][] = $xml["fetch_data"]["table_to_xml"]["window_text_log"]["row"][$i]["data_datetime"];
	if($timestamp>=$baslangic && $timestamp<=$bitis ){	
	//$arraypathpathcount[$newarray["texts"][$i]] = $newarray["seconds"][$i] + $arraypathpathcount[$newarray["texts"][$i]];
	$arraypathpathcount[$newarray["texts"][$i]] = array("pencere"=>$newarray["texts"][$i],"yol"=>$newarray["paths"][$i],"toplam_zaman"=>($newarray["seconds"][$i]+$arraypathpathcount[$newarray["texts"][$i]]["toplam_zaman"]),"tarih"=>$newarray["dates"][$i]);
	}
	//$toplam = $newarray["seconds"][$i] + $arraypathpathcount[$newarray["texts"][$i][1]];
}
function sirala($a,$subkey) {
	foreach($a as $k=>$v) {
		$b[$k] = strtolower($v[$subkey]);
	}
	arsort($b);
	foreach($b as $key=>$val) {
		$c[] = $a[$key];
	}
	return $c;
}
$arraypathpathcount = sirala($arraypathpathcount,'toplam_zaman'); 
$arraysize = count($arraypathpathcount);
?>
<?php 
for($i=0;$i<$arraysize;$i++){
?>
<tr>
	<td><?php echo $arraypathpathcount[$i]["yol"]; ?></td>
    <td title="<?php echo $arraypathpathcount[$i]["pencere"];  ?>"><?php if(strlen($arraypathpathcount[$i]["pencere"])>120) {echo substr($arraypathpathcount[$i]["pencere"],0,120)."...";}else{ echo $arraypathpathcount[$i]["pencere"];}?></td>
    <td><?php echo $arraypathpathcount[$i]["tarih"]; ?></td>
    <td><?php echo toplamzaman($arraypathpathcount[$i]["toplam_zaman"]); ?></td>
</tr> 
<?php 
}
?>
<?php 
}
?>
</tbody>
</table>
