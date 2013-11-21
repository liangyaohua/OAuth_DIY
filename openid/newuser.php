<?php 
	include_once('db_connection.php');
	if(isset($_GET['username']) && $_GET['username'] != ""){
		$username = $_GET['username'];
	} else {
		die("username required");
	}
	if(isset($_GET['lastname']) && $_GET['lastname'] != ""){
		$lastname = $_GET['lastname'];
	} else {
		die("lastname required");
	}
	if(isset($_GET['firstname']) && $_GET['firstname'] != ""){
		$firstname = $_GET['firstname'];
	} else {
		die("firstname required");
	}
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
	$query = "insert into users (username,lastname,firstname,email,password) values ('".$username."','".$lastname."','".$firstname."','".$email."','".$password."')";

	try {
		$result = $connection->exec($query);
	}catch (PDOException $e) {
		throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
		die();
	}
	echo "account created, please go back to log in";
?>