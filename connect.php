<?php
	$servername="fssys.cxe6ysgxahgj.us-east-2.rds.amazonaws.com";
	$username="admin";
	$password="MqnYpgXgnIBW2HKSFbk4";
	$dbname="invms";

	//Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	//Check connection
	if ($conn->connect_error) {
   		die("Connection failed: " . $conn->connect_error);
	}
?>
