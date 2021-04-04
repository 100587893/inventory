<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['role'] == 'purchasing') {
    include("pm_topbar.php");
    include("../../connect.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  }

  $query = "SELECT * FROM requests WHERE r_id=$id;";
  $result = mysqli_query($conn, $query);
  $info = mysqli_fetch_assoc($result);

  if (isset($_POST['action'])) {
    if ($_POST['action'] == 'add') {
      $pid = $_POST['productID'];
      $quantity = $_POST['quantity'];
      $username = $info['username'];
      $campus = $info['campus'];

      $query = "INSERT INTO requests (r_id, username, campus, p_id, quantity, status, comments) VALUES ($id, '$username', '$campus', $pid, $quantity, 'approved', '');";
      mysqli_query($conn, $query);
    }
    elseif ($_POST['action'] == 'edit') {
      $pid = $_POST['productID'];
      $quantity = $_POST['quantity'];

      $query = "UPDATE requests SET quantity=$quantity WHERE p_id=$pid;";
      mysqli_query($conn, $query);
    }
    elseif ($_POST['action'] == 'delete') {
      $pid = $_POST['productID'];

      $query = "DELETE FROM requests WHERE r_id=$id AND p_id=$pid;";
      mysqli_query($conn, $query);
    }
  }


  $query = "SELECT * FROM requests WHERE r_id=$id;";
  $result = mysqli_query($conn, $query);
?>


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
      th {
        border: 2px solid black;
      }
      td {
        border: 1px solid black;
      }
    </style>
  </head>
  <body>
    <br>
      <div class="container">

        <div class="row" style="width: 100%;">
          <div class="column-sm" style="width: 33%; padding-top: 10px; padding-bottom: 5px;">
            <h5 style="text-align: center;">Request ID: <?php echo $id; ?></h5>
          </div>

          <div class="column-sm" style="width: 33%; padding-top: 10px; padding-bottom: 5px;">
            <h5 style="text-align: center;">Campus: <?php echo $info['campus'] ?></h5>
          </div>

          <div class="column-sm" style="width: 33%; padding-top: 10px; padding-bottom: 5px;">
            <h5 style="text-align: center;">Requester: <?php echo $info['username'] ?></h5>
          </div>
        </div>
        <br>
        <br>

        <table style="width: 100%; border: 2px solid black;">
          <tr style="border: 1px solid black;">
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Quantity</th>
          </tr>

          <?php
            $opt = "";
            while ($row = mysqli_fetch_assoc($result)) {
              $query2 = "SELECT name FROM product WHERE id=" .$row['p_id']. ";";
              $result2 = mysqli_query($conn, $query2);
              $item = mysqli_fetch_assoc($result2);

              $opt .= "<tr>
                        <td>" .$row['p_id']. "</td>
                        <td>" .$item['name']. "</td>
                        <td>" .$row['quantity']. "</td>
                      </tr>";
            }
            echo $opt;
          ?>
        </table>
        <br>
        <br>
        <form id="process_form" action="pm_process_request.php?id=<?php echo $id; ?>" method="post">

          <div class="row" style="width: 100%;">
            <div class="column-sm" style="width: 50%;">
              <label for="productID">Product ID:</label>
              <input type="text" name="productID" style="width: 60%;">
            </div>
            <div class="column-sm" style="width: 50%;">
              <label for="quantity">Quantity:</label>
              <input type="text" name="quantity" style="width: 60%;">
            </div>
          </div>

          <br>

          <input type="hidden" name="action" value="">
          <div class="row" style="width: 100%;">
            <a href="javascript:{}" onclick="document.getElementById('process_form').action.value = 'add'; document.getElementById('process_form').submit();" style="width: 33%;">
              <div class="column-sm" style="background-color: rgb(0, 204, 0); padding-top: 10px; padding-bottom: 5px;">
                <h5 style="color: white; text-align: center;">Add</h5>
              </div>
            </a>
            <a href="javascript:{}" onclick="document.getElementById('process_form').action.value = 'edit'; document.getElementById('process_form').submit();" style="width: 33%;">
              <div class="column-sm" style="background-color: rgb(0, 163, 204); padding-top: 10px; padding-bottom: 5px;">
                <h5 style="color: white; text-align: center;">Update</h5>
              </div>
            </a>
            <a href="javascript:{}" onclick="document.getElementById('process_form').action.value = 'delete'; document.getElementById('process_form').submit();" style="width: 33%;">
              <div class="column-sm" style="background-color: rgb(204, 0, 0); padding-top: 10px; padding-bottom: 5px;">
                <h5 style="color: white; text-align: center;">Delete</h5>
              </div>
            </a>
          </div>

          <br>

          <div class="row" style="width: 100%;">
            <a href="javascript:{}" onclick="window.location.href = 'pm_process_function.php?id=<?php echo $id; ?>&accept=true';" style="width: 50%;">
              <div class="column-sm" style="background-color: rgb(0, 204, 0); padding-top: 10px; padding-bottom: 5px;">
                <h5 style="color: white; text-align: center;">Approve</h5>
              </div>
            </a>
            <a href="javascript:{}" onclick="window.location.href = 'pm_process_function.php?id=<?php echo $id; ?>&deny=true';" style="width: 50%;">
              <div class="column-sm" style="background-color: rgb(204, 0, 0); padding-top: 10px; padding-bottom: 5px;">
                <h5 style="color: white; text-align: center;">Deny</h5>
              </div>
            </a>
          </div>

        </form>

      </div>
  </body>
</html>
