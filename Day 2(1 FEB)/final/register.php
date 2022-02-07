<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
	<link rel="stylesheet" href="css/style.css">
	<title>Register</title>
</head>
<body>
	<div>
  <a href="contactUs.html">Contact us</a>
  <a href="login.html">Login</a>
  <a href="register.html">Register</a>
  </a>
</div>
	<form class="form-div col-md-4 mx-auto mt-5" method=<?php echo $_SERVER['PHP_SELF'];?>>
			
		<div class="form-group" >
  			<input type="text" class="form-control" placeholder="Username" name="full_name"required>
		</div>

		<div class="form-group">
			<input type="email" class="form-control" placeholder="Eg. example@email.com" name="email_cs"required>
		</div>
		<div class="form-group" >
  			<input type="password" class="form-control" placeholder="Password" name="password"required>
		</div>
		<div class="form-group" >
  			<input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password"required>
		</div>
		<div class="form-group">
			<input type="number" placeholder="+1 800 000000" name="phone_num" class="form-control"required>
		</div>
		<div class="form-group text-center submit">
			<input type="submit" name="sb_btn" value="Register now" class="btn btn-primary"required>
		</div>
		<div class="form-group" >
  			<a href="login.html">Already member? Click here</a>
		</div>
	</form>
		<?php
		$uname=$_REQUEST['Username'];
		$num=$_REQUEST['phone_num'];
		$psw=$_REQUEST['password'];
		$email=$_REQUEST['email_cs'];

		echo "User name:".$uname."<br>Mobile Number: ".$num."<br>Password: ".$psw."<br>Email: ".$email;

	?>
	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
			$('form').submit(function(){
				alert("Your request has been submitted!");
			});	
	</script>

</body>

</html>