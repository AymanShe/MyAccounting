<?php
include 'sql.php';
session_start();
//get user amount and description
$user = $_SESSION['user'];
$amount = $_POST['amount'];
$description = $_POST['description'];
$isShared = false;
if(isset($_POST['shared']) && $_POST['shared']=="1")
	$isShared = true;

//get user id
$sql = 'SELECT * FROM `persons` WHERE `name` = \''.$user.'\'';
if($result = mysqli_query($con,$sql)){
	$userRow = mysqli_fetch_assoc($result);
	$userId = $userRow['id']; 
	//insert the transaction record in items table
	date_default_timezone_set("Asia/Riyadh");
	$datetime = date("Y-m-d H:i:s");
	
	
	$sql = 'INSERT INTO `items` (`person`, `amount`, `isShared`, `description`, `datetime`, `image`) VALUES (\''.$userId.'\', \''.$amount.'\', \''.($isShared==true?1:0).'\', \''.$description.'\', \''.$datetime.'\', NULL)';
	if($result = mysqli_query($con, $sql)){
		//settle the mount if shared
		if($isShared){
			$amount = $amount/2;
			// $amount = number_format((float)$amount, 2, '.', '');
		}

		$yourBalanceInDb = $userRow['balance'];
		//calculate new balance
		$yourNewBalance = $yourBalanceInDb + $amount;
		//update the db
		$sql = 'UPDATE `persons` SET `balance` = \''.$yourNewBalance.'\' WHERE `name` = \''.$user.'\'';
		if($result = mysqli_query($con, $sql)){
			$sql = 'SELECT `balance` FROM `persons` WHERE `name` != \''.$user.'\'';
			if($result = mysqli_query($con,$sql)){
				$row = mysqli_fetch_assoc($result);
				$theirBalanceInDb = $row['balance'];
				$theirNewBalance = $theirBalanceInDb - $amount;
				$sql = 'UPDATE `persons` SET `balance` = \''.$theirNewBalance.'\' WHERE `name` != \''.$user.'\'';
				if($result = mysqli_query($con, $sql)){
					$location = 'Location: /index.php?message=success';
					header($location);
				}else{
					echo mysqli_error($con);
					echo 'the second transaction wasn\'t complete. Need to adjust balance manually';				
				}
			}else{
				echo mysqli_error($con);
				echo 'the second transaction wasn\'t complete. Need to adjust balance manually';
			}
		}else{
			echo mysqli_error($con);
			echo 'transaction was not successful. Nothing changed';
		}
	}else
		echo mysqli_error($con);

}else
	echo mysqli_error($con);














	// //settle the mount if shared
	// if($isShared){
		// $amount = $amount/2;
		// $amount = number_format((float)$amount, 2, '.', '');
	// }

// //get the balance`
// $sql = 'SELECT `balance` FROM `persons` WHERE `name` = \''.$user.'\'';
// if($result = mysqli_query($con, $sql)){
	// $row = mysqli_fetch_assoc($result);
		// $yourBalanceInDb = $row['balance`'];
		// //calculate new balance
		// $yourNewBalance = $yourBalanceInDb + $amount;
		// //update the db
		// $sql = 'UPDATE `persons` SET `balance` = \''.$yourNewBalance.'\' WHERE `name` = \''.$user.'\'';
		// if($result = mysqli_query($con, $sql)){
			// $sql = 'SELECT `balance` FROM `persons` WHERE `name` != \''.$user.'\'';
			// if($result = mysqli_query($con,$sql)){
				// $row = mysqli_fetch_assoc($con);
				// $theirBalanceInDb = $row['balance'];
				// $theirNewBalance = $theirBalanceInDb - $amount;
				// $sql = 'UPDATE `persons` SET `balance` = \''.$theirNewBalance.'\' WHERE `name` != \''.$user.'\'';
				// if($result = mysqli_query($con, $sql)){
					// $location = 'Location: /index.php?message=success';
					// header($location);
				// }else{
					// echo mysqli_error($con);
					// echo 'the second transaction wasn\'t complete. Need to adjust balance manually';				
				// }
			// }else{
				// echo mysqli_error($con);
				// echo 'the second transaction wasn\'t complete. Need to adjust balance manually';
			// }
		// }else{
			// echo mysqli_error($con);
			// echo 'transaction was not successful. Nothing changed';
		// }
// }
// else
	// echo mysqli_error($con);



?>