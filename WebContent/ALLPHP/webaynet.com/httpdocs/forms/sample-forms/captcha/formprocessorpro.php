<?php
/*##############################################################################*/
/*#                    Form Mail: eMail Form Processor Pro                     #*/
/*#                              Version 4.0.8                                 #*/
/*#                            Adapted for php5                                #*/
/*##############################################################################*/
/*#                            Developer: MitriDAT                             #*/
/*#                            info@email-form.com                             #*/
/*#                          http://www.email-form.com                         #*/
/*#                          Last Modified 09.11.2005                          #*/
/*##############################################################################*/
/*# COPYRIGHT NOTICE                                                           #*/
/*# Copyright 2000-2005, MitriDAT. All Rights Reserved.                        #*/
/*#                                                                            #*/
/*# Please check ReadMe file for full details on installation                  #*/
/*##############################################################################*/
/*#***                 *** DO NOT EDIT PAST THIS LINE ***                   ***#*/
/*##############################################################################*/

error_reporting  (E_ERROR | E_WARNING | E_PARSE);

$Months=        array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');        array_unshift($Months, "");
$Weekdays=      array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
$base_path       = "./";
$error_loop      = 0;
$browser_out     = 0;
$cfg_file        = "formprocessorpro.cfg";
$mail_format     = "plain";
//FIX 24/07/2003
if (!file_exists($cfg_file)) {
    if ($_ENV["windir"]) {//windows
        $cfg_file = str_replace('\\','/',dirname($_SERVER['PATH_TRANSLATED'])).'/formprocessorpro.cfg';
        }
    $cfg_file = str_replace('//','/',$cfg_file);
    }
//FIX 24/07/2003
$cfg_form        = "form.cfg";
$content_type    = "Content-Type: text/html";
$multi_separator = ", ";

//##############################################################################
$_ENV['UPDATED'] = ' ';

// default message
if (($_SERVER['REQUEST_METHOD'] === 'GET') && (!$_SERVER['QUERY_STRING'])) {
    $_ENV['UPDATED'] = '';
    StartPage();
    exit;
}


$lines = ReadFile2('Configuration File', $cfg_file);
foreach ($lines as $line) {
        if (preg_match("/^(Referers)\s*=\s*(.+?)\s*(\x23|$)/",$line,$m))  {
     $GLOBALS[$m[1]][] = $m[2];
     }
        else {
    if (preg_match("/^(\w+)\s*=\s*(.+?)\s*(\x23|$)/",$line,$m))
    {$GLOBALS[$m[1]] = "$m[2]";}
    }
}


// we can inherit  base-path from page sequence:
if ($_POST['base_path']) { $base_path = $_POST['base_path'] .'/';}
if ($_POST['_base_path']) { $base_path = $_POST['_base_path'] .'/';}

// The following reads the form config. TMP var - "base_path" still remains
//Say GoodBye to form hidden fields :)
$lines=ReadFile2('Form Configuration File', $cfg_form);
foreach ($lines as $line) {
    if (preg_match("/^(attachments_path|mail_format)\s*=\s*(.+?)\s*(\x23|$)/",$line,$m))
        {$GLOBALS[$m[1]] = $m[2];}
    if (preg_match("/^(\w+)\s*=\s*(.+?)\s*(\x23|$)/",$line,$m))
            {
        $GLOBALS["FORM"][$m[1]] = "$m[2]";
        }
}
$attachments_path=$base_path.$attachments_path;

require_once("captcha.php");


if ( isset($_POST['r_captcha']) )
{
	if ( $_POST['r_captcha'] == $_SESSION['cpw'] )
	{
		session_destroy();
		unset($_POST['r_captcha']);
	}
	else
	{
		session_destroy();
		Error('',"The registration code did not match the one displayed, a new code has been generated, please try again.");
	}
}

//# let's party
ParseForm();
CheckRef();


if (preg_match ("/(\/\/|\.)aol\.com/i", $_SERVER['HTTP_REFERER'])) $mail_format="plain";
if (preg_match ("/(\/\/|\.)not/i", $_SERVER['HTTP_REFERER'])) $mail_format="plain";

if (!$FORM['_format_decimals']) $FORM['_format_decimals'] = "0";
if (!$FORM['GMT_OFFSET']) $FORM['GMT_OFFSET'] = "0";

// DATE FORMATTING
if (!$date_format) $date_format = 'dd.mm.yyyy';
$date = $date_format;
list ($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime(strtotime($FORM['GMT_OFFSET']." hour"));
$mon++; $year+=1900; $syear="0".($year-2000);
if (strlen($mday)<2){$mday="0".$mday;}

        $date= preg_replace("/weekday/i", $Weekdays[$wday], $date);
        $date= preg_replace("/wee/ei", substr($Weekdays[$wday],0,3), $date);
        $date= preg_replace("/month/i",$Months[$mon], $date);
        $date= preg_replace("/mmm/ei",substr($Months[$mon],0,3), $date);
        $mon = (strlen($mon)<2?"0":"").$mon;  // "0" schreiben oder nicht?
        $date= preg_replace("/yyyy/i", $year, $date);
        $date= preg_replace("/yy/i", $syear, $date);
        $date= preg_replace("/dd/i", $mday, $date);
        $date= preg_replace("/mm/i", $mon, $date);
$_ENV['DATE_GMT'] = sprintf("%02d:%02d:%02d %s GMT %d",$hour,$min,$sec,$date,$FORM['GMT_OFFSET']);
// END DATE FORMATTING


srand(time());
$rnd1 = sprintf("%04d", floor(rand(0,10000)));
$rnd2 = sprintf("%04d", floor(rand(0,10000)));

if (!$FORM['unique_reference_number']) {$FORM['unique_reference_number'] = "$year$mon$mday-$rnd1-$rnd2";}
if (is_array($missing_values) || is_array($bad_emails) || is_array($only_digits) || is_array($only_words)) { Error('evil values'); }

foreach ($FORM as $key => $val)
    {
          $FORM[$key] = preg_replace("/\x22/", "'",$val);
    }

foreach ($FORM as $key => $val)
    {
    $pn=$FORM['page_no']; $pn++;
//NOT
// start_email is hidden field in the form which email has to been sent after
    if (preg_match("/^_send_email/", $key))
        {
        if (!$FORM["_browser_out".$pn]) {
                $lines = ReadFile2('Email Template',$base_path.$FORM[$key]);
                $lines = ParseText($lines);
                $lines = ParseEmail($lines);
            SendMailBySmtp($lines);
//                        BrowserOut(array("Mail ($val) was sent OK!<br>")) ;
                }
        }
    else{if (preg_match("/^_out_file/", $key))
        {
        if (!$FORM["_browser_out".$pn]) {
        $lines = ReadFile2('Log File',$base_path.$FORM[$key]);
        $lines = ParseText($lines);
        LogFile('LogFile Template',$lines);
                }
        }

    else{if (preg_match("/^_browser_out".$FORM['page_no']."$/",$key) and $browser_out < 2)
        {
// #NOT Loading template:
        $browser_out++;
        $lines = ReadFile2('Browser Template', $base_path.$FORM[$key]);
        $lines = ParseText($lines);
//         Appending POST variables as hidden fields
                for ($i=0; $i<count($lines);$i++) {
                 if (preg_match("/(<\/form>)/i",$lines[$i])) {
                 $hfields="";
                 foreach ($FORM as $k => $v) {
                         if (preg_match("/^page_no/",$k)) {$v++;}
                         $hfields .= '<input type="hidden" name="'.$k.'" value="'.stripslashes($v).'">'."\n";
                         }
                 if (!$FORM[page_no]) {$hfields .= '<input type="hidden" name="page_no" value="1">'."\n";}
                 $lines[$i]=preg_replace("/(<\/form>)/i","$hfields\\1",$lines[$i]);
                 }
                }
        BrowserOut($lines);
        }
    else{if (preg_match("/^_redirect/",$key) and $browser_out < 2)
        {
        $browser_out++;
        Header("Location: ".$FORM[$key]);
        }
        }}}
    }


if (!$browser_out) {
    $msg = get_data();
    $_ENV['OUT_TITLE'] = "Submission Successful";
    $_ENV['OUT_MSG']   = "Your submission was successful. Thank you.";
    $msg = ParseText($msg);
    BrowserOut($msg);
}

//clearing attached files
if (is_dir($attachments_path)) {
if ($dh = opendir($attachments_path)) {
    while (($file = readdir($dh)) !== false) $files_list[] = $file;
    closedir($dh);

    $files_list = preg_grep( "/^\d{8}_(.*)_\._file$/", $files_list);
        foreach ($files_list as $attachment_file) {
                list($dev,$ino,$mode,$nlink,$uid,$gid,$rdev,$size,$atime,$mtime,$ctime,$blksize,$blocks) = stat($attachments_path.$attachment_file);
            if (time() >= $mtime + $attachments_ttl) {unlink($attachments_path.$attachment_file);}
            }
        }
}
// end clearing attached files

exit;

function ParseEmail($arr)
{
global $attachments_path, $email, $mail_format;

  $email= new mime_mail();

    for ($i=0; $i<count($arr); $i++)
    {
            if (preg_match("/^Attachment: (.+)$/i",$arr[$i],$ma))
            {
                           $files = split (',', $ma[1]);

                    foreach ($files as $attachment_file)
                    {
                    $attachment_file = trim($attachment_file);
                                if (preg_match("/([^\/\\:]*)$/",$attachment_file,$ma))
                                {
                                        $attachment_file = $ma[1];
                                }

                if (preg_match("/^\d{8}_(.*)_\._file$/",$attachment_file,$ma))
                        {$real_name = $ma[1];}
                 else        {$real_name = $attachment_file;}

                          $email->add_attachment($attachments_path,$attachment_file,$real_name);
                    }

            } else         {
                // Strip tags if mail format is plain, skipping service info lines
                if (($mail_format == "plain") && (!preg_match("/^(From|To|Cc|Bcc):/i",$arr[$i])))
                {
                $arr[$i]=strip_tags($arr[$i]);
                }
        if (!preg_match("/^(to|from|b?cc|subject|attachment): (.+)$/i",$arr[$i],$ma))
                  {  //FIXED 09.11.2005 dollar sign
                     if ($mail_format ==='plain'){
                           $arr[$i] = str_replace('&#36;','$', $arr[$i]);}
                     $email->add_html($arr[$i]);}
          else {
                        $mail_param = $ma[1];
                        $mail_val = $ma[2];
                        $var_name = "mail_".strtolower($mail_param);
            if ($var_name == "mail_cc" || $var_name == "mail_bcc" || $var_name == "mail_from") {
                    $email->headers.=$mail_param.": ".trim($mail_val)."\n";
                }

          }
        }
    }
$email->build_message($mail_format);
return $arr;
}//ParseEmail

function SendMailBySmtp($arr)
{
global $email, $mailserver;


        foreach ($arr as $line)
        {
                if (preg_match("/^(to|from|bcc|cc|subject): (.+)$/i",$line, $ma))
                {
                        $mail_param = $ma[1];
                        $mail_val = $ma[2];
            if (preg_match("/<(.+)>/",$mail_val, $ma)) $mail_val = $ma[1];

                        $var_name = "mail_".strtolower($mail_param);
                        $$var_name = $mail_val;
                }
        }
$email->send($mailserver,$mail_to, $mail_from, $mail_subject);
}//SendMailBySmtp


function BrowserOut($arr)
{
global $content_type;
@Header($content_type);
foreach ($arr as $a) print $a;
}//BrowserOut

function ParseForm()
{
global $FORM, $missing_values,$bad_emails,$only_digits,$only_dig_and_dolar,$only_words,$attachments_path,$mail_format,$multi_separator,$max_file_size;

    foreach ($_POST as $name => $value)
        {
        //FIX 29.06.2004
        if ($mail_format == "html") {
                  if (!is_array($value)) { $value = nl2br($value); }
                }
        $FORM[$name] = str_replace('$',"&#36;",$value);

                 if (preg_match("/^([rs]*[edwmcn]?[rs]*)".chr(95)."/",$name)) {

                    list($prefs, $key) = explode(chr(95), $name, 2);

                    if (preg_match("/s/i",$prefs) and $value) {
                            $value =  trim($value);
                        $FORM[$name] = $value;
                    }

                    if (preg_match("/m/i",$prefs) and $value and is_array($value) ) {
                                         if ($FORM['_multi_separator']) $multi_separator = $FORM['_multi_separator'];
                            $value = join($multi_separator,$value);
                            $value = preg_replace("/^default$multi_separator/i","",$value);
                            $value = preg_replace("/^default/i","",$value);
                            $value = preg_replace("/".$multi_separator."$/i","",$value);
                            $FORM[$name] = $value;
                                }
                    if (preg_match("/n/i",$prefs) and $value) {
                                        $value = str_replace("\n","",$value);
                                        $value = str_replace("\r","",$value);
                            $FORM[$name] = $value;
                    }

                    if (preg_match("/r/i",$prefs) and !strlen($value))
                            { $missing_values[] = $key;}
                    if (preg_match("/e/i",$prefs) and $value and isEmailBad($value))
                            { $bad_emails[] = $key;}
                    if (preg_match("/d/i",$prefs) and $value and !preg_match("/^(\d+|\d+\.\d+)$/",$value))
                            { $only_digits[] = $key;}
                    if (preg_match("/c/i",$prefs) and $value and !preg_match('/^(\$?\d+\$?|\$?\d+\.\d+\$?)$/',$value))
                            { $only_dig_and_dolar[] = $key;}
                    if (preg_match("/w/i",$prefs) and $value and !preg_match("/\w/",$value))
                            { $only_words[] = $key;}
                        }
    }

        foreach ($_FILES as $key => $file)        {
        if (file_exists($file["tmp_name"])) {
                        $file_name = basename($file["name"]);
                        $t_size = $file["size"];
                        srand(time());
            $rnd = sprintf("%08d", floor(rand(0,100000000)));
                        $FORM[$key."_uploaded"] = $rnd . "_" . $file_name . "_._file";
                        $local_file = $attachments_path . $rnd . "_" . $file_name . "_._file";
                        copy ($file["tmp_name"],$local_file)  or Error('File Access Error',"An error occurred when trying to save attachments ($local_file): $!");
            @unlink($file["tmp_name"]);
                        $f_size = 1024 * $GLOBALS[max_file_size];
                        if($t_size > $f_size && $f_size != 0) {
                                unlink($local_file);
                                Error('File Size Error',"Uploading file is too large. It must to be less than $max_file_size KB.");
                            }
            }
        }
}//ParseForm

function CheckRef()
{
global $Referers;
    if (is_array($Referers) and $_SERVER['HTTP_REFERER']) {
        foreach ($Referers as $referer) {
            if ( preg_match("/http.*?:\/\/$referer/i", $_SERVER['HTTP_REFERER'])) {
                $valid_referer++;
                break;
            }
        }
    } else {
            $valid_referer++;
    }
    if (!$valid_referer) {
        $terms = split(chr(47),$_SERVER['HTTP_REFERER']);
    Error ('Bad Referer', "'".$_SERVER['HTTP_REFERER']."' is not authorised to use this script. If you want them to be able to, you should add '".$terms[2]."' to the referer list.");
        }
}//CheckRef

function Error ($title, $msg="")
{
global $FORM, $base_path,$error_loop,$missing_values,$bad_emails,$only_digits,$only_dig_and_dolar,$only_words;
    ++$error_loop;
$error=array();
    if ($title === 'evil values') {
$val="";

        if ($missing_values) {
            $msg = "<p>The following field(s) are required to be filled in before successful submission:</p>\n<table border=0><tr><td><ol>\n";
            foreach ($missing_values as $val) { $msg .= "<li>$val\n"; }
            $msg .= "</ol></td></tr></table>\n";
                }
        if ($bad_emails) {
            $msg .= "<p>The following field(s) are required to be filled in with valid email addresses before successful submission:</p>\n<table border=0><tr><td><ol>\n";
            foreach ($bad_emails as $val) { $msg .= "<li>$val\n"; }
            $msg .= "</ol></td></tr></table>\n";
                }
        if ($only_digits) {
            $msg .= "<p>The following field(s) are required to be filled in only with digits (0-9) and decimal point before successful submission:</p>\n<table border=0><tr><td><ol>\n";
            foreach ($only_digits as $val) { $msg .= "<li>$val\n"; }
            $msg .= "</ol></td></tr></table>\n";
        }
        if ($only_dig_and_dolar) {
            $msg .= "<p>The following field(s) are required to be filled in only with digits (0-9) a decimal point, or a dollar sign before successful submission:</p>\n<table border=0><tr><td><ol>\n";
            foreach ($only_dig_and_dolar as $val) { $msg .= "<li>$val\n"; }
            $msg .= "</ol></td></tr></table>\n";
        }
        if ($only_words) {
            $msg .= "<p>The following field(s) are required to be filled in only with word characters (A-Z, 0-9) before successful submission:</p>\n<ol type=\"i\">\n";
            foreach ($only_words as $val) { $msg .= "<li>$val\n"; }
            $msg .= "</ol>\n";
        }
                $title = 'Error - Incorrect Values';
                $msg .= "<p>Please go back and fill in the fields accordingly.</p>\n";
        }
    if ($FORM['_error_url']) {
            Header ("Location: ".$FORM['_error_url']);

    } elseif ($FORM['_error_path'] and $error_loop < 2) {
        $_ENV['OUT_TITLE'] = $title;
        $_ENV['OUT_MSG']   = $msg;
        $error = ReadFile2('Error Template',$base_path.$FORM['_error_path']);
        $error = ParseText($error);
        BrowserOut($error);
        } else {
        $error = get_data();
        $_ENV['OUT_TITLE'] = $title;
        $_ENV['OUT_MSG']   = $msg;
        $error = ParseText($error);
        BrowserOut($error);
        }
    exit;
}//Error

function LogFile ($msg, $arr)
{
global $base_path;
    $file =  array_shift($arr);
    $file=trim($file);
//    $file =  preg_replace("/^(\s)/","\.\/\\1",$file);
    $file    =  $base_path . $file;

    $fh = fopen($file, 'a+') or Error('File Access Error',"An error occurred when trying to append to the $msg ($file)");
    flock($fh,LOCK_EX) or Error('File Lock Error',"An error occured when locking the $msg ($file):.");
    foreach ($arr as $a) {fputs($fh,$a);}
    fflush($fh);
    flock($fh,LOCK_UN);
    fclose($fh) or Error('File Close Error',"An error occurred when close the $msg ($file).");

}//LogFile

function ReadFile2 ($msg, $file)
{
    $lines = File($file)  or Error('File Access Error',"An error occurred when opening the $msg ($file): $!.");
    return $lines;

}//ReadFile2

function ParseText($arr)
{
global $FORM;
    for( $i=0; $i< count($arr); $i++) {
                if (is_array($FORM)) {
                foreach ($FORM as $key => $value)
                    {
/*** FIX 18/04/2005 ***/
                    $value = preg_replace("[\[]","/((", preg_replace("[\]]","/))",$value));
/**********************/
                    $value = stripslashes($value);
                    $arr[$i]=preg_replace("#\[".$key."\]#i", $value, $arr[$i]);
                    }
            }
        foreach ($_ENV as $key => $value)
            {$arr[$i]=preg_replace("/\[\%$key\]/i",$value, $arr[$i]);}
        foreach ($_SERVER as $key => $value) {
                if (!is_array($value)) {
                        $arr[$i]=preg_replace("/\[\%$key\]/i",$value, $arr[$i]);
                        }
                }

                if (preg_match("/\x7e(\w+)((\[)(\d)(\]))?/",$arr[$i],$match))
                {
                eval (" \$rr = $$match[1]; "); //$match[3]$match[4]$match[5]
                $arr[$i] = preg_replace("/\x7e(\w+)((\[)(\d)(\]))?/e", $rr, $arr[$i]);
                }
// remove blank vars
// FIX 14/08/2003
        if (preg_match("/<script/",$arr[$i])) $script = 1;
        if ($script != 1) {
            $arr[$i] = preg_replace("/\[[^<](.)*?[^>]\]/","",$arr[$i]);
            } else {
            $arr[$i] = preg_replace("/([^A-Za-z0-9\-_])\[[^<](.)*?[^>]\]/","\1",$arr[$i]);
            }
        if (preg_match("/<\/script/",$arr[$i])) $script = 0;
// FIX 14/08/2003
        }
    for( $i=0; $i< count($arr); $i++) {
        while (preg_match("/\[<((.)*?)>\]/",$arr[$i],$am)) {
            $sub = $am[1];
                        if (!preg_match("/^([\d\+\*\/\-%\.,x<>\(\)\s]|round|ifcond)*$/s",$sub)) {
//                                Error("Error in expression", $sub);
                        }
                        eval ("\$sub = $sub;");
            $arr[$i] = preg_replace("/\[\<(.)*?\>\]/s", $sub, $arr[$i]);
         }
/*** FIX 18/04/2005 ***/
         $arr[$i] = preg_replace("[\/\(\(]",'[', preg_replace("[\/\)\)]","]",$arr[$i]));
/**********************/
    }
    return $arr;

}//ParseText

function ifcond ($cond, $res1, $res2)
{
        if ($cond) {
                return sprintf("%s", $res1);
        } else {
                return sprintf("%s", $res2);
        }

}//ifcond

function get_data()
{
return array(
'<html>
<head>
<title>[%OUT_TITLE]</title>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="navy" vlink="navy" alink="red" style="font-family: verdana, arial, sans-serif; font-size: 8;">
<center><table border="0" cellpadding="0" cellspacing="0" width="500" style="font-family: verdana, arial, sans-serif; font-size: 12;">
  <tr><td><h2 align="center">[%OUT_TITLE]</h2>
    [%UPDATED]
        <p align="center">[%OUT_MSG]</p>
        <p align="center"><a href="http://www.email-form.com/">Form Mail: eMail Form Processor Pro</a><br>
    &copy; 2000-2005 <a href="http://www.mitridat.com/">MitriDAT</a></td>
  </tr>
</table>
</center>
</body>
</html>');
}//get_data

function ManagePage()
{
    $_ENV['OUT_TITLE'] = "eMail Form Processor Pro Script Administrative Section";
    $_ENV['OUT_MSG']   = "";
        $msg=File("cform.html") or Error('Config Form Open Error',"An error occurred when opening config form (cform.html): $!. Please check paths and file.");
    $msg = ParseText($msg);
    BrowserOut($msg);
}//ManagePage

function SavePage() {
ParseForm();
$mas=0;
$lines = ReadFile2('Configuration File', $GLOBALS['cfg_file']);
$fh= fopen($GLOBALS['cfg_file'],"w") or Error('Config Form Open Error',"An error occurred when opening config file($cfg_file): $!. Please check paths and file permissions (Must be 766).");
flock($fh, LOCK_EX);
foreach ($lines as $line) {
        if (preg_match("/^(Referers)\s*=\s*(.+?)\s*(\x23|$)/",$line,$ma))
                {
                $var_name=$ma[1]; $var_value=$ma[2];
                if ($FORM[$var_name.$mas]) {$line=preg_replace("/$var_value/",$FORM[$var_name.$mas],$line);}
                #print "$var_name === $FORM{$var_name.$mas}<br>";
                $mas++;
                }
        elseif (preg_match("/^(\w+)\s*=\s*(.+?)\s*(\x23|$)/",$line))
                {
                $var_name=$ma[1]; $var_value=$ma[2];
        if ($FORM[$var_name]) {$line=preg_replace("/$var_value/",$FORM[$var_name],$line);}
                }
fputs($fh, $line);
}
fflush($fh);
flock($fh, LOCK_UN);
fclose($fh) or Error('Config Form Close Error','An error occured while closing the file ($cfg_file): $!.');

}//SavePage

function StartPage() {
        $_ENV['OUT_TITLE'] = "Form Mail: eMail Form Processor Pro Script";
        $_ENV['OUT_MSG']   = 'The latest version of this script and documentation is available from
    <a href="http://www.email-form.com/">Email-Form</a>.
        </p>
        ';
    $msg = get_data();
    $msg = ParseText($msg);
    BrowserOut($msg);
}//StartPage

function isEmailBad($value)
{
return ((preg_match("/(@.*@)|(\.\.)|(@\.)|(\.@)|(^\.)/",$value)) or
                                (!preg_match("/^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,6}|[0-9]{1,3})(\]?)$/",$value)));
}//isEmailBad

class mime_mail {
  var $headers;
  var $multipart;
  var $mime;
  var $html;
  var $parts = array();

function mime_mail($headers="") {
    $this->headers=$headers;
}

function add_html($html="") {
    $this->html.=$html;
}

function build_html($orig_boundary, $mail_format="plain") {
    $this->multipart.="--$orig_boundary\n";
    $this->multipart.="Content-Type: text/".$mail_format."; charset=ISO-8859-1\n";
    //FIX 15.08.2003
    if ($mail_format === 'html') {
        $this->multipart.="Content-Transfer-Encoding: Quot-Printed\n\n";
        }

    //FIX 15.08.2003
    $this->multipart.="$this->html\n\n";
}


function add_attachment($path="", $name = "", $rname="", $c_type="application/octet-stream") {
    if (!file_exists($path.$name)) {
      print "File ".$path.$name." dosn't exist.<br>\n";
      return;
    }
    $fp=fopen($path.$name,"rb");
    if (!$fp) {
      print "File $path.$name coudn't be read.";
      return;
    }
    $file=fread($fp, filesize($path.$name));
    fclose($fp);
    $this->parts[]=array("body"=>$file, "name"=>$rname,"c_type"=>$c_type);
}

//FIX 20.12.2003 in the next two functions: "\n" instead of "\r\n" everywhere

function build_part($i) {
    $message_part="";
    $message_part.="Content-Type: ".$this->parts[$i]["c_type"];
    if ($this->parts[$i]["name"]!="")
       $message_part.="; name = \"".$this->parts[$i]["name"]."\"\n";
    else
       $message_part.="\n";
    $message_part.="Content-Transfer-Encoding: base64\n";
    $message_part.="Content-Disposition: attachment; filename = \"".
       $this->parts[$i]["name"]."\"\n\n";
    $message_part.=chunk_split(base64_encode($this->parts[$i]["body"]))."\n";
    return $message_part;
}


function build_message($mail_format="plain") {
    $boundary="=_".md5(uniqid(time()));
    $this->headers.="MIME-Version: 1.0\n";
    $this->headers.="Content-Type: multipart/mixed; boundary=\"$boundary\"\n";
    $this->multipart="";
    $this->multipart.="This is a MIME encoded message.\n\n";
    $this->build_html($boundary, $mail_format);
    for ($i=(count($this->parts)-1); $i>=0; $i--)
      $this->multipart.="--$boundary\n".$this->build_part($i);
    $this->mime = $this->multipart."--$boundary--\n";
}


function send($server, $to, $from, $subject="", $headers="")
{
    global $mailserver;
/*** FIX 19.03.05 ***/
    if (!empty($mailserver) && $mailserver!="") ini_set("SMTP", $mailserver);
/********************/
    mail($to,$subject,$this->mime,$this->headers);
}
}//mime_mail
?>
