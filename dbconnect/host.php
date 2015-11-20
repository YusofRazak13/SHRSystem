<?php 
	define('ONLINE', 'yusofrazak.com'); //Standard Connection
	define('OFFLINE', 'localhost'); //Offline Connection

	//Database Details
	define('DB_HOST', OFFLINE);
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'shrsystem');
	
	//Connect to the database
	$checkConnect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Error " . mysqli_error($checkConnect));
	
	//Checking Method
	if(!$checkConnect){
		echo "<p>Unable to connect to the database!</p>";
	}
?>