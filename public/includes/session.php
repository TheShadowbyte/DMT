<?php

	class Session {

		private $loggedIn = false;
		public  $username;
		public  $postType;

		function __construct() {
			session_start();
			$this->checkLogin();
			// What to do when AJAX requests logout
			if (isset($_POST['post-type']) == "logout") {
				$this->logout();
			}
		}

		// Returns true is user is logged in.
		public function isLoggedIn() {
			return $this->loggedIn;
		}

		// Check whether user is logged in.
		private function checkLogin() {
			if (isset($_SESSION['username'])) {
				$this->username = $_SESSION['username'];
				$this->loggedIn = true;
			}
			else {
				unset($this->username);
				$this->loggedIn = false;
			}
		}

		// Set variables for the passed user.
		public function login($user) {
			if ($user) {
				$this->username = $_SESSION['username'] = $user;
				$this->loggedIn = true;
			}
		}

		// Redirects user to a specified location based on their page access status.
		public function redirect($location=NULL) {
			if ($location != NULL) {
				header("Location: {$location}");
				exit;
			}
		}

		// Unset the user session
		private function logout() {
			unset($_SESSION['username']);
			unset($this->username);
			$this->loggedIn = false;
			echo "success";
		}

	}

	$session = new Session();
	$_SESSION['session_data'] = $session;

?>