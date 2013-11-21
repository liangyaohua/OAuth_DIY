<?php
	define('HOST','http://'.$_SERVER['HTTP_HOST'].'/oauth');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>A Simple DIY OAuth - Server</title>
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
  		<h1>A Simple DIY OAuth <small>Server</small></h1>
	</div>
	<div id="oauth">
		<form class="form-horizontal" role="form" id="oauthform">
		  	<div class="form-group">
		      	<input type="text" class="form-control" id="appname" placeholder="App name">
		  	</div>
		  	<div class="form-group">
		      	<input type="text" class="form-control" id="appurl" placeholder="App url">
		  	</div>
		  	<div class="form-group">
		      	<button type="button" class="btn btn-info" id="btn-oauth">Create App</button>
		  	</div>
		</form>
	</div>
	<div class="alert alert-info" id="alert"></div>
</div>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#alert').hide();

		$('#btn-oauth').click(function(){
			var appname = $('#appname').val();
			var appurl = $('#appurl').val();
			if (appname == "") {
				$('#alert').html("App name required");
			} else if (appurl == "") {
				$('#alert').html("App url required");
			} else {
				var downloadUrl = "<?php echo HOST;?>/oauth.php?appname="+appname+"&appurl="+appurl;

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