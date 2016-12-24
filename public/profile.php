<?php

	require_once("includes/user.php");


	
	class Profile {

		// public $user;

		public function __construct() {
			require_once("layout/header.php");
			if ($session->isLoggedIn()) {
				$this->userProfile();
			}
			else {
				$session->redirect("/");
			}
			require_once("layout/footer.php");
			$this->session = $session;
			$this->user = $user;
		}

		public function userProfile() {
			$test = new User($session);
			return $test->getUsername();
		}

	}

?>