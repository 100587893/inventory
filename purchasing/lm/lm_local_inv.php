<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSSION['role']='local') {
	include("lm_topbar.php");
	include("..\..\connect.php");
  } else {
  	header("Location: C:/wamp64/www/index.php");
  	exit();
  }

  $campus = $_SESSION['access'];
?>
<html>
	<head>
		<title><?php echo $campus; ?></title>
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
		.container1{
			margin-top: 50px;
			margin-left: 10%;
			width: 38%;
			height: 700px;
			text-align:center;
			background-color: white;
			float:left;
			border-radius: 80px;
			border-color: black;
			border-width: thick;
			border-style: solid;
		}
		.container2{
			margin-top: 50px;
			margin-right: 10%;
			height: 700px;
			width: 38%;
			text-align:center;
			background-color: white;
			float: right;
			border-radius: 80px;
			border-color: black;
			border-width: thick;
			border-style: solid;
		}
		.item{
			height: 45px;
			width: 500px;
			font-size: 16px;
			margin-bottom: 20px;
			background-color: #fff;
			padding-left: 40px;
		}
		.outside{
			font-size: 40px;
			color: Black;
			font-family: Tahoma, Geneva, sans-serif;
			text-align:center;
		}
		input[type=radio] {
			height: 25px;
			width: 25px;
			vertical-align:middle;
		}
		input[type="submit"]{
			margin-top: 10px;
			height: 45px;
			width: 150px;
			font-size: 16px;
			background-color: #000;
			color: white;
		}
		p{
			font-size: 20px;
			color: black;
		}
		h2{
			font-size: 40px;
			color: black;
			font-family: Tahoma, Geneva, sans-serif;
			text-align:center;
		}
		table.table1{
			border-collapse: collapse;
			width: 70%;
			font-size:18px;
			margin: 0 auto;

		}
		table.table2{
			border-collapse: collapse;
			width: 90%;
			font-size:18px;
			margin: 0 auto;

		}
		table, th, td {
			border: 1px solid black;
			text-align:center;

		}
		th.table1{
			height: 50px;
			background: #006;
			color: #FFF;
			font-size: 20px;
			font-family: Tahoma, Geneva, sans-serif;
		}
		th.table2{
			height: 50px;
			background: #F00;
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
		</style>
	</head>
	<body>
    <br>
    <br>
    <!--

    CURRENT INVENTORY

    -->
    <h2 class="outside">Current <?php echo $campus ?> Inventory List</h2>
    <br>
    <br>

    <table class="table1">
    	<tr>
      		<th class="table1">Product ID</th>
			<th class="table1">Product Name</th>
			<th class="table1">Manufacturer</th>
			<th class="table1">Quantity</th>
     	 	<th class="table1">Description</th>
     	 	<th class="table1">Action</th>
      	</tr>
		<?php
    $inv = $campus ."_inv";
		//Static Query
		$sql = "SELECT * FROM $inv INNER JOIN product ON $inv.product_id=product.product_id WHERE $inv.quantity>0;";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$productid=$row["product_id"];
				echo "<tr>";
				echo "<td>" . $row["product_id"]."</td>";
				echo "<td>" . $row["name"]."</td>";
				echo "<td>" . $row["manufacturer"]."</td>";
				echo "<td>" . $row["quantity"]."</td>";
				echo "<td>" . $row["description"]."</td>";
				echo "	<td>
							<a href='lm_add_sub.php?id=$productid&add=true' style='width: 50%; float: left;'><button type='button'>Add</button></a>
							<a href='lm_add_sub.php?id=$productid&sub=true' style='width: 50%; float: right;'><button type='button'>Remove</button></a>
						</td>";
				echo "</tr>";
			}
		}
		?>
    </table>
    <br>
    <br>
    <br>
    </body>
</html>
