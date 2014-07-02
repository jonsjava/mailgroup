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
if ($_SESSION['user_role'] == "supervisor" || 
$_SESSION['user_role'] == "admin" || $_SESSION['user_role'] == "moderator")
{
	if ($_POST['delete'] == "yes"){
	include("../config.inc.php");
	$username = addslashes($_POST["uname"]);
	$sql = "UPDATE `users_{$list_name}` SET `valid_user` = 0 WHERE `uname` = '{$username}';";
	@mysql_query($sql);
	$sql = "SELECT * FROM `users_{$list_name}` WHERE `uname`='{$username}';";
	$result = mysql_query($sql);
	$user_row = mysql_fetch_assoc($result);
	$user_history = $user_row['logs'];
	$username = $user_row['uname'];
	$new_logs = $user_history;
	$new_logs .= "Disabled on ".$ccdate." by ".$_SESSION['uname']."\n************\n";
	$sql = "UPDATE `users_{$list_name}` SET `logs`='{$new_logs}' WHERE uname='{$username}';";
	mysql_query($sql);
	$sql = "SELECT * FROM `moderator_{$list_name}` WHERE `uname`='{$_SESSION['uname']}';";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$mod_logs = $row['history'];
	$new_mod_logs = $mod_logs;
	$new_mod_logs .= "Disabled {$username} on {$ccdate}.\n************\n";
	$sql = "UPDATE `moderator_{$list_name}` SET `history` = '{$new_mod_logs}' WHERE `uname`='{$_SESSION['uname']}';";
	mysql_query($sql);
	header("location:index.php");
}
else{
	header("location:index.php");
	exit();
}
}
else{
	header("location:logout.php");
}
?>
