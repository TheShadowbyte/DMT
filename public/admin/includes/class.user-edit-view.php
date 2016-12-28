<?php

	require_once("/../../includes/database.php");
	require_once("/../../includes/format.php");

	// This class generates the views for both creating and updating users.
	class AdminUserEditView {

		private $database;

		public function __construct() {
			$this->database = new Database();
			$this->userEditView();
		}

		private function userEditView() {
			require_once("layout/admin-header.php");
			?><a href="users.php">Back to Users</a><?php
			if (empty($_GET['user'])) { $this->createUserView(); }
			else {
				$this->editUserView(Format::cleanStrings($this->database->openConnection(), $_GET['user']));
			}
			require_once("layout/admin-footer.php");
		}

		private function getUser($userID) {
			$sql = "SELECT * FROM users WHERE id='$userID' LIMIT 1";
			$userArray = mysqli_fetch_assoc($this->database->query($sql));
			return $userArray;
		}

		private function createUserView() {
			?>
			<h1>Create New User</h1>
			Username:
			<input id="username" type="text" name="username" /><br /><br />
			Password:
			<input id="password" type="password" name="password" /><br /><br />
			Email:
			<input id="email" type="text" name="email" /><br /><br />
			User Type:
			<select id="user-type" name="user-type">
			  <option value="registered">Registered</option>
			  <option value="administrator">Administrator</option>
			</select>
			<br /><br />
			<input id="create-user" type="submit" value="Create User">
			<?php
		}

		private function editUserView($userID) {
			$userRecord = $this->getUser($userID);
			?>
			<h1>Edit User</h1>
			<input id="user-id" type="hidden" name="user-id" value="<?php echo $userID; ?>">
			Username:
			<input id="username" type="text" name="username" value="<?php echo $userRecord["username"]; ?>" /><br /><br />
			Password:
			<input id="password" type="password" name="password" /><br /><br />
			Email:
			<input id="email" type="text" name="email" value="<?php echo $userRecord["email"]; ?>" /><br /><br />
			User Type:
			<select id="user-type" name="user-type">
			  <option value="registered">Registered</option>
			  <option value="administrator">Administrator</option>
			</select>
			<br /><br />
			<input id="update-user" type="submit" value="Update User"><br /><br />
			<a id="delete-user" href="">Delete User</a>
			<?php
		}

	}

?>