<?php
$port = $_GET["port"];
$path = $_GET["path"];
$karakter = array("ü","Ü","ö","Ö","ı","ğ","Ğ","ş","Ş","ç","Ç"," ","/",":");
$degistir = array("%FC","%DC","%F6","%D6","%FD","%F0","%D0","%FE","%DE","%E7","%C7","+","%2F","%3A");
$path = str_replace($karakter,$degistir,$path);
//$path = str_replace(" ","+",$path);
$path = urlencode($path);
$suffix = $_GET["suffix"];
if($_GET){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=proc_list?find_files___path='.$path.'___suffix='.$suffix.'';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
?>
<table data-role="table" data-mode="reflow">
<thead>
	<tr>
    	<th>&nbsp;</th>
    	<th>Dosya Adı</th>
        <th>İşlem</th>
    </tr>
</thead>
<tbody>
<?php
$num = 0;
foreach($xml->find_files as $client){
	$num++;
$slashcount = substr_count($client->file_path,"/");
$appname = explode("/",$client->file_path);
natsort($appname);
?>
<tr>
	<td style="display:none;"><?php echo "<span class='filenameexe' id='filenameexe$num'>".$appname[$slashcount]."</span>";?></td>
	<td><?php if (strlen($client->file_desc)<2){ echo "<span style=\"color:#f00\">Uygulama Adı Bulunmuyor</span>"; }else{ echo "<span class='filename' id='filename$num'>".$client->file_desc."</span>";} ?></td>
    <td><a href="#" id="button<?php echo $num; ?>" class="blockapplication" data-role="button" data-icon="delete" data-inline="true" data-theme="b">Yasakla</a></td>
</tr>
<?php
}
?>
</tbody>
<?php
}
?>
</table>