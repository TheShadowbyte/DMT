// Create Post
$(document).ready(function() {
	$("#create-post").click(function() {
		var postTitle = $("#post-title").val();
		var postContent = $("#post-content").val();
		var dataString = 'post-title='+ postTitle + '&post-content='+ postContent + '&post-type=create-post';
		if (postTitle==''||postContent=='') {
			alert("Please fill out all required fields.");
		}
		else {
			$.ajax({
				type: "POST",
				url: "/admin/news-edit.php",
				data: dataString,
				cache: false,
				success: function(result) {
					document.location.href=window.location.href + "?post=" + result;
				}
			});
		}
		return false;
	});
});

// Edit Post
$(document).ready(function() {
	$("#update-post").click(function() {
		var postID = $("#post-id").val();
		var postTitle = $("#post-title").val();
		var postContent = $("#post-content").val();
		var dataString = 'post-id='+ postID + '&post-title='+ postTitle + '&post-content='+ postContent + '&post-type=update-post';
		if (postTitle==''||postContent=='') {
			alert("Please fill out all required fields.");
		}
		else {
			$.ajax({
				type: "POST",
				url: "/admin/news-edit.php",
				data: dataString,
				cache: false,
				success: function(result) {
					if (result == "success") {
						document.location.href=window.location.href;
					}
					else {
						document.location.href=window.location.href;
					}
				}
			});
		}
		return false;
	});
});

// Delete Post
$(document).ready(function() {
	$("#delete-post").click(function() {
		var postID = $("#post-id").val();
		var dataString = 'post-id='+ postID + '&post-type=delete-post';
		$.ajax({
			type: "POST",
			url: "/admin/news-edit.php",
			data: dataString,
			cache: false,
			success: function(result) {
				document.location.href="news.php";
			}
		});
		return false;
	});
});

// Edit User
$(document).ready(function() {
	$("#edit-user").click(function() {
		var userID = $("#user-id").val();
		var username = $("#username").val();
		var email = $("#email").val();
		var dataString = 'user-id='+ userID + '&username='+ username + '&email='+ email + '&post-type=edit-user';
		if (username==''||email=='') {
			alert("Please fill out all required fields.");
		}
		else {
			$.ajax({
				type: "POST",
				url: "/admin/user-edit.php",
				data: dataString,
				cache: false,
				success: function(result) {
					alert(result);
					document.location.href=window.location.href;
				}
			});
		}
		return false;
	});
});
