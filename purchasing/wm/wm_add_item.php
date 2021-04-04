<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['role'] == 'warehouse') {
    include("wm_topbar.php");
    include("..\..\connect.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }

  if (isset($_GET["id"])) {
    $id = $_GET["id"];
  }


  if (isset($id)) {
    $query = "SELECT * FROM product WHERE product_id='$id';";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
  }
?>


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Item Information</title>
    <style>
      td {
        padding-top: 10px;
        padding-bottom: 10px;
        padding-right: 10px;
        padding-left: 10px;
        border-bottom: 2px solid black;
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
    <h2 class="outside">Add <?php echo $row['name']; ?></h2>
    <br>
    <div class="container">
      <h3>Please fill all fields before clicking submit</h3>
      <br>

      <form action="wm_add_item_function.php?id=<?php echo $id; ?>" method="post">
        <table style="width: 100%;">
          <tr>
            <td><label for="quantity">Quantity:</label></td>
            <td><input type="text" id="quantity" name="quantity"></td>
          </tr>
          <tr>
            <td><label for="delivered_by">Delivered By:</label></td>
            <td><input type="text" id="delivered_by" name="delivered_by"></td>
          </tr>
        </table>
        <button type="submit" name="button" style="float: right; margin-top: 10px;">Submit</button>
      </form>
    </div>
  </body>
</html>
