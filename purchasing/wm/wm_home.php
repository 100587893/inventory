<?php
	session_start();
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['role'] == 'warehouse') {
		include("wm_topbar.php");
		include("../../connect.php");
	} else {
		header("Location: C:/wamp64/www/index.php");
		exit();
	}
?>


<html>
	<head>
		<title>Purchasing</title>
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
			width: 90%;
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
		}
		th.table1{
			height: 50px;
			background: #006;
			color: #FFF;
			font-size: 20px;
			text-align:center;
			font-family: Tahoma, Geneva, sans-serif;
		}
		th.table2{
			height: 50px;
			background: #F00;
			color: #FFF;
			font-size: 20px;
			text-align:center;
			font-family: Tahoma, Geneva, sans-serif;
		}
		td{
			height: 30px;
			background: #FFF;
			color: black;
			text-align:center;
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
		</style>
	</head>
	<body>

    	<section class="box">
       		<!--

            Order Requests

            -->
            <div class="container1">
                <br>
                <h2>Active Requests</h2>
                <table class="table1">
            	<tr>
                	<th class="table1">Campus</th>
                	<th class="table1">Total Number of Requests</th>
            	</tr>
      	<?php

				//number of requests query SCAR
				$sql = "SELECT COUNT(DISTINCT product_id) AS count FROM requests WHERE status = 'ordered' AND campus = 'Scarborough';";
				$result = $conn->query($sql);
				$row = $result->fetch_assoc();

				//number of requests query TOR
				$sql2 = "SELECT COUNT(DISTINCT product_id) AS count FROM requests WHERE status = 'ordered' AND campus = 'Toronto';";
				$result2 = $conn->query($sql2);
				$row2 = $result2->fetch_assoc();

				//number of requests query MISS
				$sql3 = "SELECT COUNT(DISTINCT product_id) AS count FROM requests WHERE status = 'ordered' AND campus = 'Mississauga';";
				$result3 = $conn->query($sql3);
				$row3 = $result3->fetch_assoc();

				//number of requests query BUR
				$sql4 = "SELECT COUNT(DISTINCT product_id) AS count FROM requests WHERE status = 'ordered' AND campus = 'Burlington';";
				$result4 = $conn->query($sql4);
				$row4 = $result4->fetch_assoc();

				//number of requests query Barrie
				$sql5 = "SELECT COUNT(DISTINCT product_id) AS count FROM requests WHERE status = 'ordered' AND campus = 'Barrie';";
				$result5 = $conn->query($sql5);
				$row5 = $result5->fetch_assoc();

				//number of requests query PETER
				$sql6 = "SELECT COUNT(DISTINCT product_id) AS count FROM requests WHERE status = 'ordered' AND campus = 'Peterborough';";
				$result6 = $conn->query($sql6);
				$row6 = $result6->fetch_assoc();

				echo "<tr>";
				echo "<td>Scarborough</td>";
				echo "<td>" . $row["count"]."</td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td>Toronto</td>";
				echo "<td>" . $row2["count"]."</td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td>Mississauga</td>";
				echo "<td>" . $row3["count"]."</td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td>Burlington</td>";
				echo "<td>" . $row4["count"]."</td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td>Barrie</td>";
				echo "<td>" . $row5["count"]."</td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td>Peterborough</td>";
				echo "<td>" . $row["count"]."</td>";
				echo "</tr>";

		?>
            </table>



            </div>


            <!--

            LOW STOCK ITEMS

            -->
            <div class="container2">
            <br>
            <h2>Warehouse Low-Stock Items</h2>
            <table class="table2">
            	<tr>
                	<th class="table2">Product ID</th>
                	<th class="table2">Product Name</th>
                	<th class="table2">Quantity</th>
                	<th class="table2">Manufacturer</th>
            	</tr>
      	<?php
					//Low stock query
					$sql = "SELECT warehouse_inv.product_id, product.name, warehouse_inv.pm_quantity, product.manufacturer FROM warehouse_inv INNER JOIN product ON warehouse_inv.product_id=product.product_id WHERE warehouse_inv.pm_quantity <= product.min_stock;";
					$result = $conn->query($sql);

					$row_cnt=$result->num_rows;

					if ($row_cnt > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<td>" . $row["product_id"]."</td>";
							echo "<td>" . $row["name"]."</td>";
							echo "<td>" . $row["pm_quantity"]."</td>";
							echo "<td>" . $row["manufacturer"]."</td>";
							echo "</tr>";
						}
					}
				?>
            </table>
            </div>
        </section>

    <br>

    </body>
</html>
