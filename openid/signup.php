<?php
	define('HOST','http://'.$_SERVER['HTTP_HOST'].'/openid');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>My OpenID - Sign up</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
	<style type="text/css">
	body {
		text-align: center;
	}
	form {
		margin-left: 15px;
		margin-right: 15px;
	}
	</style>
</head>
<body>
<div class="container">
	<div class="page-header">
  		<h1>My OpenID <small>Resource server</small></h1>
	</div>
	<div id="signup">
		<form class="form-horizontal" role="form" id="signupform">
			<div class="form-group">
		      	<input type="text" class="form-control" id="lastname" placeholder="Lastname">
		  	</div>
		  	<div class="form-group">
		      	<input type="text" class="form-control" id="firstname" placeholder="Firstname">
		  	</div>
		  	<div class="form-group">
		      	<input type="text" class="form-control" id="username" placeholder="Username">
		  	</div>
		  	<div class="form-group">
		      	<input type="email" class="form-control" id="email" placeholder="Email">
		  	</div>
		  	<div class="form-group">
		      	<input type="password" class="form-control" id="password" placeholder="Password">
		  	</div>
		  	<div class="form-group">
		      	<div class="checkbox">
		        	<label>
		          		<input type="checkbox" id="checkbox"> I accept the terms of use
		       	 	</label>
		      	</div>
		  	</div>
		  	<div class="form-group">
		      	<button type="button" class="btn btn-default" id="btn-signup">Sign up</button>
		  	</div>
		</form>
		<div class="alert alert-info" id="alert"></div>
	</div>
</div>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#alert').hide();

		$('#btn-signup').click(function(){
			var username = $('#username').val();
			var lastname = $('#lastname').val();
			var firstname = $('#firstname').val();
			var email = $('#email').val();
			var password = $('#password').val();
			if(username == ""){
				$('#alert').html("username required");
			} else if (lastname == "") {
				$('#alert').html("lastname required");
			} else if (firstname == "") {
				$('#alert').html("firstname required");
			} else if (email == "") {
				$('#alert').html("email required");
			} else if (password == "") {
				$('#alert').html("password required");
			} else if(!$('#checkbox').is(':checked')) {
				$('#alert').html("you need to accept the terms of use");
			} else {
				var downloadUrl = "<?php echo HOST;?>/newuser.php?username="+username+"&lastname="+lastname+"&firstname="+firstname+"&email="+email+"&password="+password;

				ajaxUpdate(downloadUrl,"#alert");
			}

			$('#alert').fadeIn();
		});

		function ajaxUpdate(downloadUrl, divID) {
			var xmlhttp;
			if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function() {
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					$(divID).html(xmlhttp.responseText);
				}
			}
			xmlhttp.open("GET", downloadUrl, true);
			xmlhttp.send();
		}
	});
	</script>
</body>
</html>