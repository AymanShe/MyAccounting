<?php
include 'sql.php';

function getBalance($user, $con){
	$sql = 'SELECT `balance` FROM `persons` WHERE `name` = \''.$user.'\'';
	if($result = mysqli_query($con, $sql)){
		$row = mysqli_fetch_assoc($result);
		$balance = $row['balance'];
		return $balance;
	}else
		return mysqli_error($con);
}


$user = $_SESSION['user'];



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Add Transaction · myAccounting</title>


    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <style>
		html,body 
		{
			height: 100%;
		}

		body 
		{
			display: -ms-flexbox;
			display: flex;
			-ms-flex-align: center;
			align-items: center;
			padding-bottom: 40px;
			background-color: #f5f5f5;
		}

		.form-signin 
		{
			width: 100%;
			max-width: 330px;
			padding: 15px;
			margin: auto;
		}
		.form-signin .checkbox 
		{
			font-weight: 400;
		}
		.form-signin .form-control
		{
			position: relative;
			box-sizing: border-box;
			height: auto;
			padding: 10px;
			font-size: 16px;
		}
		.form-signin .form-control:focus 
		{
			z-index: 2;
		}
		.form-signin input[type="email"] 
		{
			margin-bottom: -1px;
			border-bottom-right-radius: 0;
			border-bottom-left-radius: 0;
		}
		.form-signin input[type="password"]
		{
			margin-bottom: 10px;
			border-top-left-radius: 0;
			border-top-right-radius: 0;
		}
		
		.bd-placeholder-img 
		{
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}

		@media (min-width: 768px) 
		{
			.bd-placeholder-img-lg 
			{
				font-size: 3.5rem;
			}
		}
    </style>
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
	<body class="text-center">
		<div class="form-signin">
			<form action="make_transaction.php" method="post" class="form-signin">
				<img class="mb-4" src="logo.jpg" alt="" width="72" height="72">
				<h1>BALANCE</h1>
				<h1><?php echo getBalance($user, $con) ?></h1>
				<label for="inputEmail" class="sr-only">Amount</label>
				<input type="number" name="amount" id="inputAmount" class="form-control" placeholder="Amount" required>
				
				<label for="inputPassword" class="sr-only">Description</label>
				<input type="text" name="description" id="inputDescription" class="form-control" placeholder="Description" required>
				
				<!-- <label for="inputPassword" class="sr-only">Image</label> -->
				<!-- <input type="file" name="image" id="inputImage"> -->
				
				<a id="sharedbtn" class="btn btn-secondary btn-lg btn-block" href="#">Shared</a>
				<br>
				<input type="hidden" id="shared" name="shared" value="0">
				
				<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
			</form>
			<hr>
			<a href="transactions"><button class="btn btn-lg btn-success btn-block">All Transactions</button></a>
			<p class="mt-5 mb-3 text-muted">&copy;Houses of Things 2017-2019</p>
		</div>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
	<script>
		$("#sharedbtn").click(function(){
			if($("#shared").attr("value") == "0"){
				$("#sharedbtn").removeClass("btn-secondary");
				$("#sharedbtn").addClass("btn-warning");
				$("#shared").val(1);
			}else{
				$("#sharedbtn").removeClass("btn-warning");
				$("#sharedbtn").addClass("btn-secondary");
				$("#shared").val(0);
			}
			  
		});
	</script>
</html>
