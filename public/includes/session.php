<?php

	class Session {

		private $loggedIn = false;
		public $userID;
		public  $postType;

		function __construct() {
			session_start();
			$this->checkLogin();
		}

		// Returns true is user is logged in
		public function isLoggedIn() {
			return $this->loggedIn;
		}

		// Verify whether user is logged in by checking the $_SESSION variable user_id,
		// in which case the user_id value is internalized within the Session class.
		private function checkLogin() {
			if (isset($_SESSION['user_id'])) {
				$this->userID = $_SESSION['user_id'];
				$this->loggedIn = true;
			}
			else {
				unset($this->userID);
				$this->loggedIn = false;
			}
		}

		// Set variables to the passed user ID 
		public function login($user) {
			if ($user) {
				$this->userID = $_SESSION['user_id'] = $user->id;
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

		// Unset the session user ID
		public function logout() {
			unset($_SESSION['user_id']);
			unset($this->userID);
			$this->loggedIn = false;
		}

	}

	$session = new Session();

?>