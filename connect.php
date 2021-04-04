<?php
	$servername="localhost";
	$username="root";
	$password="Madinat$902";
	$dbname="invms";

	//Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	//Check connection
	if ($conn->connect_error) {
   		die("Connection failed: " . $conn->connect_error);
	}
?>
