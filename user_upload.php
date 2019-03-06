<?php

//script default settings
$userFilePath = "../users.csv";

//database default settings
$host = "localhost";
$username = "root";
$password = "root_password";
$dbName = "php-task";
$tableName = "users";

$con = mysqli_connect($host, $username, $password, $dbName);

/*
//test connection
if(!$con) {
	echo "Connection failed: ".mysqli_connect_error();
} else {
	echo "Connected";
}
*/

$file = fopen($userFilePath, "r");

if($file) {
	fgetcsv($file); //read the first line but do nothing with it

	while(!feof($file)) {
		$user = fgetcsv($file);
		if($user != array(null)) {
			//print_r($user);
			$insertQuery = "INSERT INTO $tableName (name, surname, email) VALUES ('{$user[0]}', '{$user[1]}', '{$user[2]}')";
			if(!mysqli_query($con, $insertQuery)) {
				echo "Error description: ".mysqli_error($con);
			}
		}
	}
	
	fclose($file);
}

mysqli_close($con);