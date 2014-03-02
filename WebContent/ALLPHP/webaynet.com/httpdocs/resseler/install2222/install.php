<?php
/******************************************************************************
* This file is part of the Deadlock PHP User Management System.               *
*                                                                             *
* File Description: Show information for a specific user                      *
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

include('../db_config.php');

// functions
function generate_htpasswd ($htpasswd,$htaccess){
	global $_POST;

	$htaccess_path = $_SERVER['DOCUMENT_ROOT'].$htaccess;
	
	if(isset($_POST['htpasswd_relative'])){
		$htpasswd_path = $_SERVER['DOCUMENT_ROOT'].$htpasswd;
	} else {
		$htpasswd_path = $htpasswd;
	}

	$handle = fopen($htpasswd_path,'w') or die('Deadlock could not open the htpasswd file for writing. '.$htpasswd_path);
	fwrite($handle,' ') or die('Deadlock could not write the htpasswd file. '.$htpasswd_path);
	fclose($handle);
}

// generate the htaccess file
function generate_htaccess($htpasswd,$htaccess){
	global $_POST;

	$htaccess_path = $_SERVER['DOCUMENT_ROOT'].$htaccess;
	
	if(isset($_POST['htpasswd_relative'])){
		$htpasswd_path = $_SERVER['DOCUMENT_ROOT'].$htpasswd;
	} else {
		$htpasswd_path = $htpasswd;
	}

	$buffer = "AuthName \"Protected Area\"\nAuthType Basic\nAuthUserFile ".$htpasswd_path."\nrequire valid-user";
	$handle = fopen($htaccess_path,'w') or die('Deadlock could not open the htaccess file for writing. '.$htaccess_path);
	fwrite($handle,$buffer) or die('Deadlock could not write the htaccess file. '.$htaccess_path);
	fclose($handle);
}

if(isset($_GET['step'])){
	switch($_GET['step']){
		case '2': $currentstep='2'; break;
		case '3': $currentstep='3'; break;
		default: $currentstep='1';
	}
} else {
	$currentstep = '1';
}

if($currentstep=='1'):

if(defined("DEADLOCK_INSTALLED")){
	die('Deadlock is already installed.');
}

if(!is_writable('../db_config.php')){
	if(!chmod('../db_config.php',0777)){
		$dbconfigpermissions = 'Deadlock has detected that db_config.php is not currently writable. If you are using Unix please CHMOD db_config.php to 777. Refresh the page once you have fixed this problem.';
	}
} else {
	$dbconfigpermissions = 'Deadlock has detected that db_config.php is currently writable. You may proceed.<br /><br />Click continue to proceed to step 2.
    <input type="button" onclick="window.location=\'./install.php?step=2\'" value="Continue&gt;&gt;" />';
}
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Deadlock Installation Step 1</title>
<link href="../images/admin.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="../images/hint.js">
/***********************************************
* Show Hint script- © Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for this script and 100s more.
***********************************************/
</script>
</head>

<body>
<table width="549" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="329" height="58"><a href="./index.php"><img src="../images/header_logo.gif" width="252" height="58" border="0" /></a></td>
    <td width="220"><div align="right"><img src="../images/tux.gif" width="48" height="48" /></div></td>
  </tr>
  <tr>
    <td height="2" colspan="2"><img src="../images/grey_pixel.gif" width="100%" height="2" /></td>
  </tr>
  <tr>
    <td height="20" colspan="2" class="style2"><strong>Installation Step 1</strong></td>
  </tr>
  <tr>
    <td colspan="2" class="style2">Welcome to the Deadlock installation script. This script will guide you through the entire setup process.<br /><br /><?=$dbconfigpermissions?></td>
  </tr>
  <tr>
    <td colspan="2">
    </td>
  </tr>
  
  <tr>
    <td height="21" colspan="2" class="footercell"><div align="center">Powered By <a href="http://phpdeadlock.sourceforge.net">Deadlock</a></div></td>
  </tr>
</table>
</body>
</html>
<?
elseif($currentstep=='2'):
if(!is_writable('../db_config.php')) die('Deadlock found that db_config.php is not writable. Did you skip step 1?');

if(isset($_POST['submit'])){
	if(empty($_POST['db_name'])){
		$errors[] = 'You must enter a database name.';
	}

	if(!isset($errors)){
		$text = '<?php
/******************************************************************************
* This file is part of the Deadlock PHP User Management System.               *
*                                                                             *
* File Description: mysql config file                                         *
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

// MySQL Configuration. Do NOT modify this file once the database has been
// created unless you know what you are doing.

// Mysql host
$mysql["host"] = "'.$_POST['db_host'].'";

// Mysql database name
$mysql["database"] = "'.$_POST['db_name'].'";

// Mysql table prefix
$mysql["prefix"] = "'.$_POST['db_prefix'].'";

// Your Mysql username for the above database
$mysql["username"] = "'.$_POST['db_username'].'";

// Mysql password for the above username
$mysql["password"] = "'.$_POST['db_password'].'";

define("DEADLOCK_INSTALLED",true);

?>';
		$handle=fopen('../db_config.php','w');
		fwrite($handle,$text) or die('Deadlock was unable to write the mysql configuration file. Make sure the file "db_config.php" exists and is writable.');
		fclose($handle);
		header('Location: '.$_SERVER['PHP_SELF'].'?step=3');
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Deadlock Installation Step 2</title>
<link href="../images/admin.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="../images/hint.js">
/***********************************************
* Show Hint script- © Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for this script and 100s more.
***********************************************/
</script>
</head>

<body>
<table width="549" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="329" height="58"><a href="./index.php"><img src="../images/header_logo.gif" width="252" height="58" border="0" /></a></td>
    <td width="220"><div align="right"><img src="../images/tux.gif" width="48" height="48" /></div></td>
  </tr>
  <tr>
    <td height="2" colspan="2"><img src="../images/grey_pixel.gif" width="100%" height="2" /></td>
  </tr>
  <tr>
    <td height="20" colspan="2" class="style2"><strong>Installation Step 
    2</strong></td>
  </tr>
  <tr>
    <td colspan="2" class="style2">Here you need to specify your MySQL database information, so that we can create the db_config.php file containing your database settings. </td>
  </tr>
  <tr>
    <td colspan="2"><? if (!empty($errors)){ ?>
      <table width="95%" height="24" border="0" align="center">
      <tr>
        <td height="20">
		<div class="style9"><ul>
		<?php
		foreach($errors as $error){
			print '<li>'.$error.'</li>';
		}
		?>
		</ul></div></td>
      </tr>
    </table>
      <? } else { print '<br />'; } ?>
      <br />
    <br />
    <form id="form1" name="form1" method="post" action="<?=$_SERVER['PHP_SELF']?>?<?=$_SERVER['QUERY_STRING']?>">
      <table width="70%" border="0" align="center">
        <tr>
          <td class="style5">MySQL Host:</td>
          <td><input name="db_host" type="text" id="db_host" value="localhost" />
            <a href="#" class="hintanchor" onmouseover="showhint('Enter the hostname of the server that the database is hosted on. Usually this is localhost.', this, event, '150px')">[?]</a></td>
        </tr>
        <tr>
          <td width="48%" class="style5">Database Name:</td>
          <td width="52%"><input name="db_name" type="text" id="db_name" />
            <a href="#" class="hintanchor" onmouseover="showhint('Please enter the name of your MySQL database.', this, event, '150px')">[?]</a></td>
        </tr>
        <tr>
          <td class="style5">Database Prefix:</td>
          <td><input name="db_prefix" type="text" id="db_prefix" value="deadlock_" />
		  <a href="#" class="hintanchor" onmouseover="showhint('Please enter the desired database prefix. This may be left blank for none.', this, event, '150px')">[?]</a></td>
        </tr>
        <tr>
          <td class="style5">Database Username:</td>
          <td><input name="db_username" type="text" id="db_username" />
		  <a href="#" class="hintanchor" onmouseover="showhint('Please enter the MySQL user you would like to connect to the database as.', this, event, '150px')">[?]</a></td>
        </tr>
        <tr>
          <td class="style5">Database Password:</td>
          <td><input name="db_password" type="password" id="db_password" />
		  <a href="#" class="hintanchor" onmouseover="showhint('Enter the password for the username specified above.', this, event, '150px')">[?]</a></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input type="submit" value="Submit" />
            <input name="submit" type="hidden" id="submit" value="1" /></td>
        </tr>
      </table>
    </form>
          <br /></td>
  </tr>
  
  <tr>
    <td height="21" colspan="2" class="footercell"><div align="center">Powered By <a href="http://phpdeadlock.sourceforge.net">Deadlock</a></div></td>
  </tr>
</table>
</body>
</html>
<?
elseif($currentstep=='3'):
if(!file_exists('../db_config.php')) die('db_config.php does not yet exist. Did you skip step 2?');
if(!defined('DEADLOCK_INSTALLED')){
	die('db_config.php does not have the needed data in it. It must not have been written correctly.');
}

if(isset($_POST['submit'])){
	// validate .htpasswd path field
	if(empty($_POST['htpasswd_path'])){
		$errors[] = 'Please enter the path to your .htpasswd file.';
	} else {
		if(isset($_POST['htpasswd_relative'])){
			$htpasswddir = $_SERVER['DOCUMENT_ROOT'].dirname($_POST['htpasswd_path']);
			$htpasswdfile = $_SERVER['DOCUMENT_ROOT'].$_POST['htpasswd_path'];
		} else {
			$htpasswddir = dirname($_POST['htpasswd_path']);
			$htpasswdfile = $_POST['htpasswd_path'];
		}
		// if the .htpasswd already exists, make sure it is writable before continuing
		if(file_exists($htpasswdfile) && !is_writable($htpasswdfile)){
			$errors[] = 'The .htpasswd file specified is not writable by Deadlock. If you created this file manually, please delete it before continuing.';
		}

		if(!file_exists($htpasswddir)){
			$errors[] = 'The directory that you specified in your .htpasswd path does not exist. The full path to the directory you specified is '.$htpasswddir.'.';
		} else {
			if(!is_writable($htpasswddir)){
				$errors[] = 'The directory that you specified in your .htpasswd path is not writable. If you are using Unix, CHMOD '.$htpasswddir.' to 777.';
			}
		}
	}
	// validate .htaccess path field
	if(empty($_POST['htaccess_path'])){
		$errors[] = 'Please enter the path to your .htaccess file.';
	} else {
		$htaccessdir = $_SERVER['DOCUMENT_ROOT'].dirname($_POST['htaccess_path']);
		$htaccessfile = $_SERVER['DOCUMENT_ROOT'].$_POST['htaccess_path'];
		// if the .htaccess already exists, make sure it is writable before continuing
		if(file_exists($htaccessfile) && !is_writable($htaccessfile)){
			$errors[] = 'The .htaccess file specified is not writable by Deadlock. If you created this file manually, please delete it before continuing.';
		}

		if(!file_exists($htaccessdir)){
			$errors[] = 'The directory that you specified in your .htaccess path does not exist. The full path to the directory you specified is '.$htaccessdir.'.';
		} else {
			if(!is_writable($htaccessdir)){
				$errors[] = 'The directory that you specified in your .htaccess path is not writable. If you are using Unix, CHMOD '.$htaccessdir.' to 777.';
			}
		}
	}
	if(isset($_POST['htpasswd_relative'])){
		$htpasswd_relative = 'true';
	} else {
		$htpasswd_relative = 'false';
	}
	// validate protected url field
	if(empty($_POST['protected_area_url'])){
		$errors[] = 'Please specify the URL to your protected area.';
	}
	// validate deadlock url field
	if(empty($_POST['deadlock_url'])){
		$errors[] = 'Please specify the URL to Deadlock.';
	}
	// validate admin email
	if(empty($_POST['admin_email'])){
		$errors[] = 'Please specify your email address.';
	}

	// create tables if there are no errors
	if(!isset($errors)){
		// connect to mysql
		mysql_connect($mysql['host'],$mysql['username'],$mysql['password']) or die('The script could not connect to MySQL. Install Failed.');
		mysql_select_db($mysql['database']) or die('Could not select MySQL database. Install failed.');
		generate_htpasswd($_POST['htpasswd_path'],$_POST['htaccess_path']);
		generate_htaccess($_POST['htpasswd_path'],$_POST['htaccess_path']);
		$sql[] = 'CREATE TABLE `'.$mysql['prefix'].'config` (
`id` int(10) NOT NULL auto_increment,
`option_name` varchar(30) NOT NULL default \'\',
`value` varchar(255) NOT NULL default \'\',
PRIMARY KEY  (`id`)
);';

		$sql[] = 'CREATE TABLE `'.$mysql['prefix'].'emails` (
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default \'\',
  `subject` varchar(255) NOT NULL default \'\',
  `body` text NOT NULL,
  PRIMARY KEY  (`id`)
);';

		$sql[] = 'CREATE TABLE `'.$mysql['prefix'].'logins` (
  `id` int(10) NOT NULL auto_increment,
  `type` varchar(20) NOT NULL default \'\',
  `username` varchar(30) default NULL,
  `timestamp` int(20) NOT NULL default \'0\',
  `user_agent` varchar(200) NOT NULL default \'\',
  `ip` varchar(50) NOT NULL default \'\',
  PRIMARY KEY  (`id`)
);';

		$sql[] = 'CREATE TABLE `'.$mysql['prefix'].'users` (
  `id` int(10) NOT NULL auto_increment,
  `firstname` varchar(30) NOT NULL default \'\',
  `lastname` varchar(30) NOT NULL default \'\',
  `email` varchar(50) NOT NULL default \'\',
  `phone` varchar(15) default NULL,
  `country` varchar(30) default NULL,
  `username` varchar(30) NOT NULL default \'\',
  `password` varchar(30) NOT NULL default \'\',
  `status` int(1) NOT NULL default \'1\',
  `registration_timestamp` int(20) NOT NULL default \'0\',
  `email_verify_code` varchar(12) default NULL,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
);';

		$sql[] = 'INSERT INTO `'.$mysql['prefix'].'config` (`id`, `option_name`, `value`) VALUES (1, \'admin_pass\', \'password\'),
(2, \'admin_email\', \''.$_POST['admin_email'].'\'),
(3, \'user_welcome_email\', \'true\'),
(4, \'admin_user_email\', \'true\'),
(5, \'require_admin_accept\', \'false\'),
(6, \'optional_fields_phone\', \'true\'),
(7, \'phone_digits\', \'10\'),
(8, \'optional_fields_country\', \'true\'),
(9, \'protected_area_url\', \''.$_POST['protected_area_url'].'\'),
(10, \'deadlock_url\', \''.$_POST['deadlock_url'].'\'),
(11, \'date_format\', \'n/j/Y\'),
(12, \'bulk_email_footer\', \'\'),
(13, \'admin_session_expire\', \'3600\'),
(14, \'debug_mode\', \'false\'),
(15, \'system_messages_email\', \'system@example.com\'),
(16, \'verify_email\', \'true\'),
(17, \'user_session_expire\', \'3600\'),
(18, \'email_user_accept\', \'true\'),
(19, \'htpasswd_path\', \''.$_POST['htpasswd_path'].'\'),
(20, \'htaccess_path\', \''.$_POST['htaccess_path'].'\'),
(21, \'protected_area_name\', \'Protected Area\'),
(22, \'prune_inactive_users\', \'true\'),
(23, \'admin_username\', \'true\'),
(24, \'digest_auth\', \'false\'),
(25, \'err_401_doc\', \'\'),
(26, \'htpasswd_relative\', \''.$htpasswd_relative.'\');';

		$sql[] = 'INSERT INTO `'.$mysql['prefix'].'emails` (`id`, `name`, `subject`, `body`) VALUES (1, \'admin_NewUser\', \'New User Notification\', \'Hello Admin. You have a new user for <%LoginURL%>\r\n\r\nName: <%FirstName%> <%LastName%>\r\nEmail: <%Email%>\r\nUsername: <%Username%>\r\nPassword: <%Password%>\'),
(2, \'admin_NewPendingUser\', \'New User Pending Approval\', \'Hello. Someone has registered to be a member of <%LoginURL%>. They either have not yet verified their email, or are waiting for your approval.\r\n\r\nName: <%FirstName%> <%LastName%>\r\nEmail: <%Email%>\r\nUsername: <%Username%>\r\nPassword: <%Password%>\r\n\r\nLogin to the admin control panel to view more information or to accept/reject the account. <%DeadlockURL%>/admin/login.php\'),
(3, \'user_WelcomeEmail\', \'Welcome to the protected area!\', \'Hello <%FirstName%>. You have been added to our database as a member.\r\n\r\nTo login, copy/paste the following URL into your web browser: <%LoginURL%>\r\n\r\nIf you have any problems logging in, please contact <%AdminEmail%>.\r\n\r\nCurrently, your account information is set to the following:\r\nName: <%FirstName%> <%LastName%>\r\nEmail: <%Email%>\r\nUsername: <%Username%>\r\nPassword: <%Password%>\r\n\r\nBest Regards,\r\nAdministrator\'),
(4, \'user_PendingApproval\', \'Your Account is Pending Approval\', \'Hello <%FirstName%>. Your account is now pending approval by the website administrator. You will be notified when your account is approved.\r\n\r\nYou submitted the following:\r\nName: <%FirstName%> <%LastName%>\r\nEmail: <%Email%>\r\nUsername: <%Username%>\r\nPassword: <%Password%>\r\n\r\nThanks,\r\nAdmin\'),
(5, \'user_AccountChanged\', \'Your account has been modified\', \'Hello <%FirstName%>. This is a courtesy email to let you know that your account has been modified. Your account information is as follows:\r\n\r\nName: <%FirstName%> <%LastName%>\r\nUsername: <%Username%>\r\nEmail: <%Email%>\r\nPassword: <%Password%>\r\n\r\nBest Regards,\r\nAdministrator\'),
(6, \'user_AccountApproved\', \'Your account has been approved!\', \'Hello <%FirstName%>. Your request to be a member has been approved by the administrator! You may now login at the following URL: <%LoginURL%>\r\n\r\nUsername: <%Username%>\r\nPassword: <%Password%>\r\n\r\nIf you have any trouble logging in, send an email to <%AdminEmail%>.\r\n\r\nBest Regards,\r\nAdministrator\'),
(7, \'user_AccountDenied\', \'Your account has been denied.\', \'Hello <%FirstName%>. Unfortunately, your request for an account has been denied by the site administrator.\r\n\r\nIf you have any questions or concerns, send an email to <%AdminEmail%>.\r\n\r\nBest Regards,\r\nAdministrator\'),
(8, \'user_EmailVerification\', \'You must verify your email\', \'Hello <%FirstName%>. Before you may become a member, you must verify that this is in fact your email address by clicking the below link. If you cannot click the below link, copy and paste it into your web browser.\r\n\r\n<%DeadlockURL%>/user/verifyemail.php?code=<%VerificationCode%>&username=<%Username%>\r\n\r\nBest Regards,\r\nAdministrator\'),
(9, \'user_ForgotPassword\', \'Your forgotten password\', \'Hello <%FirstName%>. Someone has requested that we send you your account username and password.\r\n\r\nUsername: <%Username%>\r\nPassword: <%Password%>\r\n\r\nBest Regards,\r\nAdministrator\');';

		// execute the query to insert data
		foreach($sql as $query){
			mysql_query($query) or die('The following MySQL query failed. The installation failed.<br /><br />MySQL said:'.mysql_error().'<br /><br />'.nl2br(htmlentities($query)));
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Deadlock Installation Complete</title>
<link href="../images/admin.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
<table width="549" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="329" height="58"><a href="./index.php"><img src="../images/header_logo.gif" width="252" height="58" border="0" /></a></td>
    <td width="220"><div align="right"><img src="../images/tux.gif" width="48" height="48" /></div></td>
  </tr>
  <tr>
    <td height="2" colspan="2"><img src="../images/grey_pixel.gif" width="100%" height="2" /></td>
  </tr>
  <tr>
    <td height="20" colspan="2" class="style2"><strong>Install Complete </strong></td>
  </tr>
  <tr>
    <td colspan="2" class="style2">As far as Deadlock can tell, the installation was successful. Before proceeding, please do the following things:<br />1) remove the install directory<br />2) CHMOD db_config.php back to 644<br /><br />The admin password is currently set to &quot;password&quot;. This should be changed as soon as possible!<br />
    <br />
    <a href="../admin/">Click here</a> to login to the admin panel. </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  
  <tr>
    <td height="21" colspan="2" class="footercell"><div align="center">Powered By <a href="http://phpdeadlock.sourceforge.net">Deadlock</a></div></td>
  </tr>
</table>
</body>
</html>
<?
exit;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Deadlock Installation Step 3</title>
<link href="../images/admin.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="../images/hint.js">
/***********************************************
* Show Hint script- © Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for this script and 100s more.
***********************************************/
</script>
</head>

<body>
<table width="549" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="329" height="58"><a href="./index.php"><img src="../images/header_logo.gif" width="252" height="58" border="0" /></a></td>
    <td width="220"><div align="right"><img src="../images/tux.gif" width="48" height="48" /></div></td>
  </tr>
  <tr>
    <td height="2" colspan="2"><img src="../images/grey_pixel.gif" width="100%" height="2" /></td>
  </tr>
  <tr>
    <td height="20" colspan="2" class="style2"><strong>Installation Step 3 </strong></td>
  </tr>
  <tr>
    <td colspan="2" class="style2">Here we need to specify settings required in order for Deadlock to function properly. Clicking Submit will create the database tables, provided there are no errors.</td>
  </tr>
  <tr>
    <td colspan="2"><? if (!empty($errors)){ ?>
      <table width="95%" height="24" border="0" align="center">
      <tr>
        <td height="20">
		<div class="style9"><ul>
		<?php
		foreach($errors as $error){
			print '<li>'.$error.'</li>';
		}
		?>
		</ul></div></td>
      </tr>
    </table>
      <? } else { print '<br />'; } ?>
      <br />
    <br />
    <form id="form1" name="form1" method="post" action="<?=$_SERVER['PHP_SELF']?>?<?=$_SERVER['QUERY_STRING']?>">
      <table width="70%" border="0" align="center">
        <tr>
          <td class="style5">Path to Htpasswd:</td>
          <td><input name="htpasswd_path" type="text" id="htpasswd_path" value="<? if(isset($_POST['htpasswd_path'])) print $_POST['htpasswd_path']; else print "/protected/.htpasswd"; ?>" />
            <a href="#" class="hintanchor" onmouseover="showhint('Enter the path to your htpasswd file. This must be relative to the document root. For example, if the URL to your protected area is http://www.example.com/protected/, in this field you would most likely enter &quot;/protected/.htpasswd&quot;.', this, event, '150px')">[?]</a></td>
        </tr>
        <tr>
          <td class="style5">&nbsp;</td>
          <td class="style2">Relative? 
            <input name="htpasswd_relative" type="checkbox" value="true"<? if($htpasswd_relative){ print ' checked="checked"'; } elseif(!isset($_POST['submit'])) { print ' checked="checked"'; } ?> />
            <a href="#" class="hintanchor" onmouseover="showhint('If this box is checked, the path entered above must be relative to your document root. If this box is not checked, the path above must be a full path.', this, event, '150px')">[?]</a></td>
        </tr>
        <tr>
          <td width="48%" class="style5">Path to Htaccess:</td>
          <td width="52%"><input name="htaccess_path" type="text" id="htaccess_path" value="<? if(isset($_POST['htaccess_path'])) print $_POST['htaccess_path']; else print "/protected/.htaccess"; ?>" />
            <a href="#" class="hintanchor" onmouseover="showhint('Enter the path to your htaccess file. This MUST be relative to the document root and MUST be within your protected area. For example, if the URL to your protected area is http://www.example.com/protected/, in this field you would most likely enter &quot;/protected/.haccess&quot;. This file MUST be in your protected area directory for Deadlock to function properly!', this, event, '200px')">[?]</a></td>
        </tr>
        <tr>
          <td class="style5">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td class="style5">Protected URL:</td>
          <td><input name="protected_area_url" type="text" id="protected_area_url" value="<? if(isset($_POST['protected_area_url'])) print $_POST['protected_area_url']; else print "http://".$_SERVER['HTTP_HOST']."/protected/"; ?>" />
		  <a href="#" class="hintanchor" onmouseover="showhint('Enter the URL to your protected area.', this, event, '150px')">[?]</a></td>
        </tr>
        <tr>
          <td class="style5">Deadlock URL:</td>
          <td><input name="deadlock_url" type="text" id="deadlock_url" value ="<? if(isset($_POST['deadlock_url'])) print $_POST['deadlock_url']; else print "http://".$_SERVER['HTTP_HOST'].str_replace('/install','',dirname($_SERVER['REQUEST_URI'])); ?>" />
		  <a href="#" class="hintanchor" onmouseover="showhint('This is the URL to the root directory of Deadlock. On most installations this will be http://www.yoursite.com/deadlock. Do NOT include a trailing forwardslash!', this, event, '150px')">[?]</a></td>
        </tr>
        <tr>
          <td class="style5">Admin Email: </td>
          <td><input name="admin_email" type="text" id="admin_email" value="<? if(isset($_POST['admin_email'])) print $_POST['admin_email']; else print "admin@example.com"; ?>" />
		  <a href="#" class="hintanchor" onmouseover="showhint('Enter your email address.', this, event, '150px')">[?]</a></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input type="submit" value="Submit" />
            <input name="submit" type="hidden" id="submit" value="1" /></td>
        </tr>
      </table>
    </form>
          <br /></td>
  </tr>
  
  <tr>
    <td height="21" colspan="2" class="footercell"><div align="center">Powered By <a href="http://phpdeadlock.sourceforge.net">Deadlock</a></div></td>
  </tr>
</table>
</body>
</html>
<? endif; ?>