<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSSION['role']='local') {
    include("../../connect.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }

  if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $quantity = $_POST['quantity']
    $user = $_SESSION['user_fullname'];
    $campus = $_SESSION['access'];
    $inv = $campus . "_inv";

    $query = "SELECT * FROM product WHERE product_id='$id';";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if (isset($_GET['add'])) {
        $query = "UPDATE $inv SET quantity=(quantity-$quantity) WHERE product_id='$id';";
        mysqli_query($conn, $query);

        $query = "INSERT INTO add_history (campus, adder, product_id, quantity) VALUES ('$campus', '$user', '$id', $quantity);";
        mysqli_query($conn, $query);
    }
  }
?>