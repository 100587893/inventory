<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSSION['role']='local') {
    include("lm_topbar.php");
    include("../../connect.php");
    include("../../mailer.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }

  $campus = $_SESSION['access'];
  $local_inv = $campus ."_inv";

  if (isset($_GET['rid'])) {
    $rid = $_GET['rid'];
  }
  if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
  }
  if (isset($_GET['quantity'])) {
    $quantity = $_GET['quantity'];
  }

  if (isset($_GET['recieve'])) {
    $query = "UPDATE requests SET status='recieved' WHERE (status='shipped' OR status='ordered') AND campus='$campus' AND r_id=$rid AND product_id='$pid';";
    mysqli_query($conn, $query);

    $query = "SELECT * FROM $local_inv WHERE product_id='$pid';";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) != 0) {
      $query = "UPDATE $local_inv SET quantity=(quantity+$quantity) WHERE product_id='$pid';";
      mysqli_query($conn, $query);
    }
    else {
      $query = "INSERT INTO $local_inv (product_id, quantity) VALUES ('$pid', $quantity);";
      mysqli_query($conn, $query);
    }

    $query = "SELECT email, fullname FROM user WHERE role='purchasing';";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $name = $row['fullname'];
    $email = $row['email'];

    $mail->addAddress($email, $name);
    $mail->isHTML(true);
    $mail->Subject = "Purchasing - Order Update";
    $mail->Body = "<i>Order # $rid-$pid was recieved.<i>";
    $mail->AltBody = "Order # $rid-$pid was recieved.";

    try {
      $mail->send();
    } catch (Exception $e) {
      echo "error";
    }
  }
?>


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Order History</title>

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
    <h2 class="outside">Order History</h2>
    <br>
    <div class="container">
      <br>
      <h4>Active Orders</h4>
      <br>

      <table style="width: 100%;">
        <?php
          $query = "SELECT username, r_id, product_id, quantity, status, DATE(time), DATE(update_time) FROM requests WHERE (status='pending' OR status='approved' OR status='ordered' OR status='couriered' OR status='shipped') AND campus='$campus' ORDER BY time DESC;";
          $result = mysqli_query($conn, $query);

          if (mysqli_num_rows($result) == 0) {
            echo "<h5>No active orders right now</h5>";
          }
          else {
            echo "  <tr>
                      <th>Date Ordered</th>
                      <th>Requester</th>
                      <th>Product ID</th>
                      <th>Product Name</th>
                      <th>Quantity</th>
                      <th>Status</th>
                      <th>Date Updated</th>
                      <th>Recieve</th>
                    </tr>";

            $opt = "";

            while ($row = mysqli_fetch_assoc($result)) {
              $rid = $row['r_id'];
              $pid = $row['product_id'];
              $quantity = $row['quantity'];

              $query = "SELECT name, unit FROM product WHERE product_id='$pid';";
              $result2 = mysqli_query($conn, $query);

              if ($result) {
                $row2 = mysqli_fetch_assoc($result2);
              }

              $opt .= " <tr>
                          <td>" .$row['DATE(time)']. "</td>
                          <td>" .$row['username']. "</td>
                          <td>$pid</td>
                          <td>" .$row2['name']. "</td>
                          <td>" .$row['quantity']. " " .$row2['unit']. "</td>
                          <td>" .$row['status']. "</td>
                          <td>" .$row['DATE(update_time)']. "</td>";

              if ($row['status'] == 'shipped' or $row['status'] == 'ordered') {
                $opt .= "<td><a href='lm_request_history.php?recieve=true&rid=$rid&pid=$pid&quantity=$quantity'><button>Recieve</button></a></td>";
              }

              $opt .= "</tr>";
            }
            echo $opt;
          }
        ?>
      </table>


      <br>
      <br>
      <h4>Fulfilled Orders</h4>
      <br>

      <table style="width: 100%; border: 1px solid black;">
        <?php
          $query = "SELECT username, product_id, quantity, status, DATE(time), DATE(update_time) FROM requests WHERE status='recieved' AND campus='$campus' ORDER BY time DESC;";
          $result = mysqli_query($conn, $query);

          if (mysqli_num_rows($result) == 0) {
            echo "<h5>No previous orders have been made</h5>";
          }
          else {
            echo "  <tr>
                      <th>Date Ordered</th>
                      <th>Requester</th>
                      <th>Product ID</th>
                      <th>Product Name</th>
                      <th>Quantity</th>
                      <th>Status</th>
                      <th>Date Updated</th>
                    </tr>";

            $opt = "";

            while ($row = mysqli_fetch_assoc($result)) {
              $pid = $row['product_id'];

              $query = "SELECT name, unit FROM product WHERE product_id='$pid';";
              $result2 = mysqli_query($conn, $query);

              if ($result) {
                $row2 = mysqli_fetch_assoc($result2);
              }

              $opt .= " <tr>
                          <td>" .$row['DATE(time)']. "</td>
                          <td>" .$row['username']. "</td>
                          <td>$pid</td>
                          <td>" .$row2['name']. "</td>
                          <td>" .$row['quantity']. " " .$row2['unit']. "</td>
                          <td>" .$row['status']. "</td>
                          <td>" .$row['DATE(update_time)']. "</td>
                        </tr>";
            }
            echo $opt;
          }
        ?>
      </table>

      <br>
      <br>
      <h4>Cancelled/Denied Orders</h4>
      <br>

      <table style="width: 100%; border: 1px solid black;">
        <?php
          $query = "SELECT username, product_id, quantity, status, DATE(time), DATE(update_time) FROM requests WHERE (status='cancelled' OR status='denied') AND campus='$campus' ORDER BY time DESC;";
          $result = mysqli_query($conn, $query);

          if (mysqli_num_rows($result) == 0) {
            echo "<h5>No previous orders have been made</h5>";
          }
          else {
            echo "  <tr>
                      <th>Date Ordered</th>
                      <th>Requester</th>
                      <th>Product ID</th>
                      <th>Product Name</th>
                      <th>Quantity</th>
                      <th>Status</th>
                      <th>Date Updated</th>
                    </tr>";

            $opt = "";

            while ($row = mysqli_fetch_assoc($result)) {
              $pid = $row['product_id'];

              $query = "SELECT name, unit FROM product WHERE product_id='$pid';";
              $result2 = mysqli_query($conn, $query);

              if ($result) {
                $row2 = mysqli_fetch_assoc($result2);
              }

              $opt .= " <tr>
                          <td>" .$row['DATE(time)']. "</td>
                          <td>" .$row['username']. "</td>
                          <td>$pid</td>
                          <td>" .$row2['name']. "</td>
                          <td>" .$row['quantity']. " " .$row2['unit']. "</td>
                          <td>" .$row['status']. "</td>
                          <td>" .$row['DATE(update_time)']. "</td>
                        </tr>";
            }
            echo $opt;
          }
        ?>
      </table>
      <br><br>
    </div>
  </body>
</html>
