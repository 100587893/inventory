<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['role'] == 'purchasing') {
    include("pm_topbar.php");
    include("..\..\connect.php");
    include("..\..\mailer.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }

  $campus = $_GET['campus'];

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
  }

  if (isset($_POST['approve'])) {
    $query = "UPDATE requests SET status='ordered' WHERE r_id=$id AND product_id='$pid';";
    mysqli_query($conn, $query);

    $mail->addAddress($email, $name);
    $mail->isHTML(true);
    $mail->Subject = "Purchasing - Order Update";
    $mail->Body = "<i>Your order has been ordered.<i>";
    $mail->AltBody = "Your order has been ordered.";

    try {
      $mail->send();
    } catch (Exception $e) {
      echo "error";
    }
  }
  elseif (isset($_POST['supply'])) {
    $query = "UPDATE requests SET status='couriered' WHERE r_id=$id AND product_id='$pid';";
    mysqli_query($conn, $query);

    $mail->addAddress($email, $name);
    $mail->isHTML(true);
    $mail->Subject = "Purchasing - Order Update";
    $mail->Body = "<i>Your order has been shipped.<i>";
    $mail->AltBody = "Your order has been shipped.";

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
    $query = "UPDATE requests SET status='denied' WHERE r_id=$id AND product_id='$pid';";
    mysqli_query($conn, $query);

    $mail->addAddress($email, $name);
    $mail->isHTML(true);
    $mail->Subject = "Purchasing - Order Update";
    $mail->Body = "<i>Your order has been denied.<i>";
    $mail->AltBody = "Your order has been denied.";

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
        $query = "SELECT supplier FROM requests WHERE status='approved' AND campus='$campus';";
        $result = mysqli_query($conn, $query);
        $suppliers = [];

        while ($row = mysqli_fetch_assoc($result)) {
          $supp = $row['supplier'];

          if (!in_array($supp, $suppliers)) {
            $suppliers[] = $supp;
          }
        }

        if (mysqli_num_rows($result) == 0) {
          echo "<h5>There are no active orders at this time</h5>";
        }
        else {
            for ($i=0; $i < sizeof($suppliers); $i++) {
              $supplier = $suppliers[$i];
              $opt = "";
              $total = 0;

              $query = "SELECT quantity, unit_price, supplier FROM requests WHERE status='approved' AND campus='$campus';";
              $result = mysqli_query($conn, $query);

              while ($row = mysqli_fetch_assoc($result)) {
                if ($row['supplier'] == $supplier) {
                  $price = $row['unit_price'];
                  $quantity = $row['quantity'];

                  $total += $price*$quantity;
                }
              }

              echo "<div class='containers' style='width: 100%;'>
                      <h5 style='float: left;'>Items supplied by: " .$suppliers[$i]. "</h5>
                      <form action='generate_po.php?campus=$campus&supplier=$supplier' method='post'>
                          <button type='submit' style='float: right;'>Generate PO</button>
                          <input type='date' name='required_by' id='required_by' style='float: right; margin-right: 10px;' required><p style='float: right; padding-right: 5px;'><b>Date Required: </b></p>
                      </form>
                      <h5 style='float: right; padding-right: 50px;'>Order Total: $$total </h5>
                    </div>";
              echo "<br><br>";
              echo "<div class='container' style='min-width: 110%;'>
                      <div class='row-'>
                        <div class='column- header'>
                          <b>Date Ordered</b>
                        </div>

                        <div class='column- header'>
                          <b>Requester</b>
                        </div>

                        <div class='column- header'>
                          <b>Product ID</b>
                        </div>

                        <div class='column- header'>
                          <b>Product Name</b>
                        </div>

                        <div class='column- header'>
                          <b>Quantity</b>
                        </div>

                        <div class='column- header'>
                          <b>Unit Cost</b>
                        </div>

                        <div class='column- header'>
                          <b>Total Cost</b>
                        </div>

                        <div class='column- header'>
                          <b>Status</b>
                        </div>

                        <div class='column- header'>
                          <b>Warehouse</b>
                        </div>
                      </div>";

              $query = "SELECT DATE(time), username, product_id, supplier, quantity, status, r_id, unit_price FROM requests WHERE status='approved' AND campus='$campus';";
              $result = mysqli_query($conn, $query);

              while ($row = mysqli_fetch_assoc($result)) {

                if ($row['supplier'] == $supplier) {
                  $rid = $row['r_id'];
                  $pid = $row['product_id'];
                  $quantity = $row['quantity'];
                  $price = $row['unit_price'];

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

                  $query2 = "SELECT name, price, unit FROM product WHERE product_id='$pid';";
                  $result2 = mysqli_query($conn, $query2);
                  $row2 = mysqli_fetch_assoc($result2);
                  $name = $row2['name'];

                  $opt .= "   <div class='content'>
                                <h5>" .$row2['name']. "</h5>
                              </div>

                              <div class='content'>
                                <form id='" .$rid.$pid. "actionForm' action='pm_active_requests.php?campus=$campus&rid=$rid&pid=$pid' method='post'>
                                  <input type='number' name='quantity' value='" .$row['quantity']. "' style='width: 50px;'><span style='margin-left:5px;'>" .$row2['unit']. "</span>
                                  <input type='hidden' name='action' value=''>
                                  <a href='javascript:{}' onclick='document.getElementById('" .$rid.$pid. "actionForm').action.value='update'; document.getElementById('" .$rid.$pid. "actionForm').submit();'><button type='submit' name='update' form='" .$rid.$pid. "actionForm'>Update</button></a>
                                </form>
                              </div>

                              <div class='content'>
                                <h5>$" .$row['unit_price']. "</h5>
                              </div>

                              <div class='content'>
                                <h5>$" .($price*$quantity). "</h5>
                              </div>

                              <div class='content'>
                                <h5>" .$row['status']. "</h5>
                              </div>

                              <div class='content'>
                                <a href='javascript:{}' onclick='document.getElementById('" .$rid.$pid. "actionForm').action.value='approve'; document.getElementById('" .$rid.$pid. "actionForm').submit();'><button type='submit' name='approve' form='" .$rid.$pid. "actionForm'>Order</button></a>
                                <a href='javascript:{}' onclick='document.getElementById('" .$rid.$pid. "actionForm').action.value='cancel'; document.getElementById('" .$rid.$pid. "actionForm').submit();'><button type='submit' name='cancel' form='" .$rid.$pid. "actionForm'>Deny</button></a>
                              </div>
                            </div>";
                }
              }
              echo $opt;
              echo "</div>";
              echo "<br><br>";
            }
          }
        ?>
    </div>
  </body>
</html>
