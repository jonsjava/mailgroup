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
if ($_SESSION['is_valid'] != true){
	include("login.php");
}
include("config.inc.php");
if (isset($_GET['id'])){
	$removal_sql = "DELETE FROM `{$_SESSION['username']}_table_{$list_name}` WHERE id={$_GET['id']} LIMIT 1;";
		mysql_query($removal_sql);
}
else{
$removal = implode($_POST);
foreach($_POST as $key => $value) {
	 if ($value != "DELETE"){
	$removal_sql = "DELETE FROM `{$_SESSION['username']}_table_{$list_name}` WHERE id={$value} LIMIT 1;";
		 mysql_query($removal_sql);
		}
	
}
}
header("location:index.php?page=show_all_contacts");
exit();
?>