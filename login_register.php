<?php ob_start(); ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login Register</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

	<?php 
		include_once "db.php";
		if(isset($_POST['register'])){
			$username = $_POST['username'];
			$useremail = $_POST['useremail'];
			$userpassword = $_POST['userpassword'];
			$password = password_hash($userpassword,PASSWORD_BCRYPT,array('aa'=>11));
			$query = "INSERT INTO `user`(`name`, `email`, `password`) VALUES ('$username','$useremail','$password')";
			mysqli_query($connect,$query);
			header('location:login_register.php');
		}
	 ?>

	 <?php 
	 	if(isset($_POST['login'])){
	 		$email = $_POST['useremail'];
	 		$password = $_POST['userpassword'];

	 		$query = "SELECT * FROM user WHERE email='$email'";
	 		$result = mysqli_query($connect,$query);
	 		if(mysqli_num_rows($result)==0){
	 			echo "<h2 class='text-center text-danger'>Plese Register . Email Not Yet !</h2>";
	 		}else{
	 			while($row=mysqli_fetch_assoc($result)){
	 				$db_name = $row['name'];
	 				$db_pass = $row['password'];
	 				$db_email = $row['email'];
	 			}

	 		if($password == password_verify($password,$db_pass)){
	 			$_SESSION['sess_name']=$db_name;
	 			$_SESSION['sess_pass']=$db_pass;
	 			$_SESSION['sess_email']=$db_email;
	 			header('location:showpost.php');
	 		}else{
	 			echo " <h2 class='text-center text-danger'>Incorrect Password .</h2>";
	 		}


	 		}

	 	}
	  ?>

	<div class="container">

		<?php 
			if(isset($_GET['register'])){
		?>
			
		<div class="card-header">
			<h2 class="text-center">Register</h2>
		</div>

		<div class="card-body">
			<form action="" method="post">
				<div class="form-group">
					<label for="">Name</label>
					<input type="text" name="username" placeholder="Enter Your Name" class="form-control">
				</div>

				<div class="form-group">
					<label for="">Email</label>
					<input type="email" name="useremail" placeholder="Enter Your Email" class="form-control">
				</div>

				<div class="form-group">
					<label for="">Password</label>
					<input type="password" name="userpassword" placeholder="Enter Your Password" class="form-control">
				</div>

				<div class="form-group">
					<input type="submit" name="register" value="Register" class="btn btn-primary">
				</div>
			</form>
		</div>

		<div class="card-footer">
			
		</div>

		<?php
			}else{
		?>
			
		<div class="card-header">
			<h2 class="text-center">Login</h2>
		</div>

		<div class="card-body">
			<form action="" method="post">
				<div class="form-group">
					<label for="">Email</label>
					<input type="email" name="useremail" placeholder="Enter Your Email" class="form-control">
				</div>

				<div class="form-group">
					<label for="">Password</label>
					<input type="password" name="userpassword" placeholder="Enter Your Password" class="form-control">
				</div>

				<div class="form-group">
					<input type="submit" name="login" value="Login" class="btn btn-primary">
				</div>
			</form>
		</div>

		<div class="card-footer">
			<div class="text-center">
				Don't Have An Account ? <a href="login_register.php?register=1">Register</a>
			</div>
		</div>

		<?php
			}
		 ?>


	</div>


	<script src="js/bootstrap.min.js"></script>
</body>
</html>