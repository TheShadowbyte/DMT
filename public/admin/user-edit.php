<?php

	require_once("/../includes/database.php");
	require_once("/../includes/format.php");

	$database = new Database();

	if (Format::checkPostType("edit-user")) {
		$userID = $_POST['user-id'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$sqlUpdate = "UPDATE users SET username='$username', email='$email' WHERE id='$userID'";
		$database->query($sqlUpdate);
	}

	require_once("layout/admin-header.php");
	$getUserID = $_GET['user'];
	$sql = "SELECT * FROM users WHERE id='$getUserID' LIMIT 1";
	$user = mysqli_fetch_assoc($database->query($sql));
	?>
	<a href="users.php">Back to Users</a>
	<h1>Edit User</h1>
	<?php
	$getUserID = $_GET['user'];
	?>
	<input id="user-id" type="hidden" name="user-id" value="<?php echo $getUserID; ?>">
	Username:
	<input id="username" type="text" name="username" value="<?php echo $user["username"]; ?>" /><br /><br />
	Email:
	<input id="email" type="text" name="email" value="<?php echo $user["email"]; ?>" /><br /><br />
	User Type:
	<select>
	  <option value="registered">Registered</option>
	  <option value="administrator">Administrator</option>
	</select>
	<br /><br />
	<input id="edit-user" type="submit" value="Edit User"><br /><br />
	<?php
	require_once("layout/admin-footer.php");
?>