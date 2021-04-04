<?php
  include("nav.php");
  $category = $_GET["category"];
  $id = $_GET["id"];

  $connect = mysqli_connect("localhost:3306", "root", "", "INVMS");
  $query = "SELECT * FROM products WHERE p_id LIKE $id;"
  $result = mysqli_query($connect, $query);

?>


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="container">
      <form action="index.html" method="post">
        <label for="category">Category:</label>
        <input type="text" id="category" name="category" value="  <?php echo $category; ?>">

        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName" value="<?php echo $result["name"]; ?>">

        <label for="serial">Serial Number:</label>
        <input type="text" id="serial" name="serial" value="<?php echo $result["serial"]; ?>">

        <label for="manufacturer">Manufacturer:</label>
        <input type="text" id="manufacturer" name="manufacturer" value="<?php echo $result["manufacturer"]; ?>">

        <label for="supplier">Supplier:</label>
        <input type="text" id="supplier" name="supplier" value="<?php echo $result["supplier"]; ?>">

        <label for="description">Description:</label>
        <input type="text" id="description" name="description" value="<?php echo $result["name"]; ?>">

        <label for="minStock">Minimum Stock:</label>
        <input type="text" id="minStock" name="minStock" value="">

        <label for="image">Image(if applicable):</label>
        <input type="image" id="image" name="image" value="">

        <button type="submit" name="button">Submit</button>
      </form>
    </div>
  </body>
</html>
