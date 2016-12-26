<?php

	require_once("/../includes/database.php");
	require_once("/../includes/format.php");

	$database = new Database();

	if (Format::checkPostType("update-post")) {
		$postID = $_POST['post-id'];
		$postTitle = $_POST['post-title'];
		$postContent = $_POST['post-content'];
		$sqlUpdate = "UPDATE news SET title='$postTitle', content='$postContent' WHERE id='$postID'";
		$database->query($sqlUpdate);
	}
	else {
		$getPostID = $_GET['post'];
		$sql = "SELECT * FROM news WHERE id='$getPostID' LIMIT 1";
		$newsArray = mysqli_fetch_assoc($database->query($sql));
	}

?>
<?php require_once("layout/admin-header.php"); ?>
	<h1>Edit Post</h1>
	<input id="post-id" type="hidden" name="post-id" value="<?php echo $getPostID; ?>">
	<input id="post-title" type="text" name="post-title" value="<?php echo $newsArray["title"]; ?>" /><br /><br />
	<textarea id="post-content" name="post-content" rows="4" cols="40"><?php echo $newsArray["content"]; ?></textarea><br /><br />
	<input id="update-post" type="submit" value="Update Post">
<?php require_once("layout/admin-footer.php"); ?>