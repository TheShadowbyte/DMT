<?php

	require_once("config.php");

	class Database {

		private $connection;

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

		// Close connect to the database
		public function closeConnection() {
			if (isset($this->connection)) {
		 		mysqli_close($this->connection);
		  		unset($this->connection);
			}
		}

	}

?>