<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['role'] == 'purchasing') {
    include("pm_topbar.php");
    include("..\..\connect.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }

  if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
  }
?>


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Product Management</title>

    <style>
  		body{
  			margin: 0 auto;
  			background-image: url(../img/bg2.jpg);
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
    <br>
    <a href="add_item_category_select.php"><button type="button" name="button" style="float: right; margin-right: 50px;">New Item</button></a>
    <div class="container">
      <form class="searchData" method="get" action="product_management.php" style="width: 100%;">
        <input type="text" name="search" placeholder="Search..." style="width: 90%;">
        <button type="submit">Search</button>
      </form>
      <br>

      <table style="width: 100%;">
        <tr>
          <th>Product ID</th>
          <th>Product Name</th>
          <th>Manufacturer</th>
          <th>Supplier</th>
          <th>Unit</th>
          <th>Action</th>
        </tr>

        <?php
          $opt = "";
          if (isset($searchTerm)) {
            $query = "SELECT * FROM product WHERE name LIKE '%$searchTerm%';";
            $result = mysqli_query($conn, $query);
          }
          else {
            $query = "SELECT * FROM product;";
            $result = mysqli_query($conn, $query);
          }

          while ($row = mysqli_fetch_assoc($result)) {
            $opt .= " <tr>
                        <td>" .$row['product_id']. "</td>
                        <td>" .$row['name']. "</td>
                        <td>" .$row['manufacturer']. "</td>
                        <td>" .$row['supplier']. "</td>
                        <td>" .$row['unit']. "</td>
                        <td><a href='add_item_information.php?id=" .$row['product_id']. "&edit=True'><button type='button'>Edit</button></a></td>
                      </tr>";
          }

          echo $opt;
        ?>
      </table>
    </div>
  </body>
</html>
