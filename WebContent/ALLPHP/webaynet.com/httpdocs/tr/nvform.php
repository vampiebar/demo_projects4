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
   $sendto = "bulent@netdadi.com";

/* $ccto is the email where form results can be carbon copied to */
   $ccto = "bulentseker@gmail.com,info@webaynet.com,engin.mihcioglu@gmail.com";

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
if ($HTTP_GET_VARS || ! $HTTP_POST_VARS || $_GET || ! $_POST) {
include("nverror.php");
no_pst();

}else{


 /* IF OLDER VERSION OF PHP CONVERT TO NEWER VARIABLES */
        if (! $_POST) {
        $_POST = "$HTTP_POST_VARS";
        }

        if (! $_SERVER) {
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


/* CHECK TO SEE IF $_POST{"required"} IS SET */
if ($_POST{"required"}){


  $post_required = $_POST{"required"};
  $required = split(",", $post_required);
  $reqnum = count($required);

        for ($req=0; $req < $reqnum; $req++) {

        $REQ_name = $required[$req];
        $REQ_value = $POST{"$REQ_name"};


  if ($REQ_name == "email") {
     $goodem = ereg("^[^@ ]+@[^@ ]+\.[^@ \.]+$", $_POST{"email"}, $trashed);

        if (! $goodem) {
        include("nverror.php");
        msng_email();
        }  /* end ! $goodem */

  }
  elseif (! $_POST{"$REQ_name"}) {
                  $isreqe = "1";
                  $REQ_error .= "<li> $REQ_name ";
                   } /* end ! req val */

          } /* end REQ for loop  */


                /* IF THERE ARE ANY REQUIRED FIELDS NOT FILLED IN */

                if ($isreqe == "1") {
                include("nverror.php");
                msng_required();
                }


} /* END CHECK TO SEE IF $_POST{"required"} IS SET */


/* END IF THERE ARE ANY REQUIRED FIELDS NOT FILLED IN */


/* GET POSTED VARIABLES */


foreach ($_POST as $NVPOST_name => $NVPOST_value) {

            /* GET LEADS EMAIL */

            $email_lower = strtolower($NVPOST_name);

            if ($email_lower == "email") {
            $SEND_email = "$NVPOST_value";
            }

            /* END GET LEADS EMAIL */

   if (! $_POST{"sort"}) {


                            /* CHECK TO SEE IF CONFIG FIELD */
                            if ($NVPOST_name == "subject" || $NVPOST_name == "sort" || $NVPOST_name == "required" || $NVPOST_name == "success_page"){}else{
                            $SEND_prnt .= "$NVPOST_name: $NVPOST_value \n";
                            }
   } /* end ! sort */


} /* end foreach */


  /* END GET POSTED VARIABLES */




  if ($_POST{"sort"}) {

  /* SORT VARIABLES */

        $sortvars = split(",", $_POST{"sort"});
        $sortnum = count($sortvars);

               for ($num=0; $num < $sortnum; $num++) {
               $SEND_prnt .= "$sortvars[$num]: " . $_POST{"$sortvars[$num]"} . " \n";
               }

  }   /* END SORT VARIABLES */




/* send mail */


if (! $ccto) {
$header = "From: $SEND_email\r\nReply-to: $SEND_email";
}else{
$header = "From: $SEND_email\r\nReply-to: $SEND_email\r\nCc: $ccto";
}


mail($sendto, $_POST{"subject"}, $SEND_prnt, $header);

/* END sendmail */

     /* CHECK TO SEE IF FORM SPECIFYS A SUCCESS PAGE */
     if (! $_POST{"success_page"}) {

include("nverror.php");
default_success();

     }else{
     $successpage=$_POST{"success_page"};
     header("Location: $successpage");  /* redirect */
     exit;
     }



} /* END IF POSTED */


?>