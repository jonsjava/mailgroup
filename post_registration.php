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
/* 	This script will allow contacts to register themselves from a web form             */
/* 	as long as the list they are registering for is allowed to use a web               */
/* 	form and their referring address is the one on record for that list                */
/* ################################################################################### */
$list_id = addslashes($_GET['list']);
$email = addslashes($_POST['email']);
$ref = getenv("HTTP_REFERER");
include("config.inc.php");
$sql = "SELECT * FROM users_{$list_name} WHERE `id`='{$list_id}' AND `valid_user` ='1' AND `can_form` = '1' AND `refer_url` = '{$ref}' LIMIT 1;";
$result = mysql_query($sql);
$check_results = mysql_num_rows($result);
if ($check_results == 1){
	$row = mysql_fetch_assoc($result);
	$user = $row['uname'];
	$user_table = $user."_table_".$list_name;
	$full_name = $row['first_name']." ".$row['last_name'];
	$sender_address = $row['email_address'];
	/* Check to see if they are already registered */
	$sql = "SELECT * from `{$user_table}` WHERE `email_address = '{$value}';";
	$results = @mysql_query($sql);
	$has_email_addresses = @mysql_num_rows($results);
	if ($has_email_addresses == 0){
	
	
	
	
	
 	$to = $email;
	$subject = "Please confirm your e-mail address";
	$body = "We recently received a request from your e-mail address to join our mailing list. To be added, please go to ".$site_address."confirm_email.php?id=".$row23['id']."&gid={$_SESSION['group_id']} \n Once you have visited that site, you will begin to receive periodic messages from our staff.  If you receive this message in error, please disregard, and you will not receive any further messages from us.";
	$header="From:{$_SESSION['fullname']}<{$_SESSION['email_address']}>\n";
  	$header .= "Reply-To: {$_SESSION['email_address']}\n"; 
  	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-Type: text/html; charset=iso-8859-1\n";
	$headers .= "Content-Transfer-Encoding: quoted-printable\n";
	mail($to, $subject, $body, $header);
	}
	
}