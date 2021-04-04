<?php

	include "connect.php";

	//Pull selected items from previous page
	$uname=$_POST['user'];
	$pass=$_POST['pass'];

	//SQL Query to verify authorized access
	$sql = "SELECT * FROM user WHERE username='$uname' AND password='$pass'";
	$result = $conn->query($sql);
	$row = mysqli_num_rows($result);
	$row2 = $result->fetch_assoc();

	//Get user info
	$user_id=$row2["id"];
	$user_fullname=$row2["fullname"];
	$access=$row2['campus'];
	$role=$row2['role'];
	$email=$row2['email'];

	//Check if authorized and access level redirect
	if($row==1){

     session_start();
		 $_SESSION['loggedin'] = true;
		 $_SESSION['user_id'] = $user_id;
		 $_SESSION['user_name'] = $uname;
		 $_SESSION['user_fullname'] = $user_fullname;
		 $_SESSION['access'] = $access;
		 $_SESSION['role'] = $role;
		 $_SESSION['email'] = $email;

		 $pc = gethostname();

		//SQL Query to log login
		$sql = "INSERT INTO login_log(`username`, `pc_name`) VALUES ('$uname', '$pc')";
		$result = $conn->query($sql);

		//redirects based on permission
		if($access == 'admin'){
			header('Location: purchasing/admin/pm_home.php');
			exit();
		}
		elseif($access == 'purchasing'){
			header('Location: purchasing/pm/pm_home.php');
			exit();
		}
		elseif ($access == 'warehouse') {
			header('Location: purchasing/wm/wm_home.php');
			exit();
		}
		elseif($access == 'scarborough'){
			if ($role == 'local') {
				header('Location: purchasing/lm/lm_local_inv.php');
			}
			elseif ($role == 'campus') {
				header('Location: purchasing/cm/cm_local_inv.php');
			}
			exit();
		}
		elseif($access == 'Barrie'){
			if ($role == 'local') {
				header('Location: purchasing/lm/lm_local_inv.php');
			}
			elseif ($role == 'campus') {
				header('Location: purchasing/cm/cm_local_inv.php');
			}
			exit();
		}
		elseif($access == 'burlington'){
			if ($role == 'local') {
				header('Location: purchasing/lm/lm_local_inv.php');
			}
			elseif ($role == 'campus') {
				header('Location: purchasing/cm/cm_local_inv.php');
			}
			exit();
		}
	}
	else{
		header("Location: login_bad.php");
		exit();
	}

?>
