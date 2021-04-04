<?php
	session_start();
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['role'] == 'purchasing') {
		include("..\..\connect.php");
	} else {
		header("Location: C:/wamp64/www/index.php");
		exit();
    }
    
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $fax = $_POST['fax'];
    $contact = $_POST['contact'];

	if (isset($_GET["supplier"])) {
        $supplier = $_GET["supplier"];        
        
        $query = "UPDATE suppliers SET name='$name', address='$address', email='$email', phone_number='$number', fax_number='$fax', contact='$contact' WHERE name='$supplier';";
        mysqli_query($conn, $query);
    }
    else {
        $query = "INSERT INTO suppliers (name, address, email, phone_number, fax_number, contact) VALUES ('$name', '$address', '$email', '$number', '$fax', '$contact');";
        mysqli_query($conn, $query);
    }
    
    header("Location: supplier_management.php");
?>