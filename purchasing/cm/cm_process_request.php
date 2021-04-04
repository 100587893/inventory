<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSSION['role']='campus') {
    include("cm_topbar.php");
    include("..\..\connect.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }

  if (isset($_GET['rid'])) {
    $rid = $_GET['rid'];
  }
  if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
  }
  if (isset($_POST['quantity'])) {
    $quantity = $_POST['quantity'];
  }

  $query = "SELECT * FROM requests WHERE r_id=$rid AND p_id=$pid;";
  $result = mysqli_query($conn, $query);
  $request_info = mysqli_fetch_assoc($result);

  $query = "SELECT * FROM product WHERE id=$pid;";
  $result = mysqli_query($conn, $query);
  $product_info = mysqli_fetch_assoc($result);

  if (isset($_POST['update'])) {
    $query = "UPDATE requests SET quantity=$quantity WHERE p_id=$pid AND r_id=$rid;";
    mysqli_query($conn, $query);
  }
?>


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Process Request</title>
    <style media="screen">
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
        font-size: 20px;
      }
      img {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 30%;
      }
    </style>
  </head>
  <body>
    <br>
      <div class="container">

        <div class="row" style="width: 100%;">
          <div class="column-sm" style="width: 33%; padding-top: 10px; padding-bottom: 5px;">
            <h5 style="text-align: center;">Date Requested: <?php echo $request_info['time']; ?></h5>
          </div>

          <div class="column-sm" style="width: 33%; padding-top: 10px; padding-bottom: 5px;">
            <h5 style="text-align: center;">Campus: <?php echo $request_info['campus'] ?></h5>
          </div>

          <div class="column-sm" style="width: 33%; padding-top: 10px; padding-bottom: 5px;">
            <h5 style="text-align: center;">Requester: <?php echo $request_info['username'] ?></h5>
          </div>
        </div>
        <br>
        <br>

        <h4 style="text-align: center;">Product Name: <?php echo $product_info['name']; ?></h4>
        <img src="../../images/<?php echo $pid ?>.jpg">
        <br>

        <form id="process_form" action="cm_process_request.php?id=<?php echo $rid; ?>" method="post">

          <div class="row" style="width: 100%;">
            <div class="column-sm" style="width: 100%;">
              <label for="quantity"><b>Quantity:</b></label>
              <input type="text" name="quantity" style="width: 100%;" value="<?php echo $request_info['quantity']; ?>">
            </div>
          </div>

          <br>

          <input type="hidden" name="action" value="">
          <div class="row" style="width: 100%;">
            <a href="javascript:{}" onclick="document.getElementById('process_form').action.value = 'edit'; document.getElementById('process_form').submit();" style="width: 33%;">
              <div class="column-sm" style="background-color: rgb(0, 163, 204); padding-top: 10px; padding-bottom: 5px;">
                <h5 style="color: white; text-align: center;">Update</h5>
              </div>
            </a>
          </div>

          <br>

          <div class="row" style="width: 100%;">
            <a href="javascript:{}" onclick="window.location.href = 'cm_process_function.php?id=<?php echo $rid; ?>&accept=true';" style="width: 50%;">
              <div class="column-sm" style="background-color: rgb(0, 204, 0); padding-top: 10px; padding-bottom: 5px;">
                <h5 style="color: white; text-align: center;">Approve</h5>
              </div>
            </a>
            <a href="javascript:{}" onclick="window.location.href = 'cm_process_function.php?id=<?php echo $rid; ?>&deny=true';" style="width: 50%;">
              <div class="column-sm" style="background-color: rgb(204, 0, 0); padding-top: 10px; padding-bottom: 5px;">
                <h5 style="color: white; text-align: center;">Cancel Order</h5>
              </div>
            </a>
          </div>

        </form>

      </div>
  </body>
</html>
