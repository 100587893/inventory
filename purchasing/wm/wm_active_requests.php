<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['role'] == 'warehouse') {
    include("wm_topbar.php");
    include("../../connect.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }

  if (isset($_GET['rid'])) {
    $id = $_GET['rid'];
  }
  if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
  }
  if (isset($_GET['quantity'])) {
    $quantity = $_GET['quantity'];
  }

  $campus = $_GET['campus'];
?>


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Active Orders</title>

    <style>
      body{
        margin: 0 auto;
        background-image: url(../img/bg2.jpg);
      }
      .container {
        display: table;
      }
      .outside{
  			font-size: 40px;
  			color: Black;
  			font-family: Tahoma, Geneva, sans-serif;
  			text-align:center;
  		}
      .row- {
        display: table-row;
      }
      .header {
        display: table-cell;
        height: 50px;
        background: #006;
        color: #FFF;
        font-size: 20px;
        font-family: Tahoma, Geneva, sans-serif;
        border: 1px solid black;
        text-align:center;
        vertical-align: middle;
      }
      .content {
        display: table-cell;
        height: 30px;
        border: 1px solid black;
        text-align:center;
        vertical-align: middle;
      }
    </style>
  </head>

  <body>
    <br>
    <h4 class="outside">Active Orders for <?php echo $campus; ?></h4>
    <br>

    <div class="container">

      <?php
        $query = "SELECT DATE(time), username, product_id, quantity, status, r_id FROM requests WHERE status='ordered' AND campus='$campus';";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 0) {
          echo "<h5>There are no active orders at this time</h5>";
        }
        else {

        ?>

        <div class="row-">
          <div class="column- header">
            <b>Date Ordered</b>
          </div>

          <div class="column- header">
            <b>Requester</b>
          </div>

          <div class="column- header">
            <b>Product ID</b>
          </div>

          <div class="column- header">
            <b>Product Name</b>
          </div>

          <div class="column- header">
            <b>Quantity</b>
          </div>

          <div class="column- header">
            <b>Status</b>
          </div>

          <div class="column- header">
            <b>Ship</b>
          </div>
        </div>

        <?php
          $opt = "";

          while ($row = mysqli_fetch_assoc($result)) {
            $rid = $row['r_id'];
            $pid = $row['product_id'];
            $quantity = $row['quantity'];

            $opt .= " <div class='row-'>
                        <div class='content'>
                          <h5>" .$row['DATE(time)']. "</h5>
                        </div>

                        <div class='content'>
                          <h5>" .$row['username']. "</h5>
                        </div>
                        
                        <div class='content'>
                          <h5>$pid</h5>
                        </div>";

            $query2 = "SELECT name, unit FROM product WHERE product_id='$pid';";
            $result2 = mysqli_query($conn, $query2);
            $row2 = mysqli_fetch_assoc($result2);
            $name = $row2['name'];

            $opt .= "   <div class='content'>
                          <h5>$name</h5>
                        </div>

                        <div class='content'>
                          <h5>" .$row['quantity']. " " .$row2['unit']. "</h5>
                        </div>

                        <div class='content'>
                          <h5>" .$row['status']. "</h5>
                        </div>

                        <div class='content'>
                          <a href='wm_ship_item.php?rid=$rid&pid=$pid'><button type='button'>Ship</button></a>
                        </div>
                      </div>";
          }
          echo $opt;
        }
      ?>
    </div>
  </body>
</html>
