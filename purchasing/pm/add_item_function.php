<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['role'] == 'purchasing') {
    include("../../connect.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }

  $formCategory = $_POST["category"];
  $formName = $_POST["productName"];
  $formSerial = $_POST["serial"];
  $formManufacturer = $_POST["manufacturer"];
  $formSupplier = $_POST["supplier"];
  $formDescription = $_POST["description"];
  $formStock = $_POST["minStock"];
  $formUnit = $_POST["unit"];

  if (isset($_POST["image"])) {
    $formImage = $_POST["image"];
  }

  if (isset($_GET["id"])) {
    $id = $_GET["id"];
  }

  if (isset($_GET["edit"])) {
    $query = "UPDATE product SET category='$formCategory', name='$formName', product_id='$formSerial', manufacturer='$formManufacturer', supplier='$formSupplier', description='$formDescription', min_stock=$formStock, unit='$formUnit' WHERE product_id='$id';";
    $result = mysqli_query($conn, $query);
  }
  else {
    $query = "INSERT INTO product (category, name, supplier, min_stock, manufacturer, description, product_id, unit) VALUES ('$formCategory', '$formName', '$formSupplier', $formStock, '$formManufacturer', '$formDescription', '$formSerial', '$formUnit');";
    $result = mysqli_query($conn, $query);
  }

  header("Location: product_management.php");
?>
