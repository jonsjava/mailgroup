<?php
session_start();
include("../config.inc.php");
if ($_SESSION['user_role'] == "moderator" || 
		$_SESSION['user_role'] == "supervisor" || 
		$_SESSION['user_role'] == "admin")
		{
			if ($_POST['disable'] == "yes"){
				$is_valid = 0;
			}
			else{
				$is_valid = 1;
			}
			$sql = "update users_{$list_name} SET `group_name`='{$_POST['group_name']}',
				`email_address`='{$_POST['email']}',
				`first_name`='{$_POST['first_name']}',
				`last_name`='{$_POST['last_name']}',
				`password`='{$_POST['password']}',
				`valid_user`='{$is_valid}'
				WHERE `uname`='{$_POST['uname']}' LIMIT 1;";
			mysql_query($sql);
			header("location:index.php?page=show_all_users");
			exit();
		}
		