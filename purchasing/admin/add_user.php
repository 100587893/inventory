<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['role'] == 'admin') {
    include("pm_topbar.php");
    include("../../connect.php");
  } else {
    header("Location: C:/wamp64/www/index.php");
    exit();
  }
?>


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>User Information</title>
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
      <h3>Please Enter User Information</h3>
      <br>

      <form action="add_user_function.php" method="post">
        <table style="width: 100%;">
          <tr>
            <td><label for="name">Name:</label></td>
            <td><input type="text" id="name" name="name"style="width: 100%;"></td>
          </tr>
          <tr>
            <td><label for="email">E-Mail:</label></td>
            <td><input type="text" id="email" name="email" style="width: 100%;"></td>
          </tr>
          <tr>
            <td><label for="password">Password:</label></td>
            <td><input type="text" id="password" name="password" style="width: 100%;"></td>
          </tr>
          <tr>
            <td><label for="campus">Campus:</label></td>
            <td><input type="text" id="campus" name="campus" style="width: 100%;"></td>
          </tr>
          <tr>
            <td><label for="role">Role:</label></td>
            <td><input type="text" id="role" name="role" style="width: 100%;"></td>
          </tr>
        </table>
        <button type="submit" name="button" style="float: right; margin-top: 10px;">Create User</button>
      </form>
    </div>
  </body>
</html>
