<?php

	require_once("/../includes/database.php");
	require_once("/../includes/format.php");

	// This class allows admins to condone CRUD on news posts.
	// Next revision: divide model and view.

	class AdminNewsEdit {

		public function __construct() {
			$this->database = new Database();
			if (Format::checkPostType("create-post")) {
				$this->postTitle = Format::cleanStrings($this->database->openConnection(), $_POST['post-title']);
				$this->postContent = Format::cleanStrings($this->database->openConnection(), $_POST['post-content']);
				$this->createPost($this->postTitle, $this->postContent);
			}
			elseif (Format::checkPostType("update-post")) {
				$this->postID = Format::cleanStrings($this->database->openConnection(), $_POST['post-id']);
				$this->postTitle = Format::cleanStrings($this->database->openConnection(), $_POST['post-title']);
				$this->postContent = Format::cleanStrings($this->database->openConnection(), $_POST['post-content']);
				$this->updatePost($this->postID, $this->postTitle, $this->postContent);
			}
			elseif (Format::checkPostType("delete-post")) {
				$this->postID = Format::cleanStrings($this->database->openConnection(), $_POST['post-id']);
				$this->deletePost($this->postID);
			}
			else {
				require_once("layout/admin-header.php");
				if (empty($_GET['post'])) {
					$this->createPostView();
				}
				else {
					$this->editPostView(Format::cleanStrings($this->database->openConnection(), $_GET['post']));
				}
				require_once("layout/admin-footer.php");
			}
		}

		private function createPost($postTitle, $postContent) {
			$sql = "INSERT INTO news (title, content) VALUES ('$postTitle', '$postContent')";
			$this->database->query($sql);
			// Get the post ID of this newly-created post
			$sqlNewID = "SELECT id FROM news ORDER BY id DESC LIMIT 1";
			$newPostID = mysqli_fetch_assoc($this->database->query($sqlNewID))['id'];
			echo $newPostID;
		}

		private function getPost($postID) {
			$sql = "SELECT * FROM news WHERE id='$postID' LIMIT 1";
			$newsArray = mysqli_fetch_assoc($this->database->query($sql));
			return $newsArray;
		}

		private function updatePost($postID, $postTitle, $postContent) {
			$sql = "UPDATE news SET title='$postTitle', content='$postContent' WHERE id='$postID'";
			$this->database->query($sql);
		}

		private function deletePost($postID) {
			$sql = "DELETE FROM news WHERE id='$postID'";
			$this->database->query($sql);
		}

		private function createPostView() {
			?>
			<a href="news.php">Back to Posts</a>
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
			<a class="delete-post" href="">Delete Post</a>
			<?php
		}

	}

	$adminNewsEdit = new AdminNewsEdit();

?>