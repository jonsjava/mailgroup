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
session_start();
if ($_SESSION['user_role'] == "moderator" || 
		$_SESSION['user_role'] == "supervisor" || 
		$_SESSION['user_role'] == "admin")
		{
			include("../config.inc.php");
			$creation_note = "Created on ".$ccdate." by ".$_SESSION['uname']."\n************\n";
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			$uname = $_POST['uname'];
			$password = $_POST['password'];
			$group_name = $_POST['group_name'];
			@mysql_query("INSERT INTO users_{$list_name}(
			`id`, 
			`email_address`, 
			`last_name`, 
			`first_name`, 
			`uname`, 
			`password`,
			`group_name`, 
			`gid`, 
			`accepted_tos`, 
			`valid_user`,
			`logs`) 
			VALUES('', 
			'{$email}', 
			'{$last_name}', 
			'{$first_name}', 
			'{$uname}', 
			'{$password}',
			'{$group_name}', 
			'', 
			'', 
			'',
			'{$creation_note}');");
			@mysql_query("
			CREATE TABLE IF NOT EXISTS `{$uname}_table_{$list_name}` (
 			 `id` int(255) NOT NULL auto_increment,
			  `date_joined` varchar(60) NOT NULL,
			  `email_address` varchar(60) NOT NULL,
			  `verified` varchar(1) NOT NULL default '0',
			  `name` varchar(66) NOT NULL,
			  PRIMARY KEY  (`id`),
			  KEY `verified` (`verified`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;");
		$sql = "SELECT * from `moderator_{$list_name}` WHERE `uname`='{$_SESSION['uname']}';";
		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);
		$history = $row['history'];
		$history .= "Created ".$uname." on ".$ccdate."\n************\n";
		$sql = "UPDATE `moderator_{$list_name}` SET `history`='{$history}' WHERE `uname`='{$_SESSION['uname']}';";
		@mysql_query($sql);
	header("location:index.php");
	exit();
		}
else{
	print $_SESSION['user_role'];
	print "invalid user";
	exit();
	header("location:index.php");
	exit();
}
		

?>
