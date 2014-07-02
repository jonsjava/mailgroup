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
include("config.inc.php");
$gid = $_GET["gid"];
$id = $_GET['id'];
$gid = addslashes($gid);
$id = addslashes($id);
$sql = "SELECT * from users_{$list_name} where id ='{$gid}' limit 1";
$result = mysql_query($sql);
$group = mysql_fetch_assoc($result);
$group_table = $group['uname'];




$sql3 = "SELECT * FROM {$group_table}_table_{$list_name} WHERE id='".$id."' LIMIT 1;";
$result3 = mysql_query($sql3);
$row3 = mysql_fetch_assoc($result3);
$email = $row3['email_address'];


$sql2 = "DELETE FROM {$group['uname']}_table_{$list_name} WHERE id=".$id.";";
@mysql_query($sql2);
include($template_inc."header.php");
if ($email != null){
print "<center><h1><stron> Your E-Mail Address: ".$email." has been successfully removed.";
}
else{
	
}
include($template_inc."footer.php");
exit();
?>