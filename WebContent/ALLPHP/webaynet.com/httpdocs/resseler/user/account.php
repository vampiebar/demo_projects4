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

// make sure user is logged in
require('auth.inc.php');

// require the template engine class (MiniTemplator)
require('../lib/MiniTemplator.class.php');
$template = new MiniTemplator;
$templatedir = '../templates/';

if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['verify']))
{
	remove_user($_SESSION['username'],$mysql['prefix']);
	generate_htpasswd($mysql['prefix']);
	session_destroy();
	redirect('./login.php');
}

$sql= 'SELECT * FROM '.$mysql['prefix'].'users WHERE username="'.$_SESSION['username'].'"';

if(!$result = mysql_query($sql))
{
	die('The following MySQL query failed. User data could not be retrieved. '.$sql);
}

// assign the user info to variables
while (($row = mysql_fetch_array($result)) != false)
{
	$firstname = $row['firstname'];
	$lastname = $row['lastname'];
	$country = $row['country'];
	$phone = $row['phone'];
	$username = $row['username'];
	$email = $row['email'];
	$status = $row['status'];
	$RegistrationDate = date($config['date_format'],$row['registration_timestamp']);
}

if($country=='Not Selected')
{
	$country = '<i>Not Available</i>';
}

if(empty($phone))
{
	$phone = '<i>Not Available</i>';
}


$template->readFileIntoString($templatedir."overall_header.html",$header);
$template->readFileIntoString($templatedir."account_information.html",$main);
$template->readFileIntoString($templatedir."overall_footer.html",$footer);

$template->setTemplateString($header . $main . $footer);

// set the php self variable which is used to submit the form.
$template->setVariable("phpself",$_SERVER['PHP_SELF']);

// set the first name
$template->setVariable("firstname",$firstname);
// set the last name
$template->setVariable("lastname",$lastname);
// set the username
$template->setVariable("username",$username);
// set the email
$template->setVariable("email",$email);
// set the country
$template->setVariable("country",$country);
// set the phone
$template->setVariable("phone",$phone);
// set the registration date
$template->setVariable("registered",$RegistrationDate);

$javascript = <<<EOT
function deleteaccount(){
	var answer = confirm('Are you sure you want to delete your account? This action is irreversible!');
	if(answer==true){
		window.location="account.php?action=delete&verify=1";
	}
}
EOT;

// add javascript to the header
$template->setVariable("code",$javascript);
$template->addBlock("code");
$template->addBlock("javascript");

$template->setVariable("footer",show_user_footer($software_signature));
$template->setVariable("pagename","My Account");
$template->generateOutput();
?>