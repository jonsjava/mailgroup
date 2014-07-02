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
$template_inc = $template_dir.$template."/";
include($template_inc."header.php");
print "<h1><strong> Accept Terms Of Service</strong></h1><br />";
?>
	<form method="POST" action="accept_tos.php">
		<table align="center" border="0">
		<tr>
			<td>
			</td>
		</tr>
		<tr>
		<td><textarea name="contacts" rows="30" cols="75"><?php print $tos; ?></textarea></td>
		</tr>
		<tr><td>Do you accept the terms of agreement (TOS)?</td></tr>
		<tr>
			<td><input type="submit" name="submit" value="Yes"></form><form method="POST" action="logout.php"><input type="submit" name="submit" value="No"></td>
		</tr>
		</table>
	</center>
	<?php
	include($template_inc."footer.php");
