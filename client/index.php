<?php
	define('HOST','http://'.$_SERVER['HTTP_HOST'].'/client');
	$username = isset($_GET['username'])?$_GET['username']:"";
	$lastname = isset($_GET['lastname'])?$_GET['lastname']:"";
	$firstname = isset($_GET['firstname'])?$_GET['firstname']:"";
	$email = isset($_GET['email'])?$_GET['email']:"";
	$openid = isset($_GET['openid'])?$_GET['openid']:"no";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>A Simple DIY OAuth - Client</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
	<style type="text/css">
	.page-header {
		text-align: center;
	}
	#login {
		float: left;
		margin-left: 100px;
	}
	#form1 {
		margin: 10px 0 10px 15px;
	}
	#btn-openid {
		margin-top: 10px;
		margin-bottom: 10px;
	}
	#signup {
		float: right;
		margin-right: 100px;
	}
	#form2 {
		margin: 10px 0 0 15px;
	}
	</style>
</head>
<body>
<div class="container">
	<div class="page-header">
  		<h1>A Simple DIY OAuth <small>Client</small></h1>
	</div>
	<div id="login">
		<strong>Log in:</strong>
		<form class="form-horizontal" role="form" id="form1">
		  	<div class="form-group">
		      	<input type="email" class="form-control" id="loginemail" placeholder="Email">
		  	</div>
		  	<div class="form-group">
		      	<input type="password" class="form-control" id="loginpwd" placeholder="Password">
		  	</div>
		  	<div class="form-group">
		      	<div class="checkbox">
		        	<label>
		          		<input type="checkbox"> Remember me
		       	 	</label>
		      	</div>
		  	</div>
		  	<div class="form-group">
		      	<button type="button" class="btn btn-default" id="btn-login">Log in</button>
		  	</div>
		</form>
		<div>
			<strong>Or log in with:</strong><br/>
			<button type="button" class="btn btn-info" id="btn-openid">My OpenID</button>
		</div>
	</div>
	<div id="signup">
		<strong>Sign up:</strong>
		<form class="form-horizontal" role="form" id="form2">
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
		      	<input type="email" class="form-control" id="signupemail" placeholder="Email">
		  	</div>
		  	<div class="form-group">
		      	<input type="password" class="form-control" id="signuppwd" placeholder="Password">
		  	</div>
		  	<div class="form-group">
		      	<div class="checkbox">
		        	<label>
		          		<input type="checkbox"> I accept the terms of use
		       	 	</label>
		      	</div>
		  	</div>
		  	<div class="form-group">
		      	<button type="button" class="btn btn-default" id="btn-signup">Sign up</button>
		  	</div>
		</form>
	</div>
</div>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#btn-login').click(function(){
			alert("Please click the blue button to log with My OpenID");
		});

		$('#btn-signup').click(function(){
			alert("Just a demo");
		});

		$('#btn-openid').click(function(){
			var url = window.location.href.split('?')[0];
			var appID = "7e1b2294311665e727e3f74260ac420d"; // Access Token
			window.location.href = "http://www.liangyaohua.com/openid/index.php?url="+url+"&appid="+appID;
		});

		var lastname = "<?php echo $lastname;?>";
		var firstname = "<?php echo $firstname;?>";
		var username = "<?php echo $username;?>";
		var email = "<?php echo $email;?>";
		var openid = "<?php echo $openid;?>";

		if(openid == "yes") {
			alert("You're logged in successful with My OpenID");
		}

		$('#lastname').val(lastname);
		$('#firstname').val(firstname);
		$('#username').val(username);
		$('#signupemail').val(email);
	});
	</script>
</body>
</html>