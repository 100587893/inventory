<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSSION['role']='admin') {
    include("pm_topbar.php");
    include("../../connect.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }

  $campus = $_GET['campus'];
?>


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Item Remove History</title>

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
    <h2 class="outside">Item Remove History For <?php echo $campus; ?></h2>
    <br>
    <div class="container">

      <table style="width: 100%;">
        <?php
          $query = "SELECT remover, given_to, product_id, quantity, DATE(time) FROM sub_history WHERE campus='$campus' ORDER BY time DESC;";
          $result = mysqli_query($conn, $query);

          if (mysqli_num_rows($result) == 0) {
            echo "<h5>No active orders right now</h5>";
          }
          else {
            echo "  <tr>
                      <th>Remover</th>
                      <th>Given To</th>
                      <th>Product ID</th>
                      <th>Product Name</th>
                      <th>Quantity</th>
                      <th>Date Added</th>
                    </tr>";

            $opt = "";

            while ($row = mysqli_fetch_assoc($result)) {
              $pid = $row['product_id'];

              $query = "SELECT name, unit FROM product WHERE product_id='$pid';";
              $result2 = mysqli_query($conn, $query);
              $row2 = mysqli_fetch_assoc($result2);

              $opt .= " <tr>
                          <td>" .$row['remover']. "</td>
                          <td>" .$row['given_to']. "</td>
                          <td>$pid</td>
                          <td>" .$row2['name']. "</td>
                          <td>" .$row['quantity']. " " .$row2['unit']. "</td>
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
