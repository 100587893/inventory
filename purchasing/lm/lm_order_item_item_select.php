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

  $category = $_GET['category'];

  $query = "SELECT product_id, name FROM product WHERE category='$category';";
  $result = mysqli_query($conn, $query);
?>


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Item Select</title>

    <style>
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
        background: #FFF;
        color: black;
        font-size: 20px;
      }
      .table-row {
        cursor: pointer;
      }
    </style>
  </head>
  <body>
    <br>
    <div class="container">
      <h2>Please Select An Item</h2>
      <br>
      <table>
        <tr>
          <th>Product ID</th>
          <th>Product Name</th>
          <th>Product Image</th>
        </tr>

        <?php
          $opt = "";

          while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["product_id"];
            $name = $row["name"];

            $opt .= " <tr class='table-row' data-href='lm_order_item_add_item_information.php?id=$id'>
                        <td>$id</td>
                        <td>$name</td>
                        <td><image src='../../images/$id.jpg' style='height: 40%;'></td>
                      </tr>";
          }

          echo $opt;
        ?>
      </table>
    </div>

    <script type="text/javascript">
      document.addEventListener("DOMContentLoaded", () => {
        const rows = document.querySelectorAll("tr[data-href]");

        rows.forEach(row => {
          row.addEventListener("click", () => {
            window.location.href = row.dataset.href;
          });
        });
      });
    </script>
  </body>
</html>
