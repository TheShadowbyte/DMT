<?php

	require_once("/../includes/database.php");
	
	
	require_once("layout/admin-header.php");
	echo "<h1>Users</h1>";
	?><a href="user-edit.php">Create New User</a><?php
	usersList();
	require_once("layout/admin-footer.php");

	function usersList() {
		$database = new Database();
		$sql = "SELECT * FROM users";
		$query = $database->query($sql);
		?>
		<table>
			<tr>
				<td></td>
				<td>Username</td>
				<td>Email</td>
				<td>User Type</td>
			</tr>
		<?php
		while ($userArray = mysqli_fetch_assoc($query)) {
			?>
			<tr>
				<td><a href="user-edit.php?user=<?php echo $userArray['id']; ?>">Edit</a></td>
				<td><?php echo $userArray["username"]; ?></td>
				<td><?php echo $userArray["email"]; ?></td>
				<td><?php echo $userArray["user_type"]; ?></td>
			</tr>
			<?php
		}
		?>
		</table>
		<?php
	}

?>