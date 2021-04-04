<?php
  $connect = mysqli_connect("localhost:3306", "root", "Madinat$902", "INVMS");

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  }

  $query = "SELECT * FROM requests WHERE r_id=$id;";
  $result = mysqli_query($connect, $query);


  if (isset($_GET['accept'])) {
    $query = "UPDATE requests SET status='approved' WHERE r_id=$id;";
    mysqli_query($connect, $query);
  }

  elseif (isset($_GET['deny'])) {
    $query = "UPDATE requests SET status='cancelled' WHERE r_id=$id;";
    mysqli_query($connect, $query);
  }

  header("Location: cm_request_history.php");
?>
