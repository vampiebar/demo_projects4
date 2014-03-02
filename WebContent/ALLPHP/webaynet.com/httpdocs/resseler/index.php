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
require('db_config.php');

// make sure deadlock is installed, if not, send the user to the install page
if(!defined("DEADLOCK_INSTALLED")){
	redirect('./install/install.php');
}

// make sure the install directory does not exist
if(file_exists('./install/')){
	die('Please remove the install directory before continuing.');
}

// Redirect function. This must be used before any data is sent to the browser.
function redirect ($location){
	header('Location: '.$location);
	exit;
}

// redirect to user login page
redirect('user/login.php');
?>    