<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSSION['role']='campus') {
    include("cm_topbar.php");
    include("..\..\connect.php");
    include("..\..\mailer.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }

  $campus = $_SESSION['access'];

  if (isset($_GET['rid'])) {
    $id = $_GET['rid'];
  }
  if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
  }

  if (isset($id)) {
    $query = "SELECT username FROM requests WHERE r_id=$id AND product_id='$pid';";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];

    $query = "SELECT fullname, email FROM user WHERE username='$username';";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $name = $row['fullname'];
    $email = $row['email'];

    $query = "SELECT email, fullname FROM user WHERE role='purchasing';";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $manager_name = $row['fullname'];
    $manager_email = $row['email'];
  }

  if (isset($_POST['approve'])) {
    $query = "UPDATE requests SET status='approved' WHERE r_id=$id AND product_id='$pid';";
    mysqli_query($conn, $query);

    $mail->addAddress($email, $name);
    $mail->isHTML(true);
    $mail->Subject = "Purchasing - Order Update";
    $mail->Body = "<i>Your order has been approved.<i>";
    $mail->AltBody = "Your order has been approved.";

    try {
      $mail->send();
    } catch (Exception $e) {
      echo $e;
    }

    $mail->addAddress($manager_email, $manager_name);
    $mail->isHTML(true);
    $mail->Subject = "Purchasing - New order created";
    $mail->Body = "<i>There is a new order awaiting approval<i>";
    $mail->AltBody = "There is a new order awaiting approval";

    try {
      $mail->send();
    } catch (Exception $e) {
      echo "error";
    }
  }
  elseif (isset($_POST['update'])) {
    $quantity = $_POST['quantity'];
    $query = "UPDATE requests SET quantity=$quantity WHERE r_id=$id AND product_id='$pid';";
    mysqli_query($conn, $query);
  }
  elseif (isset($_POST['cancel'])) {
    $query = "UPDATE requests SET status='cancelled' WHERE r_id=$id AND product_id='$pid';";
    mysqli_query($conn, $query);

    $mail->addAddress($email, $name);
    $mail->isHTML(true);
    $mail->Subject = "Purchasing - Order Update";
    $mail->Body = "<i>Your order has been cancelled.<i>";
    $mail->AltBody = "Your order has been cancelled.";

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
        $query = "SELECT DATE(time), username, product_id, quantity, status, r_id FROM requests WHERE status='pending' AND campus='$campus';";
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
            <b>Action</b>
          </div>
        </div>

        <?php
          $opt = "";

          while ($row = mysqli_fetch_assoc($result)) {
            $rid = $row['r_id'];
            $pid = $row['product_id'];

            $query = "SELECT name, product_id, unit FROM product WHERE product_id='$pid';";
            $result2 = mysqli_query($conn, $query);

            $row2 = mysqli_fetch_assoc($result2);
            $name = $row2['name'];
            $unit = $row2['unit'];

            $opt .= " <div class='row-'>
                        <div class='content'>
                          <h5>" .$row['DATE(time)']. "</h5>
                        </div>

                        <div class='content'>
                          <h5>" .$row['username']. "</h5>
                        </div>

                        <div class='content'>
                          <h5>$pid</h5>
                        </div>

                        <div class='content'>
                          <h5>$name</h5>
                        </div>

                        <div class='content'>
                          <form id='" .$rid.$pid. "actionForm' action='cm_active_requests.php?rid=$rid&pid=$pid' method='post'>
                            <input type='text' name='quantity' value='" .$row['quantity']. "'><span style='margin-left:10px;'>$unit</span>
                            <input type='hidden' name='action' value=''>
                          </form>
                        </div>

                        <div class='content'>
                          <h5>" .$row['status']. "</h5>
                        </div>

                        <div class='content'>
                          <a href='javascript:{}' onclick='document.getElementById('" .$rid.$pid. "actionForm').action.value='approve'; document.getElementById('" .$rid.$pid. "actionForm').submit();'><button type='submit' name='approve' form='" .$rid.$pid. "actionForm'>Approve</button></a>
                          <a href='javascript:{}' onclick='document.getElementById('" .$rid.$pid. "actionForm').action.value='update'; document.getElementById('" .$rid.$pid. "actionForm').submit();'><button type='submit' name='update' form='" .$rid.$pid. "actionForm'>Update</button></a>
                          <a href='javascript:{}' onclick='document.getElementById('" .$rid.$pid. "actionForm').action.value='cancel'; document.getElementById('" .$rid.$pid. "actionForm').submit();'><button type='submit' name='cancel' form='" .$rid.$pid. "actionForm'>Cancel</button></a>
                        </div>
                      </div>";
          }
          echo $opt;
        }
      ?>
    </div>
  </body>
</html>
