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
if ($_POST['security_code'] == $_SESSION['code']){
	$_SESSION['data'] = null;
if (isset($_SESSION['username'])){
	if ($_SESSION['is_valid']  == true){
include("config.inc.php");
include("MIME.class.php");
$search_sql = @mysql_query("SELECT * FROM {$_SESSION['username']}_table_{$list_name} WHERE verified =1;");
$sent_mail_count = 0;
$current_month = date("n");
$current_year = date("Y");
while($row = @mysql_fetch_assoc($search_sql)) {
	$admin = $SESSION_['group_name']."<".$_SESSION['email_address'].">";
	$to  = $row['name']."<".$row['email_address'].">";
	$subject = $_POST['subject'];
	$message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN'
	'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
	<html>
	<head>
	<title>".$subject."</title>
	</head>";
	$message_clean1 = str_replace("\'", "'", $_POST['message']);
        $message_clean2 = str_replace('"', "'", $message_clean1);
        $message_clean3 = str_replace("\v", "", $message_clean2);
        $message_clean4 = str_replace("\'", "'", $message_clean3);
	$message .= $message_clean4;
	$message .= "<br /><br /><br />If you wish to be removed from our mailing list, please go to: \n<a href='".$site_address."remove.php?id=".$row['id']."&gid=".$_SESSION['group_id']."'> ".$web_addr.$server_root."remove.php?id=".$row['id']."&gid=".$_SESSION['group_id']."</a> \n and you will be removed immediately.";
	$message .= "\n</body></html>";
	$mime = new MIME_mail($_SESSION['email_address'], $to, $subject);
	$mime->attach($message, "", HTML, BASE64);
	$mime->send_mail();
	++$sent_mail_count;
}
$sql = "UPDATE `system_stats_{$list_name}` SET `total_sent` = `total_sent` + {$sent_mail_count}; UPDATE `users_{$list_name}` SET `pieces_sent` = `pieces_sent` + 1 WHERE uname = '{$_SESSION['username']}'; UPDATE `users_{$list_name}` SET `total_sent` = `total_sent` + {$sent_mail_count} WHERE `uname` = '{$_SESSION['username']}';";
mysql_query($sql);
$sql = "SELECT * from `system_stats_{$list_name}`;";
$results = mysql_query($sql);
$row = mysql_fetch_assoc($results);
$system_total_sent = $row['total_sent'];
$sql = "UPDATE system SET `total_sent`= `total_sent` + {$sent_mail_count} WHERE `name`='{$list_name}';";
$sql = "SELECT * FROM users_{$list_name} WHERE uname='".$_SESSION['username']."';";
$result = mysql_query($sql);
$user_row = mysql_fetch_assoc($result);
$user_history = $user_row['logs'];
$new_logs = $user_history;
$new_logs .= "DATE: ".$ccdate."\n";
$new_logs .= "Time: ".date("H:i.s")."\n";
$new_logs .= "Sent E-Mail \n";
$new_logs .= "Subject: ".$subject."\n";
$new_logs .= "Sent to ".$sent_mail_count." Email Addresses\n";
$new_logs .= "--------------------------------------------------------\n\n\n";
$sql = "UPDATE users_{$list_name} SET logs='{$new_logs}', `total_sent` = `total_sent` + 1 WHERE uname='{$_SESSION['username']}';";
mysql_query($sql);
$sql = "SELECT * from users_{$list_name} WHERE `uname` = '{$_SESSION['username']}';";
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
$user_total_sent = $row['total_sent'];
if ($system_total_sent < $user_total_sent){
	$sql = "UPDATE `system_stats_{$list_name}` SET `top_sender`='{$_SESSION['username']}', `top_sender_total` = '{$user_total_sent}';";
	mysql_query($sql);
}
header("location:index.php?message=sent");
exit();
}

else{
	header("location:index.php");
	exit();
}
	}
}

else{
	$message_clean1 = str_replace("\'", "'", $_POST['message']);
	$message_clean2 = str_replace('"', "'", $message_clean1);
	$message_clean3 = str_replace("\v", "", $message_clean2);
	$message_clean4 = str_replace("\'", "'", $message_clean3);
	$message .= $message_clean4;
	$_SESSION['data'] = $message;
	header("location:index.php?error=captcha");
}

?>
