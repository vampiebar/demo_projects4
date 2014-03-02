<?php
$port = $_GET["port"];
$maindir = $_GET["maindir"];
if($_GET){ 
$url='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=proc_list?get_proc_subdirs___parent='.$maindir.'';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($data);
for($i=0;$i<count($xml->get_proc_subdirs->subdirs);$i++){
?>
	<option><?php echo $xml->get_proc_subdirs->subdirs[$i]; ?></option>    
<?php
}
}
?>
