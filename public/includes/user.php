<?php

	require_once("database.php");
	require_once("session.php");

	class User {

		private $username;
		private $email;

		function __construct() {
			$this->session = $_SESSION['session_data'];
			$this->username = $this->session->username;
			$this->database = new Database();

		}

		public function getUsername() {
			$sql = "SELECT username FROM users WHERE username='$this->username' LIMIT 1";
			return mysqli_fetch_assoc($this->database->query($sql))['username'];
		}

		public function getEmail() {
			$sql = "SELECT email FROM users WHERE username='$this->username' LIMIT 1";
			return mysqli_fetch_assoc($this->database->query($sql))['email'];
		}

		public function changeEmail() {
			
		}

	}

	$user = new User();
	$_SESSION['user_data'] = $user;

?>