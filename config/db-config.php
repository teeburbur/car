<?php
	//if session is not started
	if(!session_start()){
		//start the session
		session_start();
	}
	//output buffer, to fix the header is already sent error
	ob_start();

	$host="localhost";  //Enter Host Name
	$db="car_project_db";  	//Enter Database Name
	$username="root";	//Enter Database User Name
	$password="";		//Enter Database Password

	//try block
	try {
		//we are using PDO of PHP. PHP Data Ojects, PHP PDO is a database access layer that provides a uniform interface for working with multiple databases
		$conn = new PDO("mysql:host={$host};dbname={$db}", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	//catch block
	catch( PDOException $e ) {
		echo "Connection error :" . $e->getMessage();
	}
?>