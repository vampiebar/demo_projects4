<?php

/*
##########################################################################################
##  FILE: nvform.php                                                                    ##
##                                                                                      ##
##  Novice Form                                   Version 1.1                           ##
##  © Copyright 2000-2003 Seth Michael Knorr      mail@sethknorr.com                    ##
##                                                                                      ##
##                       http://www.noviceform.com/                                     ##
##         Please contact me with any bugs found, or any bug fixes.                     ##
##                                                                                      ##
##                                                                                      ##
##########################################################################################
##                                                                                      ##
##  There is no email support provided for this script, the only support can be         ##
##  found at our web site: http://www.noviceform.com/                                   ##
##                                                                                      ##
##                                                                                      ##
##  ANY PERSON(S) MAY USE AND MODIFY THESE SCRIPT(S) FREE OF CHARGE FOR EITHER BUSINESS ##
##  OR PERSONAL, HOWEVER AT ALL TIMES HEADERS AND COPYRIGHT MUST ALWAYS REMAIN IN TACT. ##
##                                                                                      ##
##  REDISTRIBUTION FOR PROFIT IS PROHIBITED WITH OUT THE CONSENT OF SETH KNORR.         ##
##                                                                                      ##
##  By using this code you agree to indemnify Seth M. Knorr from any liability that     ##
##  might arise from its use.                                                           ##
##                                                                                      ##
##                                                                                      ##
##########################################################################################
*/


/* $sendto is the email where form results are sent to */
   $sendto = "info@webaynet.com,coonur@gmail.com";

/* $ccto is the email where form results can be carbon copied to */
   $ccto = "bulentseker@gmail.com,info@webaynet.com,coonur@gmail.com";

/*
         O P T I O N A L   V A R I A B L E S
*/


$setokurls = "1";

$okurls = "http://www.webaynet.com";

/*

        N O   N E E D   T O   E D I T   A N Y   V A R I A B L E S   B E L O W

*/



$backbutton = "<br><br><b>Tarayicinizin geri butonuna basin ve formu tekrar gönderin.</b>";



/* check to see if posted */
if ($_GET || ! $_POST) {
include("nverror.php");
no_pst();
}else{


 /* IF OLDER VERSION OF PHP CONVERT TO NEWER VARIABLES */
        if (!$_POST) {
        $_POST = "$HTTP_POST_VARS";
        }

        if (!$_SERVER) {
        $_SERVER = "$HTTP_SERVER_VARS";
        }


$year = date("Y");
$month = date("m");
$day = date("d");
$hour = date("h");
$min = date("i");
$tod = date("a");


$ip=$_SERVER["REMOTE_ADDR"];

$SEND_prnt = "Asagidaki formu gönderen " . $_POST{"email"} . "  Ip adresi: $ip on $monthnameactual $month/$day/$year at $hour:$min $tod \n";
$SEND_prnt .= "-------------------------------------------------------------------------\n\n";

  if ($_POST) {

  /* SORT VARIABLES */

        $dizi=$_POST;
		foreach($dizi as $ilk=>$ikinci){
               $SEND_prnt .= "$ilk: " . $ikinci . " \n";
		}

  }   /* END SORT VARIABLES */
/* send mail */

if (! $ccto) {
$header = "From: $SEND_email\r\nReply-to: $SEND_email";
}else{
$header = "From: $SEND_email\r\nReply-to: $SEND_email\r\nCc: $ccto";
}


$mail = mail($sendto, $_POST{"subject"}, $SEND_prnt, $header);
//if(!$mail){ echo "Mail gönderilemedi";}else{ echo "Mail gönderildi";}
//print_r($_POST);
//echo $sortvars;
/* END sendmail */

     /* CHECK TO SEE IF FORM SPECIFYS A SUCCESS PAGE */
     if (! $_POST{"success_page"}) {
include("nverror4.php");
default_success();
     }else{
     $successpage=$_POST{"success_page"};
     header("Location: $successpage");  /* redirect */
     exit;
     }
} /* END IF POSTED */

?>