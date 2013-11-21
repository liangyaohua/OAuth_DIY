<?php
	define('HOST','http://'.$_SERVER['HTTP_HOST'].'/openid');
	include_once('db_connection.php');
	$url = isset($_GET['url'])?$_GET['url']:"http://www.liangyaohua.com/openid/";
	$appid = isset($_GET['appid'])?$_GET['appid']:"f9a41d5f2b3c3b0078b34bed046de05d";

	$sql = "select * from apps where appid='".$appid."' and appurl='".$url."'";
	$result = $connection->prepare($sql);
	$result->execute();
	$result->setFetchMode(PDO::FETCH_OBJ);

	if(!($row = $result->fetch())) {
		die($url." is not an authorized app");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>My OpenID - Log in</title>
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
	#alert {
		margin-top: 20px;
	}
	</style>
</head>
<body>
<div class="container">
	<div class="page-header">
  		<h1>My OpenID <small>Resource server</small></h1>
	</div>
	<div id="login">
		<form class="form-horizontal" role="form" id="loginform">
		  	<div class="form-group">
		      	<input type="email" class="form-control" id="email" placeholder="Email">
		  	</div>
		  	<div class="form-group">
		      	<input type="password" class="form-control" id="password" placeholder="Password">
		  	</div>
		  	<div class="form-group">
		      	<button type="button" class="btn btn-info" id="btn-login">Log in</button>
		  	</div>
		</form>
	</div>
	<button type="button" class="btn btn-default" id="btn-create">Create an acount</button>
	<div class="alert alert-info" id="alert"></div>
</div>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#alert').hide();

		$('#btn-login').click(function(){
			var email = $('#email').val();
			var password = $('#password').val();
			if (email == "") {
				$('#alert').html("email required");
				$('#alert').fadeIn();
			} else if (password == "") {
				$('#alert').html("password required");
				$('#alert').fadeIn();
			} else {
				var downloadUrl = "<?php echo HOST;?>/login.php?email="+email+"&password="+password;

				ajaxUpdate(downloadUrl,"#alert");
			}
		});

		$('#btn-create').click(function(){
			window.location.href = "<?php echo HOST;?>/signup.php";
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
					if(xmlhttp.responseText == "failed"){
						$(divID).html("email or password not correct or account not exist");
						$(divID).fadeIn();
					} else {
						var jsonObj = jQuery.parseJSON(xmlhttp.responseText);
						var username = jsonObj.username;
						var lastname = jsonObj.lastname;
						var firstname = jsonObj.firstname;
						var _email = jsonObj.email;
						var url = "<?php echo $url;?>";
						if(url == "http://www.liangyaohua.com/openid/") {
							$(divID).html("You're logged in");
							$(divID).fadeIn();
						} else {
							window.location.href = url+"?openid=yes&username="+username+"&lastname="+lastname+"&firstname="+firstname+"&email="+_email;
						}
					}
				}
			}
			xmlhttp.open("GET", downloadUrl, true);
			xmlhttp.send();
		}
	});
	</script>
</body>
</html>