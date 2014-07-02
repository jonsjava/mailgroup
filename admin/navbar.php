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
if ($_SESSION['is_valid_moderator'] == true){
	?>
<table align="center" border="0">
	<tr>
	<td><a href="?page=main">Main</a> |</td><td><a href="?page=add_user">Add User</a> |</td><td><a href="?page=delete_user">Delete User</a> |</td><td><a href="?page=show_all_users">Show All Users</a> |</td><?php if ($_SESSION['user_role'] == "supervisor" || 
		$_SESSION['user_role'] == "admin" )
		{ print "<td> <a href='?page=add_moderator'>Add Moderator</a> | <td> <a href='?page=disable_moderator'>Disable Moderator</a> | <td> <a href='?page=show_moderator_history'>Show Moderator History</a> | <td><a href='?page=mod_tos'>Modify TOS</a> | ";}?><td><font color="Red"><?php if ($_SESSION['user_role'] == "admin"){ print "<a href='?page=halt_system'>Shutdown system</a> | ";}?></td></td> <td><a href="logout.php">Logout</a> |</td>
	</tr>
</table>
<?php
}
?>
