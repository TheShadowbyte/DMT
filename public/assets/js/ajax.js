// Account registration
$(document).ready(function() {
	$("#register-submit").click(function() {
		var username = $("#username").val();
		var email = $("#email").val();
		var password = $("#password").val();
		var passwordConfirm = $("#confirm-password").val();
		// Returns successful data submission message when the entered information is received by the User class.
		var dataString = 'username='+ username + '&email='+ email + '&password='+ password + '&post-type=register';
		if (username==''||email==''||password==''||passwordConfirm=='') {
			alert("Please fill out all required fields.");
		}
		else {
			if (password === passwordConfirm) {
				$.ajax({
					type: "POST",
					url: "/register.php",
					data: dataString,
					cache: false,
					success: function(result) {
						alert("Your account has been successfully created.");
					}
				});
			}
			else {
				alert("Passwords don't match.");
			}
		}
		return false;
	});
});

// Account login
$(document).ready(function() {
	$("#login-submit").click(function() {
		var username = $("#username").val();
		var password = $("#password").val();
		// Returns successful data submission message when the entered information is received by the User class.
		var dataString = 'username='+ username + '&password='+ password + '&post-type=login';
		if (username==''||password=='') {
			alert("Please fill out all required fields.");
		}
		else {
			$.ajax({
				type: "POST",
				// url: "/includes/class-login.php",
				url: "/includes/controller.php",
				data: dataString,
				cache: false,
				success: function(result) {
					if (result == "success") {
						alert(result);
						document.location.href="/profile";
					}
					else {
						alert(result);
						document.location.href=window.location.href;
					}
				}
			});
		}
		return false;
	});
});

// Admin login
$(document).ready(function() {
	$("#admin-login-submit").click(function() {
		var username = $("#username").val();
		var password = $("#password").val();
		// Returns successful data submission message when the entered information is received by the User class.
		var dataString = 'username='+ username + '&password='+ password + '&post-type=admin-login';
		if (username==''||password=='') {
			alert("Please fill out all required fields.");
		}
		else {
			$.ajax({
				type: "POST",
				// url: "/admin/includes/class-login-admin.php",
				url: "/includes/controller.php",
				data: dataString,
				cache: false,
				success: function(result) {
					if (result == "success") {
						document.location.href="/admin/";
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

// Account logout
$(document).ready(function() {
	$("#logout").click(function() {
		var dataString = 'post-type=logout';
		$.ajax({
			type: "POST",
			url: "/includes/session.php",
			data: dataString,
			cache: false,
			success: function(result) {
				if (result == "success") {
					document.location.href="/";
				}
				else {
					document.location.href=window.location.href;
				}
			}
		});
		return false;
	});
});

// Change Email
$(document).ready(function() {
	$("#change-email-submit").click(function() {
		var email = $("#email").val();
		var dataString = 'email='+ email + '&post-type=change-email';
		if (email=='') {
			alert("You cannot leave the email field blank.");
		}
		else {
			$.ajax({
				type: "POST",
				url: "/includes/user.php",
				data: dataString,
				cache: false,
				success: function(result) {
					if (result == "success") {
						document.location.href=window.location.href;
					}
					else {
						alert("That email address cannot be used.");
						document.location.href=window.location.href;
					}
				}
			});
		}
		return false;
	});
});