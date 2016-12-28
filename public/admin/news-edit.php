<?php

	require_once("/../includes/database.php");
	require_once("/../includes/format.php");

	// Next stage for posts is to put this code into a class

	$database = new Database();

	if (Format::checkPostType("update-post")) {
		$postID = $_POST['post-id'];
		$postTitle = $_POST['post-title'];
		$postContent = $_POST['post-content'];
		$sqlUpdate = "UPDATE news SET title='$postTitle', content='$postContent' WHERE id='$postID'";
		$database->query($sqlUpdate);
	}
	elseif (Format::checkPostType("create-post")) {
		$postTitle = $_POST['post-title'];
		$postContent = $_POST['post-content'];
		$sqlCreate = "INSERT INTO news (title, content) VALUES ('$postTitle', '$postContent')";
		$database->query($sqlCreate);
		$sqlNewID = "SELECT id FROM news ORDER BY id DESC LIMIT 1";
		$newPostID = mysqli_fetch_assoc($database->query($sqlNewID))['id'];
		echo $newPostID;
	}
	elseif (Format::checkPostType("delete-post")) {
		$postID = $_POST['post-id'];
		$sqlDelete = "DELETE FROM news WHERE id='$postID'";
		$database->query($sqlDelete);
	}
	else {
		require_once("layout/admin-header.php");
		?>
		<a href="news.php">Back to Posts</a>
		<?php
		if (empty($_GET['post'])) {
		?>
			
			
			<h1>Create New Post</h1>
			<input id="post-title" type="text" name="post-title" /><br /><br />
			<textarea id="post-content" name="post-content" rows="4" cols="40"></textarea><br /><br />
			<input id="create-post" type="submit" value="Create Post">
			<?php
		}
		else {
			$getPostID = $_GET['post'];
			?>
			<h1>Edit Post</h1>
			<?php
			$sql = "SELECT * FROM news WHERE id='$getPostID' LIMIT 1";
			$newsArray = mysqli_fetch_assoc($database->query($sql));
			?>
			<input id="post-id" type="hidden" name="post-id" value="<?php echo $getPostID; ?>">
			<input id="post-title" type="text" name="post-title" value="<?php echo $newsArray["title"]; ?>" /><br /><br />
			<textarea id="post-content" name="post-content" rows="4" cols="40"><?php echo $newsArray["content"]; ?></textarea><br /><br />
			<input id="update-post" type="submit" value="Update Post"><br /><br />
			<a class="delete-post" href="">Delete Post</a>
			<?php
		}
		require_once("layout/admin-footer.php");
	}

	

?>