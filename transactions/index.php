<?php
session_start();
if(!(isset($_SESSION['user']))){
	$location = 'Location: /';
	header($location);
	die();
}
include '../sql.php';

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
    <title>Transactions · myAccounting</title>


    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">


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

		.my-table
		{
			width: 100%;
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
		<div class="my-table">
			<a href="../"><button class="btn btn-primary" style="position:fixed; left:15px; z-index:2">Go Back</button></a>
			<table id="example" class="display" style="width:100%">
				<thead>
					<tr>
						<th>Amount</th>
						<th>Person</th>
						<th>Description</th>
						<th>Shared</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
				<?php
				
				$sql = 'SELECT * FROM `items`';
				if($result = mysqli_query($con, $sql)){
					while($row = mysqli_fetch_assoc($result)){
						echo '
						<tr>
							<td>'.$row['amount'].'</td>
							<td>'.($row['person']==1?'Ayman':'Osamah').'</td>
							<td>'.$row['description'].'</td>
							<td>'.($row['isShared']==1?'Yes':'No').'</td>
							<td>'.date_create_from_format('Y-m-d H:i:s', $row['datetime'])->format('M j, Y').'</td>
						</tr>';
					}
				}else{
					echo mysqli_error($con);
				}
				
				?>
				</tbody>
			</table>
		</div>		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
		<script>
			$(document).ready(function() {
				screen.orientation.lock('landscape');
				$('#example').DataTable( {
					scrollY:        '70vh',
					scrollCollapse: true,
					paging:         false,
					info: 		    false,
					columns: [
						{ "width": "5%" },
						{ "width": "7%" },
						null,
						{ "width": "5%" },
						{ "width": "10%" }
					  ]
				} );
			} );
		</script>
	</body>
</html>
