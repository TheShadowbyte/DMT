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