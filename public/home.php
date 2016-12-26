<?php
	
	require_once("includes/database.php");
	
	class Home { 

		public function __construct() {
			$this->database = new Database();
			require_once("layout/header.php");
			echo "<h1>Latest News</h1>";
			$this->latestNews();
			require_once("layout/footer.php");
		}

		// This displays the site's latest news.
		public function latestNews() {
			$sql = "SELECT * FROM news";
			$query = $this->database->query($sql);
			while ($newsArray = mysqli_fetch_assoc($query)) {
				echo "<h2>" . $newsArray["title"] . "</h2>";
				echo "<p>" . $newsArray["content"] . "</p>";
			}
		}

	}

	$home = new Home();

?>