<?php

	require_once("/../../includes/database.php");
	require_once("/../../includes/format.php");

	// This class generates the views for both creating and updating posts.
	class AdminNewsEditView {

		private $database;

		public function __construct() {
			$this->database = new Database();
			$this->newsEditView();
		}

		private function newsEditView() {
			require_once("layout/admin-header.php");
			?><a href="news.php">Back to Posts</a><?php
			if (empty($_GET['post'])) { $this->createPostView(); }
			else {
				$this->editPostView(Format::cleanStrings($this->database->openConnection(), $_GET['post']));
			}
			require_once("layout/admin-footer.php");
		}

		private function getPost($postID) {
			$sql = "SELECT * FROM news WHERE id='$postID' LIMIT 1";
			$newsArray = mysqli_fetch_assoc($this->database->query($sql));
			return $newsArray;
		}

		private function createPostView() {
			?>
			<h1>Create New Post</h1>
			<input id="post-title" type="text" name="post-title" /><br /><br />
			<textarea id="post-content" name="post-content" rows="4" cols="40"></textarea><br /><br />
			<input id="create-post" type="submit" value="Create Post">
			<?php
		}

		private function editPostView($postID) {
			$newsRecord = $this->getPost($postID);
			?>
			<h1>Edit Post</h1>
			<input id="post-id" type="hidden" name="post-id" value="<?php echo $postID; ?>">
			<input id="post-title" type="text" name="post-title" value="<?php echo $newsRecord["title"]; ?>" /><br /><br />
			<textarea id="post-content" name="post-content" rows="4" cols="40"><?php echo $newsRecord["content"]; ?></textarea><br /><br />
			<input id="update-post" type="submit" value="Update Post"><br /><br />
			<a id="delete-post" href="">Delete Post</a>
			<?php
		}

	}

?>