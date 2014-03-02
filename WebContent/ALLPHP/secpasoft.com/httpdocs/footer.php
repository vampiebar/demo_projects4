<div class="row-fluid footer">
	<div class="container">
    	<div class="span4">
        	<h3 class="footer_title"><?php echo $dil["iletisim"]; ?></h3>
            <p style="color:#fff;">Seçpa Yazılım ve İnternet Teknolojileri</p>
			<p style="color:#fff;">Skyport Residence Merkez Mah. Hürriyet Bulvarı No:1 Kat:9 D:106 Beylikdüzü - İstanbul</p>
            <p style="color:#fff;">Tel: <?php if($_SESSION["dil"]!="tr" || $_SESSION["dil"]=="") { echo " +90 212";} else{ echo " 0 212";} ?> 876 2 444 - <?php if($_SESSION["dil"]!="tr" || $_SESSION["dil"]=="") { echo " +90 212";} else{ echo " 0 212";} ?> 875 6610 - <?php if($_SESSION["dil"]!="tr" || $_SESSION["dil"]=="") { echo " +90 212";} else{ echo " 0 212";} ?> 875 6611</p>
            <p style="color:#fff;">Fax : <?php if($_SESSION["dil"]!="tr" || $_SESSION["dil"]=="") { echo " +90 212";} else{ echo " 0 212";} ?> 875 26 14</p>
			<p style="color:#fff;">E-posta:info@secpayazilim.com</p>
        </div>
        <div class="span4">
        	<h3 class="footer_title"><?php echo $dil["linkler"]; ?></h3>
            <div class="row-fluid">
            <div class="span6">
        	<ul class="unstyled altlink">
            	<li><a href="../anasayfa"><?php echo $dil["menu1"]; ?></a></li>
                <li><a href="../hakkimizda"><?php echo $dil["menu2"]; ?></a></li>
                <li><a href="../urunlerimiz"><?php echo $dil["menu3"]; ?></a></li>
            </ul>
            </div>
            <div class="span6">
            	<ul class="unstyled altlink">
                <li><a href="../musterilerimiz"><?php echo $dil["menu4"]; ?></a></li>
                <li><a href="../satinal"><?php echo $dil["menu5"]; ?></a></li>
                <li><a href="../iletisim"><?php echo $dil["menu6"]; ?></a></li>
                </ul>
            </div>
            </div>
        </div>
        <div class="span4">
        	<h3 class="footer_title"><?php echo $dil["sosyal_medya"]; ?></h3>
            <div class="aligncenter">
                <a class="icon-facebook icon-circled icon-64" href="https://www.facebook.com/pages/SE%C3%87PA-Yaz%C4%B1l%C4%B1m-ve-Internet-Teknolojileri/342695639180567?fref=ts"></a>
                <a class="icon-twitter icon-circled icon-64" href="#"></a>
            </div>
        </div>
    </div>
    <div class="text-center muted">2013 Seçpa Yazılım ve İnternet Teknolojileri Ltd Şti.</div>
</div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-42776363-3', 'secpasoft.com');
  ga('send', 'pageview');
</script>