<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['role'] == 'warehouse') {
    include("..\..\connect.php");
    include("..\..\mailer.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }

  $formDeliveredBy = $_POST["delivered_by"];
  $username = $_SESSION['user_fullname'];

  if (isset($_GET["rid"])) {
    $rid = $_GET["rid"];
  }
  if (isset($_GET["pid"])) {
    $pid = $_GET["pid"];
  }

  $query = "SELECT campus, quantity FROM requests WHERE r_id=$rid AND product_id='$pid';";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  $campus = $row['campus'];
  $quantity = $row['quantity'];

  $query = "INSERT INTO warehouse_send (product_id, quantity, shipped_by, shipped_to, sent_with) VALUES ('$pid', $quantity, '$username', '$campus', '$formDeliveredBy');";
  mysqli_query($conn, $query);

  $query = "UPDATE warehouse_inv SET quantity=(quantity-$formQuantity) WHERE product_id='$pid';";
  mysqli_query($conn, $query);

  $query = "UPDATE requests SET status='shipped' WHERE r_id=$rid AND product_id='$pid';";
  mysqli_query($conn, $query);

  $query = "SELECT username FROM requests WHERE r_id=$rid AND product_id='$pid';";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  $username = $row['username'];

  $query = "SELECT fullname, email FROM user WHERE username='$username';";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);

  $name = $row['fullname'];
  $email = $row['email'];

  $mail->addAddress($email, $name);
  $mail->isHTML(true);
  $mail->Subject = "Purchasing - Order Update";
  $mail->Body = "<i>Your order has been shipped.<i>";
  $mail->AltBody = "Your order has been shipped.";

  try {
    $mail->send();
  } catch (Exception $e) {
    echo "error";
  }

  header("Location: wm_active_requests.php?campus=$campus");
?>
