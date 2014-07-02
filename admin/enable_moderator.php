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
$_SESSION['user_role'] == "admin")
{
	if ($_POST['action'] == "enable"){
		$id = $_POST['id'];
		include("../config.inc.php");
		$sql = "UPDATE `moderator_{$list_name}` SET `level` = 1 WHERE `id` = '{$id}';";
		@mysql_query($sql);
		$sql = "SELECT * FROM `moderator_{$list_name}` WHERE `id`='{$id}';";
		$result = mysql_query($sql);
		$user_row = mysql_fetch_assoc($result);
		$user_history = $user_row['history'];
		$new_logs = $user_history;
		$new_logs .= "Re-Enabled on ".$ccdate." by ".$_SESSION['uname']."\n************\n";
		$sql = "UPDATE `moderator_{$list_name}` SET `history`='{$new_logs}' WHERE `id`='{$id}';";
		mysql_query($sql);
		header("location:index.php");
	}
}
else{
	header("location:logout.php");
}
?>
