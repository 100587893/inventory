<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['role'] == 'warehouse') {
    include("..\..\connect.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }

  $formQuantity = $_POST["quantity"];
  $formDeliveredBy = $_POST["delivered_by"];
  $username = $_SESSION['user_fullname'];

  if (isset($_GET["id"])) {
    $id = $_GET["id"];
  }

  $query = "INSERT INTO warehouse_rcv (product_id, quantity, delivered_by, received_by) VALUES ('$id', $formQuantity, '$formDeliveredBy', '$username');";
  mysqli_query($conn, $query);

  $query = "UPDATE warehouse_inv SET quantity=(quantity+$formQuantity) WHERE product_id='$id';";
  mysqli_query($conn, $query);

  header("Location: wm_local_inv.php");
?>
