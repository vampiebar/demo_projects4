<? 
@session_start();
@session_register("dbData");
if(@$_POST['uid'] != "") {
		$NotFound = true;
	  	$Load = true;
		$DBGuid = $_POST['uid'];
		include_once("updateform_db.php");
}
if(isset($include) && @$includeFile == true) {
	include_once($include.".php");
	die();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1254" />
<title>�r�n Yenileme Formu</title>
</head>
<style>
body,table,td,tr,th {
	font-family: Trebuchet MS, Garamond, Geneva, Helvetica;
	font-size: 12px;
}
.input {
	background-image: url(../gfx/input.gif);
	width: 247px;
	height: 18px;
	border: 1px solid #CFCFCF;
	font-family: Trebuchet MS, Garamond, Geneva, Helvetica;
	font-size: 12px;
	padding-top: 2px;
	padding-left: 3px;
}
.select {
	background-image: url(../gfx/input.gif);
	width: 252px;
	border: 1px solid #CFCFCF;
	font-family: Trebuchet MS, Garamond, Geneva, Helvetica;
	font-size: 12px;
}
#txtCode {
	font-weight: bold;
}
</style>
<script language="javascript" type="text/javascript">
	function inputEff(caller,color) {
		caller.style.borderColor = "#"+color;
	}
	
	function inputChk(caller,color) {
		var uId = caller.value;
		var txtInput = document.getElementById('txtCode');
		if ( uId.length < 16 ) {
			txtInput.style.color = '#FF0000'
			inputEff(caller,'FF0000');
			txtInput.innerHTML = "L�tfen Yukar�ya 16 hanelik Aktivasyon Kodunuzu giriniz.";
			return false
		} else {
			inputEff(caller,'009933');
			txtInput.style.color = '#009933';
			txtInput.innerHTML = "Kay�tlar inceleniyor...";
		}
	}
</script>
<body>
<form id="form" name="form" method="post" action="./?doAction" onSubmit="return inputChk(document.getElementById('uid'),'FF0000');">
  <div align="center"><img src="../gfx/logo.gif" width="259" height="93" /></div>
  <table width="450" border="0" align="center" cellpadding="3" cellspacing="3" style="border: 1px solid #EFEFEF;">
    <tr>
      <td colspan="3" bgcolor="#EFEFEF"><strong>:: �r�n Yenileme Formu</strong></td>
    </tr>
    <tr>
      <td colspan="3"><div align="justify">Bu sayfadan kulland���n�z <strong>WEBAYNET</strong> yaz�l�mlar�n�z�n kullan�m s�relerini yenileyebilirsiniz. L�tfen a�a��daki alana kulland���n�z <strong>Aktivasyon Kodu</strong>nuzu giriniz, kulland���n�z �r�n� se�meyide unutmay�n�z ... </div></td>
    </tr>
    <tr>
      <td width="5000000"><strong> Aktivasyon Kodunuz </strong></td>
      <!-- Geli�tirici notu; !-->
      <!-- Internet Explorer 7 buradaki de�er 5.000.000 olmadan bir sonraki inputu en k��eye ta��may� reddetti.! -->
      <td width="4"><strong>:</strong></td>
      <td width="249" align="right"><label>
        <input name="uid" type="text" class="input" id="uid" onfocus="inputEff(this,'009933')" onMouseOver="inputEff(this,'AFAFAF')" onMouseOut="inputEff(this,'EFEFEF')" onkeypress="inputEff(this,'009933')" value="<? echo @$_POST['uid']; ?>" maxlength="16" />
      </label></td>
    </tr>
        <tr>
      <td width="5000000"><strong> �r�n�n�z</strong></td>
      <td width="4">:</td>
      <td width="249" align="right"><label>
      <select name="pro" id="pro" class="select">
        <option value="nd">NetDADI (Ev Kullan�c� S�r�m�)</option>
        <option value="np">NetPATRON (Network S�r�m�)</option>
        <option value="npk">NetPatron Kafe S�r�m�</option>
      </select>
      </label></td>
    </tr>
    <tr>
      <td colspan="3" align="right"><label></label>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="500000" align="left"><div id="txtCode"></div></td>
            <td width="50"><input type="submit" name="button" id="button" value="G�nder" /></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td colspan="3" align="right"><div align="center"><a href="http://www.webaynet.com"><img src="../../images/homepage.jpg" width="82" height="50" border="0" /></a></div></td>
    </tr>
  </table>
  <table width="450" border="0" align="center" cellpadding="3" cellspacing="3" style="border: 1px solid #EFEFEF;">
    <? if(@$_POST['uid'] != "") {
  		if(@$NotFound == true) { ?>
        <tr>
          <td colspan="2" align="left" bgcolor="#EFEFEF"><strong>:: Sorgulama Sonucu</strong></td>
        </tr>
        <tr>
          <td colspan="2" align="left"> �zg�n�z, sunucumuzda girdi�iniz �r�n anahtar�na ait bir kay�t bulunmuyor. </td>
        </tr>
		 <? }
	} ?>
        <? if(isset($_GET['keyExpired'])) { ?>
        <tr>
          <td colspan="2" align="left" bgcolor="#EFEFEF"><strong>:: Sorgulama Sonucu</strong></td>
        </tr>
        <tr>
          <td colspan="2" align="left"> �zg�n�z, kulland���n�z Aktivasyon Kodu Kullan�m s�resi yenilenemez. L�tfen <a href="http://www.webaynet.com/tr/netdadiorder.php">buraya</a> t�klayarak yeni bir �r�n sipari�i veriniz. </td>
        </tr>
		 <? }
	 ?>
  </table>
</form>
</body>
</html>
