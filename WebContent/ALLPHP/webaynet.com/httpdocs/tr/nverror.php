<?php
/* START ERROR FUNCTIONS */

function default_success() {
?>
<?
header ("Location:thanks.asp");
?>
        <html>
        <head>
        <title>Te�ekk�rler.</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
        <style type="text/css">
<!--
.style1 {color: #FF0000}
.style2 {
	font-size: 14px;
	font-weight: bold;
}
.style16 {font-size: 13px; font-weight: bold; }
.style17 {font-size: 12px; font-weight: bold; }
-->
        </style>
        </head>
        <body>
        <BR><BR><CENTER>
        <h2 class="style1">Te�ekk�r Ederiz ... </h2>
        <h2>Formunuz ba�ar�yla g�nderildi !<br>
          <span class="style16">En k�sa s�rede verdi�iniz bilgiler do�rultusunda<br>
          sizinle irtibata ge�ilecektir.</span></h2>
        <p class="style17"><a href="http://www.webaynet.com" target="_parent">Ana Sayfa Git</a></p>
        <p class="style2"><img src="/tr/images/webaynetlogo.png" width="224" height="62"><br>
        &copy; <span class="style16">WEBAYNET</span></p>
        </CENTER>
        </body>
        </html>

<?php

exit;
} /* end function: "default_success" */




function no_pst() {
?>

<html>

<head>
<title></title>
</head><body bgcolor="#cfcfcf">
<center>


<table width=500 border=1><tr><td bgcolor="#000080">
<br><br>
<font face="Arial" color="#ffffff">
<br><br>
</td></tr></table>
</center>

</body></html>

<?php
exit;
} /* end function: "no_pst" */



function msng_email() {

        $title = "<title>Eksik bilgi var veya ge�ersiz giri� yap�lm��!</title>";
        $errormessage = "<h2>Epostan�n format� ge�ersiz veya eksik bilgi var.</h2><b>Eposta adresi ge�erli bir adres olmal�!</b>";

        echo "$title";
        echo "$errormessage";
        echo "$backbutton";
        echo "$footer";
        exit;

} /* end function: "msng_email" */




function msng_required() {

                $title = "<title>Eksik form bilgisi!</title>";
                $errormessage = "<h2>Eksik form bilgisi!</h2><b>A�a��daki gerekli alanlar doldurulmam�� bo� alanlar:</b><br><br>$REQ_error";

                echo "$title";
                echo "$errormessage";
                echo "$backbutton";
                echo "$footer";
                exit;

} /* end function: "msng_required" */

?>