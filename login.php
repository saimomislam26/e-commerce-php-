	<!DOCTYPE html>
	<?php 
	include 'connection.php';
	$error='';
	$pass='';
	$sql='';
	$email='';
	if(isset($_POST['login_button']))
	{
		if(empty($_POST['login_email']) || empty($_POST['login_password']) )
		{
			$error="Empty fields .Please filled up properly";
			
	?> 
			<script>alert('<?php echo $error ;?>');</script>
			<?php	
		}
		else{
			$email=$_POST['login_email'];
			$pass=$_POST['login_password'];
			
			$email=mysqli_real_escape_string($link,$email);
			$pass=mysqli_real_escape_string($link,$pass);
			
			$pass=md5($pass);
			
			$sql="select * from user_profiles where user_email ='$email'";
			$result= mysqli_query($link,$sql);
			$row = mysqli_fetch_array($result);
			
			if($row['user_password'] == $pass && $row['user_email'] == $email )
			{
				$_SESSION['user']['id']=$row['user_id'];
				$_SESSION['user']['name']=$row['user_name'];
				$_SESSION['user']['email']=$row['user_email'];
				$_SESSION['user']['address']=$row['user_address'];
				
				$_SESSION['user']['phone']=$row['user_phone_no'];
				
				
				
				
				header("location:index.php");
				
			}
			else{
				
				$error="Incorrect User Email or Password";
				
			}
			?> 
			<script>alert('<?php echo $error ;?>');</script>
			<?php
			
		}
	}
	?>
	
	<html lang="en">
	<head>
	  
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

	</head>
	<body>

	<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header text-center">
			<h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body mx-3">
		  
		  <!-- Default form login -->
			<form class="text-center  p-5" method="post">

		<!-- Email -->
		<input type="email" id="email_login" name="login_email" class="form-control mb-4" placeholder="E-mail">

		<!-- Password -->
		<input type="password" id="password_login" name="login_password" class="form-control mb-4" placeholder="Password">

		<div class="d-flex justify-content-around">
			<div>
				<!-- Remember me -->
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="remember_me" name="remember_me">
					<label class="custom-control-label" for="remember_me">Remember me</label>
				</div>
			</div>
			<div>
				<!-- Forgot password -->
				<a href="#">Forgot password?</a>
			</div>
		</div>

		<!-- Sign in button -->
		<p style="margin-top:5px";>
		<input type="submit" name="login_button" class="btn btn-info btn-block my-4" value="Sign in" >
		</p>
		
		<div class="error"><?php echo $error ?></div>

		<!-- Register -->
		<p>Not a member?
			<a href="register.php">Register</a>
		</p>

	</form>
		  </div>
		  <div class="modal-footer d-flex justify-content-center">
			
		  </div>
		</div>
	  </div>
	</div>

	</body>
	</html>
