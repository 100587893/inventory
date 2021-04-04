<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['role'] == 'campus') {
    include("cm_topbar.php");
    include("..\..\connect.php");
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
    <title>Item Information</title>
    <style>
      td {
        padding-top: 10px;
        padding-bottom: 10px;
        padding-right: 10px;
        padding-left: 10px;
        border-bottom: 1px solid black;
      }
    </style>
  </head>
  <body>
    <br>
    <div class="container">
      <h3>Please Enter Item Information</h3>
      <br>

      <?php
        if (!isset($id)) {
          echo "<p>Enter all available information. Category, Product Name, Manufacturer, Description, and Minimum Stock are required.</p><br>";
        }
      ?>
      <form action="cm_request_item_function.php" method="post">
        <table style="width: 100%;">
          <tr>
            <td><label for="category">Category:</label></td>
            <td><input type="text" id="category" name="category" value="<?php
                                                                        if (isset($category)) {
                                                                          echo $category;
                                                                        }
                                                                        elseif (isset($id)) {
                                                                          echo $row["category"];
                                                                        }
                                                                      ?>" style="width: 100%;"></td>
          </tr>
          <tr>
            <td><label for="productName">Product Name:</label></td>
            <td><input type="text" id="productName" name="productName" value="<?php
                                                                              if (isset($result)) {
                                                                                echo $row["name"];
                                                                              }
                                                                            ?>" style="width: 100%;"></td>
          </tr>
          <tr>
            <td><label for="serial">Serial Number:</label></td>
            <td><input type="text" id="serial" name="serial" value="<?php
                                                                    if (isset($result)) {
                                                                      echo $row["product_id"];
                                                                    }
                                                                  ?>" style="width: 100%;"></td>
          </tr>
          <tr>
            <td><label for="manufacturer">Manufacturer:</label></td>
            <td><input type="text" id="manufacturer" name="manufacturer" value="<?php
                                                                                if (isset($result)) {
                                                                                  echo $row["manufacturer"];
                                                                                }
                                                                              ?>" style="width: 100%;"></td>
          </tr>
          <tr>
            <td><label for="supplier">Supplier:</label></td>
            <td><input type="text" id="supplier" name="supplier" value="<?php
                                                                        if (isset($result)) {
                                                                          echo $row["supplier"];
                                                                        }
                                                                      ?>" style="width: 100%;"></td>
          </tr>
          <tr>
            <td><label for="description">Description:</label></td>
            <td><input type="text" id="description" name="description" value="<?php
                                                                                if (isset($result)) {
                                                                                  echo $row["description"];
                                                                                }
                                                                              ?>" style="width: 100%;"></td>
          </tr>
          <tr>
            <td><label for="minStock">Minimum Stock:</label></td>
            <td><input type="text" id="minStock" name="minStock" value="<?php
                                                                        if (isset($result)) {
                                                                          echo $row["min_stock"];
                                                                        }
                                                                      ?>" style="width: 100%;"></td>
          </tr>
          <tr>
            <td><label for="unit">Measurement Unit:</label></td>
            <td><select id="unit" name="unit" style="width: 100%;">
                  <option value="box" <?php if (isset($result)) { if ($row["unit"] == "Box") { echo "selected"; } } ?>>Box</option>
                  <option value="box" <?php if (isset($result)) { if ($row["unit"] == "Item") { echo "selected"; } } ?>>Item</option>
                  <option value="box" <?php if (isset($result)) { if ($row["unit"] == "Case") { echo "selected"; } } ?>>Case</option>
                </select>
            </td>
          </tr>
        </table>
        <button type="submit" class="btn btn-primary" style="float: right; margin-top: 10px;">Submit</button>
      </form>
    </div>
  </body>
</html>
