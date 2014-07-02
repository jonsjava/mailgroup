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

<html>
	<head>
		<title>
			Group Mailer Admin
		</title>
	</head>
	<body>
	<center>
		<table align="center">
			<form method="POST" action="p_login.php" id="Admin Login">
			<tr>
				<td>
					Username:
				</td>
				<td>
					<input type="text" name="username">
				</td>
			</tr>
			<tr>
				<td>
					Password:
				</td>
				<td>
					<input type="password" name="password">
				</td>
			</tr>
			<tr>
				<td>
					<input type="submit" value="Submit">
				</td>
			</tr>
			</form>
		</table>
	</center>
	</body>
</html>
<?php

?>