<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSSION['role']='campus') {
    include("cm_topbar.php");
    include("../../connect.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }

  $query = "SELECT DISTINCT category FROM product;";
  $result = mysqli_query($conn, $query);
?>


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Category Select</title>

    <style>
      body{
        margin: 0 auto;
        background-image: url(../img/bg2.jpg);
      }
      .row {
        border: 2px solid black;
      }
    </style>
  </head>
  <body>
    <br>
    <div class="container">
      <h3>Please Select A Category</h3>
      <br>
      <?php
        $opt = "";

        while ($row = mysqli_fetch_assoc($result)) {
          $item = $row["category"];

					$opt .= "	 <a href='cm_order_item_item_select.php?category=$item'>
											 <div class='row' data-href='#' style='width: 100%; padding: 10px;'>
											 		<h4>$item</h4>
											 </div>
										 </a>";
        }
        echo $opt;
      ?>
    </div>
  </body>
</html>
