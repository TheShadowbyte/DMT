<?php

	require_once("includes/user.php");
	require_once("includes/session.php");
	require_once("layout/header.php");

	class Profile {

		public function __construct() {

			$this->session = $_SESSION['session_data'];
			$this->user = $_SESSION['user_data'];
			
			if ($this->session->isLoggedIn()) {
				$this->username = $this->user->getUsername();
				$this->userProfile();
			}
			else {
				$this->session->redirect("/");
			}
			
		}

		private function userProfile() {
			?>
			<p>Welcome, <?php echo $this->username; ?></p>
			<?php
			$this->changeEmailForm();
		}

		private function changeEmailForm() {
			?>
			<form id="change-email">
			  Email:
			  <input id="email" type="text" name="email" value="<?php echo $this->user->getEmail(); ?>"><br>
			  <br>
			  <input id="change-email-submit" type="submit" value="Update">
			</form>
			<?php
		}

	}

	$profile = new Profile();

	require_once("layout/footer.php");

?>