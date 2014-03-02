<?php
$port = $_GET["port"];
if($_GET){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=net_list?list_net_run_limit';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
$sayi = count($xml->net_run_limited_list);
if($sayi>0){
?>
<table data-role="table" data-mode="reflow">
<thead>
	<tr>
    	<th style="display:none">&nbsp;</th>
    	<th>Kural Adı</th>
        <th>İşlem</th>
    </tr>
</thead>
<tbody>
<?php
for($i=0;$i<count($xml->net_run_limited_list);$i++){
?>
<tr id="itrtr<?php echo ($i+1) ?>">
	<td style="display:none;"><?php echo $xml->net_run_limited_list[$i]->id;?></td>
	<td><?php echo $xml->net_run_limited_list[$i]->net_run_limit_desc; ?></td>
    <td><a href="#" id="removeitrbutton<?php echo ($i+1); ?>" class="removeitrbutton" data-role="button" data-icon="check" data-inline="true" data-theme="b">İzin Ver</a></td>
</tr>
<?php
}
?>
</tbody>
<?php
}
?>
</table>
<?php 
}if($sayi==0){
	echo "Uygulanmış kural yok.";
	}
?>
