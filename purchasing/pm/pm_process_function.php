<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['role'] == 'purchasing') {
    include("../../connect.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  }

  $query = "SELECT * FROM requests WHERE r_id=$id;";
  $result = mysqli_query($conn, $query);
  $item = mysqli_fetch_assoc($result);
  $campus_inv = $item['campus'] . "_inv";

  $query = "SELECT * FROM requests WHERE r_id=$id;";
  $result = mysqli_query($conn, $query);

  if (isset($_GET['accept'])) {
    $query = "UPDATE requests SET status='ordered' WHERE r_id=$id;";
    mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
      $pid = $row["p_id"];
      $inv = $row["quantity"];
      $query = "UPDATE warehouse_inv SET pm_quantity=(pm_quantity-$inv) WHERE product_id=$pid;";
      mysqli_query($conn, $query);

      $query = "SELECT product_id FROM $campus_inv WHERE product_id=$pid;";
      $result2 = mysqli_query($conn, $query);

      if (mysqli_num_rows($result2) == 0) {
        $query = "INSERT INTO $campus_inv (product_id, quantity) VALUES ($pid, $inv);";
        mysqli_query($conn, $query);
      }
      else {
        $query = "UPDATE $campus_inv SET quantity=(quantity+$inv) WHERE product_id=$pid;";
        mysqli_query($conn, $query);
      }
    }
  }
  elseif (isset($_GET['deny'])) {
    $query = "UPDATE requests SET status='denied' WHERE r_id=$id;";
    mysqli_query($conn, $query);
  }

  header("Location: warehouse_inv.php");
?>
