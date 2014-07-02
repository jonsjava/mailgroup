<?php
session_start();
/* ######################################################################################## */
/* Mailer Group Solution -- Multi-User Mass Mailing System with opt out and Admin abilities */
/* Copyright (C) 2008  Jon Harris                                                           */
/*                                                                                          */
/* This program is free software; you can redistribute it and/or                            */
/* modify it under the terms of the GNU General Public License                              */
/* as published by the Free Software Foundation.                                            */
/*                                                                                          */
/* This program is distributed in the hope that it will be useful,                          */
/* but WITHOUT ANY WARRANTY; without even the implied warranty of                           */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the                            */
/* GNU General Public License for more details.                                             */
/*                                                                                          */
/* You should have received a copy of the GNU General Public License                        */
/* along with this program; if not, write to the Free Software                              */
/* Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.          */
/* ######################################################################################## */
if ($_SESSION['user_role'] != "admin"){
	session_unset();
	session_destroy();
	$_SESSION = array();
	header("location:index.php");
	exit();
}
include("../config.inc.php");
$sql1 = "SELECT * from system where `name` ='{$list_name}';";
$result1 = mysql_query($sql1);
$row = mysql_fetch_assoc($result1);
$halt_password = $row['password'];
if ($row['status'] == "up"){
	$change_status = "down";
}
else {
	$change_status = "up";
}
if (addslashes($_POST['halt_password']) == $halt_password){
	mysql_query("UPDATE system SET status='{$change_status}' WHERE `name`='{$list_name}'");
	header("location:index.php?page=halt_system");
	exit();
}
else {
	session_unset();
	session_destroy();
	$_SESSION = array();
	header("location:index.php");
	exit();
}