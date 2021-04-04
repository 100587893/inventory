<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    include("../../connect.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }

  $requester = $_SESSION['user_fullname'];
  
	$_SESSION['loggedin'] = false;
	$_SESSION['user_id'] = "";
	$_SESSION['user_name'] = "";
	$_SESSION['user_fullname'] = "";
	$_SESSION['access'] = "";
	$_SESSION['role'] = "";
	$_SESSION['email'] = "";
		 
  header("Location: index.php");
?>
