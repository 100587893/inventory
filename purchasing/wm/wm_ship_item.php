<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['role'] == 'warehouse') {
    include("wm_topbar.php");
    include("../../connect.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }

  if (isset($_GET["rid"])) {
    $rid = $_GET["rid"];
  }
  if (isset($_GET["pid"])) {
    $pid = $_GET["pid"];
  }


  if (isset($pid)) {
    $query = "SELECT * FROM product WHERE product_id='$pid';";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
  }
  if (isset($rid)) {
    $query = "SELECT * FROM requests WHERE r_id=$rid AND product_id='$pid';";
    $result = mysqli_query($conn, $query);
    $row2 = mysqli_fetch_assoc($result);
  }
?>


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Shipment Information</title>
    <style>
      td {
        padding-top: 10px;
        padding-bottom: 10px;
        padding-right: 10px;
        padding-left: 10px;
        border-bottom: 1px solid black;
      }
  		.outside{
  			font-size: 40px;
  			color: Black;
  			font-family: Tahoma, Geneva, sans-serif;
  			text-align:center;
  		}
    </style>
  </head>
  <body>
    <br>
    <h2 class="outside">Ship <?php echo $row['name']; ?></h2>
    <br>
    
    <div class="container">
      <h3>Please fill all fields before clicking submit</h3>
      <br>

      <form action="wm_ship_item_function.php?rid=<?php echo $rid; ?>&pid=<?php echo $pid; ?>" method="post">
        <table style="width: 100%;">
          <tr>
            <td><label for="quantity">Quantity:</label></td>
            <td><h5><?php echo $row2['quantity']; ?> <?php echo $row['unit']; ?></h5></td>
          </tr>
          <tr>
            <td><label for="delivered_by">Sent With:</label></td>
            <td><input type="text" id="delivered_by" name="delivered_by"></td>
          </tr>
        </table>
        <button type="submit" name="button" style="float: right; margin-top: 10px;">Submit</button>
      </form>
    </div>
  </body>
</html>
