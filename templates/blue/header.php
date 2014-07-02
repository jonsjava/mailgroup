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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="en" dir="ltr">
<head>

<meta http-equiv="Content-type" content="text/html;charset=iso-8859-1" />
<link rel="shortcut icon" href="favicon.ico" />
<title><?php include("site_title.php");print $site_title; ?></title>
<link rel="stylesheet" type="text/css" href="templates/blue/main.css" />
</head>
<div id="container">
	<div id="head">
		<div id="headleft">
		</div>
		<div style="float: right; text-align: right;"><p></p>
		
		<?php if (isset($_SESSION['username'])){
			?>
		<table border="0"><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td><a href="help.php"><img src="templates/blue/info.png" border="0" title="Help" alt="Help"></a> &nbsp; <a href="logout.php"><img src="templates/blue/exit.png" border="0" alt="Logout" title="Logout"></a></td></tr></table>
		<?php
		}
		?>
		
		
		</div>
 	</div>

	<div id="main">
	<br />
	<table align="center" style="width: 100%; margin-top: 5px; border: 1px solid #bbd2e0;" border="0" cellpadding="2" cellspacing="2">
		<tr class="browse_rows_actions">
			<td colspan="12">
				<table style="width: 100%;" border="0" cellpadding="2" cellspacing="0"><tr><td valign="top" style="text-align: left;">
					<?php if ($_SESSION['is_valid'] == true){ ?>	<center><table align="center"><tr><td align="center"><?php if (!(isset($_GET['page']))){ ?><form id="form1" name="form1" method="post" action="send_email.php"><input type="image" src="templates/blue/email3.gif" border="0" value="submit" alt="Send Email" title="Send Email"> <?php } else{?> <a href="index.php"><img src="templates/blue/email3.gif" border="0" title="Send Email" alt="Send Email"></a><?php } ?> </td><td align="center">&nbsp;</td><td align="center"><?php if ($_GET['page'] == "addcontacts"){?><form method="POST" action="add_contacts.php"><input type="image" src="templates/blue/customers1.gif" value="submit" alt="Add Contacts" title="Add Contacts"><?php } else{ ?> <a href="index.php?page=addcontacts"><img src="templates/blue/customers1.gif" border="0" alt="Add Contacts" title="Add Contacts"></a><?php }?></td><td align="center">&nbsp;</td><td align="center"><a href='?page=show_all_contacts'><img src="templates/blue/Button_BulletedList.jpg" border="0" alt="Show All Contacts" title="Show All Contacts"></a></td></tr><tr><td align="center">Send Email</td><td align="center">&nbsp;&nbsp;|&nbsp;&nbsp;</td><td align="center">Add Contacts</td><td align="center">&nbsp;&nbsp;|&nbsp;&nbsp;</td><td align="center">Show All Contacts</td></tr></table><br /><?php }