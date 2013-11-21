<?php 
	include_once('db_connection.php');
	if(isset($_GET['appname']) && $_GET['appname'] != ""){
		$appname = $_GET['appname'];
	} else {
		die("appname required");
	}
	if(isset($_GET['appurl']) && $_GET['appurl'] != ""){
		$appurl = $_GET['appurl'];
	} else {
		die("appurl required");
	}

	$appid = md5($appname.$appurl.mt_rand(99999));

	$query = "insert into apps (appname,appurl,appid) values ('".$appname."','".$appurl."','".$appid."')";
	$result = $connection->exec($query);
	
	if (!$result) {
		die("Create app failed");
	}
	echo "Your app has been created, your appID is: ".$appid;
?>