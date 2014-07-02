<?php
session_start();
include("config.inc.php");
$count = 0;
$input = $_POST['contacts'];
$current_date = date("M-d-Y");
$contact_sql = "";
$array = explode("\n", $input);

foreach ($array as $value){
	if ($value != null){
		if ($value != ""){
			if ($value != " "){
				if ($value != "\n"){
					if ($value != "\t"){
						if ($value != "\r"){
							$user_table = $_SESSION['username']."_table_".$list_name;
							/* Check to see if they are already registered */
							$array2 = explode(",", $value);
							$name5 = $array2[0];
							$email5 = $array2[1];
							$sql = "SELECT * from `{$user_table}` WHERE `email_address = '{$email5}';";
							$results = @mysql_query($sql);
							$has_email_addresses = @mysql_num_rows($results);
							if ($has_email_addresses == 0){
								/* Add them to the database */
								$contact_sql = "INSERT INTO `".$_SESSION['username']."_table_{$list_name}`(`id`, `date_joined`, `email_address`, `name`, `verified`) VALUES('', '".$current_date."', '".$email5."', '".$name5."', '0');";
								mysql_query($contact_sql);
								$contact_sql2 = "SELECT * FROM ".$_SESSION['username']."_table_{$list_name} WHERE email_address ='".$email5."' and verified =0;";
								$result23 = mysql_query($contact_sql2);
								$row23 = mysql_fetch_assoc($result23);
								$id = $row23['id'];
								++$count;
 								$email = $value;
 								$to = $name5."<".$email5.">";
								$subject = "Please confirm your e-mail address";
								$body = "Hello, $name5, \nWe recently received a request from your e-mail address to join our mailing list. To be added, please go to {$site_address}confirm_email.php?id=".$row23['id']."&gid={$_SESSION['group_id']} \n Once you have visited that site, you will begin to receive periodic messages from our staff.  If you receive this message in error, please disregard, and you will not receive any further messages from us.";
								$header="From:{$_SESSION['fullname']}<{$_SESSION['email_address']}>\n";
  								$header .= "Reply-To: {$_SESSION['email_address']}\n"; 
  								$headers .= "MIME-Version: 1.0\n";
								$headers .= "Content-Type: text/html; charset=iso-8859-1\n";
								$headers .= "Content-Transfer-Encoding: quoted-printable\n";
								mail($to, $subject, $body, $header);
							}
						}
					}
				}
			}
		}
	}
}


header("location:index.php?page=show_all_contacts");
	exit();
?>