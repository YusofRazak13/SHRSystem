<?php 
	require_once 'dbconnect/host.php';
	include 'interface.php';
	session_start();
	if(isset($_SESSION['user'])!="")
	{
		header("Location: home.php");
	}
	if(isset($_POST['btn-login']))
	{
		$username = mysqli_real_escape_string($checkConnect, $_POST['username']);
		$password = mysqli_real_escape_string($checkConnect, $_POST['password']);
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
?>
<link href="css/login-form.css" rel="stylesheet">

<div class="container">
    <div class="card card-container">
        <!-- <img class="profile-img-card" src="images/login_icon.png?sz=120" alt="" /> -->
        <img id="profile-img" class="profile-img-card" src="images/avatar_2x.png" />
        <p id="profile-name" class="profile-name-card"></p>
        <form class="form-signin" method="post" action="login.php">
            <span id="reauth-email" class="reauth-email"></span>
			<div class="icon-addon addon-lg">
				<input type="text" id="username" name="username" class="form-control" placeholder="Your Username" required autofocus>
					<label for="username" class="glyphicon glyphicon-user" rel="tooltip" title="username"></label>
				</input>
			</div>
			<div class="icon-addon addon-lg">
				<input type="password" id="password" name="password" class="form-control" placeholder="Your Password" required>
					<label for="password" class="glyphicon glyphicon-lock" rel="tooltip" title="password"></label>
				</input>
			</div>
            <div id="remember" class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="btn-login">Sign In</button>
        </form><!-- /form -->
		<center>
		<a href="register.php" class="new-account">
            Create Account!
        </a>or
        <a href="#" class="forgot-password">
            Reset Password?
        </a>
		</center>
    </div><!-- /card-container -->
</div><!-- /container -->

<script src="js/login-form.js"></script>