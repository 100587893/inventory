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

  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($_GET['approve'])) {
      $query = "SELECT * FROM item_request WHERE id=$id;";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($result);

      $requester = $row['requester'];
      $category = $row['category'];
      $name = $row['name'];
      $manufacturer = $row['manufacturer'];
      $supplier = $row['supplier'];
      $min_stock = $row['min_stock'];
      $description = $row['description'];
      $serial = $row['serial_number'];

      $query = "INSERT INTO product (category, name, supplier, min_stock, manufacturer, description, product_id) VALUES ('$category', '$name', '$supplier', $min_stock, '$manufacturer', '$description', '$serial');";
      mysqli_query($conn, $query);

      $query = "DELETE FROM item_request WHERE id=$id;";
      mysqli_query($conn, $query);

      $query = "SELECT email, fullname FROM user WHERE fullname='$requester';";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($result);

      $name = $row['fullname'];
      $email = $row['email'];

      $mail->addAddress($email, $name);
      $mail->isHTML(true);
      $mail->Subject = "New Item Update";
      $mail->Body = "<i>Your new item request was approved<i>";
      $mail->AltBody = "Your new item request was approved";

      try {
        $mail->send();
      } catch (Exception $e) {
        echo "error";
      }
    }
    elseif (isset($_GET['deny'])) {
      $query = "SELECT * FROM item_request WHERE id=$id;";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($result);

      $requester = $row['requester'];

      $query = "DELETE FROM item_request WHERE id=$id;";
      mysqli_query($conn, $query);

      $query = "SELECT email, fullname FROM user WHERE fullname='$requester';";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($result);

      $name = $row['fullname'];
      $email = $row['email'];

      $mail->addAddress($email, $name);
      $mail->isHTML(true);
      $mail->Subject = "New Item Update";
      $mail->Body = "<i>Your new item request was denied<i>";
      $mail->AltBody = "Your new item request was denied";

      try {
        $mail->send();
      } catch (Exception $e) {
        echo "error";
      }
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
      table{
        border-collapse: collapse;
        width: 100%;
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
        font-size: 15px;
      }
      .outside{
  			font-size: 40px;
  			color: Black;
  			font-family: Tahoma, Geneva, sans-serif;
  			text-align:center;
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
    <h4 class="outside">New Item Requests for <?php echo $campus; ?></h4>
    <br>

    <div class="container">
      <table>
        <?php
          $query = "SELECT * FROM item_request WHERE campus='$campus';";
          $result = mysqli_query($conn, $query);
          $opt = "";

          if (!$result or mysqli_num_rows($result)==0) {
            echo "<h5>There are no active item requests at this time</h5>";
          }
          else {
            echo "<tr>
                    <th>Requester</th>
                    <th>Product Category</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Manufacturer</th>
                    <th>Supplier</th>
                    <th>Description</th>
                    <th>Action</th>
                  </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
              $id = $row['id'];
              $opt .= " <tr>
                          <td>" .$row['requester']. "</td>
                          <td>" .$row['category']. "</td>
                          <td>" .$row['product_id']. "</td>
                          <td>" .$row['name']. "</td>
                          <td>" .$row['manufacturer']. "</td>
                          <td>" .$row['supplier']. "</td>
                          <td>" .$row['description']. "</td>
                          <td>
                            <a href='pm_item_requests.php?campus=$campus&id=$id&approve=true' style='float: left; width: 50%;'><button type='button'>Approve</button></a>
                            <a href='pm_item_requests.php?campus=$campus&id=$id&deny=true' style='float: right;'><button type='button'>deny</button></a>
                          </td>
                        </tr>";
            }
            echo $opt;
          }
        ?>
      </table>
    </div>
  </body>
</html>
