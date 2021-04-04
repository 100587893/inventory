<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSSION['role']='local') {
    include("../../connect.php");
    include("../../mailer.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }

  $username = $_SESSION['user_name'];
  $campus = $_SESSION['access'];

  $query = "SELECT * FROM cart WHERE username='$username';";
  $result = mysqli_query($conn, $query);
  $item = mysqli_fetch_assoc($result);
  $rid2 = $item['r_id'];

  $query = "SELECT * FROM cart WHERE username='$username';";
  $result = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_assoc($result)) {
    $query = "SELECT campus FROM user WHERE username='$username';";
    $result2 = mysqli_query($conn, $query);
    $row2 = mysqli_fetch_assoc($result2);

    $rid = $row['r_id'];
    $campus2 = $row2['campus'];
    $pid = $row['product_id'];
    $quantity = $row['quantity'];

    $query = "SELECT supplier, price FROM product WHERE product_id='$pid';";
    $result3 = mysqli_query($conn, $query);
    $row3 = mysqli_fetch_assoc($result3);
    $supplier = $row3['supplier'];
    $price = $row3['price'];

    $query = "INSERT INTO requests (r_id, username, campus, product_id, supplier, quantity, unit_price) VALUES ($rid, '$username', '$campus2', '$pid', '$supplier', $quantity, $price);";
    mysqli_query($conn, $query);
  }

  $query = "DELETE FROM cart WHERE r_id=$rid2;";
  mysqli_query($conn, $query);

  $query = "SELECT email, fullname FROM user WHERE campus='$campus' AND role='campus';";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);

  $name = $row['fullname'];
  $email = $row['email'];

  $mail->addAddress($email, $name);
  $mail->isHTML(true);
  $mail->Subject = "New order created";
  $mail->Body = "<i>There is a new order awaiting approval<i>";
  $mail->AltBody = "There is a new order awaiting approval";

  try {
    $mail->send();
  } catch (Exception $e) {
    echo "error";
  }

  header("Location: lm_request_history.php");
?>
