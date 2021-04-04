<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSSION['role']='local') {
    include("../../connect.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }
 
  if (isset($_GET["kit"])) {
    $kit = $_GET["kit"];
    $quantity = $_POST['quantity'];
    $user = $_SESSION['user_fullname'];
    $campus = $_SESSION['access'];

    $query = "SELECT MAX(r_id) FROM requests;";
    $result2 = mysqli_query($conn, $query);
    $row2 = mysqli_fetch_assoc($result2);
    $num1 = $row2['MAX(r_id)'];

    $query = "SELECT MAX(r_id) FROM cart;";
    $result2 = mysqli_query($conn, $query);
    $row2 = mysqli_fetch_assoc($result2);
    $num2 = $row2['MAX(r_id)'];

    $rid = max($num1, $num2) + 1;

    $query = "SELECT * FROM product WHERE category='$kit';";
    $result = mysqli_query($conn, $query);
    
    while ($row = $result->fetch_assoc()) {
      $id = $row['product_id'];

      $sql = "SELECT quantity FROM kit WHERE kit='$kit' AND product_id='$id';";
      $result2 = $conn->query($sql);
      $row2 = $result2->fetch_assoc();
      $item = $row2['quantity'];
      $qnty = $item * $quantity;

      $query = "INSERT INTO cart (r_id, product_id, quantity, username, kit) VALUES ('$rid', '$id', $qnty, '$user', 'DH Kit');";
      mysqli_query($conn, $query);
    }
  }

  header("Location: lm_cart.php");
?>