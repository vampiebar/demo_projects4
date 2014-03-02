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
<title>Ürün Yenileme Formu</title>
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
			txtInput.innerHTML = "Lütfen Yukarıya 16 hanelik Aktivasyon Kodunuzu giriniz.";
			return false
		} else {
			inputEff(caller,'009933');
			txtInput.style.color = '#009933';
			txtInput.innerHTML = "Kayıtlar inceleniyor...";
		}
	}
</script>
<body>
<form id="form" name="form" method="post" action="./?doAction" onSubmit="return inputChk(document.getElementById('uid'),'FF0000');">
  <div align="center"><img src="../gfx/logo.gif" width="259" height="93" /></div>
  <table width="450" border="0" align="center" cellpadding="3" cellspacing="3" style="border: 1px solid #EFEFEF;">
    <tr>
      <td colspan="3" bgcolor="#EFEFEF"><strong>:: Ürün Yenileme Formu</strong></td>
    </tr>
    <tr>
      <td colspan="3"><div align="justify">Bu sayfadan kullandığınız <strong>WEBAYNET</strong> yazılımlarınızın kullanım sürelerini yenileyebilirsiniz. Lütfen aşağıdaki alana kullandığınız <strong>Aktivasyon Kodu</strong>nuzu giriniz, kullandığınız ürünü seçmeyide unutmayınız ... </div></td>
    </tr>
    <tr>
      <td width="5000000"><strong> Aktivasyon Kodunuz </strong></td>
      <!-- Geliştirici notu; !-->
      <!-- Internet Explorer 7 buradaki değer 5.000.000 olmadan bir sonraki inputu en köşeye taşımayı reddetti.! -->
      <td width="4"><strong>:</strong></td>
      <td width="249" align="right"><label>
        <input name="uid" type="text" class="input" id="uid" onfocus="inputEff(this,'009933')" onMouseOver="inputEff(this,'AFAFAF')" onMouseOut="inputEff(this,'EFEFEF')" onkeypress="inputEff(this,'009933')" value="<? echo @$_POST['uid']; ?>" maxlength="16" />
      </label></td>
    </tr>
        <tr>
      <td width="5000000"><strong> Ürününüz</strong></td>
      <td width="4">:</td>
      <td width="249" align="right"><label>
      <select name="pro" id="pro" class="select">
        <option value="nd">NetDADI (Ev Kullanıcı Sürümü)</option>
        <option value="np">NetPATRON (Network Sürümü)</option>
        <option value="npk">NetPatron Kafe Sürümü</option>
      </select>
      </label></td>
    </tr>
    <tr>
      <td colspan="3" align="right"><label></label>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="500000" align="left"><div id="txtCode"></div></td>
            <td width="50"><input type="submit" name="button" id="button" value="Gönder" /></td>
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
          <td colspan="2" align="left"> Üzgünüz, sunucumuzda girdiğiniz ürün anahtarına ait bir kayıt bulunmuyor. </td>
        </tr>
		 <? }
	} ?>
        <? if(isset($_GET['keyExpired'])) { ?>
        <tr>
          <td colspan="2" align="left" bgcolor="#EFEFEF"><strong>:: Sorgulama Sonucu</strong></td>
        </tr>
        <tr>
          <td colspan="2" align="left"> Üzgünüz, kullandığınız Aktivasyon Kodu Kullanım süresi yenilenemez. Lütfen <a href="http://www.webaynet.com/tr/netdadiorder.php">buraya</a> tıklayarak yeni bir ürün siparişi veriniz. </td>
        </tr>
		 <? }
	 ?>
  </table>
</form>
</body>
</html>
