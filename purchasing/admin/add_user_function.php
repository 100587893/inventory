<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['role'] == 'admin') {
    include("../../connect.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }

  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $campus = $_POST["campus"];
  $role = $_POST["role"];

  $query = "INSERT INTO user (fullname, username, password, email, campus, role) VALUES ('$name', '$email', '$password', '$email', '$campus', '$role');";
  mysqli_query($conn, $query);

  header("Location: user_management.php");
?>
