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
if ($_GET['page'] == "thankyou"){
	include("templates/blue/header.php");
	print "<h1><strong>Thank you for Confirming your e-mail address</strong></h1>";
	include("templates/blue/footer.php");
}
else{
include("config.inc.php");

$gid = mysql_query("SELECT uname FROM users_{$list_name} WHERE id={$_GET['gid']}");
$row43 = mysql_fetch_assoc($gid);
$username = $row43['uname'];
mysql_query("UPDATE {$username}_table_{$list_name} SET verified=1 WHERE id={$_GET['id']};");
header("location:confirm_email.php?page=thankyou");
exit();
}
?>