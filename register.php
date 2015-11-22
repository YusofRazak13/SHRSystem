<?php 
	require_once 'dbconnect/host.php';
	include 'interface.php';
	session_start();
	if(isset($_SESSION['user'])!="")
	{
		header("Location: home.php");
	}
	if(isset($_POST['btn-register']))
	{
		$_SESSION['register'] = $_POST['username'];
		$username = mysqli_real_escape_string($checkConnect, $_POST['username']);
		$password = mysqli_real_escape_string($checkConnect, $_POST['password1']);
		$cpassword = mysqli_real_escape_string($checkConnect, $_POST['password2']);
		$email = mysqli_real_escape_string($checkConnect, $_POST['email']);
		date_default_timezone_set("UTC+8");
		$datetime = date("Y-m-d h:i:sa");
		$lastLogin = NULL;
		$student_id = NULL;
		$staff_id = NULL;
		$houseOwner_id = NULL;
		$level_id = mysqli_real_escape_string($checkConnect, $_POST['selectUser']);
		if($password != $cpassword)
		{
			?>
			<script>alert('Password not match!');</script>
			<?php
		}else{
			$password=sha1($password); // Encrypted Password
			$insert = "INSERT INTO login (username, password, email, createdDate, lastLogin, student_id, staff_id, houseOwner_id, level_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$statement = mysqli_prepare($checkConnect, $insert);
			mysqli_stmt_bind_param($statement, "sssssiiii", $username, $password, $email, $datetime, $lastLogin, $student_id, $staff_id, $houseOwner_id, $level_id);
			mysqli_stmt_execute($statement);
			mysqli_stmt_close($statement);
			mysqli_close($checkConnect);
			?>
			<script>alert("Successfully Registered!");</script>
			<?php
			header("Location: login.php");
		}		
	}
?>
<link href="css/login-form.css" rel="stylesheet">
<div class="container">
    <div class="card card-container">
		<strong style="font-size: 18px">Sign Up</strong></br>It's free and always will be.</br>
			<form role="form" data-toggle="validator" onSubmit="return validation()" id="registration" class="form-signin" method="post" action="register.php">
				<span id="reauth-email" class="reauth-email"></span>
				<div class="icon-addon addon-lg">
					<input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
						<label for="username" class="glyphicon glyphicon-user" rel="tooltip" title="username"></label>
					</input>
				</div>
				<div class="icon-addon addon-lg">
					<input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
						<label for="email" class="glyphicon glyphicon-globe" rel="tooltip" title="email"></label>
					</input>
				</div>  
				<div class="icon-addon addon-lg">
					<input type="password" id="password1" name="password1" class="form-control" placeholder="Password" minlength="8" required>
						<label for="password1" class="glyphicon glyphicon-lock" rel="tooltip" title="password1"></label>
					</input>
				</div>
				<div class="icon-addon addon-lg">
					<input type="password" id="password2" name="password2" class="form-control" placeholder="Retype Password" minlength="8" required>
						<label for="password2" class="glyphicon glyphicon-briefcase" rel="tooltip" title="password2"></label>
					</input>
				</div>
				<div>
					<select class="form-control" name="selectUser">
					  <option value="1">Staff</option>
					  <option value="2">Student</option>
					  <option value="3">House Owner</option>
					</select>
				</div>
				<div id="term" class="checkbox">
					<label>
						<input type="checkbox" value="term" required> Terms and Conditions.
					</label>
				</div>
				<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="btn-register">Confirm</button>
				Already Registered? 
				<a href="login.php" class="forgot-password">
					Login Here!
				</a>
			</form><!-- /form -->
    </div><!-- /card-container -->
</div><!-- /container -->
<script src="js/login-form.js"></script>