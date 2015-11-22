<?php 
	require_once 'dbconnect/host.php';
	include 'interface-login.php';
	session_start();
	if(isset($_SESSION['user']) != ""){
		header("Location: home.php");
	}
	if(empty($_SESSION['email'])){
		header("Location: register.php");
	}
	$getEmail = $_SESSION['email'];
	$getUsername = $_SESSION['register'];
	if(isset($_POST['btn-register']))
	{
		$studID = mysqli_real_escape_string($checkConnect, $_POST['studID']);
		$name = mysqli_real_escape_string($checkConnect, $_POST['name']);
		$icNo = mysqli_real_escape_string($checkConnect, $_POST['icNo']);
		$address1 = mysqli_real_escape_string($checkConnect, $_POST['address1']);
		$address2 = mysqli_real_escape_string($checkConnect, $_POST['address2']);
		$postCode = mysqli_real_escape_string($checkConnect, $_POST['postCode']);
		$city = mysqli_real_escape_string($checkConnect, $_POST['city']);
		$state = mysqli_real_escape_string($checkConnect, $_POST['state']);
		$phoneNo = mysqli_real_escape_string($checkConnect, $_POST['phoneNo']);
		$insert = "INSERT INTO student (studID, name, icNo, address1, address2, postcode, city, state, phoneNo, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$statement = mysqli_prepare($checkConnect, $insert);
		mysqli_stmt_bind_param($statement, "ssssssssss", $studID, $name, $icNo, $address1, $address2, $postCode, $city, $state, $phoneNo, $getEmail);
		mysqli_stmt_execute($statement);
		mysqli_stmt_close($statement);
		$getData = "SELECT id FROM student WHERE name='$name'";
		$result = mysqli_query($checkConnect, $getData) or die(mysql_error());
		$result2 = mysqli_fetch_assoc($result);
		$getID = $result2['id'];
		$insert1 = "UPDATE login SET student_id='$getID' WHERE username='$getUsername'";
		$result1 = mysqli_query($checkConnect, $insert1) or die(mysql_error());
		$count = mysqli_num_rows($result);
		$row = mysqli_fetch_array($result);
		mysqli_close($checkConnect);
		$_SESSION['email'] = "";
		?>
			<script>alert('Registration Successfully!');</script>
		<?php
		header("Location: login.php");		
	}
?>
<link href="css/login-form.css" rel="stylesheet">
<body>
<div class="container">
    <div class="card card1-container">
		<strong style="font-size: 18px">Student Details</strong></br>List of Student Details.</br>
			<form role="form" data-toggle="validator" onSubmit="return validation()" id="registration" class="form-signin" method="post" action="registerStudent.php">
				<span id="reauth-email" class="reauth-email"></span>
				<div class="icon-addon addon-lg">
					<input type="email" id="email" name="email" value="<?php echo $getEmail; ?>" class="form-control" placeholder="Email" readonly>
						<label for="email" class="glyphicon glyphicon-globe" rel="tooltip" title="email"></label>
					</input>
				</div>  
				<div class="icon-addon addon-lg">
					<input type="text" id="studID" name="studID" pattern="[0-9]+" title="Must be Numeric Only!" maxlength="10" class="form-control" placeholder="Student ID" required autofocus>
						<label for="studID" class="glyphicon glyphicon-tag" rel="tooltip" title="studID"></label>
					</input>
				</div>
				<div class="icon-addon addon-lg">
					<input type="text" id="name" name="name" pattern="[ a-zA-Z/]+" title="Must be Alphabet Only!" class="form-control" placeholder="Full Name" required>
						<label for="name" class="glyphicon glyphicon-user" rel="tooltip" title="name"></label>
					</input>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="icon-addon addon-lg">
							<input type="text" id="icNo" name="icNo" pattern="[0-9]+" title="Must be Numeric Only!" class="form-control" placeholder="I/C Number" minlength="12" maxlength="12" required>
								<label for="icNo" class="glyphicon glyphicon-barcode" rel="tooltip" title="icNo"></label>
							</input>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="icon-addon addon-lg">
							<input type="text" id="phoneNo" name="phoneNo" pattern="6[0-9]+" title="Eg: 60139888984" class="form-control" placeholder="Phone Number" minlength="11" maxlength="13" required>
								<label for="phoneNo" class="glyphicon glyphicon-earphone" rel="tooltip" title="phoneNo"></label>
							</input>
						</div>
					</div>
				</div>
				<div class="icon-addon addon-lg">
					<input type="text" id="address1" name="address1" pattern="[- a-zA-Z0-9/]+" class="form-control" placeholder="Address 1" required>
						<label for="address1" class="glyphicon glyphicon-home" rel="tooltip" title="address1"></label>
					</input>
				</div>
				<div class="icon-addon addon-lg">
					<input type="text" id="address2" name="address2" pattern="[- a-zA-Z0-9/]+" class="form-control" placeholder="Address 2" required>
						<label for="address2" class="glyphicon glyphicon-home" rel="tooltip" title="address2"></label>
					</input>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="icon-addon addon-lg">
							<input type="text" id="postCode" name="postCode" pattern="[0-9]+" title="Must be Numeric Only!" class="form-control" placeholder="Postcode" required>
								<label for="postCode" class="glyphicon glyphicon-tower" rel="tooltip" title="postCode"></label>
							</input>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="icon-addon addon-lg">
							<input type="text" id="city" name="city" pattern="[, 0-9a-zA-Z]+" class="form-control" placeholder="City" required>
								<label for="city" class="glyphicon glyphicon-road" rel="tooltip" title="city"></label>
							</input>
						</div>
					</div>
				</div>
				<div>
					<select class="form-control" name="state">
					  <option value="Johor">Johor</option>
					  <option value="Kedah">Kedah</option>
					  <option value="Kelantan">Kelantan</option>
					  <option value="Kuala Lumpur">Kuala Lumpur</option>
					  <option value="Labuan">Labuan</option>
					  <option value="Melaka">Melaka</option>
					  <option value="Negeri Sembilan">Negeri Sembilan</option>
					  <option value="Pahang">Pahang</option>
					  <option value="Pulau Pinang">Pulau Pinang</option>
					  <option value="Perak">Perak</option>
					  <option value="Perlis">Perlis</option>
					  <option value="Sabah">Sabah</option>
					  <option value="Sarawak">Sarawak</option>
					  <option value="Selangor">Selangor</option>
					  <option value="Terengganu">Terengganu</option>
					</select>
				</div>
				<div id="term" class="checkbox">
					<label>
						<input type="checkbox" value="term" required> Terms and Conditions.
					</label>
				</div>
				<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="btn-register">CONFIRM</button>
			</form><!-- /form -->
    </div><!-- /card-container -->
</div><!-- /container -->
</body>
<script src="js/login-form.js"></script>