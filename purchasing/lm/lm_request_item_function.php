<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['role'] == 'local') {
    include("..\..\connect.php");
    include("..\..\mailer.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }

  $requester = $_SESSION['user_fullname'];
  $campus = $_SESSION['access'];

  $formCategory = $_POST["category"];
  $formName = $_POST["productName"];
  $formSerial = $_POST["serial"];
  $formManufacturer = $_POST["manufacturer"];
  $formSupplier = $_POST["supplier"];
  $formDescription = $_POST["description"];
  $formStock = $_POST["minStock"];

  $query = "INSERT INTO item_request (requester, campus, category, name, product_id, manufacturer, supplier, description, min_stock) VALUES ('$requester', '$campus', '$formCategory', '$formName', '$formSerial', '$formManufacturer', '$formSupplier', '$formDescription', $formStock);";
  mysqli_query($conn, $query);

  $query = "SELECT email, fullname FROM user WHERE role='purchasing';";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);

  $name = $row['fullname'];
  $email = $row['email'];

  $mail->addAddress($email, $name);
  $mail->isHTML(true);
  $mail->Subject = "New item request created";
  $mail->Body = "<i>There is a new item request awaiting approval<i>";
  $mail->AltBody = "There is a new item request awaiting approval";

  try {
    $mail->send();
  } catch (Exception $e) {
    echo "error";
  }

  header("Location: lm_local_inv.php");
?>
