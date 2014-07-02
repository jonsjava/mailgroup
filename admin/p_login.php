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
include("../config.inc.php");
/* ################################################################################### */
/* 	Query to validate user                                                         */
/* ################################################################################### */
$username = addslashes($_POST["username"]);
$password = addslashes($_POST["password"]);


$sql = "SELECT * 
		FROM moderator_{$list_name} 
		where 
		`uname` = '{$username}' 
		and 
		`password` = '{$password}'
		and
		`level` != 0 
		limit 1;";

$result = @mysql_query($sql);
$validate = @mysql_num_rows($result);
/* ################################################################################### */
/* 	END Query to validate user                                                     */
/* ################################################################################### */



/* ################################################################################### */
/* 	Ok, they are valid, so we set their login paramaters in the session values     */
/* ################################################################################### */
if ($validate > 0){
	$row = @mysql_fetch_array($result);
	$_SESSION['is_valid_moderator'] = true;
	$_SESSION['uname'] = $row['uname'];
	
	
	if ($row['level'] == 1){
		$_SESSION['user_role'] = "moderator";
		header("location:index.php");
		exit();
	}
	
	
	if ($row['level'] == 2){
		$_SESSION['user_role'] = "supervisor";
		header("location:index.php");
		exit();
	}
	
	
	if ($row['level'] == 3){
		$_SESSION['user_role'] = "admin";
		header("location:index.php");
		exit();
	}
}



/* ################################################################################### */
/*	They aren't valid. boot them to the login screen                               */
/* ################################################################################### */
else{
	header("location:index.php");
	exit();
}
?>
