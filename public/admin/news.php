<?php

	require_once("/../includes/user.php");

	class AdminNews {

		public function __construct() {
			$this->user = $_SESSION['user_data'];
			require_once("layout/admin-header.php");
			echo "<h1>News</h1>";
			?>
			<a href="news-edit.php">Create New Post</a>
			<?php
			$this->newsList();
			require_once("layout/admin-footer.php");
		}

		// This loops through all the news in order to edit them.
		private function newsList() {
			$sql = "SELECT * FROM news";
			$query = $this->user->database->query($sql);
			?>
			<table>
				<tr>
					<td></td>
					<td>Title</td>
				</tr>
			<?php
			while ($newsArray = mysqli_fetch_assoc($query)) {
				?>
				<tr>
					<td><a href="news-edit.php?post=<?php echo $newsArray['id']; ?>">Edit</a></td>
					<td><?php echo $newsArray["title"]; ?></td>
				</tr>
				<?php
			}
			?>
			</table>
			<?php
		}

	}

	$news = new AdminNews();

?>