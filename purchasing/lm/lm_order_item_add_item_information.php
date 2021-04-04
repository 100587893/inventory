<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSSION['role']='local') {
    include("lm_topbar.php");
    include("../../connect.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }

  if (isset($_GET["category"])) {
    $category = $_GET["category"];
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
    <title></title>
    <style>
      td {
        padding-top: 10px;
        padding-bottom: 10px;
        padding-right: 10px;
        padding-left: 10px;
        border-bottom: 2px solid black;
      }
      img {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 40%;
      }
    </style>
  </head>
  <body>
    <br>
    <div class="container">
      <h3 style="text-align: center;"><?php echo $row['name']; ?></h3><br>
      <img src="../../images/<?php echo $row['id']; ?>.jpg">
      <br>

      <form action="lm_order_item_add_item_function.php?id=<?php echo $id ?>" method="post">
        <label for="quantity"><b>Quantity:</b></label>
        <input type="text" id="quantity" name="quantity" style="width: 100%;">
        <button type="submit" name="button" style="float: right; margin-top: 10px;">Add To Order</button>
      </form>
    </div>
  </body>
</html>
