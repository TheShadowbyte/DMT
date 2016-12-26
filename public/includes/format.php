<?php

	// The methods in this class are used to either check or clean submission formatting.
	class Format {

		// Cleans input POST data.
		public static function cleanStrings($con, $rawInput) {
			return mysqli_real_escape_string($con, $rawInput);
		}

		// Checks to see if the correct POST type has been submitted.
		public static function checkPostType($type) {
			if (isset($_POST['post-type']) && $_POST['post-type'] == $type) {
				return true;
			}
		}

	}

?>