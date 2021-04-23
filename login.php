<?php
session_start();

//connect to db
include 'sql.php';


//fetch username and password from POST
$username = strtolower(mysqli_real_escape_string($con, $_POST['username']));
$password = mysqli_real_escape_string($con, $_POST['password']);

//fetch from db
$sql = 'SELECT * FROM `persons` WHERE `name` = "'. $username .'"';
if($result = mysqli_query($con, $sql)){
	$value = mysqli_fetch_assoc($result);
}else{
	$message = mysqli_error($con);
	$location = 'Location: /myAccounting/login.html?message='.$message;
	header($location);
}

//if user not found
if($value==false){
	$location = 'Location: /login.html?message=Incorrect Username or Password';
	header($location);
}else{
	//compare against db
	$authenticated = password_verify($password, $value['password']);
	if(!$authenticated){
		$location = 'Location: /login.html?message=Incorrect Username or Password';
		header($location);
	}else{
		$user = $value['name'];
		$_SESSION['user'] = $user; 
		//remember me
		if(isset($_POST['remember'])){
			setcookie('user', $user, time() + (86400 * 30));
		}
		$location = 'Location: /';
		header($location);
	}
}




?>