<?php

	require_once("/../includes/database.php");
	require_once("/../includes/session.php");
	require_once("includes/class.settings-edit.php");
	require_once("includes/class.settings-view.php");

	// A controller class for the general settings page.
	class AdminSettingsController {

		private $database;

		public function __construct() {
			$this->session = $_SESSION['session_data'];
			if (isset($this->session->username)) {
				if (Format::checkPostType("update-settings")) {
					new AdminSettingsEdit();
				}
				else {
					new AdminSettingsView();
				}
			}
			else {
				$this->session->redirect("/");
			}
		}

	}

	$settings = new AdminSettingsController();

?>