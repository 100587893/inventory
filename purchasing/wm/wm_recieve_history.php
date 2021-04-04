<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSSION['role']='warehouse') {
    include("wm_topbar.php");
    include("../../connect.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }
?>


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Recieve History</title>

    <style>
  		body{
  			margin: 0 auto;
  			background-image: url(../img/bg2.jpg);
  		}
  		table{
  			border-collapse: collapse;
  			width: 70%;
  			font-size:18px;
  			margin: 0 auto;

  		}
  		table, th, td {
  			border: 1px solid black;
  			text-align:center;

  		}
  		th{
  			height: 50px;
  			background: #006;
  			color: #FFF;
  			font-size: 20px;
  			font-family: Tahoma, Geneva, sans-serif;
  		}
  		td{
  			height: 30px;
  			background: #FFF;
  			color: black;
  			font-size: 20px;
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
    <h2 class="outside">Warehouse Recieve History</h2>
    <br>
    <div class="container">

      <table style="width: 100%;">
        <?php
          $query = "SELECT product_id, quantity, delivered_by, received_by, DATE(time) FROM warehouse_rcv;";
          $result = mysqli_query($conn, $query);

          if (mysqli_num_rows($result) == 0) {
            echo "<h5>No previous orders have been received</h5>";
          }
          else {
            echo "  <tr>
                      <th>Product ID</th>
                      <th>Product Name</th>
                      <th>Quantity</th>
                      <th>Delivered By</th>
                      <th>Received By</th>
                      <th>Date Received</th>
                    </tr>";

            $opt = "";

            while ($row = mysqli_fetch_assoc($result)) {
              $pid = $row['product_id'];
              $query2 = "SELECT name, unit FROM product WHERE product_id='$pid';";
              $result2 = mysqli_query($conn, $query2);
              $row2 = mysqli_fetch_assoc($result2);
              $name = $row2['name'];

              $opt .= " <tr>
                          <td>$pid</td>
                          <td>$name</td>
                          <td>" .$row['quantity']. " " .$row2['unit']. "</td>
                          <td>" .$row['delivered_by']. "</td>
                          <td>" .$row['received_by']. "</td>
                          <td>" .$row['DATE(time)']. "</td>
                        </tr>";
            }
            echo $opt;
          }
        ?>
      </table>
    </div>
    <br><br>
  </body>
</html>
