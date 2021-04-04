<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSSION['role']='local') {
    include("../../connect.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }

  $username = $_SESSION['user_name'];

  $num1 = 0;
  $num2 = 0;

  if (isset($_GET["id"])) {
    $id = $_GET["id"];
  }

  $query = "SELECT DISTINCT username FROM cart;";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) != 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      if ($row['username'] != $username) {
        $query = "SELECT MAX(r_id) as rid FROM requests;";
        $result2 = mysqli_query($conn, $query);
        $row2 = mysqli_fetch_assoc($result2);
        $num1 = $row2['rid'];

        $query = "SELECT MAX(r_id) as rid FROM cart;";
        $result2 = mysqli_query($conn, $query);
        $row2 = mysqli_fetch_assoc($result2);
        $num2 = $row2['rid'];

        $rid = max($num1, $num2) + 1;
      }
      elseif ($row['username'] == $username) {
        $query = "SELECT r_id FROM cart WHERE username='$username';";
        $result2 = mysqli_query($conn, $query);
        $row2 = mysqli_fetch_assoc($result2);
        $rid = $row2['r_id'];
        break;
      }
    }
  }
  else {
    $query = "SELECT MAX(r_id) FROM requests;";
    $result2 = mysqli_query($conn, $query);
    $row2 = mysqli_fetch_assoc($result2);
    $num1 = $row2['MAX(r_id)'];

    $query = "SELECT MAX(r_id) FROM cart;";
    $result2 = mysqli_query($conn, $query);
    $row2 = mysqli_fetch_assoc($result2);
    $num2 = $row2['MAX(r_id)'];

    $rid = max($num1, $num2) + 1;
  }


  $quantity = $_POST['quantity'];

  $query = "INSERT INTO cart (r_id, product_id, quantity, username) VALUES ($rid, '$id', $quantity, '$username');";
  mysqli_query($conn, $query);

  header("Location: lm_cart.php");
?>
