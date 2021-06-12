		<?php 
		include 'connection.php';
		$error='';
		$email='';
		$pass='';
		$name='';
		$address='';
		$phone='';
		$sql='';
		$sqlcheck='';
		$sqlcheck1='';
		if(isset($_POST['sign_up']))
		{
			if(empty($_POST['user_name']))
			{
				$error .='<p><label class="text-danger">Please enter your name..</label></p>' ;
			}
			else{
				$name = $_POST['user_name'];
				$name=stripcslashes($name);
				$name=mysqli_real_escape_string($link,$name);
				if(!preg_match("/^[a-zA-Z]*$/",$name))
				{
					$error .='<p><label class="text-danger">Only letter and white space allowed</label></p>';
				}
			
			}
			
			
			if(empty($_POST['user_email']))
			{
				$error .='<p><label class="text-danger">Please enter your email..</label></p>' ;
			}
			else{
				$email = $_POST['user_email'];
				$email=stripcslashes($email);
				$email=mysqli_real_escape_string($link,$email);
				if(!filter_var($email,FILTER_VALIDATE_EMAIL))
				{
					$error .='<p><label class="text-danger">Invalid Email</label></p>';
				}
			
			}
			if(empty($_POST['user_pass']))
			{
				$error .='<p><label class="text-danger">Please enter your password...</label></p>' ;
			}
			else{
				$pass = $_POST['user_pass'];
				$pass=stripcslashes($pass);
				$pass=mysqli_real_escape_string($link,$pass);
				$pass=md5($pass);
				if(!preg_match("/^[a-zA-Z0-9]*$/",$address))
				{
					$error .='<p><label class="text-danger">Only  letters,digits,white spaces are allowed</label></p>';
				}
			
			}
			
			
			if(empty($_POST['user_phone']))
			{
				$error .='<p><label class="text-danger">Please enter your phone no..</label></p>' ;
			}
			else{
				$phone = $_POST['user_phone'];
				$phone=stripcslashes($phone);
				$phone=mysqli_real_escape_string($link,$phone);
				if(!preg_match("/^[0-9]*$/",$phone))
				{
					$error .='<p><label class="text-danger">Only digits are allowed</label></p>';
				}
			
			}
			
			if(empty($_POST['user_address']))
			{
				$error .='<p><label class="text-danger">Please enter your adress ...</label></p>' ;
			}
			else{
				$adress = $_POST['user_address'];
				$adress=stripcslashes($adress);
				$adress=mysqli_real_escape_string($link,$adress);
			}
			
			
	 if($error =='')
	   {
		   $sql="insert into user_profiles(user_name,user_email,user_password,user_address,user_phone_no)values('$name','$email','$pass','$adress','$phone')";
	   }
	   if(mysqli_query($link,$sql))
	   {
		  
		
		   ?>
		   
		   <script>alert('Successfully Registered');
		   window.location.href = "home.php";
		   
		   </script>
		   
		   
		   <?php
		   
		    
	   }
		else{
			$sqlcheck="select user_email from user_profiles where user_email ='$email'";
			$resultcheck= mysqli_query($link,$sqlcheck);
			$rowcheck = mysqli_fetch_array($resultcheck);
			
			$sqlcheck1="select user_phone from user_profiles where user_phone ='$phone'";
			$resultcheck= mysqli_query($link,$sqlcheck);
			$rowcheck = mysqli_fetch_array($resultcheck);
			
			?> 
			<?php 
			if($rowcheck[0] == $_POST['user_email'])
			{
			?>
			<script>alert('This email is already in use.');</script>
			<?php 
				
			}else if($rowcheck[1]==$_POST['user_phone']) {?>
			<script>alert('This phone no is already in use.');</script>
			<?php } else{ ?>
				<script>alert('Server error.');</script>
			<?php }?>
			<?php
		}
	   
	}


	?>
	
	<html>
	<head>

	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	  <link rel="stylesheet" href="css/main.css" />
		

	</head>
	
	<body>
	<?php include 'header.php'; ?>

	
	<div class="container">
		
			<div class="row">
				 <div class="col-md-6">
			<form method="post">
				<h5 style="margin-top:20px";>Sign up information</h5>
				<hr>
				<h6>Name*</h6>
				<input type="text" name="user_name" class="form-control mb-4" placeholder="Enter Your Name">
				<h6>Email*</h6>
				<input type="email" name="user_email" class="form-control mb-4" placeholder="Enter your email...">
				<h6>Password*</h6>
				<input type="password" name="user_pass"  class="form-control mb-4" placeholder="Enter Password">
				<h6>Mobile*</h6>
				<input type="text" name="user_phone"  class="form-control mb-4" placeholder="Enter your phone no...">
				<h6>Address</h6>
				<input type="text" name="user_address"  class="form-control mb-4" placeholder="Enter your adress...">
				
				<p style="margin-top:5px";>
				<input type="submit" name="sign_up" class="btn btn-info" value="Sign Up"  >
				</p>
				
				</form>
				</div>
				
			 </div>
			 
			</div>
					

	<?php include 'footer_up.php'; ?>



			
	</body>
	</html>