<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSSION['role']='local') {
    include("lm_topbar.php");
    include("../../connect.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }

  if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $query = "SELECT * FROM product WHERE product_id='$id';";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
  }
?>


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
      td {
        padding-top: 10px;
        padding-bottom: 10px;
        padding-right: 10px;
        padding-left: 10px;
        border-bottom: 2px solid black;
      }
    </style>
  </head>
  <body>
    <br>
    <div class="container">
      <?php
        if (isset($_GET['add'])) {
            echo "<h3 style='text-align: center;'>Enter the amount of " .$row['name']. " you would like to add</h3>";
        }
        else if (isset($_GET['sub'])) {
            echo "<h3 style='text-align: center;'>Enter the amount of " .$row['name']. " you would like to remove</h3>";
        }
      ?>
      <br>
      <img src="../../images/<?php echo $row['id']; ?>.jpg" style='display: block; margin-left: auto; margin-right: auto; width: 40%;'>
      <br>

      <?php
        if (isset($_GET['add'])) {
            echo "  <form action='lm_add_sub_function.php?id=$id&add=true' method='post'>
                        <label for='quantity'><b>Quantity:</b></label>
                        <input type='text' id='quantity' name='quantity' style='width: 90%;'><span style='margin-left:10px;'>" .$row['unit']. "</span>
                        <button type='submit' name='button' style='float: right; margin-top: 10px;'>Add</button>
                    </form>";
        }
        else if (isset($_GET['sub'])) {
            echo "  <form action='lm_add_sub_function.php?id=$id&sub=true' method='post'>
                        <label for='quantity'><b>Quantity:</b></label>
                        <input type='text' id='quantity' name='quantity' style='width: 90%;'><span style='margin-left:10px;'>" .$row['unit']. "</span>
                        <br><br>
                        <label for='assign'><b>Given to:</b></label>
                        <input type='text' id='assign' name='assign' style='width: 90%;'>
                        <button type='submit' name='button' style='float: right; margin-top: 10px;'>Remove</button>
                    </form>";
        }
      ?>
    </div>
  </body>
</html>
