<?php 
	include_once('db_connection.php');
	if(isset($_GET['email']) && $_GET['email'] != ""){
		$email = $_GET['email'];
	} else {
		die("email required");
	}
	if(isset($_GET['password']) && $_GET['password'] != ""){
		$password = md5($_GET['password']);
	} else {
		die("password required");
	}

	$sql = "select username,lastname,firstname from users where email=:email and password= :password";
	$result = $connection->prepare($sql);
	$result->bindValue(':email', $email, PDO::PARAM_STR);
	$result->bindValue(':password', $password, PDO::PARAM_STR);
	$result->execute();
	$result->setFetchMode(PDO::FETCH_OBJ);

	if($row = $result->fetch()) {
		$jsonArray = array("username" => $row->username,
					"lastname" => $row->lastname,
					"firstname" => $row->firstname,
					"email" => $email
					);
	} else {
		die("failed");
	}

	$json = json_encode($jsonArray);
	echo $json;
?>