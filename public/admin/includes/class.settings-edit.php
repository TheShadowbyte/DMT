<?php

	require_once("/../../includes/database.php");
	require_once("/../../includes/format.php");
	require_once("class.settings-view.php");

	// This class is the model to allow admins to condone CRUD on news posts.
	class AdminSettingsEdit {

		private $database;
		private $siteName;

		// Note to self: create a method to check whether some fields remain unchanged.

		public function __construct() {
			$this->database = new Database();
			$this->siteName = Format::cleanStrings($this->database->openConnection(), $_POST['site-name']);
			$this->adminEmail = Format::cleanStrings($this->database->openConnection(), $_POST['admin-email']);
			$this->settingsData = array(
										"site_name" => $this->siteName,
										"admin_email" => $this->adminEmail
									);
			$this->updateSettings($this->settingsData);
			$this->database->closeConnection();
		}

		private function updateSettings($settingsData) {
			foreach ($settingsData as $setting => $value) {
				$sql = "UPDATE settings SET value='$value' WHERE setting='$setting'";
				$this->database->query($sql);
			}
		}

	}

?>