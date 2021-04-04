<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSSION['role']='campus') {
    include("cm_topbar.php");
    include("../../connect.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }

  $username = $_SESSION['user_name'];

  if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
  }

  if (isset($_GET['edit'])) {
    $quantity = $_POST['quantity'];
    $query = "UPDATE cart SET quantity=$quantity WHERE username='$username' AND product_id='$pid';";
    mysqli_query($conn, $query);
  }
  elseif (isset($_GET['delete'])) {
    $query = "DELETE FROM cart WHERE product_id='$pid';";
    mysqli_query($conn, $query);
  }

  $query = "SELECT * FROM cart WHERE username='$username';";
  $result = mysqli_query($conn, $query);
?>


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Cart</title>

    <style>
  		body{
  			margin: 0 auto;
  			background-image: url(../img/bg2.jpg);
  		}
  		.box{
  			width: 100%;
  			height: 800px;
  			margin: auto;
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
  		button{
  			background-color: #4ef542;
  			height: 30px;
  			width: 75px;
  		}
  		.button2{
  			background-color: #ff7373;
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
    <h2 class="outside">Cart</h2>
    <br>

    <div class="container">
      <br>
      <table style="width: 100%;">
        <?php
          $opt = "";

          if (mysqli_num_rows($result) == 0) {
            echo "<h5>Your cart is empty</h5>";
          }
          else {
            echo "<tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Action</th>
                  </tr>";
            while ($row = mysqli_fetch_assoc($result)) {
              $pid = $row['product_id'];
              $query = "SELECT name FROM product WHERE product_id='$pid';";
              $res = mysqli_query($conn, $query);
              $row2 = mysqli_fetch_assoc($res);
              $name = $row2['name'];
              $quantity = $row['quantity'];

              $opt .= " <form action='cm_cart.php?pid=$pid' method='post'>
                          <tr>
                            <td>$pid</td>
                            <td>$name</td>
                            <td><input type='text' name='quantity' value='$quantity'></td>
                            <td><button type='submit' formaction='cm_cart.php?pid=$pid&edit=true' style='float: left; width: 49%;'>Update</button>
                                <button type='submit' formaction='cm_cart.php?pid=$pid&delete=true' style='float: right; width: 49%;'>Delete</button></td>
                          </tr>
                        </form>";
            }

            echo $opt;
            echo "</table>
                  <br>
                  <a href='cm_cart_submit_function.php'><button style='float: right; width: 20%;'>Submit Order</button></a>";
          }
        ?>
    </div>
  </body>
</html>
