<?php

	require_once("/../../includes/database.php");
	require_once("/../../includes/format.php");
	require_once("/../../includes/user.php");
	require_once("class.user-edit-view.php");

	// This class is the model to allow admins to condone CRUD on users.
	class AdminUserEdit {

		private $database;
		private $userID;
		private $username;
		private $email;
		private $userType;

		public function __construct() {
			$this->database = new Database();
			$this->determinePostType($_POST['post-type']);
			$this->database->closeConnection();
		}

		private function determinePostType($postType) {
			if (Format::checkPostType("create-user")) {
				$this->username = Format::cleanStrings($this->database->openConnection(), $_POST['username']);
				$this->password = Format::cleanStrings($this->database->openConnection(), $_POST['password']);
				$this->email = Format::cleanStrings($this->database->openConnection(), $_POST['email']);
				$this->userType = Format::cleanStrings($this->database->openConnection(), $_POST['user-type']);
				$this->createUser($this->username, $this->password, $this->email, $this->userType);
			}
			elseif (Format::checkPostType("update-user")) {
				$this->userID = Format::cleanStrings($this->database->openConnection(), $_POST['user-id']);
				$this->username = Format::cleanStrings($this->database->openConnection(), $_POST['username']);
				$this->email = Format::cleanStrings($this->database->openConnection(), $_POST['email']);
				$this->userType = Format::cleanStrings($this->database->openConnection(), $_POST['user-type']);
				$this->updateUser($this->userID, $this->username, $this->email, $this->userType);
			}
			elseif (Format::checkPostType("delete-user")) {
				$this->userID = Format::cleanStrings($this->database->openConnection(), $_POST['user-id']);
				$this->deleteUser($this->userID);
			}
		}

		private function createUser($username, $password, $email, $userType) {
			$this->password = User::passwordEncrypt($password);
			$sql = "INSERT INTO users (username, password, email, user_type) VALUES ('$username', '$this->password', '$email', '$userType')";
			$this->database->query($sql);
			// Get the ID of this newly-created user
			$sqlNewID = "SELECT id FROM users ORDER BY id DESC LIMIT 1";
			$newUserID = mysqli_fetch_assoc($this->database->query($sqlNewID))['id'];
			echo $newUserID;
		}

		private function updateUser($userID, $username, $email, $userType) {
			$sql = "UPDATE users SET username='$username', email='$email', user_type='$userType' WHERE id='$userID'";
			$this->database->query($sql);
		}

		private function deleteUser($userID) {
			$sql = "DELETE FROM users WHERE id='$userID'";
			$this->database->query($sql);
		}

	}

?>