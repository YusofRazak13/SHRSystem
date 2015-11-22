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
		
		$username = mysqli_real_escape_string($checkConnect, $_POST['username']);
		$password = mysqli_real_escape_string($checkConnect, $_POST['password1']);
		$cpassword = mysqli_real_escape_string($checkConnect, $_POST['password2']);
		if($password != $cpassword)
		{
			?>
			<script>alert('Password not match!');</script>
			<?php
		}else{
			$password=sha1($password); // Encrypted Password
			$sql = "SELECT * FROM login WHERE username='$username' and password='$password'";
			$result = mysqli_query($checkConnect, $sql) or die(mysql_error());
			$count = mysqli_num_rows($result);
			$row = mysqli_fetch_array($result);
			
			// If result matched $username and $password, table row must be 1 row
			if($count==1)
			{
				$_SESSION['user'] = $row['id'];
				header("Location: home.php");
			}
			else
			{
				?>
				<script>alert('Invalid Username or Password!');</script>
				<?php
			}
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
					<input type="password" id="password1" name="password1" class="form-control" placeholder="Password" minlength="8" required>
						<label for="password1" class="glyphicon glyphicon-lock" rel="tooltip" title="password1"></label>
					</input>
				</div>
				<div class="icon-addon addon-lg">
					<input type="password" id="password2" name="password2" class="form-control" placeholder="Retype Password" minlength="8" required>
						<label for="password2" class="glyphicon glyphicon-briefcase" rel="tooltip" title="password2"></label>
					</input>
				</div>
				<div class="icon-addon addon-lg">
					<input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
						<label for="email" class="glyphicon glyphicon-globe" rel="tooltip" title="email"></label>
					</input>
				</div>        
				<div id="term" class="checkbox">
					<label>
						<input type="checkbox" value="term" required> Terms and Conditions.
					</label>
				</div>
				<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="btn-register">Confirm</button>
			</form><!-- /form -->
    </div><!-- /card-container -->
</div><!-- /container -->
<script src="js/login-form.js"></script>