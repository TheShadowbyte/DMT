<?php

	require_once("/../../includes/database.php");
	require_once("/../../includes/format.php");
	require_once("class.news-edit-view.php");

	// This class is the model to allow admins to condone CRUD on news posts.
	class AdminNewsEdit {

		private $database;
		private $postID;
		private $postTitle;
		private $postContent;

		public function __construct() {
			$this->database = new Database();
			$this->determinePostType($_POST['post-type']);
			$this->database->closeConnection();
		}

		private function determinePostType($postType) {
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
		}

		private function createPost($postTitle, $postContent) {
			$sql = "INSERT INTO news (title, content) VALUES ('$postTitle', '$postContent')";
			$this->database->query($sql);
			// Get the ID of this newly-created post
			$sqlNewID = "SELECT id FROM news ORDER BY id DESC LIMIT 1";
			$newPostID = mysqli_fetch_assoc($this->database->query($sqlNewID))['id'];
			echo $newPostID;
		}

		private function updatePost($postID, $postTitle, $postContent) {
			$sql = "UPDATE news SET title='$postTitle', content='$postContent' WHERE id='$postID'";
			$this->database->query($sql);
		}

		private function deletePost($postID) {
			$sql = "DELETE FROM news WHERE id='$postID'";
			$this->database->query($sql);
		}

	}

?>