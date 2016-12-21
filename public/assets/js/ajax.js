$(document).ready(function() {
	$("#register-submit").click(function() {
		var name = $("#username").val();
		var email = $("#email").val();
		var password = $("#password").val();
		var passwordConfirm = $("#confirm-password").val();
		// Returns successful data submission message when the entered information is stored in database.
		var dataString = 'name1='+ name + '&email1='+ email + '&password1='+ password + '&password-confirm1='+ passwordConfirm;
		if (name==''||email==''||password==''||passwordConfirm=='') {
			alert("Please fill out all fields");
		}
		else {
			$.ajax({
				type: "POST",
				url: "../includes/ajax-submit.php",
				data: dataString,
				cache: false,
				success: function(result) {
					alert("cool");
				}
			});
		}
		return false;
	});
});