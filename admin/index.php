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
include("../config.inc.php");
include("header.php");
include("navbar.php");
if ($_SESSION['is_valid_moderator'] != true){
	include("login.php");
	include("footer.php");
}
else{

	
	
	
	/* ################################################################################### */
	/* 	Variable to handle searches--it's the start page                                   */
	/* ################################################################################### */
	if (!isset($_GET['page']))
	{
		$_GET['page'] = "main";
	}
	
	
	
	
	/* ################################################################################### */
	/* Variables to handle user accounts --all moderators see these                        */
	/* ################################################################################### */
	if ($_GET['page'] == "main")
	{
		if ($_SESSION['user_role'] == "moderator" || 
		$_SESSION['user_role'] == "supervisor" || 
		$_SESSION['user_role'] == "admin")
		{
			$sql = "SELECT * FROM `system_stats_{$list_name}`;";
			$results = mysql_query($sql);
			$row = mysql_fetch_assoc($results);
			$top_sender = $row['top_sender'];
			$total_sent = $row['total_sent'];
			$top_sender_total = $row['top_sender_total'];
			?>
			<table align="center" border="0">
				<tr>
					<td><h1><strong>STATS FOR <?php print $list_name; ?>:</strong></h1></td>
				</tr>
				<tr>
					<td>Top Sender:</td>
					<td><?php print $top_sender; ?></td>
				</tr>
				<tr>
					<td>Number Top Sender Has Sent:</td>
					<td><?php print $top_sender_total; ?></td>
				</tr>
				<tr>
					<td>Total Sent from <?php print $list_name; ?>:</td>
					<td><?php print $total_sent; ?></td>
				</tr>
			</table>
			
			<?php
		}
	}
	elseif ($_GET['page'] == "add_user")
	{
		if ($_SESSION['user_role'] == "moderator" || 
		$_SESSION['user_role'] == "supervisor" || 
		$_SESSION['user_role'] == "admin")
		{
			?>
			<form method="POST" action="add_user.php">
			<table align="center" border="0">
				<tr>
					<td><h1><strong>ADD USER</strong></h1></td>
				</tr>
				<tr>
					<td>Mail Group Name:</td>
					<td><input type="text" name="group_name"></td>
				</tr>
				<tr>
					<td>First Name:</td>
					<td><input type="text" name="first_name"></td>
				</tr>
				<tr>
					<td>Last Name:</td>
					<td><input type="text" name="last_name"></td>
				</tr>
				<tr>
					<td>E-Mail Address:</td>
					<td><input type="text" name="email"></td>
				</tr>
				<tr>
					<td>Username:</td>
					<td><input type="text" name="uname"></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="text" name="password"></td>
				</tr>
				<tr>
					<td><input type="submit" value="submit"></td>
				</tr>
			</table>
			</form>
			<?php
			
		}
	}
	elseif ($_GET['page'] == "delete_user")
	{
		if ($_SESSION['user_role'] == "moderator" || 
		$_SESSION['user_role'] == "supervisor" || 
		$_SESSION['user_role'] == "admin")
		{
			?>
			<form method="POST" action="delete_user.php">
			<table align="center" border="0">
				<tr>
					<td><h1><strong>REMOVE USER</strong></h1></td>
				</tr>
				<tr>
					<td>Username:</td>
					<td><input type="text" name="uname"></td>
				</tr>
				<tr>
					<td>Are You Sure?</td>
					<td><input type="checkbox" name="delete" value="yes">Yes</td>
				</tr>
				<tr>
					<td><input type="submit" value="submit"></td>
				</tr>
			</table>
			</form>
			<?php
			
		}
	}
	elseif ($_GET['page'] == "show_all_users")
	{
		if ($_SESSION['user_role'] == "moderator" || 
		$_SESSION['user_role'] == "supervisor" || 
		$_SESSION['user_role'] == "admin")
		{
			$sql22 = "SELECT * FROM users_{$list_name} where `valid_user`=1";
			$result22 = mysql_query($sql22);
			print "<table align='center' border='0'>
				<tr>
					<td><h1><strong>SHOWING ALL TOS-AGREED USERS</strong></h1></td>
				</tr>";
			while ($row22 = mysql_fetch_assoc($result22)){
				?>
					<tr>
						<td><a href="index.php?page=view_user&uid=<?php print $row22['id']; ?>"><?php print $row22['uname']; ?></a></td>
					</tr>
				<?php
			}
			print "</table>";
		}
	}
	elseif ($_GET['page'] == "view_user")
	{
		if ($_SESSION['user_role'] == "moderator" || 
		$_SESSION['user_role'] == "supervisor" || 
		$_SESSION['user_role'] == "admin")
		{
			$sql22 = "SELECT * FROM users_{$list_name} where `id`={$_GET['uid']} LIMIT 1";
			$result22 = mysql_query($sql22);
			
			$row22 = mysql_fetch_assoc($result22);
			print "<table align='center' border='0'>
				<tr>
					<td><h1><strong>Viewing User: ".$row22['uname']."</strong></h1></td>
				</tr>";
				?>
				<form action="update_user.php" method="POST">
				<tr>
					<td>Mail Group Name:</td>
					<td><input type="text" name="group_name" value="<?php print $row22['group_name']; ?>"></td>
				</tr>
				<tr>
					<td>First Name:</td>
					<td><input type="text" name="first_name" value="<?php print $row22['first_name']; ?>"></td>
				</tr>
				<tr>
					<td>Last Name:</td>
					<td><input type="text" name="last_name" value="<?php print $row22['last_name']; ?>"></td>
				</tr>
				<tr>
					<td>E-Mail Address:</td>
					<td><input type="text" name="email" value="<?php print $row22['email_address']; ?>"></td>
				</tr>
				<tr>
					<td>Username:</td>
					<td><input type="hidden" name="uname" value="<?php print $row22['uname']; ?>"><?php print $row22['uname']; ?></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="text" name="password" value="<?php print $row22['password']; ?>"></td>
				</tr>
				<tr>
					<td>History</td>
					<td><textarea name="history" cols="60" rows="15"><?php print $row22['logs']; ?></textarea></td>
				</tr>
				<tr>
					<td>Disable Account?</td>
					<td><input type="checkbox" name="disable" value="yes"> Yes</td>
				</tr>
				<tr>
					<td><input type="submit" value="Update"></td>
				</tr></form></table>
				<?php

			}
	}
	
	
	
	
	/* ################################################################################### */
	/* Variables to track/manage moderators -- Only supervisors/admins can see this        */
	/* ################################################################################### */
	elseif ($_GET['page'] == "show_systemwide_stats")
	{
		if ($_SESSION['user_role'] == "supervisor" || 
		$_SESSION['user_role'] == "admin" )
		{
			
			
		}
	}
	elseif ($_GET['page'] == "add_moderator")
	{
		if ($_SESSION['user_role'] == "supervisor" || 
		$_SESSION['user_role'] == "admin" )
		{
			?>
			<form method="POST" action="add_moderator.php">
			<table align="center" border="0">
				<tr>
					<td><h1><strong>ADD MODERATOR</strong></h1></td>
				</tr>
				<tr>
					<td>Username:</td>
					<td><input type="text" name="uname2"></td>
				</tr>
				<tr>
					<td>password:</td>
					<td><input type="password" name="password"></td>
				</tr>
				<tr>
					<td>Role:</td>
					<td><select name="level">
						<option value="1">Moderator</option>
						<option value="2">Supervisor</option>
						</select>
					</td>
				</tr>
				<tr>
					<td><input type="submit" value="submit"></td>
				</tr>
			</table>
			</form>
			<?php
			
		}
	}
	elseif ($_GET['page'] == "disable_moderator")
	{
		if ($_SESSION['user_role'] == "supervisor" || 
		$_SESSION['user_role'] == "admin" )
		{
			?>
			<form method="POST" action="disable_moderator.php">
			<table align="center" border="0">
				<tr>
					<td><h1><strong>DISABLE MODERATOR</strong></h1></td>
				</tr>
				<tr>
					<td>Username:</td>
					<td><input type="text" name="username"></td>
				</tr>
				<tr>
					<td>Are You Sure?</td>
					<td><input type="checkbox" name="disable" value="yes">Yes</td>
				</tr>
				<tr>
					<td><input type="submit" value="submit"></td>
				</tr>
			</table>
			</form>
			<?php
			
		}
	}
	elseif ($_GET['page'] == "show_moderator_history")
	{
		if ($_SESSION['user_role'] == "supervisor" || 
		$_SESSION['user_role'] == "admin" )
		{
			$sql22 = "SELECT * FROM `moderator_{$list_name}` where `level`=1 ORDER BY `uname`;";
			$result22 = mysql_query($sql22);
			print "<table align='center' border='0'>
				<tr>
					<td><h1><strong>SHOWING ALL ENABLED Moderators</strong></h1></td>
				</tr>";
			while ($row22 = mysql_fetch_assoc($result22)){
				
				?>
					<tr>
						<td><a href="index.php?page=view_moderator&uid=<?php print $row22['id']; ?>"><?php print $row22['uname']; ?></a></td>
					</tr>
				<?php
			}
			print "</table><br />";
			$sql22 = "SELECT * FROM `moderator_{$list_name}` where `level`=0 ORDER BY `uname`;";
			$result22 = mysql_query($sql22);
			print "<table align='center' border='0'>
				<tr>
					<td><h1><strong>SHOWING ALL DISABLED Moderators</strong></h1></td>
				</tr>";
			while ($row22 = mysql_fetch_assoc($result22)){
				?>
					<tr>
						<td><a href="index.php?page=view_moderator&uid=<?php print $row22['id']; ?>"><?php print $row22['uname']; ?></a></td>
					</tr>
				<?php
				
			}
			print "</table>";
			
		}
	}
	elseif($_GET['page'] == "view_moderator")
	{
		if ($_SESSION['user_role'] == "supervisor" ||
			$_SESSION['user_role'] == "admin" )
		{
			$uid = addslashes($_GET['uid']);
			$sql22 = "SELECT * FROM `moderator_{$list_name}` where`id`= $uid LIMIT 1;";
			$result22 = mysql_query($sql22);
			$row22 = mysql_fetch_assoc($result22);
			$mod_status = $row22['level'];
			print "<table align='center' border='0'>
				<tr>
					<td><h1><strong>Viewing Moderator: ".$row22['uname']."</strong></h1></td>
				</tr>";
				?>
				<tr>
					<td><h2>History</h2></td>
					<td><textarea name="history" cols="60" rows="15"><?php print $row22['history']; ?></textarea></td>
				</tr>
				<?php 
				if ($mod_status == 0){
					?><tr><td><form method="POST" action="enable_moderator.php">
					<input type="hidden" name="action"value="enable">
					<input type="hidden" name="id" value="<?php print $row22['id']; ?>">
					<input type="submit" value="Re-Enable" name="submit"></td></tr>
					<?php
				}
				?>
			</table>
			<?php
		}
	}
		
	/* ################################################################################### */
	/* Variable to Modify the Client Terms of Service                                      */
	/* ################################################################################### */
	elseif ($_GET['page'] =="mod_tos")
	{
		if ($_SESSION['user_role'] == "admin")
		{
			if ($system_status != "down"){
			?>
				<center><form method="POST" action="mod_tos.php">
				<table align="center" border="0">
				<tr>
					<td><h1><strong>MODIFY CLIENT TOS</strong></h1></td>
				</tr>
				<?php
				if ($_GET['tos'] == "updated"){
					?>
					<tr><td><h2>Client TOS Updated Successfully</h2></td></tr>
					<?php
				}
				?>
				<tr>
				<td><textarea name="tos" rows="20" cols="60"><?php print $tos;?></textarea></td>
				</tr>
				<tr>
					<td><input type="submit" name="submit" value="Submit"></td>
				</tr>
				</table></form></center>
			<?php
			}
		}

	}
	
	/* ################################################################################### */
	/* Variable to shut down system. Used for Maintenance mode -- Admin only               */
	/* ################################################################################### */
	elseif ($_GET['page'] == "halt_system")
	{
		if ($_SESSION['user_role'] == "admin")
		{
			if ($system_status != "down"){
			?>
			<form method="POST" action="shutdown_system.php">
			<table align="center" border="0">
				<tr>
					<td><h1><strong>LOCK SYSTEM (status: <?php print $system_status; ?>)</strong></h1></td>
				</tr>
				<tr>
					<td><font color="Red"><p>*This will Complete lock down</p><p> the system -- Are you CERTIAN?*</p></font></td>
				</tr>
				<tr>
					<td>To halt system, enter halt password:</td>
					<td><input type="text" name="halt_password"></td>
				</tr>
				<tr>
					<td>Are You Sure?</td>
					<td><input type="checkbox" name="disable" value="yes">Yes</td>
				</tr>
				<tr>
					<td><input type="submit" value="submit"></td>
				</tr>
			</table>
			</form>
			<?php
			}
			else{
				?>
			<form method="POST" action="shutdown_system.php">
			<table align="center" border="0">
				<tr>
					<td><h1><strong>UNLOCK SYSTEM (status: <?php print $system_status; ?>)</strong></h1></td>
				</tr>
				<tr>
					<td><font color="Red"><p>System is Currently Locked.</p></font></td>
				</tr>
				<tr>
					<td>To unlock system, enter halt password:</td>
					<td><input type="text" name="halt_password"></td>
				</tr>
				<tr>
					<td>Are You Sure?</td>
					<td><input type="checkbox" name="disable" value="yes">Yes</td>
				</tr>
				<tr>
					<td><input type="submit" value="submit"></td>
				</tr>
			</table>
			</form>
			<?php
			}
			
		}
	}
include("footer.php");
}

?>
