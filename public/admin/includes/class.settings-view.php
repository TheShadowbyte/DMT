<?php

	require_once("/../../includes/database.php");
	require_once("/../../includes/format.php");

	// This class generates the view for the admin general settings.
	class AdminSettingsView {

		private $database;

		public function __construct() {
			$this->database = new Database();
			$this->settingsView();
		}

		private function getSettings() {
			$sql = "SELECT * FROM settings";
			$this->database->query($sql);
			$settingsFetch = mysqli_fetch_all($this->database->query($sql), MYSQLI_ASSOC);
			$settingsArray = array();
			foreach ($settingsFetch as $key => $record) {
				$settingsArray = $this->array_push_assoc($settingsArray, $record["setting"], $record["value"]);
			}
			return $settingsArray;
		}

		// Note to self: move into a general functions file
		public function array_push_assoc($array, $key, $value) {
			$array[$key] = $value;
			return $array;
		}

		private function settingsView() {
			$settings = $this->getSettings();
			require_once("layout/admin-header.php");
			?>
			<h1>General Settings</h1>
			Site Name:
			<input id="site-name" type="text" name="site-name" value="<?php echo $settings["site_name"]; ?>" /><br /><br />
			Admin Email:
			<input id="admin-email" type="text" name="admin-email" value="<?php echo $settings["admin_email"]; ?>" /><br /><br />
			<input id="update-settings" type="submit" value="Update Settings">
			<?php
			require_once("layout/admin-footer.php");
		}

	}

?>