// Account registration
$(document).ready(function() {
	$("#register-submit").click(function() {
		var username = $("#username").val();
		var email = $("#email").val();
		var password = $("#password").val();
		var passwordConfirm = $("#confirm-password").val();
		// Returns successful data submission message when the entered information is received by the User class.
		var dataString = 'username='+ username + '&email='+ email + '&password='+ password + '&password-confirm='+ passwordConfirm + '&post-type=register';
		if (username==''||email==''||password==''||passwordConfirm=='') {
			alert("Please fill out all required fields.");
		}
		else {
			if (password === passwordConfirm) {
				$.ajax({
					type: "POST",
					url: "/includes/user.php",
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
				url: "/includes/user.php",
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
		}
		return false;
	});
});