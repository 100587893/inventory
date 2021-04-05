<?php
	session_start();
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['role'] == 'admin') {
		include("pm_topbar.php");
		include("../../connect.php");
	} else {
		header("Location: C:/wamp64/www/index.php");
		exit();
	}

	$username = $_SESSION['user_name'];

	$query = "SELECT name FROM suppliers;";
	$result = mysqli_query($conn, $query);
?>


<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Supplier Management</title>

		<style>
			body{
				margin: 0 auto;
				background-image: url(../img/bg2.jpg);
			}
			table, tr, td {
				border: 1px solid black;
			}
		</style>
	</head>

	<body>
		<br>
		<div class="container">
			<h3>Select a supplier to edit:</h3>
			<br>

			<table style="width: 100%;">
				<?php
					$opt = "";

					while ($row = mysqli_fetch_assoc($result)) {
						$item = $row["name"];

						

						$opt .= "	<tr>
										<td>
											<a href='pm_supplier_edit.php?supplier=$item'>
												<div class='row' data-href='#' style='width: 100%; padding: 10px; padding-left: 25px;'>
													<h4>$item</h4>
												</div>
											</a>
										</td>
									</tr>";
					}

					$opt .= "	<tr>
									<td>
										<a href='pm_supplier_edit.php'>
											<div class='row' data-href='#' style='width: 100%; padding: 10px; padding-left: 25px;'>
												<h4>Add new supplier...</h4>
											</div>
										</a>
									</td>
								</tr>";
					echo $opt;
				?>
			</table>
		</div>
	</body>
</html>
