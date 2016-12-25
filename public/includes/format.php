<?php

	// The methods in this class are used to either check or clean input formatting.
	class Format {

		// Cleans input POST data
		public static function cleanStrings($con, $rawInput) {
			return mysqli_real_escape_string($con, $rawInput);
		}

	}

?>