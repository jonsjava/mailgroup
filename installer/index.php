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
$install_in_progress = true;
include("../config.inc.php");
if ($_GET['go'] == "update"){
	mysql_query("ALTER TABLE `users_{$list_name}` ADD `group_name` VARCHAR(55) NOT NULL;");
	$sql = "SELECT * FROM users_{$list_name};";
	$result = mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)){
		$table = $row['uname']."_table".$list_name;
		$sql5 = "ALTER TABLE `{$table}` ADD `name` VARCHAR(55) NOT NULL;";
		mysql_query($sql5);
		header("location:?update=complete");
		exit();
	}
}
if ($_GET['go'] == "install"){
	$sql= "CREATE TABLE IF NOT EXISTS `system` (
  `id` int(30) NOT NULL auto_increment,
  `name` varchar(66) NOT NULL,
  `status` varchar(4) NOT NULL default 'up',
  `password` varchar(66) NOT NULL,
  `tos` longtext NOT NULL,
  `total_sent` int(60) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;";
mysql_query($sql);

$sql = "INSERT INTO `system` (`id`, `name`, `status`, `password`, `tos`, `total_sent`) VALUES
('', '{$list_name}', 'up', '{$_POST['system_pass']}', 'Admin has not set the TOS yet.', 0);";
mysql_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `system_stats_{$list_name}` (
  `total_sent` int(60) NOT NULL,
  `top_sender` varchar(60) NOT NULL,
  `top_sender_total` int(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql);

$sql = "INSERT INTO `system_stats_{$list_name}` (`total_sent`, `top_sender`, `top_sender_total`) VALUES
(0, 'nobody', 0);";
mysql_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `moderator_{$list_name}` (
  `id` int(60) NOT NULL auto_increment,
  `level` int(1) NOT NULL,
  `uname` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `last_login` varchar(55) NOT NULL,
  `history` longtext NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uname` (`uname`),
  KEY `level` (`level`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;";
mysql_query($sql);

$sql = "INSERT INTO `moderator_{$list_name}` (`id`, `level`, `uname`, `password`, `last_login`, `history`) VALUES
(1, 3, '{$_POST['admin_user']}', '{$_POST['admin_pass']}', '', 'Created by Installer Script on {$ccdate}\n************\n');";
mysql_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `users_{$list_name}` (
  `id` int(60) NOT NULL auto_increment,
  `email_address` varchar(60) NOT NULL,
  `last_name` varchar(55) NOT NULL,
  `first_name` varchar(55) NOT NULL,
  `uname` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `group_name` varchar(55) NOT NULL,
  `gid` varchar(60) NOT NULL,
  `last_login` varchar(55) NOT NULL,
  `logs` longtext NOT NULL,
  `pieces_sent` int(60) NOT NULL,
  `total_sent` int(60) NOT NULL,
  `accepted_tos` int(1) NOT NULL default '0',
  `valid_user` int(1) NOT NULL default '0',
  `can_form` int(1) NOT NULL,
  `refer_url` varchar(99) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `read_tos` (`accepted_tos`),
  KEY `email_address` (`email_address`),
  KEY `valid_user` (`valid_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;";
mysql_query($sql);
header("location:index.php?go=complete");
exit();
}
include("header.php");
include("navbar.php");

if ($_GET['go'] == "complete"){
	?>
	<center><h2>INSTALL COMPLETE</h2><br />
	<p>Please remove the /insaller folder before going any further</p>
	<p>Once you have done that, go to <a href="<?php print $site_address; ?>admin/"><?php print $site_address; ?>admin/</a> and login</p>
	<p>with the username/password you used in the setup.</p>
	<?php
}
if ($_GET['update'] == "complete"){
	?>
	<center><h2>UPDATE COMPLETE</h2><br />
	<p>Please remove the /insaller folder before going any further</p>
	<p>Once you have done that, go to <a href="<?php print $site_address; ?>admin/"><?php print $site_address; ?>admin/</a> and modify</p>
	<p>the users, giving them group names.</p>
	<?php
}
else{
?>

<form method="POST" action="index.php?go=install">
<table>
	<tr>
		<td>
			<center><strong><p>To update a previous install, go <a href="?go=update">HERE</a></p></strong></center>
			<p>Very rudimentiry installer script. To be fixed when I get a chance</p>
			<p>You can use the same database on different installs, simply change</p>
			<p>the <strong>config.inc.php</strong> for each install, and it will take care of the </p>
			<p>rest. Each user must be added my an admin/moderator/supervisor</p>
			<p><h2>MAKE SURE YOU HAVE THE DATABASE CREATED BEFORE USING THIS SCRIPT!</h2></p><br />
		</td>
	</tr>
	<tr>
		<td>
			Admin Username:
		</td>
		<td>
			<input type="text" name="admin_user">
		</td>
	</tr>
	<tr>
		<td>
			Admin Password(will be shown):
		</td>
		<td>
			<input type="text" name="admin_pass">
		</td>
	</tr>
	<tr>
		<td>
			System Shutdown Password(will be shown):
		</td>
		<td>
			<input type="text" name="system_pass">
		</td>
	</tr>
	<tr><td><input type="submit" value="Submit" name="submit"></td></tr>
</table></form>
<?php
}
include("footer.php");
?>
