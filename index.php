<?php
session_start();
include("config.inc.php");
include($template_inc."header.php");
if ($_SESSION['is_valid'] != true){
	include("login.php");
}
else{
	
	
if ($system_status == "down"){
	print "<center><h1><strong>SYSTEM DOWN</strong></h1><p>They mailer system is currently down for maintenance</p><p>Please check back later</p>";
	include($template_inc."footer.php");
	exit();
}
if ($_GET['page'] == "addcontacts"){
	?>
	<table align="center" border="0">
		<tr>
			<td>
			<h1><strong>ADD CONTACTS</h1></strong><p>Separate each email address by a carrier return (press "enter")</p>
			<p>USAGE: FIRSTNAME LASTNAME, EMAIL</p>
			<p>EXAMPLE: John Doe, jondoe@example.com (NOTE: COMMA MUST BE PRESENT)</p>
			<p>If you do not have a name, use this format: " , EMAIL"</p>
			</td>
		</tr>
		<tr>
			<td><textarea name="contacts" rows="30" cols="75"></textarea></td>
		</tr>
		<tr>
			<td><input type="submit" name="submit" value="Submit"></td>
		</tr>
		</table>
	</form></center>
	<?php
}
elseif($_GET['page'] == "show_all_contacts"){
	?><form action="remove_contacts.php" method="POST" name="removeContacts">
	<?php
	$contact_count = 1;
	$checkbox_count = 0;
	$sql = "SELECT email_address, id, name from {$_SESSION['username']}_table_{$list_name} WHERE verified =1 ORDER BY email_address";
	$result = mysql_query($sql);
	print "<h1><strong>VIEW/REMOVE CONTACTS</strong></h1><br /><table align='center'>\n<tr>\n";
	while ($row = mysql_fetch_assoc($result)){
		if ($contact_count == 3){
			print "<td align='left'><input type='checkbox' name='{$row['id']}' value='".$row['id']."'><a href='remove_contacts.php?id={$row['id']}'><img src='templates/blue/recycler.gif' alt='Remove' title='Remove' border='0'></a>".$row['name']."(".$row['email_address'].")</td>\n</tr>\n";
			$contact_count = 1;
		}
		else{
			print "<td align='left'><input type='checkbox' name='{$row['id']}' value='".$row['id']."'><a href='remove_contacts.php?id={$row['id']}'><img src='templates/blue/recycler.gif' alt='Remove' title='Remove' border='0'></a>".$row['name']."(".$row['email_address'].")</td>\n";
			++$contact_count;
		}
	}
	if ($contact_count == 1){ print "</tr>\n";}
	print "</table>\n";
	$contact_count = 1;
	$sql = "SELECT email_address, id, name from {$_SESSION['username']}_table_{$list_name} WHERE verified =0 ORDER BY email_address";
	$result = mysql_query($sql);
	print "<h1><strong>VIEW/REMOVE UNVERIFIED CONTACTS</strong></h1><br /><table align='center'>\n<tr>\n";
	while ($row = mysql_fetch_assoc($result)){
		if ($contact_count == 3){
			print "<td align='left'><input type='checkbox' name='{$row['id']}' value='".$row['id']."'><a href='remove_contacts.php?id={$row['id']}'><img src='templates/blue/recycler.gif' alt='Remove' title='Remove' border='0'></a>".$row['name']."(".$row['email_address'].")</td>\n</tr>\n";
			$contact_count = 1;
		}
		else{
			print "<td align='left'><input type='checkbox' name='{$row['id']}' value='".$row['id']."'><a href='remove_contacts.php?id={$row['id']}'><img src='templates/blue/recycler.gif' alt='Remove' title='Remove' border='0'></a>".$row['name']."(".$row['email_address'].")</td>\n";
			++$contact_count;
		}
	}
	if ($contact_count == 1){ print "</tr>\n";}
	
	print "<tr>\n<td align='left'><input type=submit value='DELETE'></td>\n</tr>\n</table>\n</form>\n";
}
else{

	print "<center>";
	/* EDIT THE server_root.php file before you're done! */
	/*if(!$_SESSION["user_level"] == "Moderator"){
	if (!$_SESSION["user_level"] == "user")
	{
		header("location:index.php");
		exit();
		}
	}*/

	if ($_SESSION['data'] == null){
		$data = "";
	}
	else{
		$data = $_SESSION['data'];
	}
	if ($_GET['error'] == "captcha"){
		$warning = "Please Re-enter the Security Code from the Image Below";
	}
	if ($_GET['message'] == "sent"){
		$warning = "Your Message was Successfully Sent";
	}
	else{
		$warning = "";
	}
	$user_table = $_SESSION['username']."_table_".$list_name;
	$sql = "SELECT * from `{$user_table}` WHERE `verified` = 1;";
	$results = @mysql_query($sql);
	$email_addresses = @mysql_num_rows($results);
	?>

	<?php
	?>
	      <?php if ($title != null){ print $title; } else { print "";}?>
	      <p><strong><h2><?php print $warning; ?></h2></strong></p>
	<p> Hello, <?php print $_SESSION['full_name']; ?>. You have <?php print $email_addresses; ?> Contact(s)</p>
		<p>Subject: 
	<input type="text" name="subject" size="75"></p>
	<p>Body</p>
	<p>

	<?php include_once "includes/fckeditor/fckeditor.php"; ?><?php
	  // Get data from the database
	  //$query = mysql_query("SELECT data FROM fck_data WHERE id = 1");
 	 //$data = mysql_fetch_array($query);

 	 // Configure and output editor
 	 $oFCKeditor = new FCKeditor('message');
  	$oFCKeditor->BasePath = $site_address."includes/fckeditor/";
  	$oFCKeditor->Value    = $data;
  	$oFCKeditor->Width    = 600;
 	 $oFCKeditor->Height   = 600;
  	echo $oFCKeditor->CreateHtml();
	?>

	</p><p><img src="cimage.php" /></p>
	<p><label for="security_code">Security Code: </label><input id="security_code" name="security_code" type="text" /></p>
	<p><input name="submit" type="submit" value="Send Email"/></p>
	</form>
	</center></td></tr></table>
	</body>
	</html> 
    </p>
	<?php
}
}
include($template_inc."footer.php");
?>