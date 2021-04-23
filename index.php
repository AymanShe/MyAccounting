<?php
session_start();

//if session is on
if(isset($_SESSION['user'])&&($_SESSION['user']=='ayman'||$_SESSION['user']=='osamah')){
	include('add_transaction.php');
}
else{
	if(isset($_COOKIE['user'])){
		if($_COOKIE['user']=='ayman')
			$_SESSION['user'] = 'ayman';
		if($_COOKIE['user']=='osamah')
			$_SESSION['user'] = 'osamah';
		include('add_transaction.php');
	}else{
		include('login.html');
	}
}

?>