<?php
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
$uname2 = $_POST['uname2'];
$password = addslashes($_POST['password']);
$level = addslashes($_POST['level']);
session_start();
include("../config.inc.php");
$creation_note = "Created on ".$ccdate." by ".$_SESSION['uname']."\n************\n";
if ($_SESSION['user_role'] == "supervisor" || 
		$_SESSION['user_role'] == "admin" ){

	$sql= "INSERT INTO `moderator_{$list_name}`(
			`id`, 
			`level`, 
			`uname`,
			`password`,
			`history`) 
			VALUES('', 
			'$level', 
			'$uname2', 
			'$password',
			'$creation_note');";
	mysql_query($sql);
	header("location:index.php");
			exit();
		}
else{
	header("location:logout.php");
	exit();
}
