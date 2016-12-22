<?php

	require_once("config.php");

	class Database {

		private $connection;

		function __construct() {
			$this->openConnection();
		}

		// Connect to the database
		public function openConnection() {
			$this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
			if (mysqli_connect_errno()) {
			  die("Database connection failed: " . 
			       mysqli_connect_error() . 
			       " (" . mysqli_connect_errno() . ")"
			  );
			}
		}

		// Close connection to the database
		public function closeConnection() {
			if (isset($this->connection)) {
		 		mysqli_close($this->connection);
		  		unset($this->connection);
			}
		}

		// Ensure query is valid
		private function confirmQuery($result) {
			if (!$result) {
				die("Database query failed.");
			}
		}

		// Perform SQL queries
		public function query($sql) {
			$result = mysqli_query($this->connection, $sql);
			$this->confirmQuery($result);
			return $result;
		}

	}

?>