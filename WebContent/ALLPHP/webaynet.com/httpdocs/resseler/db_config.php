<?php
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
$mysql["host"] = "localhost";

// Mysql database name
$mysql["database"] = "reseler";

// Mysql table prefix
$mysql["prefix"] = "resseler";

// Your Mysql username for the above database
$mysql["username"] = "reseler";

// Mysql password for the above username
$mysql["password"] = "125100";

define("DEADLOCK_INSTALLED",true);

?>