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


/* ################################################################################### */
/* 	Database connection and date variables                                             */
/* ################################################################################### */
$host = "localhost";
$db = "database_name"; 
$db_user = "database_username";
$db_password = "database_password";
$day = date("d");
$month = date("M");
$year = date("Y");
$ccdate = $day."/".$month."/".$year;
$link = mysql_connect($host, $db_user, $db_password);
mysql_select_db($db);
/* ################################################################################### */
/* 	END Database connection and date variables                                         */
/* ################################################################################### */


/* ################################################################################### */
/* 	Variables for the removal/mailer system                                            */
/* ################################################################################### */
$web_addr = "http://example.com";
$server_root = "/mailer/";

$list_name = "name_for_this_install";
$template = "blue";
/* ################################################################################### */
/* 	END Variables for the removal/mailer system                                        */
/* ################################################################################### */

if ($install_in_progress != true){
$sql11 = "SELECT * from system where `name` ='{$list_name}';";
$result11 = mysql_query($sql11);
$row11 = mysql_fetch_assoc($result11);
$system_status = $row11['status'];
$tos = $row11['tos'];
}
$template_dir = "templates/";
$template_inc = $template_dir.$template."/";
$site_address = $web_addr.$server_root;
?>