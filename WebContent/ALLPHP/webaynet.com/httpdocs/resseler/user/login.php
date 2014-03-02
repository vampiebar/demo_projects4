<?php
/******************************************************************************
* This file is part of the Deadlock PHP User Management System.               *
*                                                                             *
* File Description: This file adds a user to the database                     *
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

// require the template engine class (MiniTemplator)
require('../lib/MiniTemplator.class.php');
$template = new MiniTemplator;
$templatedir = '../templates/';

// set the session name
session_name('user_sid');
// start the session
session_start();

// logout user
if(isset($_GET['action']) && $_GET['action'] == 'logout')
{
	session_destroy();
	redirect($_SERVER['PHP_SELF']);
}

// if the user is logged in, send them to the logged in page
if(isset($_SESSION['user_logged_in']))
{
	redirect('./account.php');
}

// if the login form has been submitted, let's see if the info submitted is valid
if(isset($_POST['username']) && isset($_POST['password'])){
	if(check_login_info($_POST['username'],$_POST['password'],$mysql['prefix']))
	{
		if(GetCurrentStatus($_POST['username'],$mysql['prefix']) == '2')
		{
			$_SESSION['user_logged_in'] = 1;
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['StartTimestamp'] = time();
			$_SESSION['UserIP'] = $_SERVER['REMOTE_ADDR'];
			$_SESSION['UserAgent'] = $_SERVER['HTTP_USER_AGENT'];
			redirect('./account.php');
		}
		else
		{
			$error = 'That account is currently inactive. It may be waiting for email validation or the administrator\'s approval.';
		}
	}
	else
	{
		$error = 'The username/password combination you entered was invalid.';
	}
}

// generate html login page using minitemplator
$template->readFileIntoString($templatedir."overall_header.html",$header);
$template->readFileIntoString($templatedir."user_panel_login.html",$main);
$template->readFileIntoString($templatedir."overall_footer.html",$footer);

$template->setTemplateString($header . $main . $footer);

// assign error variables
if(isset($error))
{
	$template->setVariable("error",$error);
	$template->addBlock("error");
}

if($config['verify_email']=='true')
{
	$template->addBlock("activation_enabled");
}

// set the php self variable which is used to submit the form.
$template->setVariable("phpself",$_SERVER['PHP_SELF']);

// set the url to the protected area
$template->setVariable("protected_url",$config['protected_area_url']);

$template->setVariable("footer",show_user_footer($software_signature));
$template->setVariable("pagename","User Login");
$template->generateOutput();
?>