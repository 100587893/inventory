<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSSION['role']='local') {
    include("lm_topbar.php");
    include("../../connect.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }

  $username = $_SESSION['user_name'];

  $kit = $_GET['kit'];
?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
      td {
        padding-top: 10px;
        padding-bottom: 10px;
        padding-right: 10px;
        padding-left: 10px;
        border-bottom: 2px solid black;
      }
    </style>
  </head>
  <body>
    <br>
    <div class="container">
      <?php
        echo "<h3 style='text-align: center;'>Enter the number of $kit you would like to order</h3>";
      ?>
      <br>
      <br>

      <?php
        echo "  <form action='lm_kit_order_function.php?kit=$kit' method='post'>
                    <label for='quantity'><b>Quantity:</b></label>
                    <input type='text' id='quantity' name='quantity' style='width: 100%;'>
                    <button type='submit' name='button' style='float: right; margin-top: 10px;' class='btn btn-primary'>Add</button>
                </form>";
      ?>
    </div>
  </body>
</html>
