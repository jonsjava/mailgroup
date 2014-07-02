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
include("config.inc.php");
/* ################################################################################### */
/* 	Query to validate user                                                             */
/* ################################################################################### */
$username = mysql_real_escape_string($_POST["username"]);
$password = mysql_real_escape_string($_POST["password"]);
$sql = "SELECT * FROM `users_{$list_name}`
		where 
		`uname` = '{$username}' 
		and 
		`password` = '{$password}' 
		limit 1;";


$result = @mysql_query($sql);
$validate = @mysql_num_rows($result);
/* ################################################################################### */
/* 	END Query to validate user                                                         */
/* ################################################################################### */




/* ################################################################################### */
/* 	Ok, they are valid, so we set their login paramaters in the session values         */
/* ################################################################################### */
if ($validate > 0){
	$row = @mysql_fetch_array($result);
	if ($row['accepted_tos'] == "0"){
		$_SESSION['id'] = $row['id'];
		/*print "Need to accept TOS";
		exit();*/
		header("location:tos.php");
		exit();
	}
	if ($row['valid_user'] == "0"){
		header("location:index.php");
		/*print "Disabled User";*/
		exit();
	}
	$_SESSION['is_valid'] = true;
	$_SESSION['email_address'] = $row['email_address'];
	$_SESSION['full_name'] = $row['first_name']." ".$row['last_name'];
	$_SESSION['username'] = $row['uname'];
	$_SESSION['group_id'] = $row['id'];
	$_SESSION['group_name'] = $row['group_name'];
	/*print "Valid user";
		exit();*/
	header("location:index.php");
	exit();
}




/* ################################################################################### */
/*	They aren't valid. boot them to the login screen                                   */
/* ################################################################################### */
else{
	header("location:index.php");
	exit();
}
?>